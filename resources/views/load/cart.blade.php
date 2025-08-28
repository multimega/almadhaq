@php

$slang = Session::get('language');
$lang = DB::table('languages')->where('is_default','=',1)->first();


@endphp
@if(Session::has('cart'))
<div class="dropdownmenu-wrapper " id="cart-items">
	<div class="dropdown-cart-header">
		<span class="item-no">
			<span class="cart-quantity">
				{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}
			</span> {{ $langg->lang4 }}
		</span>

		<a class="view-cart" href="{{ route('front.cart',$sign) }}">
			{{ $langg->lang5 }}
		</a>
	</div><!-- End .dropdown-cart-header -->
	<ul class="dropdown-cart-products">
		@foreach(Session::get('cart')->items as $product)
		<li
			class="product cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
			<div class="product-details">
				<div class="content" style="direction: ltr;">
					<a href="{{ route('front.product',['slug' => $product['item']['slug'] , 'lang' => $sign]) }}">
						<h4 class="product-title"> @if(!$slang)
							@if($lang->id == 2)
							{!!strlen($product['item']['name_ar']) > 100 ?
							substr($product['item']['name_ar'],0,100).'...' : $product['item']['name_ar']!!}
							@else
							{{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' :
							$product['item']['name']}}
							@endif
							@else
							@if($slang == 2)
							{!!strlen($product['item']['name_ar']) > 100 ?
							substr($product['item']['name_ar'],0,100).'...' : $product['item']['name_ar']!!}
							@else
							{{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' :
							$product['item']['name']}}
							@endif
							@endif</h4>
					</a>

					<span class="cart-product-info">
						@if(!$slang)
						@if($lang->id == 2)
						<span
							id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{
							App\Models\Product::convertPrice($product['item']['price'] != 0 ? $product['item']['price']
							: $product['size_price'] ) }}</span>
						x <span class="cart-product-qty"
							id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{
							$product['item']['measure'] }}</span>

						@else
						<span class="cart-product-qty"
							id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{
							$product['item']['measure'] }}</span>
						x <span
							id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{
							App\Models\Product::convertPrice($product['item']['price'] != 0 ? $product['item']['price']
							: $product['size_price'] ) }}</span>
						@endif
						@else
						@if($slang == 2)
						<span
							id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{
							App\Models\Product::convertPrice($product['item']['price'] != 0 ? $product['item']['price']
							: $product['size_price'] ) }}</span>
						x <span class="cart-product-qty"
							id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{
							$product['item']['measure'] }}</span>
						@else
						<span class="cart-product-qty"
							id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{
							$product['item']['measure'] }}</span>
						x <span
							id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{
							App\Models\Product::convertPrice($product['item']['price'] != 0 ? $product['item']['price']
							: $product['size_price'] ) }}</span>
						@endif
						@endif

					</span>
				</div>
			</div><!-- End .product-details -->

			<figure class="product-image-container">
				<a href="{{ route('front.product', ['slug' => $product['item']['slug'] , 'lang' => $sign]) }}"
					class="product-image">
					@if (isset($product['image']))
                        <img
                          src="{{ $product['image'] ? filter_var($product['image'], FILTER_VALIDATE_URL) ? $product['image'] : asset('assets/images/product-colors/'.$product['image']):asset('assets/images/noimage.png') }}"
                          alt="">
                        @else
                        <img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}"
						alt="product">
                        @endif
					{{-- <img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}"
						alt="product"> --}}
				</a>
				<div class="cart-remove btn-remove"
					data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}"
					data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}"
					title="Remove Product">
					<!--<i class="icofont-close"></i>-->
					<i class="fas fa-times"></i>
				</div>
			</figure>
		</li><!-- End .product -->
		@endforeach
	</ul><!-- End .cart-product -->

	<div class="dropdown-cart-total">
		<span>{{ $langg->lang6 }}</span>

		<span class="cart-total-price">
			<span class="cart-total">{{ Session::has('cart') ?
				App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}
			</span>
		</span>
	</div><!-- End .dropdown-cart-total -->

	<div class="dropdown-cart-action">
		<a href="{{ route('front.checkout',$sign) }}" class="mybtn1">{{ $langg->lang7 }}</a>
	</div><!-- End .dropdown-cart-total -->
</div>
@else
	<div class="empty-cart">
		<div class="img-box">
			<img src="{{asset("assets/images/empty-cart.svg")}}" alt="...">
		</div>
		<span>
			{{ $langg->lang8 }}
		</span>
	</div>
@endif