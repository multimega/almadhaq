@extends('layouts.admin')
@php
 $sign = DB::table('currencies')->where('is_default','=',1)->first();

 @endphp
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>

<style>
label{
font-size: 14px;
font-weight: 600;
color: #777;
}
.select-input-color input{
  padding-left: unset !important;
}
</style>
@endsection
@section('content')

<div class="content-area">
    <div class="home-head mb-4">
        <h3>{{ __('License Product') }} <span>{{ __('Manage your license products') }}</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/products') }}">{{ __("Products") }}</a></li>
                <li class="breadcrumb-item">{{ __("Add Product") }}</li>
            </ol>
        </nav>
    </div>
	<div class="add-product-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
					<div class="body-area" style="background: #f2f3f8;padding: 0">
                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        <form id="geniusform" action="{{route('admin-prod-store')}}" method="POST" class="exp-form" enctype="multipart/form-data">
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
    														<label>{{ __('Product Arabic Description') }}*</label>
        													<div class="text-editor">
        														<textarea class="ckeditor form-control" name="details_ar"></textarea>
        													</div>
    													</div>
    												</div>
    											</div>
                                                <div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Arabic Product Buy/Return Policy') }}*</label>
    														<div class="text-editor">
    														    <textarea class="ckeditor form-control" name="policy_ar"></textarea>
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
        														<textarea class="ckeditor form-control" name="details"></textarea>
        													</div>
    													</div>
    												</div>
    											</div>
    											<div class="row">
    												<div class="col-lg-12">
    												    <div class="form-group">
    														<label>{{ __('Product Buy/Return Policy') }}*</label>
        													<div class="text-editor">
        														<textarea class="ckeditor form-control" name="policy"></textarea>
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
    			                        <!--image-->
                                        @if($gs->templatee_select == 2    ||  $gs->templatee_select == 1111)
                                            <div class="row">
    					                        <div class="col-lg-12">
                                                    <div class="form-group">
            			                                <label>{{ __('Feature Hover Image') }} *</label>
            			                                <div class="panel panel-body">
                                                    		<img class="span4 mobile text-center" id="landscapes2" style="overflow: hidden; width: 100%; height: 400px; border: 1px dashed black;">
                                                             
                                                        </div>
                                                        <input class="d-inline-block mybtn1 sm-btn mybtn1 mt-1 mb-2" type="file" onchange="document.getElementById('landscapes2').src = window.URL.createObjectURL(this.files[0])" id="hover_photo" name="hover_photo" value="">
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
                                            <h4>{{ __('Categories') }}</h4>
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
        									</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Box -->
                                <!-- Start Box -->
                                <div class="col-lg-6">
                                    <div class="default-box default-box-dashed">
                                        <div class="default-box-head default-box-head-show-hide d-flex align-items-center justify-content-between">
                                            <h4>{{ __('Price') }}</h4>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Box -->
                            </div>
                            <!-- End 2 Boxes
                            <!-- Start Box -->
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
												<input name="youtube" type="text" class="form-control" placeholder="{{ __('Enter Youtube Video URL') }}">
											</div>
										</div>
										<div class="col-lg-6">
										    <div>
											    <div>
						                            <div class="checkbox-wrapper form-group">
						                              <input type="checkbox" name="seo_check" class="checkclick" id="allowProductSEO" value="1">
						                              <label for="allowProductSEO">{{ __('Allow Product SEO') }}</label>
						                            </div>
					                            </div>
				                            </div>
				                            <div class="showbox">
			                                    <div class="row">
    					                            <div class="col-lg-12">
    					                              <div class="form-group">
    					                                  <label>{{ __('Product Title') }}*</label> <span>{{ __('(In Any Language)') }}</span>
    					                                  <input type="text" class="form-control" placeholder="{{ __('Enter Product Title') }}" name="title" >
    					                              </div>
    					                            </div>
					                            </div>
					                            <div class="row">
    					                            <div class="col-lg-12">
    					                              <div class="form-group">
    					                                  <label>{{ __('Product Title') }}*</label> <span>{{ __('(Arabic)') }}</span>
    					                                  <input type="text" class="form-control" placeholder="{{ __('Enter Product Arabic Title') }}" name="title_ar" >
    					                              </div>
    					                            </div>
					                            </div>
					                          <div class="row">
					                            <div class="col-lg-12">
					                              <div class="form-group">
					                                  <label>{{ __('Meta Tags') }} *</label>
					                                  <ul id="metatags" class="myTags"></ul>
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
				                              <div class="row">
					                            <div class="col-lg-12">
					                              <div class="form-group">
					                                  <label>{{ __('Arabic Meta Description') }} *</label>
					                                  <div class="text-editor">
    					                                <textarea name="meta_description_ar" class="form-control" placeholder="{{ __('Arabic Meta Description') }}"></textarea>
    					                              </div>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="row">
												<div class="col-lg-12">
						                            <div class="form-group">
						                                <label>{{ __('Tags') }} *</label>
						                                <ul id="tags" class="myTags" ></ul>
						                            </div>
					                            </div>
					                          </div>
					                          <div class="row">
												<div class="col-lg-12">
						                            <div class="form-group">
						                                <label>{{ __('Arabic Tags') }} *</label>
						                                <ul id="atags" class="myTags" ></ul>
						                            </div>
					                            </div>
					                          </div>
					                        </div>
										</div>
										
			                            <div class="col-lg-6">
										    <div>
											    <div>
						                            <div class="checkbox-wrapper form-group">
						                              <input type="checkbox" name="feature" value="1" class="checkclick3" id="allowProductfeature" >
						                              <label for="allowProductfeature">{{ __('Subscription feature settings') }}</label>
						                            </div>
					                            </div>
				                            </div>
				                            <div class="showbox subs">
					                          <div class="row">
					                            <div class="col-lg-12">
					                              <div class="form-group">
					                                  <label>{{ __('Subscription type') }}*</label>
					                                  <select name="subscription_type" class="form-control">
    						                               <option value="Days">{{ __('Days') }}</option>
    						                               <option value="Months">{{ __('Months') }}</option>
    						                               <option value="Years">{{ __('Years') }}</option>
    						                           </select>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="row">
					                            <div class="col-lg-12">
					                              <div class="form-group">
					                                  <label>{{ __('subscription period') }}*</label>
					                                  <input name="subscription_period" type="number" min="0" class="form-control" placeholder="{{ __('subscription period') }}" value="0">
					                              </div>
					                            </div>
					                          </div>
					                          <div class="row">
					                            <div class="col-lg-12">
					                              <div class="form-group">
					                                  <label>{{ __('subscription trial period') }}*</label>
                                                      <input name="trial_period" type="number" min="0" class="form-control" placeholder="{{ __('trial period') }}" value="0">
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
												<label>{{__("Platform")}} * </label><small>{{ __('(Optional)') }}</small>
												<input type="text" class="form-control" placeholder="{{__("Enter Platform")}}" name="platform">	
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>{{__("Region")}} * </label><small>{{ __('(Optional)') }}</small>
												<input type="text" class="form-control" placeholder="{{ __("Enter Region") }}" name="region">	
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>{{__("License Type")}} * </label><small>{{ __('(Optional)') }}</small>
												<input type="text" class="form-control" placeholder="{{ __("Enter Type") }}" name="licence_type">	
											</div>
										</div>
										<div class="col-lg-6">
											<div class="featured-keyword-area">
												<div class="form-group">
													<label>{{ __("Product License") }}</label>
                                                    <div class="feature-tag-top-filds" id="license-section">
							                            <div class="license-area">
						                                    <span class="remove license-remove"><i class="fas fa-times"></i></span>
						                                    <div  class="row">
						                                       <div class="col-lg-6">
						                                          <input type="text" name="license[]" class="form-control" placeholder="{{ __("License Key") }}" required="">
						                                        </div>
						                                        <div class="col-lg-6">
						                                           <input type="number" min="1" name="license_qty[]" class="form-control" placeholder="{{ __("License Quantity") }}" value="1">
						                                        </div>
						                                    </div>
							                            </div>
													</div>
													<a href="javascript:;" id="license-btn" class="main-light-btn mb-4 text-white"><i class="icofont-plus"></i> {{ __("Add More Field") }}</a>
												</div>                    														
											</div>
										</div>
			                            <div class="col-lg-12">
											<div class="form-group">
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
                            <!-- End Box -->	
	                        <input type="hidden" name="type" value="License">
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

<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
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
    				<div class="selected-image">
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
	
$('.cropme').simpleCropper();
$('#crop-image').on('click',function(){
$('.cropme').click();
});

    $(".checkclick3").on( "change", function() {
            if(this.checked){
             $(".subs").removeClass('showbox');  
            }
            else{
             $(".subs").addClass('showbox');   
            }
        });
</script>


<script src="{{asset('assets/admin/js/product.js')}}"></script>

 <script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
       
    });
</script>
@endsection