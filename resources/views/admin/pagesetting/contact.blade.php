@extends('layouts.admin')

@section('content')
	@php 


  $features= App\Models\Feature::all();

@endphp

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Contact Us') }}</h4>
                    <ul class="links">
                      <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/main-settings') }}">Main Settings</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/menu-settings') }}">{{ __('Menu Page Settings') }}</a>
                        </li>
                      <li>
                        <a href="{{ route('admin-ps-contact') }}">{{ __('Contact Us Page') }}</a>
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
                        <form id="geniusform" action="{{ route('admin-ps-updates') }}" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}

                        @include('includes.admin.form-both')  

                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                              <div class="left-area">
                                <h4 class="heading">
                                    {{ __('Contact Page') }}:
                                </h4>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="action-list">
                                    <select class="process select droplinks {{ $gs->is_contact == 1 ? 'drop-success' : 'drop-danger' }}">
                                      <option data-val="1" value="{{route('admin-gs-iscontact',1)}}" {{ $gs->is_contact == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                      <option data-val="0" value="{{route('admin-gs-iscontact',0)}}" {{ $gs->is_contact == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                    </select>
                                  </div>
                            </div>
                          </div>
                          <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Contact Title') }} *
                                      <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <textarea class="ckeditor form-control"  name="contact_title"> {{ $data->contact_title }} </textarea>
                                  </div>
                              </div>
                            </div>
                            <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Contact Arabic Title') }} *
                                      <p class="sub-heading">{{ __('(Arabic)') }}</p>
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <textarea class="ckeditor form-control"  name="contact_title_ar"> {{ $data->contact_title_ar }} </textarea>
                                  </div>
                              </div>
                            </div>
                          <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Contact Text') }} *
                                      <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <textarea class="ckeditor form-control"  name="contact_text"> {{ $data->contact_text }} </textarea>
                                  </div>
                              </div>
                            </div>
                            <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Contact Arabic Text') }} *
                                      <p class="sub-heading">{{ __('(Arabic)') }}</p>
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <textarea class="ckeditor form-control"  name="contact_text_ar"> {{ $data->contact_text_ar }} </textarea>
                                  </div>
                              </div>
                            </div>


                          <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Contact Us Email Address') }} *
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                 <input type="email" class="ckeditor form-control" placeholder="{{ __('Enter Email') }}" name="contact_email" value="{{ $data->contact_email }}">
                              </div>
                            </div>
                          <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Contact Form Success Text') }} *
                                      <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <textarea name="contact_success" class="ckeditor form-control"> {{ $data->contact_success }} </textarea>
                                  </div>
                              </div>
                            </div>  
                            <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Contact Form Success Arabic Text') }} *
                                      <p class="sub-heading">{{ __('(Arabic)') }}</p>
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <textarea name="contact_success_ar" class="ckeditor form-control"> {{ $data->contact_success_ar }} </textarea>
                                  </div>
                              </div>
                            </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Email') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="email" class="input-field" placeholder="{{ __('Enter Email') }}" name="email" value="{{ $data->email }}">
                          </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Website') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Enter Website') }}" name="site" value="{{ $data->site }}">
                          </div>
                        </div>

                          <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Street Address') }} *
                                      <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <textarea name="street" placeholder="Enter Street Address"> {{ $data->street }} </textarea>
                                  </div>
                              </div>
                            </div>
                            <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Arabic Street Address') }} *
                                      <p class="sub-heading">{{ __('(Arabic)') }}</p>
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <textarea name="street_ar" placeholder="Enter Arabic  Street Address"> {{ $data->street_ar }} </textarea>
                                  </div>
                              </div>
                            </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Phone') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Enter Phone') }}" name="phone" value="{{ $data->phone }}">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Fax') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Enter Fax') }}" name="fax" value="{{ $data->fax }}">
                          </div>
                        </div> 
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Google Map') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Google Map IFrame') }}" name="map" value="{{ $data->map }}">
                          </div>
                        </div>
                        @if($features[4]->status == 1 && $features[4]->active == 1 )
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Messenger Page ID') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Enter Page ID') }}" name="page_id" value="{{ $data->page_id }}">
                          </div>
                        </div> 
                        
                        
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Whats App Number') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Enter number') }}" name="w_phone" value="{{ $data->w_phone }}">
                          </div>
                        </div>
                        @endif

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
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


 <script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
       
    });
</script>

@endsection