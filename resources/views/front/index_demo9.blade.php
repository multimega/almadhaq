
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
    .add-cart-box h4 {
        color: #7aa93c;
    }
    .add-cart-box .btn-actions button{
        border: 0;
        padding: 10px;
    }
</style>
<main class="main">
            <div class="home-slider-container">
                <div class="home-slider owl-carousel">
                    @if($ps->slider == 1)
    				   @if(count($sliders))
    					@foreach($sliders as $data)
                    <div class="home-slide">
                        <div class="slide-bg owl-lazy"  data-src="{{('assets/images/sliders/'.$data->photo)}}"></div><!-- End .slide-bg -->
                        <div class="home-slide-content container">
                            <div class="row">
                                <div class="col-md-6 offset-md-6 col-lg-5 offset-lg-7">
                                    <h4>
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
                                    </h4>
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
                                    <!--<h3>Only <strong>199 USD</strong></h3>-->
                                    @if(!empty($data->link)) 
                                         <a class="btn btn-primary" href="{{$data->link}}">{{ $langg->lang25 }}</a>
                                        @endif
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .home-slide-content -->
                    </div><!-- End .home-slide -->
                    @endforeach
                    @endif
                    @endif
                    
                </div><!-- End .home-slider -->
            </div><!-- End .home-slider-container -->

            @if($ps->service ==1)
            <div class="info-boxes-container">
                <div class="container">
                    <div class="row" style="width: 100%">
                    @foreach($chunk as $service) 
                    <div class="info-box col-lg-3 col-md-6">
                    
                    
                          <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">

                        <div class="info-box-content">
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
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                    @endforeach
                    </div>
                </div><!-- End .container -->
            </div><!-- End .info-boxes-container -->
            @endif
            <div class="home-product-tabs">
                <div class="container">
                    <ul class="nav nav-tabs" role="tablist">
                        @if($ps->featured ==1)
                                <li class="nav-item">
                                    <a class="nav-link active" id="featured-products-tab" data-toggle="tab" href="#featured-products" role="tab" aria-controls="featured-products" aria-selected="true">{{ $langg->lang26}}</a>
                                </li>
                                @endif
                                
                                @if($ps->best == 1)
                                <li class="nav-item">
                                    <a class="nav-link" id="best-products-tab" data-toggle="tab" href="#best-products" role="tab" aria-controls="best-products" aria-selected="false">{{ $langg->lang27}}</a>
                                </li>
                                @endif
                                  @if($ps->top_rated == 1)
                                 <li class="nav-item">
                                    <a class="nav-link"  id="top-products-tab" data-toggle="tab" href="#top-products" role="tab" aria-controls="top-products" aria-selected="true">	{{ $langg->lang28 }}</a>
                                </li>
                                @endif
                                @if($ps->big == 1)
                                 <li class="nav-item">
                                    <a class="nav-link" id="big-products-tab" data-toggle="tab" href="#big-products" role="tab" aria-controls="big-products" aria-selected="true">{{ $langg->lang29 }}</a>
                                </li>
                                @endif
                                
                                @if($ps->hot_sale == 1)
                                <li class="nav-item">
                                    <a class="nav-link"   id="new-products-tab" data-toggle="tab" href="#new-products" role="tab" aria-controls="new-products" aria-selected="true">{{ $langg->lang31 }}</a>
                                </li>
                                @endif
                                
                                @if($ps->hot_sale == 1)
                                <li class="nav-item">
                                    <a class="nav-link" id="hot-products-tab" data-toggle="tab" href="#hot-products" role="tab" aria-controls="hot-products" aria-selected="true">{{ $langg->lang33 }}</a>
                                </li>
                                @endif
                                
                                @if($ps->hot_sale == 1)
                                <li class="nav-item">
                                    <a class="nav-link" id="trending-products-tab" data-toggle="tab" href="#trending-products" role="tab" aria-controls="trending-products" aria-selected="true">{{ $langg->lang32}}</a>
                                </li>
                                @endif
                                
                                @if($ps->flash_deal == 1)
                                 <li class="nav-item">
                                    <a class="nav-link" id="flash-products-tab" data-toggle="tab" href="#flash-products" role="tab" aria-controls="flash-products" aria-selected="true">{{ $langg->lang244 }}</a>
                                </li>
                                @endif
                    </ul>
                </div><!-- End .container -->
                <div class="tab-content">
                    @if($ps->featured == 1)
                    <div class="tab-pane fade show active" id="featured-products" role="tabpanel" aria-labelledby="featured-products-tab">
                        <div class="container">
                            <div class="tab-products-carousel owl-carousel owl-theme">
                                @foreach($feature_products as $prod)
                                <div class="product-default">
                                    <figure>
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
                                    @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
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
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->

                                        <div class="product-action">
                                           @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                    <div class="product-single-qty">
										<input class="horizontal-quantity form-control" type="text">
									</div><!-- End .product-single-qty -->
                                 
                                 
                                 @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                       @endif
                                   

                                    <!--<a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">-->
                                    <!--    <span>{{ $langg->lang909 }}</span>-->
                                    <!--</a>-->
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endforeach
                            </div><!-- End .products-carousel -->
                        </div><!-- End .container -->
                    </div><!-- End .tab-pane -->
                    @endif
                    @if($ps->best == 1)
                    <div class="tab-pane fade" id="best-products" role="tabpanel" aria-labelledby="best-products-tab">
                        <div class="container">
                            <div class="tab-products-carousel owl-carousel owl-theme">
                                @foreach($best_products as $prod)
                                <div class="product-default">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">Quick View</a>
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
                                    <div class="product-single-qty">
										<input class="horizontal-quantity form-control" type="text">
									</div><!-- End .product-single-qty -->
                                    @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                       @endif
                                    <!--<a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">-->
                                    <!--    <span>{{ $langg->lang909 }}</span>-->
                                    <!--</a>-->
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endforeach
                            </div><!-- End .products-carousel -->
                        </div><!-- End .container -->
                    </div><!-- End .tab-pane -->
                    @endif
                    @if($ps->top_rated == 1)
                    <div class="tab-pane fade" id="top-products" role="tabpanel" aria-labelledby="top-products-tab">
                        <div class="container">
                            <div class="tab-products-carousel owl-carousel owl-theme">
                                @foreach($top_products as $prod)
                                <div class="product-default">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">Quick View</a>
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
                                    <div class="product-single-qty">
										<input class="horizontal-quantity form-control" type="text">
									</div><!-- End .product-single-qty -->
                                    @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                       @endif

                                    <!--<a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">-->
                                    <!--    <span>{{ $langg->lang909 }}</span>-->
                                    <!--</a>-->
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endforeach
                            </div><!-- End .products-carousel -->
                        </div><!-- End .container -->
                    </div><!-- End .tab-pane -->
                    @endif
                    @if($ps->big == 1)
                    <div class="tab-pane fade" id="big-products" role="tabpanel" aria-labelledby="big-products-tab">
                        <div class="container">
                            <div class="tab-products-carousel owl-carousel owl-theme">
                                @foreach($big_products as $prod)
                                <div class="product-default">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">Quick View</a>
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
                                    <div class="product-single-qty">
										<input class="horizontal-quantity form-control" type="text">
									</div><!-- End .product-single-qty -->
                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                       @endif
                                    <!--<a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">-->
                                    <!--    <span>{{ $langg->lang909 }}</span>-->
                                    <!--</a>-->
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endforeach
                            </div><!-- End .products-carousel -->
                        </div><!-- End .container -->
                    </div><!-- End .tab-pane -->
                    @endif
                    @if($ps->hot_sale == 1)
                    <div class="tab-pane fade" id="new-products" role="tabpanel" aria-labelledby="new-products-tab">
                        <div class="container">
                            <div class="tab-products-carousel owl-carousel owl-theme">
                                @foreach($latest_products as $prod)
                                <div class="product-default">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">Quick View</a>
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
                                    <div class="product-single-qty">
										<input class="horizontal-quantity form-control" type="text">
									</div><!-- End .product-single-qty -->
                                     @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                       @endif

                                    <!--<a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">-->
                                    <!--    <span>{{ $langg->lang909 }}</span>-->
                                    <!--</a>-->
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endforeach
                            </div><!-- End .products-carousel -->
                        </div><!-- End .container -->
                    </div><!-- End .tab-pane -->
                    @endif
                    @if($ps->hot_sale == 1)
                    <div class="tab-pane fade" id="hot-products" role="tabpanel" aria-labelledby="hot-products-tab">
                        <div class="container">
                            <div class="tab-products-carousel owl-carousel owl-theme">
                                @foreach($hot_products as $prod)
                                <div class="product-default">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">Quick View</a>
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
                                    <div class="product-single-qty">
										<input class="horizontal-quantity form-control" type="text">
									</div><!-- End .product-single-qty -->
                                     @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                       @endif

                                    <!--<a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">-->
                                    <!--    <span>{{ $langg->lang909 }}</span>-->
                                    <!--</a>-->
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endforeach
                            </div><!-- End .products-carousel -->
                        </div><!-- End .container -->
                    </div><!-- End .tab-pane -->
                    @endif
                    @if($ps->hot_sale == 1)
                    <div class="tab-pane fade" id="trending-products" role="tabpanel" aria-labelledby="trending-products-tab">
                        <div class="container">
                            <div class="tab-products-carousel owl-carousel owl-theme">
                                @foreach($trending_products as $prod)
                                <div class="product-default">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">Quick View</a>
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
                                    <div class="product-single-qty">
										<input class="horizontal-quantity form-control" type="text">
									</div><!-- End .product-single-qty -->
                                     @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                       @endif

                                    <!--<a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">-->
                                    <!--    <span>{{ $langg->lang909 }}</span>-->
                                    <!--</a>-->
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endforeach
                            </div><!-- End .products-carousel -->
                        </div><!-- End .container -->
                    </div><!-- End .tab-pane -->
                    @endif
                    @if($ps->flash_deal == 1)
                    <div class="tab-pane fade" id="flash-products" role="tabpanel" aria-labelledby="flash-products-tab">
                        <div class="container">
                            <div class="tab-products-carousel owl-carousel owl-theme">
                                @foreach($discount_products as $prod)
                                <div class="product-default">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview">Quick View</a>
                                        @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                                    </figure>
                                    <div class="product-details">
                                        <p class='flash-deal'> @if($langg->rtl == "1" ) مدة سريان العرض:  @else Discount ends date : @endif{{$prod->discount_date}}</p>
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
                                    <div class="product-single-qty">
										<input class="horizontal-quantity form-control" type="text">
									</div><!-- End .product-single-qty -->
                                     @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                          <a data-href="{{ route('product.cart.add',$prod->id) }}"  class="paction btn add-cart btn-add-cart add-to-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        <span>{{ $langg->lang56 }}</span>
                                    </a>
                                       @endif

                                    <!--<a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">-->
                                    <!--    <span>{{ $langg->lang909 }}</span>-->
                                    <!--</a>-->
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endforeach
                            </div><!-- End .products-carousel -->
                        </div><!-- End .container -->
                    </div><!-- End .tab-pane -->
                    @endif
                </div><!-- End .tab-content -->
            </div><!-- End .home-product-tabs -->

            <div class="container">
                <div class="row">
                    @foreach($chunk as $service)
                    <div class="col-md-3">
                        <div class="feature-box">
                       <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;margin:auto">

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
            </div><!-- End .container -->

            <div class="mb-1"></div><!-- margin -->

            <div class="promo-section" style="background-image: url('{{('assets/images/banners/'.$fix_banners[0]->photo)}}')">
                <div class="container">
                    <div class="banner-content row align-items-center text-center">
						<div class="col-md-5 col-lg-4 ml-xl-auto text-md-right">
							<h2 class="mb-md-0">{!!$fix_banners[0]->title!!}</h2>
						</div>
						<div class="col-md-3 pb-4 pb-md-0">
							<a href="{{$fix_banners[0]->link}}" class="btn btn-primary ls-10">{{ $langg->lang25 }}</a>
						</div>
						<div class="col-md-4 mr-xl-auto text-md-left">
							<h4 class="mb-1 coupon-sale-text p-0 d-block ls-10 text-transform-none">
								<b class="bg-dark text-white font1">{!!$fix_banners[0]->subtitle!!}</b>
							</h4>
							<h5 class="mb-2 coupon-sale-text ls-10 p-0"><i class="ls-0">UP TO</i><b class="text-white bg-secondary">$100</b> OFF</h5>
						</div>
					</div>
                </div><!-- End .container -->
            </div><!-- End .promo-section -->
    
            @if($ps->partners == 1)
            <div class="partners-container">
                <div class="container">
                    <div class="partners-carousel owl-carousel owl-theme">
                        @foreach($partners as $j)
                        <a href="#" class="partner">
                            <img src="{{asset('assets/images/partner/'.$j->photo)}}" style="width:100%; height:50px;" alt="logo">
                        </a>
                        @endforeach
                    </div><!-- End .partners-carousel -->
                </div><!-- End .container -->
            </div><!-- End .partners-container -->
            @endif
            <div class="container">
                <div class="row">
                    @if($ps->featured ==1)
                    <?php $i=0; ?>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="product-column">
                            <h3 class="h4 title">{{$langg->lang26}}</h3>
                            @foreach($feature_products as $prod)
                            <?php $i++; ?>
                            @if($i<4)
                            <div class="product product-sm">
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
                                </figure>
                                <div class="product-details">
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
                            @endif
                            @endforeach
                        </div><!-- End .product-column -->
                    </div><!-- End .col-lg-3 -->
                    @endif
                    @if($ps->hot_sale == 1)
                    <?php $i=0; ?>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="product-column">
                            <h3 class="h4 title">{{$langg->lang31}}</h3>
                            @foreach($latest_products as $prod)
                            <?php $i++; ?>
                            @if($i<4)
                            <div class="product product-sm">
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
                                </figure>
                                <div class="product-details">
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
                            @endif
                            @endforeach
                        </div><!-- End .product-column -->
                    </div><!-- End .col-lg-3 -->
                    @endif
                    @if($ps->hot_sale == 1)
                    <?php $i=0; ?>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="product-column">
                            <h3 class="h4 title">{{$langg->lang32}}</h3>
                            @foreach($trending_products as $prod)
                            <?php $i++; ?>
                            @if($i<4)
                            <div class="product product-sm">
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
                                </figure>
                                <div class="product-details">
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
                            @endif
                            @endforeach
                        </div><!-- End .product-column -->
                    </div><!-- End .col-lg-3 -->
                    @endif
                    @if($ps->hot_sale == 1)
                    <?php $i=0; ?>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="product-column">
                            <h3 class="h4 title">{{$langg->lang33}}</h3>
                            @foreach($sale_products as $prod)
                            <?php $i++; ?>
                            @if($i<4)
                            <div class="product product-sm">
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
                                </figure>
                                <div class="product-details">
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
                            @endif
                            @endforeach
                        </div><!-- End .product-column -->
                    </div><!-- End .col-lg-3 -->
                    @endif
                </div><!-- End .container -->
            </div><!-- End .container -->

            <div class="mb-6"></div><!-- margin -->
        </main><!-- End .main -->