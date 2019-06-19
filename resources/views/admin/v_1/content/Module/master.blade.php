@extends('core::admin.'.$theme_cms->value.'.templates.parent')

@section('page_level_css')
    {{Html::style(module_asset_url('core:assets/metronic-v5/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'))}}
@endsection

@section('title_dashboard', ' Module')

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
                            Master Data of Module
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-md-5">
                    @if (!empty(session('global_message')))
                        <div class="alert {{session('global_message')['status'] == 200 ? 'alert-info' : 'alert-warning' }} alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
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

                <div class="row mb-4">
                    <div class="col-md-5">
                        <a href="{{action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@create')}}" class="btn btn-brand m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                            <span>
                                <i class="la la-plus"></i>
                                <span>Add New Module</span>
                            </span>
                        </a>
                    </div>
                </div>

                <!--begin: Datatable -->
                <table class="table table-striped data-table" id="html_table" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Order</th>
                            <th>Scanable</th>
                            <th>Scope</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modules as $module)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$module->name}}</td>
                                <td>{{$module->slug}}</td>
                                <td>{{$module->module_type}}</td>
                                <td>{{$module->description}}</td>
                                <td>{{$module->order}}</td>
                                <td>{{$module->string_is_scanable}}</td>
                                <td>
                                    @foreach($module->scope as $scope)
                                        {{$scope}},
                                    @endforeach
                                </td>
                                <td>
                                    <div class="col">
                                        <div class="btn-group">
                                            <a href="javascript:void(0)" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <button class="dropdown-item" type="button">
                                                    <a class="m-link m-link--state m-link--info" href="{{action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@create').'?code='.encrypt($module->id)}}"><i class="fa fa-edit"> Edit</i></a>
                                                </button>
                                                <form action="{{action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@destroy')}}" method="post" accept-charset="utf-8">
                                                    {{method_field('DELETE')}}
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" value="{{encrypt($module->id)}}">
                                                </form>
                                                <button class="dropdown-item confirm-delete" type="button"><a class="m-link m-link--state m-link--accent" data-toggle="modal" href="#small"><i class="fa fa-trash"> Delete</i></a></button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>


        </div>

        <!--end::Portlet-->

    </div>
</div>
{{-- End of Row --}}

@endsection

@section('page_level_js')
    {{Html::script(module_asset_url('core:assets/metronic-v5/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'))}}
    {{Html::script(module_asset_url('core:assets/js/autosize.min.js'))}}
    {{Html::script('vendor/laravel-filemanager/js/lfm.js')}}
@endsection