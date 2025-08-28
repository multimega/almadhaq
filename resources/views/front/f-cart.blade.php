@extends('layouts.front_34')

@section('content')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();

if (Session::has('currency')) {
        
              $curr =  App\Models\Currency::find(Session::get('currency'));
        
             }else {
    
                $curr =  App\Models\Currency::where('is_default','=',1)->first();
}

@endphp
<!-- Start Shipping Aside -->
<div class="shipping-aside">
    <div class="shipping-aside-container">
        <div class="bg-white mb-3 py-3">
            <div class="px-3 py-2 shipping-aside-head d-flex justify-content-between align-items-center">
                <h4>Delivery Locations</h4>
                <h4 class="close-aside">x</h4>
            </div>
            <div class="mx-3">
                <input type="text" class="form-control" placeholder="Location">
            </div>
        </div>
        
        <div class="bg-white mb-3 p-3">
            <div class="shipping-locations">
                <ul class="unstyled-list p-0">
                    <li class="d-flex justify-content-between align-items-center"><span>Cairo</span><input type="radio" name="adress"></li>
                    <li class="d-flex justify-content-between align-items-center"><span>Mansoura</span><input type="radio" name="adress"></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Shipping Aside -->
<!-- Start Cart Sec -->
<div class="cart-p">
    <div class="row m-0">
        <div class="col-md-8">
            @include('includes.form-success')
            @if(Session::has('cart'))
                @foreach($products as $product)
                <div class="cart-qty-delivery d-flex justify-content-between align-items-center mb-2">
                    <h3>Cart <span>({{count($products)}})</span></h3>
                    <!--<h4>Deliver to <span class="shiping-to-btn">Al Haram</span></h4>-->
                </div>
                <div class="cart-table d-flex align-items-center cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
                    <div class="cart-item-img m-auto">
                        <img src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" class="w-100">
                    </div>
                    <div class="cart-item-info">
                        <!--<span class="brand">Calvin Klein</span>-->
                        <h3 class="name">
                            @if(!$slang)
                              @if($lang->id == 2)
                              {!!strlen($product['item']['name_ar']) > 100 ? substr($product['item']['name_ar'],0,100).'...' : $product['item']['name_ar']!!}
                              @else 
                              {{strlen($product['item']['name']) > 35 ? substr($product['item']['name'],0,35).'...' : $product['item']['name']}}
                              @endif 
                          @else  
                              @if($slang == 2) 
                              {!!strlen($product['item']['name_ar']) > 100 ? substr($product['item']['name_ar'],0,100).'...' : $product['item']['name_ar']!!}
                              @else
                              {{strlen($product['item']['name']) > 35 ? substr($product['item']['name'],0,35).'...' : $product['item']['name']}}
                              @endif
                          @endif
                        </h3>
                        <span class="time">
                            @if(!empty($product['size']))
                                <b>{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{$product['size']}} <br>
                                @endif
                                @if(!empty($product['color']))
                                <div class="d-flex mt-2">
                                <b>{{ $langg->lang313 }}</b>:  <span id="color-bar" style="border: 10px solid #{{$product['color'] == "" ? "white" : $product['color']}};"></span>
                                </div>
                                @endif

                                    @if(!empty($product['keys']))

                                    @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)
                                       @php
                                             $atrr = App\Models\Attribute::where('input_name',$key)->first();
                                             $atrroption = App\Models\AttributeOption::where('name',$value)->first();
                                             
                                      @endphp
                                      
                                      
                                                            <b>@if($atrr)
                                    @if(!$slang)
                                          @if($lang->id == 2)
                                         {{ ucwords(str_replace('_', ' ', $atrr->name_ar))  }} :
                                          @else 
                                        {{ ucwords(str_replace('_', ' ', $atrr->name))  }} :
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                        {{ ucwords(str_replace('_', ' ', $atrr->name_ar))  }} :
                                          @else
                                         {{ ucwords(str_replace('_', ' ', $atrr->name))  }} :
                                          @endif
                                      @endif
                                      @else
                                      
                                     {{ ucwords(str_replace('_', ' ', $key))  }} :
                                      @endif </b> @if($atrroption)
                                        @if(!$slang)
                                          @if($lang->id == 2)
                                             {{$atrroption->name_ar}}
                                              @else 
                                             {{$atrroption->name}}
                                              @endif 
                                          @else  
                                              @if($slang == 2) 
                                             {{$atrroption->name_ar}}
                                              @else
                                              {{$atrroption->name}} 
                                              @endif
                                          @endif
                                        @else
                                        
                                        {{ $value }}
                                        @endif  <br>
                                                        @endforeach
    
                                                        @endif
    
                        </span>
                        <!--<span class="delivery">Free delivery by <span class="text-success">Sat, May 1</span></span>-->
                        <!--<span class="buyer">solid by <strong>Noon</strong></span>-->
                        <!--<span class="return"><i class="fas fa-undo"></i> This item cannot be exchanged or returned.</span>-->
                        <span class="removecart cart-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}"><i class="fas fa-trash-alt text-danger"></i> </span>
                      
                    </div>
                    <div class="cart-item-right">
                        <span class="price product-unit-price">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
                        <b id="prc{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                          {{ App\Models\Product::convertPrice($product['price']) }} 
                         </b>
                        @if($product['item']['type'] == 'Physical')
                        <div class="qty">
                          <ul class="list-unstyled d-flex">
                              <input type="hidden" class="prodid" value="{{$product['item']['id']}}">  
                              <input type="hidden" class="itemid" value="{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">     
                              <input type="hidden" class="size_qty" value="{{$product['size_qty']}}">     
                              <!--<input type="hidden" class="size_price" value="{{$product['size_price']}}">   -->   
                                  
                                <input type="hidden" class="size_price"  value="{{$product['item']['price']}}" >
              
                            <li>
                              <span class="qtminus1 reducing">
                                <i class="icofont-minus"></i>
                              </span>
                            </li>
                            <li>
                              <span class="qttotal1" id="qty{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ $product['qty'] }}</span>
                            </li>
                            <li>
                              <span class="qtplus1 adding">
                                <i class="icofont-plus"></i>
                              </span>
                            </li>
                          </ul>
                      </div>
                        @endif
                        <!--<img src="assets/images/express.png">-->
                    </div>
                </div>
                @endforeach
            @endif
            <div class="continue-shopping my-5">
                <a href="{{route('front.index',$sign)}}">Continue Shopping</a>
            </div>
        </div>
        @if(Session::has('cart'))
        <div class="col-md-4">
            <div class="cart-form">
                <h3>{{ $langg->lang127 }}</h3>
                <!--<form class="form-inline">-->
                <!--    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Coupon Code or Gift Card">-->
                <!--    <button type="submit" class="btn btn-primary mb-2">APPLY</button>-->
                <!--</form>-->
                <div class="subtotal d-flex justify-content-between  align-items-center">
                    <p>{{ $langg->lang128 }}</p>
                    <span class="cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' }}</span>
                </div>
                <div class="subtotal d-flex justify-content-between  align-items-center">
                    <p>{{ $langg->lang129 }}</p>
                    <span class="text-primary discount">{{ App\Models\Product::convertPrice(0)}}</span>
                    <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(0)}}">
                </div>
                <div class="subtotal d-flex justify-content-between  align-items-center">
                    <p>{{ $langg->lang130 }}</p>
                    <span>{{$tx}}%</span>
                </div>
                <hr>
                <div class="total d-flex justify-content-between  align-items-center">
                    <p>{{ $langg->lang131 }}</p>
                    <span class="main-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}   {{$curr->sign}}</span>
                </div>
                <a href="{{ route('front.f-checkout',$sign) }}" class="order-btn btn btn-primary d-block text-white">
                  {{ $langg->lang135 }}
                </a>
            </div>
            <!--<p class="text-center mt-3 font-weight-bold"><span class="text-success">Earn EGP 2.4 cashback.</span> Add noon VIP to cart</p>-->
            <!--<img src="assets/images/cart_ads.png" class="w-100">-->
        </div>
        @endif
    </div>
</div>
<!-- End Cart Sec -->
@endsection