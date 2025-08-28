@php

$slang = Session::get('language');
$lang = DB::table('languages')->where('is_default','=',1)->first();


@endphp
@if (count($prods) > 0)
@foreach ($prods as $key => $prod)
<div class="col-grid col-lg-3 col-md-3 col-6">

	@if(!$slang)
	@if($lang->id == 2)
	<a href="{{ route('front.product',['slug' =>  $prod->slug_ar ,'lang' => $sign ]) }}" class="item">
		@else
		<a href="{{ route('front.product', ['slug' =>  $prod->slug ,'lang' => $sign ]) }}" class="item">
			@endif
			@else
			@if($slang == 2)
			<a href="{{ route('front.product', ['slug' =>  $prod->slug_ar ,'lang' => $sign ]) }}" class="item">
				@else
				<a href="{{ route('front.product', ['slug' =>  $prod->slug ,'lang' => $sign ]) }}" class="item">
					@endif
					@endif

					<div class="item-img">
						@if(!empty($prod->features))
						<div class="sell-area">
							@foreach($prod->features as $key => $data1)
							<span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{
								$prod->features[$key] }}</span>
							@endforeach
						</div>
						@endif
						<div class="extra-list">
							<ul>
								<li>
									@if(Auth::guard('web')->check())

									<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}"
										data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}"
										data-placement="right"><i class="icofont-heart-alt"></i>
									</span>

									@else

									<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal"
										id="wish-btn" data-target="#comment-log-reg" data-placement="right">
										<i class="icofont-heart-alt"></i>
									</span>

									@endif
								</li>
								<li>
								    
								    <!--<a class="quick-view"  href="{{ route('product.quick',$prod->id) }}">-->
								    <!--    <i class="icofont-eye"></i>-->
            <!--                          </a>-->
								<span class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}"
										 data-href="{{ route('product.quick',$prod->id) }}"
										data-toggle="modal" data-target="#quickview" data-placement="right"> <i
											class="icofont-eye"></i>
									</span>
								</li>
								<li>
									<span class="add-to-compare"
										data-href="{{ route('product.compare.add',$prod->id) }}" data-toggle="tooltip"
										data-placement="right" title="{{ $langg->lang57 }}" data-placement="right">
										<i class="icofont-exchange"></i>
									</span>
								</li>
							</ul>
						</div>
						<img class="img-fluid"
							src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
							@if(!$slang) @if($lang->id == 2)

						alt="{{$prod->alt_ar}}"
						@else
						alt="{{$prod->alt}}"
						@endif
						@else
						@if($slang == 2)
						alt="{{$prod->alt_ar}}"
						@else
						alt="{{$prod->alt}}"
						@endif
						@endif
						>
					</div>
					<div class="info">
					    {{--
						<div class="stars">
							<div class="ratings">
								<div class="empty-stars"></div>
								<div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
							</div>
						</div>
						--}}
						<h5 class="name mt-2">
							@if(!$slang)
								@if($lang->id == 2)
								{!! $prod->showName_ar() !!}
								@else
								{{ $prod->showName() }}
								@endif
							@else
								@if($slang == 2)
								{!! $prod->showName_ar() !!}
								@else
								{{ $prod->showName() }}
								@endif
							@endif</h5>

							<div class="price">

							<span>
							    @if(isset($prod->featured_price)) 
							@if(!$slang)
								@if($lang->id == 2)
								{{ $prod->showFeaturedPrice_ar() }}
								@else
								{{ $prod->showFeaturedPrice() }}
								@endif
							@else
								@if($slang == 2)
								{{ $prod->showFeaturedPrice_ar() }}
								@else
								{{ $prod->showFeaturedPrice() }}
								@endif
							@endif 
							@else
							@if(!$slang)
								@if($lang->id == 2)
								{{ $prod->showPrice_ar() }}
								@else
								{{ $prod->showPrice() }}
								@endif
							@else
								@if($slang == 2)
								{{ $prod->showPrice_ar() }}
								@else
								{{ $prod->showPrice() }}
								@endif
							@endif 
							@endif
							</span>
							

							 
						    <small class="old-price">
								@if(!$slang)
									@if($lang->id == 2)
									{{ $prod->showPreviousPrice_ar() }}
									@else
									{{ $prod->showPreviousPrice() }}
									@endif
								@else
									@if($slang == 2)
									{{ $prod->showPreviousPrice_ar() }}
									@else
									{{ $prod->showPreviousPrice() }}
									@endif
								@endif
								</small>
							 
						</div>
						
					</div>
					
					<div class="item-cart-area">
							@if($prod->product_type == "affiliate")
							<span class="add-to-cart-btn affilate-btn"
								data-href="{{ route('affiliate.product', ['slug' =>  $prod->slug ,'lang' => $sign ]) }}"><i
									class="icofont-cart"></i>
								{{ $langg->lang251 }}
							</span>
							@else
							@if($prod->emptyStock())
							<span class="add-to-cart-btn cart-out-of-stock">
								<i class="icofont-close-circled"></i> {{ $langg->lang78 }}
							</span>
							@else
							<span class="add-to-cart add-to-cart-btn"
								data-href="{{ route('product.cart.add',$prod->id) }}">
								<i class="icofont-cart"></i> {{ $langg->lang56 }}
							</span>
						<!--	<span class="add-to-cart-quick add-to-cart-btn"
								data-href="{{ route('product.cart.quickadd',['id' => $prod->id  , 'lang' => $sign]) }}">
								<i class="icofont-cart"></i> {{ $langg->lang251 }}
							</span>-->
							@endif
							@endif
						</div>
					
					
				</a>

</div>
@endforeach
<div class="col-lg-12">
	<div class="page-center mt-5">
		{!! $prods->appends(['search' => request()->input('search')])->links() !!}
	</div>
</div>
@else
<div class="col-lg-12">
	<div class="page-center">
		<h4 class="text-center">{{ $langg->lang60 }}</h4>
	</div>
</div>
@endif


@if(isset($ajax_check))


<script type="text/javascript">
	// Tooltip Section


    $('[data-toggle="tooltip"]').tooltip({
      });
      $('[data-toggle="tooltip"]').on('click',function(){
          $(this).tooltip('hide');
      });




      $('[rel-toggle="tooltip"]').tooltip();

      $('[rel-toggle="tooltip"]').on('click',function(){
          $(this).tooltip('hide');
      });


// Tooltip Section Ends

</script>

@endif