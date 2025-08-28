@php 


$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$main=App\Models\Generalsetting::find(1);
$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);
@endphp

 <main class="main">
            <div class="home-slider-container">
                <div class="home-slider owl-carousel owl-theme">
                   @if($ps->slider == 1)
				   @if(count($sliders))
					@foreach($sliders as $key=>$data)
				 
        					@if($data->position == 'left')
                            <div class="home-slide">
                                   @if(!empty($data->link))
                                  <a href="{{$data->link}}">
                                <div class="slide-bg owl-lazy" data-src="{{asset('assets/images/sliders/'.$data->photo)}}"></div><!-- End .slide-bg -->
                                   
                                <div class="home-slide-content container">
                                    <div class="slide-content-wrapper">
                                        <p style="font-size: {{$data->details_size}}px; color: {{$data->details_color}}" class="details details{{$data->id}}" data-animation="animated {{$data->details_anime}}">@if(!$slang)
                                             @if($lang->id == 2)
                                               {{$data->details_text_ar}}
                                                  @else 
                                                 {{$data->details_text}}
                                                  @endif 
                                                    @else  
                                                  @if($slang == 2) 
                                                 {{$data->details_text_ar}}
                                                  @else
                                                  {{$data->details_text}}
                                                  @endif
                                                    
                                                    
                                      @endif</p>
                                       <h3 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}">
                                        
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
                                        
                                    </h3>
                                            <h2 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">
                                            @if(!$slang)
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
                                      @endif
                                      </h2>
                                      </a>
                                    @endif  
                                    
                                    </div><!-- End .slide-content-wrapper -->
                                </div><!-- End .home-slide-content -->
                            </div><!-- End .home-slide -->
                            @else
                            <div class="home-slide">
                                @if(!empty($data->link))
                                  <a href="{{$data->link}}">
                                <div class="slide-bg owl-lazy" data-src="{{asset('assets/images/sliders/'.$data->photo)}}"></div><!-- End .slide-bg -->
                                @if(!empty($data->btn_text))
                                  <a class="slide-button rounded btn-light btn position-absolute  " href="{{ $data->link }}" style="z-index: 1111111111; top:70%; left:8% ; font-weight:bold">{{ ( $lang->sign == 'ar' ) ?  $data->btn_text_ar : $data->btn_text }}</a>
                                @endif
                                <div class="home-slide-content container">
                                    <div class="row">
                                        <div class="col-md-6 offset-md-6">
                                            <p style="font-size: {{$data->details_size}}px; color: {{$data->details_color}}" class="details details{{$data->id}}" data-animation="animated {{$data->details_anime}}">@if(!$slang)
                                             @if($lang->id == 2)
                                               {{$data->details_text_ar}}
                                                  @else 
                                                 {{$data->details_text}}
                                                  @endif 
                                                    @else  
                                                  @if($slang == 2) 
                                                 {{$data->details_text_ar}}
                                                  @else
                                                  {{$data->details_text}}
                                                  @endif
                                                    
                                                    
                                      @endif</p>
                                       <h3 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}">
                                        
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
                                        
                                    </h3>
                                            <h2 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">
                                            @if(!$slang)
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
                                                    
                                                    
                                      @endif
                                      </h2>
                                      </a>
                                    @endif
                                        </div><!-- End .col-lg-5 -->
                                    </div><!-- End .row -->
                                </div><!-- End .home-slide-content -->
                            </div><!-- End .home-slide -->
                            @endif
                            
                    @endforeach
                    @endif
                    @endif
                    
                </div><!-- End .home-slider -->
            </div><!-- End .home-slider-container -->

            <div class="main-container">
                <div class="category-list" id="category-list">
                    <ul class="nav category-list-nav">
                        
                        @if(!empty($gs->feature_icon))
                        <li class="nav-item green">
                            <a href="#cat-1" class="nav-link">
                                <span class="cat-list-icon"><img src="{{asset('assets/images/'.$gs->feature_icon)}}" width="28" alt="Category Name"></span>
                                <span class="cat-list-text">{{$langg->lang26}}</span>
                            </a>
                        </li>
                        @endif
                        
                         @if(!empty($gs->best_icon))
                        <li class="nav-item orange">
                            <a href="#cat-2" class="nav-link">
                                <span class="cat-list-icon"><img src="{{asset('assets/images/'.$gs->best_icon)}}" width="24" alt="Category Name"></span>
                                <span class="cat-list-text">{{$langg->lang27}}</span>
                            </a>
                        </li>
                        @endif
                        
                         @if(!empty($gs->top_icon))
                        <li class="nav-item red">
                            <a href="#cat-3" class="nav-link">
                                <span class="cat-list-icon"><img src="{{asset('assets/images/'.$gs->top_icon)}}" width="24" alt="Category Name"></span>
                                <span class="cat-list-text">{{$langg->lang28}}</span>
                            </a>
                        </li>
                        @endif
                        
                         @if(!empty($gs->big_icon))
                        <li class="nav-item lime">
                            <a href="#cat-4" class="nav-link">
                                <span class="cat-list-icon"><img src="{{asset('assets/images/'.$gs->big_icon)}}" width="32" alt="Category Name"></span>
                                <span class="cat-list-text">{{$langg->lang29}}</span>
                            </a>
                        </li>
                        @endif
                        
                        @if(!empty($gs->new_icon))
                        <li class="nav-item blue">
                            <a href="#cat-5" class="nav-link">
                                <span class="cat-list-icon"><img src="{{asset('assets/images/'.$gs->new_icon)}}" width="25" alt="Category Name"></span>
                                <span class="cat-list-text"> {{$langg->lang31}}</span>
                            </a>
                        </li>
                        @endif
                        
                         @if(!empty($gs->hot_icon))
                        <li class="nav-item gray">
                            <a href="#cat-6" class="nav-link">
                                <span class="cat-list-icon"><img src="{{asset('assets/images/'.$gs->hot_icon)}}" width="24" alt="Category Name"></span>
                                <span class="cat-list-text"> {{$langg->lang32}}</span>
                            </a>
                        </li>
                        @endif
                        
                          @if(!empty($gs->trending_icon))
                        <li class="nav-item lightblue">
                            <a href="#cat-7" class="nav-link">
                                <span class="cat-list-icon"><img src="{{asset('assets/images/'.$gs->trending_icon)}}" width="24" alt="Category Name"></span>
                                <span class="cat-list-text">{{$langg->lang33}}</span>
                            </a>
                        </li>
                        @endif
                        
                         @if(!empty($gs->discount_icon))
                        <li class="nav-item lightblue">
                            <a href="#cat-8" class="nav-link">
                                <span class="cat-list-icon"><img src="{{asset('assets/images/'.$gs->discount_icon)}}" width="24" alt="Category Name"></span>
                                <span class="cat-list-text">{{$langg->lang244}}</span>
                            </a>
                        </li>
                        @endif
                        
                    </ul>
                </div><!-- End .category-list -->

                <div class="main-content">
                    <div class="container-fluid">
                       
                        @if($ps->featured ==1)
                        <div id="cat-1" class="category-section">
                            <div class="category-title">
                              <h2>{{ $langg->lang26}}</h2>
                               <a href="{{ route('front.products',$sign) }}" class="btn btn-outline-primary">See more</a>
                            </div><!-- End .category-title -->


                            <div class="products-carousel owl-carousel owl-theme">
                               @foreach($feature_products as $prod)
                                <div class="product">
                                    <figure class="product-image-container">
                                       <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                <img class="xzoom5" id="xzoom-magnific"
                  src="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                  xoriginal="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                
                />
              </a>                                     
                                
                                       
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">{{$langg->lang55}}</a>
                                       <!--<a  href="{{ route('product.quickz',$prod->id) }}"  id="{{$prod->id}}" name="{{ $slang }}" class="btn btn-primary view-product-modal" data-bs-toggle="modal" data-bs-target="#staticBackdrop">-->
                                       <!--   Launch -->
                                       <!-- </a>-->
                                        
                                        <!-- Button trigger modal -->



                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                           
                                              <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                    <button onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction add-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal">
                                        <span>{{$langg->lang56}}</span>
                                    </button>
                                    
                                    <!--<a href="javascript:;" data-href="{{ route('product.cart.add',$prod->id) }}" class="paction add-cart  addtocart add-to-cart" title="{{$langg->lang56}}">-->
                                    <!--            <span>{{$langg->lang56}}</span>-->
                                    <!--        </a>-->
                                    @endif
                                            
                                            <!-- <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="paction add-cart" title="{{$langg->lang56}}">-->
                                            <!--    <span>{{$langg->lang56}}</span>-->
                                            <!--</a>-->

                                            <a  class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}" title="{{$langg->lang909}}">
                                              <span>{{$langg->lang909}}</span>
                                           </a> 
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                               @endforeach
                               
                            </div><!-- End .products-carousel -->

                            <div class="banners-group">
                                <div class="row row-sm">
                                    
                                    @if(!empty($bottom_small_banners[0]))
                                    <div class="col-lg-12 mx-auto">
                                        
                                        <div class="banner banner-image banner-botm">
                                            <a href="{{$bottom_small_banners[0]->link}}">
                                                <img src="{{asset('assets/images/banners/'.$bottom_small_banners[0]->photo)}}" alt="banner">
                                            </a>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-6 -->
                                   @endif
                                </div><!-- End .row -->
                            </div><!-- End .banners-group -->
                        </div><!-- End .category-section -->
                        @endif
                        
                        
                        
                        
                        
                          @if($ps->best ==1)
                        <div id="cat-2" class="category-section">
                            <div class="category-title">
                              <h2>{{ $langg->lang27}}</h2>
                               <a href="{{ route('front.products',$sign) }}" class="btn btn-outline-primary">See more</a>
                            </div><!-- End .category-title -->


                            <div class="products-carousel owl-carousel owl-theme">
                              
                              
                               @foreach($best_products as $prod)
                                <div class="product">
                                    <figure class="product-image-container">
                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img class="xzoom5" id="xzoom-magnific"
                  src="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                  xoriginal="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                
                />
                                </a>
                                       
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">{{$langg->lang55}}</a>
                                       
                                    </figure>
                                    <div class="product-details">
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
                                           
                                              <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                    <!--<button onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction add-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal">-->
                                    <!--    <span>{{$langg->lang56}}</span>-->
                                    <!--</button>-->
                                    @endif
                                            
                                            <!--<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="paction add-cart" title="{{$langg->lang56}}">-->
                                            <!--    <span>{{$langg->lang56}}</span>-->
                                            <!--</a>-->

                                            <a  class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}" title="{{$langg->lang909}}">
                                              <span>{{$langg->lang909}}</span>
                                           </a> 
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                               @endforeach
                               
                            </div><!-- End .products-carousel -->

                             <div class="banners-group">
                                <div class="row row-sm">
                                    
                                    @if(!empty( $bottom_small_banners[1]))
                                    <div class="col-lg-12 mx-auto">
                                        
                                        <div class="banner banner-image banner-botm">
                                            <a href="{{$bottom_small_banners[1]->link}}">
                                                <img src="{{asset('assets/images/banners/'.$bottom_small_banners[1]->photo)}}" alt="banner">
                                            </a>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-6 -->
                                   @endif
                                </div><!-- End .row -->
                            </div><!-- End .banners-group -->
                        </div><!-- End .category-section -->
                        @endif
                        
                        
                        
                        
                         @if($ps->top_rated ==1)
                        <div id="cat-3" class="category-section">
                            <div class="category-title">
                              <h2>{{ $langg->lang28}}</h2>
                               <a href="{{ route('front.products',$sign) }}" class="btn btn-outline-primary">See more</a>
                            </div><!-- End .category-title -->


                            <div class="products-carousel owl-carousel owl-theme">
                              
                              
                               @foreach($top_products as $prod)
                                <div class="product">
                                    <figure class="product-image-container">
                                       <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img class="xzoom5" id="xzoom-magnific"
                  src="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                  xoriginal="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                
                />
                                </a>
                                       
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">{{$langg->lang55}}</a>
                                       
                                    </figure>
                                    <div class="product-details">
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
                                           
                                              <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                    <button onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction add-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal">
                                        <span>{{$langg->lang56}}</span>
                                    </button>
                                    @endif
                                            
                                            <!--<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="paction add-cart" title="{{$langg->lang56}}">-->
                                            <!--    <span>{{$langg->lang56}}</span>-->
                                            <!--</a>-->

                                            <a  class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}" title="{{$langg->lang909}}">
                                              <span>{{$langg->lang909}}</span>
                                           </a> 
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                               @endforeach
                               
                            </div><!-- End .products-carousel -->

                             <div class="banners-group">
                                <div class="row row-sm">
                                    @if(!empty($bottom_small_banners[2]))
                                    <div class="col-lg-12 mx-auto">
                                        
                                        <div class="banner banner-image banner-botm">
                                            <a href="{{$bottom_small_banners[2]->link}}">
                                                <img src="{{asset('assets/images/banners/'.$bottom_small_banners[2]->photo)}}" alt="banner">
                                            </a>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-6 -->
                                   @endif
                                    
                                </div><!-- End .row -->
                            </div><!-- End .banners-group -->
                        </div><!-- End .category-section -->
                        @endif
                        
                        
                        
                        
                         @if($ps->big ==1)
                        <div id="cat-4" class="category-section">
                            <div class="category-title">
                              <h2>{{ $langg->lang29}}</h2>
                               <a href="{{ route('front.products',$sign) }}" class="btn btn-outline-primary">See more</a>
                            </div><!-- End .category-title -->


                            <div class="products-carousel owl-carousel owl-theme">
                              
                              
                               @foreach($big_products as $prod)
                                <div class="product">
                                    <figure class="product-image-container">
                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img class="xzoom5" id="xzoom-magnific"
                  src="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                  xoriginal="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                
                />
                                </a>
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">{{$langg->lang55}}</a>
                                       
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                           
                                              <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                    <button class="btn-icon btn-add-cart add-to-cart paction add-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal">
                                        <span>{{$langg->lang56}}</span>
                                    </button>
                                    @endif
                                            <!--<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}" class="paction add-cart" title="{{$langg->lang56}}">-->
                                            <!--    <span>{{$langg->lang56}}</span>-->
                                            <!--</a>-->

                                            <a  class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}" title="{{$langg->lang909}}">
                                              <span>{{$langg->lang909}}</span>
                                           </a> 
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                               @endforeach
                               
                            </div><!-- End .products-carousel -->

                           <div class="banners-group">
                                <div class="row row-sm">
                                    @if(!empty($bottom_small_banners[3]))
                                    <div class="col-lg-12 mx-auto">
                                        
                                        <div class="banner banner-image banner-botm">
                                            <a href="{{$bottom_small_banners[3]->link}}">
                                                <img src="{{asset('assets/images/banners/'.$bottom_small_banners[3]->photo)}}" alt="banner">
                                            </a>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-6 -->
                                   @endif
                                   
                                </div><!-- End .row -->
                            </div><!-- End .banners-group -->
                        </div><!-- End .category-section -->
                        @endif
                        
                        
                        
                        
                          @if($ps->hot_sale ==1)
                        <div id="cat-5" class="category-section">
                            <div class="category-title">
                              <h2>{{ $langg->lang31}}</h2>
                               <a href="{{ route('front.products',$sign) }}" class="btn btn-outline-primary">See more</a>
                            </div><!-- End .category-title -->


                            <div class="products-carousel owl-carousel owl-theme">
                              
                              
                               @foreach($latest_products as $prod)
                                <div class="product">
                                    <figure class="product-image-container">
                                       <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img class="xzoom5" id="xzoom-magnific"
                  src="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                  xoriginal="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                
                />
                                </a>
                                       
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">{{$langg->lang55}}</a>
                                       
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                           
                                              <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                    <button onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction add-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal">
                                        <span>{{$langg->lang56}}</span>
                                    </button>
                                    @endif
                                           
                                           <!--<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="paction add-cart" title="{{$langg->lang56}}">-->
                                           <!--     <span>{{$langg->lang56}}</span>-->
                                           <!-- </a>-->

                                            <a  class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}" title="{{$langg->lang909}}">
                                              <span>{{$langg->lang909}}</span>
                                           </a> 
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                               @endforeach
                               
                            </div><!-- End .products-carousel -->

                           <div class="banners-group">
                                <div class="row row-sm">
                                    
                                       @if(!empty($bottom_small_banners[4]))
                                    <div class="col-lg-12 mx-auto">
                                        
                                        <div class="banner banner-image banner-botm">
                                            <a href="{{$bottom_small_banners[4]->link}}">
                                                <img src="{{asset('assets/images/banners/'.$bottom_small_banners[4]->photo)}}" alt="banner">
                                            </a>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-6 -->
                                   @endif
                                </div><!-- End .row -->
                            </div><!-- End .banners-group -->
                        </div><!-- End .category-section -->
                        @endif
                        
                        
                         @if($ps->hot_sale ==1)
                        <div id="cat-6" class="category-section">
                            <div class="category-title">
                              <h2>{{ $langg->lang32}}</h2>
                               <a href="{{ route('front.products',$sign) }}" class="btn btn-outline-primary">See more</a>
                            </div><!-- End .category-title -->


                            <div class="products-carousel owl-carousel owl-theme">
                              
                              
                               @foreach($hot_products as $prod)
                                <div class="product">
                                    <figure class="product-image-container">
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img class="xzoom5" id="xzoom-magnific"
                  src="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                  xoriginal="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                
                />
                                </a>
                                       
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">{{$langg->lang55}}</a>
                                       
                                    </figure>
                                    <div class="product-details">
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
                                           
                                              <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                    <button onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction add-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal">
                                        <span>{{$langg->lang56}}</span>
                                    </button>
                                    @endif
                                            <!--<a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="paction add-cart" title="{{$langg->lang56}}">-->
                                            <!--    <span>{{$langg->lang56}}</span>-->
                                            <!--</a>-->

                                            <a  class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}" title="{{$langg->lang909}}">
                                              <span>{{$langg->lang909}}</span>
                                           </a> 
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                               @endforeach
                               
                            </div><!-- End .products-carousel -->

                        <div class="banners-group">
                                <div class="row row-sm">
                                    @if(!empty($bottom_small_banners[5]))
                                    <div class="col-lg-12 mx-auto">
                                        
                                        <div class="banner banner-image banner-botm">
                                            <a href="{{$bottom_small_banners[5]->link}}">
                                                <img src="{{asset('assets/images/banners/'.$bottom_small_banners[5]->photo)}}" alt="banner">
                                            </a>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-6 -->
                                   @endif
                                        
                                </div><!-- End .row -->
                            </div><!-- End .banners-group -->
                        </div><!-- End .category-section -->
                        @endif
                        
                      
                      
                         @if($ps->hot_sale ==1)
                        <div id="cat-7" class="category-section">
                            <div class="category-title">
                              <h2>{{ $langg->lang33}}</h2>
                               <a href="{{ route('front.products',$sign) }}" class="btn btn-outline-primary">See more</a>
                            </div><!-- End .category-title -->


                            <div class="products-carousel owl-carousel owl-theme">
                              
                              
                               @foreach($trending_products as $prod)
                                <div class="product">
                                    <figure class="product-image-container">
                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img class="xzoom5" id="xzoom-magnific"
                  src="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                  xoriginal="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                
                />
                                </a>
                                       
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">{{$langg->lang55}}</a>
                                       
                                    </figure>
                                    <div class="product-details">
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
                                           
                                              <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                    <button onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction add-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal">
                                        <span>{{$langg->lang56}}</span>
                                    </button>
                                    @endif
                                            
                                            <!--<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}" class="paction add-cart" title="{{$langg->lang56}}">-->
                                            <!--    <span>{{$langg->lang56}}</span>-->
                                            <!--</a>-->

                                            <a  class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}" title="{{$langg->lang909}}">
                                              <span>{{$langg->lang909}}</span>
                                           </a> 
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                               @endforeach
                               
                            </div><!-- End .products-carousel -->

                            <div class="banners-group">
                                <div class="row row-sm">
                                    @if(!empty($bottom_small_banners[6]))
                                    <div class="col-lg-12 mx-auto">
                                        
                                        <div class="banner banner-image banner-botm">
                                            <a href="{{$bottom_small_banners[6]->link}}">
                                                <img src="{{asset('assets/images/banners/'.$bottom_small_banners[6]->photo)}}" alt="banner">
                                            </a>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-6 -->
                                   @endif
                                </div><!-- End .row -->
                            </div><!-- End .banners-group -->
                        </div><!-- End .category-section -->
                        @endif
                        
                        
                        @if($ps->flash_deal  == 1)
                        <div id="cat-8" class="category-section">
                            <div class="category-title">
                              <h2>{{ $langg->lang244}}</h2>
                               <a href="{{ route('front.products',$sign) }}" class="btn btn-outline-primary">See more</a>
                            </div><!-- End .category-title -->


                            <div class="products-carousel owl-carousel owl-theme">
                              
                              
                               @foreach($discount_products as $prod)
                                <div class="product">
                                    <figure class="product-image-container">
                                       <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img class="xzoom5" id="xzoom-magnific"
                  src="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                  xoriginal="{{filter_var($prod->photo, FILTER_VALIDATE_URL) ?$prod->photo:asset('assets/images/products/'.$prod->photo)}}"
                
                />
                                </a>
                                       
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">{{$langg->lang55}}</a>
                                       
                                    </figure>
                                    <div class="product-details">
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
                                           
                                              <a href="javascript:;" data-href="{{ route('user-wishlist-add',$prod->id) }}" class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                    <button onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction add-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal">
                                        <span>{{$langg->lang56}}</span>
                                    </button>
                                    @endif
                                            <!--<a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}" class="paction add-cart" title="{{$langg->lang56}}">-->
                                            <!--    <span>{{$langg->lang56}}</span>-->
                                            <!--</a>-->

                                            <a  class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}" title="{{$langg->lang909}}">
                                              <span>{{$langg->lang909}}</span>
                                           </a> 
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                               @endforeach
                               
                            </div><!-- End .products-carousel -->

                           <div class="banners-group">
                                <div class="row row-sm">
                                    
                                      @if(!empty($bottom_small_banners[7]))
                                    <div class="col-lg-12 mx-auto">
                                        
                                        <div class="banner banner-image banner-botm">
                                            <a href="{{$bottom_small_banners[7]->link}}">
                                                <img src="{{asset('assets/images/banners/'.$bottom_small_banners[7]->photo)}}" alt="banner">
                                            </a>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-6 -->
                                   @endif
                                    
                                </div><!-- End .row -->
                            </div><!-- End .banners-group -->
                        </div><!-- End .category-section -->
                        @endif
                        
                    </div><!-- End .container-fluid -->
                </div><!-- End .main-content -->
            </div><!-- End .main-container -->
        </main><!-- End .main -->
        <!-- Modal -->
@include('load.view-product-model')
        <!-- Button trigger modal -->
   @section('scripts')
   <script>
   
  $(document).ready(function() {
    $('#close-button11').click(function() {
      $('#staticBackdrop').hide();
    });
  });
</script>
	<script>
        $('.view-product-modal').on('click', function() {
  // Get the ID of the clicked button
  var productId = $(this).attr('id');
  var lang = $(this).attr('name');
 console.log('bbhh',productId,lang);
  // Send an AJAX request to retrieve the product data
  $.ajax({
    url: '/items/view/' + productId,
    method: 'GET',
    success: function(data) {
        console.log(data);
      // Display the product data in the modal
    //   $('#modal-title').html(data.title);
    //   $('#modal-description').html(data.description);
    //   $('#modal-image').attr('src', data.image);
    //   $('#product-modal').modal('show');
    },
    error: function() {
      alert('Error retrieving product data');
    }
  });
});


</script>
<script>
	
	$(document).ready(function() {
  $('#carouselExampleIndicators').carousel({
    interval: 2000
  });
});
</script>
	
@endsection
