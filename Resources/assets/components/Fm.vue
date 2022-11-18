<template>
	<div class="row">
    <div class="col-sm-12">

        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">

            <div class="m-portlet__body">
                <div class="note note-info">
                    <div style="height: 600px;">
                        <file-manager></file-manager>
                    </div>
                </div>
            </div>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->

    </div>
  </div>
</template>
<script>
    export default {
        data(){
            return{
            }
        },
        created() {
          this.$parent.$data.breadcumb = `<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
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
                                        </ul>`;
        },
        methods: {
        },
    }
</script>
<style lang="scss" scoped>
</style>