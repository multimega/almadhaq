@extends('layouts.admin')
@php
 $sign = DB::table('currencies')->where('is_default','=',1)->first();

 @endphp
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading"> {{ __('Edit Product') }}<a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
											<ul class="links">
												<li>
													<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
												</li>
												<li>
													<a href="{{ route('admin-prod-index') }}">{{ __('Products') }} </a>
												</li>
												<li>
													<a href="javascript:;">{{ __('Physical Product') }}</a>
												</li>
												<li>
													<a href="javascript:;">{{ __('Edit') }}</a>
												</li>
											</ul>
									</div>
								</div>
							</div>
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">

					                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
					                      <form id="geniusform" action="{{route('admin-prod-update',$data->id)}}" method="POST" enctype="multipart/form-data">
					                        {{csrf_field()}}


                                      @include('includes.admin.form-both')

                                        <!--    <button class="tablink" onclick="openPage('Home', this, '#1F224F')" id="defaultOpen">{{ __('WebSite Setting') }}</button>
                                            <button class="tablink" onclick="openPage('News', this, '#1F224F')" >{{ __('Mobile Setting') }}</button>
                                            
                                            
                                            <div id="Home" class="tabcontent">
                                                
                                                
                                       
                                            
											
                                            </div>
                                             <div id="News" class="tabcontent">
                                             
                                                     
                                             
                                            </div>

                                            
                                            
                                            
                                            -->
                                             <div class="tabs">
                                              <div class="tab-2">
                                                <label for="tab2-1" class="label" 
                                                
                                                 @if($gs->light_dark == 0) 
                                                style=" 
                                                color: #fff;
                                                cursor: pointer;
                            display: block;
                            font-size: 1.1em;
                            font-weight: 800;
                            line-height: 1em;
                            padding: 2rem 0;
                            text-align: center;"
                            @else
                             style=" 
                                                color: black;
                                                cursor: pointer;
                            display: block;
                            font-size: 1.1em;
                            font-weight: 800;
                            line-height: 1em;
                            padding: 2rem 0;
                            text-align: center;"
                            
                            @endif
                            
                            
                            
                            >{{ __('WebSite Setting') }}</label>
                                                   <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
                                                <div>
                                                	<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product Name') }}* </h4>
																<p class="sub-heading">{{ __('(In Any Language)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Enter Product Name') }}" name="name" required="" value="{{ $data->name }}">
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product Arabic Name') }}* </h4>
																<p class="sub-heading">{{ __('(Arabic)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Enter Product Arabic Name') }}" name="name_ar" required="" value="{{ $data->name_ar }}">
													</div>
												</div>
												
												
														<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product Alt') }}* </h4>
																<p class="sub-heading">{{ __('(In Any Language)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Enter Product ALt') }}" name="alt" required="" value="{{ $data->alt }}">
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product ALt') }}* </h4>
																<p class="sub-heading">{{ __('(Arabic)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Enter Product Arabic ALt') }}" name="alt_ar" required="" value="{{ $data->alt_ar }}">
													</div>
												</div>
												
												
												

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product Sku') }}* </h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Enter Product Sku') }}" name="sku" required="" value="{{ $data->sku }}">

							                            <div class="checkbox-wrapper">
							                              <input type="checkbox" name="product_condition_check" class="checkclick" id="conditionCheck" value="1" {{ $data->product_condition != 0 ? "checked":"" }}>
							                              <label for="conditionCheck">{{ __('Allow Product Condition') }}</label>
							                            </div>

													</div>
												</div>


						                        <div class="{{ $data->product_condition == 0 ? "showbox":"" }}">

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product Condition') }}*</h4>
														</div>
													</div>
													<div class="col-lg-7">
															<select name="product_condition">
				                                                  <option value="2" {{$data->product_condition == 2
                                                    ? "selected":""}}>{{ __('New') }}</option>
				                                                  <option value="1" {{$data->product_condition == 1
                                                    ? "selected":""}}>{{ __('Used') }}</option>
															</select>
													</div>

												</div>


						                        </div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Category') }}*</h4>
														</div>
													</div>
													<div class="col-lg-7">
															<select id="cat" name="category_id" required="">
																	<option>{{ __('Select Category') }}</option>

                                              @foreach($cats as $cat)
                                                  <option data-href="{{ route('admin-subcat-load',$cat->id) }}" value="{{$cat->id}}" {{$cat->id == $data->category_id ? "selected":""}} >{{$cat->name}}</option>
                                              @endforeach
						                                     </select>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Sub Category') }}*</h4>
														</div>
													</div>
													<div class="col-lg-7">
															<select id="subcat" name="subcategory_id">
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

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Child Category') }}*</h4>
														</div>
													</div>
													<div class="col-lg-7">
															<select id="childcat" name="childcategory_id" {{$data->subcategory_id == null ? "disabled":""}}>
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

                                            	<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Brands') }}*</h4>
														</div>
													</div>
													<div class="col-lg-7">
															<select id="brand" name="brand_id">
                                                  				<option value="">{{ __('Select Brand') }}</option>
                                                  				    @foreach($brands as $b)
                                                  				        <option value="{{$b->id}}" {{$b->id == $data->brand_id ? 'selected' : ""}}>{{$b->name}}</option>
                                                  				    @endforeach
															</select>
													</div>
												</div>
							                     <div class="row">
							                        <div class="col-lg-4">
							                          <div class="left-area">
							                              <h4 class="heading">{{ __('Feature Image') }} *</h4>
							                          </div>
							                        </div>
							                        <div class="col-lg-7">
	<div class="row">
	<div class="panel panel-body">
		<div class="span4 cropme text-center" id="landscape" style="width: 400px; height: 400px; border: 1px dashed black;">
		</div>
		</div>
	</div>

			<a href="javascript:;" id="crop-image" class="d-inline-block mybtn1">
				<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
			</a>


							                        </div>
							                      </div>

							                      <input type="hidden" id="feature_photo" name="photo" value="{{ $data->photo }}" accept="image/*">

											
											
											                        <!--image-->
                               @if($gs->templatee_select == 2)
                                              <div class="row">
							                        <div class="col-lg-4">
							                          <div class="left-area">
							                              <h4 class="heading">{{ __('Feature Hover Image') }} *</h4>
							                          </div>
							                        </div>
							                        <div class="col-lg-7">
                                                	<div class="row">
                                                	<div class="panel panel-body">
                                                		<img class="span4 mobile text-center" id="landscapes2" src="{{asset('assets/images/products/'.$data->hover_photo)}}" style="width: 400px; height: 400px; border: 1px dashed black;">
                                                         
                                                </div>
                                                	</div>
                                                
                                                		<!--	<a href="javascript:;" id="crop-image" class="d-inline-block mybtn1">
                                                				<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
                                                			</a>
