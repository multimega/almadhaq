@extends('layouts.load')

@section('content')

@include('includes.admin.form-error')  
<form id="geniusformdata" action="{{route('admin-subcat-update',$data->id)}}" method="POST" enctype="multipart/form-data" class="inp-50">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            <label>{{ __("Category") }}</label>
            <select name="category_id" class="form-select" required="">
                <option value="">{{ __("Select Category") }}</option>
                @foreach($cats as $cat)
                <option value="{{ $cat->id }}" {{ $data->category_id == $cat->id ? 'selected' :'' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __("English Name") }}</label>
            <input type="text" class="form-control" name="name" placeholder="{{ __("English Name") }}" required="" value="{{$data->name}}">
        </div>
        <div class="col-md-6">
            <label>{{ __("Arabic Name") }}</label>
            <input type="text" class="form-control" name="name_ar" placeholder="{{ __("Arabic Name") }}" required="" value="{{$data->name_ar}}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="text-editor">
                <label>{{ __("English Description") }}</label>
                <textarea class="ckeditor form-control" name="details">{{$data->details}}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-editor">
                <label>{{ __("Arabic Description") }}</label>
                <textarea class="ckeditor form-control" name="details_ar">{{$data->details_ar}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __("English Title") }}</label>
            <input type="text" class="form-control" name="title" placeholder="{{ __("English Title") }}"  value="{{$data->title}}">
        </div>
        <div class="col-md-6">
            <label>{{ __("Arabic Title") }}</label>
            <input type="text" class="form-control" name="title_ar" placeholder="{{ __("Arabic Title") }}"  value="{{$data->title_ar}}">
        </div>
    </div> 
    <div class="row">
        <div class="col-md-6">
            <label>{{ __("English Slug") }}</label>
            <input type="text" class="form-control" name="slug" placeholder="{{ __("English Slug") }}" required="" value="{{$data->slug}}">
        </div>
        <div class="col-md-6">
            <label>{{ __("Arabic Slug") }}</label>
            <input type="text" class="form-control" name="slug_ar" placeholder="{{ __("Arabic Slug") }}" required="" value="{{$data->slug_ar}}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>{{ __("Meta Tags") }}</label>
            <ul id="metatags" class="myTags">
                @if(!empty($data->meta_tag))
                <li>{{  $data->meta_tag}}</li>
                @endif
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="text-editor">
                <label>{{ __("English Meta Description") }}</label>
                <textarea name="meta_description" class="ckeditor form-control" placeholder="{{ __("English Meta Description") }}">{{ $data->meta_description }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-editor">
                <label>{{ __("Arabic Meta Description") }}</label>
                <textarea name="meta_description_ar" class="ckeditor form-control" placeholder="{{ __("Arabic Meta Description") }}">{{ $data->meta_description_ar }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" >
            <label>{{ __("English Tags") }}</label>
            <ul id="tags" class="myTags">
                @if(!empty($data->tags))
                <li>{{ $data->tags}}</li>
                @endif                  
            </ul>
        </div>
        <div class="col-md-6" >
            <label>{{ __("Arabic Tags") }}</label>
            <ul id="atags" class="myTags">          
                @if(!empty($data->tags_ar)) 
                <li>{{$data->tags_ar }}</li>
                @endif 
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>{{ __("Current Image") }}</label>
            <div class="img-upload">
                <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/subcategories/'.$data->photo):asset('assets/images/noimage.png') }});">
                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                    <input type="file" name="photo" class="img-upload" id="image-upload">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-4 text-end">
            <button class="main-dark-btn py-3" type="submit">{{ __("Save") }}</button>
        </div>
    </div>
</form>

@endsection

@section('scripts')




<script type="text/javascript">

{{-- TAGIT --}}

          $("#metatags").tagit({
          fieldName: "meta_tag[]",
          allowSpaces: true 
          });

          $("#tags").tagit({
          fieldName: "tags[]",
          allowSpaces: true 
        });
       
        $("#tags_ar").tagit({
          fieldName: "tags_ar[]",
          allowSpaces: true 
        });

{{-- TAGIT ENDS--}}
</script>

<script src="{{asset('assets/admin/js/product.js')}}"></script>
<script src="{{asset('assets/admin/js/jscolor.js')}}"></script>




 <script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
       
    });
</script>


@endsection