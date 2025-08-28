@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
  <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
   @if($gs->light_dark == 0) 
<link href="{{asset('assets/admin/css/bootstrap-tagsinput.css')}}" rel="stylesheet"/>

@else
<link href="{{asset('assets/admin/css/light/bootstrap-tagsinput.css')}}" rel="stylesheet"/>
@endif
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  
}

/* Style tab links */
.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 50%;
}

.tablink:hover {
  background-color: #777;
  color: white;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  
  display: none;
  padding: 100px 20px;
  height: 100%;
}

/*DSADSADASD*/



button:focus,
input:focus,
textarea:focus,
select:focus {
  outline: none; }

.tabs {
  display: block;
  display: -webkit-flex;
  display: -moz-flex;
  display: flex;
  -webkit-flex-wrap: wrap;
  -moz-flex-wrap: wrap;
  flex-wrap: wrap;
  margin: 0;
  overflow: hidden; }
  .tabs .label [class^="tab"] label ,
  .tabs .label [class*=" tab"] label  {
   
    cursor: pointer;
    display: block;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1em;
    padding: 2rem 0;
    text-align: center; }
  .tabs [class^="tab"] [type="radio"],
  .tabs [class*=" tab"] [type="radio"] {
    border-bottom: 1px solid rgba(239, 237, 239, 0.5);
    cursor: pointer;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: block;
    width: 100%;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out; }
    .tabs [class^="tab"] [type="radio"]:hover, .tabs [class^="tab"] [type="radio"]:focus,
    .tabs [class*=" tab"] [type="radio"]:hover,
    .tabs [class*=" tab"] [type="radio"]:focus {
      border-bottom: 1px solid #1F224F; }
    .tabs [class^="tab"] [type="radio"]:checked,
    .tabs [class*=" tab"] [type="radio"]:checked {
      border-bottom: 2px solid #1F224F; }
    .tabs [class^="tab"] [type="radio"]:checked + div,
    .tabs [class*=" tab"] [type="radio"]:checked + div {
      opacity: 1; }
    .tabs [class^="tab"] [type="radio"] + div,
    .tabs [class*=" tab"] [type="radio"] + div {
      display: block;
      opacity: 0;
      padding: 2rem 0;
      width: 90%;
      -webkit-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out; }
  .tabs .tab-2 {
    width: 50%; }
    .tabs .tab-2 [type="radio"] + div {
      width: 200%;
      margin-left: 200%; }
    .tabs .tab-2 [type="radio"]:checked + div {
      margin-left: 0; }
    .tabs .tab-2:last-child [type="radio"] + div {
      margin-left: 100%; }
    .tabs .tab-2:last-child [type="radio"]:checked + div {
      margin-left: -100%; }
</style>

@endsection
@section('content')
@php
$sign = App\Models\Currency::where('is_default',1)->first();
@endphp
<div class="content-area">
    <div class="home-head mb-4">
        <h3>{{ __('Physical Product') }} <span>{{ __('Manage your physical products') }}</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/products') }}">{{ __("Products") }}</a></li>
                <li class="breadcrumb-item">{{ __("Edit Product") }}</li>
            </ol>
        </nav>
    </div>
	<div class="add-product-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
				    <div class="body-area" style="background: #f2f3f8;padding: 0">
                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        <form id="geniusform" action="{{route('admin-prod-update',$data->id)}}" method="POST" class="exp-form" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @include('includes.admin.form-both')
                            <!-- Start Box -->
                            <div class="default-box">
                                <div class="row mb-0">
                                    <!-- Start Arabic & English inputs-->
                                    <div class="col-lg-6">
                                        <div class="d-flex bg-white prod-lang-tab mb-3">
                                            <ul class="list-unstyled lang-ul">
                                                <li class="text-center active" data-lang='ar'>
                                                    <img src="{{asset('assets/admin/images/eg.gif')}}" width="32" class="d-block">
                                                    ع
                                                </li>
                                                <li class="text-center" data-lang='en'>
                                                    <img src="{{asset('assets/admin/images/gb.gif')}}" width="32" class="d-block">
                                                    EN
                                                </li>
                                            </ul>
                                            <div class="toggle-lang-tab active" id="lang-ar">
                                                <div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product Name ar') }}* </label>
        													<input type="text" class="form-control" placeholder="{{ __('Enter Product Arabic Name') }}" name="name_ar" required="" value="{{ $data->name_ar }}">
        												</div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product ALt') }}* </label>
    													    <input type="text" class="form-control" placeholder="{{ __('Enter Product Arabic ALt') }}" name="alt_ar" required="" value="{{ $data->alt_ar }}">
    												    </div>
    												</div>
    											</div>
                                                <div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product Arabic Description') }}*</label>
        													<div class="text-editor">
        														<textarea class="ckeditor form-control" name="details_ar">{{$data->details_ar}}</textarea>
        													</div>
    													</div>
    												</div>
    											</div>
                                                <div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Arabic Product Buy/Return Policy') }}*</label>
    														<div class="text-editor">
    														    <textarea class="ckeditor form-control" name="policy_ar">{{$data->policy_ar}}</textarea>
    													    </div>
    												    </div>
    												</div>
    											</div>
    										</div>
                                            <div class="toggle-lang-tab" id="lang-en">
                                                <div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product Name') }}* </label>
    														<input type="text" class="form-control" placeholder="{{ __('Enter Product Name') }}" name="name" required="" value="{{ $data->name }}">
    													</div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product ALt') }}* </label>
    														<input type="text" class="form-control" placeholder="{{ __('Enter Product ALt') }}" name="alt" required="" value="{{ $data->alt }}">
    													</div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product Description') }}*</label>
        													<div class="text-editor">
        														<textarea class="ckeditor form-control" name="details">{{$data->details}}</textarea>
        													</div>
    													</div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product Buy/Return Policy') }}*</label>
        													<div class="text-editor">
        														<textarea class="ckeditor form-control" name="policy">{{$data->policy}}</textarea>
        													</div>
    													</div>
    												</div>
    											</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Arabic & English inputs-->
                                    <div class="col-lg-6">
                                        <div class="row">
    					                        <div class="col-lg-12">
                                                    <div class="form-group">
            			                                <label>{{ __('Feature  Image') }} *</label>
            			                                <div class="panel panel-body">
                                                    		<img class="span4 mobile text-center" src="{{asset('assets/images/products/'.$data->photo)}}" id="landscapes2" style="overflow: hidden; width: 100%; height: 400px; border: 1px dashed black;">
                                                        </div>
                                                        <input class="d-inline-block mybtn1 sm-btn mybtn1 mt-1 mb-2" type="file" onchange="document.getElementById('landscapes2').src = window.URL.createObjectURL(this.files[0])" id="hover_photo"  accept="image/*"  name="photo" value="{{ $data->photo }}">
            			                            </div>
            			                        </div>
        			                        </div>      
                                 {{--        <div class="form-group">
                                            <label>{{ __('Feature Image') }} * <small>{{ __('image size') }} 205px X 205px</small></label>
                                            <div class="panel panel-body">
                                        		<div class="span4 cropme d-flex align-items-center justify-content-center" id="landscape" style="overflow: hidden; width: 100%; height: 400px; border: 1px dashed black;">
                                        		    <div class="text-center">
                                        		        <i class="far fa-images"></i>
                                        		        <p>Upload Image</p>
                                        		    </div>
                                        		</div>
                                       <!-- 		<a href="javascript:;" id="crop-image" class="d-inline-block mybtn1 mt-1 mb-2">-->
                                    			<!--	<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}-->
                                    			<!--</a>-->
                                    		</div>
                                        </div>
    
    			                        <input type="file" id="feature_photo" name="photo" value="{{ $data->photo }}" accept="image/*">
    			                        <!--image-->--}}
                                        @if($gs->templatee_select == 2    ||  $gs->templatee_select == 1111)
                                            <div class="row">
    					                        <div class="col-lg-12">
                                                    <div class="form-group">
            			                                <label>{{ __('Feature Hover Image') }} *</label>
            			                                <div class="panel panel-body">
                                                    		<img class="span4 mobile text-center" src="{{asset('assets/images/products/'.$data->hover_photo)}}" id="landscapes2" style="overflow: hidden; width: 100%; height: 400px; border: 1px dashed black;">
                                                        </div>
                                                        <input class="d-inline-block mybtn1 sm-btn mybtn1 mt-1 mb-2" type="file" onchange="document.getElementById('landscapes2').src = window.URL.createObjectURL(this.files[0])" id="hover_photo" name="hover_photo" value="{{ $data->hover_photo }}">
                                                        <span class='span-img-size'>{{ __('image size') }} 205px X 205px</span>
            			                            </div>
            			                        </div>
        			                        </div>      
        					             @endif
        					            <input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
        							    <div class="row">
    				                        <div class="col-lg-12">
                                                <div class="form-group">
        											<label>{{ __('Product Gallery Images') }} * <small>{{ __('You can upload multiple Images.') }} - {{ __('image size') }} 205px X 205px</small></label>
        										    <a href="javascript" class="set-gallery-prod set-gallery-web"  data-bs-toggle="modal" data-bs-target="#setgallery">
                    									<input type="hidden" value="{{$data->id}}">
                    									<i class="fas fa-cloud-upload-alt me-2"></i> {{ __('Set Gallery') }}
                    								</a>
        										</div>
        									</div>
        								</div>
        								
        								<input type="file" name="gallerymobile[]" class="hidden" id="uploadgallerymobile" accept="image/*" multiple>
        								<div class="row">
    				                        <div class="col-lg-12">
                                                <div class="form-group">
    												<label>{{ __('Product Mobile Gallery Images') }} * <small>{{ __('You can upload multiple Images.') }} - {{ __('image size') }} 205px X 205px</small></label>
            										<a href="javascript" class="set-gallery-prod set-gallery-mobile"  data-bs-toggle="modal" data-bs-target="#setgallerymobile">
            										    <input type="hidden" id="id_mobile" value="{{$data->id}}">
            											<i class="fas fa-cloud-upload-alt me-2"></i> {{ __('Set Mobile Gallery') }}
            										</a>
        										</div>
        									</div>
        								</div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Box -->
                            <!-- Start 2 Boxes -->     
                            <div class="row">
                                <!-- Start Box -->
                                <div class="col-lg-6">
                                    <div class="default-box default-box-dashed">
                                        <div class="default-box-head default-box-head-show-hide d-flex align-items-center justify-content-between">
                                            <h4>{{ __('Categories & Brands') }}</h4>
                                            <i class="fas fa-angle-down arrow"></i>
                                        </div>
                                        <div class="default-box-body hidden-default-box-body">
                                            <div class="row">
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Category') }}*</label>
        												<select id="cat" name="category_id" required="" class="form-control">
        													<option value="">{{ __('Select Category') }}</option>
        													@foreach($cats as $cat)
                                                                <option data-href="{{ route('admin-subcat-load',$cat->id) }}" value="{{$cat->id}}" {{$cat->id == $data->category_id ? "selected":""}} >{{$cat->name}}</option>
                                                            @endforeach
        			                                     </select>
        											</div>
        										</div>
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Sub Category') }}*</label>
        												<select id="subcat" name="subcategory_id" class="form-control">
        													<option value="">{{ __('Select Sub Category') }}</option>
        													@if($data->subcategory_id == null)
                                                                @foreach($data->category->subs as $sub)
                                                                    <option data-href="{{ route('admin-childcat-load',$sub->id) }}" value="{{$sub->id}}" >{{$sub->name}}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach($data->category->subs as $sub)
                                                                    <option data-href="{{ route('admin-childcat-load',$sub->id) }}" value="{{$sub->id}}" {{$sub->id == $data->subcategory_id ? "selected":""}} >{{$sub->name}}</option>
                                                                @endforeach
                                                            @endif
        			                                     </select>
        											</div>
        										</div>
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Child Category') }}*</label>
        												<select id="childcat" name="childcategory_id" {{$data->subcategory_id == null ? "disabled":""}} class="form-control">
                                              				<option value="">{{ __('Select Child Category') }}</option>
                                                            @if($data->subcategory_id != null)
                                                                @if($data->childcategory_id == null)
                                                                    @foreach($data->subcategory->childs as $child)
                                                                        <option value="{{$child->id}}" >{{$child->name}}</option>
                                                                    @endforeach
                                                                @else
                                                                    @foreach($data->subcategory->childs as $child)
                                                                        <option value="{{$child->id}} " {{$child->id == $data->childcategory_id ? "selected":""}}>{{$child->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            @endif
        												</select>
        											</div>
        										</div>
        										@php
                        							$selectedAttrs = json_decode($data->attributes, true);
                        							// dd($selectedAttrs);
                    						    @endphp
                        						{{-- Attributes of category starts --}}
                        						<div id="catAttributes">
                        							@php
                        								$catAttributes = !empty($data->category->attributes) ? $data->category->attributes : '';
                        							@endphp
                        							@if (!empty($catAttributes))
                        								@foreach ($catAttributes as $catAttribute)
                        									<div class="row">
                        										 <div class="col-lg-4">
                        												<div class="left-area">
                        													 <h4 class="heading">{{ $catAttribute->name }} *</h4>
                        												</div>
                        										 </div>
                        										 <div class="col-lg-7">
                        											 @php
                        											 	$i = 0;
                        											 @endphp
                        											 @foreach ($catAttribute->attribute_options as $optionKey => $option)
                        												 @php
                        													$inName = $catAttribute->input_name;
                        													$checked = 0;
                        												 @endphp
                        
                        
                        												 <div class="row">
                        													 <div class="col-lg-5">
                        														 <div class="custom-control custom-checkbox">
                         															 <input type="checkbox" id="{{ $catAttribute->input_name }}{{$option->id}}" name="{{ $catAttribute->input_name }}[]" value="{{$option->name}}" class="custom-control-input attr-checkbox"
                         															 @if (is_array($selectedAttrs) && array_key_exists($catAttribute->input_name,$selectedAttrs))
                         																 @if (is_array($selectedAttrs["$inName"]["values"]) && in_array($option->name, $selectedAttrs["$inName"]["values"]))
                         																	 checked
                        																	 @php
                        																	 	$checked = 1;
                        																	 @endphp
                         																 @endif
                         															 @endif
                         															 >
                         															 <label class="custom-control-label" for="{{ $catAttribute->input_name }}{{$option->id}}">{{ $option->name }}</label>
                         														</div>
                        													 </div>
                        
                        													 <div class="col-lg-7 {{ $catAttribute->price_status == 0 ? 'd-none' : '' }}">
                        															<div class="row">
                        																 <div class="col-2">
                        																		+
                        																 </div>
                        																 <div class="col-10">
                        																		<div class="price-container">
                        																			 <span class="price-curr">{{ $sign->sign }}</span>
                        																			 <input type="text" class="input-field price-input" id="{{ $catAttribute->input_name }}{{$option->id}}_price" data-name="{{ $catAttribute->input_name }}_price[]" placeholder="0.00 (Additional Price)" value="{{ !empty($selectedAttrs["$inName"]['prices'][$i]) && $checked == 1 ? $selectedAttrs["$inName"]['prices'][$i] : '' }}">
                        																		</div>
                        																 </div>
                        															</div>
                        													 </div>
                        												 </div>
                        
                        
                        												 @php
                        													 if ($checked == 1) {
                        													 	$i++;
                        													 }
                        												 @endphp
                        												@endforeach
                        										 </div>
                        
                        									</div>
                        								@endforeach
                        							@endif
                        						</div>
                        						{{-- Attributes of category ends --}}
                        
                        
                        						{{-- Attributes of subcategory starts --}}
                        						<div id="subcatAttributes">
                        							@php
                        								$subAttributes = !empty($data->subcategory->attributes) ? $data->subcategory->attributes : '';
                        							@endphp
                        							@if (!empty($subAttributes))
                        								@foreach ($subAttributes as $subAttribute)
                        									<div class="row">
                        										 <div class="col-lg-4">
                        												<div class="left-area">
                        													 <h4 class="heading">{{ $subAttribute->name }} *</h4>
                        												</div>
                        										 </div>
                        										 <div class="col-lg-7">
                        												 @php
                        												 	$i = 0;
                        												 @endphp
                        												 @foreach ($subAttribute->attribute_options as $option)
                        													 @php
                        														$inName = $subAttribute->input_name;
                        														$checked = 0;
                        													 @endphp
                        
                        													 <div class="row">
                        													    <div class="col-lg-5">
                        													       <div class="custom-control custom-checkbox">
                        													          <input type="checkbox" id="{{ $subAttribute->input_name }}{{$option->id}}" name="{{ $subAttribute->input_name }}[]" value="{{$option->name}}" class="custom-control-input attr-checkbox"
                        													          @if (is_array($selectedAttrs) && array_key_exists($subAttribute->input_name,$selectedAttrs))
                        													          @php
                        													          $inName = $subAttribute->input_name;
                        													          @endphp
                        													          @if (is_array($selectedAttrs["$inName"]["values"]) && in_array($option->name, $selectedAttrs["$inName"]["values"]))
                        													          checked
                        															  @php
                        															 	$checked = 1;
                        															  @endphp
                        													          @endif
                        													          @endif
                        													          >
                        													          <label class="custom-control-label" for="{{ $subAttribute->input_name }}{{$option->id}}">{{ $option->name }}</label>
                        													       </div>
                        													    </div>
                        													    <div class="col-lg-7 {{ $subAttribute->price_status == 0 ? 'd-none' : '' }}">
                        													       <div class="row">
                        													          <div class="col-2">
                        													             +
                        													          </div>
                        													          <div class="col-10">
                        													             <div class="price-container">
                        													                <span class="price-curr">{{ $sign->sign }}</span>
                        													                <input type="text" class="input-field price-input" id="{{ $subAttribute->input_name }}{{$option->id}}_price" data-name="{{ $subAttribute->input_name }}_price[]" placeholder="0.00 (Additional Price)" value="{{ !empty($selectedAttrs["$inName"]['prices'][$i]) && $checked == 1 ? $selectedAttrs["$inName"]['prices'][$i] : '' }}">
                        													             </div>
                        													          </div>
                        													       </div>
                        													    </div>
                        													 </div>
                        													 @php
                        														 if ($checked == 1) {
                        														 	$i++;
                        														 }
                        													 @endphp
                        													@endforeach
                        
                        										 </div>
                        									</div>
                        								@endforeach
                        							@endif
                        						</div>
                        						{{-- Attributes of subcategory ends --}}
                        
                        
                        						{{-- Attributes of child category starts --}}
                        						<div id="childcatAttributes">
                        							@php
                        								$childAttributes = !empty($data->childcategory->attributes) ? $data->childcategory->attributes : '';
                        							@endphp
                        							@if (!empty($childAttributes))
                        								@foreach ($childAttributes as $childAttribute)
                        									<div class="row">
                        										 <div class="col-lg-4">
                        												<div class="left-area">
                        													 <h4 class="heading">{{ $childAttribute->name }} *</h4>
                        												</div>
                        										 </div>
                        										 <div class="col-lg-7">
                        											 @php
                        											 	$i = 0;
                        											 @endphp
                        											 @foreach ($childAttribute->attribute_options as $optionKey => $option)
                        												 @php
                        													$inName = $childAttribute->input_name;
                        													$checked = 0;
                        												 @endphp
                        												 <div class="row">
                        														 <div class="col-lg-5">
                        															 <div class="custom-control custom-checkbox">
                         																 <input type="checkbox" id="{{ $childAttribute->input_name }}{{$option->id}}" name="{{ $childAttribute->input_name }}[]" value="{{$option->name}}" class="custom-control-input attr-checkbox"
                         																 @if (is_array($selectedAttrs) && array_key_exists($childAttribute->input_name,$selectedAttrs))
                         																	 @php
                         																		$inName = $childAttribute->input_name;
                         																	 @endphp
                         																	 @if (is_array($selectedAttrs["$inName"]["values"]) && in_array($option->name, $selectedAttrs["$inName"]["values"]))
                         																		 checked
                        																		 @php
                        																		 	$checked = 1;
                        																		 @endphp
                         																	 @endif
                         																 @endif
                         																 >
                         																 <label class="custom-control-label" for="{{ $childAttribute->input_name }}{{$option->id}}">{{ $option->name }}</label>
                         															</div>
                        													  </div>
                        
                        
                        														<div class="col-lg-7 {{ $childAttribute->price_status == 0 ? 'd-none' : '' }}">
                        															 <div class="row">
                        																	<div class="col-2">
                        																		 +
                        																	</div>
                        																	<div class="col-10">
                        																		 <div class="price-container">
                        																				<span class="price-curr">{{ $sign->sign }}</span>
                        																				<input type="text" class="input-field price-input" id="{{ $childAttribute->input_name }}{{$option->id}}_price" data-name="{{ $childAttribute->input_name }}_price[]" placeholder="0.00 (Additional Price)" value="{{ !empty($selectedAttrs["$inName"]['prices'][$i]) && $checked == 1 ? $selectedAttrs["$inName"]['prices'][$i] : '' }}">
                        																		 </div>
                        																	</div>
                        															 </div>
                        														</div>
                        												 </div>
                        												 @php
                        													 if ($checked == 1) {
                        													 	$i++;
                        													 }
                        												 @endphp
                        												@endforeach
                        										 </div>
                        
                        									</div>
                        								@endforeach
                        							@endif
                        						</div>
                        						{{-- Attributes of child category ends --}}
        										
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Brands') }}*</label>
        												<select id="brand" name="brand_id" class="form-control">
                                              				<option value="">{{ __('Select Brand') }}</option>
                                          				    @foreach($brands as $b)
                                          				        <option value="{{$b->id}}" {{$b->id == $data->brand_id ? 'selected' : ""}}>{{$b->name}}</option>
                                          				    @endforeach
        												</select>
        											</div>
        										</div>
        										
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __("Affiliate Category Type") }}*</label>
        												<select id="affiliate_setting_id" name="affiliate_setting_id" class="form-control">
                                                            <option  value=" " >{{ __('Select Affiliate Category') }}</option>
                                                            @foreach($affilates as $affilate)
                                                                <option {{$data->affiliate_setting_id == $affilate->id ? "selected":""}} value="{{$affilate->id}}" >{{$affilate->affiliate_name}}</option>
                                                            @endforeach
                                                        </select>
        											</div>
        										</div>
        										
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Product Sku') }}* </label>
        												<input type="text" class="form-control" placeholder="{{ __('Enter Product Sku') }}" name="sku" required="" value="{{ $data->sku }}">
        											</div>
        										</div>
        									</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Box -->
                                <!-- Start Box -->
                                <div class="col-lg-6">
                                    <div class="default-box default-box-dashed">
                                        <div class="default-box-head default-box-head-show-hide d-flex align-items-center justify-content-between">
                                            <h4>{{ __('Allowness') }}</h4>
                                            <i class="fas fa-angle-down arrow"></i>
                                        </div>
                                        <div class="default-box-body hidden-default-box-body">  
                                            <div class="row">

        										<div class="col-lg-6">
        										    <div>
        										        <div>
        													<div class="checkbox-wrapper form-group">
        						                              <input type="checkbox" name="product_condition_check" class="checkclick" id="conditionCheck" value="1" {{ $data->product_condition != 0 ? "checked":"" }}>
        						                              <label for="conditionCheck">{{ __('Allow Product Condition') }}</label>
        						                            </div>
        					                            </div>
        				                            </div>
        											<div class="{{ $data->product_condition == 0 ? "showbox":"" }}">
        												<div class="col-lg-12 p-0">
        													<div class="form-group">
            													<select name="product_condition" class="form-control">
                                                                    <option value="2" {{$data->product_condition == 2 ? "selected":""}}>{{ __('New') }}</option>
                                                                    <option value="1" {{$data->product_condition == 1 ? "selected":""}}>{{ __('Used') }}</option>
            													</select>
        													</div>
        												</div>
        						                    </div>
        										</div>

            									<div class="col-lg-6">
            										<div class="form-group">
            										    <div>
                                                            <ul class="list">
                    											<li>
                    												<input  name="shipping_time_check" type="checkbox" id="check1" value="1" {{$data->ship != null ? "checked":""}}>
                    												<label for="check1">{{ __('Allow Estimated Shipping Time') }}</label>
                    											</li>
                    										</ul>
                										</div>
            										</div>
                    		                        <div class="{{ $data->ship != null ? "":"showbox" }}">
                										<div class="col-lg-12 p-0">
                											<div class="form-group">
                												<label>{{ __('Product Estimated Shipping Time') }}* </label>
                												<input type="text" class="form-control" placeholder="{{ __('Estimated Shipping Time') }}" name="ship" value="{{ $data->ship == null ? "" : $data->ship }}">
                											</div>
                										</div>
                    		                        </div>
            									</div>
        										
        										<div class="col-lg-6">
        										    <div class="form-group">
            										    <div>
                    										<ul class="list">
                    											<li>
                    												<input name="size_check" type="checkbox" id="size-check" value="1" {{ !empty($data->size) ? "checked":"" }}>
                    												<label for="size-check">{{ __('Allow Product Sizes') }}</label>
                    											</li>
                    										</ul>
            									        </div>
        									        </div>
                    							    <div class="{{ !empty($data->size) ? "":"showbox" }} mb-4" id="size-display">
                										<div  class="col-lg-12 p-0">
                    											<div class="product-size-details mb-0 pb-0" id="size-section">
                    											@if(!empty($data->size))
                    											    @foreach($data->size as $key => $data1)
                    												<div class="size-area">
                        												<span class="remove size-remove"><i class="fas fa-times"></i></span>
                        												<div  class="row">
                    														<div class="col-md-4 col-sm-6">
                    															<label>
                    																{{ __('Size Name') }} :
                    																<span>
                    																	{{ __('(eg. S,M,L,XL,XXL,3XL,4XL)') }}
                    																</span>
                    															</label>
                    															<input type="text" name="size[]" class="input-field space" placeholder="{{ __('Size Name') }}" value="{{ $data->size[$key] }}">
                    														</div>
                    														<div class="col-md-4 col-sm-6">
                    															<label>
                    																{{ __('Size Qty') }} :
                    																<span>
                    																	{{ __('(Number of quantity of this size)') }}
                    																</span>
                    															</label>
                    															<input type="number" name="size_qty[]" class="input-field" placeholder="{{ __('Size Qty') }}" min="1" value="{{!empty($data->size_qty) ? $data->size_qty[$key] : "" }}">
                    														</div>
                    														<div class="col-md-4 col-sm-6">
                    															<label>
                    																{{ __('Size Price') }} :
                    																<span>
                    																	{{ __('(This price will be added with base price)') }}
                    																</span>
                    															</label>
                    															<input type="number" name="size_price[]" class="input-field" placeholder="{{ __('Size Price') }}" min="0" value="{{!empty($data->size_price) ? $data->size_price[$key] : "" }}">
                    														</div>
                    													</div>
                    												</div>
                    												@endforeach
                    											@else
                    											    <div class="size-area">
                        												<span class="remove size-remove"><i class="fas fa-times"></i></span>
                        												<div  class="row">
                    														<div class="col-md-4 col-sm-6">
                    															<label>
                    																{{ __('Size Name') }} :
                    																<span>
                    																	{{ __('(eg. S,M,L,XL,XXL,3XL,4XL)') }}
                    																</span>
                    															</label>
                    															<input type="text" name="size[]" class="input-field space" placeholder="{{ __('Size Name') }}">
                    														</div>
                    														<div class="col-md-4 col-sm-6">
                    															<label>
                    																{{ __('Size Qty') }} :
                    																<span>
                    																	{{ __('(Number of quantity of this size)') }}
                    																</span>
                    															</label>
                    															<input type="number" name="size_qty[]" class="input-field" placeholder="{{ __('Size Qty') }}" value="1" min="1">
                    														</div>
                    														<div class="col-md-4 col-sm-6">
                    															<label>
                    																{{ __('Size Price') }} :
                    																<span>
                    																	{{ __('(This price will be added with base price)') }}
                    																</span>
                    															</label>
                    															<input type="number" name="size_price[]" class="input-field" placeholder="{{ __('Size Price') }}" value="0" min="0">
                    														</div>
                    													</div>
                    												</div>
                												@endif
                    											</div>
                    											<a href="javascript:;" id="size-btn" class="main-light-btn mb-4 text-white"><i class="fas fa-plus"></i>{{ __('Add More Size') }} </a>
                    										</div>
                    								</div>
            									</div>
            									<!-- Color Size -->
            									<div class="col-lg-6">
        										    <div class="form-group">
            										    <div>
        													<ul class="list">
        														<li>
        															<input name="size_color_check" type="checkbox" id="size-color-check" value="1" {{ count($colors) > 0 ? "checked":"" }}>
        															<label for="size-color-check">{{ __('Allow Product Colors By Sizes') }}</label>
        														</li>
        													</ul>
        											    </div>
        											</div>
        											<div class="{{ count($colors) > 0 ? "":"showbox" }}" id="size-color-display">
        												<div  class="col-lg-12 p-0">
        													<div class="product-size-details mb-0 pb-0" id="size-color-section">
                    										@if(!empty($colors))
                    										    @foreach($colors as $dataa)
        														<div class="size-area">
        															<span class="remove size-remove"><i class="fas fa-times"></i></span>
        															<div  class="row">
        																<div class="col-lg-6">
        																	<label>
        																		{{ __('Size Name') }} :
        																		<span>
        																			{{ __('(eg. S,M,L,XL,XXL,3XL,4XL)') }}
        																		</span>
        																	</label>
        																	<input type="text" name="size_color[]" class="input-field space" placeholder="Size Name" value="{{ $dataa->size }}">
        																</div>
        																<div  class="col-lg-6">
        																	<label>
        																		{{ __('Color') }} :
        																		<span>
        																			{{ __('(eg. #000000,#00324)') }}
        																		</span>
        																	</label>
        																	<div class="color-area">
        																		
        										                                <div class="input-group colorpicker-component cp">
        										                                  <input type="text" name="color_size[]" value="{{ $dataa->colors }}"  class="input-field cp"/>
        										                                  <span class="input-group-addon"><i></i></span>
        										                                </div>
        										                         	</div>
        										                         
        													        	</div>
        												        	
        												        		<div  class="col-lg-6">
        																	<label>
        																		{{ __('Color Qty') }} :
        																	
        																	</label>
        																	<div class="color-area">
        																		
        										                                <div class="input-group ">
        										                                  <input type="number" name="color_qty[]" value="{{ $dataa->size_qty }}" min="0"  class="input-field "/>
        										                                 
        										                                </div>
        										                         	</div>
        									                         
        												        	    </div>	
        													        	<div  class="col-lg-6">
        																	<label>
        																		{{ __('Color Price') }} :
        																	
        																	</label>
        																	<div class="color-area">
        																		
        										                                <div class="input-group ">
        										                                  <input type="number" name="color_price[]" value="{{ $dataa->size_price }}" min="0"  class="input-field "/>
        										                                 
        										                                </div>
        										                         	</div>
        										                         
        													        	</div>

																		<div  class="col-lg-12">
        																	<label>
        																		{{ __('Image') }} :
        																	
        																	</label>
        																	<div class="color-area">
        																		
        										                                <div class="input-group ">
        										                                  <input type="file" name="color_image[]" class="input-field "/>
        										                                 
        										                                </div>
        										                         	</div>
        										                         
        													        	</div>

        															</div>
        														</div>
        														@endforeach
    														@else
        													    <div class="size-area">
        															<span class="remove size-remove"><i class="fas fa-times"></i></span>
        															<div  class="row">
        																<div class="col-lg-6">
        																	<label>
        																		{{ __('Size Name') }} :
        																		<span>
        																			{{ __('(eg. S,M,L,XL,XXL,3XL,4XL)') }}
        																		</span>
        																	</label>
        																	<input type="text" name="size_color[]" class="input-field space" placeholder="Size Name">
        																</div>
        																<div  class="col-lg-6">
        																	<label>
        																		{{ __('Color') }} :
        																		<span>
        																			{{ __('(eg. #000000,#00324)') }}
        																		</span>
        																	</label>
        																	<div class="color-area">
        																		
        										                                <div class="input-group colorpicker-component cp">
        										                                  <input type="text" name="color_size[]" value="#000000"  class="input-field cp"/>
        										                                  <span class="input-group-addon"><i></i></span>
        										                                </div>
        										                         	</div>
        										                         
        													        	</div>
        												        	
        												        		<div  class="col-lg-6">
        																	<label>
        																		{{ __('Color Qty') }} :
        																	
        																	</label>
        																	<div class="color-area">
        																		
        										                                <div class="input-group ">
        										                                  <input type="number" name="color_qty[]" value="0" min="0"  class="input-field "/>
        										                                 
        										                                </div>
        										                         	</div>
        									                         
        												        	    </div>	
        													        	<div  class="col-lg-6">
        																	<label>
        																		{{ __('Color Price') }} :
        																	
        																	</label>
        																	<div class="color-area">
        																		
        										                                <div class="input-group ">
        										                                  <input type="number" name="color_price[]" value="0" min="0"  class="input-field "/>
        										                                 
        										                                </div>
        										                         	</div>
        										                         
        													        	</div>
        															</div>
        														</div>
        													@endif	
        													</div>
        												    <a href="javascript:;" id="size-color-btn" class="main-light-btn mb-4 text-white"><i class="fas fa-plus"></i>{{ __('Add More Color For Sizes') }} </a>
        												</div>
        											</div>
        										</div>
            									
            									<div class="col-lg-6">
        											<div class="form-group">
                                                        <div>
                                                            <ul class="list">
        														<li>
        															<input class="checkclick1" name="color_check" type="checkbox" id="check3" value="1" {{ !empty($data->color) ? "checked":"" }}>
        															<label for="check3">{{ __('Allow Product Colors') }}</label>
        														</li>
        													</ul>
                                                        </div>
        											</div>
        											<div class="{{ !empty($data->color) ? "":"showbox" }}" id="colors-display">
								                        @if(!empty($data->color))
                										<div class="col-lg-12 p-0">
                											<div class="form-group">
        														<label>{{ __('Product Colors') }}* <small>{{ __('(Choose Your Favorite Colors)') }}</small></label>
        														<div class="select-input-color" id="color-section">
        														    @foreach($data->color as $key => $data1)
        															<div class="color-area">
        																<span class="remove color-remove"><i class="fas fa-times"></i></span>
        								                                <div class="input-group colorpicker-component cp">
        								                                  <input type="text" name="color[]" value="{{ $data->color[$key] }}"  class="input-field cp"/>
        								                                  <span class="input-group-addon"><i></i></span>
        								                                </div>
        								                         	</div>
        								                         	@endforeach
        								                        </div>
        													    <a href="javascript:;" id="color-btn" class="main-light-btn mb-4 text-white"><i class="fas fa-plus"></i>{{ __('Add More Color') }} </a>
        													</div>
        												</div>
        												@else
        												<div class="col-lg-12 p-0">
                											<div class="form-group">
        														<label>{{ __('Product Colors') }}* <small>{{ __('(Choose Your Favorite Colors)') }}</small></label>
        														<div class="select-input-color" id="color-section">
        															<div class="color-area">
        																<span class="remove color-remove"><i class="fas fa-times"></i></span>
        								                                <div class="input-group colorpicker-component cp">
        								                                  <input type="text" name="color[]" value="#000000"  class="input-field cp"/>
        								                                  <span class="input-group-addon"><i></i></span>
        								                                </div>
        								                         	</div>
        								                        </div>
        													    <a href="javascript:;" id="color-btn" class="main-light-btn mb-4 text-white"><i class="fas fa-plus"></i>{{ __('Add More Color') }} </a>
        													</div>
        												</div>
        												@endif
        					                        </div>
        										</div>
            									
            									<div class="col-lg-6">
        											<div class="form-group">
                                                        <div>
        													<ul class="list">
        														<li>
        															<input class="checkclick1" name="whole_check" type="checkbox" id="whole_check" value="1" {{ !empty($data->whole_sell_qty) ? "checked":"" }}>
        															<label for="whole_check">{{ __('Allow Product Whole Sell') }}</label>
        														</li>
        													</ul>
        											    </div>
        											</div>
        											<div class="{{ !empty($data->whole_sell_qty) ? "":"showbox" }}">
        												<div class="col-lg-12 p-0">
        													<div class="featured-keyword-area">
        														<div class="feature-tag-top-filds" id="whole-section">
                        										@if(!empty($data->whole_sell_qty))
                    										        @foreach($data->whole_sell_qty as $key => $data1)
        															<div class="feature-area">
        																<span class="remove whole-remove"><i class="fas fa-times"></i></span>
        																<div class="row">
        																	<div class="col-lg-6">
        																	    <input type="number" name="whole_sell_qty[]" value="{{ $data->whole_sell_qty[$key] }}" class="input-field" placeholder="{{ __('Enter Quantity') }}" min="0">
        																	</div>
        
        																	<div class="col-lg-6">
        										                                <input type="number" name="whole_sell_discount[]" value="{{ $data->whole_sell_discount[$key] }}" class="input-field" placeholder="{{ __('Enter Discount Percentage') }}" min="0" />
        																	</div>
        																</div>
        															</div>
        															@endforeach
        														@else
        														    <div class="feature-area">
        																<span class="remove whole-remove"><i class="fas fa-times"></i></span>
        																<div class="row">
        																	<div class="col-lg-6">
        																	    <input type="number" name="whole_sell_qty[]" class="input-field" placeholder="{{ __('Enter Quantity') }}" min="0">
        																	</div>
        
        																	<div class="col-lg-6">
        										                                <input type="number" name="whole_sell_discount[]" class="input-field" placeholder="{{ __('Enter Discount Percentage') }}" min="0" />
        																	</div>
        																</div>
        															</div>
        														@endif
        														</div>
        														<a href="javascript:;" id="whole-btn" class="main-light-btn"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>
        													</div>
        												</div>
        											</div>
        										</div>
        										<div class="col-lg-6">
        											<div class="form-group">
        												<ul class="list">
        													<li>
        														<input class="free_ship" name="free_ship" type="checkbox" id="free_ship" value="1" {{$data->free_ship == 1 ? "checked" : ""}}>
        														<label for="free_ship">{{ __('Free Shipping') }}</label>
        													</li>
        												</ul>
        										    </div>
        										</div>

												<div class="col-lg-6">
            										<div class="form-group">
            										    <div>
                                                            <ul class="list">
                    											<li>
                    												<input  name="featured_price_check" type="checkbox" id="featured_price_check" value="1" {{$data->featured_price != null ? "checked":""}}>
                    												<label for="featured_price_check">{{ __('Featured Price') }}</label>
                    											</li>
                    										</ul>
                										</div>
            										</div>
                    		                        <div class="{{ $data->featured_price != null ? "":"showbox" }}">
                										<div class="col-lg-12 p-0">
                											<div class="form-group">
                												<input type="number" min="0" step="0.1" class="form-control" placeholder="{{ __('Featured Price') }}" name="featured_price" value="{{ $data->featured_price == null ?: $data->featured_price }}">
                											</div>
                										</div>
                    		                        </div>
            									</div>

        									</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Box -->
                            </div>
                            <!-- End 2 Boxes -->
                            <!-- Start 2 Boxes -->
                            <div class="row">
                                <!-- Start Box -->
                                <div class="col-lg-6">
                                    <div class="default-box default-box-dashed">
                                        <div class="default-box-head default-box-head-show-hide d-flex align-items-center justify-content-between">
                                            <h4>{{ __('Price & Stock') }}</h4>
                                            <i class="fas fa-angle-down arrow"></i>
                                        </div>
                                        <div class="default-box-body hidden-default-box-body"> 
                                            <div class="row">
                                                <div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Product Current Price') }}*
        												<small>
        												    ({{ __('In') }} {{$sign->name}})
        												</small>
        												</label>
        												<input name="price" type="number" class="form-control" placeholder="{{ __('e.g 20') }}" step="0.1" required="" min="0" value="{{round($data->price * $sign->value , 2)}}">
        											</div>
        										</div>
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Product Previous Price') }}* <small>{{ __('(Optional)') }}</small></label>
        												<input name="previous_price" step="0.1" type="number" class="form-control" placeholder="{{ __('e.g 20') }}" min="0" value="{{round($data->previous_price * $sign->value , 2)}}">
        											</div>
        										</div>
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>
        													{{ __('Product Mobile Current Price') }}*
        													<small>
        													    ({{ __('In') }} {{$sign->name}})
        													</small>
        												</label>
        												<input name="mobile_price" type="number" class="form-control" placeholder="{{ __('e.g 20') }}" step="0.1"  min="0"  value="{{$data->mobile_price}}">
        											</div>
        										</div>
        										<div class="col-lg-6" id="stckprod">
        											<div class="form-group">
        												<label class="heading">{{ __('Product Stock') }}* <small>{{ __('(Leave it empty it will appear Unlimited)') }}</small></label>
        												<input name="stock" type="text" class="form-control" placeholder="{{ __('p.s 20') }}" value="{{ $data->stock }}">
        											</div>
        										</div>
        										<div class="col-lg-6">
        										    <div>
        											    <div>
        													<div class="checkbox-wrapper form-group">
        														<input type="checkbox" name="measure_check" class="checkclick" id="allowProductMeasurement" value="1" {{ $data->measure == null ? '' : 'checked' }}>
        														<label for="allowProductMeasurement">{{ __('Allow Product Measurement') }}</label>
        													</div>
        												</div>
        											</div>
        											<div class="{{ $data->measure == null ? 'showbox' : '' }}">
        												<div class="col-lg-12 p-0">
        													<div class="form-group">
        														<div class="row">
        														    <div class="col-lg-10">
                														<select id="product_measure" class="form-control">
                                                                            <option value="" {{$data->measure == null ? 'selected':''}}>{{ __('None') }}</option>
                                                                            <option value="Gram" {{$data->measure == 'Gram' ? 'selected':''}}>{{ __('Gram') }}</option>
                                                                            <option value="Kilogram" {{$data->measure == 'Kilogram' ? 'selected':''}}>{{ __('Kilogram') }}</option>
                                                                            <option value="Litre" {{$data->measure == 'Litre' ? 'selected':''}}>{{ __('Litre') }}</option>
                                                                            <option value="Pound" {{$data->measure == 'Pound' ? 'selected':''}}>{{ __('Pound') }}</option>
                                                                            <option value="Custom" {{ in_array($data->measure,explode(',', 'Gram,Kilogram,Litre,Pound')) ? '' : 'selected' }}>{{ __('Custom') }}</option>
                                                                         </select>
                    												</div><br>
                    												<div class="col-lg-10"><input name="scale" type="number"  class="form-control"  min="1" value="{{$data->scale}}"></div>
                    												<div class="col-lg-10 {{ in_array($data->measure,explode(',', 'Gram,Kilogram,Litre,Pound')) ? 'hidden' : '' }}" id="measure">
                    													<input name="measure" type="text" id="measurement" class="form-control" placeholder="{{ __('Enter Unit') }}" value="{{$data->measure}}">
                    												</div>
        														</div>
        													</div>
        												</div>
            										</div>
        										</div>
        										
        											<div class="col-lg-6">
													<div>
														<div>
															<div class="checkbox-wrapper form-group">
																<input type="checkbox" name="country_price_check"
																	class="checkclick" id="allowCountryPrice"
																	value="1">
																<label for="allowCountryPrice">{{ __('Allow
																	Country Price') }}</label>
															</div>
														</div>
													</div>
													<div class="showbox">
													<div class="col-lg-12 p-0">
															<div class="featured-keyword-area">
																<div class="feature-tag-top-filds" id="country-section">
																	<div class="feature-area">
																		<span class="remove country-remove"><i
																				class="fas fa-times"></i></span>
																		<div class="row">
																			<div class="col-lg-6">
																			 <select name="country[]" class="input-field" >
																			     <option value="Egypt">Egypt</option>
																			     <option value="United States">United States</option>
																			     <option value="United Kingdom">United Kingdom</option>
																			     <option value="Germany">Germany</option>
																			     <option value="Ireland">Ireland</option>
																			     <option value="Hong Kong">Hong Kong</option>
																			     <option value="Russia">Russia</option>
																			     <option value="Canada">Canada</option>
																			     <option value="South Korea">South Korea</option>
																			     <option value="Singapore">Singapore</option>
																			     <option value="Ukraine">Ukraine</option>
																			     <option value="China">China</option>
																			     <option value="Japan">Japan</option>
																			     <option value="Netherlands">Netherlands</option>
																			     <option value="Greenland">Greenland</option>
																			     <option value="Turkey">Turkey</option>
																			     
																			 </select>
																			</div>

																			<div class="col-lg-6">
																				<input type="number"
																					name="country_price[]"
																					class="input-field"
																					placeholder="{{ __('Enter price') }}"
																					min="0" />
																			</div>
																		</div>
																	</div>
																</div>

																<a href="javascript:;" id="country-btn"
																	class="main-light-btn"><i class="icofont-plus"></i>
																	{{ __('Add More country') }}</a>
															</div>
														</div>
													</div>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Box -->
                                <!-- Start Box -->
                                <div class="col-lg-6">
                                    <div class="default-box default-box-dashed">
                                        <div class="default-box-head default-box-head-show-hide d-flex align-items-center justify-content-between">
                                            <h4>{{ __('(SEO Settings)') }}</h4>
                                            <i class="fas fa-angle-down arrow"></i>
                                        </div>
                                        <div class="default-box-body hidden-default-box-body"> 
                                            <div class="row">
                                                <div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Youtube Video URL') }}*</label>
        												<span class="sub-heading">{{ __('(Optional)') }}</span>
        												<input  name="youtube" type="text" class="form-control" placeholder="{{ __('Enter Youtube Video URL') }}" value="{{$data->youtube}}">
        											</div>
        										</div>
        										<div class="col-lg-6">
        										    <div>
        											    <div>
        						                            <div class="checkbox-wrapper form-group">
        						                              <input type="checkbox" name="seo_check" value="1" class="checkclick" id="allowProductSEO" value="1" {{ ($data->meta_tag != null || strip_tags($data->meta_description) != null) ? 'checked':'' }}>
        						                              <label for="allowProductSEO">{{ __('Allow Product SEO') }}</label>
        						                            </div>
        					                            </div>
        				                            </div>
        				                            <div class="{{ ($data->meta_tag == null && strip_tags($data->meta_description) == null) ? "showbox":"" }}">
        					                          <div class="row">
        					                            <div class="col-lg-12">
        					                              <div class="form-group">
        					                                  <label>{{ __('Meta Tags') }} *</label>
        					                                  <ul id="metatags" class="myTags">
        					                                    @if(!empty($data->meta_tag))
                                    	                            @foreach ($data->meta_tag as $element)
                                    	                                <li>{{  $element }}</li>
                                    	                            @endforeach
                                                                @endif
        					                                   </ul>
        					                              </div>
        					                            </div>
        					                          </div>
        					                          <div class="row">
        					                            <div class="col-lg-12">
        					                              <div class="form-group">
        					                                  <label>{{ __('Meta Description') }} *</label>
        					                                  <div class="text-editor">
            					                                <textarea name="meta_description" class="form-control" placeholder="{{ __('Meta Description') }}">{{ $data->meta_description }}</textarea>
            					                              </div>
        					                              </div>
        					                            </div>
        					                          </div>
        				                              <div class="row">
        					                            <div class="col-lg-12">
        					                              <div class="form-group">
        					                                  <label>{{ __('Arabic Meta Description') }} *</label>
        					                                  <div class="text-editor">
            					                                <textarea name="meta_description_ar" class="form-control" placeholder="{{ __('Arabic Meta Description') }}">{{ $data->meta_description_ar }}</textarea>
            					                              </div>
        					                              </div>
        					                            </div>
        					                          </div>
        					                        </div>
        										</div>
        										
        										<div class="col-lg-6">
        											<div class="featured-keyword-area">
        												<div class="form-group">
        													<label>{{ __('Feature Tags') }}</label>
        													<div class="feature-tag-top-filds" id="feature-section">
    													    @if(!empty($data->features))
                											    @foreach($data->features as $key => $data1)
        														<div class="feature-area">
        															<span class="remove feature-remove"><i class="fas fa-times"></i></span>
        															<div class="row">
        																<div class="col-lg-6">
        																<input type="text" name="features[]" class="form-control" placeholder="{{ __('Enter Your Keyword') }}" value="{{ $data->features[$key] }}">
        																</div>
        
        																<div class="col-lg-6">
        									                                <div class="input-group colorpicker-component cp">
        									                                  <input type="text" name="colors[]" value="{{ $data->colors[$key] }}" class="form-control cp"/>
        									                                  <span class="input-group-addon"><i></i></span>
        									                                </div>
        																</div>
        															</div>
        														</div>
        														@endforeach
        													@else
        													    <div class="feature-area">
        															<span class="remove feature-remove"><i class="fas fa-times"></i></span>
        															<div class="row">
        																<div class="col-lg-6">
        																<input type="text" name="features[]" class="form-control" placeholder="{{ __('Enter Your Keyword') }}">
        																</div>
        
        																<div class="col-lg-6">
        									                                <div class="input-group colorpicker-component cp">
        									                                  <input type="text" name="colors[]" value="#000000" class="form-control cp"/>
        									                                  <span class="input-group-addon"><i></i></span>
        									                                </div>
        																</div>
        															</div>
        														</div>
    														@endif
        													</div>
        													<a href="javascript:;" id="feature-btn" class="main-light-btn mb-4 text-white"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>
        												</div>
        											</div>
        										</div>
        										<div class="col-lg-6">
        				                            <div class="form-group">
        				                                <label>{{ __('Tags') }} *</label>
        				                                <ul id="tags" class="myTags" >
        				                                    @if(!empty($data->tags))
                            	                                @foreach ($data->tags as $element)
                            	                                  <li>{{  $element }}</li>
                            	                                @endforeach
                                                            @endif     
        				                                </ul>
        				                            </div>
        			                            </div>
        			                            <div class="col-lg-12">
        											<div class="form-group" >
        												<label>{{ __("Related Products") }} :</label>
        												<select class="form-control multi-sel" name="related[]" multiple="multiple">
                                                            @forelse($pro as $app)
                                                                <option value="{{$app->id}}">{{$app->name}}</option>
                        
                                                            @empty
                        
                                                            @endforelse
                                                        </select>
        											</div>
        										</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- End Box -->
                            </div>
                            <!-- End 2 Boxes -->
                            <!-- Start Box -->
                            <div class="default-box">
    						    <div class="row">
    							<div class="col-lg-12">
    								<table class="table">
                                      <thead class="thead-dark">
                                        <tr>
                                          <th style="padding: 7px;" scope="col">#</th>
                                          <th scope="col">{{ __("Product Name") }}</th>
                                         
                                          <th scope="col">{{ __("Action") }}</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @forelse($Related as $key=>$r)  
                                        @php 
                                        $p = App\Models\Product::where('id',$r->related_id)->first();
                                        @endphp
                                        <tr>
                                          <th style="padding: 7px;" scope="row">{{$key+1}}</th>
                                           @if($p)  <td>{{$p->name}}</td> @else  <td>{{ __("Product Deleted") }}</td> @endif 
                                          
                                          <td><a href="{{route('admin-related-delete',$r->id)}}"  class="delete"><i class="fas fa-trash-alt"></i> </a></td>
                                        </tr>
                                       @empty
                                        <tr style="text-align: center;">
                                          <th colspan="3" style="text-align: center;" scope="row" >{{ __("No Related Product") }}</th>
                                         
                                        </tr>
                                       
                                       @endforelse
                                      </tbody>
                                    </table>
    							</div>
    						</div>
                            </div>
                            
                            <div class="default-box">
    						    <div class="row">
    							<div class="col-lg-12">
    								<table class="table">
                                      <thead class="thead-dark">
                                        <tr>
                                          <th style="padding: 7px;" scope="col">#</th>
                                          <th scope="col">{{ __("country") }}</th>
                                          <th scope="col">{{ __("price") }}</th>
                                         
                                          <th scope="col">{{ __("Action") }}</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @forelse($ProductCurrencies as $key=>$r)  
                                      
                                        <tr>
                                          <th style="padding: 7px;" scope="row">{{$key+1}}</th>
                                          <td>{{$r->country}}</td> 
                                          <td>{{$r->price}}</td> 
                                          
                                          <td><a href="{{route('admin-country-price-delete',$r->id)}}"  class="delete"><i class="fas fa-trash-alt"></i> </a>
                                          <a href="javascript:;"  data-href="{{route('admin-country-price-edit',$r->id)}}" class="edit delete" data-bs-toggle="modal" data-bs-target="#modal1"><i class="fas fa-edit"></i> </a></td>
                                        </tr>
                                       @empty
                                        <tr style="text-align: center;">
                                          <th colspan="3" style="text-align: center;" scope="row" >{{ __("No Country Prices") }}</th>
                                         
                                        </tr>
                                       
                                       @endforelse
                                      </tbody>
                                    </table>
    							</div>
    						</div>
                            </div>
                            <!-- End Box -->
    						<div class="row">
    							<div class="col-lg-12 text-center">
    								<button class="main-light-btn py-3" type="submit">{{ __('Save') }} <i class="fas fa-check ms-3"></i></button>
    							</div>
    						</div>
                            <!-- End-->
					    </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Gallery Modal -->
<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
    		<div class="modal-header">
    			<h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    		</div>
    		<div class="modal-body">
    			<div class="top-area">
    				<div class="row">
    					<div class="col-md-10 col-8">
    					    <form  method="POST" enctype="multipart/form-data" id="form-gallery">
								{{ csrf_field() }}
								<input type="hidden" id="pid" name="product_id" value="">
								<input type="file" name="gallery[]" class="hidden" id="uploadgallerys" accept="image/*" multiple>
									<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
							</form>
						</div>
    					<div class="col-md-2 col-4">
    						<a href="javascript:;" class="upload-done-btn main-bg-dark text-white" data-bs-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
    					</div>
    				</div>
    			</div>
    			<div class="gallery-images mt-3">
    				<div class="selected-image selected-image-web">
    					<div class="row"></div>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
</div>
<!-- Mobile Gallery Modal -->
<div class="modal fade" id="setgallerymobile" tabindex="-1" role="dialog" aria-labelledby="setgallerymobile" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="top-area">
				<div class="row">
					<div class="col-md-10 col-8">
					    <form  method="POST" enctype="multipart/form-data" id="form-gallery-mobile">
							{{ csrf_field() }}
							<input type="hidden" id="pidd" name="product_id" value="">
							<input type="file" name="gallery[]" class="hidden" id="uploadgallerymobile" accept="image/*" multiple>
							<label for="image-upload" id="prod_gallery_mobile"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
						</form>
					</div>
					<div class="col-md-2 col-4">
						<a href="javascript:;" class="upload-done-btn main-bg-dark text-white" data-bs-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
					</div>
				</div>
			</div>
			<div class="gallery-images mt-3">
				<div class="selected-image selected-image-mobile ">
					<div class="row"></div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>

			<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
										
										
										<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
											</div>
										</div>
										</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">

// Gallery Section Update

    $(document).on("click", ".set-gallery-web" , function(){
        var pid = $(this).find('input[type=hidden]').val();
        $('#pid').val(pid);
        $('.selected-image .row').html('');
            $.ajax({
                    type: "GET",
                    url:"{{ route('admin-gallery-show') }}",
                    data:{id:pid},
                    success:function(data){
                      if(data[0] == 0)
                      {
	                    $('.selected-image .row').addClass('justify-content-center');
	      				$('.selected-image .row').html('<h3>{{ __('No Images Found.') }}</h3>');
     				  }
                      else {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();
                          var arr = $.map(data[1], function(el) {
                          return el });

                          for(var k in arr)
                          {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
                          }
                       }

                    }
                  });
      });
    $(document).on("click", ".set-gallery-mobile" , function(){
        var pid = $(this).find('input[type=hidden]').val();
        $('#pidd').val(pid);
        $('.selected-image .row').html('');
            $.ajax({
                    type: "GET",
                    url:"{{ route('admin-gallery-mobileshow') }}",
                    data:{id:pid},
                    success:function(data){
                      if(data[0] == 0)
                      {
	                    $('.selected-image .row').addClass('justify-content-center');
	      				$('.selected-image .row').html('<h3>{{ __('No Images Found.') }}</h3>');
     				  }
                      else {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();
                          var arr = $.map(data[1], function(el) {
                          return el });

                          for(var k in arr)
                          {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
                          }
                       }

                    }
                  });
      });


  $(document).on('click', '.remove-img' ,function() {
    var id = $(this).find('input[type=hidden]').val();
    $(this).parent().parent().remove();
	    $.ajax({
	        type: "GET",
	        url:"{{ route('admin-gallery-delete') }}",
	        data:{id:id}
	    });
  });

  $(document).on('click', '#prod_gallery' ,function() {
    $('#uploadgallerys').click();
  });
 $(document).on('click', '#prod_gallery_mobile' ,function() {
    $('#uploadgallerymobile').click();
  });


  $("#uploadgallerys").change(function(){
    $("#form-gallery").submit();
  }); 
  
  $("#uploadgallerymobile").change(function(){
    $("#form-gallery-mobile").submit();
  });

  $(document).on('submit', '#form-gallery' ,function() {
		  $.ajax({
		   url:"{{ route('admin-gallery-store') }}",
		   method:"POST",
		   data:new FormData(this),
		   dataType:'JSON',
		   contentType: false,
		   cache: false,
		   processData: false,
		   success:function(data)
		   {
		    if(data != 0)
		    {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();
		        var arr = $.map(data, function(el) {
		        return el });
		        for(var k in arr)
		           {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
		            }
		    }

		                       }

		  });
		  return false;
 });
  $(document).on('submit', '#form-gallery-mobile' ,function() {
		  $.ajax({
		   url:"{{ route('admin-gallery-mobile-store') }}",
		   method:"POST",
		   data:new FormData(this),
		   dataType:'JSON',
		   contentType: false,
		   cache: false,
		   processData: false,
		   success:function(data)
		   {
		    if(data != 0)
		    {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();
		        var arr = $.map(data, function(el) {
		        return el });
		        for(var k in arr)
		           {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
		            }
		    }

		                       }

		  });
		  return false;
 });


// Gallery Section Update Ends

</script>

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>

<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

<script type="text/javascript">

$('.cropme').simpleCropper();

$('#crop-image').on('click',function(){
$('.cropme').click();
});

$('.mobile').on('click',function(){
$('#feature_mobile_photo').click();
});


</script>


  <script type="text/javascript">
  $(document).ready(function() {

    <?php
if (empty($data->photo)) {
  $photoSrc = asset('assets/images/noimage.png');
} else {
  if (filter_var($data->photo, FILTER_VALIDATE_URL)) {
    $photoSrc = $data->photo;
  } else {
    $photoSrc = asset('assets/images/products/'.$data->photo);
  }
}
?>

    let html = `<img src="<?php echo e($photoSrc); ?>" alt="">`;
    $(".span4.cropme").html(html);
 

<?php
if (empty($data->mobile_photo)) {
  $photoSrc = asset('assets/images/noimage.png');
} else {
  if (filter_var($data->mobile_photo, FILTER_VALIDATE_URL)) {
    $photoSrc = $data->mobile_photo;
  } else {
    $photoSrc = asset('assets/images/products/'.$data->mobile_photo);
  }
}
?>

    
    let htmls = `<img src="<?php echo e($photoSrc);  ?>" alt="">`;
    $(".mobile").html(htmls);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  });


  $('.ok').on('click', function () {

 setTimeout(
    function() {


  	var img = $('#feature_photo').val();
  
    
      $.ajax({
        url: "{{route('admin-prod-upload-update',$data->id)}}",
        type: "POST",
        data: {"image":img},
        success: function (data) {
          if (data.status) {
            $('#feature_photo').val(data.file_name);
          }
          if ((data.errors)) {
            for(var error in data.errors)
            {
              $.notify(data.errors[error], "danger");
            }
          }
        }
      });
   
    
     
        
   
      

    }, 1000); 
    




    });  
    
    $('.ok_mobile').on('click', function () {

 setTimeout(
    function() {


  
  	var imgg = $('#feature_mobile_photo').val();
   
        $.ajax({
        url: "{{route('admin-prod-upload-mobile-update',$data->id)}}",
        type: "POST",
        data: {"image":imgg},
        success: function (data) {
          if (data.status) {
            $('#feature_mobile_photo').val(data.file_name);
          }
          if ((data.errors)) {
            for(var error in data.errors)
            {
              $.notify(data.errors[error], "danger");
            }
          }
        }
      });
        
    
      

    }, 1000); 
    




    });

  </script>

  <script type="text/javascript">

  $('#imageSource').on('change', function () {
    var file = this.value;
      if (file == "file"){
          $('#f-file').show();
          $('#f-link').hide();
      }
      if (file == "link"){
          $('#f-file').hide();
          $('#f-link').show();
      }
  });

/*$(document).ready(function(){
 $('.size-color').tokenfield({
  autocomplete:{
   source: ['PHP','Codeigniter','HTML','JQuery','Javascript','CSS','Laravel','CakePHP','Symfony','Yii 2','Phalcon','Zend','Slim','FuelPHP','PHPixie','Mysql'],
   delay:100
  },
  showAutocompleteOnFocus: true
 });
 });*/
 
 
 
        $(".checkclick3").on( "change", function() {
            if(this.checked){
             $(".subs").removeClass('showbox');  
            }
            else{
             $(".subs").addClass('showbox');   
            }
        });
  </script>
<script type="text/javascript" src="{{asset('assets/admin/js/bootstrap-tagsinput.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/product.js')}}"></script>

<script type="text/javascript">
    
    $('.size-color').val();
    
    
</script>
     <script type="text/javascript">
    $("input.space").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});
    
    </script>
<script>
/*function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();*/
</script>


<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
       
    });
</script>
@endsection
