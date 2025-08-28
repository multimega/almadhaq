@extends('layouts.admin')

@section('content')

<div class="content-area">
  <div class="mr-breadcrumb">
    <div class="row">
      <div class="col-lg-12">
        <h4 class="heading">{{ __('Telr settings') }}</h4>
        <ul class="links">
          <li>
            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
          </li>
          <li>
            <a href="{{ url('admin/main-settings') }}">Main Settings</a>
          </li>
          <li>
            <a href="{{ url('admin/payment-settings') }}">{{ __('Payment Settings') }}</a>
          </li>
          <li>
            <a href="javascript:;">{{ __('Telr settings') }}</a>
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
            <div class="gocover"
              style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
            </div>
            <form id="geniusform" action="{{ route('admin-gs-update') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}

              @include('includes.admin.form-both')



              <div class="row justify-content-center">
                <div class="col-lg-3">
                  <div class="left-area">
                    <h4 class="heading">{{ __('Store ID:') }} *
                    </h4>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="tawk-area">
                    <input type="text" class="input-field" placeholder="{{ __('Store ID') }}" name="telr_store_id"
                      value="{{ $gs->telr_store_id }}">
                  </div>
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-lg-3">
                  <div class="left-area">
                    <h4 class="heading">{{ __('Authentication Key:') }} *
                    </h4>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="tawk-area">
                    <input type="text" class="input-field" placeholder="{{ __('Authentication Key') }}" name="telr_auth_key"
                      value="{{ $gs->telr_auth_key }}">
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
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection