@extends('layouts.admin') 

<style>
    /*Shipment Page */

.ship-cad-box{
    margin-bottom: 20px;
    border: 1px solid #ccc;
    padding: 21px 10px;
    box-shadow: 2px 2px 10px #cccccc;
}
.ship-cad-box img{
    width: 100%;
    height: 160px;
    object-fit: cover;
}
.ship-cad-box .justify-content-between{
    justify-content: space-between;
}
.ship-cad-box h3{
    font-size: 17px;
    font-weight: 600;
}
.ship-cad-box p{
    font-size: 17px;
    font-weight: 500;
    color: #444;
}
.ship-cad-box .border-0{
    background: transparent;
    border: 0;
}
.ship-cad-box .m-auto{
    margin: auto;
}
</style>

@section('content')

<div class="content-area">
  <div class="row">
           
            <div class="col-lg-4 mb-4">
                <div class="ship-cad-box">
                    <img src="{{asset('assets/admin/images/cart/boosta.png')}}">
                    <div class="d-flex justify-content-between py-3">
                        <h3>{{ __('Bosta Settings')}} </h3>
                    </div>
                    <p>testtest</p>
                    <hr class="py-3">
                    <div class='ship-card-icons d-flex justify-content-between'>
                        <a href="{{ route('admin-bosta') }}" class="btn btn-success m-auto">تعديل ضبط شركة الشحن <i class="far fa-edit"></i> </a>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 mb-4">
                <div class="ship-cad-box">
                    <img src="{{asset('assets/admin/images/cart/aramex.png')}}">
                    <div class="d-flex justify-content-between py-3">
                        <h3>{{ __('Aramex  Settings')}}</h3>
                    </div>
                    <p>testtest</p>
                    <hr class="py-3">
                    <div class='ship-card-icons d-flex justify-content-between'>
                        <a href="{{ route('admin-aramex') }}" class="btn btn-success m-auto">تعديل ضبط شركة الشحن <i class="far fa-edit"></i> </a>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 mb-4">
                <div class="ship-cad-box">
                    <img src="{{asset('assets/admin/images/cart/hFgc7i_fastlooooooooo.png')}}">
                    <div class="d-flex justify-content-between py-3">
                        <h3>{{ __('Fastlo Settings')}} </h3>
                    </div>
                    <p>testtest</p>
                    <hr class="py-3">
                    <div class='ship-card-icons d-flex justify-content-between'>
                        <a href="{{ route('admin-fastlo') }}" class="btn btn-success m-auto">تعديل ضبط شركة الشحن <i class="far fa-edit"></i> </a>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 mb-4">
                <div class="ship-cad-box">
                    <img src="{{asset('assets/admin/images/cart/xiW5V3_fedexxxx.png')}}">
                    <div class="d-flex justify-content-between py-3">
                        <h3>{{ __('Fedex Settings')}}</h3>
                    </div>
                    <p>testtest</p>
                    <hr class="py-3">
                    <div class='ship-card-icons d-flex justify-content-between'>
                        <a href="{{ route('admin-fedex') }}" class="btn btn-success m-auto">تعديل ضبط شركة الشحن <i class="far fa-edit"></i> </a>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 mb-4">
                <div class="ship-cad-box">
                    <img src="{{asset('assets/admin/images/cart/aps.png')}}">
                    <div class="d-flex justify-content-between py-3">
                        <h3>{{ __('Abs Settings')}} </h3>
                    </div>
                    <p>testtest</p>
                    <hr class="py-3">
                    <div class='ship-card-icons d-flex justify-content-between'>
                        <a href="{{ route('admin-abs') }}" class="btn btn-success m-auto">تعديل ضبط شركة الشحن <i class="far fa-edit"></i> </a>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 mb-4">
                <div class="ship-cad-box">
                    <img src="{{asset('assets/admin/images/cart/Mylerz-Egy.png')}}">
                    <div class="d-flex justify-content-between py-3">
                        <h3>{{ __('Mylerz Settings')}} </h3>
                    </div>
                    <p>testtest</p>
                    <hr class="py-3">
                    <div class='ship-card-icons d-flex justify-content-between'>
                        <a href="{{ route('admin-mylerz') }}" class="btn btn-success m-auto">تعديل ضبط شركة الشحن <i class="far fa-edit"></i> </a>
                    </div>
                </div>
            </div>
             
        </div>
</div>


@endsection   