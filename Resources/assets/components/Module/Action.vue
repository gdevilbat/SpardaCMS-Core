<template>
    <div class="col">
        <div class="btn-group">
            <a href="javascript:void(0)" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
            </a>
            <div class="dropdown-menu dropdown-menu-left">
                <button class="dropdown-item" type="button">
                    <router-link :to="{name: 'module-form', query: {'code': data.encrypted_id}}" class="m-link m-link--state m-link--info">
                       <i class="fa fa-edit"> Edit</i>
                    </router-link>
                </button>
                <button class="dropdown-item" type="button"><a class="m-link m-link--state m-link--accent" data-toggle="modal" href="#small"><i class="fa fa-trash"> Delete</i></a></button>
            </div>
        </div>
        <div class="modal fade" id="small" tabindex="-1" role="dialog" aria-hidden="true"  aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <form v-on:submit.prevent="remove($event)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                        <h5 class="text-center">
                        Are You Sure ?
                        </h5>
                        <input type="hidden" v-bind:name="data.primary_key" v-bind:value="data.encrypted_id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary confirmed">Delete</button>
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <loading
                :is-full-page="true"
                :active.sync="loading"/>
    </div>
</template>
<script>
    import Loading from 'vue-loading-overlay'

    export default {
        components: {
            Loading,
        },
        props: {
            data: {},
            name: {},
            action: {
                type: Object,
                default(rawProps) {
                    return { 
                        view: false,
                        edit: false,
                        delete: false 
                    }
                } 
            }
        },
        data(){
            return {
                loading: false
            }
        },
        methods: {
            remove(e){
                const formData = new FormData(e.target);
                formData.append('_method', 'DELETE');

                const self = this;

                self.loading = true;
                axios({
                    method: "post",
                    url: "/control/module/form",
                    data: formData,
                })
                .then(function (response) {
                    //handle success
                    self.updated = response.data;
                    self.loading = false;

                    self.$router.go(self.$router.currentRoute);
                })
                .catch(function (error) {
                    //handle error
                    console.log(error);
                });
            }
        }
    }
</script>
<style lang="scss" scoped>
    @import 'vue-loading-overlay/dist/vue-loading.css';
</style>