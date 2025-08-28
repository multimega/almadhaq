@extends('layouts.load')

@section('content')

@include('includes.admin.form-error')
<form id="geniusformdata" action="{{route('admin-brand-update',$data->id)}}" method="POST" enctype="multipart/form-data" class="inp-50">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('English Name') }}</label>
            <input type="text" class="form-control" name="name" placeholder="{{ __('English Name') }}" required="" value="{{$data->name}}">
        </div>
        <div class="col-md-6">
            <label>{{ __('Arabic Name') }}</label>
            <input type="text" class="form-control" name="name_ar" placeholder="{{ __('Arabic Name') }}" required="" value="{{$data->name_ar}}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('English Slug') }}</label>
            <input type="text" class="form-control" name="slug" placeholder="{{ __('English Slug') }}" required="" value="{{$data->slug}}">
        </div>
        <div class="col-md-6">
            <label>{{ __('Arabic Slug') }}</label>
            <input type="text" class="form-control" name="slug_ar" placeholder="{{ __('Arabic Slug') }}" required="" value="{{$data->slug_ar}}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('Brand Page English Title') }}</label>
            <input type="text" class="form-control" placeholder="{{ __('Brand Page English Title') }}" value="{{ $data->title }}" name="title" >
        </div>
        <div class="col-md-6">
            <label>{{ __('Brand Page Arabic Title') }}</label>
            <input type="text" class="form-control" placeholder="{{ __('Brand Page Arabic Title') }}"  value="{{ $data->title_ar }}" name="title_ar" >
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tawk-area">
                <label>{{ __('English Meta Keywords') }}</label>
                <textarea  name="meta_keys" class="form-control" placeholder="{{ __('English Meta Keywords') }}" rows="3">{{ $data->meta_keys }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tawk-area">
                <label>{{ __('Arabic Meta Keywords') }}</label>
                <textarea  name="meta_keys_ar" class="form-control" placeholder="{{ __('Arabic Meta Keywords') }}" rows="3">{{ $data->meta_keys_ar }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="text-editor">
                <label>{{ __('English Meta Description') }}</label>
                <textarea name="meta_description" class="form-control" placeholder="{{ __('English Meta Description') }}">{{ $data->meta_description}}</textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="text-editor">
                <label>{{ __('Arabic Meta Description') }}</label>
                <textarea name="meta_description_ar" class="form-control" placeholder="{{ __('Arabic Meta Description') }}">{{ $data->meta_description_ar}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>{{ __('Current Image') }}</label>
            <div class="img-upload">
                <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/brands/'.$data->photo):asset('assets/images/noimage.png') }});">
                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                    <input type="file" name="photo" class="img-upload" id="image-upload">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-4 text-end">
            <button class="main-dark-btn py-3" type="submit">{{ __('Save') }}</button>
        </div>
    </div>
</form>

@endsection
