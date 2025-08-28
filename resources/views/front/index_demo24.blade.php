@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

$flash_deal_product= App\Models\Product::get()->take(1);

@endphp
<style>
    .home-slider{
        height:560px;
        overflow:hidden;
    }
    .home-slider .slide-details{
        margin-top:15px;
    }
</style>
<main class="home main">
            <section class="svg-container svg-bottom">
                <div class="home-slider owl-carousel owl-carousel-lazy owl-theme">
                    @foreach($sliders as $data)
                    <div class="home-slide" class="owl-lazy">
                        <img class="owl-lazy" src="{{asset('assets/demo_24/assets/images/lazy.png')}}" data-src="" alt="slider image">
                        <img src="assets/images/sliders/{{$data->photo}}">
                        <div class="home-slide-content">
                            <div class="container">
                                <!--<a href="#" class="slide-image"><img src="assets/images/products/product-1.jpg"></a>-->
                                <div class="slide-details">
                                    <a href="#" class="product-title">
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
                                    </a>
                                    <div class="product-details">
                                        <div class="sales-panel">
                                            <div class="sales-info">
                                                <span>
                                                    @if(!$slang)
                                                    @if($lang->id == 2)
                                                         {{$data->subtitle_text}}
                                                    @else 
                                                          {{$data->subtitle_text}}
                                                    @endif 
                                                @else  
                                                    @if($slang == 2) 
                                                        {{$data->subtitle_text}}
                                                    @else
                                                        {{$data->subtitle_text}}
                                                    @endif
                                              @endif
                                                </span>
                                            </div>
                                        </div>
                                        <a href="{{$data->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach                    
                </div>
            </section>

            <section class="container mb-1">
                <div class="row row-sm">
                    @foreach($chunk as $service )
                    <div class="col-lg-3">
                        <div class="service-widget">
                            <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">
                            <h3 class="service-title">
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
                            <!--<button>learn more</button>-->
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            
            <section class="bg-grey svg-container svg-top pb-3">
                <img src="assets/demo_24/assets/images/banners/home-shape1.png" class="image-right">
                <img src="assets/demo_24/assets/images/banners/home-shape2.png" class="image-left">
                <div class="container">
                    @if($ps->featured ==1)
                    <div class="featured-items product-panel">
                        <h2 class="section-title">{{ $langg->lang26}}</h2>
                        <div class="featured-products owl-carousel owl-theme owl-dots-top" data-toggle="owl" data-owl-options="{
                            'loop': false,
                            'margin': 20,
                            'autoplay': false,
                            'responsive': {
                              '0': {
                                'items': 2
                              },
                              '992': {
                                'items': 3
                              }
                            }
                        }">
                            @foreach($feature_products as $prod)
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                <div class="label-group">
                                    @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                </div>
                                <div class="btn-icon-group">
                                    @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if($ps->top_rated ==1)
                    <div class="featured-items product-panel">
                        <h2 class="section-title">{{ $langg->lang28}}</h2>
                        <div class="featured-products owl-carousel owl-theme owl-dots-top" data-toggle="owl" data-owl-options="{
                            'loop': false,
                            'margin': 20,
                            'autoplay': false,
                            'responsive': {
                              '0': {
                                'items': 2
                              },
                              '992': {
                                'items': 3
                              }
                            }
                        }">
                            @foreach($top_products as $prod)
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                <div class="label-group">
                                    @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                </div>
                                <div class="btn-icon-group">
  @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if($ps->best ==1)
                    <div class="featured-items product-panel">
                        <h2 class="section-title">{{ $langg->lang27}}</h2>
                        <div class="featured-products owl-carousel owl-theme owl-dots-top" data-toggle="owl" data-owl-options="{
                            'loop': false,
                            'margin': 20,
                            'autoplay': false,
                            'responsive': {
                              '0': {
                                'items': 2
                              },
                              '992': {
                                'items': 3
                              }
                            }
                        }">
                            @foreach($best_products as $prod)
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                <div class="label-group">
                                    @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                </div>
                                <div class="btn-icon-group">
  @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if($ps->big ==1)
                    <div class="featured-items product-panel">
                        <h2 class="section-title">{{ $langg->lang29}}</h2>
                        <div class="featured-products owl-carousel owl-theme owl-dots-top" data-toggle="owl" data-owl-options="{
                            'loop': false,
                            'margin': 20,
                            'autoplay': false,
                            'responsive': {
                              '0': {
                                'items': 2
                              },
                              '992': {
                                'items': 3
                              }
                            }
                        }">
                            @foreach($big_products as $prod)
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                <div class="label-group">
                                    @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                </div>
                                <div class="btn-icon-group">
  @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if(!empty($fix_banners[0]))
                    <div class="banner-box" style="background-image: url('assets/images/banners/{{$fix_banners[0]->photo}}');">
                        <div class="banner-content">
                            <div class="banner-info">
                                <h3>{!! $fix_banners[0]->title !!}</h3>
                                <p>{!! $fix_banners[0]->subtitle !!}</p>
                            </div>
                            <a href="{{$fix_banners[0]->link}}"><button>{{ $langg->lang25 }}<i class="icon-angle-right"></i></button></a>
                        </div>
                    </div>
                    @endif
                    @if($ps->hot_sale ==1)
                    <div class="featured-items product-panel">
                        <h2 class="section-title">{{ $langg->lang33}}</h2>
                        <div class="featured-products owl-carousel owl-theme owl-dots-top" data-toggle="owl" data-owl-options="{
                            'loop': false,
                            'margin': 20,
                            'autoplay': false,
                            'responsive': {
                              '0': {
                                'items': 2
                              },
                              '992': {
                                'items': 3
                              }
                            }
                        }">
                            @foreach($sale_products as $prod)
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                <div class="label-group">
                                    @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                </div>
                                <div class="btn-icon-group">
  @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if($ps->hot_sale ==1)
                    <div class="featured-items product-panel">
                        <h2 class="section-title">{{ $langg->lang32}}</h2>
                        <div class="featured-products owl-carousel owl-theme owl-dots-top" data-toggle="owl" data-owl-options="{
                            'loop': false,
                            'margin': 20,
                            'autoplay': false,
                            'responsive': {
                              '0': {
                                'items': 2
                              },
                              '992': {
                                'items': 3
                              }
                            }
                        }">
                            @foreach($trending_products as $prod)
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                <div class="label-group">
                                    @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                </div>
                                <div class="btn-icon-group">
  @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if($ps->hot_sale ==1)
                    <div class="featured-items product-panel">
                        <h2 class="section-title">{{ $langg->lang30}}</h2>
                        <div class="featured-products owl-carousel owl-theme owl-dots-top" data-toggle="owl" data-owl-options="{
                            'loop': false,
                            'margin': 20,
                            'autoplay': false,
                            'responsive': {
                              '0': {
                                'items': 2
                              },
                              '992': {
                                'items': 3
                              }
                            }
                        }">
                            @foreach($hot_products as $prod)
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                <div class="label-group">
                                    @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                </div>
                                <div class="btn-icon-group">
  @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if($ps->hot_sale ==1)
                    <div class="featured-items product-panel">
                        <h2 class="section-title">{{ $langg->lang31}}</h2>
                        <div class="featured-products owl-carousel owl-theme owl-dots-top" data-toggle="owl" data-owl-options="{
                            'loop': false,
                            'margin': 20,
                            'autoplay': false,
                            'responsive': {
                              '0': {
                                'items': 2
                              },
                              '992': {
                                'items': 3
                              }
                            }
                        }">
                            @foreach($latest_products as $prod)
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                <div class="label-group">
                                    @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                </div>
                                <div class="btn-icon-group">
  @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if($ps->flash_deal ==1)
                    <div class="featured-items product-panel">
                        <h2 class="section-title">{{ $langg->lang244}}</h2>
                        <div class="featured-products owl-carousel owl-theme owl-dots-top" data-toggle="owl" data-owl-options="{
                            'loop': false,
                            'margin': 20,
                            'autoplay': false,
                            'responsive': {
                              '0': {
                                'items': 2
                              },
                              '992': {
                                'items': 3
                              }
                            }
                        }">
                            @foreach($discount_products as $prod)
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                <div class="label-group">
                                    @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                </div>
                                <div class="btn-icon-group">
  @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </section>
            
            <section class="container mb-2" style="position : relative;">
                <div class="product-panel">
                    <h2 class="section-title">{{ $langg->lang27}}</h2>
                    <div class="row row-sm">
                        @foreach($best_products as $prod)
                        <div class="col-6 col-md-4">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                <div class="label-group">
                                    @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                </div>
                                <div class="btn-icon-group">
  @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                            </div>
                            </div>
                            @endforeach
                        
                    </div>
                    <button class="btn-view-more">{{$langg->lang952}}</button>
                </div>
                @if($ps->partners == 1)
                <div class="partners-panel">
                    <h3 class="cross-txt">As Featured At</h3>
                    <div class="partners-carousel owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{
                        'loop' : true,
                        'nav' : false,
                        'dots': true,
                        'margin' : 0,
                        'autoHeight': true,
                        'autoplay': true,
                        'autoplayTimeout': 3000,
                        'responsive': {
                          '0': {
                            'items': 2
                          },
                          '480': {
                            'items' : 3
                          },
                          '768': {
                            'items': 5
                          },
                          '1200': {
                            'items': 7
                          }
                        }
                    }">
                        @foreach($partners as $j)
                        <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo" style="width:160px;height:60px">
                        @endforeach
                    </div>
                </div>
                @endif
            </section>

            <section class="bg-grey mb-0">
                <div class="container">
                    <div class="row row-sm" style="padding: 7rem 0 5rem;">
                        <div class="col-lg-6">
                            <div class="testimonials-slider owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                                'items': 1,
                                'dots': true,
                                'autoplay' : false
                            }">
                                <div class="testimonial">
                                    <div class="testimonial-owner">
                                        <figure>
                                            <img src="assets/images/clients/client1.png" alt="client">
                                        </figure>

                                        <div>
                                            <h4 class="testimonial-title">john Smith</h4>
                                            <span>CEO & Founder</span>
                                        </div>
                                    </div><!-- End .testimonial-owner -->

                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie, massa ut semper egestas, ex ligula ifend neque, eget pharetra elit lectus ac ex.risus.</p>
                                    </blockquote>
                                </div><!-- End .testimonial -->
                                <div class="testimonial">
                                    <div class="testimonial-owner">
                                        <figure>
                                            <img src="assets/images/clients/client1.png" alt="client">
                                        </figure>

                                        <div>
                                            <h4 class="testimonial-title">john Smith</h4>
                                            <span>CEO & Founder</span>
                                        </div>
                                    </div><!-- End .testimonial-owner -->

                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie, massa ut semper egestas, ex ligula ifend neque, eget pharetra elit lectus ac ex.risus.</p>
                                    </blockquote>
                                </div><!-- End .testimonial -->
                                <div class="testimonial">
                                    <div class="testimonial-owner">
                                        <figure>
                                            <img src="assets/images/clients/client1.png" alt="client">
                                        </figure>

                                        <div>
                                            <h4 class="testimonial-title">john Smith</h4>
                                            <span>CEO & Founder</span>
                                        </div>
                                    </div><!-- End .testimonial-owner -->

                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie, massa ut semper egestas, ex ligula ifend neque, eget pharetra elit lectus ac ex.risus.</p>
                                    </blockquote>
                                </div><!-- End .testimonial -->
                            </div><!-- End .testimonials-slider -->
                        </div>
                        <div class="col-lg-6">
                          <div class="widget news-widget">
                            <h3 class="widget-title">{{$langg->lang43}}</h3>
                            <div class="widget-content row row-sm">
                                <?php $i=0; ?>
                                @foreach(DB::table('blogs')->orderby('id','desc')->take(2)->get() as $blogg)
                                @if($i<2)
                                <?php $i++ ?>
                                <div class="col-sm-6 subwidget">
                                    <span class="subwidget-date">{{date('d', strtotime($blogg->created_at))}} {{date('m', strtotime($blogg->created_at))}}
                                    </span>
                                    <h4 class="subwidget-title">
                                        @if(!$slang)
                                              @if($lang->id == 2)
                                              {{strlen($blogg->title_ar) > 50 ? substr($blogg->title_ar,0,50)."...":$blogg->title_ar}}
                                              @else 
                                              {{strlen($blogg->title) > 50 ? substr($blogg->title,0,50)."...":$blogg->title}}
                                              @endif 
                                          @else  
                                              @if($slang == 2) 
                                              {{strlen($blogg->title_ar) > 50 ? substr($blogg->title_ar,0,50)."...":$blogg->title_ar}}
                                              @else
                                              {{strlen($blogg->title) > 50 ? substr($blogg->title,0,50)."...":$blogg->title}}
                                              @endif
                                          @endif
                                    </h4>
                                    <p>
                                        @if(!$slang)
                                              @if($lang->id == 2)
                                             {{substr(strip_tags($blogg->details_ar),0,120)}}
                                              @else 
                                              {{substr(strip_tags($blogg->details),0,120)}}
                                              @endif 
                                          @else  
                                              @if($slang == 2) 
                                              {{substr(strip_tags($blogg->details_ar),0,120)}}
                                              @else
                                              {{substr(strip_tags($blogg->details),0,120)}}
                                              @endif
                                          @endif
                                    </p>
                                    <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign ])}}">{{ $langg->lang38 }}<i class="icon-right-open"></i></a>
                                </div>
                                @endif
                                @endforeach
                            </div>
                          </div>  
                        </div>
                    </div>
                </div>
            </section>
        </main><!-- End .main -->