@extends('core::admin.'.$theme_cms->value.'.templates.parent')

@section('title_dashboard', 'Module')

@section('breadcrumb')
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
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
        </ul>
@endsection

@section('content')

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
                            Module Form
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form class="m-form m-form--fit m-form--label-align-right" action="{{route('cms.module.store')}}" method="post">
                <div class="m-portlet__body">
                    <div class="col-md-5 offset-md-4">
                        @if (!empty(session('global_message')))
                            <div class="alert {{session('global_message')['status'] == 200 ? 'alert-info' : 'alert-warning' }}">
                                {{session('global_message')['message']}}
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="form-group m-form__group d-flex">
                        <div class="col-md-4 d-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">Module Name<span class="ml-1 m--font-danger" aria-required="true">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control m-input slugify" data-target="slug" name="name" placeholder="Module Name" value="{{old('name') ? old('name') : (!empty($module) ? $module->name : '')}}">
                        </div>
                    </div>
                    <div class="form-group m-form__group d-flex">
                        <div class="col-md-4 d-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">Module Slug<span class="ml-1 m--font-danger" aria-required="true">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control m-input" name="slug" id="slug" placeholder="Module Slug" value="{{old('slug') ? old('slug') : (!empty($module) ? $module->slug : '')}}">
                        </div>
                    </div>
                    <div class="form-group m-form__group d-flex">
                        <div class="col-md-4 d-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">Module Order<span class="ml-1 m--font-danger" aria-required="true">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control m-input" min="1" name="order" placeholder="Module order" value="{{old('order') ? old('order') : (!empty($module) ? $module->order : '')}}">
                        </div>
                    </div>
                    <div class="form-group m-form__group d-flex">
                        <div class="col-md-4 d-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">Module Scanable<span class="ml-1 m--font-danger" aria-required="true">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <div class="m-radio-list">
                                <label class="m-radio">
                                    <input type="radio" name="is_scanable" value="1" {{old('is_scanable') !== null && old('is_scanable') == '1' ? 'checked' : (!empty($module) && $module->is_scanable == 1 ? 'checked' : '')}}> Yes
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="is_scanable" value="0" {{old('is_scanable') !== null && old('is_scanable') == '0' ? 'checked' : (!empty($module) && $module->is_scanable == 0 ? 'checked' : '')}}> No
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group d-flex">
                        <div class="col-md-4 d-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">Module Description</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control m-input autosize" type="text" name="description" placeholder="Module Description">{{old('description') ? old('description') : (!empty($module) ? $module->description : '')}}</textarea>
                        </div>
                    </div>
                    @verbatim
                        <div id="scope" v-cloak>
                            <div class="form-group m-form__group d-flex">
                                <div class="col-md-4 d-flex justify-content-end py-3">
                                    <label for="exampleInputEmail1">Scope</label>
                                </div>
                                <div class="col-md-8">
                                    <div v-for="(item, index) in (components)">
                                        <div class="d-flex my-1">
                                            <div class="col-md-10 no-padding">
                                                <input type="text" class="form-control" v-bind:name="'scope[]'" placeholder="Scope Name" v-model="components[index]">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn m-btn--pill btn-metal" v-on:click="removeComponent(index)"><span><i class="fa fa-minus"></i></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group d-flex">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-success" v-on:click="addComponent">Tambah Scope</button>
                                </div>
                            </div>
                        </div>
                    @endverbatim
                </div>
                {{csrf_field()}}
                @if(isset($_GET['code']))
                    <input type="hidden" name="{{\Gdevilbat\SpardaCMS\Modules\Core\Entities\Module::getPrimaryKey()}}" value="{{$_GET['code']}}">
                @endif
                {{$method}}
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
{{-- End of Row --}}

@endsection

@section('page_level_js')
    {{Html::script(module_asset_url('core:assets/js/autosize.min.js'))}}
    {{Html::script(module_asset_url('core:assets/js/slugify.js'))}}
@endsection

@section('page_script_js')
    <script type="text/javascript">
        var Scope = new Vue({
            mixins: [componentMixin],
            el: "#scope",
            data: {
                components: {!! !empty($module) && !empty($module->scope)? json_encode($module->scope) : json_encode(array(array())) !!},
            },
        });
    </script>
@endsection