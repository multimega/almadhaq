
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
    .footer-top, .footer-middle {
        background-color: transparent;
    }
    footer{
        padding: 20px;
    }

.category-card {
    box-shadow: 0 4px 14px rgba(0,0,0,0.07);
    transition: transform 0.15s;
}
.category-card:hover {
    transform: translateY(-4px) scale(1.03);
    box-shadow: 0 6px 24px rgba(0,0,0,0.14);
}
.category-overlay {
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
}


</style>
<main class="main">
            <div class="container">
                <div class="info-boxes-slider row">
						<div class="col-md-4 info-box info-box-icon-left">
							<i class="icon-shipping font-35 pt-1"></i>

							<div class="info-box-content pt-1">
								<h4>FREE SHIPPING &amp; RETURN</h4>
								<p class="text-body">Free shipping on all orders over $99</p>
							</div><!-- End .info-box-content -->
						</div><!-- End .info-box -->

						<div class="col-md-4 info-box info-box-icon-left">
							<i class="icon-money pt-1"></i>

							<div class="info-box-content">
								<h4>MONEY BACK GUARANTEE</h4>
								<p class="text-body">100% money back guarantee</p>
							</div><!-- End .info-box-content -->
						</div><!-- End .info-box -->

						<div class="col-md-4 info-box info-box-icon-left">
							<i class="icon-support pt-1"></i>

							<div class="info-box-content">
								<h4>ONLINE SUPPORT 24/7</h4>
								<p class="text-body">Lorem ipsum dolor sit amet.</p>
							</div><!-- End .info-box-content -->
						</div><!-- End .info-box -->
					</div><!-- End .info-boxes-slider -->

                <div class="home-slider-container">
                    <div class="home-slider owl-carousel owl-theme owl-theme-light">
                        @if($ps->slider == 1)
            				   @if(count($sliders))
            					@foreach($sliders as $data)
                        <div class="home-slide">
                            <div class="slide-bg owl-lazy" data-src="{{('assets/images/sliders/'.$data->photo)}}"></div><!-- End .slide-bg -->
                            <div class="container">
                                <div class="home-slide-content">
                                    <!--<div class="slide-border-top">-->
                                    <!--    <img src="assets/images/slider/border-top.png" alt="Border" width="290" height="38">-->
                                    <!--</div><!-- End .slide-border-top -->
                                    <h3> @if(!$slang)
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
                                    <h1>
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
                                    <a class="btn btn-secondary" href="{{$data->link}}">{{ $langg->lang25 }}</a>
                                    <!--<div class="slide-border-bottom">-->
                                    <!--    <img src="assets/images/slider/border-bottom.png" alt="Border" width="290" height="111">-->
                                    <!--</div><!-- End .slide-border-bottom -->
                                </div><!-- End .home-slide-content -->
                            </div><!-- End .container -->
                        </div><!-- End .home-slide -->
                        @endforeach
                        @endif
                        @endif
                    </div><!-- End .home-slider -->
                </div><!-- End .home-slider-container -->
            </div><!-- End .container -->

         {{--   <div class="container">
                <div class="row">
                    @if($ps->featured ==1)
                    <div class="col-md-4">
                        <div class="column-product-container">
                            <h2>{{ $langg->lang26}}</h2>
                            <div class="column-slider owl-carousel">
                                <?php $i=0 ?>
                                @foreach($feature_products as $prod)
                                @if($i<3)
                                <?php $i++ ?>
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
                                    </figure>
                                    <div class="product-details text-center">
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
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endif
                                @endforeach
                            </div><!-- End .column-slider  -->
                        </div><!-- End .column-product-container -->
                    </div><!-- End .col-md-4 -->
                    @endif
                    
                    @if($ps->best ==1)
                    <div class="col-md-4">
                        <div class="column-product-container">
                            <h2>{{ $langg->lang27}}</h2>
                            <div class="column-slider owl-carousel">
                                <?php $i=0 ?>
                                @foreach($best_products as $prod)
                                @if($i<3)
                                <?php $i++ ?>
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">Quick view</a>
                                    </figure>
                                    <div class="product-details text-center">
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
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endif
                                @endforeach
                            </div><!-- End .column-slider  -->
                        </div><!-- End .column-product-container -->
                    </div><!-- End .col-md-4 -->
                    @endif
                    
                    @if($ps->hot_sale == 1)
                    <div class="col-md-4">
                        <div class="column-product-container">
                            <h2>{{ $langg->lang31}}</h2>
                            <div class="column-slider owl-carousel">
                                <?php $i=0 ?>
                                @foreach($latest_products as $prod)
                                @if($i<3)
                                <?php $i++ ?>
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">Quick view</a>
                                    </figure>
                                    <div class="product-details text-center">
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
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endif
                                @endforeach
                            </div><!-- End .column-slider  -->
                        </div><!-- End .column-product-container -->
                    </div><!-- End .col-md-4 -->
                    @endif
                            
                   
                </div><!-- End .row -->
            </div><!-- End .container --> --}}
            
            
                       
            <div class="container my-5">
                <div class="row justify-content-center">
                    @foreach($categorys->take(4) as $cat)
                        <div class="col-12 col-md-3 col-sm-6 mb-4">
                            <a href="{{ route('front.category', ['category' => $cat->slug, 'lang' => $sign]) }}" style="text-decoration: none;">
                                <div class="category-card position-relative" style="border-radius: 12px; overflow: hidden;">
                                    <img src="{{ $cat->photo ? asset('assets/images/categories/'.$cat->photo) : asset('assets/images/noimage.png') }}" 
                                        alt="{{ $cat->name }}" class="img-fluid w-100" style="height:250px; object-fit:cover;">
                                    <div class="category-overlay position-absolute bottom-0 start-0 w-100 text-center py-2"
                                         style="background:rgb(29 167 104 / 81%); color:#fff; font-weight:bold; font-size:2rem;bottom:0;">
                                        {{ (isset($slang) && $slang == 2) ? $cat->name_ar : $cat->name }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="banners-group">
                <div class="container">
                    <div class="row">
                        @foreach($fix_banners as $banner)
                        <div class="col-lg-4 col-md-6 home-banners">
                            <div class="banner banner-image" style="height:200px">
                                <a href="{{$banner->link}}" style="height:100%">
                                    <img src="{{('assets/images/banners/'.$banner->photo)}}" alt="banner" style="height:100%">
                                </a>
                                <div class="banner-layer banner-layer-middle banner-layer-left">
                                <h5 class=" m-b-3 font3">
                                @if(!$slang)
                                      @if($lang->id == 2)
                                    {!!$banners->title_ar!!}
                                      @else 
                                      {!! $banner->title!!}
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
                                <a href="{{$banner->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                            </div>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                        @endforeach
                        
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .banners-group -->
            @if($ps->featured == 1 && !$feature_products->isEmpty())
             <div class="container">
                <div class="container-box">
                    <div class="row row-sm">
                        @foreach($feature_products as $prod)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
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
                                 @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">{{ $langg->lang75 }}</a>
                                    @endif
                            </div><!-- End .product -->
                        </div><!-- End .col-lg-3 -->
                        @endforeach
                    </div><!-- End .row -->
                </div><!-- End .container-box -->
            </div><!-- End .container -->
            @endif
            <div class="mb-3"></div><!-- margin -->
            @if($ps->best == 1 && !$best_products->isEmpty())
            <div class="container">
                <div class="container-box">
                    <div class="row row-sm">
                        @foreach($best_products as $prod)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
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
                                    
                                   
                                </div>
                                <!-- End .product-details -->
                                 @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">{{ $langg->lang75 }}</a>
                                    @endif
                                    
                            </div><!-- End .product -->
                        </div><!-- End .col-lg-3 -->
                        @endforeach
                    </div><!-- End .row -->
                </div><!-- End .container-box -->
            </div><!-- End .container -->
            @endif
            <div class="mb-3"></div><!-- margin -->

             @if($ps->top_rated == 1 && !$top_products->isEmpty())
            <div class="container">
                <div class="container-box">
                    <div class="row row-sm">
                        @foreach($top_products as $prod)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
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
                                @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">{{ $langg->lang75 }}</a>
                                    @endif
                            </div><!-- End .product -->
                        </div><!-- End .col-lg-3 -->
                        @endforeach
                    </div><!-- End .row -->
                </div><!-- End .container-box -->
            </div><!-- End .container -->
            @endif
            <div class="mb-3"></div><!-- margin -->
            
            @if($ps->big == 1 && !$big_products->isEmpty())
                <div class="container">
                    <div class="container-box">
                        <div class="row row-sm">
                            @foreach($big_products as $prod)
                            <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
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
                                     @if($prod->emptyStock())
                                          <button class="btn">
                                            <a href="javascript:;" class="cart-out-of-stock">
                                              <i class="icofont-close-circled"></i>
                                              {{ $langg->lang78 }}</a>
                                          </button>
                                        @else    
                                         <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">{{ $langg->lang75 }}</a>
                                        @endif
                                </div><!-- End .product -->
                            </div><!-- End .col-lg-3 -->
                            @endforeach
                        </div><!-- End .row -->
                    </div><!-- End .container-box -->
                </div><!-- End .container -->
            @endif
            <div class="mb-3"></div><!-- margin -->
            
            @if($ps->hot_sale == 1 && !$latest_products->isEmpty())
                <div class="container">
                    <div class="container-box">
                        <div class="row row-sm">
                            @foreach($latest_products as $prod)
                            <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
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
                                    @if($prod->emptyStock())
                                          <button class="btn">
                                            <a href="javascript:;" class="cart-out-of-stock">
                                              <i class="icofont-close-circled"></i>
                                              {{ $langg->lang78 }}</a>
                                          </button>
                                        @else    
                                         <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">{{ $langg->lang75 }}</a>
                                        @endif
                                </div><!-- End .product -->
                            </div><!-- End .col-lg-3 -->
                            @endforeach
                        </div><!-- End .row -->
                    </div><!-- End .container-box -->
                </div><!-- End .container -->
            @endif
            <div class="mb-3"></div><!-- margin -->
            @if($ps->hot_sale == 1 && !$hot_products->isEmpty())
            <div class="container">
                <div class="container-box">
                    <div class="row row-sm">
                        @foreach($hot_products as $prod)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
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
                                 @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">{{ $langg->lang75 }}</a>
                                    @endif
                            </div><!-- End .product -->
                        </div><!-- End .col-lg-3 -->
                        @endforeach
                    </div><!-- End .row -->
                </div><!-- End .container-box -->
            </div><!-- End .container -->
            @endif
            <div class="mb-3"></div><!-- margin -->    
            @if($ps->hot_sale == 1 && !$trending_products->isEmpty())
            <div class="container">
                <div class="container-box">
                    <div class="row row-sm">
                        @foreach($trending_products as $prod)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-5 col">
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
                                @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">{{ $langg->lang75 }}</a>
                                    @endif
                            </div><!-- End .product -->
                        </div><!-- End .col-lg-3 -->
                        @endforeach
                    </div><!-- End .row -->
                </div><!-- End .container-box -->
            </div><!-- End .container -->
            @endif
            <div class="mb-3"></div><!-- margin -->      
            
            @if($ps->flash_deal == 1 && !$discount_products->isEmpty())
            <div class="container">
                <div class="container-box">
                    <div class="row row-sm">
                        @foreach($discount_products as $prod)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-5 col">
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
                                @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">{{ $langg->lang75 }}</a>
                                    @endif
                            </div><!-- End .product -->
                        </div><!-- End .col-lg-3 -->
                        @endforeach
                    </div><!-- End .row -->
                </div><!-- End .container-box -->
            </div><!-- End .container -->
            @endif
            
           <!-- <div class="container main-banner my-5">
                <a href="{{$fix_banners[0]->link}}" style="height:100px">
                    <img src="{{('assets/images/banners/'.$bottom_small_banners[0]->photo)}}" alt="banner">
                </a>
                <div class="banner-layer banner-layer-middle banner-layer-left">
                <h5 class=" m-b-3 font3 d-inline-block px-5">
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
                <h4 class="mb-3 text-uppercase text-white d-inline-block px-5">
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
            </div>   -->   
             @if($ps->service == 1)
            <div class="container">
                <div class="container-box container-box-lg info-boxes">
                    <div class="row">
                        @foreach($chunk as $service) 
                        <div class="col-md-4">
                            <div class="feature-box feature-box-simple text-center">
                             <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;margin: auto;">

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
                        </div><!-- End .col-md-3 -->
                         @endforeach
                    </div><!-- End .row -->
                @endif
                    
                    @if($ps->partners == 1)
                    <hr class="mb-4"><!-- margin -->
                        <div class="partners-carousel owl-carousel owl-theme">
                            @foreach($partners as $j)
                            <a href="#" class="partner">
                                <img src="{{asset('assets/images/partner/'.$j->photo)}}" style="width:100%; height:50px;" alt="logo">
                            </a>
                            @endforeach
                        </div><!-- End .partners-carousel -->
                        <hr class="mb-4"><!-- margin -->
                    @endif
                    
                </div><!-- End .container-box -->
            </div><!-- End .container -->
        </main><!-- End .main -->
        
        
        
        
        
      
        
        