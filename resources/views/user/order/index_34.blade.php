@extends('layouts.front_34')

@section('content')

<div class="acc-settings">
    <div class="row m-0">
        @include('includes.user-dashboard-34-sidebar')
        <div class="col-lg-10 col-md-9 hidden-classes mb-3">
            <div>
                <div class="settings-container">
                    <h3>{{ $langg->lang277 }}</h3>
                    <div class="no-orders text-center">
                        <div class="mr-table allproduct mt-4">
                            <div class="table-responsiv">
    							<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
    								<thead>
    									<tr>
    										<th>{{ $langg->lang278 }}</th>
    										<th>{{ $langg->lang279 }}</th>
    										<th>{{ $langg->lang280 }}</th>
    										<th>{{ $langg->lang281 }}</th>
    										<th>{{ $langg->lang282 }}</th>
    									</tr>
    								</thead>
    								<tbody>
    									 @foreach($orders as $order)
    									<tr>
    										<td>{{$order->order_number}}</td>
    										<td>{{date('d M Y',strtotime($order->created_at))}}</td>
    										<td>{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</td>
    										<td>
    											<div class="order-status {{ $order->status }}">
    											@if($order->status =="pending")
                                                        {{ $langg->lang540 }}
                                                   @endif
                                                   
                                                    @if($order->status =="processing")
                                                        {{ $langg->lang541 }}
                                                   @endif
                                                   
                                                    @if($order->status =="completed")
                                                        {{ $langg->lang542 }}
                                                   @endif
                                                   
                                                    @if($order->status =="declined")
                                                        {{ $langg->lang543 }}
                                                   @endif
    
                                                  @if($order->status =="on delivery")
                                                
                                                    @if(!$slang)
                                                        @if($lang->id == 2)
                                                           قيد التوصيل
                                                        @else 
                                                            On Delivery
                                                        @endif 
                                                    @else  
                                                        @if($slang == 2) 
                                                            قيد التوصيل 
                                                        @else
                                                            On Delivery
                                                        @endif
                                                    @endif
                			
                                                @endif
    
    											</div>
    										</td>
    										<td>
    											<a href="{{route('user-order',$order->id)}}">{{ $langg->lang283 }}</a>
    										</td>
    									</tr>
    									@endforeach
    								</tbody>
    							</table>
						    </div>
						</div>
                        <i class="fas fa-shopping-cart"></i>
                        <h4 class="mt-3">You don't have any orders yet</h4>
                        <a href="#" class="btn btn-primary mt-4">Continue Shopping</a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection