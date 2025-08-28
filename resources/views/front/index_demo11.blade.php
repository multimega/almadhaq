

@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<style>
    .owl-carousel .owl-nav.disabled{
        display:block;
    }
</style>
        <main class="main">
            <div class="container">
                <div class="home-slider-container">
                    <div class="home-slider owl-carousel owl-theme owl-theme-light">
                        @if($ps->slider == 1)
            				   @if(count($sliders))
            					@foreach($sliders as $data)
                        <div class="home-slide">
                            <div class="slide-bg owl-lazy" data-src="{{('assets/images/sliders/'.$data->photo)}}"></div><!-- End .slide-bg -->
                            <div class="home-slide-content">
                                <div class="slide-title">
                                    <h3>@if(!$slang)
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
                                          @endif</h3>
                                    <h1>@if(!$slang)
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
                                          </h1>
                                </div><!-- End .slide-title -->
                                <!--<div class="slide-price">40<span class="slide-price-desc"><strong>%</strong>OFF</span></div>-->
                                <!--<div class="slide-price">40<span class="slide-price-desc"><strong>%</strong>OFF</span></div><!-- End .slide-price -->-->
                                <a href="{{$data->link}}" class="btn btn-dark">{{ $langg->lang25 }}</a>
                            </div><!-- End .home-slide-content -->
                        </div><!-- End .home-slide -->
                        @endforeach
                        @endif
                        @endif
                    </div><!-- End .home-slider -->
                </div><!-- End .home-slider-container -->
            </div><!-- End .container -->

            <div class="container">
                <div class="row">
                    @foreach($categories->where('is_featured','=',1) as $cat)
                    <div class="col-md-4">
                        <h3 class="subtitle">
                            @if(!$slang)
                              @if($lang->id == 2)
                              {{ $cat->name_ar }}
                              @else 
                              {{ $cat->name }}
                              @endif 
                               
                              @else  
                              @if($slang == 2) 
                              {{ $cat->name_ar }}
                              @else
                              {{ $cat->name }}
                             @endif
                            @endif
                        </h3>
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{asset('assets/images/categories/'.$cat->photo) }}" alt="banner">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .col-md-4 -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-3"></div><!-- margin -->

