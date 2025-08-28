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
    <div class="container px-0">
        <div class="home-head mb-4 mb-md-5">
            <h3>{{ __('Marketing kit') }}</h3>
            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">{{ __('Marketing kit') }}</li>
                </ol>
            </nav>
        </div>
        <div class="home-body">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-user-cart-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/advanced-cart.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Abandoned cart') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-subs-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/subscribers.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Subscribers') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                @if($features[2]->status == 1 && $features[2]->active == 1 )
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('wallet') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/wallet.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Wallet') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if($features[1]->status == 1 && $features[1]->active == 1 )
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('loyalty') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/loyality-program.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Loyalty Program') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if($features[3]->status == 1 && $features[3]->active == 1 )
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-referral-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/referrals-program.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Referrals program') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if($features[5]->status == 1 && $features[5]->active == 1 )
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-offer-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/offer-pages.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Offer Pages') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if($features[6]->status == 1 && $features[6]->active == 1 )
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-notif-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/notifications.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Notifications') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if($features[0]->status == 1 && $features[0]->active == 1 )
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin.coupons-tabs') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/coupons.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Coupons') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-cblog-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/icons/blog.png')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Blog') }}</h4>
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