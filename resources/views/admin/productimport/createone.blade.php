@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>
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
                <li class="breadcrumb-item"><a href="{{ route('admin-import-index') }}">{{ __("All Affiliate Products") }}</a></li>
                <li class="breadcrumb-item">{{ __("Add Affiliate Product") }}</li>
            </ol>
        </nav>
    </div>
	<div class="add-product-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
			        <div class="body-area" style="background: #f2f3f8;padding: 0">
                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        <form id="geniusform" action="{{route('admin-import-store')}}" method="POST" class="exp-form" enctype="multipart/form-data">
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
    														<label>{{ __('Product Name') }}* </label>
        													<input type="text" class="form-control" placeholder="{{ __('Enter Product Arabic Name') }}" name="name_ar" required="">
        												</div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product ALt') }}* </label>
    													    <input type="text" class="form-control" placeholder="{{ __('Enter Product Arabic ALt') }}" name="alt_ar" required="">
    												    </div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product Description') }}*</label>
        													<div class="text-editor">
        														<textarea class="nic-edit-p form-control" name="details"></textarea>
        													</div>
    													</div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product Buy/Return Policy') }}*</label>
        													<div class="text-editor">
        														<textarea class="nic-edit-p form-control" name="policy"></textarea>
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
    														<input type="text" class="form-control" placeholder="{{ __('Enter Product Name') }}" name="name" required="">
    													</div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product ALt') }}* </label>
    														<input type="text" class="form-control" placeholder="{{ __('Enter Product ALt') }}" name="alt" required="">
    													</div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product Description') }}*</label>
        													<div class="text-editor">
        														<textarea class="nic-edit-p form-control" name="details"></textarea>
        													</div>
    													</div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product Buy/Return Policy') }}*</label>
        													<div class="text-editor">
        														<textarea class="nic-edit-p form-control" name="policy"></textarea>
        													</div>
    													</div>
    												</div>
    											</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Arabic & English inputs-->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __("Feature Image Source") }}* <small>{{ $langg->lang971 }}</small></label>
                                            <select id="imageSource" name="image_source" class="form-control">
                                  				<option value="file">{{ __("File") }}</option>
                                  				<option value="link">{{ __("Link") }}</option>
											</select>
                                        </div>
                                        <div class="form-group" id="f-file">
                                            <label>{{ __('Feature Image') }} * <small>{{ __('image size') }} 205px X 205px</small></label>
                                            <div class="panel panel-body">
                                        		<div class="span4 cropme d-flex align-items-center justify-content-center" id="landscape" style="overflow: hidden; width: 100%; height: 400px; border: 1px dashed black;">
                                        		    <div class="text-center">
                                        		        <i class="far fa-images"></i>
                                        		        <p>{{ __('Upload Image') }}</p>
                                        		    </div>
                                        		</div>
                                    		</div>
                                        </div>
    			                        <input type="hidden" id="feature_photo" name="photo" value="">
    			                        <div id="f-link" class="form-group" style="display: none;">
    									    <label>{{ __("Feature Image Link ") }}*</label>
    										<input type="text" name="photolink" value="" class="form-control">
									  </div>
    			                        
        					            <input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
        							    <div class="row">
    				                        <div class="col-lg-12">
                                                <div class="form-group">
        											<label>{{ __('Product Gallery Images') }} * <small>{{ __('You can upload multiple Images.') }} - {{ __('image size') }} 205px X 205px</small></label>
        											<a href="#" class="set-gallery-prod" data-bs-toggle="modal" data-bs-target="#setgallery">
            											<i class="fas fa-cloud-upload-alt me-2"></i> {{ __('Set Gallery') }}
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
                                                                <option data-href="{{ route('admin-subcat-load',$cat->id) }}" value="{{ $cat->id }}">{{$cat->name}}</option>
        		                                            @endforeach
        			                                     </select>
        											</div>
        										</div>
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Sub Category') }}*</label>
        												<select id="subcat" name="subcategory_id" disabled="" class="form-control">
        													<option value="">{{ __('Select Sub Category') }}</option>
        			                                     </select>
        											</div>
        										</div>
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Child Category') }}*</label>
        												<select id="childcat" name="childcategory_id" disabled="" class="form-control">
                                              				<option value="">{{ __('Select Child Category') }}</option>
        												</select>
        											</div>
        										</div>
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Product Sku') }}* </label>
        												<input type="text" class="form-control" placeholder="{{ __('Enter Product Sku') }}" name="sku" required="" value="{{ str_random(3).substr(time(), 6,8).str_random(3) }}">
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
        						                              <input type="checkbox" name="product_condition_check" class="checkclick" id="conditionCheck" value="1">
        						                              <label for="conditionCheck">{{ __('Allow Product Condition') }}</label>
        						                            </div>
        					                            </div>
        				                            </div>
        											<div class="showbox">
        												<div class="col-lg-12 p-0">
        													<div class="form-group">
            													<select name="product_condition" class="form-control">
                                                                    <option value="2">{{ __('New') }}</option>
                                                                    <option value="1">{{ __('Used') }}</option>
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
                    												<input  name="shipping_time_check" type="checkbox" id="check1" value="1">
                    												<label for="check1">{{ __('Allow Estimated Shipping Time') }}</label>
                    											</li>
                    										</ul>
                										</div>
            										</div>
                    		                        <div class="showbox">
                										<div class="col-lg-12 p-0">
                											<div class="form-group">
                												<label>{{ __('Product Estimated Shipping Time') }}* </label>
                												<input type="text" class="form-control" placeholder="{{ __('Estimated Shipping Time') }}" name="ship">
                											</div>
                										</div>
                    		                        </div>
            									</div>
        										
        										<div class="col-lg-6">
        										    <div class="form-group">
            										    <div>
                    										<ul class="list">
                    											<li>
                    												<input name="size_check" type="checkbox" id="size-check" value="1">
                    												<label for="size-check">{{ __('Allow Product Sizes') }}</label>
                    											</li>
                    										</ul>
            									        </div>
        									        </div>
                    							    <div class="showbox mb-4" id="size-display">
                										<div  class="col-lg-12 p-0">
                    											<div class="product-size-details mb-0 pb-0" id="size-section">
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
                    											</div>
                    											<a href="javascript:;" id="size-btn" class="main-light-btn mb-4 text-white"><i class="fas fa-plus"></i>{{ __('Add More Size') }} </a>
                    										</div>
                    								</div>
            									</div>
            									<div class="col-lg-6">
        											<div class="form-group">
                                                        <div>
                                                            <ul class="list">
        														<li>
        															<input class="checkclick1" name="color_check" type="checkbox" id="check3" value="1">
        															<label for="check3">{{ __('Allow Product Colors') }}</label>
        														</li>
        													</ul>
                                                        </div>
        											</div>
        											<div class="showbox " id="colors-display">
                										<div class="col-lg-12 p-0">
                											<div class="form-group">
        														<p class="sub-heading">{{ __('(Choose Your Favorite Colors)') }}</p>
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
        												    @if(!empty($sign->name))
        													({{ __('In') }} {{$sign->name}})
        													@endif
        												</small>
        												</label>
        												<input name="price" type="number" class="form-control" placeholder="{{ __('e.g 20') }}" step="0.1" required="" min="0">
        											</div>
        										</div>
        										<div class="col-lg-6">
        											<div class="form-group">
        												<label>{{ __('Product Previous Price') }}* <small>{{ __('(Optional)') }}</small></label>
        												<input name="previous_price" step="0.1" type="number" class="form-control" placeholder="{{ __('e.g 20') }}" min="0">
        											</div>
        										</div>
        										<div class="col-lg-6" id="stckprod">
        											<div class="form-group">
        												<label>{{ __('Product Stock') }}* <small>{{ __('(Leave it empty it will appear out of stock)') }}</small></label>
        												<input name="stock" type="text" class="form-control" placeholder="{{ __('p.s 20') }}">
        											</div>
        										</div>
        										<div class="col-lg-6">
        										    <div>
        											    <div>
        													<div class="checkbox-wrapper form-group">
        														<input type="checkbox" name="measure_check" class="checkclick" id="allowProductMeasurement" value="1">
        														<label for="allowProductMeasurement">{{ __('Allow Product Measurement') }}</label>
        													</div>
        												</div>
        											</div>
        											<div class="showbox">
        												<div class="col-lg-12 p-0">
        													<div class="form-group">
        														<div class="row">
        														    <div class="col-lg-8">
                														<select id="product_measure" class="form-control">
                		                                                  <option value="">{{ __('None') }}</option>
                		                                                  <option value="Gram">{{ __('Gram') }}</option>
                		                                                  <option value="Kilogram">{{ __('Kilogram') }}</option>
                		                                                  <option value="Litre">{{ __('Litre') }}</option>
                		                                                  <option value="Pound">{{ __('Pound') }}</option>
                		                                                  <option value="Custom">{{ __('Custom') }}</option>
                					                                     </select>
                    												</div>
                    												<div class="col-lg-4"><input name="scale" type="number"  class="form-control"  min="1" value="1"></div>
                    												<div class="col-lg-12 hidden" id="measure">
                    													<input name="measure" type="text" id="measurement" class="form-control" placeholder="{{ __('Enter Unit') }}">
                    												</div>
        														</div>
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
        												<label>{{ __('Youtube Video URL') }}* <small>{{ __('(Optional)') }}</small></label>
        												<input  name="youtube" type="text" class="form-control" placeholder="{{ __('Enter Youtube Video URL') }}">
        											</div>
        										</div>
        										<div class="col-lg-6">
        										    <div>
        											    <div>
        						                            <div class="checkbox-wrapper form-group">
        						                              <input type="checkbox" name="seo_check" value="1" class="checkclick" id="allowProductSEO" value="1">
        						                              <label for="allowProductSEO">{{ __('Allow Product SEO') }}</label>
        						                            </div>
        					                            </div>
        				                            </div>
        				                            <div class="showbox">
        					                          <div class="row">
        					                            <div class="col-lg-12">
        					                              <div class="form-group">
        					                                  <label>{{ __('Meta Tags') }} *</label>
        					                                  <ul id="metatags" class="myTags">
        					                                </ul>
        					                              </div>
        					                            </div>
        					                          </div>
        					                          <div class="row">
        					                            <div class="col-lg-12">
        					                              <div class="form-group">
        					                                  <label>{{ __('Meta Description') }} *</label>
        					                                  <div class="text-editor">
            					                                <textarea name="meta_description" class="form-control" placeholder="{{ __('Meta Description') }}"></textarea>
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
        													</div>
        
        													<a href="javascript:;" id="feature-btn" class="main-light-btn mb-4 text-white"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>
        												</div>
        											</div>
        										</div>
        										<div class="col-lg-6">
        				                            <div class="form-group">
        				                                <label>{{ __('Tags') }} *</label>
        				                                <ul id="tags" class="myTags" >
        				                                             
        				                                </ul>
        				                            </div>
        			                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- End Box -->
                            </div>
                            <!-- End 2 Boxes -->
                            <input type="hidden" name="type" value="Physical">
							<div class="row">
								<div class="col-lg-12 text-center">
									<button class="main-light-btn py-3" type="submit">{{ __('Create Product') }} <i class="fas fa-check ms-3"></i></button>
								</div>
							</div>
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
						    <label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
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

