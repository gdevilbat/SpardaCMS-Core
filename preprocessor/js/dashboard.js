window._ = require('lodash');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

Vue.config.errorHandler = function (err, vm) {
  window.console.log(err);
};

$ = window.$;
jQuery = window.jQuery;

String.prototype.toProperCase = function () {
    return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};

(function($) {
$.fn.serializefiles = function() {
    var obj = $(this);
    /* ADD FILE TO PARAM AJAX */
    var formData = new FormData();
    $.each($(obj).find("input[type='file']"), function(i, tag) {
        $.each($(tag)[0].files, function(i, file) {
            formData.append(tag.name, file);
        });
    });
    var params = $(obj).serializeArray();
    $.each(params, function (i, val) {
        formData.append(val.name, val.value);
    });
    return formData;
};

//
// Pipelining function for DataTables. To be used to the `ajax` option of DataTables
//
$.fn.dataTable.pipeline = function ( opts ) {
    // Configuration options
    var conf = $.extend( {
        pages: 5,     // number of pages to cache
        url: '',      // script url
        data: null,   // function or object with parameters to send to the server
                      // matching how `ajax.data` works in DataTables
        method: 'GET' // Ajax HTTP method
    }, opts );
 
    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;
 
    return function ( request, drawCallback, settings ) {
        var ajax          = false;
        var requestStart  = request.start;
        var drawStart     = request.start;
        var requestLength = request.length;
        var requestEnd    = requestStart + requestLength;
         
        if ( settings.clearCache ) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        }
        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
            // outside cached data - need to make a request
            ajax = true;
        }
        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                  JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                  JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
        ) {
            // properties changed (ordering, columns, searching)
            ajax = true;
        }
         
        // Store the request for checking next time around
        cacheLastRequest = $.extend( true, {}, request );
 
        if ( ajax ) {
            // Need data from the server
            if ( requestStart < cacheLower ) {
                requestStart = requestStart - (requestLength*(conf.pages-1));
 
                if ( requestStart < 0 ) {
                    requestStart = 0;
                }
            }
             
            cacheLower = requestStart;
            cacheUpper = requestStart + (requestLength * conf.pages);
 
            request.start = requestStart;
            request.length = requestLength*conf.pages;
 
            // Provide the same `data` options as DataTables.
            if ( $.isFunction ( conf.data ) ) {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data( request );
                if ( d ) {
                    $.extend( request, d );
                }
            }
            else if ( $.isPlainObject( conf.data ) ) {
                // As an object, the data given extends the default
                $.extend( request, conf.data );
            }
 
            settings.jqXHR = $.ajax( {
                "type":     conf.method,
                "url":      conf.url,
                "data":     request,
                "dataType": "json",
                "cache":    false,
                "success":  function ( json ) {
                    cacheLastJson = $.extend(true, {}, json);
 
                    if ( cacheLower != drawStart ) {
                        json.data.splice( 0, drawStart-cacheLower );
                    }
                    if ( requestLength >= -1 ) {
                        json.data.splice( requestLength, json.data.length );
                    }
                     
                    drawCallback( json );
                }
            } );
        }
        else {
            json = $.extend( true, {}, cacheLastJson );
            json.draw = request.draw; // Update the echo for each response
            json.data.splice( 0, requestStart-cacheLower );
            json.data.splice( requestLength, json.data.length );
 
            drawCallback(json);
        }
    }
};
 
// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register( 'clearPipeline()', function () {
    return this.iterator( 'table', function ( settings ) {
        settings.clearCache = true;
    } );
} );
 

})(jQuery);

