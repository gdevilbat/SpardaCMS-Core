<div class="form-group m-form__group d-flex">
    <div class="col-md-4 d-flex justify-content-end py-3">
        <label for="exampleInputEmail1">{{title_case(str_slug($column, ' '))}} Meta Title :</label>
    </div>
    <div class="col-md-8">
        <input type="text" class="form-control m-input" name="{{str_slug($column).'[meta_title]'}}" placeholder="Meta Title SEO" value="{{old(str_slug($column).'.meta_title') ? old(str_slug($column).'.meta_title') : (!empty($settings->where('name',str_slug($column))->flatten()->first()->value['meta_title']) ? $settings->where('name',str_slug($column))->flatten()->first()->value['meta_title'] : '')}}">
    </div>
</div>
<div class="form-group m-form__group d-flex">
    <div class="col-md-4 d-flex justify-content-end py-3">
        <label for="exampleInputEmail1">{{title_case(str_slug($column, ' '))}} Meta Keyword :</label>
    </div>
    <div class="col-md-8">
        <input type="text" class="form-control m-input" name="{{str_slug($column).'[meta_keyword]'}}" placeholder="Meta Keyword SEO" value="{{old(str_slug($column).'.meta_keyword') ? old(str_slug($column).'.meta_keyword') : (!empty($settings->where('name',str_slug($column))->flatten()->first()->value['meta_keyword']) ? $settings->where('name',str_slug($column))->flatten()->first()->value['meta_keyword'] : '')}}" data-role="tagsinput" >
    </div>
</div>
<div class="form-group m-form__group d-flex">
    <div class="col-md-4 d-flex justify-content-end py-3">
        <label for="exampleInputEmail1">{{title_case(str_slug($column, ' '))}} Meta Description :</label>
    </div>
    <div class="col-md-8">
        <textarea type="text" class="form-control m-input autosize" name="{{str_slug($column).'[meta_description]'}}" placeholder="Meta Description SEO">{{old(str_slug($column).'.meta_description') ? old(str_slug($column).'.meta_description') : (!empty($settings->where('name',str_slug($column))->flatten()->first()->value['meta_description']) ? $settings->where('name',str_slug($column))->flatten()->first()->value['meta_description'] : '')}}</textarea>
    </div>
</div>
<div class="form-group m-form__group d-flex">
    <div class="col-md-4 d-flex justify-content-end py-3">
        <label for="exampleInputEmail1">{{title_case(str_slug($column, ' '))}} FB Share Title</label>
    </div>
    <div class="col-md-8">
        <textarea type="text" class="form-control m-input autosize" name="{{str_slug($column).'[fb_share_title]'}}" placeholder="Facebook Share Title Preview">{{old(str_slug($column).'.fb_share_title') ? old(str_slug($column).'.fb_share_title') : (!empty($settings->where('name',str_slug($column))->flatten()->first()->value['fb_share_title']) ? $settings->where('name',str_slug($column))->flatten()->first()->value['fb_share_title'] : '')}}</textarea>
    </div>
</div>
<div class="form-group m-form__group d-flex flex-wrap">
    <div class="col-md-4 d-flex justify-content-end py-3">
        {{title_case(str_slug($column, ' '))}} FB Share Image
    </div>
    <div class="col-md-8">
       <div class="input-group m-input-group">
          <div class="input-group-prepend">
            <button data-input="{{str_slug($column)}}-fb_share_image" data-preview="{{str_slug($column)}}-fb_share_preview" class="btn btn-primary filemanager-image">
              <i class="fa fa-picture-o"></i> Choose
            </button>
          </div>
           @if(empty($settings->where('name',str_slug($column))->flatten()->first()->value['fb_share_image']))
              <input id="{{str_slug($column)}}-fb_share_image" class="form-control m-input" type="text" name="{{str_slug($column).'[fb_share_image]'}}" value="{{old(str_slug($column).'.fb_share_image')}}">
           @else
              <input id="{{str_slug($column)}}-fb_share_image" class="form-control m-input" type="text" name="{{str_slug($column).'[fb_share_image]'}}" value="{{$settings->where('name',str_slug($column))->flatten()->first()->value['fb_share_image']}}">
           @endif
        </div>
       @if(empty($settings->where('name',str_slug($column))->flatten()->first()->value['fb_share_image']))
           <img id="{{str_slug($column)}}-fb_share_preview" style="margin-top:15px;max-height:100px;">
       @else
           <img id="{{str_slug($column)}}-fb_share_preview" style="margin-top:15px;max-height:100px;" src="{{url($settings->where('name',str_slug($column))->flatten()->first()->value['fb_share_image'])}}">
       @endif
    </div>
    <div class="col-md-8 offset-md-4">
        <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
    </div>
</div>
<div class="form-group m-form__group d-flex">
    <div class="col-md-4 d-flex justify-content-end py-3">
        <label for="exampleInputEmail1">{{title_case(str_slug($column, ' '))}} FB Share Description</label>
    </div>
    <div class="col-md-8">
        <textarea type="text" class="form-control m-input autosize" name="{{str_slug($column).'[fb_share_description]'}}" placeholder="Facebook Share Description Preview">{{old(str_slug($column).'.fb_share_description') ? old(str_slug($column).'.fb_share_description') : (!empty($settings->where('name',str_slug($column))->flatten()->first()->value['fb_share_description']) ? $settings->where('name',str_slug($column))->flatten()->first()->value['fb_share_description'] : '')}}</textarea>
    </div>
</div>