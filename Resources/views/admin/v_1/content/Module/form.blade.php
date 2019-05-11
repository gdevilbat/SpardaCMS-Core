@extends('core::admin.'.$theme_cms->value.'.template')

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
            <form class="m-form m-form--fit m-form--label-align-right" action="{{action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@store')}}" method="post">
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
                            <label for="exampleInputEmail1">Module Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control m-input" name="name" placeholder="Module Name" value="{{old('name') ? old('name') : (!empty($module) ? $module->name : '')}}">
                        </div>
                    </div>
                    <div class="form-group m-form__group d-flex">
                        <div class="col-md-4 d-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">Module Slug</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control m-input" name="slug" placeholder="Module Slug" value="{{old('slug') ? old('slug') : (!empty($module) ? $module->slug : '')}}" readonly>
                        </div>
                    </div>
                    <div class="form-group m-form__group d-flex">
                        <div class="col-md-4 d-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">Module Name</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control m-input autosize" type="text" name="description" placeholder="Module Description">{{old('description') ? old('description') : (!empty($module) ? $module->description : '')}}</textarea>
                        </div>
                    </div>
                    @verbatim
                        <div id="form" v-cloak>
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
                                            <div class="col-md-2" v-if="components.length > 1">
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
                    <input type="hidden" name="id" value="{{$_GET['code']}}">
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
    <script type="text/javascript">
        form_data = {!! !empty($module)? json_encode($module->scope) : json_encode(array(array())) !!};
        FormComponent.components = form_data;
        FormComponent.$nextTick(function () {
        });
    </script>
@endsection