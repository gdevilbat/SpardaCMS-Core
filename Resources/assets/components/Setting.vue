<template>
	<div class="row">
        <div class="col-sm-12">

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="fa fa-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Setting Form
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right" v-on:submit.prevent="submit($event)">
                    <div class="m-portlet__body">
                        <Meta/>
                        <hr/>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end py-3">
                                <label for="">{{$options.name}} Background Landscape</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-background-landscape" data-preview="global-background-landscape_preview" class="btn btn-primary" v-on:click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input id="global-background-landscape" class="form-control m-input" type="text" v-bind:name="$options.name.toLowerCase()+'[background][landscape]'">
                                    </div>
                                <img id="global-background-landscape_preview" style="margin-top:15px;max-height:100px;">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end py-3">
                                <label for="">{{$options.name}} Background Portrait</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-background-portrait" data-preview="global-background-portrait_preview" class="btn btn-primary" v-on:click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input id="global-background-portrait" class="form-control m-input" type="text" v-bind:name="$options.name.toLowerCase()+'[background][portrait]'">
                                    </div>
                                <img id="global-background-portrait_preview" style="margin-top:15px;max-height:100px;">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end py-3">
                                <label for="">{{$options.name}} Favicon Image</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-favicon" data-preview="global-favicon_preview" class="btn btn-primary" v-on:click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input id="global-favicon" class="form-control m-input" type="text" v-bind:name="$options.name.toLowerCase()+'[favicon]'">
                                    </div>
                                <img id="global-favicon_preview" style="margin-top:15px;max-height:100px;">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end py-3">
                                <label for="">{{$options.name}} Logo Image</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-logo" data-preview="global-logo_preview" class="btn btn-primary" v-on:click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input id="global-logo" class="form-control m-input" type="text" v-bind:name="$options.name.toLowerCase()+'[logo]'">
                                    </div>
                                <img id="global-logo_preview" style="margin-top:15px;max-height:100px;">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end py-3">
                                <label for="">{{$options.name}} Not Found Image</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-not_found_image" data-preview="global-not_found_image_preview" class="btn btn-primary" v-on:click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input id="global-not_found_image" class="form-control m-input" type="text" v-bind:name="$options.name.toLowerCase()+'[not_found_image]'">
                                    </div>
                                <img id="global-not_found_image_preview" style="margin-top:15px;max-height:100px;">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end py-3">
                                <label for="">{{$options.name}} Maintenance Image</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-maintenance_image" data-preview="global-maintenance_image_preview" class="btn btn-primary" v-on:click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input id="global-maintenance_image" class="form-control m-input" type="text" v-bind:name="$options.name.toLowerCase()+'[maintenance_image]'">
                                    </div>
                                <img id="global-maintenance_image_preview" style="margin-top:15px;max-height:100px;">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group m-form__group d-md-flex">
                            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                                <label for="exampleInputEmail1">{{$options.name}} Google Site Verification :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control m-input" v-bind:name="$options.name.toLowerCase()+'[google_site_verification]'" placeholder="Google Site Verification" v-bind:value="$parent.settings.global.value.google_site_verification">
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex">
                            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                                <label for="exampleInputEmail1">Pagination Count :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" class="form-control m-input" name="pagination_count" placeholder="Google Site Verification" v-bind:value="$parent.settings.pagination_count">
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="offset-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->

            </div>
            <!--end::Portlet-->

        </div>
    </div>
</template>
<script>
    import Meta from './Meta.vue'
    import FileManager from './FileManager.vue'

    export default {
        mixins: [FileManager],
        name: 'Global',
        components: {
            Meta
        },
        data(){
            return{
            }
        },
         created() {
          this.$parent.$data.breadcumb = ` <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                                <li class="m-nav__item m-nav__item--home">
                                                    <a href="#" class="m-nav__link m-nav__link--icon">
                                                        <i class="m-nav__link-icon la la-home"></i>
                                                    </a>
                                                </li>
                                                <li class="m-nav__separator">-</li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <span class="m-nav__link-text">Home</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__separator">-</li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <span class="m-nav__link-text">Setting</span>
                                                    </a>
                                                </li>
                                            </ul>`;
        },
        methods: {
            submit: function(e){
                let formData = new FormData(e.target);
                formData.append('_method', 'PUT');

                axios({
                    method: "post",
                    url: "/control/setting",
                    data: formData,
                    headers: { "Content-Type": "multipart/form-data" },
                })
                .then(function (response) {
                    //handle success
                    console.log(response);
                })
                .catch(function (response) {
                    //handle error
                    console.log(response);
                });
            }
        },
    }
</script>
<style lang="scss" scoped>
</style>