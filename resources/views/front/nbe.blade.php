@extends('layouts.front')
@section('content')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$gs=App\Models\GeneralSetting::find(1);

@endphp
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
                                        {{ $langg->razorpay}}
                                    </h4>
                                    <p class="text">
                                        {{ $langg->order_text }}
                                    </p>
                                  </div>
                              <div class="checkout-steps-action"> 
                                     <button   class="btn btn-primary"  id="pay"  onclick="Checkout.showLightbox();">National Bank of Egypt </button>
                                 </div>      
                                  
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                    <div class="product__header">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-12">
                                              
                                    </div>
                                        @include('includes.form-success')
                                            <div class="col-md-12" id="tempview">
                                                <div class="dashboard-content">
                                                    <div class="view-order-page" id="print">
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
                                   <div class="row">
                                      <<div class="col-lg-8 order-lg-first">
                                         <div class="checkout-payment">
                                   <div class="form-group">
                                      <input type="hidden"  name="total_price"  id="total_price"  value="{{round($order->pay_amount * $order->currency_value,2)}}" class="form-control form-control-sm" required >
                                  </div>
                                  
                                   <div class="form-group required-field">
                                     
                                    <input  type="hidden" id="order_id"   name="order_id" value="{{$order->id}}" class="form-control" >
                                  </div>
                                   <div> 
                                  <input type="hidden"  value="{{$items['session']['id']}}" id="session">
                                            
                                  
                                  </div>
                                       <script src="https://nbe.gateway.mastercard.com/checkout/version/57/checkout.js" 
                                         data-cancel="cancelCallback"
                                          data-complete="completeCallback">
                                        
                                          </script>
                                              
                                        <script type="text/javascript" src="https://code.jquery.com/jquery-1.4.3.min.js" ></script>
                                           <script type="text/javascript">
                                              $(document).ready(function(){
                                                $("#pay").mousemove(function(){
                                                 
                                                  price = $("#total_price").val();

                                                });
                                              });
                                        
                                                  cancelCallback = "https://version3.vooecommerce.com/{{$sign}}/cancelpayment",
                                                  completeCallback= "{{url('editorder/'.$order->id)}}",
                                                  
                                                 Checkout.configure({
                                                  merchant:'{{$gs->merchant_id_nbe}}',
                                                  
                                                  order: {                    
                                                  amount:$("#total_price").val(),
                                                  currency: 'EGP',  
                                                  description: 'Ordered goods',     
                                                  id:$("#order_id").val()
                                                  },
                                                  
                                                  session: { 
                                                     id:$("#session").val()
                                                     
                                                     },
                                                   
                                                  interaction: {
                                                operation: 'PURCHASE',
                                                  merchant: {
                                                    name: '{{$gs->merchant_nbe}}',
                                                    address: {
                                                        line2:'cairo'      
                                                     }    
                                                   }
                                                  }
                                                  
                                               });
                                              
                                       </script>
                                
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
                </div>
               
            </div>

@endif

  </section>

@endsection

<script>
     var fullUrlLink = location.href;
     
   if (fullUrlLink.search("owner") > 0  ||  fullUrlLink.search("hc-action-complete") > 0) {
       window.location.href="{{url('editorder/'.$order->id)}}"
   }else{
      
     

    }
      
  </script>