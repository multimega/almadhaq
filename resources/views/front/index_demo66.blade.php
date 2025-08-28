@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);
$categorys=App\Models\Category::get();
$blogs = DB::table('blogs')->get();
@endphp

	<main class="main">
			<div class="container mb-2">
				<div class="info-boxes-container row row-joined mb-2 font2 dr-l">
				
				
				
				    @foreach($chunk as $key=>$data)
					<div class="info-box info-box-icon-left col-lg-4">
					
					      
					       @if($key==0)  
                           <i class="icon-shipping"></i>
                        @endif
                        
                         @if($key==1)  
                           <i class="icon-us-dollar"></i>
                        @endif
                        
                         @if($key==2)  
                           <i class="icon-support"></i>
                        @endif
					     

						<div class="info-box-content">
							<h4>@if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $data->title_ar }}
                                              @else 
                                              {{ $data->title }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $data->title_ar }}
                                              @else
                                              {{ $data->title }} 
                                              @endif
                                @endif</h4>
							<p class="text-body">@if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $data->details_ar }}
                                              @else 
                                              {{ $data->details }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $data->details_ar }}
                                              @else
                                              {{ $data->details }} 
                                              @endif
                                @endif</p>
						</div><!-- End .info-box-content -->
					</div><!-- End .info-box -->
            
                @endforeach
				
				</div>

				<div class="row">
					<div class="col-lg-9">
						<div class="home-slider owl-carousel owl-theme owl-carousel-lazy mb-4" data-owl-options="{
							'loop': false,
							'dots': true,
							'nav': false
						}">
						
						
						
						   @if($ps->slider == 1)
				            @if(count($sliders))
			      		    @foreach($sliders as $data)
			      		    
			      		    
							    <div class="home-slide home-slide1 banner banner-md-vw banner-sm-vw">
								<img class="owl-lazy slide-bg" data-src="{{asset('assets/images/sliders/'.$data->photo)}}" alt="slider image">
								<div class="banner-layer banner-layer-middle">
									<h4 class="text-white pb-4 mb-0" style="color:{{$data->title_color}};size:{{$data->title_size}}">@if(!$slang)
                                     @if($lang->id == 2)
                                         {{$data->title_text_ar}}
                                          @else 
                                          {{$data->title_text}}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {{$data->title_text_ar}}
                                          @else
                                          {{$data->title_text}}
                                          @endif
                                            
                                            
                                         @endif</h4>
									<h2 class="text-white mb-0" style="color:{{$data->subtitle_color}};size:{{$data->subtitle_size}}">
									     
                                          @if(!$slang)
                                          @if($lang->id == 2)
                                         {{$data->subtitle_text_ar}}
                                          @else 
                                          {{$data->subtitle_text}}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {{$data->subtitle_text_ar}}
                                          @else
                                          {{$data->subtitle_text}}
                                          @endif
                                            
                                            
                                           @endif
									    
									</h2>
								
									<h5 class="text-white text-uppercase d-inline-block mb-0 ls-n-20 align-text-bottom" style="color:{{$data->details_color}};size:{{$data->details_size}}">
									      
									        @if(!$slang)
                                         @if($lang->id == 2)
                                         {{$data->details_text_ar}}
                                          @else 
                                          {{$data->details_text}}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {{$data->details_text_ar}}
                                          @else
                                          {{$data->details_text}}
                                          @endif
                                            
                                            
                                        @endif
									    
									</h5>
									
									   @if(!empty($data->link)) 
									<a href="{{$data->link}}" class="btn btn-md ls-10">
									      @if(!$slang)
                                          @if($lang->id == 2)
                                         {{$data->btn_text_ar}}
                                          @else 
                                          {{$data->btn_text}}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {{$data->btn_text_ar}}
                                          @else
                                          {{$data->btn_text}}
                                          @endif
                                            
                                            
                                           @endif
 
									   </a>
									@endif
								</div><!-- End .banner-layer -->
						    	</div><!-- End .home-slide -->
                          
                          
                            
                              @endforeach
                              @endif
                              @endif
						
						
						    
							
							
							
							
						</div><!-- End .home-slider -->

						<div class="banners-container m-b-2 owl-carousel owl-theme" data-owl-options="{
							'dots': false,
							'margin': 20,
							'loop': false,
							'responsive': {
								'480': {
									'items': 2
								},
								'768': {
									'items': 3
								}
							}
						}">
						
						
					        @foreach($fix_banners as $banner) 
							   
							     <div class="banner banner1 banner-hover-shadow mb-2" style="height: 150px">
								<figure class="h-100">
									<img class="h-100" src="{{asset('assets/images/banners/'.$banner->photo)}}" alt="banner">
								</figure>
								<div class="banner-layer banner-layer-middle">
									<h3 class="m-b-2">
									    @if(!$slang)
                                      @if($lang->id == 2)
                                    {!!$banners->title_ar!!}
                                      @else 
                                      {!!$banner->title!!}
                                      @endif 
                                  @else  
                                      @if($slang == 2) 
                                      {!!$banner->title_ar!!}
                                      @else
                                      {!!$banner->title!!}
                                      @endif
                                  @endif
									</h3>
									<h4 class="m-b-4 text-primary"><sup class="text-dark">
									     @if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$banner->subtitle_ar!!}
                                          @else 
                                          {!!$banner->subtitle!!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$banner->subtitle_ar!!}
                                          @else
                                          {!!$banner->subtitle!!}
                                          @endif
                                      @endif
									</h4>
									
									  @if(!empty($banner->link)) 
									<a href="{{$banner->link}}" class="text-dark text-uppercase ls-10">
									     @if(!$slang)
                                   @if($lang->id == 2)
                                        {!!$banner->btn_ar!!}  
                                      @else 
                                       {!!$banner->button!!}  
                                      @endif 
                                       @else  
                                      @if($slang == 2) 
                                        {!!$banner->btn_ar!!}  
                                      @else
                                       {!!$banner->button!!}  
                                      @endif
                                    @endif 
									   </a>
									@endif
								
								</div>
							</div><!-- End .banner -->
							
							 @endforeach
						
						</div>

					
					  @if($ps->featured == 1)
						<h2 class="section-title ls-n-10 m-b-4">{{ $langg->lang26 }}</h2>

						<div class="products-slider owl-carousel owl-theme dots-top m-b-1 pb-1">
						
						      @foreach($feature_products as $key => $prod)
						      
						     	<div class="product-default inner-quickview inner-icon">
								<figure>
									<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
										<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}">
									</a>
								
								  	@if(!empty($prod->features))
									<div class="label-group">
									
										
										
													<div class="product-label label-hot">
													@foreach($prod->features as $key => $data1)
														<span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
														@endforeach 
													</div>
											
												
									</div>
									
									@endif
									<div class="btn-icon-group">
									  <button class="btn-icon btn-add-cart  add-to-cart"  data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
									</div>
								 <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{ $langg->lang55 }}">
                                    
                                         {{ $langg->lang55 }}
                                    
                                </a>
								</figure>
								<div class="product-details">
									<div class="category-wrap">
										<div class="category-list">
											<a href="{{ route('front.category',[ 'category' => $prod->category->slug , 'lang' =>$sign ]) }}" class="product-category">
											     @if(!$slang)
                                            @if($lang->id == 2)
                               
                                        {{$prod->category->name_ar }}
                                          
                                             @else 
                                          
                                         {{ $prod->category->name }}
        
                                          @endif 
                                        @else
                                          @if($slang == 2) 
                                             {{ $prod->category->name_ar }}
        
                                          @else
                                         {{ $prod->category->name }}

                                      @endif
                                      @endif
											</a>
										</div>
										
										 @if(Auth::guard('web')->check())

											<a href="#" class="add-to-wish btn-icon-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icon-heart"></i>
											</a>

									@endif
									
									</div>
									<h2 class="product-title">
										<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
										    
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
                                         @endif
										    
										</a>
									</h2>
									<div class="ratings-container">
										<div class="product-ratings">
											<span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
											<span class="tooltiptext tooltip-top"></span>
										</div><!-- End .product-ratings -->
									</div><!-- End .product-container -->
									<div class="price-box">
										<span class="product-price">{{ $prod->showPrice() }}</span>
									</div><!-- End .price-box -->
								</div><!-- End .product-details -->
							</div>
							
							 @endforeach
						
						</div><!-- End .featured-proucts -->

                       @endif

                      
					
					   	@if($ps->partners == 1)
					     	<div class="brands-slider owl-carousel owl-theme images-center mb-3" data-owl-options="{
							'responsive': {
								'768': {
									'items': 5
								}
							}
						}">
							
							
						   @foreach($partners as $j)
                               <img src="{{asset('assets/images/partner/'.$j->photo)}}" width="140" height="60" alt="brand">
                           @endforeach
						
						
						</div><!-- End .brands-slider -->
                        @endif
					
					
						<div class="row products-widgets">
						
						       @if($ps->top_rated ==1)
							<div class="col-sm-6 col-md-4 pb-4 pb-md-0">
								<div class="product-column">
									<h3 class="section-sub-title ls-n-20">{{ $langg->lang28}}</h3>

								
								
								   @foreach($top_products as $prod)
									<div class="product-default left-details product-widget mb-3">
										<figure>
											<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
												<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
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
                                                               @endif>
											</a>
										</figure>
										<div class="product-details">
											<h2 class="product-title">
												<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                      @endif  
												    
												</a>
											</h2>
											<div class="ratings-container">
												<div class="product-ratings">
													<span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
													<span class="tooltiptext tooltip-top"></span>
												</div><!-- End .product-ratings -->
											</div><!-- End .product-container -->
											<div class="price-box">
												<span class="product-price">{{ $prod->showPrice() }}</span>
											</div><!-- End .price-box -->
										</div><!-- End .product-details -->
									</div>
								
									@endforeach
									
								</div><!-- End .product-column -->
							</div><!-- End .col-md-4 -->
							
							@endif
							
							
							
							
						      @if($ps->best == 1)
							<div class="col-sm-6 col-md-4 pb-4 pb-md-0">
								<div class="product-column">
									<h3 class="section-sub-title ls-n-20">{{ $langg->lang27}}</h3>

								
								
								   @foreach($best_products as $prod)
									<div class="product-default left-details product-widget mb-3">
										<figure>
											<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
												<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
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
                                                               @endif>
											</a>
										</figure>
										<div class="product-details">
											<h2 class="product-title">
												<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                      @endif  
												    
												</a>
											</h2>
											<div class="ratings-container">
												<div class="product-ratings">
													<span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
													<span class="tooltiptext tooltip-top"></span>
												</div><!-- End .product-ratings -->
											</div><!-- End .product-container -->
											<div class="price-box">
												<span class="product-price">{{ $prod->showPrice() }}</span>
											</div><!-- End .price-box -->
										</div><!-- End .product-details -->
									</div>
								
									@endforeach
									
								</div><!-- End .product-column -->
							</div><!-- End .col-md-4 -->
							
							@endif
							
							
							
							  @if($ps->hot_sale == 1)
							<div class="col-sm-6 col-md-4 pb-4 pb-md-0">
								<div class="product-column">
									<h3 class="section-sub-title ls-n-20">{{ $langg->lang32}}</h3>

								
								
								   @foreach($trending_products as $prod)
									<div class="product-default left-details product-widget mb-3">
										<figure>
											<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
												<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
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
                                                               @endif>
											</a>
										</figure>
										<div class="product-details">
											<h2 class="product-title">
												<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                      @endif  
												    
												</a>
											</h2>
											<div class="ratings-container">
												<div class="product-ratings">
													<span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
													<span class="tooltiptext tooltip-top"></span>
												</div><!-- End .product-ratings -->
											</div><!-- End .product-container -->
											<div class="price-box">
												<span class="product-price">{{ $prod->showPrice() }}</span>
											</div><!-- End .price-box -->
										</div><!-- End .product-details -->
									</div>
								
									@endforeach
									
								</div><!-- End .product-column -->
							</div><!-- End .col-md-4 -->
							
							@endif
							
							
							
						 @if($ps->big == 1)
							<div class="col-sm-6 col-md-4 pb-4 pb-md-0">
								<div class="product-column">
									<h3 class="section-sub-title ls-n-20">{{ $langg->lang29}}</h3>

								
								
								   @foreach($big_products as $prod)
									<div class="product-default left-details product-widget mb-3">
										<figure>
											<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
												<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
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
                                                               @endif>
											</a>
										</figure>
										<div class="product-details">
											<h2 class="product-title">
												<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                      @endif  
												    
												</a>
											</h2>
											<div class="ratings-container">
												<div class="product-ratings">
													<span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
													<span class="tooltiptext tooltip-top"></span>
												</div><!-- End .product-ratings -->
											</div><!-- End .product-container -->
											<div class="price-box">
												<span class="product-price">{{ $prod->showPrice() }}</span>
											</div><!-- End .price-box -->
										</div><!-- End .product-details -->
									</div>
								
									@endforeach
									
								</div><!-- End .product-column -->
							</div><!-- End .col-md-4 -->
							
							@endif
							
							
							
								 @if($ps->hot_sale == 1)
							<div class="col-sm-6 col-md-4 pb-4 pb-md-0">
								<div class="product-column">
									<h3 class="section-sub-title ls-n-20">{{ $langg->lang31}}</h3>

								
								
								   @foreach($latest_products as $prod)
									<div class="product-default left-details product-widget mb-3">
										<figure>
											<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
												<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
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
                                                               @endif>
											</a>
										</figure>
										<div class="product-details">
											<h2 class="product-title">
												<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                      @endif  
												    
												</a>
											</h2>
											<div class="ratings-container">
												<div class="product-ratings">
													<span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
													<span class="tooltiptext tooltip-top"></span>
												</div><!-- End .product-ratings -->
											</div><!-- End .product-container -->
											<div class="price-box">
												<span class="product-price">{{ $prod->showPrice() }}</span>
											</div><!-- End .price-box -->
										</div><!-- End .product-details -->
									</div>
								
									@endforeach
									
								</div><!-- End .product-column -->
							</div><!-- End .col-md-4 -->
							
							@endif
							
							
							
						 @if($ps->hot_sale == 1)
							<div class="col-sm-6 col-md-4 pb-4 pb-md-0">
								<div class="product-column">
									<h3 class="section-sub-title ls-n-20">{{ $langg->lang30}}</h3>

								
								
								   @foreach($hot_products as $prod)
									<div class="product-default left-details product-widget mb-3">
										<figure>
											<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
												<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
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
                                                               @endif>
											</a>
										</figure>
										<div class="product-details">
											<h2 class="product-title">
												<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                      @endif  
												    
												</a>
											</h2>
											<div class="ratings-container">
												<div class="product-ratings">
													<span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
													<span class="tooltiptext tooltip-top"></span>
												</div><!-- End .product-ratings -->
											</div><!-- End .product-container -->
											<div class="price-box">
												<span class="product-price">{{ $prod->showPrice() }}</span>
											</div><!-- End .price-box -->
										</div><!-- End .product-details -->
									</div>
								
									@endforeach
									
								</div><!-- End .product-column -->
							</div><!-- End .col-md-4 -->
							
							@endif
							
							
							
							
								 @if($ps->hot_sale == 1)
							<div class="col-sm-6 col-md-4 pb-4 pb-md-0">
								<div class="product-column">
									<h3 class="section-sub-title ls-n-20">{{ $langg->lang33}}</h3>

								
								
								   @foreach($sale_products as $prod)
									<div class="product-default left-details product-widget mb-3">
										<figure>
											<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
												<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
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
                                                               @endif>
											</a>
										</figure>
										<div class="product-details">
											<h2 class="product-title">
												<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                      @endif  
												    
												</a>
											</h2>
											<div class="ratings-container">
												<div class="product-ratings">
													<span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
													<span class="tooltiptext tooltip-top"></span>
												</div><!-- End .product-ratings -->
											</div><!-- End .product-container -->
											<div class="price-box">
												<span class="product-price">{{ $prod->showPrice() }}</span>
											</div><!-- End .price-box -->
										</div><!-- End .product-details -->
									</div>
								
									@endforeach
									
								</div><!-- End .product-column -->
							</div><!-- End .col-md-4 -->
							
							@endif
							
							
							
							
								 @if($ps->flash_deal == 1)
							<div class="col-sm-6 col-md-4 pb-4 pb-md-0">
								<div class="product-column">
									<h3 class="section-sub-title ls-n-20">{{ $langg->lang244}}</h3>

								
								
								   @foreach($discount_products as $prod)
									<div class="product-default left-details product-widget mb-3">
										<figure>
											<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
												<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
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
                                                               @endif>
											</a>
										</figure>
										<div class="product-details">
											<h2 class="product-title">
												<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                      @endif  
												    
												</a>
											</h2>
											<div class="ratings-container">
												<div class="product-ratings">
													<span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
													<span class="tooltiptext tooltip-top"></span>
												</div><!-- End .product-ratings -->
											</div><!-- End .product-container -->
											<div class="price-box">
												<span class="product-price">{{ $prod->showPrice() }}</span>
											</div><!-- End .price-box -->
										</div><!-- End .product-details -->
									</div>
								
									@endforeach
									
								</div><!-- End .product-column -->
							</div><!-- End .col-md-4 -->
							
							@endif
							
							
							
							
							
							
                           
							
							
							
							
							
							
							
							
						</div><!-- End .row -->

						<hr class="mt-1 mb-5">

						<div class="feature-boxes-container mt-3">
							<div class="row">
							
							
							
							     @foreach($chunkss as $key=>$data )
							
								<div class="col-md-4">
								
									<div class="feature-box px-sm-3 feature-box-simple text-center">
									     @if($key == 0)
                                    	<i class="icon-earphones-alt"></i>
                                    @endif
                                    @if($key == 1)
                                     
                                       	<i class="icon-credit-card"></i>
                        
                                   @endif
                                    @if($key == 2)
                                     	<i class="icon-action-undo"></i>
                                   @endif
                                   

										<div class="feature-box-content">
											<h3 class="m-b-1">
											     @if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $data->title_ar }}
                                              @else 
                                              {{ $data->title }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $data->title_ar }}
                                              @else
                                              {{ $data->title }} 
                                              @endif
                                      @endif
											</h3>
										

											<p>
											    @if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $data->details_ar }}
                                              @else 
                                              {{ $data->details }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $data->details_ar }}
                                              @else
                                              {{ $data->details }} 
                                              @endif
                                @endif
											</p>
										</div><!-- End .feature-box-content -->
									</div><!-- End .feature-box -->
								</div><!-- End .col-md-4 -->
								
								@endforeach

							
							</div><!-- End .row -->
						</div><!-- End .feature-boxes-container -->
					</div><!-- End .col-lg-9 -->

					<div class="sidebar-overlay"></div>
					<div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
					<aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar tl-r">
						<div class="side-menu-wrapper text-uppercase mb-2 d-none d-lg-block">
							<h2 class="side-menu-title bg-gray ls-n-25">{{ $langg->lang14 }}</h2>

							<nav class="side-nav">
								<ul class="menu menu-vertical sf-arrows">
									<li class="active"><a href="{{route('front.index',$sign)}}"><i class="icon-home"></i>{{ $langg->lang17 }}</a></li>
								
								
								
								
								    <li>
                                        <a href="category.html" class="sf-with-ul"><i class="icon-briefcase"></i>
                                        @if($langg->rtl != "1") Shop  @else المتجر   @endif</a>
                                        
                                          <ul>
                                                                
                                                                
                                                 @foreach($categorys as $data) 
                                         <li> <a href="{{ route('front.category',  ['category' => $data->slug , 'lang' => $sign]) }}"   @if(count($data->subs) > 0 )  class="sf-with-ul" @endif>
                                             @if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $data->name_ar }}
                                              @else 
                                              {{ $data->name }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $data->name_ar }}
                                              @else
                                              {{ $data->name }} 
                                              @endif
                                               @endif</a>

                                                @if(count($data->subs) > 0 )   
                                                <ul>
                                                 @foreach($data->subs as $subcat)
											    <li>
												  <a  href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug ,'lang' => $sign])}}">
        
                                                                
                                                                  
                                                                   @if(!$slang)
                                                          @if($lang->id == 2)
                                                         {{$subcat->name_ar}}
                                                          @else 
                                                          
                                                         {{$subcat->name}}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                        {{$subcat->name_ar}}
                                                          @else
                                                          {{$subcat->name}}
                                                          @endif
                                                      @endif
                                                                  
                                                                  </a>
													          </li>
												            	@endforeach
                                                             </ul>
                                                             @endif
                                                 </li>
                                                            @endforeach
                                                               
                                            </ul>
                                                       
                                    </li>
                             
                                    
                                    
                                 <li>
                                        <a href="#" class="sf-with-ul"><i class="icon-briefcase"></i>
                                        @if($langg->rtl != "1") Products  @else المنتجات   @endif</a></a>
                                        
                                            <ul>
                                                                
                                                                
                                                 @foreach($feature_products as $prod) 
                                         <li> <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                             
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
                                                      @endif
                                               </a>

                                              
                                         </li>
                                        @endforeach
                                      
                                                               
                                            </ul>
                                                       
                                 </li>
                                    
                                    <li>
                                        <a href="#" class="sf-with-ul"><i class="icon-docs-inv"></i> @if($langg->rtl != "1") Pages  @else الصفحات   @endif</a></a>

                                        <ul>
                                             <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
							                        @foreach(DB::table('pages')->where('header','=',1)->get() as $data)
							     	             <li><a href="{{ route('front.page', ['slug' => $data->slug , 'lang' => $sign]) }}">
							     	                     @if(!$slang)
                                                          @if($lang->id == 2)
                                                         {{ $data->title_ar }}
                                                          @else 
                                                          
                                                         {{ $data->title }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {{ $data->title_ar }}
                                                          @else
                                                          {{ $data->title }}
                                                          @endif
                                                      @endif</a></li> 
                                                      @endforeach
                                	<li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
   
                                        @if(!Auth::check())
                                      <li> <a href="{{url('user/login')}}">{{ $langg->lang12 }}</a>
                                      </li>
                                        @else
        							    	<li>
										    	<a href="{{ route('user-logout') }}">{{ $langg->lang223 }}</a>
									    	</li>
                                         @endif
                                         
                                         
                                        </ul>
                                        
                                        
                                    </li>
                                    <li><a href="#" class="sf-with-ul"><i class="icon-sliders"></i>@if($langg->rtl != "1") Profile  @else البروفايل   @endif</a>
                                        <ul>
                                            
                                            
                                               @if(!Auth::guard('web')->check())
                									<li class="login">
                										<a href="{{ route('user.login') }}" class="sign-log">
                											<div class="links">
                												<span class="sign-in">{{ $langg->lang12 }}</span> <span>|</span>
                												<span class="join">{{ $langg->lang13 }}</span>
                											</div>
                										</a>
                									</li>
									
								
								       	 @else 
									 
									 	@if(Auth::user()->IsVendor())
								
								        
													<li>
														<a href="{{ route('vendor-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang11 }}</a>
								
													</li>
														<li>
														<a href="{{ route('user-logout') }}"> {{ $langg->lang223 }}</a>
								              		</li>
												
													
										@else	
										
									<li>
										<a href="{{ route('user-dashboard') }}"> {{ $langg->lang11 }}</a>
									</li>
									
									 	<li>
														<a href="{{ route('user-logout') }}"> {{ $langg->lang223 }}</a>
										</li>
									@endif	
                               
						      @endif
                                            
                                            
						    
									
							
							  	
                        			@if($gs->reg_vendor == 1)
									
                        				@if(Auth::check())
	                        				@if(Auth::guard('web')->user()->is_vendor == 2)
	                        				
	                        				    <li>
	                        					<a href="{{ route('user-package') }}" class="sell-btn">{{ $langg->lang11 }}</a>
	                        					</li>
	                        				@endif
									
									@endif
									
									@endif
                        		
									
										
							      
                            </ul>
                         </li>
                        
                        
                                    <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
									
									
									
									
									
									
								</ul>
							</nav>
						</div><!-- End .side-menu-container -->

					
					
					
					
					
						
						
						
						

						<div class="widget widget-newsletters bg-gray text-center">
							<h3 class="widget-title text-uppercase">{{$langg->newsletter}}</h3>
							<p class="mb-2">  @if(!$slang)
                                                          @if($lang->id == 2)
                                                          {{$gs->subscribee_message_ar}}
                                                          @else 
                                                          
                                                          {{$gs->subscribee_message}}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          {{$gs->subscribee_message_ar}}
                                                          @else
                                                           {{$gs->subscribee_message}}
                                                          @endif
                                                      @endif</p>
						                 
						                 
						                      <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST" >
                                <div class="form-group">
                                    {{csrf_field()}}
                              
                                <input type="email" class="form-control" name="email" id="email" required="" placeholder="{{ $langg->lang49 }}">
                                
                                  
                                </div><!-- Endd .form-group -->
                              
                              <input type="submit" class="btn btn-dark btn-md"   value = "{{ ($langg->rtl != '1')  ?    'Subscribe Now' :  'ابدأ' }}">

                            </form>
						</div><!-- End .widget -->

					
					
					
					        	<div class="widget widget-testimonials">
							<div class="owl-carousel owl-theme dots-left">
							
							
							     @foreach($reviews as $data )
							      	
							      	
							      	   <div class="testimonial">
									<div class="testimonial-owner">
										<figure>
											<img src="{{asset('assets/images/reviews/'.$data->photo)}}" alt="client">
										</figure>

										<div>
											<h4 class="testimonial-title"> @if(!$slang)
                                                          @if($lang->id == 2)
                                                         {{ $data->title_ar }}
                                                          @else 
                                                          
                                                         {{ $data->title }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {{ $data->title_ar }}
                                                          @else
                                                          {{ $data->title }}
                                                          @endif
                                                      @endif</h4>
											<span> @if(!$slang)
                                                          @if($lang->id == 2)
                                                         {{ $data->subtitle_ar }}
                                                          @else 
                                                          
                                                         {{ $data->subtitle }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {{ $data->subtitle_ar }}
                                                          @else
                                                          {{ $data->subtitle }}
                                                          @endif
                                                      @endif</span>
										</div>
									</div><!-- End .testimonial-owner -->

									<blockquote class="ml-4 pr-0">
										<p>@if(!$slang)
                                                          @if($lang->id == 2)
                                                         {{ $data->details_ar }}
                                                          @else 
                                                          
                                                         {{ $data->details }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {{ $data->details_ar }}
                                                          @else
                                                          {{ $data->details }}
                                                          @endif
                                                      @endif</p>
									</blockquote>
								</div><!-- End .testimonial -->
								
								@endforeach

							
							</div><!-- End .testimonials-slider -->
						</div><!-- End .widget -->
						

						<div class="widget widget-posts post-date-in-media">
							<div class="owl-carousel owl-theme dots-left dots-m-0" data-owl-options="{
								'margin': 20
							}">
							
							
							 
							   @foreach($blogs as $blog)
								<article class="post">
                                    <div class="post-media">
                                        <a href="single.html">
                                            <img src="{{asset('assets/images/blogs/'.$blog->photo)}}" alt="Post">
                                        </a>
										<!--<div class="post-date">-->
										<!--	<span class="day">{{$blog->created_at}}</span>-->
										
										<!--</div>-->
                                    </div><!-- End .post-media -->

                                    <div class="post-body">
                                        <h2 class="post-title m-b-2">
                                            <a href="{{route('front.blogshow',['id' => $blog->id , 'lang' => $sign ])}}"> @if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $blog->title_ar }}
                                              @else 
                                             {{ $blog->title }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                                {{ $blog->title_ar }}
                                              @else
                                              {{ $blog->title }}
                                              @endif
                                               @endif </a>
                                        </h2>

                                        <div class="post-content">
                                            <p>@if(!$slang)
                                              @if($lang->id == 2)
                                              {!! substr($blog->details_ar,0,100) !!}
                                              @else 
                                             {!! substr($blog->details,0,100) !!}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                                {!! substr($blog->details_ar,0,100) !!}
                                              @else
                                              {!! substr($blog->details,0,100)!!}
                                              @endif
                                               @endif </p>

                                            <a href="{{route('front.blogshow',['id' => $blog->id , 'lang' => $sign ])}}" class="read-more">{{ $langg->lang34 }} <i class="icon-right-open"></i></a>
                                        </div><!-- End .post-content -->
                                    </div><!-- End .post-body -->
								</article>
								@endforeach

							
							</div><!-- End .posts-slider -->
						</div><!-- End .widget -->
					</aside><!-- End .col-lg-3 -->
				</div><!-- End .row -->
			</div><!-- End .container -->
		</main><!-- End .main -->