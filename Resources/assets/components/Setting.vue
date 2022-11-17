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
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <Meta/>
                        <hr/>
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

    export default {
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
        },
    }
</script>
<style lang="scss" scoped>
</style>