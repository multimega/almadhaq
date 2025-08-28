<div style="overflow-y:scroll; height:350px;">

		<a class="clear">{{ __('New Order(s).') }}</a>
		@if(count($datas) > 0)
		<a id="order-notf-clear" data-href="{{ route('order-notf-clear') }}" class="clear" href="javascript:;">
			{{ __('Clear All') }}
		</a>
		<ul>
		@foreach($datas as $data)
		@php
		$order = App\Models\Order::find($data->order_id);
		
		@endphp
		@if($order)
			<li>
				<a href="{{ route('admin-order-show',$data->order_id) }}"> <i class="fas fa-newspaper"></i> 
				<p>{{ __('You Have a new order.') }} {{$order->order_number}}</p>
				<p>{{$order->created_at->diffForHumans()}}</p>
				</a>
			</li>
		@endif	
		@endforeach

		</ul>

		@else 

		<a class="clear" href="javascript:;">
			{{ __('No New Notifications.') }}
		</a>

		@endif
		
		
		</div>