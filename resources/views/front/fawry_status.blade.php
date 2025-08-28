@php 
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$gs=App\Models\GeneralSetting::find(1);
@endphp

@extends('layouts.front')

@section('content')
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
                    <!-- Starting of Dashboard data-table area -->
                    <div class="content-box section-padding add-product-1">
                        <div class="top-area">
                                <div class="content">
                                    <h4 class="heading">
                                        {{ $langg->order_title }}
                                    </h4>
                                    <p class="text">
                                        {{ $langg->order_text }}
                                    </p>
                                  </div>
                                 <div class="checkout-steps-action">
                                    <button class="mybtn1" type="image" onclick="checkout()" alt="pay-using-fawry" id="fawry-payment-btn">pay with fawry</button>
	                                <div id="fawry-UAT"></div>
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
                                                        <p><strong>تكلفة الشحن </strong>{{$order->currency_sign}}{{round($order->shipping_price * $order->currency_value,2)}}</p>
                                                        <p> <strong>التكلفة الأجمالية </strong>  {{$order->currency_sign}}{{round(($order->shipping_price + $order->pay_amount) * $order->currency_value,2)}}</p>
                                                         <br>
                                                          <div class="table-responsive">
                                                            <table  class="table">
                                                                <h4 class="text-center">{{ $langg->lang308 }}</h4>
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
                                                        
                                                        
                                                           <div class="form-group">
                                                               <input type="hidden" name="total_price" id="total_price" value="{{ round($order->pay_amount * $order->currency_value,2 )}}" class="form-control form-control-sm" required>
                                                            </div>
                                
                                                        <div class="form-group required-field">
                                                            <input type="hidden" id="order_id" name="order_id" value="{{$order->id}}" class="form-control">
                                                        </div>
                                                                                        
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>

@endif
</section>
@endsection

@section('scripts')
<script src="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/js/fawrypay-payments.js"></script>                                        
<script>
function checkout() {
	 const configuration = {
       locale: "{{getLang()}}",
       divSelector: 'fawry-UAT',
	   mode: DISPLAY_MODE.SEPARATED,
	   onSuccess: successCallBack,
	   onFailure: failureCallBack,
	};
   
	FawryPay.checkout(buildChargeRequest(), configuration);
}

function buildChargeRequest() {
	const chargeRequest = {
		merchantCode: "{{$merchantCode}}",
		merchantRefNum: "{{$merchantRefNum}}",
		customerMobile: "{{$order->customer_phone}}",
		customerEmail: "{{$order->customer_email}}",
		customerName: "{{$order->customer_name}}",
		paymentExpiry: '1672351200000',
		customerProfileId: "{{$customerProfileId}}", 
		chargeItems: [
			{
				itemId: "{{$itemId}}",
				description: "{{$description}}",
				price: "{{$paymentPrice}}",
				quantity: "{{$quantity}}",
				imageUrl: 'https://www.atfawry.com/ECommercePlugin/resources/images/atfawry-ar-logo.png'
			}
		],
		paymentMethod: '',
		returnUrl: "{{$returnUrl}}",
		signature: "{{$hash}}"
	};
	
	return chargeRequest;
}

function successCallBack(data) {
	console.log('handle success call back as desired, data', data);
	document.getElementById('fawryPayPaymentFrame')?.remove();
}

function failureCallBack(data) {
	console.log('handle failure call back as desired, data', data);
	document.getElementById('fawryPayPaymentFrame')?.remove();
}
</script>
@endsection


