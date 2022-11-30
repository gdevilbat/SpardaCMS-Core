<template>
	<div>
        <data-table
            :data="data"
            :order-by="id"
            :columns="columns"
            @on-table-props-changed="reloadTable">
        </data-table>
        <loading
            :is-full-page="true"
            :active.sync="loading"/>
    </div>
</template>
<script>
    import _ from 'lodash'
    import Loading from 'vue-loading-overlay';
    
    export default {
        components: {
            Loading
        },
        props: {
            url: String,
            id: String,
            tableProps: Object,
            columns: Array
        },
        data(){
            return{
                loading: false,
                data: {},
            }
        },
        created() {
            this.loading = true
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
                    self.loading = false;
                })
                // eslint-disable-next-line
                .catch(errors => {
                    //Handle Errors
                })
            },
            reloadTable(tableProps) {
                const self = this;
                let debounce = _.debounce(function (e) {
                    self.getData(self.url, tableProps);
                }, 500)

                if(!self.loading){
                    self.loading = true
                    debounce();
                }
            },
        }
    }
</script>
<style >
</style>
<style lang="scss">
    @import 'vue-loading-overlay/dist/vue-loading.css';
    
    .pagination{
        -webkit-box-pack: end !important;
        -ms-flex-pack: end !important;
        justify-content: flex-end !important;
    }
</style>