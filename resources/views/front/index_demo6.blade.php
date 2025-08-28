@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);
$categorys=App\Models\Category::get();

@endphp

 <main class="main">
     
            <div class="info-boxes-container">
                <div class="container">
                     @foreach($chunk as $key=>$data)
                        
                    <div class="info-box">
                         @if($key==0)  
                           <i class="icon-shipping"></i>
                        @endif
                        
                         @if($key==1)  
                           <i class="icon-us-dollar"></i>
                        @endif
                        
                         @if($key==2)  
                           <i class="icon-support"></i>
                        @endif

                    
                        <div class="info-box-content">
                            <h4>@if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $data->title_ar }}
                                              @else 
                                              {{ $data->title }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $data->title_ar }}
                                              @else
                                              {{ $data->title }} 
                                              @endif
                                @endif</h4>
                            <p>@if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $data->details_ar }}
                                              @else 
                                              {{ $data->details }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $data->details_ar }}
                                              @else
                                              {{ $data->details }} 
                                              @endif
                                @endif</p>
                        </div><!-- End .info-box-content -->
                        
                    </div><!-- End .info-box -->
                    @endforeach
                  
                </div><!-- End .container -->
            </div><!-- End .info-boxes-container -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="home-slider owl-carousel owl-carousel-lazy owl-theme owl-theme-light">
                          
                            @if($ps->slider == 1)
				            @if(count($sliders))
			      		    @foreach($sliders as $data)
                           
                            <div class="home-slide">
                                <div class="owl-lazy slide-bg" data-src="{{asset('assets/images/sliders/'.$data->photo)}}"></div>
                                <div class="home-slide-content text-white">
                                    <h3 style="color:{{$data->title_color}};size:{{$data->title_size}}">@if(!$slang)
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
                                            
                                            
                                         @endif</h3>
                                       <h1 style="color:{{$data->subtitle_color}};size:{{$data->subtitle_size}}">
                                         
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
                                        
                                    </h1>
                                    <p style="color:{{$data->details_color}};size:{{$data->details_size}}">
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
                              
                                        @if(!empty($data->link)) 
                                       <a href="{{$data->link}}" class="btn btn-dark">
                                        @if(!$slang)
                                          @if($lang->id == 2)
                                         {{$data->btn_text_ar}}
                                          @else 
                                          {{$data->btn_text}}
                                          @endif 
                                            @else  
                                          @if($slang == 2) 
                                          {{$data->btn_text_ar}}
                                          @else
                                          {{$data->btn_text}}
                                          @endif
                                            
                                            
                                           @endif
                                           
                                       </a>
                                       @endif
                                </div><!-- End .home-slide-content -->
                            </div><!-- End .home-slide -->
                     @endforeach
                  @endif
             @endif
                            
                        </div><!-- End .home-slider -->

                        <div class="row">
                            
                            @foreach( $top_small_banners as $data) 
                            <div class="col-md-4">
                                <div class="banner banner-image">
                                    <a href="{{$data->link}}">
                                        <img src="{{asset('assets/images/banners/'.$data->photo)}}" alt="banner">
                                    </a>
                                </div><!-- End .banner -->
                            </div><!-- End .col-md-4 -->

                          @endforeach

                        </div><!-- End .row -->

                        <div class="mb-3"></div><!-- margin -->
      
                 
                        @if($ps->featured == 1)
               
                        <h2 class="carousel-title">{{ $langg->lang26 }}</h2>

                        <div class="home-featured-products owl-carousel owl-theme owl-dots-top">
                          
                   
                        @foreach($feature_products as $key => $prod)
                        
                            <div class="product">
                                <figure class="product-image-container">
                                    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" class="product-image">
                                        <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
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
                                <div class="product-details">
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <h2 class="product-title" >
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
									  <a data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>Add to Wishlist</span>
                                        </a>
                                        @endif

									
                                      @if($prod->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                       <a  class="paction add-cart add-to-cart addtocart-btn" data-href="{{ route('product.cart.add',$prod->id) }}"   title="Add to Cart">
                                            <span>@if($langg->rtl != "1") Add to Cart @else اضافة الى العربة @endif</span>
                                        </a>
            
                                                @endif
                                      

                                        <a href="#" class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                            <span>Add to Compare</span>
                                        </a>
                                    </div><!-- End .product-action -->
                                </div><!-- End .product-details -->
                            </div><!-- End .product -->

                         @endforeach  
                           
                        </div>
                        
                        @endif

                        <div class="mb-6"></div>

                        <div class="row">
                            <div class="col-6 col-md-4">
                                <div class="product-column">
                                    
                                    <h3 class="title">{{$langg->lang31}}</h3>

                                    @foreach($latest_products as $prod)
                                    
                                    <div class="product product-sm">
                                        <figure class="product-image-container">
                                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
                                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
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
                                                <a href="{{route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}"> 
                                              
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
                                                </div><!-- End .product-ratings -->
                                            </div><!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">{{ $prod->showPrice() }}</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div><!-- End .product -->

                                  @endforeach

                                  
                                  
                                  
                                  
                                </div><!-- End .product-column -->
                            </div><!-- End .col-md-4 -->

                            <div class="col-6 col-md-4">
                                <div class="product-column">
                                    <h3 class="title">{{$langg->lang30}}</h3>

                                    @foreach($hot_products as $prod)
                                    
                                    <div class="product product-sm">
                                        <figure class="product-image-container">
                                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
                                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
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
                                                <a href="{{route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}"> 
                                              
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
                                                </div><!-- End .product-ratings -->
                                            </div><!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">{{ $prod->showPrice() }}</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div><!-- End .product -->
                                  @endforeach
                                </div><!-- End .product-column -->
                            </div><!-- End .col-md-4 -->

                            <div class="col-6 col-md-4">
                                <div class="product-column">
                                    <h3 class="title">{{$langg->lang33}}</h3>

                                    
                                      @foreach($sale_products as $prod)
                                    
                                    <div class="product product-sm">
                                        <figure class="product-image-container">
                                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
                                                <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" @if(!$slang)
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
                                                <a href="{{route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}"> 
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
                                                </div><!-- End .product-ratings -->
                                            </div><!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">{{ $prod->showPrice() }}</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div><!-- End .product -->

                                  @endforeach
                                   

                                   
                                   
                                   
                                   
                                </div><!-- End .product-column -->
                            </div><!-- End .col-md-4 -->
                        </div><!-- End .row -->

                        <div class="mb-3"></div><!-- margin -->

                        <div class="row">
                            
                            
                            
                        @foreach($chunkss as $key=>$data )
                        
                       
                       
                            <div class="col-sm-6 col-md-4">
                                <div class="feature-box feature-box-simple text-center">
                                    @if($key == 0)
                                        <i class="icon-star"></i>
                                    @endif
                                    @if($key == 1)
                                     
                                        <i class="icon-reply"></i>
                        
                                   @endif
                                    @if($key == 2)
                                      <i class="icon-paper-plane"></i>
                                   @endif
                                   

                                    <div class="feature-box-content">
                                        <h3>
                                            @if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $data->title_ar }}
                                              @else 
                                              {{ $data->title }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $data->title_ar }}
                                              @else
                                              {{ $data->title }} 
                                              @endif
                                      @endif
                                            
                                        </h3>
                                        <p>@if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $data->details_ar }}
                                              @else 
                                              {{ $data->details }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $data->details_ar }}
                                              @else
                                              {{ $data->details }} 
                                              @endif
                                @endif</p>
                                
                                       @if($key == 0)
                                        <a href="{{ route('front.contact',$sign) }}" class="btn btn-outline-dark">@if($langg->rtl != "1") GET IN TOUCH @else اتصل بنا @endif</a>
                                      
                                      @endif
                                   
                                    @if($key == 1)
                                    
                                      <a href="{{ url('/white-friday') }}" class="btn btn-outline-dark">@if($langg->rtl != "1") RETURN POLICY @else  سياسة الاسترجاع  @endif</a>
                                       
                        
                                   @endif
                                    @if($key == 2)
                                      <a href="{{ url('/terms') }}" class="btn btn-outline-dark">@if($langg->rtl != "1") LEARN MORE @else اكتشف المزيد  @endif</a>
                                   @endif
                                        
                                    </div><!-- End .feature-box-content -->
                                </div><!-- End .feature-box -->
                            </div><!-- End .col-md-4 -->

                          
                       
                       
                       @endforeach
                       
                        </div><!-- End .row -->
                    </div><!-- End .col-lg-9 -->

                    <aside class="sidebar-home col-lg-3 order-lg-first">
                        <div class="side-menu-container">
                            <h2>{{ $langg->lang14 }}</h2>

                            <nav class="side-nav">
                                <ul class="menu menu-vertical sf-arrows">
                                    <li class="active"><a href="{{route('front.index',$sign)}}"><i class="icon-home"></i>{{ $langg->lang17 }}</a></li>
                                    <li>
                                        <a href="category.html" class="sf-with-ul"><i class="icon-briefcase"></i>
                                        @if($langg->rtl != "1") Shop  @else المتجر   @endif</a>
                                        
                                          <ul>
                                                                
                                                                
                                                 @foreach($categorys as $data) 
                                         <li> <a href="{{ route('front.category',  ['category' => $data->slug , 'lang' => $sign]) }}"   @if(count($data->subs) > 0 )  class="sf-with-ul" @endif>
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
                                                <ul>
                                                 @foreach($data->subs as $subcat)
											    <li>
												  <a  href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug ,'lang' => $sign])}}">
        
                                                                
                                                                  
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
                                                                  
                                                                  </a>
													          </li>
												            	@endforeach
                                                             </ul>
                                                             @endif
                                                 </li>
                                                            @endforeach
                                                               
                                            </ul>
                                                       
                                    </li>
                                    
                                    
                                 <li>
                                        <a href="#" class="sf-with-ul"><i class="icon-briefcase"></i>
                                        @if($langg->rtl != "1") Products  @else المنتجات   @endif</a></a>
                                        
                                            <ul>
                                                                
                                                                
                                                 @foreach($feature_products as $prod) 
                                         <li> <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign])}}" >
                                             
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

                                              
                                         </li>
                                        @endforeach
                                      
                                                               
                                            </ul>
                                                       
                                 </li>
                                    
                                    <li>
                                        <a href="#" class="sf-with-ul"><i class="icon-docs-inv"></i> @if($langg->rtl != "1") Pages  @else الصفحات   @endif</a></a>

                                        <ul>
                                             <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
							                        @foreach(DB::table('pages')->where('header','=',1)->get() as $data)
							     	             <li><a href="{{ route('front.page', ['slug' => $data->slug , 'lang' => $sign]) }}">
							     	                     @if(!$slang)
                                                          @if($lang->id == 2)
                                                         {{ $data->title_ar }}
                                                          @else 
                                                          
                                                         {{ $data->title }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {{ $data->title_ar }}
                                                          @else
                                                          {{ $data->title }}
                                                          @endif
                                                      @endif</a></li> 
                                                      @endforeach
                                	<li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
   
                                        @if(!Auth::check())
                                      <li> <a href="{{url('user/login')}}">{{ $langg->lang12 }}</a>
                                      </li>
                                        @else
        							    	<li>
										    	<a href="{{ route('user-logout') }}">{{ $langg->lang223 }}</a>
									    	</li>
                                         @endif
                                         
                                         
                                        </ul>
                                        
                                        
                                    </li>
                                    <li><a href="#" class="sf-with-ul"><i class="icon-sliders"></i>@if($langg->rtl != "1") Profile  @else البروفايل   @endif</a>
                                        <ul>
                                            
                                            
                                               @if(!Auth::guard('web')->check())
                									<li class="login">
                										<a href="{{ route('user.login') }}" class="sign-log">
                											<div class="links">
                												<span class="sign-in">{{ $langg->lang12 }}</span> <span>|</span>
                												<span class="join">{{ $langg->lang13 }}</span>
                											</div>
                										</a>
                									</li>
									
								
								       	 @else 
									 
									 	@if(Auth::user()->IsVendor())
								
								        
													<li>
														<a href="{{ route('vendor-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang11 }}</a>
								
													</li>
														<li>
														<a href="{{ route('user-logout') }}"> {{ $langg->lang223 }}</a>
								              		</li>
												
													
										@else	
										
									<li>
										<a href="{{ route('user-dashboard') }}"> {{ $langg->lang11 }}</a>
									</li>
									
									 	<li>
														<a href="{{ route('user-logout') }}"> {{ $langg->lang223 }}</a>
										</li>
									@endif	
                               
						      @endif
                                            
                                            
						    
									
							
							  	
                        			@if($gs->reg_vendor == 1)
									
                        				@if(Auth::check())
	                        				@if(Auth::guard('web')->user()->is_vendor == 2)
	                        				
	                        				    <li>
	                        					<a href="{{ route('user-package') }}" class="sell-btn">{{ $langg->lang11 }}</a>
	                        					</li>
	                        				@endif
									
									@endif
									
									@endif
                        		
									
										
							      
                            </ul>
                         </li>
                        
                        
                                    <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
                                </ul>
                            </nav>
                        </div><!-- End .side-menu-container -->
                        <div class="widget widget-banners">
                            <div class="widget-banners-slider owl-carousel owl-theme">
                                
                                @foreach($bottom_small_banners as $data)
                                <div class="banner banner-image">
                                    <a href="{{$data->link}}">
                                        <img src="{{asset('assets/images/banners/'.$data->photo)}}" alt="banner">
                                    </a>
                                </div><!-- End .banner -->
                              
                                @endforeach
                              
                            </div><!-- End .banner-slider -->
                        </div><!-- End .widget -->

                        <div class="widget widget-newsletters">
                            <h3 class="widget-title">{{$langg->newsletter}}</h3>
                            <p>
                                 
                                  @if(!$slang)
                                                          @if($lang->id == 2)
                                                          {{$gs->subscribee_message_ar}}
                                                          @else 
                                                          
                                                          {{$gs->subscribee_message}}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          {{$gs->subscribee_message_ar}}
                                                          @else
                                                           {{$gs->subscribee_message}}
                                                          @endif
                                                      @endif
                                   
                                
                                
                                </p>
                            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST" >
                                <div class="form-group">
                                    {{csrf_field()}}
                              
                                <input type="email" class="form-control" name="email" id="email" required="">
                                
                                    <label for="email"><i class="icon-envolope"></i>{{ $langg->lang49 }}</label>
                                </div><!-- Endd .form-group -->
                              
                              <input type="submit" class="btn btn-block"   value = "{{ ($langg->rtl != '1')  ?    'Subscribe Now' :  'ابدأ' }}">

                            </form>
                        </div><!-- End .widget -->

                        <div class="widget widget-testimonials">
                            <div class="widget-testimonials-slider owl-carousel owl-theme">
                                
                                @foreach($reviews as $data )
                                <div class="testimonial">
                                    <div class="testimonial-owner">
                                        <figure>
                                            <img src="{{asset('assets/images/reviews/'.$data->photo)}}" alt="client">
                                        </figure>

                                        <div>
                                            <h4 class="testimonial-title">
                                                @if(!$slang)
                                                          @if($lang->id == 2)
                                                         {{ $data->title_ar }}
                                                          @else 
                                                          
                                                         {{ $data->title }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {{ $data->title_ar }}
                                                          @else
                                                          {{ $data->title }}
                                                          @endif
                                                      @endif
                                            </h4>
                                            <span>
                                                @if(!$slang)
                                                          @if($lang->id == 2)
                                                         {{ $data->subtitle_ar }}
                                                          @else 
                                                          
                                                         {{ $data->subtitle }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {{ $data->subtitle_ar }}
                                                          @else
                                                          {{ $data->subtitle }}
                                                          @endif
                                                      @endif
                                            </span>
                                        </div>
                                    </div><!-- End .testimonial-owner -->

                                    <blockquote>
                                        <p>@if(!$slang)
                                                          @if($lang->id == 2)
                                                         {{ $data->details_ar }}
                                                          @else 
                                                          
                                                         {{ $data->details }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                         {{ $data->details_ar }}
                                                          @else
                                                          {{ $data->details }}
                                                          @endif
                                                      @endif</p>
                                    </blockquote>
                                </div><!-- End .testimonial -->
                             @endforeach
                               
                            </div><!-- End .testimonials-slider -->
                        </div><!-- End .widget -->

                        <div class="widget">
                            <div class="widget-posts-slider owl-carousel owl-theme">
                                <div class="post">
                                    <span class="post-date">01- Jun -2018</span>
                                    <h4 class="post-title"><a href="#">Fashion News</a></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi. </p>
                                </div><!-- End .post -->

                                <div class="post">
                                    <span class="post-date">22- May -2018</span>
                                    <h4 class="post-title"><a href="#">Shopping News</a></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non plasasyi. </p>
                                </div><!-- End .post -->

                                <div class="post">
                                    <span class="post-date">13- May -2018</span>
                                    <h4 class="post-title"><a href="#">Fashion News</a></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat. </p>
                                </div><!-- End .post -->
                            </div><!-- End .posts-slider -->
                        </div><!-- End .widget -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-4"></div><!-- margin -->
        </main><!-- End .main -->