-->                         <input class="d-inline-block mybtn1" type="file" onchange="document.getElementById('landscapes2').src = window.URL.createObjectURL(this.files[0])" id="hover_photo" name="hover_photo" value="{{ $data->hover_photo }}">

							                        </div>
							                      </div>
							                      
							             @endif
											
											
											
											
											
											
											
											
											
											
											
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">
																	{{ __('Product Gallery Images') }} *
																</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<a href="javascript" class="set-gallery set-gallery-web"  data-toggle="modal" data-target="#setgallery">
															<input type="hidden" value="{{$data->id}}">
																<i class="icofont-plus"></i> {{ __('Set Gallery') }}
														</a>
													</div>
												</div>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">

														</div>
													</div>
													<div class="col-lg-7">
														<ul class="list">
															<li>
																<input  name="shipping_time_check" type="checkbox" id="check1" value="1" {{$data->ship != null ? "checked":""}}>
																<label for="check1">{{ __('Allow Estimated Shipping Time') }}</label>
															</li>
														</ul>
													</div>
												</div>



						                        <div class="{{ $data->ship != null ? "":"showbox" }}">

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product Estimated Shipping Time') }}* </h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Estimated Shipping Time') }}" name="ship" value="{{ $data->ship == null ? "" : $data->ship }}">
													</div>
												</div>


						                        </div>

											        <div class="row">
													<div class="col-lg-4">
														<div class="left-area">

														</div>
													</div>
													<div class="col-lg-7">
														<ul class="list">
															<li>
																<input name="size_check" type="checkbox" id="size-check" value="1" {{ !empty($data->size) ? "checked":"" }}>
																<label for="size-check">{{ __('Allow Product Sizes') }}</label>
															</li>
														</ul>
													</div>
												</div>
													<div class="{{ !empty($data->size) ? "":"showbox" }}" id="size-display">
													<div class="row">
															<div  class="col-lg-4">
															</div>
															<div  class="col-lg-7">
																<div class="product-size-details" id="size-section">
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
																					<input type="text" name="size[]" class="input-field space" placeholder="Size Name" value="{{ $data->size[$key] }}">
																				</div>
																				<div class="col-md-4 col-sm-6">
																						<label>
																							{{ __('Size Qty') }} :
																							<span>
																								{{ __('(Number of quantity of this size)') }}
																							</span>
																						</label>
																					<input type="number" name="size_qty[]" class="input-field" placeholder="Size Qty"  value="{{!empty($data->size_qty) ? $data->size_qty[$key] : "" }}">
																				</div>
																				<div class="col-md-4 col-sm-6">
																						<label>
																							{{ __('Size Price') }} :
																							<span>
																								{{ __('(This price will be added with base price)') }}
																							</span>
																						</label>
																					<input type="number" name="size_price[]" class="input-field" placeholder="{{ __('Size Price') }}"  value="{{!empty($data->size_price) ? $data->size_price[$key] : "" }}">
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
																					<input type="text" name="size[]" class="input-field space" placeholder="Size Name">
																				</div>
																				<div class="col-md-4 col-sm-6">
																						<label>
																							{{ __('Size Qty') }} :
																							<span>
																								{{ __('(Number of quantity of this size)') }}
																							</span>
																						</label>
																					<input type="number" name="size_qty[]" class="input-field" placeholder="Size Qty" value="1" min="1">
																				</div>
																				<div class="col-md-4 col-sm-6">
																						<label>
																							{{ __('Size Price') }} :
																							<span>
																								{{ __('(This price will be added with base price)') }}
																							</span>
																						</label>
																					<input type="number" name="size_price[]" class="input-field" placeholder="Size Price" value="0" min="0">
																				</div>
																			</div>
																		</div>
																	@endif
																</div>

																<a href="javascript:;" id="size-btn" class="add-more"><i class="fas fa-plus"></i>{{ __('Add More Size') }} </a>
															</div>
													</div>
												</div>


                                                <!-- Color Size -->
                                                 <div class="row">
													<div class="col-lg-4">
														<div class="left-area">

														</div>
													</div>
													<div class="col-lg-7">
														<ul class="list">
															<li>
																<input name="size_color_check" type="checkbox" id="size-color-check" value="1" {{ count($colors) > 0 ? "checked":"" }}>
																<label for="size-color-check">{{ __('Allow Product Colors By Sizes') }}</label>
															</li>
														</ul>
													</div>
												</div>
													<div class="{{ count($colors) > 0 ? "":"showbox" }}" id="size-color-display">
													<div class="row">
															<div  class="col-lg-4">
															</div>
															<div  class="col-lg-7">
																<div class="product-size-details" id="size-color-section">
																@if(!empty($colors))
																	 @foreach($colors as $dataa)
																		<div class="size-area">
																		<span class="remove size-remove"><i class="fas fa-times"></i></span>
																		<div  class="row">
																				<div class="col-md-4 col-sm-4">
																					<label>
																						{{ __('Size Name') }} :
																						<span>
																							{{ __('(eg. S,M,L,XL,XXL,3XL,4XL)') }}
																						</span>
																					</label>
																					<input type="text" name="size_color[]" class="input-field space" placeholder="Size Name" value="{{ $dataa->size }}">
																				</div>
																			<div  class="col-md-4 col-sm-4">
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
														        		<div  class="col-md-4 col-sm-4">
																		<label>
																						{{ __('Color Qty') }} :
																					
																					</label>
																		<div class="color-area">
																			
											                                <div class="input-group ">
											                                  <input type="text" name="color_qty[]" value="{{ $dataa->size_qty }}"  class="input-field "/>
											                                 
											                                </div>
											                         	</div>
											                         
														        	</div>
														        		<div  class="col-md-4 col-sm-4">
																		<label>
																						{{ __('Color Price') }} :
																					
																					</label>
																		<div class="color-area">
																			
											                                <div class="input-group ">
											                                  <input type="number" name="color_price[]" value="{{ $dataa->size_price }}" min="0"  class="input-field "/>
											                                 
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
																				<div class="col-md-4 col-sm-4">
																					<label>
																						{{ __('Size Name') }} :
																						<span>
																							{{ __('(eg. S,M,L,XL,XXL,3XL,4XL)') }}
																						</span>
																					</label>
																					<input type="text" name="size_color[]" class="input-field space"  placeholder="Size Name">
																				</div>
																	<div  class="col-md-4 col-sm-4">
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
														        	
														        		<div  class="col-md-4 col-sm-4">
																		<label>
																						{{ __('Color Qty') }} :
																					
																					</label>
																		<div class="color-area">
																			
											                                <div class="input-group ">
											                                  <input type="text" name="color_qty[]" value="0"  class="input-field "/>
											                                 
											                                </div>
											                         	</div>
											                         
														        	</div>
														        	
														        		<div  class="col-md-4 col-sm-4">
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

																<a href="javascript:;" id="size-color-btn" class="add-more"><i class="fas fa-plus"></i>{{ __('Add More Color For Sizes') }} </a>
															</div>
													</div>
												</div>
                                                
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">

														</div>
													</div>
													<div class="col-lg-7">
														<ul class="list">
															<li>
																<input class="checkclick1" name="color_check" type="checkbox" id="check3" value="1" {{ !empty($data->color) ? "checked":"" }}>
																<label for="check3">{{ __('Allow Product Colors') }}</label>
															</li>
														</ul>
													</div>
												</div>



						                        <div class="{{ !empty($data->color) ? "":"showbox" }}" id="colors-display">

													<div class="row">
														@if(!empty($data->color))
															<div  class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">
																		{{ __('Product Colors') }}*
																	</h4>
																	<p class="sub-heading">
																		{{ __('(Choose Your Favorite Colors)') }}
																	</p>
																</div>
															</div>
															<div  class="col-lg-7">
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
																	<a href="javascript:;" id="color-btn" class="add-more mt-4 mb-3"><i class="fas fa-plus"></i>{{ __('Add More Color') }} </a>
															</div>
														@else
															<div  class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">
																		{{ __('Product Colors') }}*
																	</h4>
																	<p class="sub-heading">
																		{{ __('(Choose Your Favorite Colors)') }}
																	</p>
																</div>
															</div>
															<div  class="col-lg-7">
																	<div class="select-input-color" id="color-section">
																		<div class="color-area">
																			<span class="remove color-remove"><i class="fas fa-times"></i></span>
											                                <div class="input-group colorpicker-component cp">
											                                  <input type="text" name="color[]" value="#000000"  class="input-field cp"/>
											                                  <span class="input-group-addon"><i></i></span>
											                                </div>
											                         	</div>
											                         </div>
																	<a href="javascript:;" id="color-btn" class="add-more mt-4 mb-3"><i class="fas fa-plus"></i>{{ __('Add More Color') }} </a>
															</div>


														@endif
													</div>

						                        </div>



												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">

														</div>
													</div>
													<div class="col-lg-7">
														<ul class="list">
															<li>
																<input class="checkclick1" name="whole_check" type="checkbox" id="whole_check" value="1" {{ !empty($data->whole_sell_qty) ? "checked":"" }}>
																<label for="whole_check">{{ __('Allow Product Whole Sell') }}</label>
															</li>
														</ul>
													</div>
												</div>

						                    <div class="{{ !empty($data->whole_sell_qty) ? "":"showbox" }}">
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">

														</div>
													</div>
													<div class="col-lg-7">
														<div class="featured-keyword-area">
															<div class="feature-tag-top-filds" id="whole-section">
																@if(!empty($data->whole_sell_qty))

																	 @foreach($data->whole_sell_qty as $key => $data1)

																<div class="feature-area">
																	<span class="remove whole-remove"><i class="fas fa-times"></i></span>
																	<div class="row">
																		<div class="col-lg-6">
																		<input type="number" name="whole_sell_qty[]" class="input-field" placeholder="{{ __('Enter Quantity') }}" min="0" value="{{ $data->whole_sell_qty[$key] }}" required="">
																		</div>

																		<div class="col-lg-6">
											                            <input type="number" name="whole_sell_discount[]" class="input-field" placeholder="{{ __('Enter Discount Percentage') }}" min="0" value="{{ $data->whole_sell_discount[$key] }}" required="">
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

															<a href="javascript:;" id="whole-btn" class="add-fild-btn"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>
														</div>
													</div>
												</div>
											</div>
                                        <div class="row">
													<div class="col-lg-4">
														<div class="left-area">

														</div>
													</div>
													<div class="col-lg-7">
														<ul class="list">
															<li>
																<input class="free_ship" name="free_ship" type="checkbox" id="free_ship" value="1" {{$data->free_ship == 1 ? "checked" : ""}}>
																<label for="free_ship">{{ __('Free Shipping') }}</label>
															</li>
														</ul>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">
																{{ __('Product Current Price') }}*
															</h4>
															<p class="sub-heading">
															 @if(!empty($sign->name))
																({{ __('In') }} {{$sign->name}})
															 @endif
															</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="price" type="number" class="input-field" placeholder="e.g 20" step="0.1" min="0" value="{{round($data->price * $sign->value , 2)}}" required="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product Previous Price') }}*</h4>
																<p class="sub-heading">{{ __('(Optional)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="previous_price" step="0.1" type="number" class="input-field" placeholder="e.g 20" value="{{round($data->previous_price * $sign->value , 2)}}" min="0">
													</div>
												</div>
												<div class="" id="stckprod">
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product Stock') }}*</h4>
																<p class="sub-heading">{{ __('(Leave Empty will Show Always Available)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="stock" type="text" class="input-field" placeholder="e.g 20" value="{{ $data->stock }}">
														<div class="checkbox-wrapper">
															<input type="checkbox" name="measure_check" class="checkclick1" id="allowProductMeasurement" value="1" {{ $data->measure == null ? '' : 'checked' }}>
															<label for="allowProductMeasurement">{{ __('Allow Product Measurement') }}</label>
														</div>
													</div>
												</div>

												</div>

											<div class="{{ $data->measure == null ? 'showbox' : '' }}">

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product Measurement') }}*</h4>
														</div>
													</div>
													<div class="col-lg-3">
															<select id="product_measure">
			                                                  <option value="" {{$data->measure == null ? 'selected':''}}>{{ __('None') }}</option>
			                                                  <option value="Gram" {{$data->measure == 'Gram' ? 'selected':''}}>{{ __('Gram') }}</option>
			                                                  <option value="Kilogram" {{$data->measure == 'Kilogram' ? 'selected':''}}>{{ __('Kilogram') }}</option>
			                                                  <option value="Litre" {{$data->measure == 'Litre' ? 'selected':''}}>{{ __('Litre') }}</option>
			                                                  <option value="Pound" {{$data->measure == 'Pound' ? 'selected':''}}>{{ __('Pound') }}</option>
			                                                  <option value="Custom" {{ in_array($data->measure,explode(',', 'Gram,Kilogram,Litre,Pound')) ? '' : 'selected' }}>{{ __('Custom') }}</option>
						                                     </select>
													</div>
													<div class="col-lg-1"><input name="scale" type="number"  class="input-field"  min="1" value="{{$data->scale}}"></div>
													<div class="col-lg-3 {{ in_array($data->measure,explode(',', 'Gram,Kilogram,Litre,Pound')) ? 'hidden' : '' }}" id="measure">
														<input name="measure" type="text" id="measurement" class="input-field" placeholder="Enter Unit" value="{{$data->measure}}">
													</div>
												</div>

											</div>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">
																	{{ __('Product Description') }}*
															</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="text-editor">
															<textarea name="details" class="ckeditor form-control">{{$data->details}}</textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">
																	{{ __('Product Arabic Description') }}*
															</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="text-editor">
															<textarea name="details_ar" class="ckeditor form-control">{{$data->details_ar}}</textarea>
														</div>
													</div>
												</div>



												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">
																	{{ __('Product Buy/Return Policy') }}*
															</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="text-editor">
															<textarea name="policy" class="ckeditor form-control">{{$data->policy}}</textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">
																	{{ __('Product Arabic Buy/Return Policy') }}*
															</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="text-editor">
															<textarea name="policy_ar" class="ckeditor form-control">{{$data->policy_ar}}</textarea>
														</div>
													</div>
												</div>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Youtube Video URL') }}*</h4>
																<p class="sub-heading">{{ __('(Optional)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input  name="youtube" type="text" class="input-field" placeholder="Enter Youtube Video URL" value="{{$data->youtube}}">
						                            <div class="checkbox-wrapper">
						                              <input type="checkbox" name="seo_check" value="1" class="checkclick" id="allowProductSEO" {{ ($data->meta_tag != null || strip_tags($data->meta_description) != null) ? 'checked':'' }}>
						                              <label for="allowProductSEO">{{ __('Allow Product SEO') }}</label>
						                            </div>
													</div>
												</div>



						                        <div class="{{ ($data->meta_tag == null && strip_tags($data->meta_description)  == null && $data->title == null  && $data->title_ar == null  ) ? "showbox":"" }}">
						                          
						                          
						                          <div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product Title') }}* </h4>
																<p class="sub-heading">{{ __('(In Any Language)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Enter Product Title') }}" name="title"  value="{{ $data->title }}" >
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Product title') }}* </h4>
																<p class="sub-heading">{{ __('(Arabic)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Enter Product Arabic Title') }}" name="title_ar" value="{{ $data->title_ar }}" >
													</div>
												</div>
						                          
						                          
						                          
						                          <div class="row">
						                            <div class="col-lg-4">
						                              <div class="left-area">
						                                  <h4 class="heading">{{ __('Meta Tags') }} *</h4>
						                              </div>
						                            </div>
						                            <div class="col-lg-7">
						                              <ul id="metatags" class="myTags">
						                              	@if(!empty($data->meta_tag))
							                                @foreach ($data->meta_tag as $element)
							                                  <li>{{  $element }}</li>
							                                @endforeach
						                                @endif
						                              </ul>
						                            </div>
						                          </div>

						                          <div class="row">
						                            <div class="col-lg-4">
						                              <div class="left-area">
						                                <h4 class="heading">
						                                    {{ __('Meta Description') }} *
						                                </h4>
						                              </div>
						                            </div>
						                            <div class="col-lg-7">
						                              <div class="text-editor">
						                                <textarea name="meta_description" class="input-field" placeholder="{{ __('Details') }}">{{ $data->meta_description }}</textarea>
						                              </div>
						                            </div>
						                          </div>
						                          <div class="row">
						                            <div class="col-lg-4">
						                              <div class="left-area">
						                                <h4 class="heading">
						                                    {{ __('Arabic Meta Description') }} *
						                                </h4>
						                              </div>
						                            </div>
						                            <div class="col-lg-7">
						                              <div class="text-editor">
						                                <textarea name="meta_description_ar" class="input-field" placeholder="{{ __('Arabic Details') }}">{{ $data->meta_description_ar }}</textarea>
						                              </div>
						                            </div>
						                          </div>
						                          
						                          
						                           <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                                <h4 class="heading">{{ __('Tags') }} *</h4>
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <ul id="tags" class="myTags">
						                            	@if(!empty($data->tags))
							                                @foreach ($data->tags as $element)
							                                  <li>{{  $element }}</li>
							                                @endforeach
						                                @endif
						                            </ul>
						                          </div>
						                        </div>
						                        
						                        
						                              <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                                <h4 class="heading">{{ __('Arabic Tags') }} *</h4>
						                            </div>
						                          </div>
						                          <div class="col-lg-7" >
						                              
						                              
						                            <ul id="atags" class="myTags" >
						                                 
											 <li>{{$data->tags_ar }}    </li>                             
											                               
											                               
						                            </ul>
						                          </div>
						                        </div>
						                          
						                          
						                          
						                          
						                        </div>  
						                        
						                        
						                        
						                        	<!--<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															
														</div>
													</div>
													<div class="col-lg-7">
													
						                            <div class="checkbox-wrapper">
						                              <input type="checkbox" name="feature" value="1" class="checkclick3" id="allowProductfeature" {{ ($data->feature != 0) ? 'checked':'' }}>
						                              <label for="allowProductfeature">{{ __('Allow Product feature settings ') }}</label>
						                            </div>
													</div>
												</div>
						                        -->
						                        
						                  <!--      <div class="{{ $data->feature == 0  ? "showbox " :" " }} subs" >
						                          <div class="row">
						                            <div class="col-lg-4">
						                              <div class="left-area">
						                                  <h4 class="heading">{{ __('Subscription type') }}: </h4>
						                              </div>
						                            </div>
						                            <div class="col-lg-7">
						                           <select name="subscription_type" class>
						                               <option value="Days" {{$data->subscription_type == "Days" ? "selected" : ""}}>Days</option>
						                               <option value="Months" {{$data->subscription_type == "Months" ? "selected" : ""}}>Months</option>
						                               <option value="Years" {{$data->subscription_type == "Years" ? "selected" : ""}}>Years</option>
						                           </select>
						                            </div>
						                          </div>

						                          <div class="row">
						                            <div class="col-lg-4">
						                              <div class="left-area">
						                                <h4 class="heading">
						                                    {{ __('subscription period') }} :
						                                </h4>
						                              </div>
						                            </div>
						                            <div class="col-lg-7">
						                              <div class="text-editor">
						                                <input name="subscription_period" type="number" min="0" class="input-field" placeholder="{{ __('subscription period') }}" value="{{ $data->subscription_period }}">
						                              </div>
						                            </div>
						                          </div>     
						                          
						                          <div class="row">
						                            <div class="col-lg-4">
						                              <div class="left-area">
						                                <h4 class="heading">
						                                    {{ __('subscription trial period') }} :
						                                </h4>
						                              </div>
						                            </div>
						                            <div class="col-lg-7">
						                              <div class="text-editor">
						                                <input name="trial_period" type="number" min="0" class="input-field" placeholder="{{ __('trial period') }}" value="{{ $data->trial_period }}">
						                              </div>
						                            </div>
						                          </div>
						                    
						                        </div>-->

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">

														</div>
													</div>
													<div class="col-lg-7">
														<div class="featured-keyword-area">
															<div class="heading-area">
																<h4 class="title">{{ __('Feature Tags') }}</h4>
															</div>

															<div class="feature-tag-top-filds" id="feature-section">
																@if(!empty($data->features))

																	 @foreach($data->features as $key => $data1)

																<div class="feature-area">
																	<span class="remove feature-remove"><i class="fas fa-times"></i></span>
																	<div class="row">
																		<div class="col-lg-6">
																		<input type="text" name="features[]" class="input-field" placeholder="{{ __('Enter Your Keyword') }}" value="{{ $data->features[$key] }}">
																		</div>

																		<div class="col-lg-6">
											                                <div class="input-group colorpicker-component cp">
											                                  <input type="text" name="colors[]" value="{{ $data->colors[$key] }}" class="input-field cp"/>
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
																		<input type="text" name="features[]" class="input-field" placeholder="{{ __('Enter Your Keyword') }}">
																		</div>

																		<div class="col-lg-6">
											                                <div class="input-group colorpicker-component cp">
											                                  <input type="text" name="colors[]" value="#000000" class="input-field cp"/>
											                                  <span class="input-group-addon"><i></i></span>
											                                </div>
																		</div>
																	</div>
																</div>

																@endif
															</div>

															<a href="javascript:;" id="feature-btn" class="add-fild-btn"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>
														</div>
													</div>
												</div>


						                  
                                            	<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Related Products") }} :</h4>
														</div>
													</div>
													<div class="col-lg-7">
															
																	
						                                               <select class="form-control" name="related[]" multiple="multiple"
                                                                            >
						                                                
                                                                        @forelse($pro as $app)
                                                                            <option value="{{$app->id}}">{{$app->name}}</option>
                                    
                                                                        @empty
                                    
                                                                        @endforelse
                                                                    </select>
						                                    
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															
														</div>
													</div>
													<div class="col-lg-7">
														<table class="table">
                                                                  <thead class="thead-dark">
                                                                    <tr>
                                                                      <th style="padding: 7px;" scope="col">#</th>
                                                                      <th scope="col">Product Name</th>
                                                                     
                                                                      <th scope="col">Action</th>
                                                                    </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                    @forelse($Related as $key=>$r)  
                                                                    @php 
                                                                    $p = App\Models\Product::where('id',$r->related_id)->first();
                                                                    @endphp
                                                                    <tr>
                                                                      <th style="padding: 7px;" scope="row">{{$key+1}}</th>
                                                                       @if($p)  <td>{{$p->name}}</td> @else  <td>Product Deleted</td> @endif 
                                                                      
                                                                      <td><a href="{{route('admin-related-delete',$r->id)}}"  class="delete"><i class="fas fa-trash-alt"></i> </a></td>
                                                                    </tr>
                                                                   @empty
                                                                    <tr style="text-align: center;">
                                                                      <th colspan="3" style="text-align: center;" scope="row" >No Related Product</th>
                                                                     
                                                                    </tr>
                                                                   
                                                                   @endforelse
                                                                  </tbody>
                                                                </table>	
																	
						                                             
						                                    
													</div>
												</div>

                                            <div class="row">
													<div class="col-lg-4">
														<div class="left-area">

														</div>
													</div>
													<div class="col-lg-7 text-center">
														<button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
													</div>
												</div>

                                                </div>
                                              </div>
                                              
                                              
                                              <div class="tab-2">
                                                <label for="tab2-2" class="label" 
                                                
                                                 @if($gs->light_dark == 0) 
                                                
                                                
                                                style="color: #fff; cursor: pointer;
                                                    display: block;
                                                    font-size: 1.1em;
                                                    font-weight: 800;
                                                    line-height: 1em;
                                                    padding: 2rem 0;
                                                    text-align: center;"
                                                    
                                                 @else
                                                 
                                                   style="color: black; cursor: pointer;
                                                    display: block;
                                                    font-size: 1.1em;
                                                    font-weight: 800;
                                                    line-height: 1em;
                                                    padding: 2rem 0;
                                                    text-align: center;"
                                                 
                                                 @endif
                                                    
                                                    
                                                    >{{ __('Mobile Setting') }}</label>
                                                <input id="tab2-2" name="tabs-two" type="radio">
                                                <div>
                                                 
                                                 <div class="row">
							                        <div class="col-lg-4">
							                          <div class="left-area">
							                              <h4 class="heading">{{ __('Feature Image') }} *</h4>
							                          </div>
							                        </div>
							                        <div class="col-lg-7">
                            	<div class="row">
                            	<div class="panel panel-body">
                            		<img class="span4 cropme2 mobile text-center" src="{{ empty($data->mobile_photo) ? asset('assets/images/noimage.png') : filter_var($data->mobile_photo, FILTER_VALIDATE_URL) ? $data->mobile_photo : asset('assets/images/products/'.$data->mobile_photo) }}" id="landscapes" style="width: 400px; height: 400px; border: 1px dashed black;">
                            		
                            		</div>
                            	</div>

                    		<!--	<a href="javascript:;" id="crop-images" class="d-inline-block mybtn1"></a>
                    				<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}-->
                    			    <input class="d-inline-block mybtn1" type="file" onchange="document.getElementById('landscapes').src = window.URL.createObjectURL(this.files[0])" id="feature_mobile_photo" name="mobile_photo" value="{{ $data->mobile_photo }}">
                    			
                    			


							                        </div>
							                      </div>

							                     

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">
																	{{ __('Product Gallery Images') }} *
																</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<a href="javascript" class="set-gallery set-gallery-mobile"  data-toggle="modal" data-target="#setgallerymobile">
															<input type="hidden" id="id_mobile" value="{{$data->id}}">
															
																<i class="icofont-plus"></i> {{ __('Set Gallery') }}
														</a>
														
													</div>
												</div>

 	<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">
																{{ __('Product Mobile Current Price') }}*
															</h4>
															<p class="sub-heading">
																({{ __('In') }} {{$sign->name}})
															</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="mobile_price" type="number" class="input-field" placeholder="{{ __('e.g 20') }}" step="0.1"  min="0" value="{{$data->mobile_price}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">
																	{{ __('Product Mobile Description') }}*
															</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="text-editor">
															<textarea name="mobile_details" style="height: 93px;width: 378px;">{{$data->mobile_details}}</textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">
																	{{ __('Product Mobile Arabic Description') }}*
															</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="text-editor">
															<textarea name="mobile_details_ar" style="height: 93px;width: 378px;">{{$data->mobile_details_ar}}</textarea>
														</div>
													</div>
												</div>



												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">
																	{{ __('Product Buy/Return Policy') }}*
															</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="text-editor">
															<textarea name="mobile_policy" style="height: 93px;width: 378px;">{{$data->mobile_policy}}</textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">
																	{{ __('Product Arabic Mobile Buy/Return Policy') }}*
															</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="text-editor">
															<textarea name="mobile_policy_ar" style="height: 93px;width: 378px;">{{$data->mobile_policy_ar}}</textarea>
														</div>
													</div>
												</div>

                                             <!--   <div class="row">
													<div class="col-lg-4">
														<div class="left-area">

														</div>
													</div>
													<div class="col-lg-7 text-center">
														<button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
													</div>
												</div>-->
                                                 
                                                </div>
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

		<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="top-area">
						<div class="row">
							<div class="col-sm-6 text-right">
								<div class="upload-img-btn">
									<form  method="POST" enctype="multipart/form-data" id="form-gallery">
										{{ csrf_field() }}
									<input type="hidden" id="pid" name="product_id" value="">
									<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
											<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
									</form>
								</div>
							</div>
							<div class="col-sm-6">
								<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
							</div>
							<div class="col-sm-12 text-center">( <small>{{ __('You can upload multiple Images.') }}</small> )</div>
						</div>
					</div>
					<div class="gallery-images">
						<div class="selected-image">
							<div class="row">


							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="setgallerymobile" tabindex="-1" role="dialog" aria-labelledby="setgallerymobile" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="top-area">
						<div class="row">
							<div class="col-sm-6 text-right">
								<div class="upload-img-btn">
									<form  method="POST" enctype="multipart/form-data" id="form-gallery-mobile">
										{{ csrf_field() }}
									<input type="hidden" id="pidd" name="product_id" value="">
									<input type="file" name="gallery[]" class="hidden" id="uploadgallerymobile" accept="image/*" multiple>
											<label for="image-upload" id="prod_gallery_mobile"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
									</form>
								</div>
							</div>
							<div class="col-sm-6">
								<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
							</div>
							<div class="col-sm-12 text-center">( <small>{{ __('You can upload multiple Images.') }}</small> )</div>
						</div>
					</div>
					<div class="gallery-images">
						<div class="selected-image">
							<div class="row">


							</div>
						</div>
					</div>
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
    $('#uploadgallery').click();
  });
 $(document).on('click', '#prod_gallery_mobile' ,function() {
    $('#uploadgallerymobile').click();
  });


  $("#uploadgallery").change(function(){
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

    let html = `<img src="{{ empty($data->photo) ? asset('assets/images/noimage.png') : filter_var($data->photo, FILTER_VALIDATE_URL) ? $data->photo : asset('assets/images/products/'.$data->photo) }}" alt="">`;
    $(".span4.cropme").html(html);  
    
    let htmls = `<img src="{{ empty($data->mobile_photo) ? asset('assets/images/noimage.png') : filter_var($data->mobile_photo, FILTER_VALIDATE_URL) ? $data->mobile_photo : asset('assets/images/products/'.$data->mobile_photo) }}" alt="">`;
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


 <script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
       
    });
</script>
@endsection
