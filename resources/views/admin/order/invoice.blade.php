
@extends('layouts.admin')

@section('content')
<div class="content-area">
     @if(Auth::guard('admin')->check())
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Order Invoice') }} <a class="add-btn" href="javascript:history.back();"><i
                            class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Orders') }}</a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Invoice') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif
    <div class="order-table-wrap">
        <div class="invoice-wrap">
            <div class="invoice__title">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="invoice__logo text-left">
                           <img src="{{ asset('assets/images/'.$gs->invoice_logo) }}" alt="woo commerce logo">
                        </div>
                    </div>
                    
                    @if($order->invoice_url)
                    <div class="col-sm-4">
                      
                        <div class="text-center">
                            {!! QrCode::size(100)->generate(url($order->invoice_url)); !!}
                        </div>

                    </div>
                    @endif
                    
                    <div class="col-lg-4 text-right">
                             @if(Auth::guard('admin')->check())

                        <a class="btn  add-newProduct-btn print" href="{{route('admin-order-print',$order->id)}}"
                        target="_blank"><i class="fa fa-print"></i> {{ __('Print Invoice') }}</a>
                        @endif
                    </div>
                </div>
            </div>
            <br>
            <div class="row invoice__metaInfo mb-4">
                <div class="col-lg-6">
                    <div class="invoice__orderDetails">
                        
                        <h3><strong>فاتورة ضريبية
                        </strong></h3>
                        <p><strong>{{ __('Order Details') }} </strong></p>
                        <span><strong>{{ __('Invoice Number') }} :</strong> {{ sprintf("%'.08d", $order->id) }}</span><br>
                        <span><strong>{{ __('Order Date') }} :</strong> {{ date('d-M-Y',strtotime($order->created_at)) }}</span><br>
                        <span><strong>{{  __('Order ID')}} :</strong> {{ $order->order_number }}</span><br>
                        
                    @if($order->scheduled_delivery_date && $order->scheduled_delivery_start_time && $order->scheduled_delivery_end_time)
                        @php
                            $dayName = \Carbon\Carbon::parse($order->scheduled_delivery_date)->translatedFormat('l');
                            $startTime = \Carbon\Carbon::parse($order->scheduled_delivery_start_time)->format('h:i A');
                            $endTime = \Carbon\Carbon::parse($order->scheduled_delivery_end_time)->format('h:i A');
                        @endphp
                        <span>
                            <strong>{{ __('Scheduled Delivery') }} :</strong>
                            {{ __('التوصيل يوم') }} {{ $dayName }} {{ __('من') }} {{ $startTime }} {{ __('إلى') }} {{ $endTime }}
                        </span><br>
                    @endif

                        
                        
                        @if($order->dp == 0)
                        <span> <strong>{{ __('Shipping Method') }} :</strong>
                            @if($order->shipping == "pickup")
                            {{ __('Pick Up') }}
                            @else
                            {{ __('Ship To Address') }}
                            @endif
                        </span><br>
                        @endif
                        <span> <strong>{{ __('Payment Method') }} :</strong> {{$order->method}}</span>
                    </div>
                </div>
            </div>
            <div class="row invoice__metaInfo">
               @if($order->dp == 0)
                <div class="col-lg-6">
                        <div class="invoice__shipping">
                            <p><strong>{{ __('Shipping Address') }}</strong></p>
                           <span><strong>{{ __('Customer Name') }}</strong>: {{ $order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</span><br>
                           <span><strong>{{ __('Customer Email') }}</strong>: {{ $order->shipping_email == null ? $order->customer_email : $order->shipping_email}}</span><br>
                           <span><strong>{{ __('Customer Phone') }}</strong>: {{ $order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}</span><br>
                           <span><strong>{{ __('Address') }}</strong>: {{ $order->shipping_address == null ? $order->customer_address : $order->shipping_address }}</span><br>
                           
                             <span><strong>{{ __('Building Number') }}</strong>: {{ $order->building_number }}</span><br>
                           <span><strong>{{ __('Area') }}</strong>: {{ $order->area }}</span><br>
                           
                           <span><strong>{{ __('City') }}</strong>: {{ $order->shipping_city == null ? $order->customer_city : $order->shipping_city }}</span><br>
                           <span><strong>{{ __('Country') }}</strong>: {{ $order->shipping_country == null ? $order->customer_country : $order->shipping_country }}</span>

                        </div>
                </div>

            @endif

                <div class="col-lg-6">
                        <div class="buyer">
                            <p><strong>{{ __('Billing Details') }}</strong></p>
                            <span><strong>{{ __('Customer Name') }}</strong>: {{ $order->customer_name}}</span><br>
                            <span><strong>{{ __('Address') }}</strong>: {{ $order->customer_address }}</span><br>
                            
                                                       
                             <span><strong>{{ __('Building Number') }}</strong>: {{ $order->building_number }}</span><br>
                           <span><strong>{{ __('Area') }}</strong>: {{ $order->area }}</span><br>
                           
                           
                            <span><strong>{{ __('City') }}</strong>: {{ $order->customer_city }}</span><br>
                            <span><strong>{{ __('Country') }}</strong>: {{ $order->customer_country }}</span>
                        </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="invoice_table">
                        <div class="mr-table">
                            <div class="table-responsive">
                                <table id="example2" class="table table-hover dt-responsive" cellspacing="0"
                                    width="100%" >
                                    <thead>
                                        <tr>
                                            <th>{{ __('Product') }}</th>
                                            <th>{{ __('Details') }}</th>
                                            <th>{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $subtotal = 0;
                                        $tax = 0;
                                        @endphp
                                        @foreach($cart->items as $product)
                                        <tr>
                                            <td width="50%">
                                                @if($product['item']['user_id'] != 0)
                                                @php
                                                $user = App\Models\User::find($product['item']['user_id']);
                                                @endphp
                                                @if(isset($user))
                                                <a target="_blank"
                                                    href="{{ route('front.product', $product['item']['slug']) }}">{{ $product['item']['name']}}</a>
                                                @else
                                                <a href="javascript:;">{{$product['item']['name']}}</a>
                                                @endif

                                                @else
                                                <a href="javascript:;">{{ $product['item']['name']}}</a>

                                                @endif
                                            </td>


                                            <td>
                                                @if($product['size'])
                                               <p>
                                                    <strong>{{ __('Size') }} :</strong> {{$product['size']}}
                                               </p>
                                               @endif
                                               @if($product['color'])
                                                <p>
                                                        <strong>{{ __('color') }} :</strong> <span
                                                        style="width: 40px; height: 20px; display: block; background: #{{$product['color']}};"></span>
                                                </p>
                                                @endif
                                                <p>
                                                        <strong>{{ __('Price') }} :</strong> {{$order->currency_sign}}{{ round($product['item']['price'] * $order->currency_value , 2) }}
                                                </p>
                                               <p>
                                                    <strong>{{ __('Qty') }} :</strong> {{$product['qty']}} {{ $product['item']['measure'] }}
                                               </p>

                                                    @if(!empty($product['keys']))

                                                    @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)
                                                    <p>

                                                        <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} 

                                                    </p>
                                                    @endforeach

                                                    @endif
                                               
                                            </td>




                                      
                                            <td>{{$order->currency_sign}}{{ round($product['price'] * $order->currency_value , 2) }}
                                            </td>
                                            @php
                                            $subtotal += round($product['price'] * $order->currency_value, 2);
                                            @endphp

                                        </tr>

                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="2">{{ __('Total without VAT') }}</td>
<td>{{ number_format(abs((round($subtotal, 2) - ((round($order->pay_amount, 2) * $order->currency_value) - $order->shipping_price) - (round($order->pay_amount, 2) * $order->currency_value) - $order->shipping_price) / 1.15), 2) }}</td>                                        </tr>
                                        @if($order->shipping_cost != 0)
                                        <tr>
                                            <td colspan="2">{{ __('Shipping Cost') }}({{$order->currency_sign}})</td>
                                            <td>+ {{ round($order->shipping_cost , 2) }}</td>
                                        </tr>
                                        @endif

                                        @if($order->packing_cost != 0)
                                        <tr>
                                            <td colspan="2">{{ __('Packaging Cost') }}({{$order->currency_sign}})</td>
                                            <td>+ {{ round($order->packing_cost , 2) }}</td>
                                        </tr>
                                        @endif

                                       
                                        <tr>
                                            <td colspan="2">{{ __('VAT') }}</td>
                                            <td>15%</td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="2">{{ __('VAT value') }}</td>
                                            <td>{{$order->currency_sign}} {{ round(((round($order->pay_amount, 2) * $order->currency_value) - $order->shipping_price) -  (round($order->pay_amount, 2) * $order->currency_value) /1.15,2)}}
                                        </tr>
                                         @if($order->shipping_price != 0)
                                        <tr>
                                            <td colspan="2">{{ __('Shipping Price') }}({{$order->currency_sign}})</td>
                                            <td>+ {{round($order->shipping_price, 2)}}</td>
                                        </tr>
                                        @endif
                                        
                                         
                                        
                                        
                                        
                                        
                                        
                                        
                                        @if($order->coupon_discount != null)
                                        <tr>
                                            <td colspan="2">{{ __('Coupon Discount') }}({{$order->currency_sign}})</td>
                                            <td>- {{round($order->coupon_discount, 2)}}</td>
                                        </tr>
                                        @endif
                                        
                                        @if($order->wallet != 0)
                                        <tr>
                                            <td colspan="2">{{ __('Wallet Discount') }}({{$order->currency_sign}})</td>
                                            <td>- {{round($order->wallet, 2)}}</td>
                                        </tr>
                                        @endif
                                       
                                        <tr>
                                            <td colspan="1"></td>
                                            <td>{{ __('Total with VAT and shipping') }}</td>
                                            <td>{{$order->currency_sign}} {{ round($order->pay_amount, 2) * $order->currency_value }}
                                            </td><!--+ round($order->shipping_price,2)-->
                                            
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Area End -->
</div>
</div>
</div>

@endsection