@if($ps->featured ==1)
            <div class="container">
                <h2 class="subtitle text-center">{{ $langg->lang26}}</h2>
                <div class="top-selling-products owl-carousel owl-theme">
                    @foreach($feature_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            <a data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal" class="paction add-cart" title="Add to Cart">
                                <span>{{$langg->lang56}}</span>
                            </a>
                        </figure>
                        <div class="product-details product-price-inner">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-proucts -->
            </div><!-- End .container -->
@endif
            <div class="mb-5"></div><!-- margin -->

         
@if($ps->best ==1)
            <div class="container">
                <h2 class="subtitle text-center">{{ $langg->lang27}}</h2>
                <div class="top-selling-products owl-carousel owl-theme">
                    @foreach($best_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            
                            
                           
                            
                             @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a data-href="{{ route('product.cart.add',$prod->id) }}"   class="paction add-cart  btn-add-cart add-to-cart" title ="{{$langg->lang56}}">
                                        <span>{{$langg->lang56}}</span>
                                    </a>
                                    @endif
                        </figure>
                        <div class="product-details product-price-inner">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-proucts -->
            </div><!-- End .container -->
@endif
            <div class="mb-5"></div><!-- margin -->

@if($ps->top_rated ==1)
            <div class="container">
                <h2 class="subtitle text-center">{{ $langg->lang28}}</h2>
                <div class="top-selling-products owl-carousel owl-theme">
                    @foreach($top_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a data-href="{{ route('product.cart.add',$prod->id) }}"   class="paction add-cart  btn-add-cart add-to-cart" title ="{{$langg->lang56}}">
                                        <span>{{$langg->lang56}}</span>
                                    </a>
                                    @endif
                        </figure>
                        <div class="product-details product-price-inner">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-proucts -->
            </div><!-- End .container -->
@endif
            <div class="mb-5"></div><!-- margin -->


@if($ps->big ==1)
            <div class="container">
                <h2 class="subtitle text-center">{{ $langg->lang29}}</h2>
                <div class="top-selling-products owl-carousel owl-theme">
                    @foreach($big_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a data-href="{{ route('product.cart.add',$prod->id) }}"   class="paction add-cart  btn-add-cart add-to-cart" title ="{{$langg->lang56}}">
                                        <span>{{$langg->lang56}}</span>
                                    </a>
                                    @endif
                        </figure>
                        <div class="product-details product-price-inner">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-proucts -->
            </div><!-- End .container -->
@endif
            <div class="mb-5"></div><!-- margin -->



@if($ps->hot_sale ==1)
            <div class="container">
                <h2 class="subtitle text-center">{{ $langg->lang31}}</h2>
                <div class="top-selling-products owl-carousel owl-theme">
                    @foreach($latest_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                           @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a data-href="{{ route('product.cart.add',$prod->id) }}"   class="paction add-cart  btn-add-cart add-to-cart" title ="{{$langg->lang56}}">
                                        <span>{{$langg->lang56}}</span>
                                    </a>
                                    @endif
                        </figure>
                        <div class="product-details product-price-inner">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-proucts -->
            </div><!-- End .container -->
@endif
            <div class="mb-5"></div><!-- margin -->


@if($ps->hot_sale ==1)
            <div class="container">
                <h2 class="subtitle text-center">{{ $langg->lang32}}</h2>
                <div class="top-selling-products owl-carousel owl-theme">
                    @foreach($trending_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                           @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a data-href="{{ route('product.cart.add',$prod->id) }}"   class="paction add-cart  btn-add-cart add-to-cart" title ="{{$langg->lang56}}">
                                        <span>{{$langg->lang56}}</span>
                                    </a>
                                    @endif
                        </figure>
                        <div class="product-details product-price-inner">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-proucts -->
            </div><!-- End .container -->
@endif
            <div class="mb-5"></div><!-- margin -->


@if($ps->hot_sale ==1)
            <div class="container">
                <h2 class="subtitle text-center">{{ $langg->lang33}}</h2>
                <div class="top-selling-products owl-carousel owl-theme">
                    @foreach($hot_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a data-href="{{ route('product.cart.add',$prod->id) }}"   class="paction add-cart  btn-add-cart add-to-cart" title ="{{$langg->lang56}}">
                                        <span>{{$langg->lang56}}</span>
                                    </a>
                                    @endif
                        </figure>
                        <div class="product-details product-price-inner">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-proucts -->
            </div><!-- End .container -->
@endif
            <div class="mb-5"></div><!-- margin -->


@if($ps->flash_deal ==1)
            <div class="container">
                <h2 class="subtitle text-center">{{ $langg->lang244}}</h2>
                <div class="top-selling-products owl-carousel owl-theme">
                    @foreach($discount_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                             @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a data-href="{{ route('product.cart.add',$prod->id) }}"   class="paction add-cart  btn-add-cart add-to-cart" title ="{{$langg->lang56}}">
                                        <span>{{$langg->lang56}}</span>
                                    </a>
                                    @endif
                        </figure>
                        <div class="product-details product-price-inner">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-proucts -->
            </div><!-- End .container -->
@endif
            <div class="mb-5"></div><!-- margin -->

            <div class="partners-container">
                <div class="container">
                    @if($ps->partners == 1)
                    <div class="partners-carousel owl-carousel owl-theme">
                        @foreach($partners as $j)
                        <a href="#" class="partner">
                            <img src="{{asset('assets/images/partner/'.$j->photo)}}" style="width:100%; height:50px;" alt="logo">
                        </a>
                        @endforeach
                    </div><!-- End .partners-carousel -->
                    @endif<!-- End .partners-carousel -->
                </div><!-- End .container -->
            </div><!-- End .partners-container -->
        </main><!-- End .main -->

        