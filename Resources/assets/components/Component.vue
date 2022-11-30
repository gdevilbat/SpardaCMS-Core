<template>
     <div>
        <div class="form-group m-form__group d-md-flex">
            <div class="col-md-4 d-md-flex justify-content-end py-3">
                <label for="exampleInputEmail1">{{title}} :</label>
            </div>
            <div class="col-md-8">
                <div v-for="(item, index) in (components)" :key="index">
                    <div class="d-md-flex my-1">
                        <div class="col-md-10 no-padding">
                            <input type="text" class="form-control" :name="name+'[]'" placeholder="Scope Name" v-model="components[index]">
                        </div>
                        <div class="col-md-2 text-right">
                            <button type="button" class="btn m-btn--pill btn-metal" @click="removeComponent(index)"><span><i class="fa fa-minus"></i></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group m-form__group d-md-flex">
            <div class="col-md-6 offset-md-4">
                <button type="button" class="btn btn-success" @click="addComponent">Tambah Scope</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            title: '',
            name: '',
            components: {
                type: Array,
                default(rawProps) {
                    return []
                }
            },
        },
        data(){
            return {
            }
        },
        methods: {
            addComponent: function(){
                const length =  this.components.length;
                this.components.push([]);
            },
            removeComponent: function(index){
                this.components.splice(index, 1);
            },
        },
    }
</script>
<style lang="scss" scoped>
</style>