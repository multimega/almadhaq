<?php
  $features= App\Models\Feature::all();
  $l = DB::table('languages')->where('is_default','=',1)->first();
?>
@extends('layouts.admin') 
@section('content') 

<div class="content-area">
    <div class="container px-0">
        <div class="home-head mb-4 mb-md-5">
            <h3>{{ __('General Settings') }}</h3>
            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.main-settings') }}">{{ __('Main Settings') }}</a>
                    </li>
                    <li class="breadcrumb-item">{{ __('General Settings') }}</li>
                </ol>
            </nav>
        </div>
        <div class="home-body">
            <div class="row">
                @if($features[7]->status == 1 && $features[7]->active == 1 )
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-template') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/template.webp')}}" alt="Choose Template image">
                            </div>
                            <div>
                                <h4>{{ __('Choose Template') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-logo') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/cloud-computing-1.webp')}}" alt="Logo image">
                            </div>
                            <div>
                                <h4>{{ __('Logo') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-block') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/web-link.webp')}}" alt="Block Icons image">
                            </div>
                            <div>
                                <h4>{{ __('Block Icons') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-fav') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/search-1.webp')}}" alt="Favicon image">
                            </div>
                            <div>
                                <h4>{{ __('Favicon') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-load') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/loading.webp')}}" alt="loading image">
                            </div>
                            <div>
                                <h4>{{ __('Loader') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-load2') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/loading.webp')}}" alt="loading image">
                            </div>
                            <div>
                                <h4>{{ __('Admin Loader') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-wallet-loyalty') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/wallet.webp')}}" alt="Wallet & Loyalty image">
                            </div>
                            <div>
                                <h4>{{ __('Wallet & Loyalty Photo') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-contents') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/copywriting.webp')}}" alt="Website Contents image">
                            </div>
                            <div>
                                <h4>{{ __('Website Contents') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-header') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/headers.webp')}}" alt="headers image">
                            </div>
                            <div>
                                <h4>{{ __('Header') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-footer') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/footer.webp')}}" alt="footer image">
                            </div>
                            <div>
                                <h4>{{ __('Footer') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-social-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/link.webp')}}" alt="Social Links image">
                            </div>
                            <div>
                                <h4>{{ __('Social Links') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-social-facebook') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/enter.webp')}}" alt="Facebook Login image">
                            </div>
                            <div>
                                <h4>{{ __('Facebook Login') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-social-google') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/enter.webp')}}" alt="Google Login image">
                            </div>
                            <div>
                                <h4>{{ __('Google Login') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-affilate') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/info.webp')}}" alt="Affiliate Information image">
                            </div>
                            <div>
                                <h4>{{ __('Affiliate Information') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-popup') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/pop-up.webp')}}" alt="Popup Banner image">
                            </div>
                            <div>
                                <h4>{{ __('Popup Banner') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-role-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/settings-1.webp')}}" alt="'Manage Roles image">
                            </div>
                            <div>
                                <h4>{{ __('Manage Roles') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-staff-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/team.webp')}}" alt="Manage Staffs image">
                            </div>
                            <div>
                                <h4>{{ __('Manage Staffs') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-user-image') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/customer-service.webp')}}" alt="Customer Default image">
                            </div>
                            <div>
                                <h4>{{ __('Customer Default Image') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-error-banner') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/error-message.webp')}}" alt="Error Banner image">
                            </div>
                            <div>
                                <h4>{{ __('Error Banner') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-maintenance') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/shield.webp')}}" alt="bsite Maintenance image">
                            </div>
                            <div>
                                <h4>{{ __('Website Maintenance') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-erp-integration') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/erp.webp')}}" alt="ERP Integration image">
                            </div>
                            <div>
                                <h4>{{ __('ERP Integration') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-currency-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/rupee.webp')}}" alt="Currencies image">
                            </div>
                            <div>
                                <h4>{{ __('Currencies') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                                
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-gs-whatsapp') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/rupee.webp')}}" alt="Whatsapp image">
                            </div>
                            <div>
                                <h4>{{ __('Whatsapp') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- to controll the tax of the invoice -->
                <!--<div class="col-lg-4 col-md-6">-->
                <!--    <a href="{{ route('admin-tax-value') }}">-->
                <!--        <div class="box-link d-flex align-items-center">-->
                <!--            <div class="img-container me-3">-->
                <!--                <img src="{{asset('assets/admin/images/general-settings/rupee.webp')}}" alt="Currencies image">-->
                <!--            </div>-->
                <!--            <div>-->
                <!--                <h4>ضريبة القيمة المضافة</h4>-->
                <!--                <p class="mb-0">Lorem Ipsum is simply dummy</p>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </a>-->
                <!--</div>-->

            </div>
        </div>
    </div>
</div>



@endsection    