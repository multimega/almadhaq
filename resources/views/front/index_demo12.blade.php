@php 
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$main=App\Models\Generalsetting::find(1);
@endphp
      
        <main class="main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 offset-lg-3">
                        <div class="home-slider owl-carousel owl-carousel-lazy owl-theme">
                            @if($ps->slider == 1)
				            @if(count($sliders))
				        	@foreach($sliders as $data) 
                            <a href="{{$data->link}}">
                                     
                            <div class="home-slide">
                                <div class="owl-lazy slide-bg" src="{{asset('assets/images/sliders/'.$data->photo)}}" data-src="{{asset('assets/images/sliders/'.$data->photo)}}">
                                     
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
								<h3>@if(!$slang)
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
                                  @endif</h3> 
                                           
                                           <div class="mb-0">
                                               <a href="{{$data->link}}">
                                                   <button class="btn btn-modern btn-md btn-dark">{{ $langg->lang25 }}</button>
                                               </a>
                                           </div>
                                     
                                   
                                   
                                     </div>    
                                    
                            </div>
                        </a>
                            @endforeach
                            @endif
                            @endif
                        
                          
                        </div><!-- End .home-slider -->
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->

                
                <br>
                 @if($ps->featured == 1)
                <h2 class="title text-center">{{ $langg->lang26}}</h2>
                <div class="products-carousel owl-carousel owl-theme owl-nav-top">
                    
                     @foreach($feature_products as $prod)
                    <div class="product-default left-details mb-4">
                        <figure>
                                 <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="" class="product-category">
                                    
                                 @if(!$slang)
                                 @if($lang->id == 2)
                               
                                {{$prod->category->name_ar }}
                                    
                                @else 
                                  
                                 {{ $prod->category->name }}

                                  @endif 
                                  @else   
                                  @if($slang == 2) 
                                     {{ $prod->category->name_ar }}

                                  @else
                                 {{ $prod->category->name }}

                                      @endif
                                      @endif
                                      
                                      </a>
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
                                    <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="pric('web')e-box">
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
                                     <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                      
                                    @endif
                                     @if(Auth::guard('web')->check())
                                       <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                      @endif                          
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                    <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <i class="fas fa-compare"></i>
                                    </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                 @endif
                
                @if($ps->large_banner == 1)
                @if(! empty($large_banners[0]))
                <div class="banner banner-image mb-2 mb-md-4 mb-lg-6">
                    
                     <div class="text-center mb-0">
                       <a href="{{$large_banners[0]->link}}" target="_blank">
                            <button class="btn btn-modern btn-md btn-dark">
                              @if($slang == 1)
                               {{ $large_banners[0]->button }}
                              @elseif($slang == 2)
                               {{ $large_banners[0]->btn_ar }}
                              @endif 
                            </button>
                       </a>
                     </div>
                    <img src="{{asset('assets/images/banners/'.$large_banners[0]->photo)}}"style="height:174px;" alt="banner">
                    
                  </div>
                @endif
                 @endif                     
                    @if($ps->big == 1)
                   <h2 class="title text-center">{{ $langg->lang29 }}</h2>
                <div class="products-carousel owl-carousel owl-theme owl-nav-top">
                     @foreach($big_products as $prod)
                    <div class="product-default left-details mb-4">
                        <figure>
                                 <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%; height:245px;">
                                </a>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="" class="product-category">  @if(!$slang)
                                 @if($lang->id == 2)
                               
                                {{$prod->category->name_ar }}
                                    
                                @else 
                                  
                                 {{ $prod->category->name }}

                                  @endif 
                                  @else   
                                  @if($slang == 2) 
                                     {{ $prod->category->name_ar }}

                                  @else
                                 {{ $prod->category->name }}

                                      @endif
                                      @endif
                                      </a>
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
                                     <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                      
                                    @endif
                                     @if(Auth::guard('web')->check())
                                       <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                      @endif                          
                                   <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                   <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <i class="fas fa-compare"></i>
                                    </a>
                            </div>
                        </div><!-- End .product-details -->
                    </div>
                    @endforeach
                </div><!-- End .featured-proucts -->
                 @endif            

            
                <div class="row">
                     <div class="col-md-6 col-lg-3">
                            <div class="banner banner-image">
                                <a href="{{$top_small_banners[0]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[0]->photo)}}" style="height:158px;"alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->

                     @if(!empty($top_small_banners[1]->link))
                        <div class="col-md-6 col-lg-3">
                            <div class="banner banner-image">
                                <a href="{{$top_small_banners[1]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[1]->photo)}}"style="height:158px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                    @endif
                        @if(!empty($top_small_banners[2]->link))
                        <div class="col-md-6 col-lg-3">
                            <div class="banner banner-image">
                                <a href="{{$top_small_banners[2]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[2]->photo)}}"style="height:158px;" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                        @endif
                        @if(!empty($top_small_banners[3]->link))
                         <div class="col-md-6 col-lg-3">
                            <div class="banner banner-image">
                                <a href="{{$top_small_banners[3]->link}}">
                                    <img src="{{asset('assets/images/banners/'.$top_small_banners[3]->photo)}}"style="height:158px;" alt="banner">
                                </a>
                            </div>
                        </div>
                        @endif
                        
                    </div>

                <div class="mb-3"></div>

                 @if($ps->best == 1)
                <h2 class="title text-center">{{ $langg->lang27 }}</h2>
                <div class="products-carousel owl-carousel owl-theme owl-nav-top">
                     @foreach($best_products as $prod)
                    <div class="product-default left-details mb-4">
                        <figure>
                                 <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="" class="product-category"> @if(!$slang)
                                 @if($lang->id == 2)
                               
                                {{$prod->category->name_ar }}
                                    
                                @else 
                                  
                                 {{ $prod->category->name }}

                                  @endif 
                                  @else   
                                  @if($slang == 2) 
                                     {{ $prod->category->name_ar }}

                                  @else
                                 {{ $prod->category->name }}

                                      @endif
                                      @endif</a>
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
                                     <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                      
                                    @endif
                                     @if(Auth::guard('web')->check())
                                       <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                      @endif                          
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                   <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <i class="fas fa-compare"></i>
                                    </a>
                            </div>
                        </div><!-- End .product-details -->
                    </div>
                    @endforeach
                </div>
                 @endif
                 <div class="row my-5">
                     <div class='col-md-6'>
                         <h2 class="text-center">{{ $langg->lang28 }}</h2>
                         
                  <div class="one-product owl-carousel owl-theme owl-nav-top text-center">
                         @foreach($top_products as $prod)
                    <div class="product-default left-details mb-4">
                        <figure>
                         <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    <a href="" class="product-category">  @if(!$slang)
                                     @if($lang->id == 2)
                                   
                                    {{$prod->category->name_ar }}
                                        
                                    @else 
                                      
                                     {{ $prod->category->name }}
    
                                      @endif 
                                      @else   
                                      @if($slang == 2) 
                                         {{ $prod->category->name_ar }}
    
                                      @else
                                     {{ $prod->category->name }}
    
                                          @endif
                                          @endif</a>
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
                                      <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                </div><!-- End .price-box -->
                                
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach
                        </div>
                     </div>
                     <div class='col-md-6'>
                         <h2 class="text-center">{{ $langg->lang27 }}</h2>
                         
                  <div class="one-product owl-carousel owl-theme owl-nav-top text-center">
                         @foreach($best_products as $prod)
                    <div class="product-default left-details mb-4">
                        <figure>
                         <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    <a href="" class="product-category">  @if(!$slang)
                                     @if($lang->id == 2)
                                   
                                    {{$prod->category->name_ar }}
                                        
                                    @else 
                                      
                                     {{ $prod->category->name }}
    
                                      @endif 
                                      @else   
                                      @if($slang == 2) 
                                         {{ $prod->category->name_ar }}
    
                                      @else
                                     {{ $prod->category->name }}
    
                                          @endif
                                          @endif</a>
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
                                      <span class="product-price">{{ $prod->showPrice() }}</span></span>
                                </div><!-- End .price-box -->
                                
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach
                        </div>
                     </div>
                 </div>
   
                <div class="mb-6"></div>
                
                 @if($ps->top_rated ==1)
                    <h2 class="title text-center">{{ $langg->lang28 }}</h2>
                  <div class="products-carousel owl-carousel owl-theme owl-nav-top">
                    @foreach($top_products as $prod)
                    <div class="product-default left-details mb-4">
                        <figure>
                                 <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="" class="product-category">  @if(!$slang)
                                 @if($lang->id == 2)
                               
                                {{$prod->category->name_ar }}
                                    
                                @else 
                                  
                                 {{ $prod->category->name }}

                                  @endif 
                                  @else   
                                  @if($slang == 2) 
                                     {{ $prod->category->name_ar }}

                                  @else
                                 {{ $prod->category->name }}

                                      @endif
                                      @endif</a>
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
                                     <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>{{$langg->lang56}}</button>
                                      
                                    @endif
                                     @if(Auth::guard('web')->check())
                                       <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                      @endif                          
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                   <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <i class="fas fa-compare"></i>
                                    </a>
                            </div>
                        </div><!-- End .product-details -->
                    </div>
                    @endforeach
                </div><!-- End .featured-proucts -->
                 @endif              
                
        
            	@if($ps->partners == 1)
            <div class="partners-container my-5">
                <div class="container">
                    
                    <div class="partners-carousel owl-carousel owl-theme owl-nav-top owl-loaded owl-drag">
                         @foreach($partners as $j)
                        <a href="{{$j->link}}" class="partner">
                            <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo">
                        </a>
                       @endforeach
                    </div><!-- End .partners-carousel -->
                </div><!-- End .container -->
            </div><!-- End .partners-container -->
            @endif
           
            </div><!-- End .container -->
        </main><!-- End .main -->