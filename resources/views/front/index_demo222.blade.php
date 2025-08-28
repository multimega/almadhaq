@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<style>
@if(!empty($large_banners[0]))
.parallax-background{
    background-image: url("{{('assets/images/banners/'.$large_banners[0]->photo)}}");
}
@endif
</style>
<main class="main">
			<div class="home-slider-container clearfix">
				<div class="home-slider owl-carousel owl-theme show-nav-hover nav-large">
				    @if($ps->slider == 1)
    				   @if(count($sliders))
    					@foreach($sliders as $data)
					<div class="home-slide home-slide1 d-flex align-items-center banner">
						<div class="slide-bg owl-lazy" data-src="assets/images/sliders/{{$data->photo}}"></div><!-- End .slide-bg -->
						<div class="container">
							<div class="banner-layer banner-layer-middle float-right">
							
								<h2 class="text-uppercase rotated-upto-text mb-0">
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
								</h2>
								<h3 class="m-b-1">
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
								</h3>

								<hr class="divider-short-thick">

								<!--<h5 class="text-uppercase d-inline-block mb-0 ls-n-20">Starting at <span class="ml-2">$<em>39</em>99</span></h5>-->
								<a href="{{$data->link}}" class="btn btn-light btn-xl btn-icon-right" role="button">{{ $langg->lang25 }} <i class="fas fa-long-arrow-alt-right"></i></a>
							</div><!-- End .banner-layer -->
						</div>
					</div><!-- End .home-slide -->
                        @endforeach
                      @endif
                     @endif
					
				</div><!-- End .home-slider -->
			</div><!-- End .home-slider-container -->

			<div class="banners-container text-uppercase clear">
				<div class="container">
					<div class="row row-joined">
						@foreach($categories->where('is_featured','=',1)->take(3) as $category)
						<div class="banner col-md-4">
							<div class="banner-content text-left">
								<h3 class="banner-title m-b-1">
								     @if(!$slang)
                                      @if($lang->id == 2)
                                      {{ $category->name_ar }}
                                      @else 
                                      {{ $category->name }}
                                      @endif 
                                  @else  
                                      @if($slang == 2) 
                                      {{ $category->name_ar }}
                                      @else
                                      {{ $category->name }}
                                      @endif
                                  @endif
								</h3>
								<p>{{$category->products->count()}}</p>
								<hr class="divider-short-thick">

								<a href="{{ route('front.category',['category' => $category->slug ,'lang' => $sign ]) }}" class="btn">{{ $langg->lang25 }} <i class="fas fa-long-arrow-alt-right"></i></a>
							</div><!-- End .banner-content -->
							<a href="{{ route('front.category',['category' => $category->slug ,'lang' => $sign ]) }}">
								<img src="assets/images/categories/{{$category->photo}}">
							</a>
						</div><!-- End .banner -->
						@endforeach
					</div><!-- End .row -->
				</div><!-- End .container -->
			</div><!-- End .banners-container -->

			<div class="container mb-5">
            	<div class="info-boxes-container">
					<div class="row row-joined">
						@foreach($chunk as $service)
						<div class="info-box info-box-icon-left col-lg-4">
							<i class="icon-{{$service->icon}}"></i>

							<div class="info-box-content">
								<h4>@if(!$slang) 
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
                              @endif
								</p>
							</div><!-- End .info-box-content -->
						</div><!-- End .info-box -->
						@endforeach
					</div><!-- End .row -->
				</div><!-- End .info-boxes-container -->
			</div><!-- End .container -->

			<div class="container mb-4 mb-lg-6">
			    @if($ps->featured ==1)
				<h2 class="section-title text-center mb-0">{{ $langg->lang26}}</h2>

				<div class="row product-ajax-grid">
					@foreach($feature_products as $prod)
					<div class="col-sm-3 col-6">
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
                                        <div class="product-label label-sale">{{ $prod->features[$key] }} </div>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								     @if($prod->emptyStock())
                                      <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
                                    @else    
                                   	<button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon-wish paction add-wishlist add-to-wish">
                                        <i class="icon-heart"></i>
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
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
								    <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $prod->showPrice() }}</span></span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
						</div>
					</div><!-- End .col-md-3 -->
					@endforeach
				</div><!-- End .row -->
                @endif
				<a class="btn btn-dark btn-lg btn-center loadmore mt-1" href="#">Load More</a>

				<hr>
