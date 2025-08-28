
@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<style>
    .cat-banner img{
        height: 300px;
        filter: unset;
    }
</style>
        <main class="main">
            <div class="home-slider-container">
                <div class="home-slider owl-carousel owl-theme owl-theme-light">
                    @if($ps->slider == 1)
            				   @if(count($sliders))
            					@foreach($sliders as $data)
            	<a href="{{$data->link}}">
                    <div class="home-slide">
                        <div class="slide-bg owl-lazy" data-src="{{('assets/images/sliders/'.$data->photo)}}"></div><!-- End .slide-bg -->
                        <div class="container">
                            <div class="home-slide-content ">
                                <h3 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}"> @if(!$slang)
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
                                    </h3>
                                    <h1 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}">
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
                                    </h1>
                                <!--<h2><span>70%</span> off</h2>-->
                                <!--<a href="{{$data->link}}" class="btn btn-primary">{{ $langg->lang25 }}</a>-->
                                <!--@if(!empty($data->first_side_photo))-->
                                <!--<img src="{{asset('assets/images/sliders/'.$data->first_side_photo)}}" class="slide-item-img slide-img-1" alt="item" width="123" height="153">-->
                                <!--@endif-->
                                
                                <!--@if(!empty($data->second_side_photo))-->
                                <!--<img src="{{asset('assets/images/sliders/'.$data->second_side_photo)}}" class="slide-item-img slide-img-2" alt="item" width="144" height="241">-->
                                <!--@endif-->
                            
                            </div><!-- End .home-slide-content -->
                        </div><!-- End .container -->
                    </div><!-- End .home-slide -->
                    </a>
                    @endforeach
                        @endif
                        @endif
                </div><!-- End .home-slider -->
            </div><!-- End .home-slider-container -->

            @if($ps->featured == 1)
            <div class="container product-wrapper">
                <div class="row category-grid">
                    
                            @foreach($feature_products as $prod)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid-product">
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
                            </a>
                                @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                            </figure>
                           
                            
                                @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                     </a>
                                    @endif
                                 
                            
                            
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">
                                                    @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{$prod->category->name}}
                                                      @else 
                                                      {{$prod->category->name_ar}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{$prod->category->name_ar}}
                                                      @else
                                                      {{$prod->category->name}}
                                                      @endif
                                                  @endif
                                                </a>
                                            </div>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish">
                                            </a>
                                            @endif
                                        </div>
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
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div><!-- End .col-xl-3 -->
                    @endforeach
                    
                </div><!-- End .row -->
            </div><!-- End .product-wrapper -->
            @endif
            <div class="container my-5">
                <div class="banners-slider owl-carousel owl-theme owl-loaded">
                    @foreach($fix_banners as $banner)
					<div class="cat-banner appear-animate my-5" style="background:#eb7033" data-animation-name="fadeInRightShorter">
						<figure>
							<img src="{{('assets/images/banners/'.$banner->photo)}}" alt="brand" width="140" height="60">
						</figure>

						<div class="cat-content d-inline-block position-relative">	
						<h3 class="text-uppercase d-inline-block mb-0 ls-n-20 pr-1 pt-2">@if(!$slang)
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
							<h5 class="text-uppercase rotated-upto-text mb-0">
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
							</h5>

						<!--	<hr class="divider-short-thick">-->

						
							<a href="{{$banner->link}}" class="btn btn-xl btn-icon-right" role="button">{{ $langg->lang25 }} <i class="fas fa-long-arrow-alt-right"></i></a>
						</div><!-- End .cat-content -->
					</div><!-- End .cat-banner -->
					@endforeach
                </div>
            </div>

            <div class="container newsletter-sec text-md-left text-center py-4 px-5 my-4">
                <div class="row align-items-center">
                    <div class="col-md-6  my-2">
                        <i class="far fa-envelope"></i>
                        <div class="widget widget-newsletter widget-newsletter-f">
                            <h4 class="widget-title">{{$langg->newsletter}}</h4>
                            <p>{{$gs->popup_text}}</p>
                        </div>
                    </div>
                    <div class="col-md-6 px-md-0 px-5 my-2">
                        <div class="widget widget-newsletter">
                            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                                <input type="email" class="form-control" placeholder="{{ $langg->lang741 }}" required>

                                <input type="submit" class="btn" value="@if(!$slang)
                                       @if($lang->id == 2)
                                            ابدأ  
                                          @else 
                                           Sign Up
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            ابدأ 
                                          @else
                                           Sign Up
                                          @endif
                               @endif">
                            </form>
                        </div>
                    </div><!-- End .widget -->
                </div>
            </div>

            @if($ps->best == 1)
            <div class="container product-wrapper">
                <div class="row category-grid">
                    
                            @foreach($best_products as $prod)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid-product">
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
                            </a>
                                @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                            </figure>
                            @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                     </a>
                                    @endif
                            
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">
                                                    @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{$prod->category->name}}
                                                      @else 
                                                      {{$prod->category->name_ar}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{$prod->category->name_ar}}
                                                      @else
                                                      {{$prod->category->name}}
                                                      @endif
                                                  @endif
                                                </a>
                                            </div>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish">
                                            </a>
                                            @endif
                                        </div>
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
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div><!-- End .col-xl-3 -->
                    @endforeach
                    
                </div><!-- End .row -->
            </div><!-- End .product-wrapper -->
            @endif
            
            
            @if($ps->top_rated == 1)
            <div class="container product-wrapper">
                <div class="row category-grid">
                    
                    @foreach($top_products as $prod)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid-product">
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
                            </a>
                                @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                            </figure>
                            @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                     </a>
                                    @endif
                            
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">
                                                    @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{$prod->category->name}}
                                                      @else 
                                                      {{$prod->category->name_ar}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{$prod->category->name_ar}}
                                                      @else
                                                      {{$prod->category->name}}
                                                      @endif
                                                  @endif
                                                </a>
                                            </div>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish">
                                            </a>
                                            @endif
                                        </div>
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
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div><!-- End .col-xl-3 -->
                    @endforeach
                    
                </div><!-- End .row -->
            </div><!-- End .product-wrapper -->
            @endif
            @if($ps->big == 1)
            <div class="container product-wrapper">
                <div class="row category-grid">
                    
                    @foreach($big_products as $prod)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid-product">
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
                            </a>
                                @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                            </figure>
                            @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                     </a>
                                    @endif
                            
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">
                                                    @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{$prod->category->name}}
                                                      @else 
                                                      {{$prod->category->name_ar}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{$prod->category->name_ar}}
                                                      @else
                                                      {{$prod->category->name}}
                                                      @endif
                                                  @endif
                                                </a>
                                            </div>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish">
                                            </a>
                                            @endif
                                        </div>
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
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div><!-- End .col-xl-3 -->
                    @endforeach
                    
                </div><!-- End .row -->
            </div><!-- End .product-wrapper -->
            @endif
            
            @if($ps->hot_sale == 1)
            <div class="container product-wrapper">
                <div class="row category-grid">
                    
                    @foreach($hot_products as $prod)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid-product">
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
                            </a>
                                @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                            </figure>
                             @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                     </a>
                                    @endif
                            
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">
                                                    @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{$prod->category->name}}
                                                      @else 
                                                      {{$prod->category->name_ar}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{$prod->category->name_ar}}
                                                      @else
                                                      {{$prod->category->name}}
                                                      @endif
                                                  @endif
                                                </a>
                                            </div>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish">
                                            </a>
                                            @endif
                                        </div>
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
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div><!-- End .col-xl-3 -->
                    @endforeach
                    
                </div><!-- End .row -->
            </div><!-- End .product-wrapper -->
            @endif
            
            @if($ps->hot_sale == 1)
            <div class="container product-wrapper">
                <div class="row category-grid">
                    
                    @foreach($trending_products as $prod)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid-product">
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
                            </a>
                                @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                            </figure>
                             @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                   <a  onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                     </a>
                                    @endif
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">
                                                    @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{$prod->category->name}}
                                                      @else 
                                                      {{$prod->category->name_ar}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{$prod->category->name_ar}}
                                                      @else
                                                      {{$prod->category->name}}
                                                      @endif
                                                  @endif
                                                </a>
                                            </div>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish">
                                            </a>
                                            @endif
                                        </div>
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
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div><!-- End .col-xl-3 -->
                    @endforeach
                    
                </div><!-- End .row -->
            </div><!-- End .product-wrapper -->
            @endif
            @if($ps->flash_deal == 1)
            <div class="container product-wrapper">
                <div class="row category-grid">
                    
                    @foreach($discount_products as $prod)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid-product">
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
                            </a>
                                @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                            </figure>
                             @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <a  onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                     </a>
                                    @endif
                            
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">
                                                    @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{$prod->category->name}}
                                                      @else 
                                                      {{$prod->category->name_ar}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{$prod->category->name_ar}}
                                                      @else
                                                      {{$prod->category->name}}
                                                      @endif
                                                  @endif
                                                </a>
                                            </div>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish">
                                            </a>
                                            @endif
                                        </div>
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
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div><!-- End .col-xl-3 -->
                    @endforeach
                    
                </div><!-- End .row -->
            </div><!-- End .product-wrapper -->
            @endif
            
            @if($ps->hot_sale == 1)
            <div class="container product-wrapper">
                <div class="row category-grid">
                    
                    @foreach($trending_products as $prod)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid-product">
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
                            </a>
                                @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                            </figure>
                              @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else     
                                   <a  onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                     </a>
                                    @endif
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">
                                                    @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{$prod->category->name}}
                                                      @else 
                                                      {{$prod->category->name_ar}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{$prod->category->name_ar}}
                                                      @else
                                                      {{$prod->category->name}}
                                                      @endif
                                                  @endif
                                                </a>
                                            </div>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish">
                                            </a>
                                            @endif
                                        </div>
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
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div><!-- End .col-xl-3 -->
                    @endforeach
                    
                </div><!-- End .row -->
            </div><!-- End .product-wrapper -->
            @endif
            <div class="container shop-by-cat-sec text-center py-4 px-5 my-5">
                <h2 class="mb-3">Shop By Category</h2>
                <div class="row align-items-center">
                    @foreach($categories as $category)
                    <div class="col-md-4 cat-div mb-3">
                        <a href="{{ route('front.category', ['category' => $category->slug , 'lang' => $sign]) }}" class="text-white">
                            @if(!$slang)
                              @if($lang->id == 2)
                              {{ $category->name_ar }}
                              @else 
                              {{ $category->name }}
                              @endif 
                          @else  
                              @if($slang == 2) 
                              {{ $category->name_ar }}
                              @else
                              {{ $category->name }}
                              @endif
                          @endif
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="subtitle">
                            <span>{{$langg->lang43}}</span>
                        </h2>

                        <div class="blog-slider owl-carousel owl-theme owl-loaded">
                            @foreach(DB::table('blogs')->orderby('id','desc')->take(2)->get() as $blogg)
                            <article class="entry">
                                <div class="entry-media">
                                    <a href="#">
                                        <img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" alt="@if(!$slang)
                                      @if($lang->id == 2)
                                       
                                      alt="{{$blogg->alt_ar}}"        
                                      @else 
                                       alt="{{$blogg->alt}}"    
                                      @endif 
                                      @else  
                                      @if($slang == 2) 
                                          alt="{{$blogg->alt_ar}}"    
                                      @else
                                           alt="{{$blogg->alt}}"    
                                      @endif
                           @endif">
                                    </a>
                                    <div class="entry-date">{{date('d', strtotime($blogg->created_at))}}<span>{{date('m', strtotime($blogg->created_at))}}</span></div><!-- End .entry-date -->
                                </div><!-- End .entry-media -->
    
                                <div class="entry-body">
                                    <h3 class="entry-title">
                                        <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign ])}}">
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
                                    </a>
                                    </h3>
                                    <div class="entry-content">
                                        <p>@if(!$slang)
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
                                                  @endif  </p>

                                    <a class="btn" href="{{route('front.blogshow',['id' => $blogg->id , 'lang'=> $sign ])}}">{{ $langg->lang38 }}</a>
                                    </div><!-- End .entry-content -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                            @endforeach
                            
                        </div><!-- End .blog-carousel -->
                    </div><!-- End .col-lg-6 -->

                    <div class="col-lg-6">
                        <h2 class="subtitle">
                            <span>{{$langg->lang956}}</span>
                        </h2>

                        <div class="testimonial-slider owl-carousel owl-theme owl-loaded">
                            @foreach($reviews as $review)
                             <div class="testimonial">
                                <div class="testimonial-owner">
                                    <figure>
                                        <img src="{{asset('assets/images/reviews/'.$review->photo)}}" alt="client">
                                    </figure>

                                    <div>
                                        <h4 class="testimonial-title">
                                            
                                             @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{  $review->title_ar }}
                                                      @else 
                                                        {{  $review->title }}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                        {{  $review->title_ar }}
                                                      @else
                                                       {{  $review->title }}
                                                      @endif
                                                  @endif 
                                        </h4>
                                        <span> @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{  $review->subtitle_ar }}
                                                      @else 
                                                        {{  $review->subtitle }}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                        {{  $review->subtitle_ar }}
                                                      @else
                                                       {{  $review->subtitle }}
                                                      @endif
                                                  @endif </span>
                                    </div>
                                </div><!-- End .testimonial-owner -->

                                <blockquote>
                                    <p>@if(!$slang)
                                                      @if($lang->id == 2)
                                                     {{strip_tags($review->details_ar)}}
                                                      @else 
                                                      {{strip_tags($review->details)}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{strip_tags($review->details_ar)}}
                                                      @else
                                                      {{strip_tags($review->details)}}
                                                      @endif
                                                  @endif</p>
                                </blockquote>
                            </div><!-- End .testimonial -->
                             @endforeach
                           
                        </div><!-- End .testimonials-slider -->
                    </div><!-- End .col-lg-6 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
            
            
            @if($ps->partners == 1)
           
                        @foreach($partners as $j) <div class="partners-container">
                <div class="container">
                    
                    <div class="partners-carousel owl-carousel owl-theme">
                        <a href="#" class="partner">
                            <img src="{{asset('assets/images/partner/'.$j->photo)}}" style="width:100%; height:50px;" alt="logo">
                        </a>  </div><!-- End .partners-carousel -->
                    
                </div><!-- End .container -->
            </div>
                        @endforeach
                  
            @endif
    <hr class="divider-short-thick">
        </main><!-- End .main -->

        