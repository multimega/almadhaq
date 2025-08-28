@php 


$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$main=App\Models\Generalsetting::find(1);
$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);
$blogs = DB::table('blogs')->get();
@endphp
      

        <main class="main">
            <div class="home-top-container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="home-slider owl-carousel owl-carousel-lazy">
                                    @if($ps->slider == 1)
				                    @if(count($sliders))
				                	@foreach($sliders as $data)
                                <div class="home-slide">
                                    <img class="owl-lazy" src="{{asset('assets/images/sliders/'.$data->photo)}}" data-src="{{asset('assets/images/sliders/'.$data->photo)}}"  alt="slider image">
                                    <div class="home-slide-content">
                                        	<h1 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}"> 
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
                                                   @endif</h1>
                                           <h4 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">  @if(!$slang)
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
                                           @endif</h4>     
                                        <a href="{{$data->link}}" class="btn btn-secondary">{{ $langg->lang25 }} </a>
                                    </div>
                                </div>
                                   @endforeach
                                   @endif
                                   @endif
                            </div><!-- End .home-slider -->
                        </div><!-- End .col-lg-8 -->

                        <div class="col-lg-4 top-banners">
                            @if(!empty($top_small_banners[0]->link))
                            <div class="banner banner-image">
                                <a href="{{$top_small_banners[0]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[0]->photo)}}"  alt="banner">
                                </a>
                            </div><!-- End .banner -->
                           @endif
  
                            @if(!empty($top_small_banners[1]->link))
                            <div class="banner banner-image">
                                <a href="{{$top_small_banners[1]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[1]->photo)}}"  alt="banner">
                                </a>
                            </div><!-- End .banner -->
                           @endif
                           
                            @if(!empty($top_small_banners[2]->link))
 
                            <div class="banner banner-image">
                                <a href="{{$top_small_banners[2]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[2]->photo)}}"  alt="banner">
                                </a>
                            </div><!-- End .banner -->
                            @endif
                            
                        </div><!-- End .col-lg-4 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .home-top-container -->

         
             @if($ps->service ==1)
            <div class="info-boxes-container">
                <div class="container">
                    @foreach($chunk as $service) 
                        <div class="info-box">
                          <img class="mx-2" src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">
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
                                          @endif</h4>
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
                          @endforeach 
                </div><!-- End .container -->
            </div><!-- End .info-boxes-container -->
           @endif
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="home-product-tabs">
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
                                    <a class="nav-link" id="hot-products-tab" data-toggle="tab" href="#hot-products" role="tab" aria-controls="hot-products" aria-selected="true">{{ $langg->lang32 }}</a>
                                </li>
                                @endif
                                
                                @if($ps->hot_sale == 1)
                                <li class="nav-item">
                                    <a class="nav-link" id="trending-products-tab" data-toggle="tab" href="#trending-products" role="tab" aria-controls="trending-products" aria-selected="true">{{ $langg->lang33}}</a>
                                </li>
                                @endif
                                
                                @if($ps->flash_deal == 1)
                                 <li class="nav-item">
                                    <a class="nav-link" id="flash-products-tab" data-toggle="tab" href="#flash-products" role="tab" aria-controls="flash-products" aria-selected="true">{{ $langg->lang244 }}</a>
                                </li>
                                @endif
                            </ul>
                            <div class="tab-content">
                             @if($ps->featured == 1)
                                 <div class="tab-pane fade show active" id="featured-products" role="tabpanel" aria-labelledby="featured-products-tab">
                                     <div class="row row-sm">
                                          @foreach($feature_products as $prod)
                                        <div class="col-6 col-md-4">
                                            <div class="product-default mb-4">
                                                <figure>
                                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"  @if(!$slang)
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
                                                        @if(!Auth::guard('web')->check())
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
                                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    
                                                    <div class="price-box">
                                                       <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                       <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                                    </div><!-- End .price-box -->
                                                      <div class="product-action">
                                                      
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
                                                </div><!-- End .product-details -->
                                            </div>
                                        </div><!-- End .col-md-4 -->
                                        @endforeach
                                        
                                    </div><!-- End .row -->
                                </div><!-- End .tab-pane -->
                                @endif
                                
                                
                               @if($ps->best ==1)
                                <div class="tab-pane fade" id="best-products" role="tabpanel" aria-labelledby="best-products-tab">
                                    <div class="row row-sm">
                                       @foreach($best_products as $prod)
                                        <div class="col-6 col-md-4">
                                            <div class="product-default mb-4">
                                                <figure>
                                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"  @if(!$slang)
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
                                                        @if(!Auth::guard('web')->check())
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
                                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    
                                                    <div class="price-box">
                                                       <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                       <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                                    </div><!-- End .price-box -->
                                                      <div class="product-action">
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
                                                </div><!-- End .product-details -->
                                            </div>
                                        </div><!-- End .col-md-4 -->
                                        @endforeach
                                        
                                    </div><!-- End .row -->
                                </div><!-- End .tab-pane -->
                                @endif
                                @if($ps->top_rated == 1)
                                
                                <div class="tab-pane fade" id="top-products" role="tabpanel" aria-labelledby="top-products-tab">
                                    <div class="row row-sm">
                                       @foreach($top_products as $prod)
                                        <div class="col-6 col-md-4">
                                            <div class="product-default mb-4">
                                                <figure>
                                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"  @if(!$slang)
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
                                                        @if(!Auth::guard('web')->check())
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
                                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    
                                                    <div class="price-box">
                                                       <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                       <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                                    </div><!-- End .price-box -->
                                                      <div class="product-action">
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
                                                </div><!-- End .product-details -->
                                            </div>
                                        </div><!-- End .col-md-4 -->
                                        @endforeach
                                        
                                    </div><!-- End .row -->
                                </div><!-- End .tab-pane -->
                                @endif
                                
                                
                                @if($ps->big ==1)
                                <div class="tab-pane fade" id="big-products" role="tabpanel" aria-labelledby="big-products-tab">
                                    <div class="row row-sm">
                                       @foreach($big_products as $prod)
