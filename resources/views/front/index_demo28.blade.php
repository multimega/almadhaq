@php 
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$categorys=App\Models\Category::get();
$main=App\Models\Generalsetting::find(1);
$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);
@endphp
<main class="home">
            <section class="container">
                <div class="row my-3">
                <div class="col-lg-8">
                    <div class="home-slider owl-carousel owl-theme owl-loaded owl-home" data-toggle="owl" data-owl-options="{
                        'item': 1,
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'margin': 20,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                              'items': 1,
                              'margin': 0
                            },
                            '300': {
                              'items': 1
                            },
                            '576': {
                              'items': 1
                            },
                            '768': {
                              'items': 1
                            },
                            '992': {
                              'items': 1
                            },
                            '1200': {
                              'items' : 1
                            }
                        }
                      }">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                @if($ps->slider == 1)
            				   @if(count($sliders))
            					@foreach($sliders as $data)
                                <div class="owl-item">
                                    <div class="slide-content">
                                    <h2 class="" style="color:{{$data->title_color}};size:{{$data->title_size}}" > 
                                    @if($language == 'ar')
                                    {{$data->title_text_ar}}
                                    @else
                                    {{$data->title_text}}
                                    @endif
                                    </h2>
                                    
                                    <h3 class="" style="color:{{$data->subtitle_color}};size:{{$data->subtitle_size}}"><span>
                                         @if($language == 'ar')
                                         {{$data->subtitle_text_ar}}
                                         @else     
                                          {{$data->subtitle_text}}
                                         @endif 
                                         </span>
                                    </h3>
                                    
                                    
                                    <p class="" style="color:{{$data->details_color}};size:{{$data->details_size}}">
                                        @if($language == 'ar')                                   
                                        {{$data->details_text_ar}}
                                        @else    
                                        {{$data->details_text}}
                                        @endif
                                    </p>
                                        
                                          @if(isset($data->link)) 
                                             <button class="btn" style="background-color:#87001D;color:#fff;">
                                             <a href="{{$data->link}}">
                                             @if($language == 'ar')                                       
                                                 {{ $data->btn_text_ar}}
                                             @else
                                                {{$data->btn_text}}
                                             @endif
                                            </a>
                                            </button>
                                            @endif
                                    </div>
                                    <img src="{{('assets/images/sliders/'.$data->photo )}}">
                                </div>
                                @endforeach
                                @endif
                                @endif
                            </div>
                        </div>
                </div>
                    </div>
                    <div class="col-lg-4">
                        <a href="{{$fix_banners[0]->link}}" class="owl-home-banner-container">
                        <img src="{{asset('assets/images/banners/'.$fix_banners[0]->photo)}}" class="owl-home-banner">
                        <div class="owl-home-content">
                            <h4>
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
                            </h4>
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
                            <button class="btn">
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
                            </button>
                        </div>
                        </a>
                    </div>
                </div>

                <section class="widget-newsletter mb-3">
                    <div class="row row-sm">
                        <div class="col-md-6 col-xl-5 ads">
                            <i class="far fa-envelope ads-icon"></i>
                            <div class="ads-info">
                                <h2>
                                    @if(!$slang)
                                       @if($lang->id == 2)
                                            {{$gs->popup_title_ar}}  
                                          @else 
                                           {{$gs->popup_title}}
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            {{$gs->popup_title_ar}} 
                                          @else
                                           {{$gs->popup_title}}
                                          @endif
                                   @endif
                                    </h2>
                                <span>
                                    @if(!$slang)
                                       @if($lang->id == 2)
                                            {{$gs->popup_text_ar}}  
                                          @else 
                                           {{$gs->popup_text}}
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            {{$gs->popup_text_ar}} 
                                          @else
                                           {{$gs->popup_text}}
                                          @endif
                                   @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-7 widget-newsletter-form">
                            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                                @csrf
                                <input type="email" class="form-control" id="newsletter-email" name="email" placeholder="{{ $langg->lang741 }}" required>
                                <button class="btn" type="submit">
                                    @if(!$slang)
                                       @if($lang->id == 2)
                                            اشترك  
                                          @else 
                                           SUBSCRIBE
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            اشترك 
                                          @else
                                           SUBSCRIBE
                                          @endif
                                   @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </section>

                @if($ps->featured ==1)
                <section class="product-panel mb-0" style="padding-top : .5rem;">
                    <div class="section-title">
                        <h2>{{ $langg->lang26}}</h2>
                    </div>
                    <div class="row row-sm">
                        <div class="owl-carousel owl-theme owl-loaded" data-toggle="owl" data-owl-options="{
                        'item': 1,
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'margin': 20,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                              'items': 2,
                              'margin': 0
                            },
                            '300': {
                              'items': 2
                            },
                            '576': {
                              'items': 2
                            },
                            '768': {
                              'items': 4
                            },
                            '992': {
                              'items': 5
                            },
                            '1200': {
                              'items' : 6
                            }
                        }
                      }">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                        @foreach($feature_products as $prod)
                        
                        <div class="owl-item">
                        <!--<div class="col-6 col-sm-4 col-lg-2">-->
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
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
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                        @endforeach
                        </div>
                        </div>
                        </div>
                    </div>
                </section>
                @endif
                @if($ps->top_rated ==1)
                <section class="product-panel mb-0" style="padding-top : .5rem;">
                    <div class="section-title">
                        <h2>{{ $langg->lang28}}</h2>
                    </div>
                    <div class="row row-sm">
                        <div class="owl-carousel owl-theme owl-loaded" data-toggle="owl" data-owl-options="{
                        'item': 1,
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'margin': 20,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                              'items': 2,
                              'margin': 0
                            },
                            '300': {
                              'items': 2
                            },
                            '576': {
                              'items': 2
                            },
                            '768': {
                              'items': 4
                            },
                            '992': {
                              'items': 5
                            },
                            '1200': {
                              'items' : 6
                            }
                        }
                      }">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                        @foreach($top_products as $prod)
                        <div class="owl-item">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
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
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                        @endforeach
                        </div>
                        </div>
                        </div>
                    </div>
                </section>
                @endif
                @if($ps->best ==1)
                <section class="product-panel mb-0" style="padding-top : .5rem;">
                    <div class="section-title">
                        <h2>{{ $langg->lang27}}</h2>
                    </div>
                    <div class="row row-sm">
                        <div class="owl-carousel owl-theme owl-loaded" data-toggle="owl" data-owl-options="{
                        'item': 1,
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'margin': 20,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                              'items': 2,
                              'margin': 0
                            },
                            '300': {
                              'items': 2
                            },
                            '576': {
                              'items': 2
                            },
                            '768': {
                              'items': 4
                            },
                            '992': {
                              'items': 5
                            },
                            '1200': {
                              'items' : 6
                            }
                        }
                      }">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                        @foreach($best_products as $prod)
                        <div class="owl-item">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign] ) }}">
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
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
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
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                        @endforeach
                        </div>
                        </div>
                        </div>
                    </div>
                </section>
                @endif
                @if($ps->big ==1)
                <section class="product-panel mb-0" style="padding-top : .5rem;">
                    <div class="section-title">
                        <h2>{{ $langg->lang29}}</h2>
                    </div>
                    <div class="row row-sm">
                        <div class="owl-carousel owl-theme owl-loaded" data-toggle="owl" data-owl-options="{
                        'item': 1,
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'margin': 20,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                              'items': 2,
                              'margin': 0
                            },
                            '300': {
                              'items': 2
                            },
                            '576': {
                              'items': 2
                            },
                            '768': {
                              'items': 4
                            },
                            '992': {
                              'items': 5
                            },
                            '1200': {
                              'items' : 6
                            }
                        }
                      }">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                        @foreach($big_products as $prod)
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
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
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                        @endforeach
                        </div>
                        </div>
                        </div>
                    </div>
                </section>
                @endif
                @if($ps->featured_category == 1)
                <div class="car-slider bg-grey owl-carousel owl-theme text-center" id="carbrandlist" data-toggle="owl" data-owl-options="{
                    'nav': false,
                    'dots': true,
                    'loop': false,
                    'margin': 20,
                    'autoHeight': true,
                    'autoplay': true,
                    'autoplayTimeout': 5000,
                    'responsive': {
                        '0': {
                          'items': 2,
                          'margin': 0
                        },
                        '338': {
                          'items' : 2
                        },
                        '450': {
                          'items': 2
                        },
                        '600': {
                          'items': 2
                        },
                        '728' : {
                          'items': 4
                        },
                        '900' : {
                          'items' : 5
                        },
                        '1200': {
                          'items' : 5
                        }
                      }
                  }">
                     
                     @foreach($categories->where('is_featured','=',1) as $cat)
                    <button id="car_chevy" class="btn">
                      <a href="{{ route('front.category',['category' => $cat->slug ,'lang' => $sign ]) }}">
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
                    </button>
                    @endforeach
                </div>
                @endif
            </section>
            @if($ps->flash_deal ==1)
            <section class="bg-grey pt-4 pb-4">
                <div class="container home-banner-list bg-white pt-4 pb-3">
                    @foreach($fix_banners as $banner)
                    <div class="col-12 col-md-6 col-lg-4 mb-2" style="position: relative;display: flex;align-items: center;justify-content: center;text-align: center">
                        <figure style="height: 180px">
                            <a href="{{$banner->link}}">
                                <img src="assets/images/banners/{{$banner->photo}}">
                            </a>
                        </figure>
                        <div class="product-details" style="position: absolute;background: rgb(0,0,0,.4);padding: 15px;color: #fff;border-radius: 5px;">
                            <h4 style="color: #fff;font-size: 20px;">
                                @if(!$slang)
                                  @if($lang->id == 2)
                                    {!!$banner->title_ar!!}
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
                            <button class="btn">
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
                            </button>
                            
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </section>
            @endif
            <section class="container pt-3 pb-3">
                @if(!empty($fix_banners[2]))
                <div class="home-banner mt-3" style="background-image: url('{{asset('assets/images/banners/'.$fix_banners[2]->photo)}}')">
                    <div class="ads">
                        <div class="price-off">
                            <span>BIG SALE</span>
                        </div>
                        <h2>@if(!$slang)
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
                                      @endif</h2>
                        <h3>@if(!$slang)
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
                                      @endif</h3>
                    </div>
                    <a href="{{$fix_banners[2]->link}}"><button class="btn">{{ $langg->lang25 }}</button></a>
                </div>
                @endif
                @if($ps->hot_sale ==1)
                <section class="product-panel mb-0" style="padding-top : .5rem;">
                    <div class="section-title">
                        <h2>{{ $langg->lang33}}</h2>
                    </div>
                    <div class="row row-sm">
                        <div class="owl-carousel owl-theme owl-loaded" data-toggle="owl" data-owl-options="{
                        'item': 1,
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'margin': 20,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                              'items': 2,
                              'margin': 0
                            },
                            '300': {
                              'items': 2
                            },
                            '576': {
                              'items': 2
                            },
                            '768': {
                              'items': 4
                            },
                            '992': {
                              'items': 5
                            },
                            '1200': {
                              'items' : 6
                            }
                        }
                      }">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                        @foreach($sale_products as $prod)
                        <div class="owl-item">
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
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
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
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                        @endforeach
                        </div>
                        </div>
                        </div>
                    </div>
                </section>
                @endif
                @if($ps->hot_sale ==1)
                <section class="product-panel mb-0" style="padding-top : .5rem;">
                    <div class="section-title">
                        <h2>{{ $langg->lang32}}</h2>
                    </div>
                    <div class="row row-sm">
                        <div class="owl-carousel owl-theme owl-loaded" data-toggle="owl" data-owl-options="{
                        'item': 1,
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'margin': 20,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                              'items': 2,
                              'margin': 0
                            },
                            '300': {
                              'items': 2
                            },
                            '576': {
                              'items': 2
                            },
                            '768': {
                              'items': 4
                            },
                            '992': {
                              'items': 5
                            },
                            '1200': {
                              'items' : 6
                            }
                        }
                      }">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                        @foreach($trending_products as $prod)
                        <div class="owl-item">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
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
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                        @endforeach
                        </div>
                        </div>
                        </div>
                    </div>
                </section>
                @endif
                @if($ps->hot_sale ==1)
                <section class="product-panel mb-0" style="padding-top : .5rem;">
                    <div class="section-title">
                        <h2>{{ $langg->lang30}}</h2>
                    </div>
                    <div class="row row-sm">
                        <div class="owl-carousel owl-theme owl-loaded" data-toggle="owl" data-owl-options="{
                        'item': 1,
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'margin': 20,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                              'items': 2,
                              'margin': 0
                            },
                            '300': {
                              'items': 2
                            },
                            '576': {
                              'items': 2
                            },
                            '768': {
                              'items': 4
                            },
                            '992': {
                              'items': 5
                            },
                            '1200': {
                              'items' : 6
                            }
                        }
                      }">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                        @foreach($hot_products as $prod)
                        <div class="owl-item">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
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
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                        @endforeach
                        </div>
                        </div>
                        </div>
                    </div>
                </section>
                @endif
                @if($ps->hot_sale ==1)
                <section class="product-panel mb-0" style="padding-top : .5rem;">
                    <div class="section-title">
                        <h2>{{ $langg->lang31}}</h2>
                    </div>
                    <div class="row row-sm">
                        <div class="owl-carousel owl-theme owl-loaded" data-toggle="owl" data-owl-options="{
                        'item': 1,
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'margin': 20,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                              'items': 2,
                              'margin': 0
                            },
                            '300': {
                              'items': 2
                            },
                            '576': {
                              'items': 2
                            },
                            '768': {
                              'items': 4
                            },
                            '992': {
                              'items': 5
                            },
                            '1200': {
                              'items' : 6
                            }
                        }
                      }">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                        @foreach($latest_products as $prod)
                        <div class="owl-item">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
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
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
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
                                        <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                        <span class="product-price">{{ $prod->showPrice() }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                        @endforeach
                        </div>
                        </div>
                        </div>
                    </div>
                </section>
                @endif
                
                @if($ps->service == 1)
                <div class="mt-2 mb-3 bg-grey">
                    <div class="row row-sm">
                        @foreach($chunk as $service )
                        <div class="col-md-3 ads">
                          <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">
                            <div class="ads-info">
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
                                <span>
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
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($ps->partners == 1)
                <div id="trustbrands">
                    <div class="section-title">
                        <h2>{{ $langg->lang826 }}</h2>
                    </div>

                    <div class="brand-slider owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{
                        'nav': false,
                        'dots': true,
                        'loop': true,
                        'margin': 20,
                        'center': true,
                        'autoHeight': true,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                              'items': 1,
                              'margin': 0
                            },
                            '300': {
                              'items': 2
                            },
                            '576': {
                              'items': 3
                            },
                            '768': {
                              'items': 4
                            },
                            '992': {
                              'items': 5
                            },
                            '1200': {
                              'items' : 6
                            }
                        }
                      }">
                        @foreach($partners as $j)
                        <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo" style="width:160px;height:60px">
                        @endforeach
                    </div>
                </div>
                @endif
            </section>
            
            @if($ps->review_blog == 1)
            <section class="bg-grey pt-1 pb-1">
                <div class="container mt-4 mb-2">
                    <div class="post-slider owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'margin': 20,
                        'autoHeight': true,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                          '0': {
                            'items': 1,
                            'margin': 0
                          },
                          '500': {
                            'items': 2
                          },
                          '800': {
                            'items': 3
                          }
                        }
                      }">
                        
                        @foreach(DB::table('blogs')->orderby('id','desc')->take(3)->get() as $blogg)
                        <div class="product-default inner-quickview post">
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
                                <div class="label-group">
                                    <div class="product-label label-dark"><span class="date-day">{{date('d', strtotime($blogg->created_at))}}</span>{{date('m', strtotime($blogg->created_at))}}</div>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h2 class="product-title">
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
                                </h2>
                                <p class="product-description">
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
                                          <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign ])}}">{{ $langg->lang38 }}</a>
                                </p>
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </section>
            @endif

        </main><!-- End .main -->