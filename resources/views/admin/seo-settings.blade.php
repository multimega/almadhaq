<?php
  $features= App\Models\Feature::all();
  $l = DB::table('languages')->where('is_default','=',1)->first();
?>
@extends('layouts.admin') 
@section('content') 
<div class="content-area">
    <div class="px-0">
        <div class="home-head mb-4 mb-md-5">
            <h3>{{ __('SEO Tools') }}</h3>
            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/main-settings') }}">{{ __('Main Settings') }}</a>
                    </li>
                    <li class="breadcrumb-item">{{ __('SEO Tools') }}</li>
                </ol>
            </nav>
        </div>
        <div class="home-body">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-prod-popular',30) }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Popular Products') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-seotool-keywords') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('ِAll Website Meta') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-product-header') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Product Page Header') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-category-header') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Category Page Header') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-subcategory-header') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('SubCategory Page Header') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-childcategory-header') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('ChildCategory Page Header') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-offer-header') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Offer Page Header') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-brand-header') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Brand Page Header') }}</h4>
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