<div class="col-6 col-md-4">
                                            <div class="product-default mb-4">
                                                <figure>
                                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"  @if(!$slang)
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
                                                        @if(!Auth::guard('web')->check())
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
                                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    
                                                    <div class="price-box">
                                                       <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                       <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                                    </div><!-- End .price-box -->
                                                      <div class="product-action">
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
                                                </div><!-- End .product-details -->
                                            </div>
                                        </div><!-- End .col-md-4 -->
                                        @endforeach
                                        
                                    </div><!-- End .row -->
                                </div><!-- End .tab-pane -->
                                @endif
                                @if($ps->hot_sale == 1)
                                <div class="tab-pane fade" id="new-products" role="tabpanel" aria-labelledby="new-products-tab">
                                    <div class="row row-sm">
                                       @foreach($latest_products as $prod)
                                        <div class="col-6 col-md-4">
                                            <div class="product-default mb-4">
                                                <figure>
                                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"  @if(!$slang)
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
                                                        @if(!Auth::guard('web')->check())
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
                                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    
                                                    <div class="price-box">
                                                       <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                       <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                                    </div><!-- End .price-box -->
                                                      <div class="product-action">
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
                                                </div><!-- End .product-details -->
                                            </div>
                                        </div><!-- End .col-md-4 -->
                                        @endforeach
                                    </div><!-- End .row -->
                                </div><!-- End .tab-pane -->
                                @endif
                                @if($ps->hot_sale == 1)
                                <div class="tab-pane fade" id="hot-products" role="tabpanel" aria-labelledby="hot-products-tab">
                                    <div class="row row-sm">
                                       @foreach($hot_products as $prod)
                                        <div class="col-6 col-md-4">
                                            <div class="product-default mb-4">
                                                <figure>
                                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"  @if(!$slang)
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
                                                        @if(!Auth::guard('web')->check())
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
                                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    
                                                    <div class="price-box">
                                                       <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                       <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                                    </div><!-- End .price-box -->
                                                      <div class="product-action">
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
                                                </div><!-- End .product-details -->
                                            </div>
                                        </div><!-- End .col-md-4 -->
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                        
                                @if($ps->hot_sale == 1)
                                <div class="tab-pane fade"  id="trending-products" role="tabpanel" aria-labelledby="trending-products-tab">
                                    <div class="row row-sm">
                                       @foreach($trending_products as $prod)
                                        <div class="col-6 col-md-4">
                                            <div class="product-default mb-4">
                                                <figure>
                                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"  @if(!$slang)
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
                                                        @if(!Auth::guard('web')->check())
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
                                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    
                                                    <div class="price-box">
                                                       <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                       <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                                    </div><!-- End .price-box -->
                                                      <div class="product-action">
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
                                                </div><!-- End .product-details -->
                                            </div>
                                        </div><!-- End .col-md-4 -->
                                        @endforeach
                                        
                                    </div><!-- End .row -->
                                </div><!-- End .tab-pane -->
                                @endif
                        
                                @if($ps->flash_deal  == 1)
                                <div class="tab-pane fade"  id="flash-products" role="tabpanel" aria-labelledby="flash-products-tab">
                                    <div class="row row-sm">
                                       @foreach($discount_products as $prod)
                                        <div class="col-6 col-md-4">
                                            <div class="product-default mb-4">
                                                <figure>
                                                      <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;"  @if(!$slang)
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
                                                        @if(!Auth::guard('web')->check())
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
                                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    
                                                    <div class="price-box">
                                                       <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                       <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                                    </div><!-- End .price-box -->
                                                      <div class="product-action">
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
                                                </div><!-- End .product-details -->
                                            </div>
                                        </div><!-- End .col-md-4 -->
                                        @endforeach
                                        
                                    </div><!-- End .row -->
                                </div><!-- End .tab-pane -->
                                @endif
                            </div><!-- End .tab-content -->
                        </div><!-- End .home-product-tabs -->

                        <div class="banners-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="banner banner-image">
                                        <a href="{{$fix_banners[0]->link}}">
                                            <img src="{{asset('assets/images/banners/'.$fix_banners[0]->photo)}}"  style="width:100%; height:107px;" alt="banner">
                                        </a>
                                    </div><!-- End .banner -->

                                    <div class="banner banner-image">
                                        <a href="{{$fix_banners[0]->link}}">
                                            <img src="{{asset('assets/images/banners/'.$fix_banners[0]->photo)}}" style="width:100%; height:107px;" alt="banner">
                                        
                                    </div><!-- End .banner -->

                                </div><!-- End .col-md-4 -->

                                <div class="col-md-8">
                                     <div class="banner banner-image">
                                       <a href="{{$fix_banners[0]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$fix_banners[0]->photo)}}" style="width:100%; height:223px;" alt="banner">
                                </a>
                                  </div><!-- End .banner -->
                                </div><!-- End .col-md-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .banners-group -->
                    </div><!-- End .col-lg-9 -->

                            <aside class="sidebar-home col-lg-3">
                                <div class="widget widget-cats">
                                    <h3 class="widget-title">{{$langg->lang14}}</h3>
                                      <ul class="catAccordion">
                                            @if(isset($categories))
                                            @foreach($categories as $data) 
                                         <li> <a href="{{ route('front.category', ['category' => $data->slug , 'lang' => $sign]) }}">
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
                                               @endif</a>

                                        @if(count($data->subs) > 0 )   
                                      <button class="accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#accordion-ul-{{$data->id}}" aria-expanded="false" aria-controls="accordion-ul-{{$data->id}}"></button>
                                      <ul class="collapse" id="accordion-ul-{{$data->id}}">
                                           @foreach($data->subs as $subcat)
                                        <li> <a  href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug,'lang'=>$sign])}}">
        
                                                                        
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
                                    @endif
                                
                                </ul>
                                  
                            </div>
                            <div class="widget widget-banners px-5 pb-3 text-center">
    							<div class="banners-slider owl-carousel owl-theme owl-loaded dots-small">
    								@foreach($fix_banners as $banner)
    								<div class="banner d-flex flex-column align-items-center">
    								    <img src="{{('assets/images/banners/'.$banner->photo)}}">
    									<!--<h3 class="badge-sale bg-secondary d-flex flex-column align-items-center justify-content-center text-uppercase"><em class="pt-3 ls-0"></h3>-->
    									<h4 class="sale-text font1 text-uppercase m-b-3">
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
    									</h4>
    									<p>
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
    									</p>
    									<a href="{{$banner->link}}" class="btn btn-primary btn-md font1">{{ $langg->lang25 }}</a>
    								</div><!-- End .banner -->
    								@endforeach
    							</div><!-- End .banner-slider -->
    						</div><!-- End .widget -->
    
    						
                    	
                    	<div class="widget widget-widget widget-posts post-date-in-medialetters bg-gray text-center">
							<h3 class="widget-title text-uppercase">{{$langg->newsletter}}</h3>
							<p class="mb-2">  @if(!$slang)
                                                          @if($lang->id == 2)
                                                          {!!$gs->subscribee_message_ar!!}
                                                          @else 
                                                          
                                                          {!!$gs->subscribee_message!!}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          {!!$gs->subscribee_message_ar!!}
                                                          @else
                                                           {!!$gs->subscribee_message!!}
                                                          @endif
                                                      @endif</p>
						                 
						                 
						                      <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST" >
                                <div class="form-group">
                                    {{csrf_field()}}
                              
                                <input type="email" class="form-control" name="email" id="email" required="" placeholder="{{ $langg->lang49 }}">
                                
                                  
                                </div><!-- Endd .form-group -->
                              
                              <input type="submit" class="btn btn-dark btn-md"   value = "{{ ($langg->rtl != '1')  ?    'Subscribe Now' :  'ابدأ' }}">

                            </form>
						</div><!-- End .widget -->

					
					
					
					        	<div class="widget widget-testimonials">
							<div class="testimonial-slider owl-carousel owl-loaded owl-theme dots-left">
							
							
							     @foreach($reviews as $data )
							      	
							      	
							      	   <div class="testimonial">
									<div class="testimonial-owner">
										<figure>
											<img src="{{asset('assets/images/reviews/'.$data->photo)}}" alt="client">
										</figure>

										<div>
											<h4 class="testimonial-title"> @if(!$slang)
                                                          @if($lang->id == 2)
                                                         {!! $data->title_ar !!}
                                                          @else 
                                                          
                                                         {!! $data->title !!}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {!! $data->title_ar !!}
                                                          @else
                                                          {!! $data->title !!}
                                                          @endif
                                                      @endif</h4>
											<span> @if(!$slang)
                                                          @if($lang->id == 2)
                                                         {!! $data->subtitle_ar !!}
                                                          @else 
                                                          
                                                         {!! $data->subtitle !!}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {!! $data->subtitle_ar !!}
                                                          @else
                                                          {!! $data->subtitle !!}
                                                          @endif
                                                      @endif</span>
										</div>
									</div><!-- End .testimonial-owner -->

									<blockquote class="ml-4 pr-0">
										<p>@if(!$slang)
                                                          @if($lang->id == 2)
                                                         {!! $data->details_ar !!}
                                                          @else 
                                                          
                                                         {!! $data->details !!}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {!! $data->details_ar !!}
                                                          @else
                                                          {!! $data->details !!}
                                                          @endif
                                                      @endif</p>
									</blockquote>
								</div><!-- End .testimonial -->
								
								@endforeach

							
							</div><!-- End .testimonials-slider -->
						</div><!-- End .widget -->
						

						<div class="widget widget-posts post-date-in-media">
							<div class="blog-slider owl-carousel owl-theme owl-loaded dots-left dots-m-0" data-owl-options="{
								'margin': 20
							}">
							
							
							 
							   @foreach($blogs as $blog)
								<article class="post">
                                    <div class="post-media">
                                        <a href="single.html">
                                            <img src="{{asset('assets/images/blogs/'.$blog->photo)}}" alt="Post">
                                        </a>
										<!--<div class="post-date">-->
										<!--	<span class="day">{{$blog->created_at}}</span>-->
										
										<!--</div>-->
                                    </div><!-- End .post-media -->

                                    <div class="post-body">
                                        <h2 class="post-title mt-2 m-b-2">
                                            <a href="{{route('front.blogshow',['id' => $blog->id , 'lang' => $sign ])}}"> @if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $blog->title_ar }}
                                              @else 
                                             {{ $blog->title }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                                {{ $blog->title_ar }}
                                              @else
                                              {{ $blog->title }}
                                              @endif
                                               @endif </a>
                                        </h2>

                                        <div class="post-content">
                                            <p>@if(!$slang)
                                              @if($lang->id == 2)
                                              {!! substr($blog->details_ar,0,100) !!}
                                              @else 
                                             {!! substr($blog->details,0,100) !!}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                                {!! substr($blog->details_ar,0,100) !!}
                                              @else
                                              {!! substr($blog->details,0,100)!!}
                                              @endif
                                               @endif </p>

                                            <a href="{{route('front.blogshow',['id' => $blog->id , 'lang' => $sign ])}}" class="read-more">{{ $langg->lang34 }} <i class="icon-right-open"></i></a>
                                        </div><!-- End .post-content -->
                                    </div><!-- End .post-body -->
								</article>
								@endforeach

							
							</div><!-- End .posts-slider -->
						</div><!-- End .widget -->
                        
                        
                    </aside><!-- End .col-lg-3 -->    
                </div><!-- End .row -->
            </div>

            <div class="mb-4"></div>
            <h2  style="text-align:center;">{{ $langg->lang236 }}</h2>
            
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
        </main><!-- End .main -->
