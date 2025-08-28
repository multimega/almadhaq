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
.owl-carousel-lazy.owl-carousel.owl-loaded .home-slide {
    background-repeat: no-repeat;
    background-size: cover;
}
.add-to-wish{
    border:0
}
.tab-pane .inner-icon figure .btn-icon-group{
    right: 0;
}
.tab-pane .btn-icon-group button{
    padding: 0;
}
.tab-pane .cart-out-of-stock{
    font-size: 9px;
}
</style>
        <main class="main home">
            <div class="home-top-container">
                <div class="home-slider owl-carousel owl-theme owl-carousel-lazy">
                    @foreach($sliders as $data)
                    <div class="home-slide" style="background-image: url('assets/images/sliders/{{$data->photo}}');">
                        <img class="owl-lazy" src="assets/images/lazy.png" alt="slider image">
                        <div class="home-slide-content container">
                            <div>
                                <h2 class="home-slide-subtitle">
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
                                </h2>
                                <h1 class="home-slide-title">
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
                                <!--<h2 class="home-slide-foot">from <span>$499</span></h2>-->
                                <button class="btn btn-dark btn-buy"><a href="{{$data->link}}">{{ $langg->lang25 }}</a></button>
                            </div>
                        </div><!-- End .home-slide-content -->
                    </div><!-- End .home-slide -->
                    @endforeach
                </div>
                <div class="home-slider-sidebar">
                    <ul>
                        @foreach($sliders as $data)
                        <li id="active-slider">
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
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div><!-- End .home-slider -->
            
            @if($ps->featured ==1)
            <section class="product-panel mt-5">
                <div class="container">
                    <div class="section-title">
                        <h2>{{ $langg->lang26}}</h2>
                    </div>
                    <div class="product-intro divide-line mt-2 mb-8">
                        @foreach($feature_products as $prod)
                        <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                      @endif</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <!--<span class="tooltiptext tooltip-top">0</span>-->
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
            </section>
            @endif
            @if($ps->top_rated ==1)
            <section class="product-panel mt-5">
                <div class="container">
                    <div class="section-title">
                        <h2>{{ $langg->lang28}}</h2>
                    </div>
                    <div class="product-intro divide-line mt-2 mb-8">
                        @foreach($top_products as $prod)
                        <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
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
                                      @endif</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <!--<span class="tooltiptext tooltip-top">0</span>-->
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
            </section>
            @endif
            @if($ps->big ==1)
            <section class="product-panel mt-5">
                <div class="container">
                    <div class="section-title">
                        <h2>{{ $langg->lang29}}</h2>
                    </div>
                    <div class="product-intro divide-line mt-2 mb-8">
                        @foreach($big_products as $prod)
                        <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                      @endif</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <!--<span class="tooltiptext tooltip-top">0</span>-->
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
            </section>
            @endif
            @if($ps->best ==1)
            <section class="product-panel mt-5">
                <div class="container">
                    <div class="section-title">
                        <h2>{{ $langg->lang27}}</h2>
                    </div>
                    <div class="product-intro divide-line mt-2 mb-8">
                        @foreach($best_products as $prod)
                        <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                      @endif</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <!--<span class="tooltiptext tooltip-top">0</span>-->
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
            </section>
            @endif
            @if($ps->hot_sale ==1)
            <section class="product-panel mt-5">
                <div class="container">
                    <div class="section-title">
                        <h2>{{ $langg->lang33}}</h2>
                    </div>
                    <div class="product-intro divide-line mt-2 mb-8">
                        @foreach($sale_products as $prod)
                        <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
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
                                      @endif</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <!--<span class="tooltiptext tooltip-top">0</span>-->
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
            </section>
            @endif
            @if($ps->hot_sale ==1)
            <section class="product-panel mt-5">
                <div class="container">
                    <div class="section-title">
                        <h2>{{ $langg->lang32}}</h2>
                    </div>
                    <div class="product-intro divide-line mt-2 mb-8">
                        @foreach($trending_products as $prod)
                        <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="#" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                      @endif</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <!--<span class="tooltiptext tooltip-top">0</span>-->
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
            </section>
            @endif
            @if($ps->hot_sale ==1)
            <section class="product-panel mt-5">
                <div class="container">
                    <div class="section-title">
                        <h2>{{ $langg->lang30}}</h2>
                    </div>
                    <div class="product-intro divide-line mt-2 mb-8">
                        @foreach($hot_products as $prod)
                        <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                      @endif</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <!--<span class="tooltiptext tooltip-top">0</span>-->
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
            </section>
            @endif
            @if($ps->flash_deal ==1)
            <section class="product-panel mt-5">
                <div class="container">
                    <div class="section-title">
                        <h2>{{ $langg->lang244}}</h2>
                    </div>
                    <div class="product-intro divide-line mt-2 mb-8">
                        @foreach($discount_products as $prod)
                        <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                      @endif</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <!--<span class="tooltiptext tooltip-top">0</span>-->
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
            </section>
            @endif
            <!--<section class="categories-container">-->
            <!--    <div class="container categories-carousel owl-carousel owl-theme" data-toggle="owl" data-owl-options="{-->
            <!--        'loop' : false,-->
            <!--        'margin': 30,-->
            <!--        'nav': false,-->
            <!--        'dots': true,-->
            <!--        'autoHeight': true,-->
            <!--        'responsive': {-->
            <!--          '0': {-->
            <!--            'items': 2,-->
            <!--            'margin': 0-->
            <!--          },-->
            <!--          '576': {-->
            <!--            'items': 3-->
            <!--          },-->
            <!--          '768': {-->
            <!--            'items': 4-->
            <!--          },-->
            <!--          '992': {-->
            <!--            'items': 5-->
            <!--          },-->
            <!--          '1200': {-->
            <!--            'items': 6-->
            <!--          }-->
            <!--        }-->
            <!--    }">-->
            <!--        <div class="category">-->
            <!--            <i class="icon-category-fashion"></i>-->
            <!--            <span>Fashion</span>-->
            <!--        </div>-->
            <!--        <div class="category">-->
            <!--            <i class="icon-category-electronics"></i>-->
            <!--            <span>Electronics</span>-->
            <!--        </div>-->
            <!--        <div class="category">-->
            <!--            <i class="icon-gift"></i>-->
            <!--            <span>Gift</span>-->
            <!--        </div>-->
            <!--        <div class="category">-->
            <!--            <i class="icon-category-garden"></i>-->
            <!--            <span>Garden</span>-->
            <!--        </div>-->
            <!--        <div class="category">-->
            <!--            <i class="icon-category-music"></i>-->
            <!--            <span>Music</span>-->
            <!--        </div>-->
            <!--        <div class="category">-->
            <!--            <i class="icon-category-motors"></i>-->
            <!--            <span>Motors</span>-->
            <!--        </div>-->
            <!--    </div><!-- End .categories-carousel -->-->
            <!--</section><!-- End .categories-container -->-->

            
            <section class="home-products-intro mt-3 mb-1">
                <div class="container">
                    <div class="row row-sm">
                        @if(!empty($fix_banners[0]))
                        <div class="col-xl-6">
                            <div class="banner-product bg-grey" style="background-image: url('assets/images/banners/{{$fix_banners[0]->photo}}');background-position : 54%;">
                                <h2>{!!$fix_banners[0]->title!!}</h2>
                                <div class="mr-5">
                                    <h4>{!!$fix_banners[0]->subtitle!!}</h4>
                                    <button class="btn btn-primary"><a href="{{$fix_banners[0]->link}}">{{ $langg->lang25 }}</a></button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(!empty($fix_banners[1]))
                        <div class="col-xl-6">
                            <div class="banner-product bg-grey" style="background-image: url('assets/images/banners/{{$fix_banners[1]->photo}}');background-position : 54%;">
                                <h2>{!!$fix_banners[1]->title!!}</h2>
                                <div class="mr-5">
                                    <h4>{!!$fix_banners[1]->subtitle!!}</h4>
                                    <button class="btn btn-primary"><a href="{{$fix_banners[1]->link}}">{{ $langg->lang25 }}</a></button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>

            @if($ps->hot_sale ==1)
            <section class="product-panel mt-5">
                <div class="container">
                    <div class="section-title">
                        <h2>{{ $langg->lang31}}</h2>
                    </div>
                    <div class="product-intro divide-line mt-2 mb-8">
                        @foreach($latest_products as $prod)
                        <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
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
                                      @endif</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <!--<span class="tooltiptext tooltip-top">0</span>-->
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
            </section>
            @endif

            <section class="home-products-intro bg-grey" id="specialOffer" style="padding: 4.5rem 0 2rem;">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="section-title">
                                <h2>Special Offer</h2>
                            </div>
                            <div class="banner-product mt-3" style="background-image: url('assets/images/products/product-special.jpg');">
                                <div class="banner-content">
                                    <h2>Elec Deals</h2>
                                    <h4><span class="old-price">$59.00</span><span class="price">$49.00</span></h4>
                                    <button class="btn btn-primary">SHOP NOW</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="home-product-tabs">
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    @foreach($categorys as $data)
                                    <li class="nav-item">
                                        <a class="nav-link" id="{{ $data->name }}-tab" data-toggle="tab" href="{{ route('front.category', ['category' => $data->slug , 'lang' => $sign]) }}" role="tab" aria-controls="{{ $data->name }}" aria-selected="true">
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
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show" id="fashion" role="tabpanel" aria-labelledby="fashion-tab">
                                        <div class="row row-sm">
                                            @foreach($latest_products as $prod)
                                            <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                                                <figure>
                                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                                                </figure>
                                                <div class="product-details">
                                                    <div class="category-wrap">
                                                        <div class="category-list">
                                                            <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                                        </div>
                                                        @if(Auth::guard('web')->check())
                                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                                            <span>{{ $langg->lang54 }}</span>
                                                        </a>
                                                        @endif
                                                    </div>
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
                                                          @endif</a>
                                                    </h2>
                                                    <div class="ratings-container">
                                                        <div class="product-ratings">
                                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                                            <!--<span class="tooltiptext tooltip-top">0</span>-->
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    <div class="price-box">
                                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                                    </div><!-- End .price-box -->
                                                </div><!-- End .product-details -->
                                            </div>
                                            @endforeach
                                            
                                        </div><!-- End .row -->
                                    </div><!-- End .tab-pane -->
                                    
                                    <div class="tab-pane fade" id="Mobiles" role="tabpanel" aria-labelledby="Mobiles-tab">
                                        <div class="row row-sm">
                                            @foreach($latest_products as $prod)
                                            <div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
                                                <figure>
                                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    
                                </div>
                                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                                                </figure>
                                                <div class="product-details">
                                                    <div class="category-wrap">
                                                        <div class="category-list">
                                                            <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                                        </div>
                                                        @if(Auth::guard('web')->check())
                                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                                            <span>{{ $langg->lang54 }}</span>
                                                        </a>
                                                        @endif
                                                    </div>
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
                                                          @endif</a>
                                                    </h2>
                                                    <div class="ratings-container">
                                                        <div class="product-ratings">
                                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                                            <!--<span class="tooltiptext tooltip-top">0</span>-->
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    <div class="price-box">
                                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                                    </div><!-- End .price-box -->
                                                </div><!-- End .product-details -->
                                            </div>
                                            @endforeach
                                            
                                        </div><!-- End .row -->
                                    </div><!-- End .tab-pane -->
                                    
                                </div><!-- End .tab-content -->
                            </div><!-- End .home-product-tabs -->
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-3 mb-3">
                <div class="container">
                    <div class="owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{
                        'loop' : false,
                        'nav': false,
                        'dots': true,
                        'margin': 20,
                        'autoHeight': true,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                          '0': {
                            'items': 2
                          },
                          '570': {
                            'items': 2
                          },
                          '830': {
                            'items': 3
                          },
                          '1220': {
                            'items': 4
                          }
                        }
                    }">
                        @foreach($categories->where('is_featured','=',1) as $cat)
                        <div class="home-product-list">
                            <img src="{{asset('assets/images/categories/'.$cat->photo) }}">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="{{ route('front.category', ['category' => $cat->slug , 'lang' => $sign]) }}">
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
                                        </a>
                                </h4>
                                <button  class="btn btn-dark"><a href="{{ route('front.category', ['category' => $cat->slug , 'lang' => $sign]) }}">{{ $langg->lang25 }}</a></button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="bg-grey">
                <div class="container">
                    <div class="row">
                        @foreach($chunk as $service )
                        
                        <div class="col-md-3">
                            <div class="info-box">
                                <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">

                                <div class="info-box-content">
                                    <!--<h4 class="info-title">ONLINE SUPPORT</h4>-->
                                    <h4 class="info-subtitle">@if(!$slang) 
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
                        </div>
                        @endforeach
                    </div>
                </div><!-- End .container -->
            </section><!-- End .info-boxes-container -->

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
                        
                        @foreach($flash_deal_product as $prod)
                        <div class="col-sm-6 col-xl-3">
                            <div class="product-default inner-quickview inner-icon center-details count-down">
                                <h2 class="product-name">{{ $langg->lang244}}</h2>
                                <figure>
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                        <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h2 class="product-title">
                                        <a href="{{ route('front.product', ['slug' => $latest_products[0]->slug , 'lang' => $sign] ) }}">
                                            @if(!$slang)
                                          @if($lang->id == 2)
                                         {!! $latest_products[0]->showName_ar() !!}
                                          @else 
                                          
                                        {{ $latest_products[0]->showName() }}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!! $latest_products[0]->showName_ar() !!}
                                          @else
                                          {{ $latest_products[0]->showName() }}
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
                                <div class="count-down-panel">
                                    <h4>OFFER ENDS IN:
                                        <span class="countdown" data-plugin-countdown data-plugin-options="{'date': '2020/06/10 12:00:00', 'numberClass': 'font-weight-extra-bold'}"></span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @if($ps->partners == 1)
            <section class="container mt-3 mb-7" id="topBrands">
                <div class="section-title mb-5">
                    <h4>Partners</h4>
                </div>
                <div class="partners-carousel owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{
                    'loop' : true,
                    'nav': false,
                    'dots': true,
                    'autoHeight': true,
                    'autoplay': true,
                    'autoplayTimeout': 5000,
                    'responsive': {
                      '0': {
                        'items': 2,
                        'margin': 0
                      },
                      '480': {
                        'items': 3
                      },
                      '768': {
                        'items': 4
                      },
                      '992': {
                        'items': 5
                      }
                    }
                }">
                    
                        @foreach($partners as $j)
                        <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo" style="width:160px;height:60px">
                        @endforeach
                        
                </div>
            </section>
            @endif
        </main><!-- End .main -->

        