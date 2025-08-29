@extends('layouts.front')

@section('content')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$gs= App\Models\GeneralSetting::find(1);

@endphp
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">
          <li>
            <a href="{{ route('front.index',$sign) }}">
              {{ $langg->lang17 }}
            </a>
          </li>
          <li>
            <a href="{{ route('payment.return') }}">
              {{ $langg->lang169 }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>


<section class="tempcart">
@if(!empty($tempcart))

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="content-box section-padding add-product-1">
                        <div class="top-area">
                                <div class="content">
                                    <h4 class="heading">
                                        {{ $langg->razorpay }}
                                    </h4>
                                    <p class="text">
                                        {{ $langg->order_text }}
                                    </p>
                                  </div>
                               <div class="checkout-steps-action">
                                <a  href="https://accept.paymobsolutions.com/api/acceptance/iframes/{{$gs->framepaymentt}}?payment_token={{$key2['token']}}">
                                 <img src="{{asset('assets/admin/images/download.png')}}"></a>
                            </div>
                                  
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                    <div class="product__header">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-12">
                                                <div class="product-header-title">
                                                    <h2>{{ $langg->lang285 }} {{$order->order_number}}</h2>
                                        </div>   
                                    </div>
                                        @include('includes.form-success')
                                            <div class="col-md-12" id="tempview">
                                                <div class="dashboard-content">
                                                    <div class="view-order-page" id="print">
                                                        <p class="order-date">{{ $langg->lang301 }} {{date('d-M-Y',strtotime($order->created_at))}}</p>

                                                       @if($order->dp == 1)

                                                        <div class="billing-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h5>{{ $langg->lang287 }}</h5>
                                                                    <address>
                                                                        {{ $langg->lang288 }} {{$order->customer_name}}<br>
                                                                        {{ $langg->lang290 }} {{$order->customer_phone}}<br>
                                                                        {{ $langg->lang291 }} {{$order->customer_address}}<br>
                                                                        {{$order->customer_city}}-{{$order->customer_zip}}
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>{{ $langg->lang292 }}</h5>
                                                                    <p>{{ $langg->lang293 }} {{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</p>
                                                                    <p>{{ $langg->lang294 }} {{$order->method}}</p>

                                                                    @if($order->method != "Cash On Delivery")
                                                                        @if($order->method=="Stripe")
                                                                            {{$order->method}} {{ $langg->lang295 }} <p>{{$order->charge_id}}</p>
                                                                        @endif
                                                                        {{$order->method}} {{ $langg->lang296 }} <p id="ttn">{{$order->txnid}}</p>

                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @else
                                                        <div class="shipping-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    @if($order->shipping == "shipto")
                                                                        <h5>{{ $langg->lang302 }}</h5>
                                                                        <address>
                                                                            {{ $langg->lang288 }} {{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}<br>
                                                                            {{ $langg->lang290 }} {{$order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}<br>
                                                                            {{ $langg->lang291 }} {{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}<br>
                                                                             {{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}-{{$order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip}}
                                                                                                                                    </address>
                                                                            @else
                                                                        <h5>{{ $langg->lang303 }}</h5>
                                                                        <address>
                                                                            {{ $langg->lang304 }} {{$order->pickup_location}}<br>
                                                                        </address>
                                                                        @endif

                                                                      </div>
                                                                <div class="col-md-6">
                                                                    <h5>{{ $langg->lang305 }}</h5>
                                                                    @if($order->shipping == "shipto")
                                                                        <p>{{ $langg->lang306 }}</p>
                                                                    @else
                                                                        <p>{{ $langg->lang307 }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="billing-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h5>{{ $langg->lang287 }}</h5>
                                                                    <address>
                                                                        {{ $langg->lang288 }} {{$order->customer_name}}<br>
                                                                        {{ $langg->lang290 }} {{$order->customer_phone}}<br>
                                                                        {{ $langg->lang291 }} {{$order->customer_address}}<br>
                                                                        {{$order->customer_city}}-{{$order->customer_zip}}
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>{{ $langg->lang292 }}</h5>
                                                                    @if($order->shipping_tax >0 )<p>@lang('Shipping tax') : {{ $order->shipping_tax}} %</p> @endif
                                                                    @if($order->shipping_price > 0 )<p>@lang('shipping price With Tax') : {{$order->currency_sign}} {{ round($order->shipping_price , 2) }}</p> @endif
                                                                    <p>{{ $langg->lang293 }} {{$order->currency_sign}} {{ round($order->pay_amount * $order->currency_value , 2) }}</p>
                                                                    <p>{{ $langg->lang294 }} {{$order->method}}</p>

                                                                    @if($order->method != "Cash On Delivery")
                                                                        @if($order->method=="Stripe")
                                                                            {{$order->method}} {{ $langg->lang295 }} <p>{{$order->charge_id}}</p>
                                                                        @endif
                                                                        @if($order->method=="Paypal")
                                                                        {{$order->method}} {{ $langg->lang296 }} <p id="ttn">{{ isset($_GET['tx']) ? $_GET['tx'] : '' }}</p>
                                                                       
                                                                        @endif

                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                            @endif
                                                         <br>
                                                          <h4 class="text-start">{{ $langg->lang308 }}</h4>
                                                          <div class="table-responsive">
                                                            <table  class="table">
                                                                
                                                                <thead>
                                                                <tr>
                                
                                                                    <th width="60%">{{ $langg->lang310 }}</th>
                                                                    <th width="20%">{{ $langg->lang539 }}</th>
                                                                    <th width="10%">{{ $langg->lang314 }}</th>
                                                                    <th width="10%">{{ $langg->lang315 }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                             @foreach($tempcart->items as $product)
                                             
                                                           <tr>

                                                    <td>@if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{ $product['item']['name_ar'] }}
                                                      @else 
                                                     {{ $product['item']['name'] }}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{ $product['item']['name_ar'] }}
                                                      @else
                                                     {{ $product['item']['name'] }}
                                                      @endif
                                                  @endif</td>
                                            <td>
                                                <b>{{ $langg->lang311 }}</b>: {{$product['qty']}} <br>
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
                                  @endif  </b> @if($atrroption)
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
                                    @endif <br>
                                                    @endforeach
                                                    @endif

                                                  </td>
                                            <td>{{$order->currency_sign}}{{round($product['item']['price'] * $order->currency_value,2)}}</td>
                                            <td>{{$order->currency_sign}}{{round($product['price'] * $order->currency_value,2)}}</td>

                                        </tr>
                                          @endforeach


        
                                        </tbody>
                                    </table>
                                     </div> 
                                                        
                        
                                   
                                                        
                                                                                        
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <!-- Ending of Dashboard data-table area -->
            </div>

            @endif
            
              </section>
            
            @endsection

   
   <script>
   
    var fullUrlLink = location.href;
   if (fullUrlLink.search("success=false") > 0 ) {
       window.location.href="{{url('editorder/'.$order->id)}}"
   
   }if (fullUrlLink.search("success=true") > 0 ) {
      window.location.href="{{url('cancelpayment')}}"       

    }
      
  </script>