$(document).ready(function() {
    var confirm_delete = {
        data: {
            'object' : null
        }
    }
    window.confirm_delete = confirm_delete;
    
    /*----------  Datatable  ----------*/
    var table = $(".data-table").DataTable({
        "pagingType": "full_numbers",
        fnInitComplete: function(settings){
        url = window.location.href;
        url = url.split("#");
        if(1 in url)
        {
            var api = new $.fn.dataTable.Api( settings );
            api.page(parseInt(url[1])-1).draw('page');
        }
       }
    });

    $(".dataTables_wrapper .dataTables_paginate").click(function(event) {
        url = window.location.href;
        url = url.split("#");
        if($(".product-table").length > 0)
        {
            info = product.page.info();
        }
        else
        {
            info = table.page.info();
        }
        new_url = url[0]+'#'+(info.page+1);
        window.location = new_url;

        /*===========================================
        =            Delete Confirmation            =
        ===========================================*/

            $(".confirm-delete").click(function(event) {
                confirm_delete.data.object = this;
            });

            $(".confirmed").click(function(event) {
                $(confirm_delete.data.object).prev().get(0).submit();
            });

        /*=====  End of Delete Confirmation  ======*/
    });

    var hidden_table = $(".hidden-table").dataTable({
        buttons: [
            { extend: 'print', className: 'btn dark btn-outline' },
            { extend: 'copy', className: 'btn red btn-outline' },
            { extend: 'pdf', className: 'btn green btn-outline' },
            { extend: 'excel', className: 'btn yellow btn-outline ' },
            { extend: 'csv', className: 'btn purple btn-outline ' },
            { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
        ],
    });

    $('.table-toolbar  li > a.tool-action').on('click', function() {
        var action = $(this).attr('data-action');
        hidden_table.DataTable().button(action).trigger();
    });

    $(".btn-cancel").click(function(event) {
        window.history.back();
    });

    /*==============================================
    =            Component Filter Table            =
    ==============================================*/

         $(".length-filter").each(function(index, el) {
             $(this).change(function(event) {
                $($(this).parents("form").get(0)).submit();
             });
         }); 

         $(".search-filter").each(function(index, el) {
             $(this).click(function(event) {
                $($(this).parents("form").get(0)).submit();
             });
         });   

    /*=====  End of Component Filter Table  ======*/

    /*========================================
    =            Image Filemanage            =
    ========================================*/

        if($(".filemanager-image").length > 0)
        {
            $('.filemanager-image').filemanager('image', {prefix: base+'/filemanager'});
        }

    /*=====  End of Image Filemanage  ======*/

    /*==========================================
        =            Date Picker Object            =
        ==========================================*/
        
            if($(".date-picker").length > 0)
            {
                $(".date-picker").datepicker();
            }
            
            /*=====  End of Date Picker Object  ======*/

        /*=====  End of Data Table Object  ======*/

    /*============================================
    =            Masking Phone number            =
    ============================================*/

            $(".phone").keyup(function(event) {
                phone = this.value;
                for(var i = 0; i < phone.length; i++){
                    if(phone.charAt(0) == '0')
                    {
                        valid_number = setCharAt(phone, 0, '');
                        $(this).val(valid_number);
                    }

                    if(!phone.charAt(i).match(/[0-9]/))
                    {
                        valid_number = setCharAt(phone, i, '');
                        $(this).val(valid_number);
                    }
                }
            });

            $(".phone").keydown(function(event) {
                number = [8, 37, 39, 48, 49, 50, 51, 52 , 53, 54, 55, 56, 57];
                value  = $.inArray(event.keyCode, number);
                if(value !== -1)
                {
                    if(this.value.length === 0)
                    {
                        if(event.keyCode === 48)
                            return false;
                    }
                    return true;
                }

                return false;
            });

            window.setCharAt = function(str,index,chr){
                if(index > str.length-1) return str;
                return str.substr(0,index) + chr + str.substr(index+1);
            }

    /*=====  End of Masking Phone number  ======*/

    /*====================================
    =            Multi Select            =
    ====================================*/
    
    if($(".select2").length)
    {
        $(".select2").select2();
    }
    
    /*=====  End of Multi Select  ======*/

    /*===========================================
    =            Delete Confirmation            =
    ===========================================*/

       window.deleteData();

    /*=====  End of Delete Confirmation  ======*/

    /*=================================
    =            Form Role            =
    =================================*/

        $("#submit-role").click(function(event) {
            $(".checkbox").each(function(index, el) {
                if ($(this).is(':checked')) {
                    $($(this).next('.role').get(0)).val(true);
                  } else {
                    $($(this).next('.role').get(0)).val(false);
                  }
                $(this).attr('value', 'false');
            });
            $("#form-role").submit();
        });

    /*=====  End of Form Role  ======*/

    /*=================================
    =            CK Editor            =
    =================================*/
    
        $(".ckeditor").each(function () {
             CKEDITOR.replace( $(this).attr("name"),{
                filebrowserImageBrowseUrl: base+'/filemanager?type=Images',
                filebrowserImageUploadUrl: base+'/filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: base+'/filemanager?type=Files',
                filebrowserUploadUrl: base+'/filemanager/upload?type=Files&_token=',
                image_previewText: ' '
            });
        });
    
    /*=====  End of CK Editor  ======*/

    /*====================================
    =            Slugify link            =
    ====================================*/

        /*----------  Product Slug URL  ----------*/
       $(".slugify").each(function(index, el) {
           $(this).keyup(function(event) {
               target = $(this).attr('data-target');
               $("#"+target).val(slugify($(this).val()));
           });
       });

    /*=====  End of Slugify link  ======*/

    /*=========================================
    =            Autosize Textarea            =
    =========================================*/

        if($(".autosize").length)
        {
            autosize($(".autosize"));
        }
    
    /*=====  End of Autosize Textarea  ======*/
    
    
});

if($("#thead").length > 0)
{
    var TableComponent = new Vue({
        el: "#thead",
        data: {
            column: '',
            dir: '',
        },
        methods:{
            order: function(column){
                self = this;
                $first = $(self.$el).parents("div").get(0);
                $form = $($first).prevAll("form").get(0);
                $dir = $($form).children("[name='dir']").get(0);
                $column = $($form).children("[name='column']").get(0);
                if(column == $($column).val())
                {
                    if($($dir).val() == 'DESC')
                    {
                        new_dir = 'ASC';
                    }
                    else
                    {
                        new_dir = 'DESC';
                    }
                }
                else
                {
                        new_dir = 'DESC';
                }

                $($column).val(column);
                $($dir).val(new_dir);
                $($form).submit();
            }
        }
    })
}


/*=======================================
=            Form Commponent            =
=======================================*/

    if($("#form").length > 0)
    {
        var FormComponent = new Vue({
            el: "#form",
            data: {
                components: [
                ],
            },
            methods: {
                addComponent: function(){
                    this.components.push([]);
                    this.$nextTick(function(){
                        /*========================================
                        =            Image Filemanage            =
                        ========================================*/

                        if($(".filemanager-image").length > 0)
                        {
                            $('.filemanager-image').filemanager('image', {prefix: base+'/filemanager'});
                        }

                        $(".banner").each(function(index, el) {
                           $(this).change(function(event) {
                               //window.alert('asdads');
                               value = $(this).val();
                               index = $(this).attr('data-index');
                               name = $(this).attr('data-name');
                               FormComponent.components[index][name] = value;
                           });
                        });
                    });
                },
                removeComponent: function(index){
                    if($(".description").length > 0)
                    {
                       if(CKEDITOR.instances['description_'+index])
                           CKEDITOR.instances['description_'+index].destroy(true);
                    }
                    this.components.splice(index, 1);
                },
            },
            mounted: function () {
                    this.$nextTick(function () {
                        /*========================================
                        =            Image Filemanage            =
                        ========================================*/

                            if($(".filemanager-image").length > 0)
                            {
                                $('.filemanager-image').filemanager('image', {prefix: base+'/filemanager'});
                            }
                        $(".banner").each(function(index, el) {
                           $(this).change(function(event) {
                               //window.alert('asdads');
                               value = $(this).val();
                               index = $(this).attr('data-index');
                               name = $(this).attr('data-name');
                               FormComponent.components[index][name] = value;
                           });
                        });
                    });
            }
        });
        window.FormComponent = FormComponent;
    }


/*=====  End of Form Commponent  ======*/

/*=================================
=            Mixin Vue            =
=================================*/
    var componentMixin = {
        data: {
            window: window
        },
       methods: {
            addComponent: function(){
                this.components.push([]);
                this.$nextTick(function(){
                        /*========================================
                        =            Image Filemanage            =
                        ========================================*/

                        if($(".filemanager-file").length > 0)
                        {
                            $('.filemanager-file').filemanager('file', {prefix: base+'/filemanager'});
                        }

                        if($(".filemanager-image").length > 0)
                        {
                            $('.filemanager-image').filemanager('image', {prefix: base+'/filemanager'});
                        }


                        self = this;
                        $(".file-input").each(function(index, el) {
                           $(this).change(function(event) {
                               //window.alert('asdads');
                               value = $(this).val();
                               index = $(this).attr('data-index');
                               name = $(this).attr('data-name');
                               self.components[index][name] = value;
                           });
                        });
                });
            },
            removeComponent: function(index){
                this.components.splice(index, 1);
            },
        },
        mounted: function () {
                this.$nextTick(function () {
                    /*========================================
                    =            Image Filemanage            =
                    ========================================*/

                    if($(".filemanager-file").length > 0)
                    {
                        $('.filemanager-file').filemanager('file', {prefix: base+'/filemanager'});
                    }

                    if($(".filemanager-image").length > 0)
                    {
                        $('.filemanager-image').filemanager('image', {prefix: base+'/filemanager'});
                    }


                    self = this;
                    $(".file-input").each(function(index, el) {
                       $(this).change(function(event) {
                           //window.alert('asdads');
                           value = $(this).val();
                           index = $(this).attr('data-index');
                           name = $(this).attr('data-name');
                           self.components[index][name] = value;
                       });
                    });
                });
        }
    }
    window.componentMixin = componentMixin;

/*=====  End of Mixin Vue  ======*/

window.deleteData = function(){
     $(".confirm-delete").click(function(event) {
        confirm_delete.data.object = this;
    });

    $(".confirmed").click(function(event) {
        $(confirm_delete.data.object).prev().get(0).submit();
    });
}