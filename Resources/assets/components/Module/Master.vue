<template>
	<div class="row">
        <div class="col-sm-12">

            <div class="m-portlet m-portlet--tab">
                <!--begin::Portlet-->
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="fa fa-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Master Data of Module
                                </h3>
                            </div>
                        </div>
                    </div>
                <!--end::Portlet-->

                <div class="m-portlet__body">
                    <div class="row mb-4">
                        <div class="col-md-5">
                            <router-link :to="{name: 'module-form'}" class="btn btn-brand m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Add New Module</span>
                                </span>
                            </router-link>
                        </div>
                    </div>
                    <data-table
                        :data="data"
                        :columns="columns"
                        @on-table-props-changed="reloadTable"
                        :debounce-delay="5000">
                    </data-table>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                url: '/control/module/data',
                data: {},
                tableProps: {
                    search: '',
                    length: 10,
                    column: 'id_module',
                    dir: 'asc'
                },
                columns: [
                    {
                        label: 'ID',
                        name: 'id_module',
                        orderable: true,
                    },
                    {
                        label: 'Name',
                        name: 'name',
                        orderable: true,
                    },
                    {
                        label: 'Scanable',
                        name: 'string_is_scanable',
                        orderable: false,
                    },
                ]
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
                                            <li class="m-nav__separator">-</li>
                                            <li class="m-nav__item">
                                                <a href="" class="m-nav__link">
                                                    <span class="m-nav__link-text">Module</span>
                                                </a>
                                            </li>
                                        </ul>`;

            this.getData(this.url);
        },
        methods: {
            getData(url = this.url, options = this.tableProps) {
                let self = this;
                axios({
                    method: "post",
                    url: url,
                    params: options
                })
                .then(response => {
                    self.data = response.data;
                })
                // eslint-disable-next-line
                .catch(errors => {
                    //Handle Errors
                })
            },
            reloadTable(tableProps) {
                this.getData(this.url, tableProps);
            }
        }
    }
</script>
<style lang="scss" scoped>
</style>