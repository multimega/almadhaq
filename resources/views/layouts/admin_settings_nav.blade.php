<?php
            
              
  $features= App\Models\Feature::all();
  $l = DB::table('languages')->where('is_default','=',1)->first();
  
?>
<style>
    a span{
        white-space: nowrap;
        font-weight: 600;
    }
    .navbar-brand{
        font-weight: 600;
        font-size: 16px;
        background: #3e0000;
        color: #fff !important;
        padding: 5px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 d-flex" style="overflow-x: auto">
  <a class="navbar-brand" href="#">{{ __('General Settings') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto px-2">
        @if($features[7]->status == 1 && $features[7]->active == 1 )
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-template') }}"><span>Choose Template</span></a>
        </li>
        @endif
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-gs-logo') }}"><span>{{ __('Logo') }}</span></a>-->
        <!--</li>-->
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-gs-block') }}"><span>{{ __('Block Icons') }}</span></a>-->
        <!--</li>-->
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-gs-fav') }}"><span>{{ __('Favicon') }}</span></a>-->
        <!--</li>-->
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-gs-load') }}"><span>{{ __('Loader') }}</span></a>-->
        <!--</li> -->
        <!-- <li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-gs-load2') }}"><span>{{ __('Admin Loader') }}</span></a>-->
        <!--</li> -->
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-wallet-loyalty') }}"><span>{{ __('Wallet & Loyalty Photo') }}</span></a>-->
        <!--</li>-->
       
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-gs-contents') }}"><span>{{ __('Website Contents') }}</span></a>-->
        <!--</li>-->
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-gs-header') }}"><span>Header</span></a>-->
        <!--</li>-->
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-gs-footer') }}"><span>{{ __('Footer') }}</span></a>-->
        <!--</li>-->
        
        <!--<li class="nav-item"><a class="nav-link" href="{{route('admin-social-index')}}"><span>{{ __('Social Links') }}</span></a></li>-->
        
        
        <li class="nav-item"><a class="nav-link" href="{{route('admin-social-facebook')}}"><span>{{ __('Facebook Login') }}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('admin-social-google')}}"><span>{{ __('Google Login') }}</span></a></li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-gs-affilate') }}"><span>{{__('Affiliate Information')}}</span></a>
        </li>
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-gs-popup') }}"><span>{{ __('Popup Banner') }}</span></a>-->
        <!--</li>-->
        
        <!--<li class="nav-item"><a class="nav-link" href="{{route('admin-gs-payments')}}"><span>{{__('Payment Information')}}</span></a></li>-->
        <!--<li class="nav-item"><a class="nav-link" href="{{route('admin-payment-index')}}"><span>{{ __('Payment Gateways') }}</span></a></li>-->

        <!--<li class="nav-item"><a class="nav-link" href="{{route('admin-currency-index')}}"><span>{{ __('Currencies') }}</span></a></li>-->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-role-index') }}" class=" wave-effect"><span>{{ __('Manage Roles') }}</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-staff-index') }}" class=" wave-effect"><span>{{ __('Manage Staffs') }}</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-user-image') }}"><span>{{ __('Customer Default Image') }}</span></a>
        </li>
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('admin-gs-error-banner') }}"><span>{{ __('Error Banner') }}</span></a>-->
        <!--</li>-->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-gs-maintenance') }}"><span>{{ __('Website Maintenance') }}</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-gs-erp-integration') }}"><span>{{ __('ERP Integration') }}</span></a>
        </li>
    </ul>
  </div>
</nav>
