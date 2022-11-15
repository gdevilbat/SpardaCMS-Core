<div class="form-group m-form__group d-md-flex">
    <div class="col-md-4 d-md-flex justify-content-end py-3">
        <label for="exampleInputEmail1">{{\Str::title(\Str::slug($column, ' '))}} Meta Title :</label>
    </div>
    <div class="col-md-8">
        <input type="text" class="form-control m-input" name="{{\Str::slug($column).'[meta_title]'}}" placeholder="Meta Title SEO" value="{{old(\Str::slug($column).'.meta_title') ? old(\Str::slug($column).'.meta_title') : (!empty($settings->where('name',\Str::slug($column))->flatten()->first()->value['meta_title']) ? $settings->where('name',\Str::slug($column))->flatten()->first()->value['meta_title'] : '')}}">
    </div>
</div>
<div class="form-group m-form__group d-md-flex">
    <div class="col-md-4 d-md-flex justify-content-end py-3">
        <label for="exampleInputEmail1">{{\Str::title(\Str::slug($column, ' '))}} Meta Keyword :</label>
    </div>
    <div class="col-md-8">
        <input type="text" class="form-control m-input" name="{{\Str::slug($column).'[meta_keyword]'}}" placeholder="Meta Keyword SEO" value="{{old(\Str::slug($column).'.meta_keyword') ? old(\Str::slug($column).'.meta_keyword') : (!empty($settings->where('name',\Str::slug($column))->flatten()->first()->value['meta_keyword']) ? $settings->where('name',\Str::slug($column))->flatten()->first()->value['meta_keyword'] : '')}}" data-role="tagsinput" >
    </div>
</div>
<div class="form-group m-form__group d-md-flex">
    <div class="col-md-4 d-md-flex justify-content-end py-3">
        <label for="exampleInputEmail1">{{\Str::title(\Str::slug($column, ' '))}} Meta Description :</label>
    </div>
    <div class="col-md-8">
        <textarea type="text" class="form-control m-input autosize" name="{{\Str::slug($column).'[meta_description]'}}" placeholder="Meta Description SEO">{{old(\Str::slug($column).'.meta_description') ? old(\Str::slug($column).'.meta_description') : (!empty($settings->where('name',\Str::slug($column))->flatten()->first()->value['meta_description']) ? $settings->where('name',\Str::slug($column))->flatten()->first()->value['meta_description'] : '')}}</textarea>
    </div>
</div>
<div class="form-group m-form__group d-md-flex">
    <div class="col-md-4 d-md-flex justify-content-end py-3">
        <label for="exampleInputEmail1">{{\Str::title(\Str::slug($column, ' '))}} FB Share Title</label>
    </div>
    <div class="col-md-8">
        <textarea type="text" class="form-control m-input autosize" name="{{\Str::slug($column).'[fb_share_title]'}}" placeholder="Facebook Share Title Preview">{{old(\Str::slug($column).'.fb_share_title') ? old(\Str::slug($column).'.fb_share_title') : (!empty($settings->where('name',\Str::slug($column))->flatten()->first()->value['fb_share_title']) ? $settings->where('name',\Str::slug($column))->flatten()->first()->value['fb_share_title'] : '')}}</textarea>
    </div>
</div>
<div class="form-group m-form__group d-md-flex flex-wrap">
    <div class="col-md-4 d-md-flex justify-content-end py-3">
        {{\Str::title(\Str::slug($column, ' '))}} FB Share Image
    </div>
    <div class="col-md-8">
       <div class="input-group m-input-group">
          <div class="input-group-prepend">
            <button data-input="{{\Str::slug($column)}}-fb_share_image" data-preview="{{\Str::slug($column)}}-fb_share_preview" class="btn btn-primary lfm-input">
              <i class="fa fa-picture-o"></i> Choose
            </button>
          </div>
           @if(empty($settings->where('name',\Str::slug($column))->flatten()->first()->value['fb_share_image']))
              <input id="{{\Str::slug($column)}}-fb_share_image" class="form-control m-input" type="text" name="{{\Str::slug($column).'[fb_share_image]'}}" value="{{old(\Str::slug($column).'.fb_share_image')}}">
           @else
              <input id="{{\Str::slug($column)}}-fb_share_image" class="form-control m-input" type="text" name="{{\Str::slug($column).'[fb_share_image]'}}" value="{{$settings->where('name',\Str::slug($column))->flatten()->first()->value['fb_share_image']}}">
           @endif
        </div>
       @if(empty($settings->where('name',\Str::slug($column))->flatten()->first()->value['fb_share_image']))
           <img id="{{\Str::slug($column)}}-fb_share_preview" style="margin-top:15px;max-height:100px;">
       @else
           <img id="{{\Str::slug($column)}}-fb_share_preview" style="margin-top:15px;max-height:100px;" src="{{generate_storage_url($settings->where('name',\Str::slug($column))->flatten()->first()->value['fb_share_image'])}}">
       @endif
    </div>
    <div class="col-md-8 offset-md-4">
        <span class="m-form__help">*Max Size 1MB, Best Resolution 1920px X 1080px (16:9)</span>
    </div>
</div>
<div class="form-group m-form__group d-md-flex">
    <div class="col-md-4 d-md-flex justify-content-end py-3">
        <label for="exampleInputEmail1">{{\Str::title(\Str::slug($column, ' '))}} FB Share Description</label>
    </div>
    <div class="col-md-8">
        <textarea type="text" class="form-control m-input autosize" name="{{\Str::slug($column).'[fb_share_description]'}}" placeholder="Facebook Share Description Preview">{{old(\Str::slug($column).'.fb_share_description') ? old(\Str::slug($column).'.fb_share_description') : (!empty($settings->where('name',\Str::slug($column))->flatten()->first()->value['fb_share_description']) ? $settings->where('name',\Str::slug($column))->flatten()->first()->value['fb_share_description'] : '')}}</textarea>
    </div>
</div>