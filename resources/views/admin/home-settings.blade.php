<?php
  $features= App\Models\Feature::all();
  $l = DB::table('languages')->where('is_default','=',1)->first();
?>
@extends('layouts.admin') 
@section('content') 
<div class="content-area">
    <div class="px-0">
        <div class="home-head mb-4 mb-md-5">
            <h3>{{ __('Home Page Settings') }}</h3>
            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/main-settings') }}">{{ __('Main Settings') }}</a>
                    </li>
                    <li class="breadcrumb-item">{{ __('Home Page Settings') }}</li>
                </ol>
            </nav>
        </div>
        <div class="home-body">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-sl-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Sliders') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-service-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Services') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-ps-best-seller') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Right Side Banner1') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-ps-big-save') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Right Side Banner2') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-fixx') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>Fixed Banners</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-sb-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Top Small Banners') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-sb-large') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Large Banners') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-sb-bottom') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Bottom Small Banners') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-review-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Reviews') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-partner-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Partners') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-ps-customize') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Home Page Customization') }}</h4>
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