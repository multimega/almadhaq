<?php
  $features= App\Models\Feature::all();
  $l = DB::table('languages')->where('is_default','=',1)->first();
?>
@extends('layouts.admin')
@section('content') 

<div class="content-area">
    <div class="px-0">
        <div class="home-head mb-4 mb-md-5">
            <h3>{{ __('Payment Settings') }}</h3>
            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/main-settings') }}">{{ __('Main Settings') }}</a>
                    </li>
                    <li class="breadcrumb-item">{{ __('Payment Settings') }}</li>
                </ol>
            </nav>
        </div>
        <div class="home-body">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-payments') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Payment Information') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-payment-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/main-settings/settings.webp')}}" alt="General Settings image">
                            </div>
                            <div>
                                <h4>{{ __('Payment Gateways') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-tap')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-fluid w-25 me-3">
                                <img src="{{asset('assets/admin/images/payment/tap.jpg')}}">
                            </div>
                            <div>
                                <h4>{{__('Tap Payment')}}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-bankmasr')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/payment/masr.png')}}">
                            </div>
                            <div>
                                <h4>{{__('Bank  Masr Payment')}}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-nbe')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/payment/nbe.jpg')}}">
                            </div>
                            <div>
                                <h4>{{__('Nbe Payment')}}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-accept')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/payment/accept.png')}}">
                            </div>
                            <div>
                                <h4>{{__('Accept Payment')}}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-thawani')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/payment/thawani.jpg')}}">
                            </div>
                            <div>
                                <h4>{{__('Thawani Payment')}}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-fatora')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/payment/fatora.jpg')}}">
                            </div>
                            <div>
                                <h4>{{__('Fatora Payment')}}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-paypalpaymentt')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/payment/paypal.svg')}}">
                            </div>
                            <div>
                                <h4>{{__('Paypal Payment')}}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-vapulus')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/payment/vapulus.png')}}">
                            </div>
                            <div>
                                <h4>{{__('Vapulus Payment')}}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-fawry')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/payment/fawry.jpg')}}">
                            </div>
                            <div>
                                <h4>{{__('Fawry Payment')}}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-tabby')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/payment/tabby.png')}}">
                            </div>
                            <div>
                                <h4>{{__('Tabby Payment')}}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                 <div class="col-lg-4 col-md-6">
                    <a href="{{route('admin-gs-telr')}}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/payment/telr.jpeg')}}">
                            </div>
                            <div>
                                <h4>{{__('Telr Payment')}}</h4>
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