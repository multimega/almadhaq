
        <main class="main">
            <div class="home-slider owl-carousel owl-theme">
            <!-- End .home-slide -->
	         @foreach($sliders as $data)
                <div class="home-slide">
                    <div class="slide-bg owl-lazy"  data-src="{{asset('assets/images/sliders/'.$data->photo)}}"></div><!-- End .slide-bg -->
                    <div class="home-slide-content">
                        <h2>  
                     @if($lang->id == 2)
                     
                     {{$data->subtitle_text_ar}}
                     
                      @else 
                      {{$data->subtitle_text}}
                      @endif 
                         
                      @if($slang == 2) 
                      {{$data->subtitle_text_ar}}
                      @else
                      {{$data->subtitle_text}}
                      @endif
                        <br> </h2>
        
                                <span>	@if(!$slang)
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
                       @endif</span>

                        <a href="{{$data->link}}" class="btn" role="button">
                                        
                              @if($lang->id == 2)
                             {{$data->details_text_ar}}
                              @else 
                              {{$data->details_text}}
                              @endif 
                        
                                       
                         </a>
                   
                    </div>
                </div>
                @endforeach
                
            </div>

            <section class="container-fluid">
                <div class="section-header mt-6">
                    <h2 class="section-title">Shop By Category</h2>
                </div>

                <div class="row row-sm mb-2">
                    @foreach($categories->where('is_featured','=',1) as $cat)
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="product-category">
                            <a href="{{ route('front.category', ['category' => $cat->slug , 'lang' => $sign]) }}">
                                <figure>
                                    <img src="{{asset('assets/images/categories/'.$cat->image) }}" style="width:100%; height:228px;">
                                </figure>
                                <div class="category-content">
                                    <h3>@if(!$slang)
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
                                    <span><mark class="count">{{ count($cat->products) }}</mark>&nbsp;Products</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <section class="bg-grey pt-3 pb-3">
                <div class="container-fluid mt-6 mb-5">
                    <div class="row row-sm">
                        @foreach($top_small_banners as $chunk)
                        <div class="col-6 col-lg-3">
                            <div class="home-banner">
                                <img src="{{asset('assets/images/banners/'.$chunk->photo)}}" style="height:367px; width:100%;">
                                <div class="home-banner-content content-left-bottom">
                                    <h3>{{$chunk->title}}</h3>
                                    <h4>{{$chunk->subtitle}}</h4>
                                    <a href="{{$chunk->link}}" class="btn" role="button">{{$chunk->button}}</a>
                                </div>
                            </div>
                        </div>
                     	@endforeach
                    
                    </div>
                </div>
            </section>
 
 
              @if($ps->featured == 1)
            <section class="container-fluid">
                <div class="section-header mt-6">
                    <h2 class="section-title">{{ $langg->lang26 }}</h2>
                </div>

                <div class="row row-sm mb-10">
                  	@foreach($feature_products as $prod)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%;height:245px;"  @if(!$slang)
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
                               @if(!empty($prod->features))
                                <div class="label-group">
                                    
                                    	@foreach($prod->features as $key => $data1)
										 <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
								    	@endforeach
                                </div>
                                      @endif
                           
                                <div class="btn-icon-group">
                                    
                                    @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
         						     <span class="btn-icon add-to-cart"    data-href="{{ route('product.cart.add',$prod->id) }}"data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></span>
                                    @endif
                                </div>
                                
                                
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                      <div class="category-list">
                                        <a href="#" class="product-category">
                                
                                
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
                                     @if(Auth::guard('web')->check())

																<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icofont-heart-alt" ></i>
																</span>

																@else

																<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																	<i class="icofont-heart-alt"></i>
																</span>

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
                                                        @endif</h5>
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
             @if($ps->best == 1)
             <section class="container-fluid">
                <div class="section-header mt-6">
                    <h2 class="section-title">{{ $langg->lang27 }}</h2>
                </div>

                <div class="row row-sm mb-10">
                  	@foreach($best_products as $prod)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png')}}"style="width:100%;height:245px;"  @if(!$slang)
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
                                
                                  
                                   
                                   @if(!empty($prod->features))
                                <div class="label-group">
                                    
                               	    @foreach($prod->features as $key => $data1)
									 <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
								    @endforeach
                                </div>
                                @endif
                                <div class="btn-icon-group">
                                    					
   @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
         						     <span class="btn-icon add-to-cart"    data-href="{{ route('product.cart.add',$prod->id) }}"data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></span>
                                    @endif                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a> 
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
                                                  @endif</h5>
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
          
          @if($ps->top_rated == 1)   
         <section class="container-fluid">
                <div class="section-header mt-6">
                    <h2 class="section-title">{{ $langg->lang28 }}</h2>
                </div>
                <div class="row row-sm mb-10">
                  	@foreach($top_products as $prod)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%;height:245px;"  @if(!$slang)
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
                                 @if(!empty($prod->features))
                                <div class="label-group">
                                    
                                    	@foreach($prod->features as $key => $data1)
										 <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
									@endforeach
                                </div>
                                @endif
                                <div class="btn-icon-group">
                                    					
   @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
         						     <span class="btn-icon add-to-cart"    data-href="{{ route('product.cart.add',$prod->id) }}"data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></span>
                                    @endif                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                   
                                </div>
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
                                                  @endif</h5>
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
                   @if($ps->big == 1)   
             <section class="container-fluid">
                <div class="section-header mt-6">
                    <h2 class="section-title">{{ $langg->lang29 }}</h2>
                </div>
                <div class="row row-sm mb-10">
                  	@foreach($big_products as $prod)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"style="width:100%;height:245px;"  @if(!$slang)
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
                                 @if(!empty($prod->features))
                                <div class="label-group">
                                    
                                    	@foreach($prod->features as $key => $data1)
										 <span class="product-label label-cut" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
									@endforeach
                                </div>
                                @endif
                                <div class="btn-icon-group">
                                    					
   @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
         						     <span class="btn-icon add-to-cart"    data-href="{{ route('product.cart.add',$prod->id) }}"data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></span>
                                    @endif                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                   
                                </div>
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
                                                  @endif</h5>
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
            
        </main>

   
     