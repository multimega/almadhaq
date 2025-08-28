   @php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);
$categorys=App\Models\Category::get();
$blogs = DB::table('blogs')->get();
@endphp
<style>
    
    
    .sale-banner.banner h2{
        font-size:30px !important;
    }
</style>
   
   
   
   <main class="main">
            <div class="container">
                <div class="home-slider-container">
                    <div class="home-slider owl-carousel owl-theme owl-theme-light nav-pos-outside show-nav-hover slide-animate">
                    
                      @if($ps->slider == 1)
				            @if(count($sliders))
			      		    @foreach($sliders as $key=>$data)
			      		    
			      	
			      	
			      	@if($key%2 == 0)	    
                         
                        <div class="home-slide">
                            <div class="slide-bg owl-lazy"  src="{{asset('assets/images/sliders/'.$data->photo)}}" data-src="{{asset('assets/images/sliders/'.$data->photo)}}" ></div><!-- End .slide-bg -->
                            <div class="home-slide-content sale-banner">
                                <div class="row no-gutter bg-primary appear-animate" data-animation-name="fadeInLeftShorter">
                                    <div class="col-auto col-md-6 d-flex flex-column justify-content-center col-1">
                                        <h4 class="align-left text-uppercase mb-0 appear-animate" data-animation-name="slideInRight" data-animation-delay="400" style="color:{{$data->details_color}};font-size:{{$data->details_size}}">
                                            
                                           @if(!$slang)
                                         @if($lang->id == 2)
                                         {!!$data->details_text_ar!!}
                                          @else 
                                          {!!$data->details_text!!}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {!!$data->details_text_ar!!}
                                          @else
                                          {!!$data->details_text!!}
                                          @endif
                                            
                                            
                                        @endif
                                            
                                            </h4>
                                        <h3 class="text-white mb-0 align-left text-uppercase appear-animate" data-animation-name="slideInRight" data-animation-delay="400"  style="color:{{$data->title_color}};font-size:{{$data->title_size}}">
                                            
                                          @if(!$slang)
                                     @if($lang->id == 2)
                                         {!!$data->title_text_ar!!}
                                          @else 
                                          {!!$data->title_text!!}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {!!$data->title_text_ar!!}
                                          @else
                                          {!!$data->title_text!!}
                                          @endif
                                            
                                            
                                         @endif
                                            
                                            
                                            
                                            </h3>
                                    </div>
                            
                                    <div class="col-auto col-md-6 col-2 appear-animate" data-animation-name="slideInLeft" data-animation-delay="400">
                                        <h2 class="text-white mb-0 position-relative align-left"   style="color:{{$data->subtitle_color}};font-size:{{$data->subtitle_size}}px">
                                            
                                              @if(!$slang)
                                          @if($lang->id == 2)
                                         {!!$data->subtitle_text_ar!!}
                                          @else 
                                          {!!$data->subtitle_text!!}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {!!$data->subtitle_text_ar!!}
                                          @else
                                          {!!$data->subtitle_text!!}
                                          @endif
                                            
                                            
                                           @endif
                                        </h2>
                                    </div>
                                </div>
                                <div class="mb-0 text-right" >
                                    <button class="btn btn-lg btn-dark appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="600">@if(!$slang)
                                          @if($lang->id == 2)
                                         {!!$data->btn_text_ar!!}
                                          @else 
                                          {{$data->btn_text}}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {!!$data->btn_text_ar!!}
                                          @else
                                          {{$data->btn_text}}
                                          @endif
                                            
                                            
                                           @endif</button>
                                </div>
                            </div>
                        </div><!-- End .home-slide -->
                    @else
                    
                    <div class="home-slide  home-slide-left" >
                            <div class="slide-bg owl-lazy"  src="{{asset('assets/images/sliders/'.$data->photo)}}" data-src="{{asset('assets/images/sliders/'.$data->photo)}}" ></div><!-- End .slide-bg -->
                            <div class="home-slide-content sale-banner">
                                <div class="row no-gutter bg-primary appear-animate" data-animation-name="fadeInLeftShorter">
                                    <div class="col-auto col-md-6 d-flex flex-column justify-content-center col-1">
                                        <h4 class="align-left text-uppercase mb-0 appear-animate" data-animation-name="slideInRight" data-animation-delay="400" style="color:{{$data->details_color}};font-size:{{$data->details_size}}">
                                            
                                           @if(!$slang)
                                         @if($lang->id == 2)
                                         {!!$data->details_text_ar!!}
                                          @else 
                                          {!!$data->details_text!!}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {!!$data->details_text_ar!!}
                                          @else
                                          {!!$data->details_text!!}
                                          @endif
                                            
                                            
                                        @endif
                                            
                                            </h4>
                                        <h3 class="text-white mb-0 align-left text-uppercase appear-animate" data-animation-name="slideInRight" data-animation-delay="400"  style="color:{{$data->title_color}};font-size:{{$data->title_size}}">
                                            
                                          @if(!$slang)
                                     @if($lang->id == 2)
                                         {!!$data->title_text_ar!!}
                                          @else 
                                          {!!$data->title_text!!}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {!!$data->title_text_ar!!}
                                          @else
                                          {!!$data->title_text!!}
                                          @endif
                                            
                                            
                                         @endif
                                            
                                            
                                            
                                            </h3>
                                    </div>
                            
                                    <div class="col-auto col-md-6 col-2 appear-animate" data-animation-name="slideInLeft" data-animation-delay="400">
                                        <h2 class="text-white mb-0 position-relative align-left"   style="color:{{$data->subtitle_color}};font-size:{{$data->subtitle_size}}">
                                            
                                              @if(!$slang)
                                          @if($lang->id == 2)
                                         {!!$data->subtitle_text_ar!!}
                                          @else 
                                          {!!$data->subtitle_text!!}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {!!$data->subtitle_text_ar!!}
                                          @else
                                          {!!$data->subtitle_text!!}
                                          @endif
                                            
                                            
                                           @endif
                                        </h2>
                                    </div>
                                </div>
                                <div class="mb-0 text-right" >
                                    <button class="btn btn-lg btn-dark appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="600">@if(!$slang)
                                          @if($lang->id == 2)
                                         {!!$data->btn_text_ar!!}
                                          @else 
                                          {{$data->btn_text}}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {!!$data->btn_text_ar!!}
                                          @else
                                          {{$data->btn_text}}
                                          @endif
                                            
                                            
                                           @endif</button>
                                </div>
                            </div>
                        </div><!-- End .home-slide -->
                        
                        
                        @endif
                        
                           
                              @endforeach
                              @endif
                              @endif
						
						
                        

                     
                        
                        
                        
                        
                        
                        
                    </div><!-- End .home-slider -->
                </div><!-- End .home-slider-container -->
            </div><!-- End .container -->
            
            <div class="container banner-container">
                <div class="row">
                    
                    
                    @foreach( $top_small_banners as  $key=>$data) 
                    
                    
                    @if($key ==0 )
                  
                    <div class="col-md-4 col-sm-6 appear-animate" data-animation-name="fadeInRightShorter" data-y="200">
                        <h3 class="subtitle">
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
                                            
                        </h3>
                        <div class="heading-spacer"></div>
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{asset('assets/images/banners/'.$data->photo)}}" width="360" height="270" alt="banner"/>
                            </a>
                            <div class="banner-meta">
                                
                                
                                 @if(!empty($data->link)) 
									<a href="{{$data->link}}" >
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
									@endif
                                
                                   
                                    
                                    
                                    

                               
                            </div><!-- End .banner-meta -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-md-4 -->
                    @endif
                    
                      @if($key ==1 )
                  
                    <div class="col-md-4 col-sm-6 appear-animate"   data-animation-duration="1500">
                        <h3 class="subtitle">
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
                                            
                        </h3>
                        <div class="heading-spacer"></div>
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{asset('assets/images/banners/'.$data->photo)}}" width="360" height="270" alt="banner"/>
                            </a>
                            <div class="banner-meta">
                                
                                
                                 @if(!empty($data->link)) 
									<a href="{{$data->link}}" >
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
									@endif
                                
                                   
                                    
                                    
                                    

                               
                            </div><!-- End .banner-meta -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-md-4 -->
                    @endif
                    
                    
                    
                      @if($key ==2 )
                  
                    <div class="col-md-4 col-sm-6 appear-animate" data-animation-name="fadeInLeftShorter">
                        <h3 class="subtitle">
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
                                            
                        </h3>
                        <div class="heading-spacer"></div>
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{asset('assets/images/banners/'.$data->photo)}}" width="360" height="270" alt="banner"/>
                            </a>
                            <div class="banner-meta">
                                
                                
                                 @if(!empty($data->link)) 
									<a href="{{$data->link}}" >
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
									@endif
                                
                                   
                                    
                                    
                                    

                               
                            </div><!-- End .banner-meta -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-md-4 -->
                    @endif
                  
                    @endforeach
                  
                  
                    
                    
                    
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-3"></div><!-- margin -->
            
            
            @if($ps->featured == 1)
            
            <div class="container feature-container">
                <h2 class="subtitle text-center">{{ $langg->lang26 }}</h2>
                <div class="heading-spacer"></div>
                <div class="row">
                  
                  
                      @foreach($feature_products as $key => $prod)
                    <div class="col-6 col-sm-4 col-md-3 appear-animate" data-animation-delay="100" data-animation-duration="1500">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                
                                
                                
                                <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" width="300" height="300" @if(!$slang)
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
                                                               @endif   >
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}" width="300" height="300" class="hover-image" @if(!$slang)
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
                                   	  <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                
                                
                                
                                </div>
                             
                                 <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{ $langg->lang55 }}">
                                    
                                         {{ $langg->lang55 }}
                                    
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                       
                                        
                                        	<a href="{{ route('front.category',[ 'category' => $prod->category->slug , 'lang' =>$sign ]) }}" class="product-category">
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

											<a href="#" class="add-to-wish btn-icon-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icon-heart"></i>
											</a>

									@endif
                                  
                                </div>
                                <h3 class="product-title">
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
                                </h3>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="product-price">{{ $prod->showPrice() }}– {{ $prod->showPreviousPrice() }}</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                     @endforeach
                </div>
            </div><!-- End .container -->

        @endif
           
           
            @if(!empty($fix_banners[0]))  
            <div class="sale-banner banner appear-animate" data-animation-delay="100" data-animation-duration="1500" 
            style="background-image: url('assets/images/banners/{{$fix_banners[0]->photo}}');background-position: center;background-repeat: no-repeat;background-size: cover;height: 300px;display: flex;align-items: center;">
                <div class="container banner-content">
                    <div class="row no-gutter">
                        <div class="col-auto col-md-4 d-flex flex-column justify-content-center col-1">
                      
                            <h3 class="text-white mb-0 align-left text-uppercase">
                               
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
                        </div>
                        <div class="col-auto col-md-4 col-2">
                            <h2 class="text-white mb-0 position-relative align-left">
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
                            </h2>
                        </div>
                        <div class="mb-0 col-md-4 col-3 col-auto">
                            <button class="btn btn-lg btn-primary">
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
                    </div>
                </div>
            </div>
            
            @endif

            <div class="container">
                <div class="product-widgets row pt-1 m-b-2 mb-6">
                   
                    @if($ps->top_rated ==1)
                    <div class="col-md-4 col-sm-6 pb-5 appear-animate" data-animation-name="fadeInRightShorter">
                        <h4 class="subtitle ta-l ta-r text-uppercase">{{ $langg->lang28}}</h4>
                        <div class="heading-spacer"></div>
                       
                       @foreach($top_products as $prod)
                        <div class="product-default left-details product-widget mb-2">
                            <figure>
                               
                                   
                                    
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="175" height="175" @if(!$slang)
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
                                                               @endif   >
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}"  width="175" height="175" class="hover-image" @if(!$slang)
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
                                     	<a href="{{ route('front.category',[ 'category' => $prod->category->slug , 'lang' =>$sign ]) }}" class="product-category">
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
                     
                      @endforeach
                   
                    </div>
                    
                    
                    @endif
                    
                    
                    
                    
                           @if($ps->best ==1)
                    <div class="col-md-4 col-sm-6 pb-5 appear-animate" data-animation-name="fadeInRightShorter">
                        <h4 class="subtitle ta-l ta-r text-uppercase">{{ $langg->lang27}}</h4>
                        <div class="heading-spacer"></div>
                       
                       @foreach($best_products as $prod)
                        <div class="product-default left-details product-widget mb-2">
                            <figure>
                               
                                   
                                    
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="175" height="175" @if(!$slang)
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
                                                               @endif   >
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}"  width="175" height="175" class="hover-image" @if(!$slang)
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
                                     	<a href="{{ route('front.category',[ 'category' => $prod->category->slug , 'lang' =>$sign ]) }}" class="product-category">
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
                     
                      @endforeach
                   
                    </div>
                    
                    
                    @endif
                    
                    
                    
                    
                        @if($ps->hot_sale ==1)
                    <div class="col-md-4 col-sm-6 pb-5 appear-animate" data-animation-name="fadeInRightShorter">
                        <h4 class="subtitle ta-l ta-r text-uppercase">{{ $langg->lang32}}</h4>
                        <div class="heading-spacer"></div>
                       
                       @foreach($trending_products as $prod)
                        <div class="product-default left-details product-widget mb-2">
                            <figure>
                               
                                   
                                    
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="175" height="175" @if(!$slang)
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
                                                               @endif   >
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}"  width="175" height="175" class="hover-image" @if(!$slang)
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
                                     	<a href="{{ route('front.category',[ 'category' => $prod->category->slug , 'lang' =>$sign ]) }}" class="product-category">
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
                     
                      @endforeach
                   
                    </div>
                    
                    
                    @endif
                    
                    
                    
                    
                        @if($ps->big ==1)
                    <div class="col-md-4 col-sm-6 pb-5 appear-animate" data-animation-name="fadeInRightShorter">
                        <h4 class="subtitle ta-l ta-r text-uppercase">{{ $langg->lang29}}</h4>
                        <div class="heading-spacer"></div>
                       
                       @foreach($big_products as $prod)
                        <div class="product-default left-details product-widget mb-2">
                            <figure>
                               
                                   
                                    
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="175" height="175" @if(!$slang)
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
                                                               @endif   >
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}"  width="175" height="175" class="hover-image" @if(!$slang)
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
                                     	<a href="{{ route('front.category',[ 'category' => $prod->category->slug , 'lang' =>$sign ]) }}" class="product-category">
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
                     
                      @endforeach
                   
                    </div>
                    
                    
                    @endif
                    
                    
                    
                       @if($ps->hot_sale ==1)
                    <div class="col-md-4 col-sm-6 pb-5 appear-animate" data-animation-name="fadeInRightShorter">
                        <h4 class="subtitle ta-l ta-r text-uppercase">{{ $langg->lang31}}</h4>
                        <div class="heading-spacer"></div>
                       
                       @foreach($latest_products as $prod)
                        <div class="product-default left-details product-widget mb-2">
                            <figure>
                               
                                   
                                    
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="175" height="175" @if(!$slang)
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
                                                               @endif   >
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}"  width="175" height="175" class="hover-image" @if(!$slang)
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
                                     	<a href="{{ route('front.category',[ 'category' => $prod->category->slug , 'lang' =>$sign ]) }}" class="product-category">
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
                     
                      @endforeach
                   
                    </div>
                    
                    
                    @endif
                    
                    
                       @if($ps->hot_sale ==1)
                    <div class="col-md-4 col-sm-6 pb-5 appear-animate" data-animation-name="fadeInRightShorter">
                        <h4 class="subtitle ta-l ta-r text-uppercase">{{ $langg->lang30}}</h4>
                        <div class="heading-spacer"></div>
                       
                       @foreach($hot_products as $prod)
                        <div class="product-default left-details product-widget mb-2">
                            <figure>
                               
                                   
                                    
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="175" height="175" @if(!$slang)
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
                                                               @endif   >
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}"  width="175" height="175" class="hover-image" @if(!$slang)
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
                                     	<a href="{{ route('front.category',[ 'category' => $prod->category->slug , 'lang' =>$sign ]) }}" class="product-category">
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
                     
                      @endforeach
                   
                    </div>
                    
                    
                    @endif
                    
                    
                    
                    @if($ps->hot_sale ==1)
                    <div class="col-md-4 col-sm-6 pb-5 appear-animate" data-animation-name="fadeInRightShorter">
                        <h4 class="subtitle ta-l ta-r text-uppercase">{{ $langg->lang33}}</h4>
                        <div class="heading-spacer"></div>
                       
                       @foreach($sale_products as $prod)
                        <div class="product-default left-details product-widget mb-2">
                            <figure>
                               
                                   
                                    
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="175" height="175" @if(!$slang)
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
                                                               @endif   >
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}"  width="175" height="175" class="hover-image" @if(!$slang)
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
                                     	<a href="{{ route('front.category',[ 'category' => $prod->category->slug , 'lang' =>$sign ]) }}" class="product-category">
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
                     
                      @endforeach
                   
                    </div>
                    
                    
                    @endif
                    
                    
                    
                    @if($ps->flash_deal ==1)
                    <div class="col-md-4 col-sm-6 pb-5 appear-animate" data-animation-name="fadeInRightShorter">
                        <h4 class="subtitle ta-l ta-r text-uppercase">{{ $langg->lang244}}</h4>
                        <div class="heading-spacer"></div>
                       
                       @foreach($discount_products as $prod)
                        <div class="product-default left-details product-widget mb-2">
                            <figure>
                               
                                   
                                    
                                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="175" height="175" @if(!$slang)
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
                                                               @endif   >
                                <img src="{{ $prod->hover_photo ? asset('assets/images/products/'.$prod->hover_photo):asset('assets/images/noimage.png') }}"  width="175" height="175" class="hover-image" @if(!$slang)
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
                                     	<a href="{{ route('front.category',[ 'category' => $prod->category->slug , 'lang' =>$sign ]) }}" class="product-category">
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
                     
                      @endforeach
                   
                    </div>
                    
                    
                    @endif
                    
                    
                    
                    
                    
                    
                    
                 
                </div><!-- End .product-widgets -->
            </div>



          	@if($ps->partners == 1)
            <div class="container">
                <div class="brands-slider images-center owl-carousel owl-theme nav-pos-outside show-nav-hover appear-animate" data-toggle="owl" data-owl-options="{
                    'nav': false,
                    'center': true,
                    'dots': true,
                    'loop': true,
                    'margin': 20,
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
                          'items': 2
                        },
                        '900' : {
                          'items' : 5
                        },
                        '1200': {
                          'items' : 5
                        }
                      }
                  }">
                   
                     @foreach($partners as $j)
                               <img src="{{asset('assets/images/partner/'.$j->photo)}}" width="140" height="60" alt="brand">
                           @endforeach
                </div><!-- End .partners-carousel -->
            </div><!-- End .container -->
            
            @endif

          
        </main><!-- End .main -->