


@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp

<style>
    .partners-container .owl-carousel .owl-nav.disabled{
        display: block;
    }
</style>
        <main class="main">
            <div class="container">
                <div class="home-slider owl-carousel owl-carousel-lazy owl-theme">
                    @if($ps->slider == 1)
    				   @if(count($sliders))
    					@foreach($sliders as $data)
                    <div class="home-slide">
                        <a href="#"><img class="owl-lazy" src="assets/images/lazy.png" data-src="{{('assets/images/sliders/'.$data->photo)}}" alt="slider image"></a>
                    </div><!-- End .home-slide -->
                        @endforeach
                        @endif
                        @endif
                </div><!-- End .home-slider -->
            </div><!-- End .container -->

            <div class="info-boxes-container my-4">
                <div class="container">
                    <div class="row" style="width: 100%">
                        @foreach($chunk as $service )
                        <div class="col-lg-3 col-md-6">
                           <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">
                            <div class="info-icon-container">
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
                            </div>
                        </div><!-- End .info-box -->
                        @endforeach
                    </div>
                </div><!-- End .container -->
            </div><!-- End .info-boxes-container -->

            <div class="container home-container">
                <div class="row">
                    <div class="col-lg-9">
                        @if($ps->featured ==1)
                        <h2 class="subtitle">{{ $langg->lang26}}</h2>
                        <div class="row row-sm">
                            @foreach($feature_products as $prod)
                            <div class="col-6 col-md-4 col-xl-3">
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
                                        
                                        
                                      
                                        
                                   @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}" class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        </a>
                                    @endif
                                        
                                        
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
                                    </figure>
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
                        @endif
                        
                    </div><!-- End .col-lg-9 -->
                    
                    
                    <aside class="sidebar-home col-lg-3 order-lg-first">
                        <div class="widget widget-cats">
                            <h3 class="widget-title"><i class="icon-menu"></i>{{ $langg->lang961 }}</h3>

                            <ul class="catAccordion">
                                <?php $i=0 ?>
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('front.category', ['category' => $category->slug , 'lang' => $sign]) }}">
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
                                    
                                    @if(count($category->subs) > 0)
                                    <?php $i++; ?>
                                        <button class="accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#accordion-ul-<?php echo $i; ?>" aria-expanded="false" aria-controls="accordion-ul-1"></button>

                                        <ul class="collapse" id="accordion-ul-<?php echo $i; ?>">
                                            @foreach($category->subs as $subcat)
                                            <li><a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug ,'lang' => $sign])}}">
                                                @if(!$slang)
                                                    @if($lang->id == 2)
                                                  {{$subcat->name_ar}}
                                                  @else 
                                                  {{$subcat->name}}
                                                  @endif 
                                                   @else
                                                  @if($slang == 2) 
                                                  {{$subcat->name_ar}}
                                                  @else
                                                  {{$subcat->name}}
                                                  @endif
                                                  @endif

                                            </a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                                @endforeach
                                
                            </ul>
                        </div><!-- End .widget -->
                        
                        <div class="widget widget-features">
                            <div class="row">
                                @foreach($chunk as $service )
                                <div class="col-12 col-sm-6 col-lg-12">
                                    <div class="feature-box">
                                        <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px; margin:auto">

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
                                    </div><!-- End .feature-box -->
                                </div><!-- End .col-sm-6 -->
                                @endforeach
                                
                            </div><!-- End .row -->
                        </div><!-- End .widget -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
                <div class="container my-3">
                    <div class="row">
                    @foreach($fix_banners as $banner)
                        <div class="col-md-4 home-banners">
                            <img src="{{('assets/images/banners/'.$banner->photo)}}" alt="banner" class="">
                            <div class="banner-layer banner-layer-middle banner-layer-left">
                                <h5 class=" m-b-3 font3">
                                @if(!$slang)
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
                                </h5>
                                <h4 class="mb-3 text-uppercase text-white">
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
                                </h4>
                                <a href="{{$banner->link}}"><button class="btn">
                                    @if(!$slang)
                                   @if($lang->id == 2)
                                        {!!$banner->btn_ar!!}  
                                      @else 
                                       {!!$banner->button!!}  
                                      @endif 
                                       @else  
                                      @if($slang == 2) 
                                        {!!$banner->btn_ar!!}  
                                      @else
                                       {!!$banner->button!!}  
                                      @endif
                                    @endif 
                                </button></a>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                @if($ps->best ==1)
                        <h2 class="subtitle">{{ $langg->lang27}}</h2>
                        <div class="row row-sm">
                            @foreach($best_products as $prod)
                            <div class="col-lg-2 col-md-4 col-6">
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
                                         @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        </a>
                                    @endif
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
                                    </figure>
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
                        @endif
                        @if($ps->top_rated ==1)
                        <h2 class="subtitle">{{ $langg->lang28}}</h2>
                        <div class="row row-sm">
                            @foreach($top_products as $prod)
                            <div class="col-lg-2 col-md-4 col-6">
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
                                         @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        </a>
                                    @endif
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
                                    </figure>
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
                        @endif
                        @if($ps->big ==1)
                        <h2 class="subtitle">{{ $langg->lang29}}</h2>
                        <div class="row row-sm">
                            @foreach($big_products as $prod)
                            <div class="col-lg-2 col-md-4 col-6">
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
                                         @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        </a>
                                    @endif
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
                                    </figure>
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
                        @endif
                        
                        @if($ps->hot_sale ==1)
                        <h2 class="subtitle">{{ $langg->lang32}}</h2>
                        <div class="row row-sm">
                            @foreach($trending_products as $prod)
                            <div class="col-lg-2 col-md-4 col-6">
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
                                         @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        </a>
                                    @endif
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
                                    </figure>
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
                        @endif
                        @if($ps->hot_sale ==1)
                        <h2 class="subtitle">{{ $langg->lang33}}</h2>
                        <div class="row row-sm">
                            @foreach($hot_products as $prod)
                            <div class="col-lg-2 col-md-4 col-6">
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
                                         @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        </a>
                                    @endif
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
                                    </figure>
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
                        @endif
                        @if($ps->flash_deal ==1)
                        <h2 class="subtitle">{{ $langg->lang244}}</h2>
                        <div class="row row-sm">
                            @foreach($discount_products as $prod)
                            <div class="col-lg-2 col-md-4 col-6">
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
                                        @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        </a>
                                    @endif
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
                                    </figure>
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
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->

           <!--                             <div class="product-action">-->
           <!--                                    @if(Auth::guard('web')->check())-->
									  <!--<a   data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">-->
           <!--                             <span>{{ $langg->lang54 }}</span>-->
           <!--                             </a>-->
           <!--                             @endif-->


           <!--                         <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">-->
           <!--                             <span>{{ $langg->lang909 }}</span>-->
           <!--                         </a>-->
           <!--                             </div>-->
                                        <!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                            </div><!-- End .col-xl-3 -->
                            @endforeach
                        </div><!-- End .row -->
                        @endif
            </div><!-- End .container -->


            @if($ps->hot_sale ==1)
            <div class="container">
                <h2 class="subtitle subtitle-line mb-5"><span>{{ $langg->lang31}}</span></h2>

                <div class="new-arrivals-products owl-carousel owl-theme owl-nav-bottom">
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
                              @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        </a>
                                    @endif
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
                    @endforeach
                </div><!-- End .new-arrivals-products -->
            </div><!-- End .container -->
            @endif
            @if(!empty($fix_banners[0]))
            <section class="home-banner">
                <div class="container">
                    <div class="banner">
                        <img src="{{('assets/images/banners/'.$fix_banners[0]->photo)}}" height="380" alt="banner" class="">
                        <div class="banner-layer banner-layer-middle banner-layer-left">
                            <h5 class=" m-b-3 font3">
                                @if(!$slang)
                                      @if($lang->id == 2)
                                    {!!$fix_banners[0]->title_ar!!}
                                      @else 
                                      {!!$fix_banners[0]->title!!}
                                      @endif 
                                  @else  
                                      @if($slang == 2) 
                                      {!!$fix_banners[0]->title_ar!!}
                                      @else
                                      {!!$fix_banners[0]->title!!}
                                      @endif
                                  @endif
                            </h5>
                            <h4 class="mb-3 text-uppercase text-white">
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
                            </h4>
                            <a href="{{$fix_banners[0]->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                        </div>
                    </div>
                </div>
            </section>
            @endif
            <div class="container newsletter-sec">
                <div class="row align-items-center">
                    <div class="col-md-6 text-md-right text-center my-2">
                        <div class="widget widget-newsletter">
                            <h4 class="widget-title">{{$langg->newsletter}}</h4>
                            <p>{{$gs->popup_text}}</p>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-left text-center px-md-0 px-5 my-2">
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
            @if($ps->partners == 1)
            <div class="partners-container">
                <div class="container">
                    <h2 class="subtitle subtitle-line mb-6"><span>Partners</span></h2>
                    <div class="partners-carousel owl-carousel owl-theme">
                        @foreach($partners as $j)
                        <a href="#" class="partner">
                            <img src="{{asset('assets/images/partner/'.$j->photo)}}" style="width:100%; height:50px;" alt="logo">
                        </a>
                        @endforeach
                    </div><!-- End .partners-carousel -->
                </div><!-- End .container -->
            </div><!-- End .partners-container -->
            @endif</div><!-- End .container -->

            <div class="mb-5 mb-md-6 mb-lg-7"></div><!-- margin -->
        </main><!-- End .main -->

        