@if(count($categories->where('is_featured','=',1)) > 0)
	<h2 class="section-title text-center mb-0">{{$langg->lang832}}</h2>
				<p class="section-description text-center mb-3">{{$langg->lang833}}</p>

				<div class="owl-carousel owl-theme categories-slider content-center-bottom nav-outer">
				    @foreach($categories->where('is_featured','=',1) as $category)
					<div class="product-category">
						<a href="{{ route('front.category',['category' => $category->slug ,'lang' => $sign ]) }}">
							<figure>
								<img src="assets/images/categories/{{$category->photo}}">
							</figure>
							<div class="category-content">
								<h3>
								     @if(!$slang)
                                      @if($lang->id == 2)
                                      {{ $category->name_ar }}
                                      @else 
                                      {{ $category->name }}
                                      @endif 
                                  @else  
                                      @if($slang == 2) 
                                      {{ $category->name_ar }}
                                      @else
                                      {{ $category->name }}
                                      @endif
                                  @endif
								</h3>
							</div>
						</a>
					</div>
					@endforeach
				</div><!-- End .categories-slider -->
@endif
			
			</div><!-- End .container -->
            
			@if(!empty($large_banners[0]))
			<div class="promo-section mb-5" data-parallax="{'speed': 1.5}" data-image-src="{{('assets/images/banners/'.$large_banners[0]->photo)}}">
				<div class="promo-content">
				
					    <h2>@if(!$slang)
                                          @if($lang->id == 2)
                                            {!!$large_banners[0]->title_ar!!}
                                          @else 
                                            {!!$large_banners[0]->title!!}
                                          @endif 
                                            @else  
                                              @if($slang == 2) 
                                                {!!$large_banners[0]->title_ar!!}
                                              @else
                                                {!!$large_banners[0]->title!!}
                                              @endif
                                          @endif</h2>	
                                          <h3 class="m-b-1">@if(!$slang)
                                          @if($lang->id == 2)
                                        {!!$large_banners[0]->subtitle_ar!!}
                                          @else 
                                          {!!$large_banners[0]->subtitle!!}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!!$large_banners[0]->subtitle_ar!!}
                                          @else
                                          {!!$large_banners[0]->subtitle!!}
                                          @endif
                                      @endif</h3>
					<hr class="divider-short-thick">
					<a href="{{$large_banners[0]->link}}" class="btn btn-light ls-n-25">@if(!$slang)
                                           @if($lang->id == 2)
                                            {!!$large_banners[0]->btn_ar!!}  
                                          @else 
                                           {!!$large_banners[0]->button!!}  
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            {!!$large_banners[0]->btn_ar!!}  
                                          @else
                                           {!!$large_banners[0]->button!!}  
                                          @endif
                                        @endif   <i class="fas fa-long-arrow-alt-right ml-2"></i></a>
				</div>
			</div><!-- End .promo-section -->
            @endif
			<div class="container mb-2 mb-lg-4">
			    @if($ps->best ==1)
				<h2 class="section-title text-center mb-0">{{ $langg->lang27}}</h2>

				<div class="row pb-2">
				    @foreach($best_products as $prod)
					<div class="col-sm-4">
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
                                        <div class="product-label label-sale">{{ $prod->features[$key] }} </div>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								      @if($prod->emptyStock())
                                      <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
                                    @else    
                                   	<button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon-wish paction add-wishlist add-to-wish">
                                        <i class="icon-heart"></i>
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
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
								    <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $prod->showPrice() }}</span></span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
						</div>
					</div><!-- End .col-sm-4 -->
					@endforeach
				</div><!-- End .row -->
                @endif
                
                @if($ps->big ==1)
				<h2 class="section-title text-center mb-0">{{ $langg->lang29}}</h2>

				<div class="row pb-2">
				    @foreach($big_products as $prod)
					<div class="col-sm-4">
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
                                        <div class="product-label label-sale">{{ $prod->features[$key] }} </div>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								    @if($prod->emptyStock())
                                    <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
                                    @else    
                                   	<button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon-wish paction add-wishlist add-to-wish">
                                        <i class="icon-heart"></i>
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
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
								    <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $prod->showPrice() }}</span></span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
						</div>
					</div><!-- End .col-sm-4 -->
					@endforeach
				</div><!-- End .row -->
                @endif
                
                @if($ps->top_rated ==1)
				<h2 class="section-title text-center mb-0">{{ $langg->lang28}}</h2>

				<div class="row pb-2">
				    @foreach($top_products as $prod)
					<div class="col-sm-4">
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
                                        <div class="product-label label-sale">{{ $prod->features[$key] }} </div>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								     @if($prod->emptyStock())
                                    <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
                                    @else    
                                   	<button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon-wish paction add-wishlist add-to-wish">
                                        <i class="icon-heart"></i>
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
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
								    <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $prod->showPrice() }}</span></span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
						</div>
					</div><!-- End .col-sm-4 -->
					@endforeach
				</div><!-- End .row -->
                @endif
                
                @if($ps->flash_deal ==1)
				<h2 class="section-title text-center mb-0">{{ $langg->lang244}}</h2>

				<div class="row pb-2">
				    @foreach($discount_products as $prod)
					<div class="col-sm-4">
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
                                        <div class="product-label label-sale">{{ $prod->features[$key] }} </div>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								     @if($prod->emptyStock())
                                    <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
                                    @else    
                                   	<button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon-wish paction add-wishlist add-to-wish">
                                        <i class="icon-heart"></i>
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
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
								    <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $prod->showPrice() }}</span></span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
						</div>
					</div><!-- End .col-sm-4 -->
					@endforeach
				</div><!-- End .row -->
                @endif
                
                @if($ps->hot_sale ==1)
				<h2 class="section-title text-center mb-0">{{ $langg->lang33}}</h2>

				<div class="row pb-2">
				    @foreach($sale_products as $prod)
					<div class="col-sm-4">
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
                                        <div class="product-label label-sale">{{ $prod->features[$key] }} </div>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								     @if($prod->emptyStock())
                                    <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
                                    @else    
                                   	<button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="btn-icon-wish paction add-wishlist add-to-wish">
                                        <i class="icon-heart"></i>
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
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
								    <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $prod->showPrice() }}</span></span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
						</div>
					</div><!-- End .col-sm-4 -->
					@endforeach
				</div><!-- End .row -->
                @endif
				<hr class="mt-1">

				<div class="row">
				    @if($ps->hot_sale ==1)
					<div class="col-md-4 pb-5 pb-md-0">
						<h4 class="section-sub-title mb-2">{{ $langg->lang32}}</h4>
						@foreach($trending_products->take(3) as $prod)
							<div class="product-default left-details product-widget">
								<figure>
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
										<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="95" height="95"
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
								</figure>
								<div class="product-details">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
									<h2 class="product-title">
										<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
					@endif
					@if($ps->hot_sale ==1)
					<div class="col-md-4 pb-5 pb-md-0">
						<h4 class="section-sub-title mb-2">{{ $langg->lang30}}</h4>
						@foreach($hot_products->take(3) as $prod)
							<div class="product-default left-details product-widget">
								<figure>
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
										<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="95" height="95"
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
								</figure>
								<div class="product-details">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
									<h2 class="product-title">
										<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
					@endif
					@if($ps->hot_sale ==1)
					<div class="col-md-4 pb-5 pb-md-0">
						<h4 class="section-sub-title mb-2">{{ $langg->lang31}}</h4>
						@foreach($latest_products->take(3) as $prod)
							<div class="product-default left-details product-widget">
								<figure>
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
										<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  width="95" height="95"
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
								</figure>
								<div class="product-details">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
									<h2 class="product-title">
										<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
					@endif
				</div><!-- End .row -->
			</div><!-- End .container -->

			<div class="blog-section">
				<div class="container">
					<h2 class="section-title text-center mb-0">{{$langg->lang834}}</h2>
					<p class="section-description text-center mb-3 mb-lg-5">{{$langg->lang835}}</p>

					<div class="owl-carousel owl-theme mb-6 pb-2" data-owl-options="{
						'loop': false,
						'margin': 20,
						'autoHeight': true,
						'autoplay': false,
						'items': 2,
						'responsive': {
							'768': {
								'items': 2
							}
						}
					}">
					    @foreach(DB::table('blogs')->orderby('id','desc')->get() as $blogg)
						<article class="post">
							<div class="post-media">
								<a href="single.html">
								    <img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" width="225" height="280" alt="@if(!$slang)
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
								</a>
							</div><!-- End .post-media -->

							<div class="post-body">
								<h2 class="post-title">
									<a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign ])}}">
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
									</a>
								</h2>
								<div class="post-date">{{date('d', strtotime($blogg->created_at))}} - {{date('m', strtotime($blogg->created_at))}}</div><!-- End .post-date -->
								<div class="post-content">
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
                                    <a href="{{route('front.blogshow',['id' => $blogg->id , 'lang' => $sign ])}}" class="read-more">{{ $langg->lang38 }} <i class="fas fa-long-arrow-alt-right ml-1"></i></a>

								</div><!-- End .post-content -->
							</div><!-- End .post-body -->
						</article><!-- End .post -->
                        @endforeach
					</div>

					<a class="btn btn-dark btn-lg btn-center" href="blog.html">Our Blog</a>
				</div><!-- End .container -->
			</div><!-- End .blog-section -->

			<!--<div class="brands-section">
				<div class="container">
					<div class="brands-slider owl-carousel owl-theme images-center">
						@foreach($partners as $j)
                            <img src="{{asset('assets/images/partner/'.$j->photo)}}" width="140" height="60" alt="brand">
                        @endforeach
					</div><
				</div>
			</div>-->
		</main><!-- End .main -->