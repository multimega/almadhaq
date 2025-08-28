@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
        <main class="main">
            <div class="home-slider-container">
                <div class="home-slider owl-carousel owl-theme owl-theme-light">
                  
	             @if($ps->slider == 1)
				   @if(count($sliders))
					@foreach($sliders as $data)
                    <a href="{{$data->link}}"><div class="home-slide">
                    <div class="slide-bg owl-lazy"  data-src="{{asset('assets/images/sliders/'.$data->photo)}}"></div>
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-8 col-md-6 text-center slide-content-right">
                                    <div class="home-slide-content">
                                        <h3>	
                                        <h4 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">  @if(!$slang)
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
                                            @endif</h3>
											
											<h1 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}"> 


                                                  @if(!$slang)
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
                                                   @endif</h1>
                                                    
                                                          
                                                      
                                                    
                                    </div><!-- End .home-slide-content -->
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .container -->
                    </div><!-- End .home-slide --></a>
                    @endforeach
                    @endif
                    @endif
                </div><!-- End .home-slider -->
            </div><!-- End .home-slider-container -->

            <div class="info-boxes-container">
                <div class="container">
                     @foreach($chunk as $service)  
                    <div class="info-box">
                        <i class="icon-{{$service->icon}}"></i>
                        <div class="info-box-content">
                            <h4>         
                                         @if(!$slang)
                                         @if($lang->id == 2)
                                         {{ $service->title_ar }}
                                          @else 
                                         	{{ $service->title }}
                                          @endif 
                                        @else
                                          @if($slang == 2) 
                                          	{{ $service->title_ar }}
                                          @else
                                          	{{ $service->title }}
                                          @endif
                                          @endif
                                          </h4>
                                       <p>
                                            @if(!$slang)
                                           @if($lang->id == 2)
                                         {{ $service->details_ar }}
                                          @else 
                                         	{{ $service->details }}
                                          @endif 
                                         @else
                                          @if($slang == 2) 
                                          	{{ $service->details_ar }}
                                          @else
                                          	{{ $service->details }}
                                          @endif
                                          @endif
                                          </p>
                                    </div><!-- End .info-box-content -->
                              </div><!-- End .info-box -->
                                  @endforeach
                                  </div>
                                  </div>
                                
            <div class="banners-group">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="{{$top_small_banners[0]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[0]->photo)}}" style="height:143px;"alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->

                      @if(!empty($top_small_banners[1]->link))
                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="{{$top_small_banners[1]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[1]->photo)}}"style="height:143px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                        @endif

                      @if(!empty($top_small_banners[2]->link))
                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="{{$top_small_banners[2]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[2]->photo)}}"style="height:143px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                        
                        @endif
                        
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .banneers-group -->
            	@if($ps->featured == 1)
            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">	{{ $langg->lang26 }}</h2>

                    <div class="featured-products owl-carousel owl-theme">
                       @foreach($feature_products as $prod)
                        <div class="product-default">
                            <figure>
                               <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  @if(!$slang)
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
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
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
                                
                                <div class="price-box">
                                    <span class="product-price">{{ $prod->showPrice() }}</span>
                                </div><!-- End .price-box -->
                                <div class="product-action">
                                     @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                      <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-proucts-section -->
                 @endif
            <div class="mb-5"></div><!-- margin -->
        	 	@if($ps->best == 1)

            <div class="carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{ $langg->lang27 }}</h2>

                    <div class="new-products owl-carousel owl-theme">
                       @foreach($best_products as $prod)
                        <div class="product-default">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                     <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png')}}" style="width:243px;height:243px;"  @if(!$slang)
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
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
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
                                    
                                           <div class="price-box">
                                               <span class="product-price"><span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                               <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                          </div><!-- End .price-box -->
                                   <div class="product-action">
                                   @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                    <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                                  </div>
                              </div><!-- End .product-details -->
                           </div>
                             @endforeach
                    </div><!-- End .news-proucts -->
                    
                </div><!-- End .container -->
            </div><!-- End .carousel-section -->
           @endif
            <div class="mb-5"></div>
        	@if($ps->top_rated == 1)
            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">	{{ $langg->lang28 }}</h2>
                    <div class="featured-products owl-carousel owl-theme">
                       @foreach($top_products as $prod)
                        <div class="product-default">
                            <figure>
                               <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  @if(!$slang)
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
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
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
                                
                                <div class="price-box">
                                    <span class="product-price">{{ $prod->showPrice() }}</span>
                                </div><!-- End .price-box -->
                                <div class="product-action">
                                     @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                      <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-proucts-section -->
                 @endif
            <div class="mb-5"></div><!-- margin -->
            
            	@if($ps->big == 1)
            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">	{{ $langg->lang29 }}</h2>

                    <div class="featured-products owl-carousel owl-theme">
                       @foreach($big_products as $prod)
                        <div class="product-default">
                            <figure>
                               <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  @if(!$slang)
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
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
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
                                
                                <div class="price-box">
                                    <span class="product-price">{{ $prod->showPrice() }}</span>
                                </div><!-- End .price-box -->
                                <div class="product-action">
                                     @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                      <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-proucts-section -->
                 @endif
            <div class="mb-5"></div><!-- margin -->
            
             @if(!empty($large_banners[0]))
            <a href="{{$large_banners[0]->link}}"><div class="promo-section" style="background-image: url({{asset('assets/images/banners/'.$large_banners[0]->photo)}})">
                <div class="container">
                    <h3>{{$large_banners[0]->title}}</h3>
                    
                </div><!-- End .container -->
            </div><!-- End .promo-section --></a>
            @endif
            <div class="partners-container">
                <div class="container">
                    <div class="partners-carousel owl-carousel owl-theme">
                          @foreach($partners as $j)
                        <a href="#" class="partner">
                            <img src="{{asset('assets/images/partner/'.$j->photo)}}" style="width:100%; height:50px;" alt="logo">
                        </a>
                        @endforeach
                       
                    </div>
                </div>
            </div>

            <div class="blog-section">
                <div class="container">
                    <h2 class="h3 title text-center">{{ $langg->lang24 }}</h2>
                    <div class="blog-carousel owl-carousel owl-theme">
                       
                      	@foreach(DB::table('blogs')->orderby('views','desc')->take(2)->get() as $blogg)

                        <article class="entry">
                            <div class="entry-media">
                                <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign])}}">
                                    <img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" alt="Post">
                                </a>
                                <div class="entry-date"> 
                                
                                <span> {{date('d', strtotime($blogg->created_at))}}
								{{date('M', strtotime($blogg->created_at))}}
                                                </span></div>
                            </div>

                            <div class="entry-body">
                                <h3 class="entry-title">
                                    <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign])}}">
                                        
                                         @if(!$slang)
                                        @if($lang->id == 2)
                                                 {!!strlen($blogg->title_ar) > 70 ? substr($blogg->title_ar,0,70)."..." : $blogg->title_ar!!}
                                                  @else 
                                                  {!!strlen($blogg->title) > 40 ? substr($blogg->title,0,40)."..." : $blogg->title!!}
                                                  @endif 
                                              @else  
                                                  @if($slang == 2) 
                                                {!!strlen($blogg->title_ar) > 70 ? substr($blogg->title_ar,0,70)."...":$blogg->title_ar!!}
                                                  @else
                                                  {!!strlen($blogg->title) > 40 ? substr($blogg->title,0,40)."..." : $blogg->title!!}
                                                  @endif
                                              @endif      
									</a>
                                </h3>
                                <div class="entry-content">
                                        <p> 
                                          @if($lang->id == 2)
                                             {!!substr(strip_tags($blogg->details_ar),0,400)!!}
                                              @else 
                                             	{!!substr(strip_tags($blogg->details),0,170)!!}
                                              @endif 
                                             
                                              @if($slang == 2) 
                                              	{!!substr(strip_tags($blogg->details_ar),0,400)!!}
                                              @else
                                              	{!!substr(strip_tags($blogg->details),0,170)!!}
                                              @endif
                                        </p>

                                    <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign])}}" class="btn btn-dark">{{ $langg->lang34 }}</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                        @endforeach
                    </div><!-- End .blog-carousel -->
                </div><!-- End .container -->
            </div><!-- End .blog-section -->
        </main><!-- End .main -->

    