@extends('layouts.load')

@section('content')
@include('includes.admin.form-error')  
<form id="geniusformdata" action="{{route('admin-brand-create')}}" method="POST" enctype="multipart/form-data" class="inp-50">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-6">
             <label>{{ __('English Name') }}</label>
            <input type="text" class="form-control" name="name" placeholder="{{ __('English Name') }}" required="" value="">
        </div>
        <div class="col-md-6">
             <label>{{ __('Arabic Name') }}</label>
            <input type="text" class="form-control" name="name_ar" placeholder="{{ __('Arabic Name') }}" required="" value="">
        </div>
    </div>  
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('English Slug') }}</label>
            <input type="text" class="form-control" name="slug" placeholder="{{ __('English Slug') }}" required="" value="">
        </div>
        <div class="col-md-6">
            <label>{{ __('Arabic Slug') }}</label>
            <input type="text" class="form-control" name="slug_ar" placeholder="{{ __('Arabic Slug') }}" required="" value="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('Brand Page English Title') }}</label>
            <input type="text" class="form-control" placeholder="{{ __('Brand Page English Title') }}"  name="title" >
        </div>
        <div class="col-md-6">
            <label>{{ __('Brand Page Arabic Title') }}</label>
            <input type="text" class="form-control" placeholder="{{ __('Brand Page Arabic Title') }}"   name="title_ar" >
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="tawk-area">
                <label>{{ __('English Meta Keywords') }}</label>
                <textarea  name="meta_keys" class="form-control" placeholder="{{ __('English Meta Keywords') }}" rows="3"></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="tawk-area">
                <label>{{ __('Arabic Meta Keywords') }}</label>
                <textarea  name="meta_keys_ar" class="form-control" placeholder="{{ __('Arabic Meta Keywords') }}" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-editor">
                <label>{{ __('English Meta Description') }}</label>
                <textarea name="meta_description" class="form-control" placeholder="{{ __('English Meta Description') }}" rows="3"></textarea>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="text-editor">
                <label>{{ __('Arabic Meta Description') }}</label>
                <textarea name="meta_description_ar" class="form-control" placeholder="{{ __('Arabic Meta Description') }}" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="img-upload">
                <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/admin/images/upload.png') }});">
                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                    <input type="file" name="photo" class="img-upload" id="image-upload">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-4 text-end">
            <button class="main-dark-btn py-3" type="submit">{{ __('Create Brand') }}</button>
        </div>
    </div>
</form>

@endsection