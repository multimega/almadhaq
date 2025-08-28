<?php
  $features= App\Models\Feature::all();
  $l = DB::table('languages')->where('is_default','=',1)->first();
?>
@extends('layouts.admin') 
@section('content') 

<div class="content-area">
    <div class="px-0">
        <div class="home-head mb-4 mb-md-5">
            <h3>{{ __('Shipment Settings') }}</h3>
            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/main-settings') }}">{{ __('Main Settings') }}</a>
                    </li>
                    <li class="breadcrumb-item">{{ __('Shipment Settings') }}</li>
                </ol>
            </nav>
        </div>
        <div class="home-body">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('shipping_integration') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('integration shipping company') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-shipment-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Shipment Methods') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-zones-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Shipment Zones') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-shipment-price-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Shipment Price Methods') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-shipping-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Shipping Methods') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-package-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Packagings') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-pick-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Pickup Locations') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-country-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Country') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-city-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('City') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection    