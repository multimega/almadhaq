@extends('layouts.admin')
@section('styles')


<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />
<style>
	/*DSADSADASD*/



	button:focus,
	input:focus,
	textarea:focus,
	select:focus {
		outline: none;
	}

	label {
		font-size: 14px;
		font-weight: 600;
		color: #777;
	}

	.select-input-color input {
		padding-left: unset !important;
	}
</style>
@if($gs->light_dark == 0)

@else


@endif


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
				<li class="breadcrumb-item">{{ __("Add Product") }}</li>
			</ol>
		</nav>
	</div>
	<div class="add-product-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
					<div class="body-area" style="background: #f2f3f8;padding: 0">
						<div class="gocover"
							style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
						</div>
						<form id="geniusform" action="{{route('admin-prod-store')}}" class="exp-form" method="POST"
							enctype="multipart/form-data">
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
													<img src="{{asset('assets/admin/images/eg.gif')}}" width="32"
														class="d-block">
													ع
												</li>
												<li class="text-center" data-lang='en'>
													<img src="{{asset('assets/admin/images/gb.gif')}}" width="32"
														class="d-block">
													EN
												</li>
											</ul>
											<div class="toggle-lang-tab active" id="lang-ar">
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label>{{ __('Product Name ar') }}* </label>
															<input type="text" class="form-control"
																placeholder="{{ __('Enter Product Arabic Name') }}"
																name="name_ar" required="">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label>{{ __('Product ALt') }}* </label>
															<input type="text" class="form-control"
																placeholder="{{ __('Enter Product Arabic ALt') }}"
																name="alt_ar" required="">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label>{{ __('Product Arabic Description') }}*</label>
															<div class="text-editor">
																<textarea class="ckeditor form-control"
																	name="details_ar"></textarea>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label>{{ __('Arabic Product Buy/Return Policy') }}*</label>
															<div class="text-editor">
																<textarea class="ckeditor form-control"
																	name="policy_ar">

    														    تسوق بأمن مع مميزات سياسة الإرجاع الرائعة هذه<br>
    
                                                                منتجات أصلية
                                                                <br>
                                                                نحن ملتزمون بتقديم منتجات أصلية 100٪ لعملائنا.
                                                                <br>
                                                                14 يوم للإرجاع
                                                                <br>
                                                                أمامك 14 يومًا لتقديم طلب إرجاع بعد تسليم طلباتك، إرجاع مجاني حتى 14 يومًا للمنتجات المعيبة.
                                                                <br>
                                                                استرداد المبالغ كاملة
                                                                <br>
                                                                سوف تتلقى استردادًا بنسبة 100٪ لمنتجك بالإضافة إلى رسوم الشحن، إذا قمنا بتسليم سلعة تالفة أو معيبة أو خاطئة.
                                                                <br>
                                                                إرجاع سهل ومجاني
                                                                <br>
                                                                يمكنك إرجاع أي منتج اشتريته، وسنتولى تكاليف إعادة الشحن.
                                                                <br>
                                                                كيف تعمل عملية العودة
                                                                <br>
                                                                الإبلاغ عن طلب الاسترجاع
                                                                <br>
                                                                عبر الهاتف أو صفحة اتصل بنا.
                                                                <br>
                                                                جدولة عملية الاستلام
                                                                <br>
                                                                سوف نرسل ساعيًا إلى عتبة بابك لاستلام المنتج.
                                                                <br>
                                                                إعادة السلعة
                                                                <br>
                                                                قم بتعبئة العنصر في حالته الأصلية وعبوته الأصلية. تسليم الطرد إلى مندوبنا.
                                                                <br>
                                                                معالجة الاسترداد
                                                                <br>
                                                                بمجرد استلامنا للمنتج المرتجع، سنقوم بفحصه ومعالجة استرداد أموالك على الفور.
                                                                <br>
                                                                سياسة قبول المرتجعات
                                                                <br>
                                                                ·            في حال كان المنتج لا يتوافق مع المواصفات الفنية المعروضة.
                                                                <br>
                                                                ·            ظهور عيب فني (عيب صناعي) خلال 14 يوم من تاريخ الاستلام.
                                                                <br>
                                                                ·            يشترط أن يكون العطل او العيب غير ناتج عن سوء الاستخدام.
                                                                <br>
                                                                ·            يجب أن يكون المنتج في حالته الأصلية وقت الاسترجاع.
                                                                <br>
                                                                تطبق الشروط والاحكام
                                                                														    
    														</textarea>
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
															<input type="text" class="form-control"
																placeholder="{{ __('Enter Product Name') }}" name="name"
																required="">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label>{{ __('Product ALt') }}* </label>
															<input type="text" class="form-control"
																placeholder="{{ __('Enter Product ALt') }}" name="alt"
																required="">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label>{{ __('Product Description') }}*</label>
															<div class="text-editor">
																<textarea class="ckeditor form-control"
																	name="details"></textarea>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label>{{ __('Product Buy/Return Policy') }}*</label>
															<div class="text-editor">
																<textarea class="ckeditor form-control" name="policy">

        														Safe shopping with these great return policy features!<br>
        
                                                                Authenticity guarantee<br>
                                                                
                                                                We are committed to offering our customers 100% authentic products.<br>
                                                                
                                                                30 Days Return<br>
                                                                
                                                                you have 15 days to make a return request after your orders has been delivered. Free return up to 30 days for defective products.<br>
                                                                
                                                                Full Refunds<br>
                                                                
                                                                You will receive 100% refund for your item plus shipping fees, if we delivered damaged, defective, wrong item.<br>
                                                                
                                                                Easy and free Returns<br>
                                                                
                                                                You can return any product you have bought, and we will take care of the return shipping costs.<br>
                                                                
                                                                How does Return Process Work?<br>
                                                                
                                                                1- Initiate A Return Via a phone or contact us page.<br>
                                                                
                                                                2- Schedule Pick-up.<br>
                                                                
                                                                We will send a courier to your doorstep.<br>
                                                                
                                                                3- Return the Item<br>
                                                                
                                                                Pack the item in its original state and packaging. hand over the package to the courier representative.<br>
                                                                
                                                                4- Refund Processed<br>
                                                                
                                                                Once we receive your returned item, we will inspect it and process your refund.<br>
                                                                
                                                                Return Accepted Policy.<br>
                                                                
                                                                The product does not meet the specifications.<br>
                                                                The appearance of a technical defect (manufacturing defect) within 14 days from the date of receipt, if it is not due to misuse.<br>
                                                                The product must be in its original condition at the time of return.<br>
                                                                
                                                                
                                                                Terms and conditions apply
        												    	</textarea>
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
                                                    		<img class="span4 mobile text-center" src="" id="landscapes2" style="overflow: hidden; width: 100%; height: 400px; border: 1px dashed black;">
                                                        </div>
                                                        <input class="d-inline-block mybtn1 sm-btn mybtn1 mt-1 mb-2" type="file" onchange="document.getElementById('landscapes2').src = window.URL.createObjectURL(this.files[0])" id="hover_photo"  accept="image/*"  name="photo" value="{{ old('photo')}}">
            			                            </div>
            			                        </div>
        			                        </div> 
										{{--<div class="form-group">
											<label>{{ __('Feature Image') }} * <small>{{ __('image size') }} 205px X
													205px</small></label>
											<div class="panel panel-body">
												<div class="span4 cropme d-flex align-items-center justify-content-center"
													id="landscape"
													style="overflow: hidden; width: 100%; height: 400px; border: 1px dashed black;">
													<div class="text-center">
														<i class="far fa-images"></i>
														<p>{{ __('Upload Image') }}</p>
													</div>
												</div>
												<!-- 		<a href="javascript:;" id="crop-image" class="d-inline-block mybtn1 mt-1 mb-2">-->
												<!--	<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}-->
												<!--</a>-->
											</div>
										</div>

										<input type="file" id="feature_photo"0 name="photo" value="">--}}
										<!--image-->
										@if($gs->templatee_select == 2 || $gs->templatee_select == 1111)
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<label>{{ __('Feature Hover Image') }} *</label>
													<div class="panel panel-body">
														<img class="span4 mobile text-center" id="landscapes2"
															style="overflow: hidden; width: 100%; height: 400px; border: 1px dashed black;">

													</div>
													<input class="d-inline-block mybtn1 sm-btn mybtn1 mt-1 mb-2"
														type="file"
														onchange="document.getElementById('landscapes2').src = window.URL.createObjectURL(this.files[0])"
														id="hover_photo" name="hover_photo" value="">
													<span class='span-img-size'>{{ __('image size') }} 205px X
														205px</span>
												</div>
											</div>
										</div>
										@endif

										<input type="file" name="gallery[]" class="hidden" id="uploadgallery"
											accept="image/*" multiple>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<label>{{ __('Product Gallery Images') }} * <small>{{ __('You can
															upload multiple Images.') }} - {{ __('image size') }} 205px
															X 205px</small></label>
													<a href="#" class="set-gallery-prod" data-bs-toggle="modal"
														data-bs-target="#setgallery">
														<i class="fas fa-cloud-upload-alt me-2"></i> {{ __('Set
														Gallery') }}
													</a>
												</div>
											</div>
										</div>

										<input type="file" name="gallerymobile[]" class="hidden"
											id="uploadgallerymobile" accept="image/*" multiple>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<label>{{ __('Product Mobile Gallery Images') }} * <small>{{ __('You
															can upload multiple Images.') }} - {{ __('image size') }}
															205px X 205px</small></label>
													<a href="#" class="set-gallery-prod set-gallery-mobile"
														data-bs-toggle="modal" data-bs-target="#setgallerymobile">
														<i class="fas fa-cloud-upload-alt me-2"></i> {{ __('Set Mobile
														Gallery') }}
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
										<div
											class="default-box-head default-box-head-show-hide d-flex align-items-center justify-content-between">
											<h4>{{ __('Categories & Brands') }}</h4>
											<i class="fas fa-angle-down arrow"></i>
										</div>
										<div class="default-box-body hidden-default-box-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label>{{ __('Category') }}*</label>
														<select id="cat" name="category_id" required=""
															class="form-control">
															<option value="">{{ __('Select Category') }}</option>
															@foreach($cats as $cat)
															<option
																data-href="{{ route('admin-subcat-load',$cat->id) }}"
																value="{{ $cat->id }}">{{$cat->name}}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>{{ __('Sub Category') }}*</label>
														<select id="subcat" name="subcategory_id" disabled=""
															class="form-control">
															<option value="">{{ __('Select Sub Category') }}</option>
														</select>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>{{ __('Child Category') }}*</label>
														<select id="childcat" name="childcategory_id" disabled=""
															class="form-control">
															<option value="">{{ __('Select Child Category') }}</option>
														</select>
													</div>
												</div>
												<div id="catAttributes"></div>
												<div id="subcatAttributes"></div>
												<div id="childcatAttributes"></div>


												<div class="col-lg-6">
													<div class="form-group">
														<label>{{ __('Brands') }}*</label>
														<select id="brand" name="brand_id" class="form-control">
															<option value="">{{ __('Select Brand') }}</option>
															@foreach($brands as $b)
															<option value="{{$b->id}}">{{$b->name}}</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<label>{{ __("Affiliate Category Type") }}*</label>
														<select id="affiliate_setting_id" name="affiliate_setting_id"
															class="form-control">
															<option value=" ">{{ __('Select Affiliate Category') }}
															</option>
															@foreach($affilates as $affilate)
															<option value="{{$affilate->id}}">
																{{$affilate->affiliate_name}}</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<label>{{ __('Product Sku') }}* </label>
														<input type="text" class="form-control"
															placeholder="{{ __('Enter Product Sku') }}" name="sku"
															required=""
															value="{{ str_random(3).substr(time(), 6,8).str_random(3) }}">
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
										<div
											class="default-box-head default-box-head-show-hide d-flex align-items-center justify-content-between">
											<h4>{{ __('Allowness') }}</h4>
											<i class="fas fa-angle-down arrow"></i>
										</div>
										<div class="default-box-body hidden-default-box-body">
											<div class="row">
												<div class="col-lg-6">
													<div>
														<div>
															<div class="checkbox-wrapper form-group">
																<input type="checkbox" name="product_condition_check"
																	class="checkclick" id="conditionCheck" value="1">
																<label for="conditionCheck">{{ __('Allow Product
																	Condition') }}</label>
															</div>
														</div>
													</div>
													<div class="showbox">
														<div class="col-lg-12 p-0">
															<div class="form-group">
																<label>{{ __('Product Condition') }}*</label>
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
																	<input name="shipping_time_check" type="checkbox"
																		id="check1" value="1">
																	<label for="check1">{{ __('Allow Estimated Shipping
																		Time') }}</label>
																</li>
															</ul>
														</div>
													</div>
													<div class="showbox">
														<div class="col-lg-12 p-0">
															<div class="form-group">
																<label>{{ __('Product Estimated Shipping Time') }}*
																</label>
																<input type="text" class="form-control"
																	placeholder="{{ __('Estimated Shipping Time') }}"
																	name="ship">
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<div>
															<ul class="list">
																<li>
																	<input name="size_check" type="checkbox"
																		id="size-check" value="1">
																	<label for="size-check">{{ __('Allow Product Sizes')
																		}}</label>
																</li>
															</ul>
														</div>
													</div>
													<div class="showbox mb-4" id="size-display">
														<div class="col-lg-12 p-0">
															<div class="product-size-details mb-0 pb-0"
																id="size-section">
																<div class="size-area">
																	<span class="remove size-remove"><i
																			class="fas fa-times"></i></span>
																	<div class="row">
																		<div class="col-md-4 col-sm-6">
																			<label>
																				{{ __('Size Name') }} :
																				<span>
																					{{ __('(eg. S,M,L,XL,XXL,3XL,4XL)')
																					}}
																				</span>
																			</label>
																			<input type="text" name="size[]"
																				class="input-field space"
																				placeholder="{{ __('Size Name') }}">
																		</div>
																		<div class="col-md-4 col-sm-6">
																			<label>
																				{{ __('Size Qty') }} :
																				<span>
																					{{ __('(Number of quantity of this
																					size)') }}
																				</span>
																			</label>
																			<input type="number" name="size_qty[]"
																				class="input-field"
																				placeholder="{{ __('Size Qty') }}"
																				value="1" min="1">
																		</div>
																		<div class="col-md-4 col-sm-6">
																			<label>
																				{{ __('Size Price') }} :
																				<span>
																					{{ __('(This price will be added
																					with base price)') }}
																				</span>
																			</label>
																			<input type="number" name="size_price[]"
																				class="input-field"
																				placeholder="{{ __('Size Price') }}"
																				value="0" min="0">
																		</div>
																	</div>
																</div>
															</div>
															<a href="javascript:;" id="size-btn"
																class="main-light-btn mb-4 text-white"><i
																	class="fas fa-plus"></i>{{ __('Add More Size') }}
															</a>
														</div>
													</div>
												</div>
												<!-- Color Size -->
												<div class="col-lg-6">
													<div class="form-group">
														<div>
															<ul class="list">
																<li>
																	<input name="size_color_check" type="checkbox"
																		id="size-color-check" value="1">
																	<label for="size-color-check">{{ __('Allow Product
																		Colors By Sizes') }}</label>
																</li>
															</ul>
														</div>
													</div>
													<div class="showbox" id="size-color-display">
														<div class="col-lg-12 p-0">
															<div class="product-size-details mb-0 pb-0"
																id="size-color-section">

																<div class="size-area">
																	<span class="remove size-remove"><i
																			class="fas fa-times"></i></span>
																	<div class="row">
																		<div class="col-lg-6">
																			<label>
																				{{ __('Size Name') }} :
																				<span>
																					{{ __('(eg. S,M,L,XL,XXL,3XL,4XL)')
																					}}
																				</span>
																			</label>
																			<input type="text" name="size_color[]"
																				class="input-field space"
																				placeholder="Size Name">
																		</div>
																		<div class="col-lg-6">
																			<label>
																				{{ __('Color') }} :
																				<span>
																					{{ __('(eg. #000000,#00324)') }}
																				</span>
																			</label>
																			<div class="color-area">

																				<div
																					class="input-group colorpicker-component cp">
																					<input type="text"
																						name="color_size[]"
																						value="#000000"
																						class="input-field cp" />
																					<span
																						class="input-group-addon"><i></i></span>
																				</div>
																			</div>

																		</div>

																		<div class="col-lg-6">
																			<label>
																				{{ __('Color Qty') }} :

																			</label>
																			<div class="color-area">

																				<div class="input-group ">
																					<input type="number"
																						name="color_qty[]" value="0"
																						min="0" class="input-field " />

																				</div>
																			</div>

																		</div>
																		<div class="col-lg-6">
																			<label>
																				{{ __('Color Price') }} :

																			</label>
																			<div class="color-area">

																				<div class="input-group ">
																					<input type="number"
																						name="color_price[]" value="0"
																						min="0" class="input-field " />

																				</div>
																			</div>

																		</div>
																	</div>
																</div>

															</div>

															<a href="javascript:;" id="size-color-btn"
																class="main-light-btn mb-4 text-white"><i
																	class="fas fa-plus"></i>{{ __('Add More Color For
																Sizes') }} </a>
														</div>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<div>
															<ul class="list">
																<li>
																	<input class="checkclick1" name="color_check"
																		type="checkbox" id="check3" value="1">
																	<label for="check3">{{ __('Allow Product Colors')
																		}}</label>
																</li>
															</ul>
														</div>
													</div>
													<div class="showbox " id="colors-display">
														<div class="col-lg-12 p-0">
															<div class="form-group">
																<label>{{ __('Product Colors') }}*</label>
																<p class="sub-heading">{{ __('(Choose Your Favorite
																	Colors)') }}</p>
																<div class="select-input-color" id="color-section">
																	<div class="color-area">
																		<span class="remove color-remove"><i
																				class="fas fa-times"></i></span>
																		<div
																			class="input-group colorpicker-component cp">
																			<input type="text" name="color[]"
																				value="#000000"
																				class="input-field cp" />
																			<span
																				class="input-group-addon"><i></i></span>
																		</div>
																	</div>
																</div>
																<a href="javascript:;" id="color-btn"
																	class="main-light-btn mb-4 text-white"><i
																		class="fas fa-plus"></i>{{ __('Add More Color')
																	}} </a>
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<div>
															<ul class="list">
																<li>
																	<input class="checkclick1" name="whole_check"
																		type="checkbox" id="whole_check" value="1">
																	<label for="whole_check">{{ __('Allow Product Whole
																		Sell') }}</label>
																</li>
															</ul>
														</div>
													</div>
													<div class="showbox">
														<div class="col-lg-12 p-0">
															<div class="featured-keyword-area">
																<div class="feature-tag-top-filds" id="whole-section">
																	<div class="feature-area">
																		<span class="remove whole-remove"><i
																				class="fas fa-times"></i></span>
																		<div class="row">
																			<div class="col-lg-6">
																				<input type="number"
																					name="whole_sell_qty[]"
																					class="input-field"
																					placeholder="{{ __('Enter Quantity') }}"
																					min="0">
																			</div>

																			<div class="col-lg-6">
																				<input type="number"
																					name="whole_sell_discount[]"
																					class="input-field"
																					placeholder="{{ __('Enter Discount Percentage') }}"
																					min="0" />
																			</div>
																		</div>
																	</div>
																</div>

																<a href="javascript:;" id="whole-btn"
																	class="main-light-btn"><i class="icofont-plus"></i>
																	{{ __('Add More Field') }}</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<ul class="list">
															<li>
																<input class="free_ship" name="free_ship"
																	type="checkbox" id="free_ship" value="1">
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
																	<input name="featured_price" type="checkbox"
																		id="featured_price_check" value="1">
																	<label for="featured_price_check">{{ __('Featured
																		Price') }}</label>
																</li>
															</ul>
														</div>
													</div>
													<div class="showbox">
														<div class="col-lg-12 p-0">
															<div class="form-group">
																<input type="number" min="0" step="0.1"
																	class="form-control"
																	placeholder="{{ __('Featured Price') }}"
																	name="featured_price" value="">
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
										<div
											class="default-box-head default-box-head-show-hide d-flex align-items-center justify-content-between">
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
														<input name="price" type="number" class="form-control"
															placeholder="{{ __('e.g 20') }}" step="0.1" required=""
															min="0">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>{{ __('Product Previous Price') }}* <small>{{
																__('(Optional)') }}</small></label>
														<input name="previous_price" step="0.1" type="number"
															class="form-control" placeholder="{{ __('e.g 20') }}"
															min="0">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>
															{{ __('Product Mobile Current Price') }}*
															<small>
																@if(!empty($sign->name))
																({{ __('In') }} {{$sign->name}})
																@endif
															</small>
														</label>
														<input name="mobile_price" type="number" class="form-control"
															placeholder="{{ __('e.g 20') }}" step="0.1" min="0"
															value="0">
													</div>
												</div>
												<div class="col-lg-6" id="stckprod">
													<div class="form-group">
														<label class="heading">{{ __('Product Stock') }}* <small>{{
																__('(Leave it empty it will appear Unlimited)')
																}}</small></label>
														<input name="stock" type="text" class="form-control"
															placeholder="{{ __('p.s 20') }}">
													</div>
												</div>
												<div class="col-lg-6">
													<div>
														<div>
															<div class="checkbox-wrapper form-group">
																<input type="checkbox" name="measure_check"
																	class="checkclick" id="allowProductMeasurement"
																	value="1">
																<label for="allowProductMeasurement">{{ __('Allow
																	Product Measurement') }}</label>
															</div>
														</div>
													</div>
													<div class="showbox">
														<div class="col-lg-12 p-0">
															<div class="form-group">
																<div class="row">
																	<div class="col-lg-8">
																		<select id="product_measure"
																			class="form-control">
																			<option value="">{{ __('None') }}</option>
																			<option value="Gram">{{ __('Gram') }}
																			</option>
																			<option value="Kilogram">{{ __('Kilogram')
																				}}</option>
																			<option value="Litre">{{ __('Litre') }}
																			</option>
																			<option value="Pound">{{ __('Pound') }}
																			</option>
																			<option value="Custom">{{ __('Custom') }}
																			</option>
																		</select>
																	</div>
																	<div class="col-lg-4"><input name="scale"
																			type="number" class="form-control" min="1"
																			value="1"></div>
																	<div class="col-lg-12 hidden" id="measure">
																		<input name="measure" type="text"
																			id="measurement" class="form-control"
																			placeholder="{{ __('Enter Unit') }}">
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
										<div
											class="default-box-head default-box-head-show-hide d-flex align-items-center justify-content-between">
											<h4>{{ __('(SEO Settings)') }}</h4>
											<i class="fas fa-angle-down arrow"></i>
										</div>
										<div class="default-box-body hidden-default-box-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label>{{ __('Youtube Video URL') }}*</label>
														<span class="sub-heading">{{ __('(Optional)') }}</span>
														<input name="youtube" type="text" class="form-control"
															placeholder="{{ __('Enter Youtube Video URL') }}">
													</div>
												</div>
												<div class="col-lg-6">
													<div>
														<div>
															<div class="checkbox-wrapper form-group">
																<input type="checkbox" name="seo_check" value="1"
																	class="checkclick" id="allowProductSEO" value="1">
																<label for="allowProductSEO">{{ __('Allow Product SEO')
																	}}</label>
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
																		<textarea name="meta_description"
																			class="form-control"
																			placeholder="{{ __('Meta Description') }}"></textarea>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group">
																	<label>{{ __('Arabic Meta Description') }} *</label>
																	<div class="text-editor">
																		<textarea name="meta_description_ar"
																			class="form-control"
																			placeholder="{{ __('Arabic Meta Description') }}"></textarea>
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
																	<span class="remove feature-remove"><i
																			class="fas fa-times"></i></span>
																	<div class="row">
																		<div class="col-lg-6">
																			<input type="text" name="features[]"
																				class="form-control"
																				placeholder="{{ __('Enter Your Keyword') }}">
																		</div>

																		<div class="col-lg-6">
																			<div
																				class="input-group colorpicker-component cp">
																				<input type="text" name="colors[]"
																					value="#000000"
																					class="form-control cp" />
																				<span
																					class="input-group-addon"><i></i></span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

															<a href="javascript:;" id="feature-btn"
																class="main-light-btn mb-4 text-white"><i
																	class="icofont-plus"></i> {{ __('Add More Field')
																}}</a>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>{{ __('Tags') }} *</label>
														<ul id="tags" class="myTags">

														</ul>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="form-group">
														<label>{{ __("Related Products") }} :</label>
														<select class="form-control multi-sel" name="related[]"
															multiple="multiple">
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
							<input type="hidden" name="type" value="Physical">
							<div class="row">
								<div class="col-lg-12 text-center">
									<button class="main-light-btn py-3" type="submit">{{ __('Create Product') }} <i
											class="fas fa-check ms-3"></i></button>
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
							<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload
								File') }}</label>
						</div>
						<div class="col-md-2 col-4">
							<a href="javascript:;" class="upload-done-btn main-bg-dark text-white"
								data-bs-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
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
<div class="modal fade" id="setgallerymobile" tabindex="-1" role="dialog" aria-labelledby="setgallerymobile"
	aria-hidden="true">
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
							<label for="image-upload" id="prod_gallery_mobile"><i class="icofont-upload-alt"></i>{{
								__('Upload File') }}</label>
						</div>
						<div class="col-md-2 col-4">
							<a href="javascript:;" class="upload-done-btn main-bg-dark text-white"
								data-bs-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
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
     $('.selected-image-web .row').html('');
    $('#geniusform').find('.removegal').val(0);
  });


  $("#uploadgallery").change(function(){
     var total_file=document.getElementById("uploadgallery").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('.selected-image-web .row').append('<div class="col-sm-6">'+
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
  
  
  
  $(document).on('click', '#prod_gallery_mobile' ,function() {
    $('#uploadgallerymobile').click();
     $('.selected-image-mobile .row').html('');
    $('#geniusform').find('.removegal').val(0);
  });


  $("#uploadgallerymobile").change(function(){
     var total_file=document.getElementById("uploadgallerymobile").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('.selected-image-mobile .row').append('<div class="col-sm-6">'+
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
      $('#geniusform').append('<input type="hidden" name="galvalm[]" id="galval'+i+'" class="removegal" value="'+i+'">')
     }

  });

// Gallery Section Insert Ends

</script>

<script type="text/javascript">
	$('.cropme').simpleCropper();
$('#crop-image').on('click',function(){
$('.cropme').click();
});

$('#crop-image2').on('click',function(){
$('.cropme').click();
});

$('.mobile').on('click',function(){
$('#feature_mobile_photo').click();
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

<script src="{{asset('assets/admin/js/product.js')}}"></script>
<script src="{{asset('assets/admin/js/jscolor.js')}}"></script>


<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
       $('.ckeditor').ckeditor();
       
    });
</script>

@endsection