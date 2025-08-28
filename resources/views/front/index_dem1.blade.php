
@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp

        <main class="main">
            <div class="home-top-container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="home-slider owl-carousel owl-carousel-lazy">
                                         @if($ps->slider == 1)
				                         @if(count($sliders))
				                     	 @foreach($sliders as $data)
    
                                <a href="{{$data->link}}"><div class="home-slide">
                                    <div class="owl-lazy slide-bg" data-src="{{asset('assets/images/sliders/'.$data->photo)}}"></div>
                                    <div class="home-slide-content">
                                    <h3 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">  @if(!$slang)
                                        
                                        
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
                                        <h1>@if(!$slang)
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
                                                  <p>
                                                    @if($lang->id == 2)
                                                     {{$data->details_text_ar}}
                                                    @else 
                                                       {{$data->details_text}}
                                                      @endif </p>
                                        
                                    </div><!-- End .home-slide-content -->
                                </div><!-- End .home-slide --></a>
                                @endforeach
                                 @endif
                                 @endif
                                
                            </div><!-- End .home-slider -->
                        </div><!-- End .col-lg-9 -->

                        <div class="col-lg-3 order-lg-first">
                            <div class="side-custom-menu">
                                <h2>{{ $langg->lang14 }}</h2>
                                <div class="side-menu-body">
                                    <ul>
                                          @if(isset($categories))
                                          @foreach($categories as $data) 
                                         <li> <a href="{{ url($sign.'/category/'.$data->slug) }}"   @if(count($data->subs) > 0 )  class="sf-with-ul" @endif>
                                        <img src="{{ asset('assets/images/categories/'.$data->photo) }}" style="width:28px; height:30px;" >
                                        &nbsp;    
                               
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

                                                  </li>
                                             
                                             @endforeach
                                             @endif
                                                  </ul>
                                       
                                       
                                </div><!-- End .side-menu-body -->
                            </div><!-- End .side-custom-menu -->
                        </div><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .home-top-container -->

            <div class="info-boxes-container">
                <div class="container">
                     @foreach($chunk as $service)
                    <div class="info-box">
                       <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">

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
                                          @endif</p>
                                        </div><!-- End .info-box-content -->
                                    </div><!-- End .info-box -->
                                    @endforeach
                                </div><!-- End .container -->
                              </div><!-- End .info-boxes-container -->

            <div class="banners-group">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="banner banner-image">
                                <a href="{{$fix_banners[0]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$fix_banners[0]->photo)}}"  style="width:100%; height:287px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                            @if(!empty($fix_banners[1]))
                            <div class="banner banner-image">
                                <a href="{{$fix_banners[1]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$fix_banners[1]->photo)}}" style="width:100%; height:324px;" alt="banner">
                            </div><!-- End .banner -->
                            @endif
                            @if(!empty($fix_banners[2]))
                            <div class="banner banner-image">
                                <a href="{{$fix_banners[2]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$fix_banners[2]->photo)}}" style="width:100%; height:230px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                            @endif
                        </div><!-- End .col-lg-3 -->

                        <div class="col-lg-3 col-sm-6 order-lg-last">
                            <div class="banner banner-image">
                                <a href="@if(!empty($fix_banners[3]->link)) {{$fix_banners[3]->link}} @endif">
                                    <img src="@if(!empty($fix_banners[6]->link)) {{asset('assets/images/banners/'.$fix_banners[6]->photo)}} @endif" style="width:100%; height:204px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->

                            <div class="banner banner-image">
                                <a href="@if(!empty($fix_banners[4]->link)) {{$fix_banners[4]->link}}" @endif>
                                    <img src="@if(!empty($fix_banners[7]->link)) {{asset('assets/images/banners/'.$fix_banners[7]->photo)}} @endif" style="width:100%; height:449px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->

                            <div class="banner banner-image">
                                <a href="@if(!empty($fix_banners[5]->link)) {{$fix_banners[5]->link}} @endif">
                                    <img src="@if(!empty($fix_banners[8]->link)){{asset('assets/images/banners/'.$fix_banners[8]->photo)}} @endif" style="width:100%; height:188px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-lg-3 -->        

                        <div class="col-lg-6">
                            <div class="banner banner-image">
                                <a href="@if(!empty($fix_banners[6]->link)) {{$fix_banners[6]->link}} @endif">
                                    <img src="@if(!empty($fix_banners[3]->link)) {{asset('assets/images/banners/'.$fix_banners[3]->photo)}} @endif" style="width:100%; height:350px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->

                            <div class="banner banner-image">
                                <a href="@if(!empty($fix_banners[7]->link)) {{$fix_banners[7]->link}} @endif">
                                    <img src="@if(!empty($fix_banners[4]->link)) {{asset('assets/images/banners/'.$fix_banners[4]->photo)}} @endif" style="width:100%; height:214px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->

                            <div class="banner banner-image">
                                <a href="@if(!empty($fix_banners[8]->link)) {{$fix_banners[8]->link}} @endif">
                                    <img src="@if(!empty($fix_banners[5]->link)) {{asset('assets/images/banners/'.$fix_banners[5]->photo)}} @endif" style="width:100%; height:280px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-lg-6 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .banners-group -->

            <div class="mb-4"></div>
         @if($ps->featured == 1)
            <section class="featured-section">
                <div class="container">
                    <h2 class="carousel-title">	{{ $langg->lang26 }}</h2>
                    <div class="product-intro owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 20,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                       
                      
                       
                      @foreach($feature_products as $prod)
                        <div class="product-default">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"
                                    
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
                                                               @endif
                                    
                                    >
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
                                   <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                                    
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
                                          <span class="product-price">{{ $prod->showPrice() }}</span></span>
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
                                      <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{ $langg->lang56 }}</button>
                                    @endif
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                    
                    </div>
                </div>
            </section>
              
              @endif
               @if($ps->best == 1)
            <section class="featured-section">
                <div class="container">
                    <h2 class="carousel-title">	{{ $langg->lang27 }}</h2>
                    <div class="product-intro owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 20,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                       
                      
                       
                      @foreach($best_products as $prod)
                        <div class="product-default">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"
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
                                                               @endif
                                    
                                    >
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
                                   <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                                  
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
                                          <span class="product-price">{{ $prod->showPrice() }}</span></span>
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
                                      <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{ $langg->lang56 }}</button>
                                    @endif                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                    
                    </div>
                </div>
            </section>
              
              @endif
             @if($ps->top_rated == 1)
            <section class="featured-section">
                <div class="container">
                    <h2 class="carousel-title">{{ $langg->lang28 }}</h2>
                    <div class="product-intro owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 20,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                       
                      
                       
                      @foreach($top_products as $prod)
                        <div class="product-default">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"
                                    
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
                                                               @endif
                                    >
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
                                   <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                                  
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
                                          <span class="product-price">{{ $prod->showPrice() }}</span></span>
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
                                      <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{ $langg->lang56 }}</button>
                                    @endif
                                    
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                    
                    </div>
                </div>
            </section>
              
              @endif
             @if($ps->big == 1)
            <section class="featured-section">
                <div class="container">
                    <h2 class="carousel-title">	{{ $langg->lang29 }}</h2>
                    <div class="product-intro owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 20,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                       
                      
                       
                      @foreach($big_products as  $prod)
                        <div class="product-default">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:245px;"
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
                                                               @endif
                                    
                                    >
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
                                   <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                                  
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
                                          <span class="product-price">{{ $prod->showPrice() }}</span></span>
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
                                      <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{ $langg->lang56 }}</button>
                                    @endif
                                    
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
              
              @endif
        </main>

   