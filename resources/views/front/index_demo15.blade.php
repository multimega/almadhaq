


@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp

<main class="main">
            <section class="section section-bg section-parallax section-1" style="background-image: url('{{('assets/images/banners/'.$fix_banners[0]->photo)}}');">
                <div class="container">
                    <div class="section-header">
                        <h1 class="section-title">
                            {{$fix_banners[0]->title}}
                        </h1>
                        <h2 class="section-subtitle">
                            {{$fix_banners[0]->subtitle}}
                        </h2>
                        @if(!empty($fix_banners[0]->link)) 
                        <a href="{{$fix_banners[0]->link}}" class="btn btn-primary">{{ $langg->lang25 }}</a>
                        @endif
                    </div><!-- End .section-header -->
                </div><!-- End .container -->
            </section><!-- End .section -->

@if($ps->featured ==1)
            <section class="section section-big section-bg section-parallax section-2" style="background-image: url('{{('assets/images/banners/'.$fix_banners[0]->photo)}}');">
                <div class="container text-right">
                    <div class="title-group">
                        <h3>{{ $langg->lang26}}</h3>
                        <h2>Fashion Clothes<a href="#" class="btn btn-primary">Get the Offer</a></h2>
                    </div><!-- .End .title-group -->
                </div><!-- End .container -->

                <div class="container">
                    <div class="section-products-carousel owl-carousel owl-theme">
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
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                        @endforeach
                    </div><!-- End .section-products-carousel -->
                </div><!-- End .container -->
            </section><!-- End .section -->
@endif

@if($ps->best == 1)
            <section class="section section-big section-bg section-parallax section-3" style="background-image: @if(!empty($fix_banners[1]->photo)) url('{{('assets/images/banners/'.$fix_banners[1]->photo)}}'); @endif">
                <div class="container">
                    <div class="title-group">
                        <h3>{{ $langg->lang27}}</h3>
                        <h2>Fashion Sunglasses<a href="#" class="btn btn-primary">Get the Offer</a></h2>
                    </div><!-- .End .title-group -->
                </div><!-- End .container -->

                <div class="container">
                    <div class="section-products-carousel owl-carousel owl-theme">
                        
                      @foreach($best_products as $prod)
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
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
@endforeach
                    </div><!-- End .section-products-carousel -->
                </div><!-- End .container -->
            </section><!-- End .section -->
@endif

@if($ps->top_rated ==1)
            <section class="section section-big section-bg section-parallax section-2" style="background-image: @if(!empty($fix_banners[2]->photo)) url('{{('assets/images/banners/'.$fix_banners[2]->photo)}}'); @endif">
                <div class="container text-right">
                    <div class="title-group">
                        <h3>{{ $langg->lang28}}</h3>
                        <h2>Fashion Clothes<a href="#" class="btn btn-primary">Get the Offer</a></h2>
                    </div><!-- .End .title-group -->
                </div><!-- End .container -->

                <div class="container">
                    <div class="section-products-carousel owl-carousel owl-theme">
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
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                        @endforeach
                    </div><!-- End .section-products-carousel -->
                </div><!-- End .container -->
            </section><!-- End .section -->
@endif

@if($ps->hot_sale == 1)
            <section class="section section-big section-bg section-parallax section-3" style="background-image: @if(!empty($fix_banners[3]->photo)) url('{{('assets/images/banners/'.$fix_banners[3]->photo)}}');@endif">
                <div class="container">
                    <div class="title-group">
                        <h3>{{ $langg->lang32}}</h3>
                        <h2>Fashion Sunglasses<a href="#" class="btn btn-primary">Get the Offer</a></h2>
                    </div><!-- .End .title-group -->
                </div><!-- End .container -->

                <div class="container">
                    <div class="section-products-carousel owl-carousel owl-theme">
                        
                      @foreach($trending_products as $prod)
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
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
@endforeach
                    </div><!-- End .section-products-carousel -->
                </div><!-- End .container -->
            </section><!-- End .section -->
