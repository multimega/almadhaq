@extends('layouts.admin')
@section('content')

<div class="content-area">
    <div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Template Settings") }} <span>{{ __("Manage your template settings") }}</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/main-settings') }}">{{ __("Main Settings") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/general-settings') }}">{{ __("General Settings") }}</a></li>
                <li class="breadcrumb-item">{{ __("Template") }}</li>
            </ol>
        </nav>
    </div>
    <div class="default-box">
        <div class="default-box-head">
            <h4>{{ __("Choose Template") }}</h4>
        </div>
        <div class="default-box-body">
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form id="geniusform" action="{{ route('admin-gs-update') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}

                @include('includes.admin.form-both')  
                <div class="row">
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="1" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Free Template") }}</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="11" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 1</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="11111" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 1-New</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="2" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 2</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="222" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 2-New</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="222" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 2-New</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="3" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 3</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="4" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 4</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="5" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 5</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="55" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 5-New</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="6" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 6</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="66" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 6-New</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="7" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 7</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="8" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 8</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="9" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 9</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="10" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 10</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="111" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 11</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="1111" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 11-New</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="12" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 12</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="13" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 13</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="14" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 14</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="15" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 15</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="155" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 15-New</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="16" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 16</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="166" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 16-New</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="17" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 17</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="18" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 18</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="19" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 19</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="20" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 20</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="21" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 21</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="22" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 22</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="23" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 23</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="24" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 24</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="25" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 25</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="26" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 26</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="27" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 27</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="28" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 28</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="29" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 29</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="30" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 30</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="31" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 31</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="32" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 32</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="template-box text-center position-relative">
                            <input type="radio" name="templatee_select" value="34" class="position-absolute">
                            <img src="{{asset('assets/admin/images/template-images/template.webp')}}" class="w-100">
                            <div class="template-info mt-3">
                                <h4 class="mb-2">{{ __("Template") }} 34</h4>
                                <p>{{ __("Choose The Best Template For You") }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-4 text-end">
                        <button class="main-light-btn py-3" type="submit">{{ __('Save') }} <i class="fas fa-check ms-3"></i></button>
                    </div>
                </div>
                <!--<button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>-->
            </form>
        </div>
    </div>
</div>

@endsection