@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$categorys=App\Models\Category::get();
$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);

@endphp
        <main class="main">
            @if(!empty($large_banners[0]))
            <div class="intro-section" style="background-image: url({{asset('assets/images/banners/'.$large_banners[0]->photo)}});">
                <div class="container">
                    <div class="intro-section-content">
                        <h4>{!!$large_banners[0]->title!!}</h4>
                        <h1>{!!$large_banners[0]->subtitle!!}</h1>
                        <h3><strong>{!!$large_banners[0]->title!!}</strong></h3>

                        <div class="intro-section-action">
                            <a href="{{$large_banners[0]->link}}" class="btn btn-primary">{!!$large_banners[0]->button!!}</a>
                        </div><!-- End .intro-section-action -->
                    </div><!-- End .intro-section-content -->

                    <div class="intro-products-container">
                        <div class="carousel-wrapper">
                            <div class="selected-products owl-carousel owl-theme">
                              
                                @foreach($categorys as $data) 
                                    <div class="banner-cat">
                                        <a href="{{ route('front.category', ['category' => $data->slug ,'lang' => $sign ]) }}">
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
                                           @endif
                                        </a>
                                   </div>
                               @endforeach
                            </div><!-- End .featured-proucts -->
                        </div><!-- End .carousel-wrappeer -->
                    </div><!-- End .intro-products-container -->
                </div><!-- End .container -->
            </div><!-- End .intro-section -->
            @endif
            
            <div class="banners-container">
                <div class="row mb-1">
                    <div class="col-md-9">
                        <div class="row">
                             @if(!empty($large_banners[0]))
                            <div class="col-md-8 mb-s2">
                                <div class="banner banner-image">
                                    <a href="{{$fix_banners[0]->link}}">
                                        <img src="{{asset('assets/images/banners/'.$fix_banners[0]->photo)}}" alt="banner" style="height:300px;">
                                    </a>
                                </div><!-- End .banner -->
                            </div><!-- End .col-sm-8 -->
                            @endif
                            @if(!empty($large_banners[1]))
                            <div class="col-md-4 mb-s2">
                                <div class="banner banner-image">
                                    <a href="{{$large_banners[1]->link}}">
                                        <img src="{{asset('assets/images/banners/'.$large_banners[1]->photo)}}" alt="banner" style="height:300px;">
                                    </a>
                                </div><!-- End .banner -->
                            </div><!-- End .col-sm-4 -->
                            @endif
                            @if(!empty($large_banners[2]))
                            <div class="col-md-12 mb-s2">
                                <div class="banner banner-image">
                                    <a href="{{$large_banners[2]->link}}">
                                        <img src="{{asset('assets/images/banners/'.$large_banners[2]->photo)}}" alt="banner" style="height:220px;">
                                    </a>
                                </div><!-- End .banner -->
                            </div><!-- End .col-sm-4 -->
                            @endif
                        </div>
                    </div>
                    @if(!empty($large_banners[3]))
                    <div class="col-md-3 mb-s2">
                        <div class="banner banner-image">
                            <a href="{{$large_banners[3]->link}}">
                                <img src="{{asset('assets/images/banners/'.$large_banners[3]->photo)}}" alt="banner" style="height:520px;">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .col-sm-4 -->
                    @endif
                </div><!-- End .row -->
                <div class="row">
                    @if(!empty($large_banners[4]))
                    <div class="col-md-4 mb-s2">
                        <div class="banner banner-image">
                            <a href="{{$large_banners[4]->link}}">
                                <img src="{{asset('assets/images/banners/'.$large_banners[4]->photo)}}" alt="banner" style="height:520px;">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .col-sm-4 -->
                    @endif
                    @if(!empty($large_banners[5]))
                    <div class="col-md-4 mb-s2">
                        <div class="banner banner-image">
                            <a href="{{$large_banners[5]->link}}">
                                <img src="{{asset('assets/images/banners/'.$large_banners[5]->photo)}}" alt="banner" style="height:260px;">
                            </a>
                        </div><!-- End .banner -->
                        @endif
                        @if(!empty($large_banners[6]))
                        <div class="banner banner-image">
                            <a href="{{$large_banners[6]->link}}">
                                <img src="{{asset('assets/images/banners/'.$large_banners[6]->photo)}}" alt="banner" style="height:260px;">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .col-sm-4 -->
                    @endif
                        @foreach($chunk as $service)
                    <div class="col-md-4 mb-s2">
                            <div class="feature-box feature-box-home text-center mb-1">
                               <img src="{{asset('assets/images/services/'.$service->photo)}}" class="m-auto" style="width:30px;height:30px;">

                                <div class="feature-box-content">
                                    <h3>
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
                                    </h3>
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
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                    </div><!-- col-md-4 mb-s2 -->
                         @endforeach 
                </div>
            </div><!-- End .banners-container -->


   
          @if($ps->featured == 1)
            <div class="container larger">
                <h2 class="subtitle text-center">{{ $langg->lang26 }}</h2>
                
                <div class="carousel-wrapper">
                    <div class="featured-products owl-carousel owl-theme">
               	            @foreach($feature_products  as $prod)            
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
                                <h2 class="product-title" style="word-break:break-all">
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
                                </div>
                                <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                     
                                      
                                      
                                       @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                    @endif
                                      
                                      
                                      
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach

                    </div><!-- End .featured-proucts -->
                </div><!-- End .carousel-wrapper -->
            </div><!-- End .container -->
             @endif
            <div class="mb-1"></div>  










                 
                @if($ps->best == 1) 
            <div class="container larger">
            
                <h2 class="subtitle text-center">{{ $langg->lang27 }}</h2>
                
                <div class="carousel-wrapper">
                    <div class="featured-products owl-carousel owl-theme">
               	            @foreach($best_products as $prod)            
                        <div class="product-default">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                </div>
                                <h2 class="product-title" style="word-break:break-all">
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
                                </div>
                                <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                    @endif
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach

                    </div><!-- End .featured-proucts -->
                </div><!-- End .carousel-wrapper -->
            </div><!-- End .container -->
             @endif
            <div class="mb-1"></div>
   
                @if($ps->top_rated == 1) 
            <div class="container larger">
                <h2 class="subtitle text-center">{{ $langg->lang28 }}</h2>
                
                <div class="carousel-wrapper">
                    <div class="featured-products owl-carousel owl-theme">
               	            @foreach($top_products as $prod)            
                        <div class="product-default">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"   @if(!$slang)
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
                                <h2 class="product-title" style="word-break:break-all">
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
                                </div>
                                <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                        @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                    @endif
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach

                    </div><!-- End .featured-proucts -->
                </div><!-- End .carousel-wrapper -->
            </div><!-- End .container -->
             @endif
            <div class="mb-1"></div>
            
        
        
        
        
            
          @if($ps->big == 1) 
            <div class="container larger">
                <h2 class="subtitle text-center">{{ $langg->lang29 }}</h2>
                
                <div class="carousel-wrapper">
                    <div class="featured-products owl-carousel owl-theme">
               	            @foreach($big_products as $prod)            
                        <div class="product-default">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"   @if(!$slang)
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
                                <h2 class="product-title" style="word-break:break-all">
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
                                </div>
                                <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                       @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                    @endif
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach

                    </div><!-- End .featured-proucts -->
                </div><!-- End .carousel-wrapper -->
            </div><!-- End .container -->
             @endif
            <div class="mb-1"></div>  
            
            
            
                @if($ps->hot_sale == 1)
            <div class="container larger">
                <h2 class="subtitle text-center">{{ $langg->lang32 }}</h2>
                
                <div class="carousel-wrapper">
                    <div class="featured-products owl-carousel owl-theme">
               	    @foreach($hot_products as $prod)            
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
                                <h2 class="product-title" style="word-break:break-all">
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
                                </div>
                                <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                        @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                    @endif
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach

                    </div><!-- End .featured-proucts -->
                </div><!-- End .carousel-wrapper -->
            </div><!-- End .container -->
             @endif
            <div class="mb-1"></div>  
            
            
            
                @if($ps->hot_sale == 1)
            <div class="container larger">
                <h2 class="subtitle text-center">{{ $langg->lang33 }}</h2>
                
                <div class="carousel-wrapper">
                    <div class="featured-products owl-carousel owl-theme">
               	    @foreach($trending_products as $prod)            
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
                                <h2 class="product-title" style="word-break:break-all">
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
                                </div>
                                <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                        @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                    @endif
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach

                    </div><!-- End .featured-proucts -->
                </div><!-- End .carousel-wrapper -->
            </div><!-- End .container -->
             @endif
            <div class="mb-1"></div>  
            
            
            
               
              @if($ps->flash_deal == 1)
            <div class="container larger">
                <h2 class="subtitle text-center">{{ $langg->lang244 }}</h2>
                
                <div class="carousel-wrapper">
                    <div class="featured-products owl-carousel owl-theme">
               	    @foreach($discount_products as $prod)            
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
                                <h2 class="product-title" style="word-break:break-all">
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
                                </div>
                                <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                        @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                    @endif
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach

                    </div><!-- End .featured-proucts -->
                </div><!-- End .carousel-wrapper -->
            </div><!-- End .container -->
             @endif
            <div class="mb-1"></div>  
            
            
            
            
            
            <div class="partners-container">
                <div class="container larger">
                    <h3 class="subtitle text-center">{{$langg->lang826}}</h3>
                    <div class="partners-carousel owl-carousel owl-theme">     
                         @foreach($partners as $j)
                        <a href="#" class="partner">
                            <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo">
                        </a>
                        @endforeach

                    </div><!-- End .partners-carousel -->
                </div><!-- End .container -->
            </div><!-- End .partners-container -->
            <section class="home-products-intro" id="topProducts" style="padding : 7rem 0 1rem;">
                <div class="container">
                    <div class="row row-sm">
                        <div class="col-sm-6 col-xl-3">
                            <div class="section-title mb-4">
                                <h4>{{ $langg->lang26}}</h4>
                            </div>
                            <?php $z=0; ?>
                            @foreach($feature_products as $prod)
                            @if($z<3)
                            <div class="product-default left-details row row-sm mb-0">
                                <figure class="col-4">
                                    <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"
                                        @if(!$slang)
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
                                <div class="product-details col-8">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                            <?php $z++; ?>
                            @endif
                            @endforeach
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="section-title mb-4">
                                <h4>{{ $langg->lang27}}</h4>
                            </div>
                            <?php $z=0; ?>
                            @foreach($best_products as $prod)
                            @if($z<3)
                            <div class="product-default left-details row row-sm mb-0">
                                <figure class="col-4">
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"
                                        @if(!$slang)
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
                                <div class="product-details col-8">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                            <?php $z++; ?>
                            @endif
                            @endforeach
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="section-title mb-4">
                                <h4>{{ $langg->lang28}}</h4>
                            </div>
                            <?php $z=0; ?>
                            @foreach($top_products as $prod)
                            @if($z<3)
                            <div class="product-default left-details row row-sm mb-0">
                                <figure class="col-4">
                                    <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"
                                        @if(!$slang)
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
                                <div class="product-details col-8">
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                            <?php $z++; ?>
                            @endif
                            @endforeach
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="section-title mb-4">
                                <h4>{{ $langg->lang31}}</h4>
                            </div>
                            <?php $z=0; ?>
                            @foreach($latest_products as $prod)
                            @if($z<3)
                            <div class="product-default left-details row row-sm mb-0">
                                <figure class="col-4">
                                    <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"
                                        @if(!$slang)
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
                                <div class="product-details col-8">
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                            <?php $z++; ?>
                            @endif
                            @endforeach
                        </div>
                        
                       </div>
                </div>
            </section>
        </main><!-- End .main -->

      