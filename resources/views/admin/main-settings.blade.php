@extends('layouts.admin') 
@section('content') 

<div class="content-area">
    <div class="container px-0">
        <div class="home-head mb-4 mb-md-5">
            <h3>{{ __('Main Settings') }}</h3>
            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">{{ __('Main Settings') }}</li>
                </ol>
            </nav>
        </div>
        <div class="home-body">
            <div class="row">
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.general-settings') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                    </div>
                    <div>
                        <h4>{{ __('General Settings') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin-cat-import') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/cat-bulk.webp')}}" alt="Category Bulk Upload Image">
                    </div>
                    <div>
                        <h4>{{ __('Bulk Import Upload') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('features') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/custom-features.webp')}}" alt="Feature Image">
                    </div>
                    <div>
                        <h4>{{ __('Features') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.mobile-settings') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/chat.webp')}}" alt="Mobile Settings Image">
                    </div>
                    <div>
                        <h4>{{ __('Mobile Setting') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.shipment-settings') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/arrow.webp')}}" alt="Shipment Settings Image">
                    </div>
                    <div>
                        <h4>{{ __('Shipment Settings') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.payment-settings') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/credit-card.webp')}}" alt="Payment Settings Image">
                    </div>
                    <div>
                        <h4>{{ __('Payment Settings') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.home-settings') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/home.webp')}}" alt="Home Page Settings Image">
                    </div>
                    <div>
                        <h4>{{ __('Home Page Settings') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.menu-settings') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/menu.webp')}}" alt="Menu Page Settings Image">
                    </div>
                    <div>
                        <h4>{{ __('Menu Page Settings') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.email-settings') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/email.webp')}}" alt="Email Settings Image">
                    </div>
                    <div>
                        <h4>{{ __('Email Settings') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.language-settings') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/translate.webp')}}" alt="Language Settings Image">
                    </div>
                    <div>
                        <h4>{{ __('Language Settings') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.seo-settings') }}">
                <div class="box-link d-flex align-items-center">
                    <div class="img-container me-3">
                        <img src="{{asset('assets/admin/images/main-settings/seo.webp')}}" alt="SEO Tools Settings Image">
                    </div>
                    <div>
                        <h4>{{ __('SEO Tools') }}</h4>
                        <p class="mb-0">Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
        </div>
    </div>
</div>



@endsection    