@extends('layouts.admin')

@section('content')

<div class="content-area">
            <div class="home-head mb-4">
        <h3>{{ __("Add Product") }} </h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/products') }}">{{ __("Products") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin-prod-types') }}">{{ __("Add Product") }}</a></li>
            </ol>
        </nav>
    </div>
            <div class="add-product-content">
              <div class="row">
                <div class="col-lg-12">
                  <div class="product-description">
                    <div class="heading-area">
                      <h2 class="title">
                          {{ __("Product Types") }}
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ap-product-categories">
                <div class="row">
                  <div class="col-lg-4">
                    <a href="{{ route('admin-prod-physical-create') }}">
                    <div class="cat-box box1">
                      <div class="icon">
                        <i class="fas fa-tshirt"></i>
                      </div>
                      <h5 class="title">{{ __("Physical") }} </h5>
                    </div>
                    </a>
                  </div>
                  <div class="col-lg-4">
                    <a href="{{ route('admin-prod-digital-create') }}">
                    <div class="cat-box box2">
                      <div class="icon">
                        <i class="fas fa-camera-retro"></i>
                      </div>
                      <h5 class="title">{{ __("Digital") }} </h5>
                    </div>
                    </a>
                  </div>
                  <div class="col-lg-4">
                    <a href="{{ route('admin-prod-license-create') }}">
                    <div class="cat-box box3">
                      <div class="icon">
                        <i class="fas fa-award"></i>
                      </div>
                      <h5 class="title">{{ __("license") }} </h5>
                    </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection