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
			      		    @foreach($sliders as $key=>$data)
                  
                    @if($key%2 == 0)
                    <div class="home-slide">
                        <div class="slide-bg owl-lazy" data-src="{{asset('assets/images/sliders/'.$data->photo)}}" style="background-position:32% center;"></div><!-- End .slide-bg -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5 offset-md-7">
                                    <div class="home-slide-content slide-content-big">
                                        <h1 style="color:{{$data->title_color}};font-size:{{$data->title_size}}" data-animation="animated {{$data->title_anime}}">@if(!$slang)
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
                                        <h3 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}"  data-animation="animated {{$data->subtitle_anime}}">
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
                                        <!--@if(!empty($data->link))-->
                                        <!--<a href="{{$data->link}}" class="btn btn-primary">-->
                                              
                                        <!--        @if(!$slang)-->
                                        <!--  @if($lang->id == 2)-->
                                        <!-- {{$data->btn_text_ar}}-->
                                        <!--  @else -->
                                        <!--  {{$data->btn_text}}-->
                                        <!--  @endif -->
                                        <!--    @else  -->
                                        <!--  @if($slang == 2) -->
                                        <!--  {{$data->btn_text_ar}}-->
                                        <!--  @else-->
                                        <!--  {{$data->btn_text}}-->
                                        <!--  @endif-->
                                            
                                            
                                        <!--   @endif-->
                                            
                                        <!--</a>-->
                                        @endif
                                    </div><!-- End .home-slide-content -->
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .container -->
                    </div><!-- End .home-slide -->
                
                    
                   @else    
                   <div class="home-slide">
                        <div class="slide-bg owl-lazy" data-src="{{asset('assets/images/sliders/'.$data->photo)}}" style="background-position:64% center;"></div><!-- End .slide-bg -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5 offset-md-1">
                                    <div class="home-slide-content slide-content-big">
                                       <h1 style="color:{{$data->title_color}};font-size:{{$data->title_size}}" data-animation="animated {{$data->title_anime}}">@if(!$slang)
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
                                        <h3 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}"  data-animation="animated {{$data->subtitle_anime}}">
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
                                        @if(!empty($data->link))
                                        <a href="{{$data->link}}" class="btn btn-primary">
                                              
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
                                    </div><!-- End .home-slide-content -->
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .container -->
                    </div><!-- End .home-slide -->
             
             
                    @endif
                    @endforeach
                  @endif
             @endif
             
             
             
             
                   
                </div><!-- End .home-slider -->
            </div><!-- End .home-slider-container -->

            <div class="banners-container mb-4 mb-lg-6 mb-xl-8">
                <div class="container">
                    <div class="row no-gutters">
                        
                         @if(!empty($top_small_banners[0]))
                        <div class="col-md-4">
                            <div class="banner">
                                     <div class="banner-content">
                                         <h3 class="banner-title">
                                        
                                                
                                                  {{$top_small_banners[0]->title}}
                                        
                                        </h3>

                                             <!--<a href="{{$top_small_banners[0]->link}}" class="btn">-->
                                               
                                             <!--     {{$top_small_banners[0]->button}}-->
                                                
                                                
                                             <!--    </a>-->
                                         
                                          </div>
                                       <a href="{{$top_small_banners[0]->link}}">
                                       <img src="{{asset('assets/images/banners/'.$top_small_banners[0]->photo)}}" style="height:163px;"    alt="banner">
                                     </a>
                            </div>
                        </div>
                        @endif
                        
                         @if(!empty($top_small_banners[1]->title))
                        
                        <div class="col-md-4">
                            <div class="banner">
                                <div class="banner-content">
                                    <h3 class="banner-title"> 
                                                 
                                                  {{$top_small_banners[1]->title}}
                                                 
                                    </h3>
                                       
                                              <!--<a href="{{$top_small_banners[1]->link}}" class="btn">-->
                                              
                                                  
                                              <!--    {{$top_small_banners[1]->button}}-->
                                                 
                                              <!--  </a>-->
                                </div><!-- End .banner-content -->
                                 <a href="{{$top_small_banners[1]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[1]->photo)}}"style="height:163px;" alt="banner">
                                </a>
                            </div>
                        </div>
                        @endif
                        
                         @if(!empty($top_small_banners[2]->title))
                        
                        <div class="col-md-4">
                            <div class="banner">
                                <div class="banner-content">
                                    <h3 class="banner-title"> 
                                    
                                                  {{$top_small_banners[2]->title}}
                                                  
                                     </h3>

                                        <!--   <a href="{{$top_small_banners[2]->link}}" class="btn">-->
                                        
                                                 
                                        <!--          {{$top_small_banners[2]->button}}-->
                                                  
                                        <!--</a>-->
                                </div><!-- End .banner-content -->
                                  <a href="{{$top_small_banners[2]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[2]->photo)}}" style="height:163px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                        @endif
                        
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div>
            
	        @if($ps->featured == 1)
                 
                <div class="container mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-center mb-3">{{ $langg->lang26}}</h2>
                <div class="owl-carousel owl-theme featured-products">
                    @foreach($feature_products  as $key=>$prod)
                  
                    <div class="product">
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
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><span>
                                     @if(!$slang)
                                           @if($lang->id == 2)
                                               نظرة سريعة 
                                              @else 
                                               Quick View
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                              نظرة سريعة 
                                              @else
                                              Quick View
                                              @endif
                                   @endif 
                            </span></a>
                           
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
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->

                            <div class="product-details-inner">
                                <div class="product-action">
                                  
                                  
                                  @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
  <a class="paction btn-add-cart add-to-cart add-cart" data-href="{{ route('product.cart.add',['id' => $prod->id , 'lang' => $sign ]) }}">
                                        <span>{{ $langg->lang75 }}</span>
                                    </a>                                    @endif
                                  
                                  

                                    @if(Auth::guard('web')->check())
                                    <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details-inner -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->

                     @endforeach

                </div><!-- End .featured-products -->
            </div><!-- End .container -->
               
            @endif
            
            
            

      
         
    @if(!empty($fix_banners[0]))         
           <div class="promo-section" style="background-image: url({{asset('assets/images/banners/'.$fix_banners[0]->photo)}})">
                <div class="container">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="promo-slider owl-carousel owl-theme owl-theme-light">
                                    <div class="promo-content">
                                        <h3>{{$fix_banners[0]->subtitle}}</h3>
                                        <a href="{{$fix_banners[0]->link}}" class="btn btn-primary">{{$fix_banners[0]->button}}</a>
                                    </div><!-- Endd .promo-content -->

                                     @if(!empty($fix_banners[1]))  
                                    <div class="promo-content">
                                        <h3>{{$fix_banners[1]->subtitle}}</h3>
                                        <a href="{{$fix_banners[1]->link}}" class="btn btn-primary">{{$fix_banners[1]->button}}</a>
                                    </div><!-- Endd .promo-content -->
                                    @endif
                                </div><!-- End .promo-slider -->
                            </div><!-- End .col-lg-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .container -->
            </div><!-- End .promo-section -->
            
         @endif
         
           
           
            <br>
          
          
          
            @if($ps->best == 1)
                 
                <div class="container mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-center mb-3">{{ $langg->lang27}}</h2>
                <div class="owl-carousel owl-theme featured-products">
                    @foreach($best_products  as $key=>$prod)
                  
                    <div class="product">
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
                                 <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><span>
                                     @if(!$slang)
                                           @if($lang->id == 2)
                                               نظرة سريعة 
                                              @else 
                                               Quick View
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                              نظرة سريعة 
                                              @else
                                              Quick View
                                              @endif
                                   @endif 
                            </span></a>
                           
                        </figure>
                        <div class="product-details">
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

                            <div class="product-details-inner">
                                <div class="product-action">
                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
  <a class="paction btn-add-cart add-to-cart add-cart" data-href="{{ route('product.cart.add',['id' => $prod->id , 'lang' => $sign ]) }}">
                                        <span>{{ $langg->lang75 }}</span>
                                    </a>                                    @endif

                                    @if(Auth::guard('web')->check())
                                    <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details-inner -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->

                     @endforeach

                </div><!-- End .featured-products -->
            </div><!-- End .container -->
               
            @endif
            
            
            
             @if($ps->top_rated == 1)
                 
                <div class="container mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-center mb-3">{{ $langg->lang28}}</h2>
                <div class="owl-carousel owl-theme featured-products">
                    @foreach($top_products  as $key=>$prod)
                  
                    <div class="product">
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
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}" class="hover-image"  @if(!$slang)
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
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><span>
                                     @if(!$slang)
                                           @if($lang->id == 2)
                                               نظرة سريعة 
                                              @else 
                                               Quick View
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                              نظرة سريعة 
                                              @else
                                              Quick View
                                              @endif
                                   @endif 
                            </span></a>
                           
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
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->

                            <div class="product-details-inner">
                                <div class="product-action">
                                       @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
  <a class="paction btn-add-cart add-to-cart add-cart" data-href="{{ route('product.cart.add',['id' => $prod->id , 'lang' => $sign ]) }}">
                                        <span>{{ $langg->lang75 }}</span>
                                    </a>                                    @endif

                                    @if(Auth::guard('web')->check())
                                    <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details-inner -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->

                     @endforeach

                </div><!-- End .featured-products -->
            </div><!-- End .container -->
               
            @endif
            
            
            
             @if($ps->big == 1)
                 
                <div class="container mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-center mb-3">{{ $langg->lang29}}</h2>
                <div class="owl-carousel owl-theme featured-products">
                    @foreach($big_products  as $key=>$prod)
                  
                    <div class="product">
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
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><span>
                                     @if(!$slang)
                                           @if($lang->id == 2)
                                               نظرة سريعة 
                                              @else 
                                               Quick View
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                              نظرة سريعة 
                                              @else
                                              Quick View
                                              @endif
                                   @endif 
                            </span></a>
                           
                        </figure>
                        <div class="product-details">
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

                            <div class="product-details-inner">
                                <div class="product-action">
                                       @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
  <a class="paction btn-add-cart add-to-cart add-cart" data-href="{{ route('product.cart.add',['id' => $prod->id , 'lang' => $sign ]) }}">
                                        <span>{{ $langg->lang75 }}</span>
                                    </a>                                    @endif

                                    @if(Auth::guard('web')->check())
                                    <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details-inner -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->

                     @endforeach

                </div><!-- End .featured-products -->
            </div><!-- End .container -->
               
            @endif
          
          
           
               @if($ps->hot_sale == 1)
                 
                <div class="container mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-center mb-3">{{ $langg->lang31}}</h2>
                <div class="owl-carousel owl-theme featured-products">
                    @foreach($latest_products  as $key=>$prod)
                  
                    <div class="product">
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
                               <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><span>
                                     @if(!$slang)
                                           @if($lang->id == 2)
                                               نظرة سريعة 
                                              @else 
                                               Quick View
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                              نظرة سريعة 
                                              @else
                                              Quick View
                                              @endif
                                   @endif 
                            </span></a>
                           
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
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->

                            <div class="product-details-inner">
                                <div class="product-action">
                                       @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
  <a class="paction btn-add-cart add-to-cart add-cart" data-href="{{ route('product.cart.add',['id' => $prod->id , 'lang' => $sign ]) }}">
                                        <span>{{ $langg->lang75 }}</span>
                                    </a>                                    @endif

                                    @if(Auth::guard('web')->check())
                                    <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details-inner -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->

                     @endforeach

                </div><!-- End .featured-products -->
            </div><!-- End .container -->
               
            @endif
            
            
            
             @if($ps->hot_sale == 1)
                 
                <div class="container mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-center mb-3">{{ $langg->lang32}}</h2>
                <div class="owl-carousel owl-theme featured-products">
                    @foreach($hot_products  as $key=>$prod)
                  
                    <div class="product">
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
                                 <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><span>
                                     @if(!$slang)
                                           @if($lang->id == 2)
                                               نظرة سريعة 
                                              @else 
                                               Quick View
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                              نظرة سريعة 
                                              @else
                                              Quick View
                                              @endif
                                   @endif 
                            </span></a>
                           
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
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->

                            <div class="product-details-inner">
                                <div class="product-action">
                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
  <a class="paction btn-add-cart add-to-cart add-cart" data-href="{{ route('product.cart.add',['id' => $prod->id , 'lang' => $sign ]) }}">
                                        <span>{{ $langg->lang75 }}</span>
                                    </a>                                    @endif

                                    @if(Auth::guard('web')->check())
                                    <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details-inner -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->

                     @endforeach

                </div><!-- End .featured-products -->
            </div><!-- End .container -->
               
            @endif
            
            
            
              @if($ps->hot_sale == 1)
                 
                <div class="container mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-center mb-3">{{ $langg->lang33}}</h2>
                <div class="owl-carousel owl-theme featured-products">
                    @foreach($trending_products  as $key=>$prod)
                  
                    <div class="product">
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
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><span>
                                     @if(!$slang)
                                           @if($lang->id == 2)
                                               نظرة سريعة 
                                              @else 
                                               Quick View
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                              نظرة سريعة 
                                              @else
                                              Quick View
                                              @endif
                                   @endif 
                            </span></a>
                           
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
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->

                            <div class="product-details-inner">
                                <div class="product-action">
                                       @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
  <a class="paction btn-add-cart add-to-cart add-cart" data-href="{{ route('product.cart.add',['id' => $prod->id , 'lang' => $sign ]) }}">
                                        <span>{{ $langg->lang75 }}</span>
                                    </a>                                    @endif

                                    @if(Auth::guard('web')->check())
                                    <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details-inner -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->

                     @endforeach

                </div><!-- End .featured-products -->
            </div><!-- End .container -->
               
            @endif
            
            
            
              @if($ps->flash_deal == 1)
                 
                <div class="container mb-2 mb-lg-4 mb-xl-5">
                <h2 class="title text-center mb-3">{{ $langg->lang244}}</h2>
                <div class="owl-carousel owl-theme featured-products">
                    @foreach($discount_products  as $key=>$prod)
                  
                    <div class="product">
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
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><span>
                                     @if(!$slang)
                                           @if($lang->id == 2)
                                               نظرة سريعة 
                                              @else 
                                               Quick View
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                              نظرة سريعة 
                                              @else
                                              Quick View
                                              @endif
                                   @endif 
                            </span></a>
                           
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
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->

                            <div class="product-details-inner">
                                <div class="product-action">
                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
  <a class="paction btn-add-cart add-to-cart add-cart" data-href="{{ route('product.cart.add',['id' => $prod->id , 'lang' => $sign ]) }}">
                                        <span>{{ $langg->lang75 }}</span>
                                    </a>                                    @endif

                                    @if(Auth::guard('web')->check())
                                    <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details-inner -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->

                     @endforeach

                </div><!-- End .featured-products -->
            </div><!-- End .container -->
               
            @endif
            
            
            
            
          
      
      
           <div class="blog-section">
                <div class="container">
                    <h2 class="title text-center mb-3">{{ $langg->lang24 }}</h2>

                    <div class="blog-carousel owl-carousel owl-theme">
                       
                       	@foreach(DB::table('blogs')->orderby('views','desc')->take(3)->get() as $blogg)
                        <article class="entry">
                            <div class="entry-media">
                                <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign])}}">
                                    <img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png')}}" alt="Post">
                                </a>
                            </div><!-- End .entry-media -->

                            <div class="entry-body">
                                <h2 class="entry-title">
                                    <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign])}}">
                                       @if(!$slang)
                                        @if($lang->id == 2)
                                                 {!!strlen($blogg->title_ar) > 70 ? substr($blogg->title_ar,0,70)."..." : $blogg->title_ar!!}
                                                  @else 
                                                  {{strlen($blogg->title) > 40 ? substr($blogg->title,0,40)."..." : $blogg->title}}
                                                  @endif 
                                              @else  
                                                  @if($slang == 2) 
                                                {!!strlen($blogg->title_ar) > 70 ? substr($blogg->title_ar,0,70)."...":$blogg->title_ar!!}
                                                  @else
                                                  {{strlen($blogg->title) > 40 ? substr($blogg->title,0,40)."..." : $blogg->title}}
                                                  @endif
                                              @endif      
                                    </a>
                                </h2>
                                <div class="entry-date"> {{date('d-m-Y', strtotime($blogg->created_at))}}</div><!-- End .entry-date -->
                                <div class="entry-content">
                                    <p>
                                         @if(!$slang)
                                         @if($lang->id == 2)
                                             {!!substr(strip_tags($blogg->details_ar),0,200)!!}
                                              @else 
                                             	{{substr(strip_tags($blogg->details),0,70)}}
                                              @endif 
                                             @else
                                              @if($slang == 2) 
                                              	{!!substr(strip_tags($blogg->details_ar),0,200)!!}
                                              @else
                                              	{{substr(strip_tags($blogg->details),0,70)}}
                                              @endif
                                             @endif
                                    </p>

                                    <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign])}}" class="read-more">{{ $langg->lang34 }} <i class="icon-angle-right"></i></a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                        @endforeach
                       
                    </div><!-- End .blog-carousel -->
                </div><!-- End .container -->
            </div><!-- End .blog-section -->
      
      
      
      
        </main><!-- End .main -->

      