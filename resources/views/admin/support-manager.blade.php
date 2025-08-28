<?php
  $features= App\Models\Feature::all();
  $l = DB::table('languages')->where('is_default','=',1)->first();
?>
@extends('layouts.admin') 
@section('content') 

<div class="content-area">
    <div class="container px-0">
        <div class="home-head mb-4 mb-md-5">
            <h3>{{ __('Support Manager') }}</h3>
            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">{{ __('Support Manager') }}</li>
                </ol>
            </nav>
        </div>
        <div class="home-body">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-message-index') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/template.webp')}}" alt="Choose Template image">
                            </div>
                            <div>
                                <h4>{{ __('Tickets') }}</h4>
                                <p class="mb-0">Lorem Ipsum is simply dummy</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('admin-message-dispute') }}">
                        <div class="box-link d-flex align-items-center">
                            <div class="img-container me-3">
                                <img src="{{asset('assets/admin/images/general-settings/template.webp')}}" alt="Choose Template image">
                            </div>
                            <div>
                                <h4>{{ __('Disputes') }}</h4>
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