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
                <form class="m-form m-form--fit m-form--label-align-right" @submit.prevent="submit($event)">
                    <div class="m-portlet__body">
                        <div class="col-md-5 offset-md-4" v-if="updated.status">
                            <div class="alert alert-dismissible fade show" :class="{'alert-info': updated.code == 200, 'alert-danger': updated.code != 200}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                {{updated.message}}
                            </div>
                        </div>
                        <Meta/>
                        <hr/>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                                <label for="">{{$options.name}} Background Landscape :</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-background-landscape" class="btn btn-primary" @click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input readonly id="global-background-landscape" class="form-control m-input" type="text" :name="$options.name.toLowerCase()+'[background][landscape]'" v-model="$parent.settings.global.value.background.landscape">
                                    </div>
                                <img style="margin-top:15px;max-height:100px;" :src="$route.meta.STORAGE_URL+$parent.settings.global.value.background.landscape" v-if="$parent.settings.global.value.background.landscape != null">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Best Size Less Than 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                                <label for="">{{$options.name}} Background Portrait :</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-background-portrait" class="btn btn-primary" @click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input readonly id="global-background-portrait" class="form-control m-input" type="text" :name="$options.name.toLowerCase()+'[background][portrait]'" v-model="$parent.settings.global.value.background.portrait">
                                    </div>
                                <img style="margin-top:15px;max-height:100px;" :src="$route.meta.STORAGE_URL+$parent.settings.global.value.background.portrait" v-if="$parent.settings.global.value.background.portrait != null">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Best Size Less Than 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                                <label for="">{{$options.name}} Favicon Image :</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-favicon" class="btn btn-primary" @click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input readonly id="global-favicon" class="form-control m-input" type="text" :name="$options.name.toLowerCase()+'[favicon]'" v-model="$parent.settings.global.value.favicon">
                                    </div>
                                <img style="margin-top:15px;max-height:100px;" :src="$route.meta.STORAGE_URL+$parent.settings.global.value.favicon" v-if="$parent.settings.global.value.favicon != null">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Best Size Less Than 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                                <label for="">{{$options.name}} Logo Image :</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-logo" class="btn btn-primary" @click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input readonly id="global-logo" class="form-control m-input" type="text" :name="$options.name.toLowerCase()+'[logo]'" v-model="$parent.settings.global.value.logo">
                                    </div>
                                <img style="margin-top:15px;max-height:100px;" :src="$route.meta.STORAGE_URL+$parent.settings.global.value.logo" v-if="$parent.settings.global.value.logo != null">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Best Size Less Than 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                                <label for="">{{$options.name}} Not Found Image :</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-not_found_image" class="btn btn-primary" @click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input readonly id="global-not_found_image" class="form-control m-input" type="text" :name="$options.name.toLowerCase()+'[not_found_image]'" v-model="$parent.settings.global.value.not_found_image">
                                    </div>
                                <img style="margin-top:15px;max-height:100px;" :src="$route.meta.STORAGE_URL+$parent.settings.global.value.not_found_image" v-if="$parent.settings.global.value.not_found_image != null">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Best Size Less Than 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex flex-wrap">
                            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                                <label for="">{{$options.name}} Maintenance Image :</label>
                            </div>
                            <div class="col-md-8">
                                    <div class="input-group m-input-group">
                                        <div class="input-group-prepend">
                                            <button data-input="global-maintenance_image" class="btn btn-primary" @click="lfmInput($event)">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </div>
                                        <input readonly id="global-maintenance_image" class="form-control m-input" type="text" :name="$options.name.toLowerCase()+'[maintenance_image]'" v-model="$parent.settings.global.value.maintenance_image">
                                    </div>
                                <img style="margin-top:15px;max-height:100px;" :src="$route.meta.STORAGE_URL+$parent.settings.global.value.maintenance_image" v-if="$parent.settings.global.value.maintenance_image != null">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Best Size Less Than 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group m-form__group d-md-flex">
                            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                                <label for="exampleInputEmail1">{{$options.name}} Google Site Verification :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control m-input" :name="$options.name.toLowerCase()+'[google_site_verification]'" placeholder="Google Site Verification" v-model="$parent.settings.global.value.google_site_verification">
                            </div>
                        </div>
                        <div class="form-group m-form__group d-md-flex">
                            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                                <label for="exampleInputEmail1">Pagination Count :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" class="form-control m-input" name="pagination_count" placeholder="Pagination Number of Page" v-model="$parent.settings.pagination_count">
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
                 <loading
                    :is-full-page="true"
                    :active.sync="loading"/>

            </div>
            <!--end::Portlet-->

        </div>
    </div>
</template>
<script>
    import Meta from './Meta.vue'
    import FileManager from '^/Core/Resources/assets/components/FileManager.vue'
    import Loading from 'vue-loading-overlay'

    export default {
        mixins: [FileManager],
        name: 'Global',
        components: {
            Meta,
            Loading
        },
        data(){
            return{
                updated: {
                    status: false,
                    code: 0,
                    message: ''
                },
                loading: false,
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
            submit(e){
                const formData = new FormData(e.target);
                formData.append('_method', 'PUT');

                const self = this;

                self.loading = true;
                axios({
                    method: "post",
                    url: "/control/setting",
                    data: formData,
                   // headers: { "Content-Type": "multipart/form-data" },
                })
                .then(function (response) {
                    //handle success
                    self.updated = response.data;
                    window.scrollTo(0, 0);
                    self.loading = false;

                    setTimeout(() => {
                    self.$set(self.updated, 'status', false);
                    }, 2000);
                })
                .catch(function (response) {
                    //handle error
                    console.log(response);
                });
            }
        },
    }
</script>
<style>
</style>
<style lang="scss" scoped>
    @import 'vue-loading-overlay/dist/vue-loading.css';
</style>