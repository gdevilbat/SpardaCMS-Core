import CKEditor from 'ckeditor4-vue';

window._ = require('lodash');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

Vue.use(CKEditor);
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

if(window.env == "testing")
    $.fn.dataTable.ext.errMode = 'none';
 
// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register( 'clearPipeline()', function () {
    return this.iterator( 'table', function ( settings ) {
        settings.clearCache = true;
    } );
} );

$.fn.exists = function(){ return this.length > 0; }
 

})(jQuery);

let objInputFileManager;
let objPreviewFileManager;

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
            /*url = window.location.href;
            url = url.split("#");
            if(1 in url)
            {
                var api = new $.fn.dataTable.Api( settings );
                api.page(parseInt(url[1])-1).draw('page');
            }*/
       },
       "drawCallback": function( settings ) {
                deleteData();
        }
    });

    //$(".dataTables_wrapper .dataTables_paginate").click(function(event) {
        /*url = window.location.href;
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
        window.location = new_url;*/

        /*===========================================
        =            Delete Confirmation            =
        ===========================================*/

            /*$(".confirm-delete").click(function(event) {
                confirm_delete.data.object = this;
            });

            $(".confirmed").click(function(event) {
                $(confirm_delete.data.object).prev().get(0).submit();
            });*/

        /*=====  End of Delete Confirmation  ======*/
    //});

    /*var hidden_table = $(".hidden-table").dataTable({
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
    });*/

    /*==============================================
    =            Component Filter Table            =
    ==============================================*/

         /*$(".length-filter").each(function(index, el) {
             $(this).change(function(event) {
                $($(this).parents("form").get(0)).submit();
             });
         }); 

         $(".search-filter").each(function(index, el) {
             $(this).click(function(event) {
                $($(this).parents("form").get(0)).submit();
             });
         });  */ 

    /*=====  End of Component Filter Table  ======*/

    /*==================================
    =            Data Table            =
    ==================================*/
    
    $(".data-table-ajax").each(function(index, el) {
        if($("#"+$(this).attr('id')).length > 0)
        {
            window['table_'+$(this).attr('id')] = generateDatatable(this);
        }
        else
        {
            generateDatatable(this);
        }
    });
    
    /*=====  End of Data Table  ======*/
    

    /*========================================
    =            Image Filemanage            =
    ========================================*/

        if($(".filemanager-image").length > 0)
        {
            $('.filemanager-image').filemanager('image', {prefix: base+'/control/filemanager'});
        }

        if($(".lfm-input").length > 0)
        {
            $(".lfm-input").each(function(index, el) {
                $(this).click(function(event) {
                    event.preventDefault();

                      objInputFileManager = $('#'+$(this).attr('data-input'));
                      objPreviewFileManager = $('#'+$(this).attr('data-preview'));

                      window.open(base+'/file-manager/fm-button?leftDisk='+window.disk+'&rightDisk='+window.disk, 'fm', 'width=800,height=600');
                });   
            });
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

    /*====================================
    =            Multi Select            =
    ====================================*/
    
    if($(".select2").length)
    {
        $(".select2").select2({
          placeholder: {
            id: '-1', // the value of the option
            text: 'Select an option'
          }
        });
    }
    
    /*=====  End of Multi Select  ======*/

    /*===========================================
    =            Delete Confirmation            =
    ===========================================*/

       window.deleteData();

    /*=====  End of Delete Confirmation  ======*/

    /*=================================
    =            CK Editor            =
    =================================*/
    
        /*$(".texteditor").each(function () {
             CKEDITOR.replace( $(this).attr("name"),{
                filebrowserImageBrowseUrl: base+'/control/filemanager?type=Images',
                filebrowserImageUploadUrl: base+'/control/filemanager/upload?type=Images&_token='+window.Laravel.csrfToken,
                filebrowserBrowseUrl: base+'/control/filemanager?type=Files',
                filebrowserUploadUrl: base+'/control/filemanager/upload?type=Files&_token='+window.Laravel.csrfToken,
                image_previewText: ' '
            });
        });*/

        $(".texteditor").each(function () {
            if(CKEDITOR.instances[$(this).attr("name")] == undefined)
            {
                 CKEDITOR.replace( $(this).attr("name"),{
                    filebrowserImageBrowseUrl: base+'/file-manager/ckeditor',
                });
            }
        });
    
    /*=====  End of CK Editor  ======*/

    /*====================================
    =            Slugify link            =
    ====================================*/

        /*----------  Post Slug URL  ----------*/
       $(".slugify").each(function(index, el) {
           $(this).keyup(function(event) {
               if(getParameterByName('code') == null)
               {
                   var target = $(this).attr('data-target');
                   $("#"+target).val(slugify($(this).val()));
               }
           });
       });

       /*----------  Slug Self  ----------*/
       $(".slug-me").each(function(index, el) {
           $(this).change(function(event) {
               $(this).val(slugify($(this).val()));
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

    /*============================================
    =            Show Count Text Area            =
    ============================================*/
    
    $(".count-textarea").each(function(index, el) {
        $($(this).attr('data-target-count-text')).html(this.value.length);
        $(this).keyup(function(event) {
            showCountTextLength(this, event);
        });    
    });
    
    /*=====  End of Show Count Text Area  ======*/
    

    /*============================================
    =            Masking Phone number            =
    ============================================*/

        $(".phone").keyup(function(event) {
            var phone = this.value;
            for(var i = 0; i < phone.length; i++){
                var valid_number;

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
            var number = [8, 37, 39, 48, 49, 50, 51, 52 , 53, 54, 55, 56, 57];
            var value  = $.inArray(event.keyCode, number);
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


    /*======================================
    =            Data Checklist            =
    ======================================*/
    
        $("#data-checklist").change(function(event) {
            let self = $(this);
            $(".data-checklist").each(function(index, el) {
                if($(self).is(':checked')){
                    $(this).prop('checked', true);
                }
                else
                {
                    $(this).prop('checked', false);
                }
            });
        });
    
    /*=====  End of Data Checklist  ======*/
    
    
    
});

/*=============================================
=            Loading Overlay           =
=============================================*/

    var $loading = $('.loading-overlay');
    $(document)
      .ajaxStart(function (event) {
        $loading.show();
      })
      .ajaxStop(function () {
        $loading.hide();
      })

/*=====  End of Loading Overlay ======*/

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
                            $('.filemanager-image').filemanager('image', {prefix: base+'/control/filemanager'});
                        }

                        $(".banner").each(function(index, el) {
                           $(this).change(function(event) {
                               //window.alert('asdads');
                               var value = $(this).val();
                               var index = $(this).attr('data-index');
                               var name = $(this).attr('data-name');
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
                                $('.filemanager-image').filemanager('image', {prefix: base+'/control/filemanager'});
                            }
                        $(".banner").each(function(index, el) {
                           $(this).change(function(event) {
                               //window.alert('asdads');
                               var value = $(this).val();
                               var index = $(this).attr('data-index');
                               var name = $(this).attr('data-name');
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
            window: window,
            editorConfig: {
                filebrowserImageBrowseUrl: window.base+'/file-manager/ckeditor',
            }
        },
       methods: {
            addComponent: function(){
                this.components.push([]);
                this.$nextTick(function(){
                        let self = this;

                        /*========================================
                        =            Image Filemanage            =
                        ========================================*/

                        if($(".filemanager-file").length > 0)
                        {
                            $('.filemanager-file').filemanager('file', {prefix: base+'/control/filemanager'});
                        }

                        if($(".filemanager-image").length > 0)
                        {
                            $('.filemanager-image').filemanager('image', {prefix: base+'/control/filemanager'});
                        }

                        $(this.$el).find(".file-input").each(function(index, el) {
                           $(this).change(function(event) {
                               //window.alert('asdads');
                               var value = $(this).val();
                               var index = $(this).attr('data-index');
                               var name = $(this).attr('data-name');
                               self.$set(self.components[index], name, value);
                           });
                        });
                });
            },
            removeComponent: function(index){
                this.components.splice(index, 1);
            },
            browseFileManager: function(e){
                objInputFileManager = $(this.$el).find('#'+$(e.target).attr('data-input')).eq(0);
                objPreviewFileManager = $(this.$el).find('#'+$(e.target).attr('data-preview')).eq(0);

                window.open('/file-manager/fm-button?leftDisk='+window.disk+'&rightDisk='+window.disk, 'fm', 'width=800,height=600');
            }
        },
        mounted: function () {
                this.$nextTick(function () {
                    let self = this;

                    /*========================================
                    =            Image Filemanage            =
                    ========================================*/

                    if($(".filemanager-file").length > 0)
                    {
                        $('.filemanager-file').filemanager('file', {prefix: base+'/control/filemanager'});
                    }

                    if($(".filemanager-image").length > 0)
                    {
                        $('.filemanager-image').filemanager('image', {prefix: base+'/control/filemanager'});
                    }

                    $(this.$el).find(".file-input").each(function(index, el) {
                       $(this).change(function(event) {
                           value = $(this).val();
                           index = $(this).attr('data-index');
                           name = $(this).attr('data-name');
                           self.$set(self.components[index], name, value);
                       });
                    });

                    $(this.$el).find(".texteditor").each(function () {
                        if(CKEDITOR.instances[$(this).attr("name")] == undefined)
                        {
                             CKEDITOR.replace( $(this).attr("name"),{
                                filebrowserImageBrowseUrl: base+'/file-manager/ckeditor',
                            });

                        }
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

function generateDatatable(object){
    return $(object).DataTable( {
        "pagingType": "full_numbers",
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": $.fn.dataTable.pipeline( {
            url: $(this).attr('data-ajax'),
            pages: 5 // number of pages to cache
        }),
         "columnDefs": [
        ],
        "drawCallback": function( settings ) {
            let api = new $.fn.dataTable.Api( settings );
            let page = api.page.info().page + 1;
            let stateObj = { id: page };
              
            window.history.pushState(stateObj,
                     $('title').text(), "?page="+page);

            deleteData();
        },
        "initComplete": function(settings, json) {
            let $searchBox = $("div.dataTables_filter input");
            $searchBox.unbind();
            let searchDebouncedFn = debounce(function() {
                let api = new $.fn.dataTable.Api( settings );
                api.search( this.value ).draw();
            }, 1000);
            $searchBox.on("keyup", searchDebouncedFn);
        }
    } );
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function showCountTextLength(textBox, e) { 
    
    var maxLength = parseInt($(textBox).data("length"));
    
  
    $($(textBox).attr('data-target-count-text')).html(textBox.value.length);
    
    return true; 
}

window.popupWindow = function(url, windowName, win, w, h) {
    const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
    const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
    return win.open(url, windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
}

window. debounce = function(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

window.fmSetLink = function($url){
    objInputFileManager.val($url.replace(window.storage_url, '')).change();
    objPreviewFileManager.attr('src', $url);
}

window.getStorageLink = function($url){
    if(isValidURL($url))
    {
        return $url;
    }
    else
    {
        return window.base+$url;
    }
}

window.isValidURL = function (url) {

    var res = url.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
  return (res !== null)
};

window.objSize = function(obj) {
    var count = 0;
    
    if (typeof obj == "object") {
    
        if (Object.keys) {
            count = Object.keys(obj).length;
        } else if (window._) {
            count = _.keys(obj).length;
        } else if (window.$) {
            count = $.map(obj, function() { return 1; }).length;
        } else {
            for (var key in obj) if (obj.hasOwnProperty(key)) count++;
        }
        
    }
    
    return count;
};