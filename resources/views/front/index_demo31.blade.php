@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp

<main class="home main">
            <div class="container">
                <section class="mb-2">
                    <div class="row row-sm">
                        <div class="col-lg-6">
                            <div class="home-banner">
                                <div class=" row row-sm">
                                    <div class="col-6 text-right">
                                        <div class="banner-content">
                                            <span>An entire week to enjoy all offers</span>
                                            <h3>The Week</h3>
                                            <h4>Gift Shop</h4>
                                            <button class="btn"><a href="{{ route('front.products',$sign) }}"> SHOP NOW </a></button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                                            'items': 1,
                                            'margin': 0,
                                            'nav': false,
                                            'dots': true
                                        }">
                                            <div class="product-default pt-5">
                                                <figure>
                                                    <a href="#">
                                                        <img src="assets/images/products/400x300/product-10.jpg">
                                                        <img src="assets/images/products/400x300/product-4.jpg">
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h2 class="product-title">
                                                        <a href="#">Ceramic Panda Mug</a>
                                                    </h2>
                                                    <div class="price-box">
                                                        <span class="old-price">$59.00</span>
                                                        <span class="product-price">$49.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-default pt-5">
                                                <figure>
                                                    <a href="#">
                                                        <img src="assets/images/products/400x300/product-6.jpg">
                                                        <img src="assets/images/products/400x300/product-8.jpg">
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h2 class="product-title">
                                                        <a href="#">Ceramic Panda Mug</a>
                                                    </h2>
                                                    <div class="price-box">
                                                        <span class="old-price">$59.00</span>
                                                        <span class="product-price">$49.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-default pt-5">
                                                <figure>
                                                    <a href="#">
                                                        <img src="assets/images/products/400x300/product-2.jpg">
                                                        <img src="assets/images/products/400x300/product-5.jpg">
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h2 class="product-title">
                                                        <a href="#">Ceramic Panda Mug</a>
                                                    </h2>
                                                    <div class="price-box">
                                                        <span class="old-price">$59.00</span>
                                                        <span class="product-price">$49.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="home-banner2 text-center">
                                <h3>Flash Sale Running!</h3>
                                <div class="banner-content">
                                    <div class="product-panel">
                                        <div class="product-default">
                                            <figure>
                                                <a href="#">
                                                    <img src="assets/images/products/400x400/product-1.jpg">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h2 class="product-title">
                                                    <a href="#">Teddy Bear Blue</a>
                                                </h2>
                                                <div class="price-box">
                                                    <span class="old-price">$59.00</span>
                                                    <span class="product-price">$49.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn"><a href="{{ route('front.products',$sign) }}">SHOP SALE NOW </a></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="home-banner3 text-center" style="background-image: url('assets/images/banners/banner3.jpg');">
                                <h3>Gift Finder<br><span>Find the Perfect Gift</span></h3>
                                <div class="select-box">
                                    <div class="select-custom">
                                        <select class="form-control">
                                            <option selected="" hidden="">Price Range</option>
                                            <option>0 - 100</option>
                                            <option>100 - 200</option>
                                            <option>200 - 500</option>
                                        </select>
                                    </div>
                                    <div class="select-custom">
                                        <select class="form-control">
                                            <option selected="" hidden="">By color</option>
                                            <option>Red</option>
                                            <option>Green</option>
                                            <option>Blue</option>
                                        </select>
                                    </div>
                                    <div class="select-custom">
                                        <select class="form-control">
                                            <option selected="" hidden="">By size</option>
                                            <option>L</option>
                                            <option>M</option>
                                            <option>X</option>
                                            <option>XL</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn"><a href="{{ route('front.products',$sign) }}" >VIEW SUGGESTIONS </a></button>
                            </div>
                        </div>
                        @if($ps->featured_category == 1)
                        @foreach($categories->where('is_featured','=',1) as $cat)
                        <div class="col-6 col-lg-3">
                            <div class="home-banner4 mb-2" style="background-image: url('assets/images/categories/{{$cat->photo}}');">
                                <div class="banner-content">
                                    <h3>
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
                                    <a href="{{ route('front.category',['category' => $cat->slug , 'lang' => $sign ]) }}">{{ $langg->lang25 }}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </section>

                @if($ps->featured ==1)
                <section class="product-panel pt-2 mb-2">
                    <div class="section-title">
                        <h2>{{ $langg->lang26}}</h2>
                    </div>
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
                                    <!--<div class="product-label label-cut">27% OFF</div>-->
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
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                    <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
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
                </section>
                @endif
                @if($ps->top_rated ==1)
                <section class="product-panel pt-2 mb-2">
                    <div class="section-title">
                        <h2>{{ $langg->lang28}}</h2>
                    </div>
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
                                    <!--<div class="product-label label-cut">27% OFF</div>-->
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
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                    <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
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
                </section>
                @endif
                @if($ps->best ==1)
                <section class="product-panel pt-2 mb-2">
                    <div class="section-title">
                        <h2>{{ $langg->lang27}}</h2>
                    </div>
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
                                    <!--<div class="product-label label-cut">27% OFF</div>-->
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
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                    <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
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
                </section>
                @endif
                @if($ps->big ==1)
                <section class="product-panel pt-2 mb-2">
                    <div class="section-title">
                        <h2>{{ $langg->lang29}}</h2>
                    </div>
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
                                    <!--<div class="product-label label-cut">27% OFF</div>-->
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
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                    <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
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
                </section>
                @endif
                @if($ps->hot_sale ==1)
                <section class="product-panel pt-2 mb-2">
                    <div class="section-title">
                        <h2>{{$langg->lang33}}</h2>
                    </div>
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
                                    <!--<div class="product-label label-cut">27% OFF</div>-->
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
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                    <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
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
                </section>
                @endif
                @if($ps->hot_sale ==1)
                <section class="product-panel pt-2 mb-2">
                    <div class="section-title">
                        <h2>{{ $langg->lang32}}</h2>
                    </div>
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
                                    <!--<div class="product-label label-cut">27% OFF</div>-->
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
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                    <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
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
                </section>
                @endif
                @if($ps->hot_sale ==1)
                <section class="product-panel pt-2 mb-2">
                    <div class="section-title">
                        <h2>{{ $langg->lang30}}</h2>
                    </div>
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
                        @foreach($hot_products as $prod)
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
                                    <!--<div class="product-label label-cut">27% OFF</div>-->
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
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                    <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
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
                </section>
                @endif
                @if($ps->hot_sale ==1)
                <section class="product-panel pt-2 mb-2">
                    <div class="section-title">
                        <h2>{{ $langg->lang31}}</h2>
                    </div>
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
                                    <!--<div class="product-label label-cut">27% OFF</div>-->
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
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                    <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
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
                </section>
                @endif
            </div>

            <section class="bg-grey pt-5 pb-5">
                <div class="container mt-1 mb-1">
                    <div class="row row-sm">
                        @if(!empty($fix_banners[0]))
                        <div class="col-md-4">
                            <div class="home-banner5" style="border-color : rgba(214, 106, 121, 0.7);">
                                <div class="banner-background" style="background-image: url('{{('assets/images/banners/'.$fix_banners[0]->photo)}}');">
                                </div>
                                <div class="banner-content">
                                    <span>
                                        @if(!$slang)
                                          @if($lang->id == 2)
                                        {!! $fix_banners[0]->title_ar !!}
                                          @else 
                                          {!! $fix_banners[0]->title !!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$fix_banners[0]->title_ar !!}
                                          @else
                                          {!! $fix_banners[0]->title !!}
                                          @endif
                                      @endif
                                    </span>
                                    <h3>
                                        @if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$fix_banners[0]->subtitle_ar !!}
                                          @else 
                                          {!! $fix_banners[0]->subtitle !!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!! $fix_banners[0]->subtitle_ar !!}
                                          @else
                                          {!! $fix_banners[0]->subtitle !!}
                                          @endif
                                      @endif
                                    </h3>
                                    <a href="{{$fix_banners[0]->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(!empty($fix_banners[1]))
                        <div class="col-md-4">
                            <div class="home-banner5" style="border-color : rgba(41, 56, 113, 0.7);">
                                <div class="banner-background" style="background-image: url('{{('assets/images/banners/'.$fix_banners[1]->photo)}}');">
                                </div>
                                <div class="banner-content">
                                    <span>
                                        @if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$fix_banners[1]->title_ar!!}
                                          @else 
                                          {!! $fix_banners[1]->title !!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!! $fix_banners[1]->title_ar !!}
                                          @else
                                          {!! $fix_banners[1]->title !!}
                                          @endif
                                      @endif
                                    </span>
                                    <h3>
                                        @if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$fix_banners[1]->subtitle_ar!!}
                                          @else 
                                          {!! $fix_banners[1]->subtitle !!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$fix_banners[1]->subtitle_ar!!}
                                          @else
                                          {!! $fix_banners[1]->subtitle !!}
                                          @endif
                                      @endif
                                    </h3>
                                    <a href="{{$fix_banners[1]->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(!empty($fix_banners[2]))
                        <div class="col-md-4">
                            <div class="home-banner5" style="border-color : rgba(198, 169, 155, 0.7);">
                                <div class="banner-background" style="background-image: url('{{('assets/images/banners/'.$fix_banners[2]->photo)}}');">
                                </div>
                                <div class="banner-content">
                                    <span>
                                        @if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$fix_banners[2]->title_ar!!}
                                          @else 
                                          {!!$fix_banners[2]->title!!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$fix_banners[2]->title_ar!!}
                                          @else
                                          {!!$fix_banners[2]->title!!}
                                          @endif
                                      @endif
                                    </span>
                                    <h3>
                                        @if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$fix_banners[2]->subtitle_ar!!}
                                          @else 
                                          {!! $fix_banners[2]->subtitle !!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$fix_banners[2]->subtitle_ar!!}
                                          @else
                                          {!! $fix_banners[2]->subtitle !!}
                                          @endif
                                      @endif
                                    </h3>
                                    <a href="{{$fix_banners[2]->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>

            <div class="container">
                 @if($ps->service == 1)
                <section class="service-section mt-2 mb-2">
                    @foreach($chunk as $service )
                    <div class="col-lg-3">
                        <div class="service-widget">
                            <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">
                            <div class="service-content">
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
                            </div>
                        </div>
                    </div>
                    @endforeach
                </section>
                 @endif
                 
                @if($ps->flash_deal ==1)
                <section class="product-panel pt-4 mb-2">
                    <div class="section-title">
                        <h2>{{ $langg->lang244}}</h2>
                    </div>
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
                        @foreach($discount_products as $prod)
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
                                    <!--<div class="product-label label-cut">27% OFF</div>-->
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
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                    <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
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
                </section>
                @endif
            </div>
        </main><!-- End .main -->