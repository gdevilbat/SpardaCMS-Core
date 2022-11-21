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
                <form action="" method="post" accept-charset="utf-8">
                    <input type="hidden" name="" value="">
                </form>
                <button class="dropdown-item confirm-delete" type="button"><a class="m-link m-link--state m-link--accent" data-toggle="modal" href="#small"><i class="fa fa-trash"> Delete</i></a></button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
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
        }
    }
</script>
<style lang="scss" scoped>
</style>