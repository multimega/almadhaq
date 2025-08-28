
@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);
$blogs = DB::table('blogs')->get();
@endphp

     
  <main class="main">
            <div class="home-slider-container">
                <div class="home-slider owl-carousel owl-theme owl-theme-light">
                   
                @if($ps->slider == 1)
				   @if(count($sliders))
					@foreach($sliders as $data)
					
                    <a href="{{$data->link}}"><div class="home-slide">
                        <div class="slide-bg owl-lazy"  data-src="{{asset('assets/images/sliders/'.$data->photo)}}"></div><!-- End .slide-bg -->
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-8 col-md-6 text-center slide-content-right">
                                    <div class="home-slide-content">
                                        <h3 style="color:{{$data->subtitle_color}};size:{{$data->subtitle_size}}">
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
                                            
                                        </h3>
                                        <h1 style="color:{{$data->title_color}};size:{{$data->title_size}}">
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
                                            
                                            
                              @endif
                                            
                                        </h1>
                                         
                                        <!--  @if(!empty($data->link)) -->
                                        
                                        <!--@endif-->
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
                      @foreach($chunk as $key=>$data)
                        
                    <div class="info-box">
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
                            <h4>
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
                            </h4>
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
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
               @endforeach
                   
                </div><!-- End .container -->
            </div><!-- End .info-boxes-container -->

            <div class="banners-group">
                <div class="container">
                    <div class="row">
                        @foreach( $top_small_banners as $data)
                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="{{$data->link}}">
                                    <img src="{{asset('assets/images/banners/'.$data->photo)}}" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                      @endforeach
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .banneers-group -->

          @if($ps->featured == 1)
            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{ $langg->lang26 }}</h2>

                    <div class="featured-products owl-carousel owl-theme">
                  
                       @foreach($feature_products as $key => $prod)
                        <div class="product" style="height: 415px;">
                            
                            <figure class="product-image-container">
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" class="product-image">
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
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">
                                   {{ $langg->lang55 }}
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title" style="height: 50px;">
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
                                    <span class="product-price">{{ $prod->showPrice() }}</span>
                                </div><!-- End .price-box -->

                                <div class="product-action">
                                    
                                     @if(Auth::guard('web')->check())
									  <a  href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>Add to Wishlist</span>
                                        </a>
                                        @endif
                                    
                                    @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a  class="paction add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"   title="Add to Cart">
                                            <span>{{$langg->lang56}}</span>
                                      </a>                                    @endif
                                     


                                    <a href="#" class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                            <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                       @endforeach
                       
                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-proucts-section -->
          @endif
          
           <!--best-->
           
            @if($ps->best ==1)
              <div class="mb-5"></div><!-- margin -->
            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{ $langg->lang27 }}</h2>

                    <div class="featured-products owl-carousel owl-theme">
                  
                       @foreach($best_products as $key => $prod)
                        <div class="product" style="height: 415px;">
                            
                            <figure class="product-image-container">
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" class="product-image">
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
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">
                                   {{$langg->lang55}}
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title" style="height: 50px;">
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
                                    <span class="product-price">{{ $prod->showPrice() }}</span>
                                </div><!-- End .price-box -->

                                <div class="product-action">
                                    
                                     @if(Auth::guard('web')->check())
									  <a  href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>Add to Wishlist</span>
                                        </a>
                                        @endif

                                         @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a  class="paction add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"   title="Add to Cart">
                                            <span>{{$langg->lang56}}</span>
                                      </a>                                    @endif
                                     


                                    <a href="#" class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                            <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                       @endforeach
                       
                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-proucts-section -->
          @endif
          
          
          <!--top-->
          
           @if($ps->top_rated ==1)
              <div class="mb-5"></div><!-- margin -->
            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{ $langg->lang28 }}</h2>

                    <div class="featured-products owl-carousel owl-theme">
                  
                       @foreach($top_products as $key => $prod)
                        <div class="product" style="height: 415px;">
                            
                            <figure class="product-image-container">
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}" class="product-image">
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
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">
                                     {{$langg->lang55}}
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title" style="height: 50px;">
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
									  <a  href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>Add to Wishlist</span>
                                        </a>
                                        @endif

                                       @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a  class="paction add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"   title="Add to Cart">
                                            <span>{{$langg->lang56}}</span>
                                      </a>                                    @endif
                                     


                                    <a href="#" class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                            <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                       @endforeach
                       
                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-proucts-section -->
          @endif
          
          
          <!--big-->
          
          @if($ps->big ==1)
              <div class="mb-5"></div><!-- margin -->
            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{ $langg->lang29 }}</h2>

                    <div class="featured-products owl-carousel owl-theme">
                  
                       @foreach($big_products as $key => $prod)
                        <div class="product" style="height: 415px;">
                            
                            <figure class="product-image-container">
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" class="product-image">
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
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">
                                   {{$langg->lang55}} 
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title" style="height: 50px;">
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
									  <a  href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>Add to Wishlist</span>
                                        </a>
                                        @endif

                                        @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a  class="paction add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"   title="Add to Cart">
                                            <span>{{$langg->lang56}}</span>
                                      </a>                                    @endif
                                     

                                    <a href="#" class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                            <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                       @endforeach
                       
                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-proucts-section -->
          @endif
          
          
          
           <!--hot-->
          
          @if($ps->hot_sale ==1)
              <div class="mb-5"></div><!-- margin -->
            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{ $langg->lang32 }}</h2>

                    <div class="featured-products owl-carousel owl-theme">
                  
                       @foreach($hot_products as $key => $prod)
                        <div class="product" style="height: 415px;">
                            
                            <figure class="product-image-container">
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}" class="product-image">
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
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">
                                    {{$langg->lang55}}
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title" style="height: 50px;">
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
									  <a  href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>Add to Wishlist</span>
                                        </a>
                                        @endif

                                       @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a  class="paction add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"   title="Add to Cart">
                                            <span>{{$langg->lang56}}</span>
                                      </a>                                    @endif
                                     


                                    <a href="#" class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                            <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                       @endforeach
                       
                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-proucts-section -->
          @endif
          
          
          
            @if($ps->hot_sale ==1)
              <div class="mb-5"></div><!-- margin -->
            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{ $langg->lang33 }}</h2>

                    <div class="featured-products owl-carousel owl-theme">
                  
                       @foreach($trending_products as $key => $prod)
                        <div class="product" style="height: 415px;">
                            
                            <figure class="product-image-container">
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}" class="product-image">
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
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">
                                    {{$langg->lang55}}
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title" style="height: 50px;">
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
									  <a  href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>Add to Wishlist</span>
                                        </a>
                                        @endif

                                        @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a  class="paction add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"   title="Add to Cart">
                                            <span>{{$langg->lang56}}</span>
                                      </a>                                    @endif
                                     


                                    <a href="#" class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                            <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                       @endforeach
                       
                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-proucts-section -->
          @endif
          
          
          
          
          @if($ps->flash_deal  == 1)
          
           <div class="mb-5"></div><!-- margin -->
            <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{ $langg->lang244 }}</h2>

                    <div class="featured-products owl-carousel owl-theme">
                  
                       @foreach($discount_products as $key => $prod)
                        <div class="product" style="height: 415px;">
                            
                            <figure class="product-image-container">
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" class="product-image">
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
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">
                                     {{$langg->lang55}}
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title" style="height: 50px;">
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
									  <a  href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>Add to Wishlist</span>
                                        </a>
                                        @endif

                                          @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a  class="paction add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"   title="Add to Cart">
                                            <span>{{$langg->lang56}}</span>
                                      </a>                                    @endif
                                     


                                    <a href="#" class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                            <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                       @endforeach
                       
                    </div><!-- End .featured-proucts -->
                </div><!-- End .container -->
            </div><!-- End .featured-proucts-section -->
          @endif
          
          
          
          
          
          
           @if($ps->hot_sale ==1)
            <div class="mb-5"></div><!-- margin -->

            <div class="carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{ $langg->lang31}}</h2>

                    <div class="new-products owl-carousel owl-theme">
                        
                      @foreach($latest_products as $prod)
                         <div class="product" style="height: 415px;">
                            
                            <figure class="product-image-container">
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}" class="product-image">
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
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">
                                     {{$langg->lang55}}
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title" style="height: 50px;">
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
									  <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>Add to Wishlist</span>
                                        </a>
                                        @endif

                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a  class="paction add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"   title="Add to Cart">
                                            <span>{{$langg->lang56}}</span>
                                      </a>                                    @endif
                                     

                                    <a href="#" class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                            <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                       @endforeach

                        
                    </div><!-- End .news-proucts -->
                </div><!-- End .container -->
            </div><!-- End .carousel-section -->

            @endif
            
            
            <div class="mb-5"></div><!-- margin -->

            <div class="info-section">
                <div class="container">
                    <div class="row">
                          @foreach($chunkss as $key=>$data )
                          
                        <div class="col-md-4">
                            <div class="feature-box feature-box-simple text-center">
                                
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
                                    <h3>@if(!$slang)
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
                                      @endif<span></span></h3>
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
                </div><!-- End .container -->
            </div><!-- End .info-section -->
            
            @if(!empty($large_banners[0]))
            <section class="promo-section" data-parallax="{'speed': 1.8, 'enableOnMobile': true}" style="background-image: url('assets/images/banners/{{$large_banners[0]->photo}}');background-position: center;background-repeat: no-repeat;background-size: cover;height: 300px;display: flex;align-items: center;">
				<div class="promo-banner banner container text-uppercase">
					<div class="banner-content row align-items-center text-center">
					    <div class="row">
    						<div class="col-md-4 ml-xl-auto text-md-right">
    							<h2 class="mb-md-0 text-white">
    							    @if(!$slang)
                                      @if($lang->id == 2)
                                        {!!$banner[0]->title_ar!!}
                                      @else 
                                        {!!$banner[0]->title!!}
                                      @endif 
                                        @else  
                                          @if($slang == 2) 
                                            {!!$fix_banners[0]->title_ar!!}
                                          @else
                                            {!!$fix_banners[0]->title!!}
                                          @endif
                                      @endif
    							</h2>
    						</div>
    						<div class="col-md-4 col-xl-3 pb-4 pb-md-0">
    							<a href="{{$large_banners[0]->link}}" class="btn btn-dark btn-black ls-10">
    							    @if(!$slang)
                                       @if($lang->id == 2)
                                        {!!$fix_banners[0]->btn_ar!!}  
                                      @else 
                                       {!!$fix_banners[0]->button!!}  
                                      @endif 
                                       @else  
                                      @if($slang == 2) 
                                        {!!$fix_banners[0]->btn_ar!!}  
                                      @else
                                       {!!$fix_banners[0]->button!!}  
                                      @endif
                                    @endif  
    							</a>
    						</div>
    						<div class="col-md-4 mr-xl-auto text-md-left">
    							<h5 class="mb-2 coupon-sale-text text-white ls-10 p-0"><i class="ls-0">
    							    @if(!$slang)
                                      @if($lang->id == 2)
                                        {!!$fix_banners[0]->subtitle_ar!!}
                                          @else 
                                          {!!$fix_banners[0]->subtitle!!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$fix_banners[0]->subtitle_ar!!}
                                          @else
                                          {!!$fix_banners[0]->subtitle!!}
                                          @endif
                                      @endif
    							</h5>
    						</div>
						</div>
					</div>
				</div>
			</section>
			@endif
            
        	@if($ps->partners == 1)
            <div class="partners-container">
                <div class="container">
                    
                    <div class="partners-carousel owl-carousel owl-theme">
                         @foreach($partners as $j)
                        <a href="{{$j->link}}" class="partner">
                            <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo">
                        </a>
                       @endforeach
                    </div><!-- End .partners-carousel -->
                </div><!-- End .container -->
            </div><!-- End .partners-container -->
            @endif
            <div class="blog-section">
                <div class="container">

                <div class="container">
                    <h2 class="h3 title text-center">
                         @if(!$slang)
                          @if($lang->id == 2)
                          المدونات
                          @else 
                          BLOGS
                          @endif 
                          @else  
                          @if($slang == 2) 
                             المدونات
                          @else
                         BLOGS
                          @endif
                      @endif
                        
                    </h2>

                    <div class="blog-carousel owl-carousel owl-theme">
                        @foreach($blogs as $blog)
                            <article class="post">
							<div class="post-media">
								<a href="{{route('front.blogshow',['id' => $blog->id , 'lang' => $sign ])}}">
									<img src="{{asset('assets/images/blogs/'.$blog->photo)}}" alt="Post" width="225" height="280">
								</a>
								<div class="post-date">
									<span class="day">26</span>
									<span class="month">Feb</span>
								</div>
							</div><!-- End .post-media -->

							<div class="post-body">
								<h2 class="post-title">
									<a href="{{route('front.blogshow',['id' => $blog->id , 'lang' => $sign ])}}">
									    @if(!$slang)
                                          @if($lang->id == 2)
                                          {!! $blog->title_ar !!}
                                          @else 
                                         {!! $blog->title !!}
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                            {!! $blog->title_ar !!}
                                          @else
                                          {!! $blog->title !!}
                                          @endif
                                           @endif 
									</a>
								</h2>
								<div class="post-content">
									<p>
									     @if(!$slang)
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
                                           @endif
									</p>
								</div><!-- End .post-content -->
							</div><!-- End .post-body -->
						</article><!-- End .post -->
                        @endforeach
                         

                      
                    </div><!-- End .blog-carousel -->
                </div><!-- End .container -->
            </div><!-- End .blog-section -->
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
        
   