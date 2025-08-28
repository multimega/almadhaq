@php 




$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp

<style>
.partners-panel .owl-carousel{
    position:relative !important;
}
.owl-carousel .owl-nav.disabled{
    display: block;
}
        @media only screen and (max-width:767px){
            .row.row-sm.grid.main-carousel{
                height:220px !important;
            }
            .carousel.slide{
                height:100% !important;
            }
        }
        
        .carousel.slide{
            height:520px;
            position:unset;
            width: 100%;
        }
        .carousel-inner,
        .carousel-item{
            height:97% !important
        }
        .carousel-caption{
            bottom:13%;
        }
        .carousel-caption h5{
            font-size:2.5rem;
        }
        
        .carousel-caption p{
            font-size:22px;
        }
        
        .custom-height{
            margin-top: 40px;
        }
</style>

        <main class="home main">
            <div class="container">
                <section>
                    <div class="row row-sm grid main-carousel" style="position:unset">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
      @if($ps->slider ==1)
      @foreach($sliders as $data)
    <div class="carousel-item" id="active-slider">
      <img src="{{('assets/images/sliders/'.$data->photo)}}" alt="...">
      <div class="carousel-caption d-block">
        <h5 style="color: {{$data->title_color}};">
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
          </h5>
          <p style="color: {{$data->details_color}};">
              @if(!$slang)
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
          @endif
              
          </p>
        <p style="color: {{$data->subtitle_color}};">
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
                                          @endif</p>
                                          <a class="btn btn-secondary" href="{{$data->link}}">{{ $langg->lang25 }}</a>
      </div>
    </div>
    @endforeach
    @endif
   
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                    </div>
                </section>

                <section class="mb-0">
                    <div class="row row-sm">
                        @if($ps->service ==1)
                        @foreach($chunk as $service )
                        <div class="col-md-6 col-lg-3">
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
                        @endif
                    </div>
                </section>

                <hr class="mt-0">

                <section style="position: relative;">
                    <div class="section-title">
                        <h2 class="mt-1 mb-1 mr-5">{{ $langg->lang940 }}</h2>
                        <a href="{{ route('front.products',$sign) }}" class="btn with-icon mt-1 mb-1">{{ $langg->lang25 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>

                    <div class="featured-section bg-white">
                        <ul class="nav nav-tabs filter-button-group" role="tablist" style="">
                            
                            <li class="nav-item">
                                <a class="nav-link active main-nav-link" data-filter=".grid-item">{{$langg->lang950}}</a>
                            </li>
                            
                            @if($ps->featured ==1)
                            <li class="nav-item">
                                <a class="nav-link" data-filter=".featured-products">{{ $langg->lang26}}</a>
                            </li>
                            @endif
                            @if($ps->best ==1)
                            <li class="nav-item">
                                <a class="nav-link" data-filter=".best-products">{{ $langg->lang27}}</a>
                            </li>
                            @endif
                            @if($ps->top_rated ==1)
                            <li class="nav-item">
                                <a class="nav-link" data-filter=".top-products">{{ $langg->lang28}}</a>
                            </li>
                            @endif
                            @if($ps->big ==1)
                            <li class="nav-item">
                                <a class="nav-link" data-filter=".big-products">{{ $langg->lang29}}</a>
                            </li>
                            @endif
                             @if($ps->hot_sale == 1)
                            <li class="nav-item">
                                <a class="nav-link" data-filter=".new-products">{{ $langg->lang31}}</a>
                            </li>
                            @endif
                            @if($ps->hot_sale ==1)
                            <li class="nav-item">
                                <a class="nav-link" data-filter=".hot-products">{{ $langg->lang32}}</a>
                            </li>
                            @endif
                            @if($ps->hot_sale ==1)
                            <li class="nav-item">
                                <a class="nav-link" data-filter=".trending-products">{{ $langg->lang33}}</a>
                            </li>
                            @endif
                            
                            @if($ps->flash_deal ==1)
                            <li class="nav-item">
                                <a class="nav-link" data-filter=".flash-products">{{ $langg->lang244}}</a>
                            </li>
                            @endif
                        </ul>
                        
                        <div class="row row-sm custom-height">
                            @if($ps->featured == 1)
                            @foreach($feature_products as $prod)
                            <div class="col-6 col-md-4 col-xl-5col grid-item featured-products">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{ $langg->lang55 }}">
                                         {{ $langg->lang55 }}
                                        </a> 
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
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @if($ps->best == 1)
                            @foreach($best_products as $prod)
                            <div class="col-6 col-md-4 col-xl-5col grid-item best-products">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">
                                           {{$langg->lang55}}
                                        </a> 
                                    </figure>
                                    <div class="product-details">
                                         <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                            </div>
                                 
																
						 		     	 
                                    @if(Auth::guard('web')->check())
									  <a   data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
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
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div>
                            @endforeach
                            @endif
                            
                            @if($ps->top_rated == 1)
                            @foreach($top_products as $prod)
                            <div class="col-6 col-md-4 col-xl-5col grid-item top-products">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                            </div>
                                             @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
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
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div>
                            @endforeach
                            @endif
                            
                            @if($ps->big == 1)
                            @foreach($big_products as $prod)
                            <div class="col-6 col-md-4 col-xl-5col grid-item big-products">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                            </div>
                                            @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
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
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div>
                            @endforeach
                            @endif
                            
                            @if($ps->hot_sale == 1)
                            @foreach($latest_products as $prod)
                            <div class="col-6 col-md-4 col-xl-5col grid-item new-products">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                                            </div>
                                        @if(Auth::guard('web')->check())
									  <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
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
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div>
                            @endforeach
                            @endif
                             
                            @if($ps->hot_sale == 1)
                            @foreach($trending_products as $prod)
                            <div class="col-6 col-md-4 col-xl-5col grid-item trending-products">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">
                                          {{$langg->lang55}}
                                        </a> 
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
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div>
                            @endforeach
                            @endif
                            
                            @if($ps->hot_sale == 1)
                            @foreach($hot_products as $prod)
                            <div class="col-6 col-md-4 col-xl-5col grid-item hot-products">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title=" {{$langg->lang55}}">
                                           {{$langg->lang55}}
                                        </a> 
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
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @if($ps->flash_deal == 1)
                            @foreach($discount_products as $prod)
                            <div class="col-6 col-md-4 col-xl-5col grid-item flash-products">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">
                                           {{$langg->lang55}}
                                        </a> 
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
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
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
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div><!-- End .tab-content -->
                        <div class="loadmore">
                            <a href="#" class="btn with-icon align-center grid-loadmore">{{$langg->lang952}}<i class="fas fa-long-arrow-alt-down"></i></a>
                        </div>
                    </div><!-- End .product-single-tabs -->
                </section>
            </div>
    
            @if(!empty($fix_banners[0]))
            <section>
                <div class="home-banner height-x3">
                    <figure>
                        <img src="{{asset('assets/images/banners/'.$fix_banners[0]->photo)}}">
                    </figure>
                    <div class="banner-content col-xl-11 full-content">
                        <div class="container">
                            <div class="left-content">
                                <div>
                                    <span>it is time for a</span>
                                    <h4>
                                        
                                          @if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$fix_banners[0]->title_ar!!}
                                          @else 
                                          {!! $fix_banners[0]->title!!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$fix_banners[0]->title_ar!!}
                                          @else
                                          {!! $fix_banners[0]->title !!}
                                          @endif
                                      @endif
                                                  
                    
                                       
                                        </h4>
                                </div>
                                <button class="btn"><a href="{{$fix_banners[0]->link}}" style="color:#fff !important">
                                    
                                     @if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$fix_banners[0]->btn_ar!!}
                                          @else 
                                          {!! $fix_banners[0]->button !!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$fix_banners[0]->btn_ar!!}
                                          @else
                                          {!! $fix_banners[0]->button !!}
                                          @endif
                                      @endif
                                    
                                </a> <i class="fas fa-long-arrow-alt-right"></i></button>
                            </div>
                            <div class="banner-info">
                                <a href="{{$fix_banners[0]->link}}" class="btn skew-box">   @if(!$slang)
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
                                      @endif</a>
                                <!--<h3 class="sale-off skew-box"><span>$200</span>off</h3>-->
                            </div>
                        </div>
                    </div>
                </div>   
            </section>
            @endif
            <section class="mb-6">
                <div class="container">
                    <div class="featured-section bg-white">
                        <div class="row row-sm">
                            @if($ps->featured == 1)
                            @foreach($feature_products as $prod)
                            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">
                                           {{$langg->lang55}}
                                        </a> 
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
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <a href="{{ route('front.products',$sign) }}" class="btn with-icon align-center">{{$langg->lang953}}<i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>

                    <hr>

                    <div class="row row-sm">
                        @if($ps->review_blog ==1)
                        <div class="col-xl-6">
                            <div class="section-title vertical-line mt-1 mb-1">
                                <h2>{{$langg->lang43}}</h2>
                                <hr class="vertical">
                                <a href="{{ route('front.blog',$sign) }}" class="with-icon">{{$langg->lang942}}<i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                            <div class="row row-sm banner-article">
                                
                                <?php $i=0; ?>
                                @foreach(DB::table('blogs')->orderby('id','desc')->take(2)->get() as $blogg)
                                <?php $i++ ?>
                                @if($i<2)
                                <div class="col-md-6">
                                    <figure>
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
                                        <div class="date-box">
                                            <h3 class="date-day">{{date('d', strtotime($blogg->created_at))}}</h3>
                                            <h4 class="date-month">{{date('m', strtotime($blogg->created_at))}}</h4>
                                        </div>
                                    </figure>
                                </div>
                                <div class="col-md-6">
                                    <div class="article-info">
                                        <!--<a href="#" class="article-category">DESIGN TRENDS</a>-->
                                        <h3 class="article-title">
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
                                        </h3>
                                        <p>
                                            @if(!$slang)
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
                                                  @endif 
                                        </p>
                                        <a href="{{route('front.blogshow',['id' => $blogg->id ,'lang'=> $sign ])}}" class="btn with-icon">{{ $langg->lang38 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <!--<div class="col-xl-6">-->
                        <!--    <div class="section-title vertical-line mt-1 mb-1">-->
                        <!--        <h2>FROM INSTAGRAM</h2>-->
                        <!--        <hr class="vertical">-->
                        <!--        <a href="#" class="with-icon">@VowalaaDECOR<i class="fas fa-long-arrow-alt-right"></i></a>-->
                        <!--    </div>-->
                        <!--    <div class="row row-sm">-->
                        <!--        <div class="col-sm-4 mt-2 mb-2">-->
                        <!--            <img src="assets/images/instagram/instagram1.jpg">-->
                        <!--        </div>-->
                        <!--        <div class="col-sm-4 mt-2 mb-2">-->
                        <!--            <img src="assets/images/instagram/instagram2.jpg">-->
                        <!--        </div>-->
                        <!--        <div class="col-sm-4 mt-2 mb-2">-->
                        <!--            <img src="assets/images/instagram/instagram3.jpg">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>

                </div>
            </section>
        </main><!-- End .main -->

        