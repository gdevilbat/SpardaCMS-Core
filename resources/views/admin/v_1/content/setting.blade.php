@extends('core::admin.'.$theme_cms->value.'.templates.parent')

@section('page_level_css')
    {{Html::style(module_asset_url('core:assets/metronic-v5/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'))}}
@endsection

@section('title_dashboard', ' Setting')

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
                    <span class="m-nav__link-text">Setting</span>
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
                            Setting Form
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form class="m-form m-form--fit m-form--label-align-right" action="{{route('cms.setting.store')}}" method="post">
                <div class="m-portlet__body">
                    <div class="col-md-5 offset-md-4">
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
                    @include('core::admin.'.$theme_cms->value.'.partials.meta_tag', ['column' => 'global'])
                    <hr>
                    <div class="form-group m-form__group d-md-flex flex-wrap">
                        <div class="col-md-4 d-md-flex justify-content-end py-3">
                            {{title_case(str_slug('global', ' '))}} Background Landscape
                        </div>
                        <div class="col-md-8">
                           <div class="input-group m-input-group">
                                <div class="input-group-prepend">
                                    <button data-input="global-background-landscape" data-preview="global-background-landscape_preview" class="btn btn-primary filemanager-image">
                                       <i class="fa fa-picture-o"></i> Choose
                                     </button>
                                </div>
                                @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['background']['landscape']))
                                   <input id="global-background-landscape" class="form-control m-input" type="text" name="{{str_slug('global').'[background][landscape]'}}" value="{{old(str_slug('global').'.background.landscape')}}">
                                @else
                                   <input id="global-background-landscape" class="form-control m-input" type="text" name="{{str_slug('global').'[background][landscape]'}}" value="{{$settings->where('name',str_slug('global'))->flatten()->first()->value['background']['landscape']}}">
                                @endif
                            </div>
                            @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['background']['landscape']))
                                <img id="global-background-landscape_preview" style="margin-top:15px;max-height:100px;">
                            @else
                                <img id="global-background-landscape_preview" style="margin-top:15px;max-height:100px;" src="{{url($settings->where('name',str_slug('global'))->flatten()->first()->value['background']['landscape'])}}">
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group d-md-flex flex-wrap">
                        <label class="col-md-4 d-md-flex justify-content-end py-3">
                            {{title_case(str_slug('global', ' '))}} Background Portrait
                        </label>
                        <div class="col-md-8">
                            <div class="input-group m-input-group">
                               <div class="input-group-prepend">
                                 <button data-input="global-background-portrait" data-preview="global-background-portrait_preview" class="btn btn-primary filemanager-image">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </button>
                               </div>
                                @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['background']['portrait']))
                                   <input id="global-background-portrait" class="form-control m-input" type="text" name="{{str_slug('global').'[background][portrait]'}}" value="{{old(str_slug('global').'.background.portrait')}}">
                                @else
                                   <input id="global-background-portrait" class="form-control m-input" type="text" name="{{str_slug('global').'[background][portrait]'}}" value="{{$settings->where('name',str_slug('global'))->flatten()->first()->value['background']['portrait']}}">
                                @endif
                             </div>
                            @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['background']['portrait']))
                                <img id="global-background-portrait_preview" style="margin-top:15px;max-height:100px;">
                            @else
                                <img id="global-background-portrait_preview" style="margin-top:15px;max-height:100px;" src="{{url($settings->where('name',str_slug('global'))->flatten()->first()->value['background']['portrait'])}}">
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group d-md-flex flex-wrap">
                        <label class="col-md-4 d-md-flex justify-content-end py-3">
                            {{title_case(str_slug('global', ' '))}} Favicon Image
                        </label>
                        <div class="col-md-8">
                            <div class="input-group m-input-group">
                               <div class="input-group-prepend">
                                 <button data-input="global-favicon" data-preview="global-favicon_preview" class="btn btn-primary filemanager-image">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </button>
                               </div>
                                @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['favicon']))
                                   <input id="global-favicon" class="form-control m-input" type="text" name="{{str_slug('global').'[favicon]'}}" value="{{old(str_slug('global').'.favicon')}}">
                                @else
                                   <input id="global-favicon" class="form-control m-input" type="text" name="{{str_slug('global').'[favicon]'}}" value="{{$settings->where('name',str_slug('global'))->flatten()->first()->value['favicon']}}">
                                @endif
                             </div>
                            @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['favicon']))
                                <img id="global-favicon_preview" style="margin-top:15px;max-height:100px;">
                            @else
                                <img id="global-favicon_preview" style="margin-top:15px;max-height:100px;" src="{{url($settings->where('name',str_slug('global'))->flatten()->first()->value['favicon'])}}">
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                                <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group d-md-flex flex-wrap">
                        <label class="col-md-4 d-md-flex justify-content-end py-3">
                            {{title_case(str_slug('global', ' '))}} Logo Image
                        </label>
                        <div class="col-md-8">
                            <div class="input-group m-input-group">
                               <div class="input-group-prepend">
                                 <button data-input="global-logo" data-preview="global-logo_preview" class="btn btn-primary filemanager-image">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </button>
                               </div>
                                @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['logo']))
                                   <input id="global-logo" class="form-control m-input" type="text" name="{{str_slug('global').'[logo]'}}" value="{{old(str_slug('global').'.logo')}}">
                                @else
                                   <input id="global-logo" class="form-control m-input" type="text" name="{{str_slug('global').'[logo]'}}" value="{{$settings->where('name',str_slug('global'))->flatten()->first()->value['logo']}}">
                                @endif
                             </div>
                            @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['logo']))
                                <img id="global-logo_preview" style="margin-top:15px;max-height:100px;">
                            @else
                                <img id="global-logo_preview" style="margin-top:15px;max-height:100px;" src="{{url($settings->where('name',str_slug('global'))->flatten()->first()->value['logo'])}}">
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                                <span class="form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group d-md-flex flex-wrap">
                        <label class="col-md-4 d-md-flex justify-content-end py-3">
                            {{title_case(str_slug('global', ' '))}} Not Found Image
                        </label>
                        <div class="col-md-8">
                            <div class="input-group m-input-group">
                               <div class="input-group-prepend">
                                 <button data-input="global-not_found_image" data-preview="global-not_found_image_preview" class="btn btn-primary filemanager-image">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </button>
                               </div>
                                @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['not_found_image']))
                                   <input id="global-not_found_image" class="form-control m-input" type="text" name="{{str_slug('global').'[not_found_image]'}}" value="{{old(str_slug('global').'.not_found_image')}}">
                                @else
                                   <input id="global-not_found_image" class="form-control m-input" type="text" name="{{str_slug('global').'[not_found_image]'}}" value="{{$settings->where('name',str_slug('global'))->flatten()->first()->value['not_found_image']}}">
                                @endif
                             </div>
                            @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['not_found_image']))
                                <img id="global-not_found_image_preview" style="margin-top:15px;max-height:100px;">
                            @else
                                <img id="global-not_found_image_preview" style="margin-top:15px;max-height:100px;" src="{{url($settings->where('name',str_slug('global'))->flatten()->first()->value['not_found_image'])}}">
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                                <span class="form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group d-md-flex flex-wrap">
                        <label class="col-md-4 d-md-flex justify-content-end py-3">
                            {{title_case(str_slug('global', ' '))}} Maintenance Image
                        </label>
                        <div class="col-md-8">
                            <div class="input-group m-input-group">
                               <div class="input-group-prepend">
                                 <button data-input="global-maintenance_image" data-preview="global-maintenance_image_preview" class="btn btn-primary filemanager-image">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </button>
                               </div>
                                @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['maintenance_image']))
                                   <input id="global-maintenance_image" class="form-control m-input" type="text" name="{{str_slug('global').'[maintenance_image]'}}" value="{{old(str_slug('global').'.maintenance_image')}}">
                                @else
                                   <input id="global-maintenance_image" class="form-control m-input" type="text" name="{{str_slug('global').'[maintenance_image]'}}" value="{{$settings->where('name',str_slug('global'))->flatten()->first()->value['maintenance_image']}}">
                                @endif
                             </div>
                            @if(empty($settings->where('name',str_slug('global'))->flatten()->first()->value['maintenance_image']))
                                <img id="global-maintenance_image_preview" style="margin-top:15px;max-height:100px;">
                            @else
                                <img id="global-maintenance_image_preview" style="margin-top:15px;max-height:100px;" src="{{url($settings->where('name',str_slug('global'))->flatten()->first()->value['maintenance_image'])}}">
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                                <span class="form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group m-form__group d-md-flex">
                        <div class="col-md-4 d-md-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">{{title_case(str_slug('global', ' '))}} Google Site Verification</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control m-input" name="{{str_slug('global').'[google_site_verification]'}}" placeholder="Google Site Verification" value="{{old(str_slug('global').'.google_site_verification') ? old(str_slug('global').'.google_site_verification') : (!empty($settings->where('name',str_slug('global'))->flatten()->first()->value['google_site_verification']) ? $settings->where('name',str_slug('global'))->flatten()->first()->value['google_site_verification'] : '')}}">
                        </div>
                    </div>
                    <div class="form-group m-form__group d-md-flex">
                        <div class="col-md-4 d-md-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">{{title_case(str_slug('global', ' '))}} Meta Script</label>
                        </div>
                        <div class="col-md-8">
                            <textarea type="text" class="form-control m-input autosize" name="{{str_slug('global').'[meta_script]'}}" placeholder="Script Before Body" id="m_autosize_1">{{old(str_slug('global').'.meta_script') ? old(str_slug('global').'.meta_script') : (!empty($settings->where('name',str_slug('global'))->flatten()->first()->value['meta_script']) ? $settings->where('name',str_slug('global'))->flatten()->first()->value['meta_script'] : '')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group d-md-flex">
                        <div class="col-md-4 d-md-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">Pagination Count:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control m-input" name="pagination_count" placeholder="Pagination Count" value="{{old('pagination_count') ? old('pagination_count') : ($settings->where('name','pagination_count')->count() > 0 ? $settings->where('name','pagination_count')->flatten()->first()->value : '')}}">
                        </div>
                    </div>
                    <div class="form-group m-form__group d-md-flex">
                        <div class="col-md-4 d-md-flex justify-content-end py-3">
                            <label for="exampleInputEmail1">Theme CMS:</label>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <select class="form-control m-input" name="theme_cms">
                                @foreach($admin_directories as $admin)
                                    <option value="{{$admin}}" {{old('theme_cms') == $admin ? 'selected' : ((!empty($settings->where('name','theme_cms')->flatten()[0]->value) &&  $settings->where('name','theme_cms')->flatten()[0]->value == $admin)? 'selected' : '')}}>{{$admin}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{csrf_field()}}
                {{method_field('PUT')}}
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
    {{Html::script(module_asset_url('core:assets/metronic-v5/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'))}}
    {{Html::script(module_asset_url('core:assets/js/autosize.min.js'))}}
    {{Html::script('vendor/laravel-filemanager/js/lfm.js')}}
@endsection