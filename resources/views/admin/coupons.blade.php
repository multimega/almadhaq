<?php
  $features= App\Models\Feature::all();
  $l = DB::table('languages')->where('is_default','=',1)->first();
?>
@extends('layouts.admin') 
<style>
    .box-tab{
        border: 1px solid #ececec;
        margin-bottom: 20px;
        border-radius: 6px;
        padding: 18px 12px;
        min-height: 100px;
        transition: all .2s ease-in-out;
    }
    .box-tab:hover{
        border: 1px solid #ccc;
    }
    .box-tab h4{
        font-size: 15px;
        font-weight: 600;
    }
    .box-tab p{
        font-size: 13px;
        color: #777;
        line-height: 1.4;
    }
    .box-tab i{
        font-size: 28px;
        margin-right: 10px;
        color: #3e0000;
    }
    
</style>
@section('content') 

<div class="content-area">
    <div class="home-head mb-4 mb-md-5">
            <h3>{{ __('Coupons') }}</h3>
            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.marketing-kit') }}">{{ __('Marketing kit') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.coupons-tabs') }}">{{ __('Coupons') }}</a></li>
                </ol>
            </nav>
        </div>
    <div class="product-area px-2 py-5">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-coupon-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/coupons.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Set Coupons') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-coupon-index-piece') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/coupons.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Buy One Take One Free') }}</h4>
                        <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-coupon-index-free') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/coupons.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Take One Free') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
            @if($features[1]->status == 1 && $features[1]->active == 1 )
            <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-points-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/coupons.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Loyalty Program Coupons') }}</h4>
                                <p class="mb-0">Main setting for your store</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>



@endsection    