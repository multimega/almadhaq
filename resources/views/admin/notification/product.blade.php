    <div style="overflow-y:scroll; height:350px;">
		<a class="clear">{{ __('Product(s) in Low Quantity.') }}</a>
		@if(count($datas) > 0)
		<a id="product-notf-clear" data-href="{{ route('product-notf-clear') }}" class="clear" href="javascript:;">
			{{ __('Clear All') }}
		</a>
		<ul>
		@foreach($datas as $data)
		  @if(!empty($data->product))
			<li>
				<a href="{{ route('admin-prod-edit',$data->product->id) }}"> <i class="icofont-cart"></i> {{strlen($data->product->name) > 30 ? substr($data->product->name,0,30) : $data->product->name}}</a>
				<a class="clear">{{ __('Stock') }} : {{$data->product->stock}}</a>
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