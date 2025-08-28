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
                <section>
                    <div class="row row-sm grid">
                        <div class="col-md-8 grid-item height-x1">
                            <div class="home-banner">
                                @if($ps->slider == 1)
                                <figure>
                                    <img src="assets/images/sliders/{{$sliders[0]->photo}}">
                                </figure>
                                <div class="banner-content content-right-bottom">
                                    <!--<span class="span-box span-primary">50% off</span>-->
                                    <h3 style="color: {{$sliders[0]->title_color}};">
                                     @if(!$slang)
    								    @if($lang->id == 2)
                                     {{$sliders[0]->title_text_ar}}
                                      @else 
                                      {{$sliders[0]->title_text}}
                                      @endif 
                                    @else  
                                      @if($slang == 2) 
                                      {{$sliders[0]->title_text_ar}}
                                      @else
                                      {{$sliders[0]->title_text}}
                                      @endif
                                    @endif
                                    </h3>
                                    <div class="price-box">
                                        <!--<span class="old-price">$59</span>-->
                                        <span class="product-price" style="color: {{$sliders[0]->subtitle_color}};">
                                        @if(!$slang)
                                            @if($lang->id == 2)
                                                 {{$sliders[0]->subtitle_text}}
                                            @else 
                                                  {{$sliders[0]->subtitle_text}}
                                            @endif 
                                        @else  
                                            @if($slang == 2) 
                                                {{$sliders[0]->subtitle_text}}
                                            @else
                                                {{$sliders[0]->subtitle_text}}
                                            @endif
                                      @endif
                                        </span>
                                    </div>
                                    <button class="btn"><a href="{{$sliders[0]->link}}">
                                        
                                         @if(!$slang)
                                        @if($lang->id == 2)
                                         {{ $sliders[0]->btn_text_ar }}
                                          @else 
                                          {{ $sliders[0]->btn_text }}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {{ $sliders[0]->btn_text_ar }}
                                          @else
                                          {{ $sliders[0]->btn_text }}
                                          @endif
                                          @endif
                                        
                                    </a></button>
                                </div>
                                @endif
                            </div>
                        </div>
                        @if($ps->small_banner == 1)
                        @foreach( $top_small_banners as $data) 
                        <div class="col-sm-6 col-md-4 grid-item height-x2">
                            <div class="home-banner">
                                <figure>
                                    <img src="{{asset('assets/images/banners/'.$data->photo)}}">
                                </figure>
                                <div class="banner-content content-right-bottom">
                                    <span>
                                        @if(!$slang)
                                        @if($lang->id == 2)
                                         {!!$data->title_ar!!}
                                          @else 
                                          {!!$data->title!!}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {!!$data->title_ar!!}
                                          @else
                                          {!!$data->title!!}
                                          @endif
                                          @endif
                                    </span>
                                    <h3>
                                    @if(!$slang)
                                      @if($lang->id == 2)
                                     {!!$data->subtitle_ar!!}
                                      @else 
                                      {{$data->subtitle}}
                                      @endif 
                                        @else  
                                      @if($slang == 2) 
                                      {!!$data->subtitle_ar!!}
                                      @else
                                      {!!$data->subtitle!!}
                                      @endif
                                       @endif
                                    </h3>
                                    @if(!empty($data->link)) 
                                    <button class="btn">
                                    <a href="{{$data->link}}">
									      @if(!$slang)
                                          @if($lang->id == 2)
                                         {!!$data->btn_ar!!}
                                          @else 
                                          {!!$data->button!!}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {!!$data->btn_ar!!}
                                          @else
                                          {!!$data->button!!}
                                          @endif
                                       @endif
								    </a>
								    </button>
									@endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </section>

                <section class="service-section mt-1 mb-3">
                    @foreach($chunk as $service )
                    <div class="col-lg-3">
                        <div class="service-widget">
                            <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">
                            <div class="service-content">
                                <h3 class="service-title">@if(!$slang) 
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
                                          @endif</h3>
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
            </div>
            @if($ps->featured ==1)
            <div style="background-image: url('assets/images/banners/home_banner4.jpg'); background-repeat: no-repeat; background-size: cover; padding: 7rem 0 1rem;">
                <div class="container">
                    <section class="product-panel">
                        <div class="section-title">
                            <h2>{{ $langg->lang26}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{$langg->lang25}}<i class="icon-right"></i></a>
                        </div>

                        <div class="row row-sm">
                            @foreach($feature_products as $prod)
                            <div class="col-6 col-md-3">   
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
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
                            </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
            @endif
            @if($ps->top_rated ==1)
            <div style="background-image: url('assets/images/banners/home_banner4.jpg'); background-repeat: no-repeat; background-size: cover; padding: 7rem 0 1rem;">
                <div class="container">
                    <section class="product-panel">
                        <div class="section-title">
                            <h2>{{ $langg->lang28}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{$langg->lang25}}<i class="icon-right"></i></a>
                        </div>

                        <div class="row row-sm">
                            @foreach($top_products as $prod)
                            <div class="col-6 col-md-3">   
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
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
                            </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
            @endif
            @if($ps->best ==1)
            <div style="background-image: url('assets/images/banners/home_banner4.jpg'); background-repeat: no-repeat; background-size: cover; padding: 7rem 0 1rem;">
                <div class="container">
                    <section class="product-panel">
                        <div class="section-title">
                            <h2>{{ $langg->lang27}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{$langg->lang25}}<i class="icon-right"></i></a>
                        </div>

                        <div class="row row-sm">
                            @foreach($best_products as $prod)
                            <div class="col-6 col-md-3">   
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
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
                            </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
            @endif
            @if($ps->big ==1)
            <div style="background-image: url('assets/images/banners/home_banner4.jpg'); background-repeat: no-repeat; background-size: cover; padding: 7rem 0 1rem;">
                <div class="container">
                    <section class="product-panel">
                        <div class="section-title">
                            <h2>{{ $langg->lang29}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{$langg->lang25}}<i class="icon-right"></i></a>
                        </div>

                        <div class="row row-sm">
                            @foreach($best_products as $prod)
                            <div class="col-6 col-md-3">   
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
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
                            </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
            @endif
            <div class="container">
                @if(!empty($fix_banners[0]))
                <section>
                    <div class="home-banner2 mt-4 mb-3">
                        <div class="col-lg-4 banner-background" style="background-image: url('{{('assets/images/banners/'.$fix_banners[0]->photo)}}');">
                        </div>
                        <div class="col-lg-5 mr-4">
                            <h3>
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
                            </h3>
                            <p>
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
                            </p>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{$fix_banners[0]->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                        </div>
                    </div>
                </section>
                @endif
                
                @if($ps->hot_sale ==1)
                <section class="product-panel bar-bottom">
                    <div class="section-title">
                        <h2>{{$langg->lang33}}</h2>
                        <a href="{{ route('front.products',$sign) }}">{{$langg->lang25}}<i class="icon-right"></i></a>
                    </div>

                    <div class="row row-sm grid">
                        <div class="grid-item col-sm-6 col-lg-4 height-xxl">
                            <div class="product-slider owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                                'items' : 1,
                                'nav' : false,
                                'dots' : true,
                                'margin' : 0
                            }">
                                <?php $i=0; ?>
                                @foreach($sale_products as $prod)
                                @if($i<3)
                                <div class="product-default inner-quickview inner-icon center-details">
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
                                            <span>{{ $langg->lang54 }}</span>
                                            </a>
                                            @endif
                                        </div>
                                        <h2 class="product-title" style="overflow:hidden;width:100%">
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
                                <?php $i++ ?>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @foreach($sale_products as $prod)
                        <div class="grid-item col-6 col-sm-3 col-lg-2 height-xl">
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
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
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif

                @if($ps->hot_sale ==1)
                <section class="product-panel bar-bottom">
                    <div class="section-title">
                        <h2>{{$langg->lang32}}</h2>
                        <a href="{{ route('front.products',$sign) }}">{{$langg->lang25}}<i class="icon-right"></i></a>
                    </div>

                    <div class="row row-sm grid">
                        <div class="grid-item col-sm-6 col-lg-4 height-xxl">
                            <div class="product-slider owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                                'items' : 1,
                                'nav' : false,
                                'dots' : true,
                                'margin' : 0
                            }">
                               <?php $i=0; ?>
                                @foreach($trending_products as $prod)
                                <?php if($i<3){ ?>
                                <div class="product-default inner-quickview inner-icon center-details">
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
                                            <span>{{ $langg->lang54 }}</span>
                                            </a>
                                            @endif
                                        </div>
                                        <h2 class="product-title" style="overflow:hidden;width:100%">
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
                                <?php $i++; }?>
                                
                                @endforeach
                    </div>
                    </div>
                        @foreach($trending_products as $prod)
                        <div class="grid-item col-6 col-sm-3 col-lg-2 height-xl">
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
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
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
    
                @if($ps->hot_sale ==1)
                <section class="product-panel bar-bottom">
                    <div class="section-title">
                        <h2>{{$langg->lang30}}</h2>
                        <a href="{{ route('front.products',$sign) }}">{{$langg->lang25}}<i class="icon-right"></i></a>
                    </div>

                    <div class="row row-sm grid">
                        <div class="grid-item col-sm-6 col-lg-4 height-xxl">
                            <div class="product-slider owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                                'items' : 1,
                                'nav' : false,
                                'dots' : true,
                                'margin' : 0
                            }">
                               <?php $i=0; ?>
                                @foreach($hot_products as $prod)
                                <?php if($i<3){ ?>
                                <div class="product-default inner-quickview inner-icon center-details">
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
                                            <span>{{ $langg->lang54 }}</span>
                                            </a>
                                            @endif
                                        </div>
                                        <h2 class="product-title" style="overflow:hidden;width:100%">
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
                                <?php $i++; }?>
                                
                                @endforeach
                    </div>
                    </div>
                        @foreach($hot_products as $prod)
                        <div class="grid-item col-6 col-sm-3 col-lg-2 height-xl">
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
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
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
                
                @if($ps->hot_sale ==1)
                <section class="product-panel bar-bottom">
                    <div class="section-title">
                        <h2>{{$langg->lang31}}</h2>
                        <a href="{{ route('front.products',$sign) }}">{{$langg->lang25}}<i class="icon-right"></i></a>
                    </div>

                    <div class="row row-sm grid">
                        <div class="grid-item col-sm-6 col-lg-4 height-xxl">
                            <div class="product-slider owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                                'items' : 1,
                                'nav' : false,
                                'dots' : true,
                                'margin' : 0
                            }">
                               <?php $i=0; ?>
                                @foreach($latest_products as $prod)
                                <?php if($i<3){ ?>
                                <div class="product-default inner-quickview inner-icon center-details">
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
                                            <span>{{ $langg->lang54 }}</span>
                                            </a>
                                            @endif
                                        </div>
                                        <h2 class="product-title" style="overflow:hidden;width:100%">
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
                                <?php $i++; }?>
                                
                                @endforeach
                    </div>
                    </div>
                        @foreach($latest_products as $prod)
                        <div class="grid-item col-6 col-sm-3 col-lg-2 height-xl">
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
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
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
                
                @if($ps->flash_deal ==1)
                <section class="product-panel bar-bottom">
                    <div class="section-title">
                        <h2>{{$langg->lang244}}</h2>
                        <a href="{{ route('front.products',$sign) }}">{{$langg->lang25}}<i class="icon-right"></i></a>
                    </div>

                    <div class="row row-sm grid">
                        <div class="grid-item col-sm-6 col-lg-4 height-xxl">
                            <div class="product-slider owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                                'items' : 1,
                                'nav' : false,
                                'dots' : true,
                                'margin' : 0
                            }">
                               <?php $i=0; ?>
                                @foreach($discount_products as $prod)
                                <?php if($i<3){ ?>
                                <div class="product-default inner-quickview inner-icon center-details">
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
                                            <span>{{ $langg->lang54 }}</span>
                                            </a>
                                            @endif
                                        </div>
                                        <h2 class="product-title" style="overflow:hidden;width:100%">
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
                                <?php $i++; }?>
                                
                                @endforeach
                    </div>
                    </div>
                        @foreach($discount_products as $prod)
                        <div class="grid-item col-6 col-sm-3 col-lg-2 height-xl">
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
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}" style="border:0;background:unset">
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
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif

    
                <section class="row row-sm pb-4">
                    @if(!empty($fix_banners[1]))
                    <div class="col-md-6">
                        <div class="home-banner">
                            <figure style="height: 400px;">
                                <img src="{{('assets/images/banners/'.$fix_banners[1]->photo)}}">
                            </figure>
                            <div class="banner-content content-right-bottom content-black">
                                <span>
                                    @if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$fix_banners[1]->title_ar!!}
                                          @else 
                                          {!!$fix_banners[1]->title!!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$fix_banners[1]->title_ar!!}
                                          @else
                                          {!!$fix_banners[1]->title!!}
                                          @endif
                                      @endif
                                </span>
                                <h3>
                                    @if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$fix_banners[1]->subtitle_ar!!}
                                          @else 
                                          {!!$fix_banners[1]->subtitle!!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$fix_banners[1]->subtitle_ar!!}
                                          @else
                                          {!!$fix_banners[1]->subtitle!!}
                                          @endif
                                      @endif
                                </h3>
                                <a href="{{$fix_banners[1]->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(!empty($fix_banners[2]))
                    <div class="col-md-6">
                        <div class="home-banner">
                            <figure style="height: 400px;">
                                <img src="{{('assets/images/banners/'.$fix_banners[2]->photo)}}">
                            </figure>
                            <div class="banner-content content-left-stretch content-white">
                                <span class="span-box span-primary">
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
                                          {!!$fix_banners[2]->subtitle!!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$fix_banners[2]->subtitle_ar!!}
                                          @else
                                          {!!$fix_banners[2]->subtitle!!}
                                          @endif
                                      @endif
                                </h3>
                                <a href="{{$fix_banners[2]->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                            </div>
                        </div>
                    </div>
                    @endif
                </section>
            </div>
        </main><!-- End .main -->