@endif


@if($ps->big ==1)
            <section class="section section-big section-bg section-parallax section-2" style="background-image: @if(!empty($fix_banners[4]->photo)) url('{{('assets/images/banners/'.$fix_banners[4]->photo)}}'); @endif">
                <div class="container text-right">
                    <div class="title-group">
                        <h3>{{ $langg->lang29}}</h3>
                        <h2>Fashion Clothes<a href="#" class="btn btn-primary">Get the Offer</a></h2>
                    </div><!-- .End .title-group -->
                </div><!-- End .container -->

                <div class="container">
                    <div class="section-products-carousel owl-carousel owl-theme">
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
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                        @endforeach
                    </div><!-- End .section-products-carousel -->
                </div><!-- End .container -->
            </section><!-- End .section -->
@endif

@if($ps->hot_sale == 1)
            <section class="section section-big section-bg section-parallax section-3" style="background-image: @if(!empty($fix_banners[5]->photo)) url('{{('assets/images/banners/'.$fix_banners[5]->photo)}}'); @endif">
                <div class="container">
                    <div class="title-group">
                        <h3>{{ $langg->lang30}}</h3>
                        <h2>Fashion Sunglasses<a href="#" class="btn btn-primary">Get the Offer</a></h2>
                    </div><!-- .End .title-group -->
                </div><!-- End .container -->

                <div class="container">
                    <div class="section-products-carousel owl-carousel owl-theme">
                        
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
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
@endforeach
                    </div><!-- End .section-products-carousel -->
                </div><!-- End .container -->
            </section><!-- End .section -->
@endif


@if($ps->hot_sale ==1)
            <section class="section section-big section-bg section-parallax section-2" style="background-image: @if(!empty($fix_banners[6]->photo)) url('{{('assets/images/banners/'.$fix_banners[6]->photo)}}'); @endif">
                <div class="container text-right">
                    <div class="title-group">
                        <h3>{{ $langg->lang31}}</h3>
                        <h2>Fashion Clothes<a href="#" class="btn btn-primary">Get the Offer</a></h2>
                    </div><!-- .End .title-group -->
                </div><!-- End .container -->

                <div class="container">
                    <div class="section-products-carousel owl-carousel owl-theme">
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
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                        @endforeach
                    </div><!-- End .section-products-carousel -->
                </div><!-- End .container -->
            </section><!-- End .section -->
@endif

            
@if($ps->flash_deal == 1)
            <section class="section section-big section-bg section-parallax section-3" style="background-image: @if(!empty($fix_banners[7]->photo)) url('{{('assets/images/banners/'.$fix_banners[7]->photo)}}'); @endif">
                <div class="container">
                    <div class="title-group">
                        <h3>{{ $langg->lang244}}</h3>
                        <h2>Fashion Sunglasses<a href="#" class="btn btn-primary">Get the Offer</a></h2>
                    </div><!-- .End .title-group -->
                </div><!-- End .container -->

                <div class="container">
                    <div class="section-products-carousel owl-carousel owl-theme">
                        
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
                                     <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                    @endif

                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <span>{{ $langg->lang909 }}</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
@endforeach
                    </div><!-- End .section-products-carousel -->
                </div><!-- End .container -->
            </section><!-- End .section -->
@endif

            <section class="section section-bg section-parallax section-4" style="background-image: url('{{('assets/images/banners/'.$fix_banners[0]->photo)}}');">
                <div class="container text-right">
                    <div class="section-header">
                        <h2 class="section-title">{{$fix_banners[0]->title}}</h2>
                        <h3 class="section-subtitle">{{$fix_banners[0]->subtitle}}</h3>

                        <a href="{{$fix_banners[0]->link}}" class="btn btn-primary">{{ $langg->lang25 }}</a>
                    </div><!-- End .section-header -->
                </div><!-- End .container -->
            </section><!-- End .section -->
        </main><!-- End .main -->

        