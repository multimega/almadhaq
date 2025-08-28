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
</style>
        <main class="home main">
            <div class="top-slider owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                'items' : 1,
                'margin' : 0,
                'nav': true,
                'dots': false
            }">
                @foreach($sliders as $data)
                <div class="home-slide" style="background-image: url('assets/images/sliders/{{$data->photo}}');">
                    <div class="slide-content content-left">
                        <div class="divide-txt">
                            <span>
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
                            </span>
                            <div class="divide-line"></div>
                        </div>
                        <h2>
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
                        </h2>
                        <!--<h3>30% OFF</h3>-->
                        <div class="image-info-group">
                            <!--<h5>STARTING AT <span><sup>$</sup>39<sup>99</sup></span></h5>-->
                            <a href="{{$data->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <section class="service-section mb-5 no-border">
                
                @foreach($chunk as $service )
                <div class="col-sm-6 col-xl-3">
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

            <div class="container">
                <section class="mb-5 text-center">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span>{{ $langg->lang940 }}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">Amazing products added recently in our catalog</h3>
                    </div>

                    <div class="row row-sm text-left product-ajax-grid">
                        @foreach($feature_products as $prod)
                        <div class="col-6 col-md-3 product-ajax-grid-div">
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
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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

                    <div class="loadmore">
                        <button class="btn load-more mt-2 mb-2">{{$langg->lang952}}</button>
                    </div>
                </section>

                <section class="mb-5 text-center">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span>{{$langg->lang805}}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">Amazing products added recently in our catalog</h3>
                    </div>

                    <div class="row row-sm grid">
                        @if(!empty($fix_banners[0]))
                        <div class="grid-item col-lg-6">
                            <div class="product-category">
                                <a href="{{$fix_banners[0]->link}}">
                                    <figure>
                                        <img src="{{asset('assets/images/banners/'.$fix_banners[0]->photo)}}">
                                    </figure>

                                    <div class="category-content content-right">
                                        <h3>
                                            @if(!$slang)
                                               @if($lang->id == 2)
                                                {!!$fix_banners[0]->btn_ar!!}  
                                              @else 
                                               {!!$fix_banners[0]->button!!}  
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                                {!!$fix_banners[0]->btn_ar!!}  
                                              @else
                                               {!!$fix_banners[0]->button!!}  
                                              @endif
                                            @endif  
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endif
                        @if(!empty($fix_banners[1]))
                        <div class="grid-item col-6 col-lg-3 height-x1">
                            <div class="product-category">
                                <a href="{{$fix_banners[1]->link}}">
                                    <figure>
                                        <img src="{{asset('assets/images/banners/'.$fix_banners[1]->photo)}}">
                                    </figure>

                                    <div class="category-content content-white">
                                        <h3>
                                            @if(!$slang)
                                           @if($lang->id == 2)
                                            {!!$fix_banners[1]->btn_ar!!}  
                                          @else 
                                           {!!$fix_banners[1]->button!!}  
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            {!!$fix_banners[1]->btn_ar!!}  
                                          @else
                                           {!!$fix_banners[1]->button!!}  
                                          @endif
                                        @endif  
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endif
                        @if(!empty($fix_banners[2]))
                        <div class="grid-item col-6 col-lg-3 height-x1">
                            <div class="product-category">
                                <a href="{{$fix_banners[2]->link}}">
                                    <figure>
                                        <img src="{{asset('assets/images/banners/'.$fix_banners[2]->photo)}}">
                                    </figure>
                                </a>
                            </div>
                        </div>
                        @endif
                        @if(!empty($fix_banners[3]))
                        <div class="grid-item col-6 col-lg-3 height-x1">
                            <div class="product-category">
                                <a href="{{$fix_banners[3]->link}}">
                                    <figure>
                                        <img src="{{asset('assets/images/banners/'.$fix_banners[3]->photo)}}">
                                    </figure>

                                    <div class="category-content content-white">
                                        <h3>
                                            @if(!$slang)
                                               @if($lang->id == 2)
                                                {!!$fix_banners[3]->btn_ar!!}  
                                              @else 
                                               {!!$fix_banners[3]->button!!}  
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                                {!!$fix_banners[3]->btn_ar!!}  
                                              @else
                                               {!!$fix_banners[3]->button!!}  
                                              @endif
                                            @endif  
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endif
                        @if(!empty($fix_banners[4]))
                        <div class="grid-item col-6 col-lg-3 height-x1">
                            <div class="product-category">
                                <a href="{{$fix_banners[4]->link}}">
                                    <figure>
                                        <img src="{{asset('assets/images/banners/'.$fix_banners[4]->photo)}}">
                                    </figure>
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </section>

                @if($ps->featured ==1)
                <section class="mb-5">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span>{{ $langg->lang940 }}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">{{$langg->lang831}}</h3>
                    </div>

                    <div class="product-panel owl-carousel owl-theme mb-0"
                     data-toggle="owl" data-owl-options="{
                        'margin' : 20,
                        'items' : 2,
                        'nav' : true,
                        'dots' : true,
                        'responsive' : {
                            '768' : {
                                'items' : 3
                            }
                        }
                    }">
                        @foreach($feature_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
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
                                <div class="label-group">
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                <section class="mb-5">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span>{{ $langg->lang28 }}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">{{$langg->lang831}}</h3>
                    </div>

                    <div class="product-panel owl-carousel owl-theme mb-0"
                     data-toggle="owl" data-owl-options="{
                        'margin' : 20,
                        'items' : 2,
                        'nav' : true,
                        'dots' : true,
                        'responsive' : {
                            '768' : {
                                'items' : 3
                            }
                        }
                    }">
                        @foreach($top_products as $prod)
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                <section class="mb-5">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span>{{ $langg->lang27}}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">{{$langg->lang831}}</h3>
                    </div>

                    <div class="product-panel owl-carousel owl-theme mb-0"
                     data-toggle="owl" data-owl-options="{
                        'margin' : 20,
                        'items' : 2,
                        'nav' : true,
                        'dots' : true,
                        'responsive' : {
                            '768' : {
                                'items' : 3
                            }
                        }
                    }">
                        @foreach($best_products as $prod)
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                <section class="mb-5">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span><strong>{{ $langg->lang29}}</strong> {{ $langg->lang444 }}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">{{$langg->lang831}}</h3>
                    </div>

                    <div class="product-panel owl-carousel owl-theme mb-0"
                     data-toggle="owl" data-owl-options="{
                        'margin' : 20,
                        'items' : 2,
                        'nav' : true,
                        'dots' : true,
                        'responsive' : {
                            '768' : {
                                'items' : 3
                            }
                        }
                    }">
                        @foreach($big_products as $prod)
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                <section class="mb-5">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span>{{ $langg->lang33}}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">{{$langg->lang831}}</h3>
                    </div>

                    <div class="product-panel owl-carousel owl-theme mb-0"
                     data-toggle="owl" data-owl-options="{
                        'margin' : 20,
                        'items' : 2,
                        'nav' : true,
                        'dots' : true,
                        'responsive' : {
                            '768' : {
                                'items' : 3
                            }
                        }
                    }">
                        @foreach($sale_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                <section class="mb-5">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span>{{ $langg->lang32}}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">{{$langg->lang831}}</h3>
                    </div>

                    <div class="product-panel owl-carousel owl-theme mb-0"
                     data-toggle="owl" data-owl-options="{
                        'margin' : 20,
                        'items' : 2,
                        'nav' : true,
                        'dots' : true,
                        'responsive' : {
                            '768' : {
                                'items' : 3
                            }
                        }
                    }">
                        @foreach($trending_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                <section class="mb-5">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span>{{ $langg->lang30}}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">{{$langg->lang831}}</h3>
                    </div>

                    <div class="product-panel owl-carousel owl-theme mb-0"
                     data-toggle="owl" data-owl-options="{
                        'margin' : 20,
                        'items' : 2,
                        'nav' : true,
                        'dots' : true,
                        'responsive' : {
                            '768' : {
                                'items' : 3
                            }
                        }
                    }">
                        @foreach($hot_products as $prod)
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                <section class="mb-5">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span>{{ $langg->lang31}}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">{{$langg->lang831}}</h3>
                    </div>

                    <div class="product-panel owl-carousel owl-theme mb-0"
                     data-toggle="owl" data-owl-options="{
                        'margin' : 20,
                        'items' : 2,
                        'nav' : true,
                        'dots' : true,
                        'responsive' : {
                            '768' : {
                                'items' : 3
                            }
                        }
                    }">
                        @foreach($latest_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                @if($ps->flash_deal ==1)
                <section class="mb-5">
                    <div class="section-title">
                        <div class="divide-txt">
                            <div class="divide-line"></div>
                            <span>{{ $langg->lang244}}</span>
                            <div class="divide-line"></div>
                        </div>
                        <h3 class="section-subtitle">{{$langg->lang831}}</h3>
                    </div>

                    <div class="product-panel owl-carousel owl-theme mb-0"
                     data-toggle="owl" data-owl-options="{
                        'margin' : 20,
                        'items' : 2,
                        'nav' : true,
                        'dots' : true,
                        'responsive' : {
                            '768' : {
                                'items' : 3
                            }
                        }
                    }">
                        @foreach($discount_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
                @if($ps->partners == 1)
                <div class="partners-carousel owl-carousel owl-theme mb-5" data-toggle="owl" data-owl-options="{
                    'margin' : 0,
                    'nav' : false,
                    'dots' : false,
                    'loop' : false,
                    'items' : 2,
                    'responsive' : {
                        '576' : {
                            'items' : 3
                        },
                        '768' : {
                            'items' : 4
                        },
                        '992' : {
                            'items' : 5
                        },
                        '1200' : {
                            'items' : 6
                        }
                    }
                }">
                    @foreach($partners as $j)
                        <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo" style="width:140px;height:60px">
                        @endforeach
                </div>
                @endif
            </div>
        </main><!-- End .main -->