							{{-- If This product belongs to vendor then apply this --}}
                                @if($prod->user_id != 0)

                                {{-- check  If This vendor status is active --}}
                                @if(!empty($prod->user->is_vendor))
                                @if($prod->user->is_vendor == 2)

	                            @if(isset($_GET['max']))

	                            @if($prod->vendorPrice() <= $_GET['max'])

									<div class="col-lg-4 col-md-4 col-6 remove-padding">


									@if(!$slang)
              @if($lang->id == 2)
          <a href="{{ route('front.product', ['slug' => $prod->slug_ar ,'lang' => $sign]) }}" class="item">
              @else
           <a href="{{ route('front.product',['slug' => $prod->slug ,'lang' => $sign]) }}" class="item">
              @endif
          @else
              @if($slang == 2)
              <a href="{{ route('front.product', ['slug' => $prod->slug_ar ,'lang' => $sign]) }}" class="item">
              @else
            <a href="{{ route('front.product',['slug' => $prod->slug ,'lang' => $sign]) }}" class="item">
              @endif
          @endif
											<div class="item-img">
												@if(!empty($prod->features))
													<div class="sell-area">
													@foreach($prod->features as $key => $data1)
														<span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
														@endforeach
													</div>
												@endif
													<div class="extra-list">
														<ul>
															<li>
																@if(Auth::guard('web')->check())

																<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icofont-heart-alt" ></i>
																</span>

																@else

																<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																	<i class="icofont-heart-alt"></i>
																</span>

																@endif
															</li>
															<li>
															<span class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal" data-target="#quickview" data-placement="right"> <i class="icofont-eye"></i>
															</span>
															</li>
															<li>
																<span class="add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  data-toggle="tooltip" data-placement="right" title="{{ $langg->lang57 }}" data-placement="right">
																	<i class="icofont-exchange"></i>
																</span>
															</li>
														</ul>
													</div>
												<img class="img-fluid" style="width:100%;height:auto;" src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
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
												<h4 class="price">@if(!$slang)
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
          @endif</h4>
														<h5 class="name"> @if(!$slang)
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
														<div class="item-cart-area">
															@if($prod->product_type == "affiliate")
																<span class="add-to-cart-btn affilate-btn"
																	data-href="{{ route('affiliate.product', ['slug' => $prod->slug ,'lang' => $sign]) }}"><i class="icofont-cart"></i>
																	{{ $langg->lang251 }}
																</span>
															@else

																@if($prod->emptyStock())
																<span class="add-to-cart-btn cart-out-of-stock">
																	<i class="icofont-close-circled"></i> {{ $langg->lang78 }}
																</span>
																@else
																<span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang56 }}
																</span>
																<span class="add-to-cart-quick add-to-cart-btn"
																	data-href="{{ route('product.cart.quickadd',['id' => $prod->id , 'lang' => $sign]) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang251 }}
																</span>
																@endif
															@endif
														</div>
											</div>
										</a>

									</div>

								@endif

								@else

									<div class="col-lg-4 col-md-4 col-6 remove-padding">

									@if(!$slang)
              @if($lang->id == 2)
          <a href="{{ route('front.product', ['slug' => $prod->slug_ar ,'lang' => $sign]) }}" class="item">
              @else
           <a href="{{ route('front.product', ['slug' => $prod->slug ,'lang' => $sign]) }}" class="item">
              @endif
          @else
              @if($slang == 2)
              <a href="{{ route('front.product', ['slug' => $prod->slug_ar ,'lang' => $sign]) }}" class="item">
              @else
            <a href="{{ route('front.product', ['slug' => $prod->slug ,'lang' => $sign]) }}" class="item">
              @endif
          @endif
											<div class="item-img">
												@if(!empty($prod->features))
													<div class="sell-area">
													@foreach($prod->features as $key => $data1)
														<span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
														@endforeach
													</div>
												@endif
													<div class="extra-list">
														<ul>
															<li>
																@if(Auth::guard('web')->check())

																<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icofont-heart-alt" ></i>
																</span>

																@else

																<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																	<i class="icofont-heart-alt"></i>
																</span>

																@endif
															</li>
															<li>
															<span class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal" data-target="#quickview" data-placement="right"> <i class="icofont-eye"></i>
															</span>
															</li>
															<li>
																<span class="add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  data-toggle="tooltip" data-placement="right" title="{{ $langg->lang57 }}" data-placement="right">
																	<i class="icofont-exchange"></i>
																</span>
															</li>
														</ul>
													</div>
												<img class="img-fluid" src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
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
												<h4 class="price">@if(!$slang)
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
          @endif <del><small>@if(!$slang)
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
          @endif</small></del></h4>
														<h5 class="name"> @if(!$slang)
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
														<div class="item-cart-area">
															@if($prod->product_type == "affiliate")
																<span class="add-to-cart-btn affilate-btn"
																	data-href="{{ route('affiliate.product', ['slug' => $prod->slug ,'lang' => $sign]) }}"><i class="icofont-cart"></i>
																	{{ $langg->lang251 }}
																</span>
															@else
																@if($prod->emptyStock())
																<span class="add-to-cart-btn cart-out-of-stock">
																	<i class="icofont-close-circled"></i> {{ $langg->lang78 }}
																</span>
																@else
																<span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang56 }}
																</span>
																<span class="add-to-cart-quick add-to-cart-btn"
																	data-href="{{ route('product.cart.quickadd',['id' => $prod->id , 'lang' => $sign]) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang251 }}
																</span>
																@endif
															@endif
														</div>
											</div>
										</a>

									</div>

								@endif

								@endif
								@endif

                                {{-- If This product belongs admin and apply this --}}

								@else

							<div class="col-lg-4 col-md-4 col-6 remove-padding">

									@if(!$slang)
              @if($lang->id == 2)
          <a href="{{ route('front.product', ['slug' => $prod->slug_ar ,'lang' => $sign]) }}" class="item">
              @else
           <a href="{{ route('front.product', ['slug' => $prod->slug ,'lang' => $sign]) }}" class="item">
              @endif
          @else
              @if($slang == 2)
              <a href="{{ route('front.product', ['slug' => $prod->slug_ar ,'lang' => $sign]) }}" class="item">
              @else
            <a href="{{ route('front.product', ['slug' => $prod->slug ,'lang' => $sign]) }}" class="item">
              @endif
          @endif
											<div class="item-img">
												@if(!empty($prod->features))
													<div class="sell-area">
													@foreach($prod->features as $key => $data1)
														<span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
														@endforeach
													</div>
												@endif
													<div class="extra-list">
														<ul>
															<li>
																@if(Auth::guard('web')->check())

																<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icofont-heart-alt" ></i>
																</span>

																@else

																<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																	<i class="icofont-heart-alt"></i>
																</span>

																@endif
															</li>
															<li>
															<span class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal" data-target="#quickview" data-placement="right"> <i class="icofont-eye"></i>
															</span>
															</li>
															<li>
																<span class="add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  data-toggle="tooltip" data-placement="right" title="{{ $langg->lang57 }}" data-placement="right">
																	<i class="icofont-exchange"></i>
																</span>
															</li>
														</ul>
													</div>
												<img class="img-fluid" src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
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
												<h4 class="price">@if(!$slang)
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
          @endif</h4>
														<h5 class="name"> @if(!$slang)
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
														<div class="item-cart-area">
															@if($prod->product_type == "affiliate")
																<span class="add-to-cart-btn affilate-btn"
																	data-href="{{ route('affiliate.product', ['slug' => $prod->slug ,'lang' => $sign]) }}"><i class="icofont-cart"></i>
																	{{ $langg->lang251 }}
																</span>
															@else
																@if($prod->emptyStock())
																<span class="add-to-cart-btn cart-out-of-stock">
																	<i class="icofont-close-circled"></i> {{ $langg->lang78 }}
																</span>
																@else
																<span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang56 }}
																</span>
																<span class="add-to-cart-quick add-to-cart-btn"
																	data-href="{{ route('product.cart.quickadd',['id' => $prod->id , 'lang' => $sign]) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang251 }}
																</span>
																@endif
															@endif
														</div>
											</div>
										</a>
							</div>

								@endif