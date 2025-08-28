@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Meta Keywords') }}</h4>
                    <ul class="links">
                      <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/main-settings') }}">Main Settings</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/seo-settings') }}">{{ __('SEO Tools') }}</a>
                        </li>
                      <li>
                        <a href="{{ route('admin-seotool-analytics') }}">{{ __('Meta Keywords') }}</a>
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
                        <form id="geniusform" action="{{ route('admin-seotool-analytics-update') }}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}

                        @include('includes.admin.form-both')  

                        
                    
                         <div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Home Page Title') }}* </h4>
																<p class="sub-heading">{{ __('(In Any Language)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Enter Home Page Title') }}" value="{{ $tool->title }}" name="title" >
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Home Pagetitle') }}* </h4>
																<p class="sub-heading">{{ __('(Arabic)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Enter Home Page Arabic Title') }}"  value="{{ $tool->title_ar }}" name="title_ar" >
													</div>
												</div>



                         <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Meta Keywords') }} *
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                  <div class="tawk-area">
                                    <textarea  name="meta_keys">{{ $tool->meta_keys }}</textarea>
                                  </div>
                              </div>
                            </div>




                          <div class="row">
                              <div class="col-lg-4">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Arabic Meta Keywords') }} *
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                  <div class="tawk-area">
                                    <textarea  name="meta_keys_ar">{{ $tool->meta_keys_ar }}</textarea>
                                  </div>
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
						                                <textarea name="meta_description" class="input-field" placeholder="{{ __('Meta Description') }}">{{ $tool->meta_description}}</textarea>
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
						                                <textarea name="meta_description_ar" class="input-field" placeholder="{{ __('Arabic Meta Description') }}">{{ $tool->meta_description_ar}}</textarea>
						                              </div>
						                            </div>
						                          </div>



                          
                           <div class="row">
                              <div class="col-lg-4">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('include Facebook pixels, Google tag manager, Analytics or Webmaster') }} *
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                  <div class="tawk-area">
                                    <textarea  name="google_analytics">{{ $tool->google_analytics }}</textarea>
                                  </div>
                              </div>
                            </div>

                    
                    
                          <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('FaceBook Pixels Script') }} *
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                  <div class="tawk-area">
                                    <textarea  name="facebook_pixel">{{ $tool->facebook_pixel }}</textarea>
                                  </div>
                              </div>
                            </div>
                    
                    
                    
                    
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
                          </div>
                        </div>
                      </div>
                     </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection