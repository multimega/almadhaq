@extends('layouts.front')

@section('styles')
    <style type="text/css">
        .root.root--in-iframe {
            background: #4682b447 !important;
        }


        .mybtn1:disabled {
            cursor: no-drop;
        }
    </style>
@endsection



@section('content')


    @php
        $addresss = [];
        $slang = Session::get('language');
        $lang = DB::table('languages')->where('is_default', '=', 1)->first();
        $features = App\Models\Feature::all();
        $bankkmasr = App\Models\PaymentGateway::where('status', '=', 1)->find(2);
        $accept = App\Models\PaymentGateway::where('status', '=', 1)->find(4);
        $fawry = App\Models\PaymentGateway::where('status', '=', 1)->find(3);
        $nbe = App\Models\PaymentGateway::where('status', '=', 1)->find(7);
        $thawany = App\Models\PaymentGateway::where('status', '=', 1)->find(6);
        $fatora = App\Models\PaymentGateway::where('status', '=', 1)->find(8);
        $paypal = App\Models\PaymentGateway::where('status', '=', 1)->find(9);
        $vapulus = App\Models\PaymentGateway::where('status', '=', 1)->find(14);

        $tap = App\Models\PaymentGateway::where('status', '=', 1)
            ->Where('title', 'like', '%' . 'tap' . '%')
            ->first();
        $tabby = App\Models\PaymentGateway::where('status', '=', 1)
            ->Where('title', 'like', '%' . 'tabby' . '%')
            ->first();

    @endphp
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="pages">
                        <li>
                            <a href="{{ route('front.index', $sign) }}">
                                {{ $langg->lang17 }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.checkout', $sign) }}">
                                {{ $langg->lang136 }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Check Out Area Start -->
    <section class="checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-area mb-0 pb-0">
                        <div class="checkout-process">
                            <ul class="nav" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-step1-tab" data-toggle="pill" href="#pills-step1"
                                        role="tab" aria-controls="pills-step1" aria-selected="true">
                                        <span>1</span> {{ $langg->lang743 }}
                                        <i class="far fa-address-card"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="pills-step2-tab" data-toggle="pill" href="#pills-step2"
                                        role="tab" aria-controls="pills-step2" aria-selected="false">
                                        <span>2</span> {{ $langg->lang744 }}
                                        <i class="fas fa-dolly"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="pills-step3-tab" data-toggle="pill" href="#pills-step3"
                                        role="tab" aria-controls="pills-step3" aria-selected="false">
                                        <span>3</span> {{ $langg->lang745 }}
                                        <i class="far fa-credit-card"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-8">




                    <form id="" action="" method="POST" class="checkoutform">

                        @include('includes.form-success')
                        @include('includes.form-error')

                        {{ csrf_field() }}


                        <div class="checkout-area">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-step1" role="tabpanel"
                                    aria-labelledby="pills-step1-tab">
                                    <div class="content-box">

                                        <div class="content">
                                            <div class="personal-info">
                                                <h5 class="title">
                                                    {{ $langg->lang746 }} :
                                                </h5>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input type="text" id="personal-name" class="form-control"
                                                            name="personal_name" placeholder="{{ $langg->lang747 }}"
                                                            required value="{{ Auth::check() ? Auth::user()->name : '' }}"
                                                            {!! Auth::check() ? 'readonly' : '' !!}>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        @if (Auth::check())
                                                            {{-- Show phone field for logged in users --}}
                                                            <input type="text" id="personal-phone" class="form-control"
                                                                name="phone" placeholder="{{ $langg->lang153 }}" required
                                                                value="{{ Auth::user()->phone }}" readonly>
                                                        @else
                                                            {{-- Show phone field for guests --}}
                                                            <input type="number" id="personal-phone" class="form-control"
                                                                name="phone" placeholder="Phone Number" required>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if (!Auth::check())
                                                    <div class="row">
                                                        <div class="col-lg-12 mt-3">
                                                            <input class="styled-checkbox" id="open-pass" type="checkbox"
                                                                value="1" name="pass_check">
                                                            <label for="open-pass">{{ $langg->lang749 }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="row set-account-pass d-none">
                                                        <div class="col-lg-6">
                                                            <input type="password" name="personal_pass" id="personal-pass"
                                                                class="form-control" placeholder="{{ $langg->lang750 }}">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="password" name="personal_confirm"
                                                                id="personal-pass-confirm" class="form-control"
                                                                placeholder="{{ $langg->lang751 }}">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="billing-address">
                                                <h5 class="title">
                                                    {{ $langg->lang147 }}
                                                </h5>
                                                <div class="row">
                                                    <!--<div class="col-lg-12 mb-2 {{ $digital == 1 ? 'd-none' : '' }}">
                                                     <select class="form-control" id="shipop" name="shipping" required="">
                                                   
                                                   @if ($gs->allow_shipto == 1)
    <option value="shipto">{{ $langg->lang149 }}</option>
    @endif
                                                    
                                                     @if ($gs->allow_pickup == 1)
    <option value="pickup">{{ $langg->lang150 }}</option>
    @endif
                                                   
                                                   
                                                     </select>
                                                    </div>-->

                                                    <div class="col-lg-6 d-none mb-2" id="shipshow">
                                                        <select class="form-control nice" name="pickup_location">
                                                            @foreach ($pickups as $pickup)
                                                                <option value="{{ $pickup->location }}">
                                                                    {{ $pickup->location }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--                      	<div class="col-lg-6">-->
                                                    <!--<input class="form-control" type="text" name="name"-->
                                                    <!--		placeholder="{{ $langg->lang152 }}" required=""-->
                                                    <!--		value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->name : '' }}">-->
                                                    <!--</div>-->


                                                    <!--<div class="col-lg-6">-->
                                                    <!--	<input class="form-control" type="text" name="email"-->
                                                    <!--		placeholder="{{ $langg->lang154 }}" required=""-->
                                                    <!--		value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->email : '' }}">-->
                                                    <!--</div>-->



                                                    {{-- <div class="col-lg-12">
                                                    @if (Auth::check())
                                                    @php

                                                    $addresss =
                                                    App\Models\Address::where('user_id',Auth::guard('web')->user()->id
                                                    )->get()
                                                    @endphp
                                                    @if (Auth::guard('web')->user()->address || count($addresss) > 0)
                                                    <select class="form-control my-2" id="address" name="address"
                                                        required>
                                                        <option>Select Address</option>

                                                        @if (!empty(Auth::guard('web')->user()->address)) <option
                                                            value="{{Auth::guard('web')->user()->address }}">
                                                            {{Auth::guard('web')->user()->address }} </option> @endif

                                                        @foreach ($addresss as $data)
                                                        <option value="{{ $data->id }}"> {{ $data->address }} </option>
                                                        @endforeach

                                                    </select>

                                                    <input class="form-control fff" type="text" name='addressWhenAuth'
                                                        value="" hidden>


                                                    @else

                                                    <input class="form-control fff" type="text" name="address"
                                                        placeholder="{{ $langg->lang155 }}" required=""
                                                        value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->address : '' }}">
                                                    @endif


                                                    @else
                                                    <!--<input class="form-control ff" type="text" name="address"-->
                                                    <!--	placeholder="{{ $langg->lang155 }}" required=""-->
                                                    <!--	value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->address : '' }}">-->

                                                    @endif
                                                </div> --}}



                                                    @if (Auth::check())
                                                        @if (Auth::guard('web')->user()->country)
                                                            {{-- <div class="col-lg-6" style="    margin-bottom: 10px;">
                                                    <input class="form-control" type="text" name="customer_country"
                                                        readonly required=""
                                                        value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->country : '' }}">

                                                </div> --}}

                                                            <div class="col-lg-6" style="    margin-bottom: 10px;">
                                                                <select class="form-control ff" name="customer_country"
                                                                    required="">
                                                                    @include('includes.countries')
                                                                </select>
                                                            </div>
                                                        @else
                                                            <div class="col-lg-6" style="    margin-bottom: 10px;">
                                                                <select class="form-control ff" name="customer_country"
                                                                    required="">
                                                                    @include('includes.countries')
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="col-lg-6" style="    margin-bottom: 10px;">
                                                            <select class="form-control ff" name="customer_country"
                                                                required="">
                                                                @include('includes.countries')
                                                            </select>
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-6">
                                                        @php
                                                            $country = DB::table('countries')
                                                                ->where('is_default', 1)
                                                                ->first();
                                                            $cities = App\Models\Zone::where(
                                                                'country_id',
                                                                $country->id,
                                                            )->get();

                                                        @endphp


                                                        @if (Auth::check())
                                                            @if (Auth::guard('web')->user()->country)
                                                                {{-- <input class="form-control" type="text" id="city" name="city"
                                                        readonly placeholder="{{ $langg->lang158 }}" required=""
                                                        value="{{ Auth::guard('web')->user()->city }}"> --}}

                                                                {{-- <select class="form-control" name="city" required="">
                                                        <option value="">Select City</option>
                                                        @foreach ($cities as $data)
                                                        @if ($data->status == 1)
                                                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select> --}}

                                                                <select id="citySelect" class="form-control"
                                                                    name="city" required>
                                                                    <option value="">Select City</option>
                                                                    {{-- @foreach ($cities as $data)
                                                        @if ($data->status == 1)
                                                        <option value="{{ $data->name }}" @if (Auth::guard('web')->check() && Auth::guard('web')->user()->city == $data->name)
                                                            selected @endif>
                                                            {{ $data->name }}
                                                        </option>
                                                        @endif
                                                        @endforeach --}}
                                                                </select>
                                                            @else
                                                                <select class="form-control mb-2" id="city"
                                                                    name="city" required="">
                                                                    <option value="">Select City</option>
                                                                    {{-- You may want to populate cities here if needed --}}
                                                                </select>
                                                            @endif
                                                        @else
                                                            @if ($country)
                                                                <select class="form-control" name="city"
                                                                    required="">
                                                                    <option value="">Select City</option>
                                                                    @foreach ($cities as $data)
                                                                        @if ($data->status == 1)
                                                                            <option value="{{ $data->name }}">
                                                                                {{ $data->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <select class="form-control" name="city"
                                                                    required="">
                                                                    {{-- No cities available --}}
                                                                </select>
                                                            @endif
                                                        @endif

                                                        <div id="delivery-info" class="mt-3 text-success fw-bold"
                                                            style="display: none;"></div>

                                                        <input type="hidden" name="shipping_schedule_id"
                                                            id="shipping_schedule_id">
                                                        <input type="hidden" name="scheduled_delivery_date"
                                                            id="scheduled_delivery_date">
                                                        <input type="hidden" name="scheduled_delivery_start_time"
                                                            id="scheduled_delivery_start_time">
                                                        <input type="hidden" name="scheduled_delivery_end_time"
                                                            id="scheduled_delivery_end_time">


                                                    </div>



                                                    <!-- todo:: remove the zip code -->
                                                    <!--@if ($gs->allow_zip == 1)
    -->
                                                    <!--				<div class="col-lg-6" >-->
                                                    <!--					<input class="form-control" type="text" name="zip"-->
                                                    <!--						placeholder="{{ $langg->lang159 }}" -->
                                                    <!--						value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->zip : '' }}">-->
                                                    <!--				</div>-->
                                                    <!--
    @endif-->

                                                    <div class="col-lg-6">
                                                        <input class="form-control" type="text" name="area"
                                                            placeholder="{{ __('Area') }}" required=""
                                                            value="">
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <input class="form-control" type="text" name="building_number"
                                                            placeholder="{{ __('Building Number') }}" required=""
                                                            value="">
                                                    </div>

                                                    {{-- Phone field removed - now handled in personal info section --}}


                                                    <!--		<div class="col-lg-6">
                                                     <input class="form-control" type="text" name="company_name"
                                                      placeholder="company name" required=""
                                                      value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->company_name : '' }}">
                                                    </div>-->

                                                    <!-- Do You Have Domain -->
                                                    <!--					<div class="col-lg-6">	<label >
                                                Do You Have Domain ?
                                                
                                                </label> </div>
                                                 <div class="col-lg-6">
                                                 
                                                 
                                                <div class="radio-design">
                                                <input type="radio" class="is_domain" id="free-package0" name="is_domain" value="yes"   required>
                                                <span class="checkmark"></span>
                                                <label for="free-package0">
                                                Yes
                                                <small> Write Domain Name Please	</small>
                                                </label>
                                                </div>
                                                <input  id="domain_name" class="form-control d-none" type="text" name="domain_name"
                                                      placeholder="Domain name"
                                                      value="">
                                                <div class="radio-design">
                                                <input type="radio" class="is_domain" id="free-package00" name="is_domain" value="no"   required>
                                                <span class="checkmark"></span>
                                                <label for="free-package00">
                                                No
                                                
                                                </label>
                                                </div>
                                                
                                                
                                                
                                                </div>-->
                                                    <!-- End Do You Have Domain-->

                                                    <!--Add Domain-->
                                                    <!--		<hr style="margin-top: 5rem;"><br>
                                                <div class="col-lg-6 add-domain d-none">	<label >
                                                Do You Want Add Domain ?
                                                
                                                </label> </div>
                                                 <div class="col-lg-6 add-domain d-none">
                                                 
                                                 
                                                <div class="radio-design">
                                                <input type="radio" class="add_domain" id="free-package000" name="add_domain" value="yes"   >
                                                <span class="checkmark"></span>
                                                <label for="free-package000">
                                                Yes
                                                <small> Gona Add Domain To Package	</small>
                                                </label>
                                                </div>
                                                
                                                <div class="radio-design">
                                                <input type="radio" class="add_domain" id="free-package0000" name="add_domain" value="no"   >
                                                <span class="checkmark"></span>
                                                <label for="free-package0000">
                                                No
                                                
                                                </label>
                                                </div>
                                                
                                                
                                                
                                                </div>	-->
                                                    <!-- End Add Domain-->



                                                </div>
                                            </div>

                                            <!-- todo:: remove address & order_notes -->

                                            <!--@if (!Auth::check())
    -->
                                            <!--<div class="order-note mt-3">-->
                                            <!--	<div class="row">-->
                                            <!--		<div class="col-lg-12">-->
                                            <!--		<input type="text" id="address" class="form-control" name="address"  required placeholder="{{ $langg->lang185 }}">-->
                                            <!--		</div>-->
                                            <!--	</div>-->
                                            <!--</div>-->
                                            <!--
    @endif-->

                                            <!--<div class="order-note mt-3">-->
                                            <!--	<div class="row">-->
                                            <!--		<div class="col-lg-12">-->
                                            <!--		<input type="text" id="Order_Note" class="form-control" name="order_notes" placeholder="{{ $langg->lang217 }} ({{ $langg->lang218 }})">-->
                                            <!--		</div>-->
                                            <!--	</div>-->
                                            <!--</div>-->

                                            <div class="row">
                                                <div class="col-lg-12  mt-3">
                                                    <div class="bottom-area paystack-area-btn">
                                                        <button type="submit"
                                                            class="mybtn1">{{ $langg->lang753 }}</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-step2" role="tabpanel"
                                    aria-labelledby="pills-step2-tab">
                                    <div class="content-box">
                                        <div class="content">

                                            <div class="order-area">
                                                @foreach ($products as $product)
                                                    <div class="order-item">
                                                        <div class="product-img">
                                                            <div class="d-flex">
                                                                <img src=" {{ filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ? $product['item']['photo'] : asset('assets/images/products/' . $product['item']['photo']) }}"
                                                                    height="80" width="80" class="p-1"
                                                                    style="height: 135px;">

                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <p class="name"><a
                                                                    href="{{ route('front.product', ['slug' => $product['item']['slug'], 'lang' => $sign]) }}"
                                                                    target="_blank">
                                                                    @if (!$slang)
                                                                        @if ($lang->id == 2)
                                                                            {{ $product['item']['name_ar'] }}
                                                                        @else
                                                                            {{ $product['item']['name'] }}
                                                                        @endif
                                                                    @else
                                                                        @if ($slang == 2)
                                                                            {{ $product['item']['name_ar'] }}
                                                                        @else
                                                                            {{ $product['item']['name'] }}
                                                                        @endif
                                                                    @endif
                                                                </a></p>
                                                            <div class="unit-price">
                                                                <h5 class="label">{{ $langg->lang754 }} : </h5>
                                                                <p>{{ App\Models\Product::convertPrice(
                                                                    $product['item']['price'] != 0 ? $product['item']['price'] : $product['size_price'],
                                                                ) }}
                                                                </p>
                                                            </div>
                                                            @if (!empty($product['size']))
                                                                <div class="unit-price">
                                                                    <h5 class="label">{{ $langg->lang312 }} : </h5>
                                                                    <p>{{ $product['size'] }}</p>
                                                                </div>
                                                            @endif
                                                            @if (!empty($product['color']))
                                                                <div class="unit-price">
                                                                    <h5 class="label">{{ $langg->lang313 }} : </h5>
                                                                    <span id="color-bar"
                                                                        style="border: 10px solid {{ $product['color'] == ''
                                                                            ? "
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            white"
                                                                            : '#' . $product['color'] }};"></span>
                                                                </div>
                                                            @endif
                                                            @if (!empty($product['keys']))
                                                                @foreach (array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key => $value)
                                                                    @php
                                                                        $atrr = App\Models\Attribute::where(
                                                                            'input_name',
                                                                            $key,
                                                                        )->first();
                                                                        $atrroption = App\Models\AttributeOption::where(
                                                                            'name',
                                                                            $value,
                                                                        )->first();

                                                                    @endphp
                                                                    <div class="quantity">
                                                                        <h5 class="label">
                                                                            @if ($atrr)
                                                                                @if (!$slang)
                                                                                    @if ($lang->id == 2)
                                                                                        {{ ucwords(str_replace('_', ' ', $atrr->name_ar)) }}
                                                                                        :
                                                                                    @else
                                                                                        {{ ucwords(str_replace('_', ' ', $atrr->name)) }}
                                                                                        :
                                                                                    @endif
                                                                                @else
                                                                                    @if ($slang == 2)
                                                                                        {{ ucwords(str_replace('_', ' ', $atrr->name_ar)) }}
                                                                                        :
                                                                                    @else
                                                                                        {{ ucwords(str_replace('_', ' ', $atrr->name)) }}
                                                                                        :
                                                                                    @endif
                                                                                @endif
                                                                            @else
                                                                                {{ ucwords(str_replace('_', ' ', $key)) }}
                                                                                :
                                                                            @endif
                                                                        </h5>
                                                                        <span class="qttotal">
                                                                            @if ($atrroption)
                                                                                @if (!$slang)
                                                                                    @if ($lang->id == 2)
                                                                                        {{ $atrroption->name_ar }}
                                                                                    @else
                                                                                        {{ $atrroption->name }}
                                                                                    @endif
                                                                                @else
                                                                                    @if ($slang == 2)
                                                                                        {{ $atrroption->name_ar }}
                                                                                    @else
                                                                                        {{ $atrroption->name }}
                                                                                    @endif
                                                                                @endif
                                                                            @else
                                                                                {{ $value }}
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            <div class="quantity">
                                                                <h5 class="label">{{ $langg->lang755 }} : </h5>
                                                                <span class="qttotal">{{ $product['qty'] }} </span>
                                                            </div>
                                                            <div class="total-price">
                                                                <h5 class="label">{{ $langg->lang756 }} : </h5>
                                                                <p>{{ App\Models\Product::convertPrice($product['price']) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <div class="bottom-area">
                                                        <a href="javascript:;" id="step1-btn"
                                                            class="mybtn1 mr-3">{{ $langg->lang757 }}</a>
                                                        <a href="javascript:;" id="step3-btn"
                                                            class="mybtn1">{{ $langg->lang753 }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-step3" role="tabpanel"
                                    aria-labelledby="pills-step3-tab">
                                    <div class="content-box">
                                        <div class="content">

                                            <div class="billing-info-area {{ $digital == 1 ? 'd-none' : '' }}">
                                                <h4 class="title">
                                                    {{ $langg->lang758 }}
                                                </h4>
                                                <ul class="info-list">
                                                    <li>
                                                        <p id="shipping_user"></p>
                                                    </li>
                                                    <li>
                                                        <p id="shipping_location"></p>
                                                    </li>
                                                    <li>
                                                        <p id="shipping_phone"></p>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="payment-information shipment">
                                                <h4 class="title">
                                                    {{ $langg->lang838 }}
                                                </h4>


                                                <div class="ship">

                                                </div>

                                            </div>
                                            <div class="payment-information">
                                                <h4 class="title">
                                                    {{ $langg->lang759 }}
                                                </h4>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="nav flex-column" role="tablist"
                                                            aria-orientation="vertical">

                                                            {{-- payment method selection --}}

                                                            <input type="hidden" name="payment_gateway_id"
                                                                id="payment_gateway_id" value="94">


                                                            @php
                                                                $isArabic =
                                                                    (!$slang && isset($lang) && $lang->id == 2) ||
                                                                    $slang == 2;

                                                                $paymentGateways = App\Models\PaymentGateway::where(
                                                                    'status',
                                                                    1,
                                                                )->get();
                                                            @endphp

                                                            @foreach ($paymentGateways as $paymentGateway)
                                                                @php
                                                                    $title = $isArabic
                                                                        ? $paymentGateway->title_ar
                                                                        : $paymentGateway->title;
                                                                    $details = $isArabic
                                                                        ? $paymentGateway->details_ar
                                                                        : $paymentGateway->details;
                                                                @endphp


                                                                <a class="nav-link payment"
                                                                    data-val="{{ $paymentGateway->id }}" data-show="no"
                                                                    data-form="{{ route('checkout.store.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'tap', 'slug2' => 0]) }}"
                                                                    id="payment-option-{{ $paymentGateway->id }}"
                                                                    data-toggle="pill" href="#v-pills-tab4"
                                                                    role="tab" aria-controls="v-pills-tab4"
                                                                    aria-selected="false">

                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>

                                                                    <p>
                                                                        {{ $title }}
                                                                        <small>{{ $paymentGateway->subtitle }}</small>

                                                                    </p>
                                                                </a>

                                                                @if (!empty($details))
                                                                    <div class="payment-details"
                                                                        id="details-{{ $paymentGateway->id }}"
                                                                        style="display: none;">
                                                                        {!! $details !!}
                                                                    </div>
                                                                @endif
                                                            @endforeach


                                                            @if ($gs->paypal_check == 1)
                                                                <a class="nav-link payment" data-val="" data-show="no"
                                                                    data-form="{{ route('paypal.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'paypal', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab1-tab" data-toggle="pill"
                                                                    href="#v-pills-tab1" role="tab"
                                                                    aria-controls="v-pills-tab1" aria-selected="true">
                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>
                                                                    <p>
                                                                        {{ $langg->lang760 }}

                                                                        @if ($gs->paypal_text != null)
                                                                            <small>
                                                                                {{ $gs->paypal_text }}
                                                                            </small>
                                                                        @endif
                                                                    </p>
                                                                </a>
                                                            @endif
                                                            @if ($gs->stripe_check == 1)
                                                                <a class="nav-link payment" data-val=""
                                                                    data-show="yes"
                                                                    data-form="{{ route('stripe.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'stripe', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab2-tab" data-toggle="pill"
                                                                    href="#v-pills-tab2" role="tab"
                                                                    aria-controls="v-pills-tab2" aria-selected="false">
                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>
                                                                    <p>
                                                                        {{ $langg->lang761 }}

                                                                        @if ($gs->stripe_text != null)
                                                                            <small>
                                                                                {{ $gs->stripe_text }}
                                                                            </small>
                                                                        @endif

                                                                    </p>
                                                                </a>
                                                            @endif
                                                            {{-- @if ($gs->cod_check == 1)
                                                        @if ($digital == 0)
                                                        <a class="nav-link payment" data-val="" data-show="no"
                                                            style="display:none;" data-form="{{route('cash.submit')}}"
                                                            data-href="{{ route('front.load.payment',['slug1' => 'cod','slug2' => 0]) }}"
                                                            id="v-pills-tab3-tab" data-toggle="pill"
                                                            href="#v-pills-tab3" role="tab" aria-controls="v-pills-tab3"
                                                            aria-selected="false">
                                                            <div class="icon">
                                                                <span class="radio"></span>
                                                            </div>
                                                            <p>
                                                                {{ $langg->lang762 }}

                                                                @if ($gs->cod_text != null)

                                                                <small>
                                                                    {{ $gs->cod_text }}
                                                                </small>

                                                                @endif

                                                            </p>
                                                        </a>

                                                        <div id="cashNotAllowed" style="display:none;">
                                                            <p>No cash payment allowed for this city</p>
                                                        </div>
                                                        @endif
                                                        @endif --}}
                                                            <!--  	<a class="nav-link payment" data-val="" data-show="no" data-form="{{ route('group.submit') }}" data-href="{{ route('front.load.payment', ['slug1' => 'bank', 'slug2' => 0]) }}" id="v-pills-tab3-tab" data-toggle="pill" href="#v-pills-tab3" role="tab" aria-controls="v-pills-tab3" aria-selected="false">
                                                         <div class="icon">
                                                           <span class="radio"></span>
                                                         </div>
                                                         <p>
                                                           Bank Transfer

                                                          @if ($gs->cod_text != null)
    <br>
                                                          <large>
                                                            Account Number : 000000
                                                          </large>
    @endif

                                                         </p>
                                                       </a>-->
                                                            @if ($gs->is_instamojo == 1)
                                                                <a class="nav-link payment" data-val="" data-show="no"
                                                                    data-form="{{ route('instamojo.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'instamojo', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab4-tab" data-toggle="pill"
                                                                    href="#v-pills-tab4" role="tab"
                                                                    aria-controls="v-pills-tab4" aria-selected="false">
                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>
                                                                    <p>
                                                                        {{ $langg->lang763 }}

                                                                        @if ($gs->instamojo_text != null)
                                                                            <small>
                                                                                {{ $gs->instamojo_text }}
                                                                            </small>
                                                                        @endif

                                                                    </p>
                                                                </a>
                                                            @endif


                                                            @if ($tap)
                                                                <a class="nav-link payment" data-val="" data-show="no"
                                                                    data-form="{{ route('tap.submition') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'tap', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab2-tab" data-toggle="pill"
                                                                    href="#v-pills-tab4" role="tab"
                                                                    aria-controls="v-pills-tab4" aria-selected="false">
                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>
                                                                    <p>
                                                                        {{ $langg->lang836 }}
                                                                        <small>{{ $langg->lang837 }}</small>
                                                                    </p>
                                                                </a>
                                                            @endif



                                                            <!--														        	@if ($tabby)
    -->
                                                            <!--														    	<a class="nav-link payment" data-val="" data-show="no" data-form="{{ route('tabby.submit') }}" data-href="{{ route('front.load.payment', ['slug1' => 'tap', 'slug2' => 0]) }}"  id="v-pills-tab2-tab" data-toggle="pill" href="#v-pills-tab4" role="tab" aria-controls="v-pills-tab4" aria-selected="false">-->
                                                            <!--    <div class="icon">-->
                                                            <!--        <span class="radio"></span>-->
                                                            <!--    </div>-->
                                                            <!--    <p>-->
                                                            <!--        Pay With Tabby Payment Getway-->
                                                            <!--        <small>Tabby</small>-->
                                                            <!--    </p>-->
                                                            <!--</a>-->
                                                            <!--
    @endif-->

                                                            @if ($gs->is_paytm == 1)
                                                                <a class="nav-link payment" data-val="" data-show="no"
                                                                    data-form="{{ route('paytm.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'paytm', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab5-tab" data-toggle="pill"
                                                                    href="#v-pills-tab5" role="tab"
                                                                    aria-controls="v-pills-tab5" aria-selected="false">
                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>
                                                                    <p>
                                                                        {{ $langg->paytm }}

                                                                        @if ($gs->paytm_text != null)
                                                                            <small>
                                                                                {{ $gs->paytm_text }}
                                                                            </small>
                                                                        @endif

                                                                    </p>
                                                                </a>
                                                            @endif

                                                            @if ($gs->is_razorpay == 1)
                                                                <a class="nav-link payment" data-val="" data-show="no"
                                                                    data-form="{{ route('razorpay.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'razorpay', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab6-tab" data-toggle="pill"
                                                                    href="#v-pills-tab6" role="tab"
                                                                    aria-controls="v-pills-tab6" aria-selected="false">
                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>
                                                                    <p>

                                                                        {{ $langg->razorpay }}

                                                                        @if ($gs->razorpay_text != null)
                                                                            <small>
                                                                                {{ $gs->razorpay_text }}
                                                                            </small>
                                                                        @endif
                                                                    </p>
                                                                </a>
                                                            @endif

                                                            @if ($bankkmasr)
                                                                <a class="nav-link payment" data-val="misrbank"
                                                                    data-show="no"
                                                                    data-form="{{ route('gateway.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'misrbank', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab2-tab" data-toggle="pill"
                                                                    href="#v-pills-tab2" role="tab"
                                                                    aria-controls="v-pills-tab7" aria-selected="false">

                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>


                                                                    <p>{{ $bankkmasr->title }}

                                                                        <small>{{ $bankkmasr->subtitle }}</small>

                                                                    </p>
                                                                </a>
                                                            @endif

                                                            @if ($accept)
                                                                <a class="nav-link payment" data-val="acceptss"
                                                                    data-show="no"
                                                                    data-form="{{ route('accept.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'accept', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab2-tab" data-toggle="pill"
                                                                    href="#v-pills-tab2" role="tab"
                                                                    aria-controls="v-pills-tab7" aria-selected="false">

                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>

                                                                    <p>{{ $accept->title }}
                                                                        <small>{{ $accept->subtitle }}</small>

                                                                    </p>

                                                                </a>
                                                            @endif

                                                            @if ($nbe)
                                                                <a class="nav-link payment" data-val="misrbank"
                                                                    data-show="no" data-form="{{ route('nbe.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'misrbank', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab2-tab" data-toggle="pill"
                                                                    href="#v-pills-tab2" role="tab"
                                                                    aria-controls="v-pills-tab7" aria-selected="false">

                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>

                                                                    <p>{{ $nbe->title }}

                                                                        <small>{{ $nbe->subtitle }}</small>

                                                                    </p>
                                                                </a>
                                                            @endif

                                                            @if ($thawany)
                                                                <a class="nav-link payment" data-val="misrbank"
                                                                    data-show="no"
                                                                    data-form="{{ route('thawani.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'misrbank', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab2-tab" data-toggle="pill"
                                                                    href="#v-pills-tab2" role="tab"
                                                                    aria-controls="v-pills-tab7" aria-selected="false">

                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>


                                                                    <p>{{ $thawany->title }}

                                                                        <small>{{ $thawany->subtitle }}</small>

                                                                    </p>
                                                                </a>
                                                            @endif



                                                            @if ($paypal)
                                                                <a class="nav-link payment" data-val="misrbank"
                                                                    data-show="no"
                                                                    data-form="{{ route('Paypal.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'misrbank', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab2-tab" data-toggle="pill"
                                                                    href="#v-pills-tab2" role="tab"
                                                                    aria-controls="v-pills-tab7" aria-selected="false">
                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>
                                                                    <p>{{ $paypal->title }}

                                                                        <small>{{ $paypal->subtitle }}</small>
                                                                    </p>

                                                                </a>
                                                            @endif




                                                            @if ($fawry)
                                                                <a class="nav-link payment" data-val="misrbank"
                                                                    data-show="no"
                                                                    data-form="{{ route('fawrygatewaay.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'misrbank', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab2-tab" data-toggle="pill"
                                                                    href="#v-pills-tab2" role="tab"
                                                                    aria-controls="v-pills-tab7" aria-selected="false">
                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>
                                                                    <p>{{ $fawry->title }}

                                                                        <small>{{ $fawry->subtitle }}</small>
                                                                    </p>

                                                                </a>
                                                            @endif



                                                            @if ($fatora)
                                                                <a class="nav-link payment" data-val="acceptss"
                                                                    data-show="no"
                                                                    data-form="{{ route('fatora.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'accept', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab2-tab" data-toggle="pill"
                                                                    href="#v-pills-tab2" role="tab"
                                                                    aria-controls="v-pills-tab7" aria-selected="false">

                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>

                                                                    <p>{{ $fatora->title }}
                                                                        <small>{{ $fatora->subtitle }}</small>

                                                                    </p>

                                                                </a>
                                                            @endif

                                                            @if ($vapulus)
                                                                <a class="nav-link payment" data-val="misrbank"
                                                                    data-show="no"
                                                                    data-form="{{ route('vapulus.submit') }}"
                                                                    data-href="{{ route('front.load.payment', ['slug1' => 'misrbank', 'slug2' => 0]) }}"
                                                                    id="v-pills-tab2-tab" data-toggle="pill"
                                                                    href="#v-pills-tab2" role="tab"
                                                                    aria-controls="v-pills-tab7" aria-selected="false">

                                                                    <div class="icon">
                                                                        <span class="radio"></span>
                                                                    </div>


                                                                    <p>{{ $vapulus->title }}

                                                                        <small>{{ $vapulus->subtitle }}</small>

                                                                    </p>
                                                                </a>
                                                            @endif
                                                        </div>

                                                    </div>


                                                    <div class="col-lg-12">
                                                        <div class="pay-area d-none">
                                                            <div class="tab-content" id="v-pills-tabContent">
                                                                @if ($gs->paypal_check == 1)
                                                                    <div class="tab-pane fade" id="v-pills-tab1"
                                                                        role="tabpanel"
                                                                        aria-labelledby="v-pills-tab1-tab">

                                                                    </div>
                                                                @endif
                                                                @if ($gs->stripe_check == 1)
                                                                    <div class="tab-pane fade" id="v-pills-tab2"
                                                                        role="tabpanel"
                                                                        aria-labelledby="v-pills-tab2-tab">
                                                                    </div>
                                                                @endif
                                                                @if ($gs->cod_check == 1)
                                                                    @if ($digital == 0)
                                                                        <div class="tab-pane fade" id="v-pills-tab3"
                                                                            role="tabpanel"
                                                                            aria-labelledby="v-pills-tab3-tab">
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                                @if ($gs->is_instamojo == 1)
                                                                    <div class="tab-pane fade" id="v-pills-tab4"
                                                                        role="tabpanel"
                                                                        aria-labelledby="v-pills-tab4-tab">
                                                                    </div>
                                                                @endif
                                                                @if ($gs->is_paytm == 1)
                                                                    <div class="tab-pane fade" id="v-pills-tab5"
                                                                        role="tabpanel"
                                                                        aria-labelledby="v-pills-tab5-tab">
                                                                    </div>
                                                                @endif
                                                                @if ($gs->is_razorpay == 1)
                                                                    <div class="tab-pane fade" id="v-pills-tab6"
                                                                        role="tabpanel"
                                                                        aria-labelledby="v-pills-tab6-tab">
                                                                    </div>
                                                                @endif
                                                                @if ($gs->is_paystack == 1)
                                                                    <div class="tab-pane fade" id="v-pills-tab7"
                                                                        role="tabpanel"
                                                                        aria-labelledby="v-pills-tab7-tab">
                                                                    </div>
                                                                @endif
                                                                @if ($gs->is_molly == 1)
                                                                    <div class="tab-pane fade" id="v-pills-tab8"
                                                                        role="tabpanel"
                                                                        aria-labelledby="v-pills-tab8-tab">
                                                                    </div>
                                                                @endif



                                                                @if ($digital == 0)
                                                                    @foreach ($gateways as $gt)
                                                                        <div class="tab-pane fade"
                                                                            id="v-pills-tab{{ $gt->id }}"
                                                                            role="tabpanel"
                                                                            aria-labelledby="v-pills-tab{{ $gt->id }}-tab">

                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <div class="bottom-area">

                                                        <a href="javascript:;" id="step2-btn"
                                                            class="mybtn1 mr-3">{{ $langg->lang757 }}</a>
                                                        <button type="submit" id="final-btn"
                                                            class="mybtn1">{{ $langg->lang753 }}</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        foreach ($products as $product) {
                            $pr[] = $product['item']['id'];
                        }
                        ?>

                        <input type="hidden" id="p" value=" <?php echo implode(' ,', $pr); ?> ">
                        <input type="hidden" id="shipping-cost" name="shipping_cost" value="0">
                        <input type="hidden" id="packing-cost" name="packing_cost" value="0">
                        <input type="hidden" id="wallet-cost" name="wallet_cost" value="0">

                        <input type="hidden" name="dp" value="{{ $digital }}">
                        <input type="hidden" name="tax" value="{{ $gs->tax }}">
                        <input type="hidden" name="totalQty" value="{{ $totalQty }}">

                        <input type="hidden" name="vendor_shipping_id" value="{{ $vendor_shipping_id }}">
                        <input type="hidden" name="vendor_packing_id" value="{{ $vendor_packing_id }}">


                        @if (Session::has('coupon_total'))
                            <input type="hidden" name="total" id="grandtotal" value="{{ $totalPrice }}">
                            <input type="hidden" name="tax_value" value="{{ $tax }}">
                            <input type="hidden" id="tgrandtotal" value="{{ $totalPrice }}">
                        @elseif(Session::has('coupon_total1'))
                            <input type="hidden" name="total" id="grandtotal"
                                value="{{ preg_replace(' /[^0-9,.]/', '', Session::get('coupon_total1')) }}">
                            <input type="hidden" name="tax_value" value="{{ $tax }}">

                            <input type="hidden" id="tgrandtotal"
                                value="{{ preg_replace(' /[^0-9,.]/', '', Session::get('coupon_total1')) }}">
                        @else
                            <input type="hidden" name="total" id="grandtotal"
                                value="{{ round($totalPrice * $curr->value, 2) }}">
                            <input type="hidden" name="tax_value" value="{{ $tax }}">

                            <input type="hidden" id="tgrandtotal" value="{{ round($totalPrice * $curr->value, 2) }}">
                        @endif


                        <input type="hidden" name="coupon_code" id="coupon_code"
                            value="{{ Session::has('coupon_code') ? Session::get('coupon_code') : '' }}">
                        <input type="hidden" name="coupon_discount" id="coupon_discount"
                            value="{{ Session::has('coupon') ? Session::get('coupon') : '' }}">
                        <input type="hidden" name="coupon_id" id="coupon_id"
                            value="{{ Session::has('coupon') ? Session::get('coupon_id') : '' }}">
                        <input type="hidden" name="user_id" id="user_id"
                            value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->id : '' }}">

                        @php
                        @endphp

                    </form>

                </div>

                @if (Session::has('cart'))
                    <div class="col-lg-4">
                        <div class="right-area">
                            <div class="order-box">
                                <h4 class="title">{{ $langg->lang127 }}</h4>
                                <ul class="order-list">
                                    <!--<li>-->
                                    <!--<p>-->
                                    <!--	{{ $langg->lang128 }}-->
                                    <!--</p>-->
                                    <!--<P>-->
                                    <!--	<b-->
                                    <!--	class="cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</b>-->
                                    <!--<span class="currency">{{ $curr->sign }}</span>-->
                                    <!--</P>-->
                                    <!--</li>-->

                                    <li>
                                        <p>
                                            @lang('Total Before Vat')
                                        </p>
                                        <P>
                                            <b> {{ Session::get('cart')->totalPrice }} </b>
                                            <span class="currency">{{ $curr->sign }}</span>

                                        </P>
                                    </li>

                                    @if ($gs->tax != 0)
                                        <li>
                                            <p>
                                                {{ $langg->lang144 }}
                                            </p>
                                            <P>
                                                <b> {{ $gs->tax }}% </b>

                                            </P>
                                        </li>
                                    @endif

                                    @if (Session::has('coupon'))

                                        <li class="discount-bar">
                                            <p>
                                                {{ $langg->lang145 }} <span
                                                    class="dpercent">{{ Session::get('coupon_percentage') == 0 ? '' : '(' . Session::get('coupon_percentage') . ')' }}</span>
                                            </p>
                                            <P>
                                                @if (Session::has('coupon_product'))
                                                    <b id="discount">{{ Session::get('coupon_product') }}</b>
                                                @else
                                                    @if ($gs->currency_format == 0)
                                                        <span class="currency">{{ $curr->sign }}</span> <b
                                                            id="discount">{{ Session::get('coupon') }}</b>
                                                    @else
                                                        <b id="discount">{{ Session::get('coupon') }}</b>

                                                        <!--<span class="currency">{{ $curr->sign }}</span>-->
                                                    @endif
                                                @endif


                                            </P>
                                        </li>
                                    @else
                                        <li class="discount-bar d-none">
                                            <p>
                                                {{ $langg->lang145 }} <span class="dpercent"></span>
                                            </p>

                                            <P>
                                                <!--<span class="currency">{{ $curr->sign }}</span>	-->


                                                <b id="discount">{{ Session::get('coupon') }}</b>
                                            </P>

                                        </li>
                                    @endif

                                </ul>

                                <div class="total-price">
                                    <p>
                                        {{ $langg->lang131 }}
                                    </p>
                                    <p>

                                        @if (Session::has('coupon_total'))
                                            @if ($gs->currency_format == 0)
                                                <span class="currency">{{ $curr->sign }}</span> <span
                                                    id="total-cost">{{ $totalPrice }}</span>
                                            @else
                                                <span id="total-cost">{{ $totalPrice }}</span><span
                                                    class="currency">{{ $curr->sign }}</span>
                                            @endif
                                        @elseif(Session::has('coupon_total1'))
                                            <span id="total-cost"> {{ Session::get('coupon_total1') }}</span>
                                        @else
                                            <span
                                                id="total-cost">{{ App\Models\Product::convertPrice($totalPrice) }}</span>
                                            <!--<span class="currency">{{ $curr->sign }}</span>-->
                                        @endif

                                    </p>
                                </div>

                                @if ((!Session::has('coupon') || !Session::has('free_shipping')) && Auth::check())
                                    <div class="cupon-box coupon">
                                        <div id="coupon-link">
                                            <img src="{{ asset('assets/front/images/tag.png') }}">
                                            {{ $langg->lang132 }}
                                        </div>

                                        <form id="check-coupon-form" class="coupon">
                                            <input type="text" placeholder="{{ $langg->lang133 }}" id="code"
                                                required="" autocomplete="off">
                                            <button type="submit">{{ $langg->lang134 }}</button>
                                        </form>
                                    </div>
                                @endif

                                <div class="cupon-box d-none forget">
                                    <div id="coupon-link">
                                        <img src="{{ asset('assets/front/images/tag.png') }}">
                                        <a href="{{ route('forget.coupon', $sign) }}">Remove Coupon</a>
                                    </div>




                                </div>
                                @if ((Session::has('coupon') || Session::has('free_shipping')) && Auth::check())
                                    <div class="cupon-box  forget">

                                        <div id="coupon-link">
                                            <img src="{{ asset('assets/front/images/tag.png') }}">
                                            <a href="{{ route('forget.coupon', $sign) }}">Remove Coupon</a>
                                        </div>
                                    </div>
                                @endif

                                <div id="shiphide">
                                    <div class="shiphide-container">

                                        <h4 class="title"> {{ $langg->lang829 }} </h4>

                                        <div class="shep">
                                            <input type="hidden" value="0" class="shipping_price">

                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" value="0" class="r">
                                @if ($digital == 0)


                                    @if ($gs->multiple_shipping == 1)
                                        {{-- Shipping Method Area Start --}}
                                        <div class="packeging-area">
                                            <h4 class="title">{{ $langg->lang765 }}</h4>

                                            @foreach ($shipping_data as $data)
                                                <div class="radio-design">
                                                    <input type="radio" class="shipping"
                                                        id="free-shepping{{ $data->id }}" name="shipping"
                                                        value="{{ round($data->price * $curr->value, 2) }}"
                                                        {{ $loop->first ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <label for="free-shepping{{ $data->id }}">
                                                        @if (!$slang)
                                                            @if ($lang->id == 2)
                                                                {{ $data->title_ar }}
                                                            @else
                                                                {{ $data->title }}
                                                            @endif
                                                        @else
                                                            @if ($slang == 2)
                                                                {{ $data->title_ar }}
                                                            @else
                                                                {{ $data->title }}
                                                            @endif
                                                        @endif

                                                        @if ($data->price != 0)
                                                            +
                                                            {{ $curr->sign }}{{ round($data->price * $curr->value, 2) }}
                                                        @endif
                                                        <small>{{ $data->subtitle }}</small>
                                                    </label>
                                                </div>
                                            @endforeach

                                        </div>
                                        {{-- Shipping Method Area End --}}
                                    @endif

                                    @if ($gs->multiple_packaging == 1)
                                        {{-- Packeging Area Start --}}
                                        <div class="packeging-area">
                                            <h4 class="title">{{ $langg->lang766 }}</h4>

                                            @foreach ($package_data as $data)
                                                <div class="radio-design">
                                                    <input type="radio" class="packing"
                                                        id="free-package{{ $data->id }}" name="packeging"
                                                        value="{{ round($data->price * $curr->value, 2) }}"
                                                        {{ $loop->first ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <label for="free-package{{ $data->id }}">
                                                        @if (!$slang)
                                                            @if ($lang->id == 2)
                                                                {{ $data->title_ar }}
                                                            @else
                                                                {{ $data->title }}
                                                            @endif
                                                        @else
                                                            @if ($slang == 2)
                                                                {{ $data->title_ar }}
                                                            @else
                                                                {{ $data->title }}
                                                            @endif
                                                        @endif
                                                        @if ($data->price != 0)
                                                            +
                                                            {{ $curr->sign }}{{ round($data->price * $curr->value, 2) }}
                                                        @endif
                                                        <small>
                                                            @if (!$slang)
                                                                @if ($lang->id == 2)
                                                                    {{ $data->subtitle_ar }}
                                                                @else
                                                                    {{ $data->subtitle }}
                                                                @endif
                                                            @else
                                                                @if ($slang == 2)
                                                                    {{ $data->subtitle_ar }}
                                                                @else
                                                                    {{ $data->subtitle }}
                                                                @endif
                                                            @endif
                                                        </small>
                                                    </label>
                                                </div>
                                            @endforeach

                                        </div>
                                    @endif

                                    {{-- Packeging Area End Start --}}

                                    @if (Auth::check() && $features[2]->status == 1 && $features[2]->active == 1)
                                        {{-- WAllet Area Start --}}
                                        <div class="packeging-area">
                                            <h4 class="title"> {{ $langg->lang811 }}</h4>



                                            <div class="radio-design">
                                                <input type="radio" class="wallet" id="free-package30" name="wallet"
                                                    value="0" checked>
                                                <span class="checkmark"></span>
                                                <label for="free-package30">
                                                    {{ $langg->lang827 }}


                                                </label>
                                            </div>
                                            @if (Auth::guard('web')->user()->refunds != 0)
                                                <div class="radio-design">
                                                    <input type="radio" class="wallet" id="free-package30"
                                                        name="wallet"
                                                        value="{{ round(Auth::guard('web')->user()->refunds * $curr->value, 2) }}">
                                                    <span class="checkmark"></span>
                                                    <label for="free-package30">
                                                        {{ $langg->lang828 }}

                                                        {{ $curr->sign }}{{ round(Auth::guard('web')->user()->refunds * $curr->value, 2) }}


                                                    </label>
                                                </div>
                                            @endif

                                        </div>
                                    @endif
                                    {{-- Wallet Area End Start --}}

                                    {{-- Final Price Area Start --}}
                                    <div class="final-price">
                                        <p>
                                            <span>{{ $langg->lang767 }} :</span>
                                        </p>
                                        <p>
                                            @if (Session::has('coupon_total'))
                                                @if ($gs->currency_format == 0)
                                                    <span class="currency">{{ $curr->sign }}</span> <span
                                                        id="final-cost">{{ $totalPrice }}</span>
                                                @else
                                                    <span id="final-cost">{{ $totalPrice }}</span> <span
                                                        class="currency">{{ $curr->sign }}</span>
                                                @endif
                                            @elseif(Session::has('coupon_total1'))
                                                <span id="final-cost"> {{ Session::get('coupon_total1') }}</span>
                                            @else
                                                <span
                                                    id="final-cost">{{ App\Models\Product::convertPrice($totalPrice) }}</span>
                                                <span class="currency">{{ $curr->sign }}</span>
                                            @endif

                                        </p>

                                    </div>
                                    {{-- Final Price Area End --}}

                                @endif

                                {{-- <a href="{{ route('front.checkout',$sign) }}" class="order-btn mt-4">
                            {{ $langg->lang135 }}
                        </a> --}}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Check Out Area End-->

    @if (isset($checked))

        <!-- LOGIN MODAL -->
        <div class="modal fade" id="comment-log-reg1" data-keyboard="false" data-backdrop="static" tabindex="-1"
            role="dialog" aria-labelledby="comment-log-reg-Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" aria-label="Close">
                            <a href="{{ url()->previous() }}"><span aria-hidden="true">&times;</span></a>
                        </button>
                    </div>
                    <div class="modal-body">
                        <nav class="comment-log-reg-tabmenu">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link login active" id="nav-log-tab" data-toggle="tab"
                                    href="#nav-log" role="tab" aria-controls="nav-log" aria-selected="true">
                                    {{ $langg->lang197 }}
                                </a>
                                <a class="nav-item nav-link" id="nav-reg-tab" data-toggle="tab" href="#nav-reg"
                                    role="tab" aria-controls="nav-reg" aria-selected="false">
                                    {{ $langg->lang198 }}
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-log" role="tabpanel"
                                aria-labelledby="nav-log-tab">
                                <div class="login-area">
                                    <div class="header-area">
                                        <h4 class="title">{{ $langg->lang172 }}</h4>
                                    </div>
                                    <div class="login-form signin-form">
                                        @include('includes.admin.form-login')
                                        <form id="loginform" action="{{ route('user.login.submit') }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-input">
                                                <input type="text" name="name"
                                                    placeholder="{{ $langg->lang173 }}" required="">
                                                <i class="icofont-user-alt-5"></i>
                                            </div>
                                            <div class="form-input">
                                                <input type="password" class="Password" name="password"
                                                    placeholder="{{ $langg->lang174 }}" required="">
                                                <i class="icofont-ui-password"></i>
                                            </div>
                                            <div class="form-forgot-pass">
                                                <div class="left">
                                                    <input type="hidden" name="modal" value="1">
                                                    <input type="checkbox" name="remember" id="mrp"
                                                        {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="mrp">{{ $langg->lang175 }}</label>
                                                </div>
                                                <div class="right">
                                                    <a href="{{ route('user-forgot') }}">
                                                        {{ $langg->lang176 }}
                                                    </a>
                                                </div>
                                            </div>
                                            <input id="authdata" type="hidden" value="{{ $langg->lang177 }}">
                                            <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
                                            @if (App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check == 1)
                                                <div class="social-area">
                                                    <h3 class="title">{{ $langg->lang179 }}</h3>
                                                    <p class="text">{{ $langg->lang180 }}</p>
                                                    <ul class="social-links">
                                                        @if (App\Models\Socialsetting::find(1)->f_check == 1)
                                                            <li>
                                                                <a
                                                                    href="{{ route('social-provider', ['provider' => 'facebook', 'lang' => $sign]) }}">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if (App\Models\Socialsetting::find(1)->g_check == 1)
                                                            <li>
                                                                <a
                                                                    href="{{ route('social-provider', ['provider' => 'google', 'lang' => $sign]) }}">
                                                                    <i class="fab fa-google-plus-g"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-reg-tab">
                                <div class="login-area signup-area">
                                    <div class="header-area">
                                        <h4 class="title">{{ $langg->lang181 }}</h4>
                                    </div>
                                    <div class="login-form signup-form">
                                        @include('includes.admin.form-login')
                                        <form id="registerform" action="{{ route('user-register-submit') }}"
                                            method="POST">
                                            {{ csrf_field() }}

                                            <div class="form-input">
                                                <input type="text" class="User Name" name="name"
                                                    placeholder="{{ $langg->lang182 }}" required="">
                                                <i class="icofont-user-alt-5"></i>
                                            </div>



                                            <div class="form-input">
                                                <input type="number" class="User Name" name="phone"
                                                    placeholder="{{ $langg->lang184 }}" required="">
                                                <i class="icofont-phone"></i>
                                            </div>

                                            <!--<div class="form-input">-->
                                            <!--    <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">-->
                                            <!--    <i class="icofont-location-pin"></i>-->
                                            <!--</div>-->

                                            <div class="form-input">
                                                <input type="password" class="Password" name="password"
                                                    placeholder="{{ $langg->lang186 }}" required="">
                                                <i class="icofont-ui-password"></i>
                                            </div>

                                            <div class="form-input">
                                                <input type="password" class="Password" name="password_confirmation"
                                                    placeholder="{{ $langg->lang187 }}" required="">
                                                <i class="icofont-ui-password"></i>
                                            </div>

                                            @if ($gs->is_capcha == 1)
                                                <ul class="captcha-area">
                                                    <li>
                                                        <p><img class="codeimg1"
                                                                src="{{ asset(' assets/images/capcha_code.png') }}"
                                                                alt=""> <i
                                                                class="fas fa-sync-alt pointer refresh_code "></i></p>
                                                    </li>
                                                </ul>

                                                <div class="form-input">
                                                    <input type="text" class="Password" name="codes"
                                                        placeholder="{{ $langg->lang51 }}" required="">
                                                    <i class="icofont-refresh"></i>
                                                </div>
                                            @endif

                                            <input id="processdata" type="hidden" value="{{ $langg->lang188 }}">
                                            <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGIN MODAL ENDS -->

    @endif

@endsection

@section('scripts')
    <script src="https://js.paystack.co/v1/inline.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countrySelect = document.querySelector('select[name="customer_country"]');

            if (countrySelect) {
                const targetOption = Array.from(countrySelect.options).find(option => option.value ===
                    "United Arab Emirates");

                if (targetOption) {
                    countrySelect.value = targetOption.value;

                    // Trigger the change event
                    const event = new Event('change', {
                        bubbles: true
                    });
                    countrySelect.dispatchEvent(event);
                }
            }
        });
    </script>


    <script>
        function to12HourFormat(time24) {
            const [hour, minute] = time24.split(':');
            const h = parseInt(hour);
            const ampm = h >= 12 ? 'PM' : 'AM';
            const h12 = h % 12 || 12;
            return `${h12}:${minute} ${ampm}`;
        }



        document.addEventListener('DOMContentLoaded', function() {

            const deliveryText = @json(__('Delivery Date'));

            const citySelect = document.querySelector('select[name="city"]');
            const deliveryInfo = document.getElementById('delivery-info');

            const scheduleIdInput = document.getElementById('shipping_schedule_id');
            const dateInput = document.getElementById('scheduled_delivery_date');
            const startInput = document.getElementById('scheduled_delivery_start_time');
            const endInput = document.getElementById('scheduled_delivery_end_time');

            if (citySelect) {
                citySelect.addEventListener('change', function() {
                    const cityName = this.value.trim();

                    if (!cityName) {
                        deliveryInfo.style.display = 'none';
                        deliveryInfo.textContent = ''; // Clear previous message
                        return;
                    }
                    const encodedCity = encodeURIComponent(cityName);
                    const url = `/city/${encodedCity}/available-shipping-slots`;

                    fetch(url, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.next_available) {
                                const slot = data.next_available;

                                const formattedText =
                                    `🚚 ${deliveryText}: ${slot.day}, ${slot.formatted_date} (${to12HourFormat(slot.schedule.start_time)} - ${to12HourFormat(slot.schedule.end_time)})`;


                                // Show delivery info
                                deliveryInfo.style.display = 'block';
                                deliveryInfo.textContent = formattedText;

                                // Fill hidden fields
                                scheduleIdInput.value = slot.schedule.id;
                                dateInput.value = slot.date.split('T')[0]; // YYYY-MM-DD
                                startInput.value = slot.schedule.start_time; // HH:MM
                                endInput.value = slot.schedule.end_time; // HH:MM
                            } else {
                                deliveryInfo.style.display = 'none';
                                scheduleIdInput.value = '';
                                dateInput.value = '';
                                startInput.value = '';
                                endInput.value = '';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching shipping slots:', error);
                            deliveryInfo.style.display = 'none';
                        });
                });
            }
        });
    </script>




    <script type="text/javascript">
        $('a.payment:first').addClass('active');
        $('.checkoutform').prop('action', $('a.payment:first').data('form'));
        $($('a.payment:first').attr('href')).load($('a.payment:first').data('href'));


        var show = $('a.payment:first').data('show');
        if (show != 'no') {
            $('.pay-area').removeClass('d-none');
        } else {
            $('.pay-area').addClass('d-none');
        }
        $($('a.payment:first').attr('href')).addClass('active').addClass('show');
        $("#session").load("{{ url('getapi') }}");
    </script>


    <script type="text/javascript">
        var coup = 0;
        var pos = {{ $gs->currency_format }};

        @if (isset($checked))

            $('#comment-log-reg1').modal('show');
        @endif

        var mship = $('.shipping').length > 0 ? $('.shipping').first().val() : 0;
        var mpack = $('.packing').length > 0 ? $('.packing').first().val() : 0;
        var wallet = $('.wallet').length > 0 ? $('.wallet').first().val() : 0;
        var shipping_price = $(".shipping_price").val();

        mship = parseFloat(mship);
        mpack = parseFloat(mpack);
        wallet = parseFloat(wallet);
        shipping_price = parseFloat(shipping_price);
        o = parseFloat($(".shep").text());

        $('#shipping-cost').val(mship);

        $('#packing-cost').val(mpack);
        var ftotal = parseFloat($('#grandtotal').val()) + mship + mpack - wallet;
        ftotal = parseFloat(ftotal);
        if (ftotal % 1 != 0) {
            ftotal = ftotal.toFixed(2);
        }
        if (pos == 0) {
            $('#final-cost').html(ftotal)
        } else {
            $('#final-cost').html(ftotal)
        }

        $('#grandtotal').val(ftotal);

        $('#shipop').on('change', function() {

            var val = $(this).val();
            if (val == 'pickup') {
                $('#shipshow').removeClass('d-none');
                $('#shipshow').addClass('mb-2');
                $('#shipop').addClass('mb-2');
                $("#ship-diff-address").parent().addClass('d-none');
                $('.ship-diff-addres-area').addClass('d-none');
                $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required', false);
                $('.shipment').addClass('d-none');
                $("#final-btn").removeAttr("disabled");
                $('#shiphide').addClass('d-none');
                var ftotal = parseFloat($('#grandtotal').val());
                if (pos == 0) {
                    $('#final-cost').html(ftotal)
                } else {

                    $('#final-cost').html(ftotal)

                }
            } else {
                $('#shipshow').addClass('d-none');
                $("#ship-diff-address").parent().removeClass('d-none');
                $('.ship-diff-addres-area').removeClass('d-none');
                $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required', true);
                $('.shipment').removeClass('d-none');
                $(".shipment_id").prop('required', true);
                $("#final-btn").prop("disabled", true);
                $('#shiphide').removeClass('d-none');

                var ftotal = parseFloat($('#grandtotal').val()) + parseFloat($(".r").val());
                if (pos == 0) {
                    $('#final-cost').html('{{ $curr->sign }}' + ftotal)
                } else {

                    $('#final-cost').html(ftotal + '{{ $curr->sign }}')

                }


            }

        });

        if ($('#shipop').val() == "shipto") {
            $("#final-btn").prop("disabled", true);
        }



        $('.shipping').on('click', function() {
            mship = $(this).val();

            $('#shipping-cost').val(mship);
            var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack) + parseFloat($(
                ".shipping_price").val()) - parseFloat(wallet);
            ttotal = parseFloat(ttotal);
            if (ttotal % 1 != 0) {
                ttotal = ttotal.toFixed(2);
            }
            if (pos == 0) {
                $('#final-cost').html('{{ $curr->sign }}' + ttotal);
            } else {
                $('#final-cost').html(ttotal + '{{ $curr->sign }}');
            }

            $('#grandtotal').val(ttotal);

        })

        $('.wallet').on('click', function() {

            wallet = $(this).val();
            if (wallet == 0) {
                var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack) +
                    parseFloat($(".shipping_price").val()) - parseFloat(wallet);
                $('#wallet-cost').val(wallet)
            } else {


                $('#wallet-cost').val(wallet);

                if (parseFloat($('#grandtotal').val()) > wallet) {

                    var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack) +
                        parseFloat($(".shipping_price").val()) - parseFloat(wallet);
                    //$('#wallet-cost').val(0);


                } else {
                    var wl = parseFloat(wallet) - parseFloat($('#tgrandtotal').val()) + parseFloat(mship) +
                        parseFloat($(".shipping_price").val()) + parseFloat(mpack);
                    $('#wallet-cost').val(wl);

                    var ttotal = 0;

                }

            }



            ttotal = parseFloat(ttotal);
            if (ttotal % 1 != 0) {
                ttotal = ttotal.toFixed(2);
            }
            if (pos == 0) {
                $('#final-cost').html(ttotal);
            } else {
                $('#final-cost').html(ttotal);
            }

            $('#grandtotal').val(ttotal);

        })

        $('.packing').on('click', function() {
            mpack = $(this).val();
            $('#packing-cost').val(mpack);
            var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack) + parseFloat($(
                ".shipping_price").val()) - parseFloat(wallet);
            ttotal = parseFloat(ttotal);
            if (ttotal % 1 != 0) {
                ttotal = ttotal.toFixed(2);
            }

            if (pos == 0) {
                $('#final-cost').html('{{ $curr->sign }}' + ttotal);
            } else {
                $('#final-cost').html(ttotal + '{{ $curr->sign }}');
            }


            $('#grandtotal').val(ttotal);

        })

        $("#check-coupon-form").on('submit', function() {
            var val = $("#code").val();
            var total = $("#grandtotal").val();
            //  var user = $("#user_id").val();
            var ship = 0;
            $.ajax({
                type: "GET",
                url: mainurl2 + "/carts/coupon/check",
                data: {
                    code: val,
                    total: total,
                    shipping_cost: ship
                },
                success: function(data) {


                    if (data == 11 || data == 12) {

                        if (data == 2) {
                            toastr.error(langg.already_coupon);
                            $("#code").val("");
                        } else if (data == 11) {
                            toastr.error('Total Price Is Less Than Coupon Limit');
                            $("#code").val("");
                        } else {
                            toastr.success('Free Shipping');
                            $("#code").val("");
                            $(".forget").removeClass('d-none');
                            $(".coupon").addClass('d-none');
                            $(".shep").html('');
                            $(".shep").html(0);
                            $(".r").val('');
                            $(".r").val(0);
                            var ftotal = parseFloat($('#grandtotal').val());
                            ftotal = ftotal.toFixed(2);

                            $('#final-cost').html(ftotal)









                        }

                    } else {


                        if (data == 9) {
                            toastr.error(langg.invalid_coupon);
                            $("#code").val("");
                        } else if (data == 0) {
                            toastr.error(langg.no_coupon);
                            $("#code").val("");
                        } else if (data == 2) {
                            toastr.error(langg.already_coupon);
                            $("#code").val("");
                        } else {
                            $("#check-coupon-form").toggle();
                            $(".discount-bar").removeClass('d-none');
                            $(".forget").removeClass('d-none');
                            $(".coupon").addClass('d-none');

                            if (pos == 0) {
                                $('#total-cost').html(data[0]);
                                $('#discount').html(data[2]);
                            } else {
                                $('#total-cost').html(data[0]);
                                $('#discount').html(data[2]);
                            }



                            $('#grandtotal').val(data[0]);
                            $('#tgrandtotal').val(data[0]);
                            $('#coupon_code').val(data[1]);
                            $('#coupon_id').val(data[3]);
                            $('#coupon_discount').val(data[2]);
                            if (data[4] != 0) {
                                $('.dpercent').html('(' + data[4] + ')');
                                /**/
                            } else {
                                $('.dpercent').html('');


                            }
                            if (data[7] == 3) {


                                window.location = location.href;
                            }




                            var ttotal = parseFloat($('#grandtotal').val()) + parseFloat(mship) +
                                parseFloat(mpack);
                            ttotal = parseFloat(ttotal);
                            if (ttotal % 1 != 0) {
                                ttotal = ttotal.toFixed(2);
                            }

                            if (pos == 0) {
                                $('#final-cost').html(ttotal)
                            } else {
                                $('#final-cost').html(ttotal)
                            }




                            toastr.success(langg.coupon_found);
                            $("#code").val("");


                        }

                    }


                } // end successsssssss
            });
            return false;
        });

        // Password Checking

        $("#open-pass").on("change", function() {
            if (this.checked) {
                $('.set-account-pass').removeClass('d-none');
                $('.set-account-pass input').prop('required', true);
                $('#personal-email').prop('required', true);
                $('#personal-name').prop('required', true);
            } else {
                $('.set-account-pass').addClass('d-none');
                $('.set-account-pass input').prop('required', false);
                $('#personal-email').prop('required', false);
                $('#personal-name').prop('required', false);

            }
        });

        // Password Checking Ends


        // Shipping Address Checking

        $("#ship-diff-address").on("change", function() {
            if (this.checked) {
                $('.ship-diff-addres-area').removeClass('d-none');
                $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required', true);
            } else {
                $('.ship-diff-addres-area').addClass('d-none');
                $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required', false);
            }

        });


        // Shipping Address Checking Ends
    </script>


    <script type="text/javascript">
        var ck = 0;

        $('.checkoutform').on('submit', function(e) {
            if (ck == 0) {
                e.preventDefault();
                $('#pills-step2-tab').removeClass('disabled');
                $('#pills-step2-tab').click();

            } else {
                $('#preloader').show();
            }
            $('#pills-step1-tab').addClass('active');
        });

        $('#step1-btn').on('click', function() {
            $('#pills-step1-tab').removeClass('active');
            $('#pills-step2-tab').removeClass('active');
            $('#pills-step3-tab').removeClass('active');
            $('#pills-step2-tab').addClass('disabled');
            $('#pills-step3-tab').addClass('disabled');

            $('#pills-step1-tab').click();

        });

        // Step 2 btn DONE

        // 	$('#step2-btn').on('click',function(){
        // 		$('#pills-step3-tab').removeClass('active');
        // 		$('#pills-step1-tab').removeClass('active');
        // 		$('#pills-step2-tab').removeClass('active');
        // 		$('#pills-step3-tab').addClass('disabled');
        // 		$('#pills-step2-tab').click();
        // 		$('#pills-step1-tab').addClass('active');

        // 	});


        // 	$('#step3-btn').on('click',function(){
        // 	 	if($('a.payment:first').data('val') == 'paystack'){
        // 			$('.checkoutform').prop('id','step1-form');
        // 		}
        // 		else {
        // 			$('.checkoutform').prop('id','');
        // 		}
        // 		$('#pills-step3-tab').removeClass('disabled');
        // 		$('#pills-step3-tab').click();

        //         @if (Auth::check())
        //       		var shipping_user = $('input[name="shipping_name"]').val() || $('input[name="personal_name"]').val() || '';
        //         @else
        // 		var shipping_user = $('input[name="shipping_name"]').val() || $('input[name="personal_name"]').val() || '';

        //         @endif

        //         @if (Auth::check())
        // 		var shipping_address = $('input[name="shipping_address"]').val() || $('input[name="address"]').val() || '';
        //     var shipping_country = $('input[name="customer_country"]').val() || '';
        //     var shipping_city = $('input[name="city"]').val() || '';
        //     // var shipping_location = shipping_address ? shipping_address : (shipping_country + " , " + shipping_city);

        //         var shipping_location = (shipping_country + " , " + shipping_city);


        //         @else
        // 		var shipping_address = $('input[name="shipping_address"]').val() || $('input[name="address"]').val() || '';
        //     var shipping_country = $('input[name="customer_country"]').val() || '';
        //     var shipping_city = $('input[name="city"]').val() || '';
        //     // var shipping_location = shipping_address ? shipping_address : (shipping_country + " , " + shipping_city);

        //         var shipping_location = (shipping_country + " , " + shipping_city);


        //         @endif

        //         @if (Auth::check())
        // 		var shipping_phone = $('input[name="shipping_phone"]').val() || $('select[name="phone"]').val() || $('input[name="phone"]').val() || '';

        //         @else
        // 		var shipping_phone = $('input[name="shipping_phone"]').val() || $('select[name="phone"]').val() || $('input[name="phone"]').val() || '';

        //         @endif




        $('#step3-btn').on('click', function() {
            if ($('a.payment:first').data('val') == 'paystack') {
                $('.checkoutform').prop('id', 'step1-form');
            } else {
                $('.checkoutform').prop('id', '');
            }

            $('#pills-step3-tab').removeClass('disabled');
            $('#pills-step3-tab').click();

            // ===== Common Shipping Fields for both Authenticated and Guest users =====
            var shipping_user = $('input[name="shipping_name"]').val() || $('input[name="personal_name"]').val() ||
                '';
            var shipping_address = $('input[name="shipping_address"]').val() || $('input[name="address"]').val() ||
                '';
            var shipping_country = $('[name="customer_country"]').val() || '';
            var shipping_city = $('[name="city"]').val() || '';

            var shipping_area = $('input[name="area"]').val() || '';
            var building_number = $('input[name="building_number"]').val() || '';
            var shipping_phone = $('input[name="shipping_phone"]').val() || $('select[name="phone"]').val() || $(
                'input[name="phone"]').val() || '';
            @if (Auth::check())
                var shipping_name = !$('input[name="shipping_name"]').val() ? $('input[name="personal_name"]')
                    .val() : $('input[name="shipping_name"]').val();
                var shipping_phone = !$('input[name="shipping_phone"]').val() ? $('select[name="phone"]').val() : $(
                    'input[name="shipping_phone"]').val();
            @else
                var shipping_phone = !$('input[name="shipping_phone"]').val() ? $('input[name="phone"]').val() : $(
                    'input[name="shipping_phone"]').val();
            @endif

            // ===== Assemble Location =====
            var shipping_location_parts = [];

            if (shipping_address) shipping_location_parts.push(shipping_address);


            if (building_number) shipping_location_parts.push(building_number);
            if (shipping_area) shipping_location_parts.push(shipping_area);

            if (shipping_city) shipping_location_parts.push(shipping_city);
            if (shipping_country) shipping_location_parts.push(shipping_country);

            var shipping_location = shipping_location_parts.join(" , ");

            // ===== Set Preview Data =====
            $('#shipping_user').html('<i class="fas fa-user"></i> ' + shipping_user);
            $('#shipping_location').html('<i class="fas fa-map-marker-alt"></i> ' + shipping_location);
            $('#shipping_phone').html('<i class="fas fa-phone"></i> ' + shipping_phone);
            @if (Auth::check())
                $('#shipping_name').html('<i class="fas fa-user"></i>' + shipping_name);
                $('#shipping_phone').html('<i class="fas fa-phone"></i>' + shipping_phone);
            @else
                $('#shipping_phone').html('<i class="fas fa-phone"></i>' + shipping_phone);
            @endif

            $('#pills-step1-tab').addClass('active');
            $('#pills-step2-tab').addClass('active');
        });

        $('#final-btn').on('click', function() {
            ck = 1;
        })


        $('.payment').on('click', function() {
            if ($(this).data('val') == 'paystack') {
                $('.checkoutform').prop('id', 'step1-form');
            } else {
                $('.checkoutform').prop('id', '');
            }
            $('.checkoutform').prop('action', $(this).data('form'));
            $('.pay-area #v-pills-tabContent .tab-pane.fade').not($(this).attr('href')).html('');
            var show = $(this).data('show');
            if (show != 'no') {
                $('.pay-area').removeClass('d-none');
            } else {
                $('.pay-area').addClass('d-none');
            }
            $($(this).attr('href')).load($(this).data('href'));
        })




        $(document).on('submit', '#step1-form', function() {
            $('#preloader').hide();
            var val = $('#sub').val();
            var total = $('#grandtotal').val();



            if (val == 0) {
                var handler = PaystackPop.setup({
                    key: '{{ $gs->paystack_key }}',
                    email: $('input[name=email]').val(),
                    amount: total * 100,
                    currency: "{{ $curr->name }}",
                    ref: '' + Math.floor((Math.random() * 1000000000) + 1),
                    callback: function(response) {
                        $('#ref_id').val(response.reference);
                        $('#sub').val('1');
                        $('#final-btn').click();
                    },
                    onClose: function() {
                        window.location.reload();

                    }
                });
                handler.openIframe();
                return false;
            } else {
                $('#preloader').show();
                return true;
            }

        });
    </script>
    <script>
        $(document).ready(function() {
            $("Select[name='customer_country']").change(function() {

                var id = $(this).val();
                var url = "{{ url('/cities') }}";
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function(data) {
                        $("[name='city']").html('');
                        $("[name='city']").html(data.options);


                    }
                });
            });
            $("Select[name='address']").change(function() {
                var id = $(this).val();
                var url = "{{ url('/getAddressForCheckout') }}";
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function(data) {
                        $("input[name='customer_country']").val(data.country);
                        $("input[name='city']").val(data.city);
                        $("input[name='addressWhenAuth']").val(data.address);

                        // Move the second change function here
                        var city_id = $("input[name='city']").val();
                        var product = $("#p").val();
                        var url = "{{ url('/shipments') }}";
                        var token = $("input[name='_token']").val();
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                id: city_id,
                                product: product,
                                _token: token
                            },
                            success: function(data) {
                                /* $("#final-btn").removeAttr("disabled");*/

                                $(".shep").html('');
                                $(".shep").html(data.options);
                                $(".r").val('');
                                $(".r").val(data.options);

                                //    n = parseFloat($(".r").val());
                                n = parseFloat($(".shipping_price").val());
                                var ftotal = parseFloat($('#grandtotal').val()) + n;

                                ftotal = parseFloat(ftotal);

                                if (ftotal % 1 != 0) {
                                    ftotal = ftotal.toFixed(2);
                                }
                                if (pos == 0) {
                                    $('#final-cost').html(ftotal)
                                } else {

                                    $('#final-cost').html(ftotal)

                                }

                                //$('#grandtotal').val(ftotal);




                                var id = $("input[name='city']").val();
                                var url = "{{ url('/shipmentss') }}";
                                var token = $("input[name='_token']").val();
                                $.ajax({
                                    url: url,
                                    method: 'POST',
                                    data: {
                                        id: id,
                                        _token: token
                                    },
                                    success: function(data) {

                                        $(".ship").html('');
                                        $(".ship").html(data.options);



                                    },
                                    failed: function(data) {
                                        successmessage =
                                            'No Delivery in This City';
                                        $(".ship").html(successmessage);
                                    },

                                });

                            },
                            error: function(data) {
                                // Your code for the second change function's error callback
                            }
                        });
                    }
                });
            });


            $("Select[name='city']").change(function() {

                var id = $(this).val();
                var url = "{{ url('/shipmentss') }}";
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function(data) {

                        $(".ship").html('');
                        $(".ship").html(data.options);



                    },
                    failed: function(data) {
                        successmessage = 'No Delivery in This City';
                        $(".ship").html(successmessage);
                    },

                });
            });



            @if (!Auth::check())




                $("Select[name='customer_country']").change(function() {

                    var id = $(this).val();
                    var url = "{{ url('/phonenumbers') }}";
                    var token = $("input[name='_token']").val();
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function(data) {


                            if (data.options != 0) {
                                $(".phone").html('');
                                $(".phone").html(
                                    '<input type="text" name="phone" required  minlength="' +
                                    data.options + '"  maxlength="' + data.options +
                                    '" class="form-control"	placeholder="' + langg.lang153 +
                                    '">');
                            }

                        }
                    });
                });
            @endif




        });
    </script>

    <script>
        $(document).ready(function() {
            /*            
                     if ( /*___directives_script_22___*/
        ) {
            $("#cityaddress").change(function() {

                var city = $(this).val();
                var url = "{{ url('/addressscity') }}";
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        city: city,
                        _token: token
                    },
                    success: function(data) {

                        $("[name='address']").html('');
                        $("[name='address']").html(data.options);



                    },


                });
            });

            $("Select[name='shipping_country']").change(function() {

                var id = $(this).val();
                var url = "{{ url('/cities') }}";
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function(data) {
                        $("[name='shipping_city']").html('');
                        $("[name='shipping_city']").html(data.options);

                    }
                });
            });

        });
    </script>
    <script>
        $(document).ready(function() {

            @if (Auth::check())
                @if (Auth::guard('web')->user()->city)
                    var id = $('#city').val();
                    var url = "{{ url('/shipmentss') }}";
                    var token = $("input[name='_token']").val();
                    console.log('ffffffffffffffffffffff');
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function(data) {

                            $(".ship").html('');
                            $(".ship").html(data.options);



                        },
                        failed: function(data) {
                            successmessage = 'No Delivery in This City';

                            $(".ship").html(successmessage);
                        },

                    });

                    $("Select[name='city']").change(function() {

                        var id = $(this).val();
                        var url = "{{ url('/shipmentss') }}";
                        var token = $("input[name='_token']").val();
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                id: id,
                                _token: token
                            },
                            success: function(data) {

                                $(".ship").html('');
                                $(".ship").html(data.options);



                            },
                            failed: function(data) {
                                successmessage = 'No Delivery in This City';
                                $(".ship").html(successmessage);
                            },

                        });
                    });
                @else

                    $("Select[name='city']").change(function() {

                        var id = $(this).val();
                        var url = "{{ url('/shipmentss') }}";
                        var token = $("input[name='_token']").val();
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                id: id,
                                _token: token
                            },
                            success: function(data) {

                                $(".ship").html('');
                                $(".ship").html(data.options);



                            },
                            failed: function(data) {
                                successmessage = 'No Delivery in This City';
                                $(".ship").html(successmessage);
                            },

                        });
                    });
                @endif
            @else

                $("Select[name='city']").change(function() {

                    var id = $(this).val();
                    var url = "{{ url('/shipmentss') }}";
                    var token = $("input[name='_token']").val();
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function(data) {

                            $(".ship").html('');
                            $(".ship").html(data.options);



                        },
                        failed: function(data) {
                            successmessage = 'No Delivery in This City';

                            $(".ship").html(successmessage);
                        },

                    });
                });
            @endif


        });
    </script>


    <script>
        $(document).ready(function() {

            @if (Auth::check())
                @if (Auth::guard('web')->user()->city)
                    var id = $('#city').val();
                    var product = $("#p").val();
                    var url = "{{ url('/shipments') }}";
                    var token = $("input[name='_token']").val();
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                            product: product,
                            _token: token
                        },
                        success: function(data) {
                            /* $("#final-btn").removeAttr("disabled");*/
                            $(".shep").html('');
                            $(".shep").html(data.options);
                            $(".r").val('');
                            $(".r").val(data.options);
                            if ($('#shipop').val() == "shipto") {
                                //    n = parseFloat($(".r").val());
                                n = parseFloat($(".shipping_price").val());
                                var ftotal = parseFloat($('#grandtotal').val()) + n;

                                ftotal = parseFloat(ftotal);

                                if (ftotal % 1 != 0) {
                                    ftotal = ftotal.toFixed(2);
                                }
                                if (pos == 0) {
                                    $('#final-cost').html(ftotal)
                                } else {

                                    $('#final-cost').html(ftotal)

                                }

                                //$('#grandtotal').val(ftotal);
                            }
                        },
                        failed: function(data) {
                            successmessage = 'No Delivery in This City';
                            $(".shep").html(successmessage);
                        },
                        /*else{
                            $("#final-btn").addAttr("disabled");
                            $('.ship').append("<div class='classname'>No Delivery To This City</div>");
                        }*/
                    });

                    $("Select[name='city']").change(function() {
                        var id = $(this).val();
                        var product = $("#p").val();
                        var url = "{{ url('/shipments') }}";
                        var token = $("input[name='_token']").val();
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                id: id,
                                product: product,
                                _token: token
                            },
                            success: function(data) {
                                /* $("#final-btn").removeAttr("disabled");*/
                                $(".shep").html('');
                                $(".shep").html(data.options);
                                $(".r").val('');
                                $(".r").val(data.options);
                                if ($('#shipop').val() == "shipto") {
                                    n = parseFloat($(".shipping_price").val());

                                    var ftotal = parseFloat($('#grandtotal').val()) + n;

                                    ftotal = parseFloat(ftotal);

                                    if (ftotal % 1 != 0) {
                                        ftotal = ftotal.toFixed(2);
                                    }
                                    if (pos == 0) {
                                        $('#final-cost').html(ftotal)
                                    } else {

                                        $('#final-cost').html(ftotal)

                                    }

                                    //$('#grandtotal').val(ftotal);
                                }
                            },
                            failed: function(data) {
                                successmessage = 'No Delivery in This City';
                                $(".shep").html(successmessage);
                            },
                            /*else{
                                $("#final-btn").addAttr("disabled");
                                $('.ship').append("<div class='classname'>No Delivery To This City</div>");
                            }*/
                        });
                    });
                @else

                    $("Select[name='city']").change(function() {
                        var id = $(this).val();
                        var product = $("#p").val();
                        var url = "{{ url('/shipments') }}";
                        console.log('ggg');
                        var token = $("input[name='_token']").val();
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                id: id,
                                product: product,
                                _token: token
                            },
                            success: function(data) {
                                /* $("#final-btn").removeAttr("disabled");*/
                                $(".shep").html('');
                                $(".shep").html(data.options);
                                $(".r").val('');
                                $(".r").val(data.options);
                                if ($('#shipop').val() == "shipto") {
                                    n = parseFloat($(".shipping_price").val());

                                    var ftotal = parseFloat($('#grandtotal').val()) + n;

                                    ftotal = parseFloat(ftotal);

                                    if (ftotal % 1 != 0) {
                                        ftotal = ftotal.toFixed(2);
                                    }
                                    if (pos == 0) {
                                        $('#final-cost').html(ftotal)
                                    } else {

                                        $('#final-cost').html(ftotal)

                                    }

                                    //$('#grandtotal').val(ftotal);
                                }
                            },
                            failed: function(data) {
                                successmessage = 'No Delivery in This City';
                                $(".shep").html(successmessage);
                            },
                            /*else{
                                $("#final-btn").addAttr("disabled");
                                $('.ship').append("<div class='classname'>No Delivery To This City</div>");
                            }*/
                        });
                    });
                @endif
            @else

                $("Select[name='city']").change(function() {
                    var id = $(this).val();
                    var product = $("#p").val();
                    var url = "{{ url('/shipments') }}";
                    console.log('sssshh');
                    var token = $("input[name='_token']").val();
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                            product: product,
                            _token: token
                        },
                        success: function(data) {
                            /* $("#final-btn").removeAttr("disabled");*/
                            $(".shep").html('');
                            $(".shep").html(data.options);
                            $(".r").val('');
                            $(".r").val(data.options);
                            if ($('#shipop').val() == "shipto") {
                                n = parseFloat($(".shipping_price").val());

                                var ftotal = parseFloat($('#grandtotal').val()) + n;

                                ftotal = parseFloat(ftotal);

                                if (ftotal % 1 != 0) {
                                    ftotal = ftotal.toFixed(2);
                                }
                                if (pos == 0) {
                                    $('#final-cost').html(ftotal)
                                } else {

                                    $('#final-cost').html(ftotal)

                                }

                                //$('#grandtotal').val(ftotal);
                            } else {
                                n = parseFloat($(".shipping_price").val());


                                var ftotal = parseFloat($('#grandtotal').val()) + n;
                                if (pos == 0) {
                                    $('#final-cost').html(ftotal)
                                } else {

                                    $('#final-cost').html(ftotal)

                                }

                            }
                        },
                        failed: function(data) {
                            successmessage = 'No Delivery in This City';
                            $(".shep").html(successmessage);
                        },
                        /*else{
                            $("#final-btn").addAttr("disabled");
                            $('.ship').append("<div class='classname'>No Delivery To This City</div>");
                        }*/
                    });
                });
            @endif


        });
    </script>

    <script>
        function allowCashCheck() {
            var citySelect = document.getElementById("city");
            console.log(citySelect);
            var selectedCity = citySelect.value;
            var cashOption = document.getElementById("v-pills-tab3-tab");
            var cashNotAllowed = document.getElementById("cashNotAllowed");
            var token = $("input[name='_token']").val();
            var url = "{{ route('allow-cash') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id: selectedCity,
                    _token: token
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.allowCashPayment) {
                        cashOption.style.display = "block";
                        cashNotAllowed.style.display = "none";
                    } else {
                        cashOption.style.display = "none";
                        cashNotAllowed.style.display = "block";
                    }
                },
                error: function() {
                    console.log("Error checking city cash payment");
                }
            });
        }

        var citySelect = document.getElementById("city");
        var addressSelect = document.getElementById("address");

        citySelect.addEventListener("change", allowCashCheck);
        addressSelect.addEventListener("change", allowCashCheck);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentLinks = document.querySelectorAll('.payment');
            const paymentMethodInput = document.getElementById('payment_gateway_id');

            paymentLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Hide all details
                    document.querySelectorAll('.payment-details').forEach(detail => {
                        detail.style.display = 'none';
                    });

                    // Remove active class from all
                    paymentLinks.forEach(p => p.classList.remove('active'));

                    // Add active to the clicked one
                    this.classList.add('active');

                    // Show the selected payment details
                    const selectedId = this.getAttribute('data-val');
                    const detailBox = document.getElementById(`details-${selectedId}`);
                    if (detailBox) {
                        detailBox.style.display = 'block';
                    }

                    // Set hidden input value
                    if (paymentMethodInput) {
                        paymentMethodInput.value = selectedId;
                    }
                });
            });
        });
    </script>
@endsection