@endsection

@section('scripts')

		<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
		<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

<script type="text/javascript">
	
// Gallery Section Insert

  $(document).on('click', '.remove-img' ,function() {
    var id = $(this).find('input[type=hidden]').val();
    $('#galval'+id).remove();
    $(this).parent().parent().remove();
  });

  $(document).on('click', '#prod_gallery' ,function() {
    $('#uploadgallery').click();
     $('.selected-image .row').html('');
    $('#geniusform').find('.removegal').val(0);
  });
                                        
                                
  $("#uploadgallery").change(function(){
     var total_file=document.getElementById("uploadgallery").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+i+'">'+
                                            '</span>'+
                                            '<a href="'+URL.createObjectURL(event.target.files[i])+'" target="_blank">'+
                                            '<img src="'+URL.createObjectURL(event.target.files[i])+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  '</div> '
                                      );
      $('#geniusform').append('<input type="hidden" name="galval[]" id="galval'+i+'" class="removegal" value="'+i+'">')
     }

  });

// Gallery Section Insert Ends	

</script>

  <script type="text/javascript">

  $('#imageSource').on('change', function () {
    var file = this.value;
      if (file == "file"){
          $('#f-file').show();
          $('#f-link').hide();
          $('#f-link').find('input').prop('required',false);
      }
      if (file == "link"){
          $('#f-file').hide();
          $('#f-link').show();
          $('#f-link').find('input').prop('required',true);
      }
  });
  
  </script>

<script type="text/javascript">
	
$('.cropme').simpleCropper();
$('#crop-image').on('click',function(){
$('.cropme').click();
});
</script>

<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection