<template>
    <div>
        <div class="form-group m-form__group d-md-flex">
            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                <label for="exampleInputEmail1">{{$parent.$options.name}} Meta Title :</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control m-input" v-bind:name="$parent.$options.name.toLowerCase()+'[meta_title]'" placeholder="Meta Title SEO" v-bind:value="$parent.$parent.settings.global.value.meta_title">
            </div>
        </div>
        <div class="form-group m-form__group d-md-flex">
            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                <label for="exampleInputEmail1">{{$parent.$options.name}} Meta Keyword :</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control m-input" v-bind:name="$parent.$options.name.toLowerCase()+'[meta_keyword]'" placeholder="Meta Keyword SEO" v-bind:value="$parent.$parent.settings.global.value.meta_keyword" data-role="tagsinput">
            </div>
        </div>
        <div class="form-group m-form__group d-md-flex">
            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                <label for="exampleInputEmail1">{{$parent.$options.name}} Meta Description :</label>
            </div>
            <div class="col-md-8">
                <textarea type="text" class="form-control m-input autosize" v-bind:name="$parent.$options.name.toLowerCase()+'[meta_description]'" placeholder="Meta Description SEO" v-bind:value="$parent.$parent.settings.global.value.meta_description"></textarea>
            </div>
        </div>
        <div class="form-group m-form__group d-md-flex">
            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                <label for="exampleInputEmail1">{{$parent.$options.name}} Facebook Share Title  :</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control m-input" v-bind:name="$parent.$options.name.toLowerCase()+'[fb_share_title]'" placeholder="Meta Title SEO" v-bind:value="$parent.$parent.settings.global.value.fb_share_title">
            </div>
        </div>
    </div>
</template>
<script>

    import "../../../assets/metronic-v5/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css"

    import $ from "jquery"
    import autosize from '../../../assets/js/autosize.min.js'

    export default {
        data(){
            return{
            }
        },
        mounted(){
            this.$nextTick(() => {
                let self = this;
                let vendor = this.$parent.$parent.libSelector(this.$parent.$parent.vendor_bundle);
                vendor.addEventListener('load', (event) => {
                   autosize($(".autosize"));
    
                   if(!self.$parent.$parent.isLoadedScript(this.$route.meta.APP_URL+'/metronic-v5/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')){
                        var doc = document.createElement('script');  
                        doc.setAttribute('src',this.$route.meta.APP_URL+'/metronic-v5/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js');
                        doc.setAttribute('type', 'text/javascript');
                        document.body.appendChild(doc);
                   }
                });
            });
        }
    }
</script>
<style lang="scss">
    .bootstrap-tagsinput{
        .tag{
            background-color: #9f87de;
            padding: 0.05rem 0.4rem 0.05rem 0.4rem;
        }
    } 
</style>