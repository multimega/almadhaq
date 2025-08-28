@extends('layouts.front')
@section('content')


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area">
								<h4 class="title">
								{{ $langg->lang805 }}
								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>name</th>
														<th>Start Date</th>
														<th>End Date</th>
														<th>Paid Via</th>
														<th>Price</th>
														<th>Status</th>
														<th>{{ $langg->lang282 }}</th>
														<th>ReNew</th>
													</tr>
												</thead>
												<tbody>
													 @foreach($orders as $order)
													 
													 @php
													 $pro = App\Models\Product::find($order->product_id)
													 @endphp
													<tr>
														<td>
															@if(!empty($pro)) {{$pro->name}} @else No More From This Package @endif
														</td>
														<td>
															@if(!empty($order->start_date))	{{date('d M Y',strtotime($order->start_date))}} @else {{ucwords('waiting')}} @endif 
														</td>
														<td>
															@if(!empty($order->end_date))	<p  @if($now > $order->end_date) style="color:red" @endif >{{date('d M Y',strtotime($order->end_date))}}</p> @else {{ucwords('waiting')}} @endif 
														</td>
														<td>
																{{$order->paid_via}}
														</td>
														<td>
															{{ round($order->package_price , 2) }}
														</td>
														<td>
															<div class="order-status {{ $order->status }}">
																	{{ucwords($order->status)}}
															</div>
														</td>
														<td>
															<a href="{{route('user-subscribe',$order->id)}}">
																Details
															</a>
														</td>
														<td>
															<div class="order-status completed">
																<span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$order->product_id) }}">
																	 Renew
																</span>
															</div>
														</td>
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
	</section>
@endsection