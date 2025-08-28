@extends('layouts.admin') 

@section('content')
<div class="content-area">
    <div class="home-head mb-4">
        <h3>{{ __('Edit Post') }} <span>Manage your physical posts</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.marketing-kit') }}">{{ __("Marketing kit") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin-blog-index') }}">{{ __("Posts") }}</a></li>
                <li class="breadcrumb-item">{{ __("Edit Post") }}</li>
            </ol>
        </nav>
    </div>
    <div class="add-product-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area" style="background: #f2f3f8;padding: 0">
                        @include('includes.admin.form-error') 
                        <form id="geniusform" action="{{route('admin-blog-update',$data->id)}}" method="POST" class="exp-form" enctype="multipart/form-data">
                        @include('includes.admin.form-success') 
                        {{csrf_field()}}
                            <div class="default-box">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Category') }}*</label>
                                            <select  name="category_id" class="form-select" required="">
                                                <option value="">{{ __('Select Category') }}</option>
                                                @foreach($cats as $cat)
                                                    <option value="{{ $cat->id }}" {{ $data->category_id == $cat->id ? 'selected' :'' }}>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Author') }}* <small>{{ __('(In Any Language)') }}</small></label>
                                            <input type="text" class="form-control" name="author" placeholder="{{ __('Author') }}" required="" value="{{$data->author}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Title') }} * <small>{{ __('(In Any Language)') }}</small></label>
                                            <input type="text" class="form-control" name="title" placeholder="{{ __('Title') }}" required="" value="{{$data->title}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Arabic Title') }} * <small>{{ __('(Arabic)') }}</small></label>
                                            <input type="text" class="form-control" name="title_ar" placeholder="{{ __('Arabic Title') }}" required="" value="{{$data->title_ar}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Blog Alt') }}* <small>{{ __('(In Any Language)') }}</small></label>
                                            <input type="text" class="form-control" placeholder="{{ __('Enter Blog ALt') }}" name="alt" value="{{$data->alt}}" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Blog Alt') }}* <small>{{ __('(Arabic)') }}</small></label>
                                            <input type="text" class="form-control" placeholder="{{ __('Enter Blog Arabic ALt') }}" name="alt_ar" value="{{$data->alt_ar}}" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{ __('Current Featured Image') }}</label>
                                            <div class="img-upload">
                                                <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/blogs/'.$data->photo):asset('assets/images/noimage.png') }});">
                                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                                    <input type="file" name="photo" class="img-upload" id="image-upload">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Description') }}*</label>
                                            <textarea   class="ckeditor form-control" name="details" placeholder="{{ __('Description') }}">{{ $data->details }}</textarea> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Arabic Description') }}*</label>
                                            <textarea   class="ckeditor form-control" name="details_ar" placeholder="{{ __('Arabic Description') }}">{{ $data->details_ar }}</textarea> 
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{ __('Source') }}*</label>
                                            <input type="text" class="form-control" name="source" placeholder="{{ __('Source') }}" required="" value="{{$data->source}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
    								    <div>
    								        <div>
    								            <div class="checkbox-wrapper form-group">
                                                  <input type="checkbox" name="secheck" class="checkclick" id="allowProductSEO" {{ ($data->meta_tag != null || strip_tags($data->meta_description) != null) ? 'checked':'' }}>
                                                  <label for="allowProductSEO">{{ __('Allow Blog SEO') }}</label>
                                                </div>
    			                            </div>
    		                            </div>
    									<div class="{{ ($data->meta_tag == null && strip_tags($data->meta_description) == null) ? "showbox":"" }}">
    									    <div class="row">
        										<div class="col-lg-12">
        											<div class="form-group">
        												<label>{{ __('Meta Tags') }} *</label>
        												<ul id="metatags" class="myTags">
                                                            @foreach (explode(',',$data->meta_tag) as $element)
                                                              <li>{{  $element }}</li>
                                                            @endforeach
                                                        </ul>
        											</div>
        										</div>
    										</div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Meta Description') }} *</label>
                                                        <div class="text-editor">
                                                            <textarea name="meta_description" class="ckeditor form-control" placeholder="{{ __('Meta Description') }}">{{ $data->meta_description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    		                                <div class="row">
				                                <div class="col-lg-12">
				                                    <div class="form-group">
				                                        <label>{{ __('Arabic Meta Description') }} *</label>
    				                                    <div class="text-editor">
    					                                    <textarea name="meta_description_ar" class="ckeditor form-control" placeholder="{{ __('Arabic Meta Description') }}">{{ $data->meta_description_ar }}</textarea>
    					                                </div>
    				                                </div>
				                                </div>
				                            </div>
    				                    </div>
								    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{ __('Tags') }} *</label>
                                            <ul id="tags" class="myTags">
                                                @foreach (explode(',',$data->tags) as $element)
                                                  <li>{{  $element }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
    							<div class="col-lg-12 text-center">
    								<button class="main-light-btn py-3" type="submit">{{ __('Save') }} <i class="fas fa-check ms-3"></i></button>
    							</div>
    						</div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
{{-- TAGIT ENDS--}}
</script>
<!--<script>
       CKEDITOR.replace('details', {
        extraPlugins: 'colorbutton'
    });
    CKEDITOR.replace('details_ar', {
        extraPlugins: 'colorbutton'
    });

    $.widget.bridge('uibutton', $.ui.button);
        /* ClassicEditor
        .create( document.querySelector( '#test' ) );*/
    </script>-->
    
<script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
       
    });
</script>
@endsection
