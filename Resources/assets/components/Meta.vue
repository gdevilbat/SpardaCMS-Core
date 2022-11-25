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
        <!-- <div class="form-group m-form__group d-md-flex">
            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                <label for="exampleInputEmail1">{{$parent.$options.name}} Meta Keyword :</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control m-input" v-bind:name="$parent.$options.name.toLowerCase()+'[meta_keyword]'" placeholder="Meta Keyword SEO" v-bind:value="$parent.$parent.settings.global.value.meta_keyword">
            </div>
        </div> -->
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
                <input type="text" class="form-control m-input" v-bind:name="$parent.$options.name.toLowerCase()+'[fb_share_title]'" placeholder="Facebook Share Title Preview" v-bind:value="$parent.$parent.settings.global.value.fb_share_title">
            </div>
        </div>
        <div class="form-group m-form__group d-md-flex">
            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                <label for="exampleInputEmail1">{{$parent.$options.name}} Facebook Share Description :</label>
            </div>
            <div class="col-md-8">
                <textarea type="text" class="form-control m-input autosize" v-bind:name="$parent.$options.name.toLowerCase()+'[fb_share_description]'" placeholder="Facebook Share Description" v-bind:value="$parent.$parent.settings.global.value.fb_share_description"></textarea>
            </div>
        </div>
        <div class="form-group m-form__group d-md-flex flex-wrap">
            <div class="col-md-4 d-md-flex justify-content-end align-items-center py-3">
                <label for="">{{$parent.$options.name}} Facebook Share Image :</label>
            </div>
            <div class="col-md-8">
                    <div class="input-group m-input-group">
                        <div class="input-group-prepend">
                            <button data-input="global-fb-share-image" class="btn btn-primary" v-on:click="lfmInput($event)">
                            <i class="fa fa-picture-o"></i> Choose
                            </button>
                        </div>
                        <input id="global-fb-share-image" class="form-control m-input" type="text" v-bind:name="$parent.$options.name.toLowerCase()+'[fb_share_image]'" v-model="$parent.$parent.settings.global.value.fb_share_image">
                    </div>
                <img style="margin-top:15px;max-height:100px;" v-bind:src="$route.meta.STORAGE_URL+$parent.$parent.settings.global.value.fb_share_image" v-if="$parent.$parent.settings.global.value.fb_share_image != null">
            </div>
            <div class="col-md-8 offset-md-4">
                <span class="m-form__help">*Best Less Than 1MB, Best Resolution 1920px X 1080px (16:9)</span>
            </div>
        </div>
    </div>
</template>
<script>
    import $ from "jquery"
    import FileManager from '^/Core/Resources/assets/components/FileManager.vue' 

    import autosize from '^/Core/assets/js/autosize.min.js'

    export default {
        mixins: [FileManager],
        data(){
            return{
            }
        },
        methods: {
            addTag() {
                if (!this.newTag) return;
                this.tags.push(this.newTag);
                this.newTag = '';
            },
            deleteTag(tag) {
                this.tags.splice(this.tags.indexOf(tag), 1);
            }
        },
        mounted(){
            this.$nextTick(() => {
                autosize($(".autosize"));
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