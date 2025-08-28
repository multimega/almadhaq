
@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<style>
.carousel-item img{
    width:100%;
    height:100%;
}
#carouselExampleIndicators{
    height:97%;
}
.carousel-inner,
.carousel-item{
    height:100%;
}
    @media screen and (max-width: 767px){
        .header-search .header-search-wrapper {
            width: 320px;
            left: unset;
            right: -80px
        }
        .header-search .header-search-wrapper::before {
            left: auto;
            right: 78px;
        }
        .carousel-caption{
            bottom:-5px !important;
        }
    }
    .flash-deal p{
        text-align: center;
        padding: 5px;
        background: #65829d;
        color: #fff;
    }
    .product .product-title{
        height:40px;
        overflow: hidden;
    }
    .owl-carousel .owl-nav.disabled, .owl-carousel .owl-dots.disabled {
        display: block;
    }
</style>
        <main class="main">
            <div class="home-top-container">
                <div class="container">
                    <div class="row">
                        @if(count($sliders))
                        <div class="col-lg-5">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    
    			            		@foreach($sliders as $data)
                                    <div class="carousel-item" id="active-slider">
                                            <img src="{{('assets/images/sliders/'.$data->photo)}}" alt="...">
                                            <div class="carousel-caption d-block">
                                            <h5>@if(!$slang)
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
                                              @endif</h5>
                                            <p>@if(!$slang)
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
                                          @endif</p>
                                          <a class="btn btn-secondary" href="{{$data->link}}">{{ $langg->lang25 }}</a>
                                      </div>
                                    </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div><!-- End .col-lg-5 -->
                        @endif
                        <div class="col-lg-7 top-banners">
                            <div class="row">
                                
                              
                                <div class="col-sm-6">
                                      @if(!empty($fix_banners[0]))
                                    <div class="banner banner-image">
                                        <a href="{{$fix_banners[0]->link}}">
                                            <img src="{{asset('assets/images/banners/'.$fix_banners[0]->photo)}}" alt="banner">
                                        </a>
                                    </div><!-- End .banner -->
                                    @endif
                                   @if(!empty($fix_banners[1]))
                                    <div class="banner banner-image">
                                        <a href="{{$fix_banners[1]->link}}">
                                            <img src="{{asset('assets/images/banners/'.$fix_banners[1]->photo)}}" alt="banner">
                                        </a>
                                    </div><!-- End .banner -->
                                    @endif

                                </div><!-- End .col-sm-6 -->
                                
                                
                                <div class="col-sm-6">
                                     @if(!empty($fix_banners[2]))
                                    <div class="banner banner-image">
                                        <a href="{{$fix_banners[2]->link}}">
                                            <img src="{{asset('assets/images/banners/'.$fix_banners[2]->photo)}}" alt="banner">
                                        </a>
                                    </div><!-- End .banner -->
                                    @endif

                                </div><!-- End .col-sm-6 -->
                                
                                
                                
                            </div><!-- End .row -->
                        </div><!-- End .col-lg-7 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .home-top-container -->

            @if($ps->featured ==1)
            <div class="container">
                <h2 class="subtitle">
                    <span>{{ $langg->lang26}}</span>
                </h2>

                <div class="featured-products owl-carousel owl-theme owl-nav-top">
                    @foreach($feature_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product', $prod->slug) }}" class="product-image">
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
                            </a>
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">
                               {{$langg->lang55}}
                            </a>
                            @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
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
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->

                            <div class="product-action">
                                
                               @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                
                                 @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart"  data-toggle="modal" data-target="#addCartModal" title="{{ $langg->lang56 }}">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>                        
                                    @endif
                                   

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="{{ $langg->lang909 }}">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-products -->
            </div><!-- End .container -->
            @endif
            <div class="mb-5"></div><!-- margin -->
            
            @if($ps->best ==1)
            <div class="container">
                <h2 class="subtitle">
                    <span>{{ $langg->lang27}}</span>
                </h2>

                <div class="featured-products owl-carousel owl-theme owl-nav-top">
                    @foreach($best_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
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
                        <div class="product-details">
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

                            <div class="product-action">
                                @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="{{ $langg->lang56 }}">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>                        
                                    @endif
                                   

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="{{ $langg->lang909 }}">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-products -->
            </div><!-- End .container -->
            @endif
            <div class="mb-5"></div><!-- margin -->
            
            @if($ps->hot_sale ==1)
            <div class="container">
                <h2 class="subtitle">
                    <span>{{ $langg->lang33}}</span>
                </h2>

                <div class="featured-products owl-carousel owl-theme owl-nav-top">
                    @foreach($sale_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
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
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->

                            <div class="product-action">
                               @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="{{ $langg->lang56 }}">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>                        
                                    @endif
                                   

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="{{ $langg->lang909 }}">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-products -->
            </div><!-- End .container -->
            @endif
            <div class="mb-5"></div><!-- margin -->
            
            @if($ps->top_rated ==1)
            <div class="container">
                <h2 class="subtitle">
                    <span>{{ $langg->lang28}}</span>
                </h2>

                <div class="featured-products owl-carousel owl-theme owl-nav-top">
                    @foreach($top_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
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
                        <div class="product-details">
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

                            <div class="product-action">
                               @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="{{ $langg->lang56 }}">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>                        
                                    @endif
                                   
                                   

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="{{ $langg->lang909 }}">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-products -->
            </div><!-- End .container -->
            @endif
            <div class="mb-5"></div><!-- margin -->
            
            @if($ps->hot_sale ==1)
            <div class="container">
                <h2 class="subtitle">
                    <span>{{ $langg->lang32}}</span>
                </h2>

                <div class="featured-products owl-carousel owl-theme owl-nav-top">
                    @foreach($trending_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
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
                        <div class="product-details">
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

                            <div class="product-action">
                               @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                    @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="{{ $langg->lang56 }}">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>                        
                                    @endif
                                   

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="{{ $langg->lang909 }}">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-products -->
            </div><!-- End .container -->
            @endif
            <div class="mb-5"></div><!-- margin -->
            
            @if($ps->big ==1)
            <div class="container">
                <h2 class="subtitle">
                    <span>{{ $langg->lang29}}</span>
                </h2>

                <div class="featured-products owl-carousel owl-theme owl-nav-top">
                    @foreach($big_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
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
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->

                            <div class="product-action">
                               @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                     @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="{{ $langg->lang56 }}">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>                        
                                    @endif
                                   

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="{{ $langg->lang909 }}">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-products -->
            </div><!-- End .container -->
            @endif
            <div class="mb-5"></div><!-- margin -->
            
            @if($ps->hot_sale ==1)
            <div class="container">
                <h2 class="subtitle">
                    <span>{{ $langg->lang30}}</span>
                </h2>

                <div class="featured-products owl-carousel owl-theme owl-nav-top">
                    @foreach($hot_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
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
                        <div class="product-details">
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

                            <div class="product-action">
                                @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="{{ $langg->lang56 }}">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>                        
                                    @endif
                                   

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="{{ $langg->lang909 }}">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-products -->
            </div><!-- End .container -->
            @endif
            <div class="mb-5"></div><!-- margin -->
            @if($ps->flash_deal ==1)
            <div class="container">
                <h2 class="subtitle">
                    <span>{{ $langg->lang244}}</span>
                </h2>

                <div class="featured-products owl-carousel owl-theme owl-nav-top">
                    @foreach($discount_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
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
                        <div class="product-details">
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
                            <div class='flash-deal'>
                            <p>     {{$langg->lang949}}  <?php 

                        $now = time(); // or your date as well
                        $your_date = strtotime("$prod->discount_date");
                        $datediff =  $your_date- $now;
                         
                        
                        if($langg->rtl == "1") {
                        echo '   ' . round($datediff / (60 * 60 * 24)).'     ايام  ' ;
                        }else {
                            echo '   ' . round($datediff / (60 * 60 * 24)).'     Days  ' ;
                        }
                        
                          ?>     </p>
                        </div>
                            <div class="product-action">
                                @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="{{ $langg->lang56 }}">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>                        
                                    @endif
                                   

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="{{ $langg->lang909 }}">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-products -->
            </div><!-- End .container -->
            @endif
            <div class="mb-5"></div><!-- margin -->
            
              @if($ps->featured_category   ==1 )
            <div class="banners-section">
                <div class="container">
                    <h2 class="subtitle text-center"><span>{{$langg->lang955}}</span></h2>
                    <div class="cats-carousel owl-carousel owl-theme">
                        @foreach($categories->where('is_featured','=',1) as $cat)
                        <div class="banner banner-image">
                            <a href="{{ route('front.category', ['category' => $cat->slug , 'lang' => $sign]) }}">
                                <img src="{{asset('assets/images/categories/'.$cat->photo) }}">
                            </a>
                        </div><!-- End .banner -->
                        @endforeach
                        
                    </div><!-- End .cat-carousel -->
                </div><!-- End .container -->
            </div><!-- End .banners-section -->
            
            <div class="mb-5"></div><!-- margin -->
            @endif
            
            
            @if($ps->hot_sale ==1)
            <div class="container arrived-products">
                <h2 class="subtitle">
                    <span>{{ $langg->lang31}}</span>
                </h2>

                <div class="row">
                    @foreach($latest_products as $prod)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product product-overlay">
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
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">
                                    
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
                                   @endif</a>
                                   @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif

                                <div class="product-action">

                                  @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif

                                     @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a  onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="{{ $langg->lang56 }}">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>                        
                                    @endif
                                   

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="{{ $langg->lang909 }}">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <h2 class="product-title">
                                    <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                    </div><!-- End .col-xl-2 -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .container -->
            @endif
            <div class="mb-5"></div><!-- margin -->

  @if($ps->review_blog  ==1 )
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="subtitle">
                            <span>{{$langg->lang43}}</span>
                        </h2>
                        
                        <div class="blog-slider owl-carousel owl-theme">
                            @foreach(DB::table('blogs')->orderby('id','desc')->take(2)->get() as $blogg)
                        <article class="entry">
                            <div class="entry-media">
                                <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign ])}}">
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
                                <div class="entry-date">{{date('d', strtotime($blogg->created_at))}}<span>{{date('m', strtotime($blogg->created_at))}}</span></div>
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
                        <!--<article class="entry">-->
                        <!--    <div class="entry-media">-->
                        <!--        <a href="#">-->
                        <!--            <img src="{{ asset('assets/demo_7/assets/images/demo7/5^2.jpg') }}" alt="Post">-->
                        <!--        </a>-->
                        <!--        <div class="entry-date">30 <span>Now</span></div><!-- End .entry-date -->
                        <!--    </div><!-- End .entry-media -->

                        <!--    <div class="entry-body">-->
                        <!--        <h3 class="entry-title">-->
                        <!--            <a href="#">Fashion Trends</a>-->
                        <!--        </h3>-->
                        <!--        <div class="entry-content">-->
                        <!--            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has...</p>-->

                        <!--            <a href="#" class="btn">Read More</a>-->
                        <!--        </div><!-- End .entry-content -->
                        <!--    </div><!-- End .entry-body -->
                        <!--</article><!-- End .entry -->

                        <!--<article class="entry">-->
                        <!--    <div class="entry-media">-->
                        <!--        <a href="#">-->
                        <!--            <img src="{{ asset('assets/demo_7/assets/images/demo7/5^3.jpg') }}" alt="Post">-->
                        <!--        </a>-->
                        <!--        <div class="entry-date">28 <span>Now</span></div><!-- End .entry-date -->
                        <!--    </div><!-- End .entry-media -->

                        <!--    <div class="entry-body">-->
                        <!--        <h3 class="entry-title">-->
                        <!--            <a href="#">Women Fashion</a>-->
                        <!--        </h3>-->
                        <!--        <div class="entry-content">-->
                        <!--            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has...</p>-->

                        <!--            <a href="#" class="btn">Read More</a>-->
                        <!--        </div><!-- End .entry-content -->
                        <!--    </div><!-- End .entry-body -->
                        <!--</article><!-- End .entry -->
                    </div><!-- End .blog-carousel -->
                    </div><!-- End .col-lg-6 -->

                 
                
                    <div class="col-lg-6">
                        <h2 class="subtitle">
                            <span>{{$langg->lang956}}</span>
                        </h2>

                        <div class="testimonials-slider owl-carousel owl-theme">
                          
                              @foreach($reviews as $review)
                             <div class="testimonial">
                                <div class="testimonial-owner">
                                    <figure>
                                        <img src="{{ asset('assets/demo_7/assets/images/demo7/6.jpg') }}" alt="client">
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
            
    @endif
            @if($ps->partners == 1)
            <div class="partners-container">
                <div class="container">
                    <h2 class="subtitle"><span>{{ $langg->lang826 }}</span></h2>
                    <div class="partners-carousel owl-carousel owl-theme">
                        @foreach($partners as $j)
                        <a class="partner">
                    <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo" style="height:45px">
                    </a>
                    @endforeach
                    </div><!-- End .partners-carousel -->
                </div><!-- End .container -->
            </div><!-- End .partners-container -->
            @endif
        </main><!-- End .main -->
