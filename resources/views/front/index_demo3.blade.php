
@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<style>
    .home-slide:before, .category-slide:before,
    .home-slide:after, .category-slide:after{
        content: unset;
    }
    .banners-slider .owl-item img{
        height: 300px;
    }
</style>
        <main class="main">
			<div class="container">
				<div class="home-slider-container">
					<div class="home-slider owl-carousel owl-carousel-lazy owl-theme owl-drag drag" data-owl-options="{
						'loop': false
					}">
					    @if($ps->slider == 1)
            				   @if(count($sliders))
            					@foreach($sliders as $data)
        						<div class="home-slide home-slide1 banner banner-md-vw-small banner-sm-vw-small">
        							<img class="slide-bg" src="assets/images/sliders/{{$data->photo}}" data-src="assets/images/sliders/{{$data->photo}}" alt="slider image" width="1120" height="475">
        							<div class="banner-layer banner-layer-middle">
        								<h2 class="ls-n-20 m-b-2">
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
        								</h2>
        								<!--<h3 class="mb-1"><em class="text-center ls-0">up<br>to</em>50% OFF</h3>-->
        								<h4 class="text-uppercase d-inline-block mb-0 align-top pt-2">
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
        								</h4>
        								<a href="{{$data->link}}" class="btn btn-dark btn-outline btn-xl mt-1">{{ $langg->lang25 }}</a>
        							</div><!-- End .banner-layer -->
        						</div><!-- End .home-slide -->
                            @endforeach
                                @endif
                                 @endif
                                 
						  
					</div><!-- End .home-slider -->
				</div><!-- End .home-slider-container -->

				<div class="brands-slider owl-carousel owl-theme images-center">
				    @foreach($partners as $j)
                        <img src="{{asset('assets/images/partner/'.$j->photo)}}" width="140" height="60" alt="brand">
                    @endforeach
				</div><!-- End .brands-slider -->
			</div><!-- End .container -->

			<div class="banners-section bg-gray">
				<div class="container mb-2">
					<div class="banners-slider owl-carousel owl-theme">
						@foreach($fix_banners as $banner)
						<div class="banner banner-sm-vw-large text-right">
							<figure>
								<img src="{{('assets/images/banners/'.$banner->photo)}}" alt="banner">
							</figure>

							<div class="banner-layer banner-layer-top">
								<h3 class="m-b-1">
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
								</h3>
								<h4>
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
								</h4>
							</div>

							<div class="banner-layer banner-layer-bottom">
								<a href="{{$banner->link}}" class="btn btn-dark btn-lg">
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
								</a>
							</div><!-- End .home-banner-content -->

							<div class="banner-layer banner-layer-bottom banner-layer-left">
								<img src="assets/images/banners/brand-3.jpg" width="70" height="18" alt="brand" class="banner-layer-vertical-item">
							</div>
						</div><!-- End .home-banner -->
						@endforeach
					</div><!-- End .banners-slider -->
				</div><!-- End .container -->
			</div>

			<div class="section shop-section mb-4">
				<div class="container">
					<h2 class="section-title mb-3">Browse By Category</h2>
					
					<div class="cats-slider owl-carousel owl-theme nav-thick show-nav-hover nav-outer pb-2 m-b-4" data-owl-options="{
						'items': 2,
						'margin': 20,
						'dots': false,
						'nav': true,
						'responsive': {
							'576': {
								'items': 3
							},
							'992': {
								'items': 4
							}
						}
					}">
						@foreach($categories->where('is_featured','=',1) as $category)
						<div class="product-category content-center overlay-light">
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
									<span><mark class="count">{{$category->products->count()}}</mark> products</span>
								</div>
							</a>
						</div><!-- End .product-category -->
						@endforeach
					</div>

					@if($ps->featured ==1)
					<h2 class="section-title mb-3">{{ $langg->lang26}}</h2>
					
					<div class="products-grid grid row">
						<div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark col-md-6 grid-height-1 w-md-100">
							<figure>
								<a href="{{ route('front.product',  ['slug' => $feature_products[0]->slug , 'lang' => $sign]) }}">
									<img src="{{ $feature_products[0]->photo ? asset('assets/images/thumbnails/'.$feature_products[0]->thumbnail):asset('assets/images/noimage.png') }}" 
									@if(!$slang)
                                         @if($lang->id == 2)
                                                               
                                          alt="{{$feature_products[0]->alt_ar}}"        
                                          @else 
                                           alt="{{$feature_products[0]->alt}}"    
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                              alt="{{$feature_products[0]->alt_ar}}"    
                                          @else
                                               alt="{{$feature_products[0]->alt}}"    
                                          @endif
                                           @endif>

								</a>
								<div class="label-group">
									@if(!empty($feature_products[0]->features))
                                        @foreach($feature_products[0]->features as $key => $data1)
                                        
                                     	@if(!empty($feature_products[0]->features[$key]))
                                        <span class="product-label label-sale" style="">{{ $feature_products[0]->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$feature_products[0]->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
                                    @endif
								
							   @if($feature_products[0]->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button onClick='renderImage("{{asset("assets/images/thumbnails/".$feature_products[0]->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$feature_products[0]->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
							
							
							
								</div>
                                <a href="{{ route('product.quickz',$feature_products[0]->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>
							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $feature_products[0]->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$feature_products[0]->category->name}}</a>
									</div>
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$feature_products[0]->slug , 'lang' => $sign] ) }}">
                                            @if(!$slang)
                                          @if($lang->id == 2)
                                         {!! $feature_products[0]->showName_ar() !!}
                                          @else 
                                          
                                        {{ $feature_products[0]->showName() }}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!! $feature_products[0]->showName_ar() !!}
                                          @else
                                          {{ $feature_products[0]->showName() }}
                                          @endif
                                      @endif
                                    </a>
								</h2>
								<div class="ratings-container">
									<div class="product-ratings">
										<span class="ratings" style="width:{{App\Models\Rating::ratings($feature_products[0]->id)}}%"></span><!-- End .ratings -->
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
									<span class="old-price">{{ $feature_products[0]->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $feature_products[0]->showPrice() }}</span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
						</div>

						<div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark col-md-3 grid-height-1 w-md-50 w-xs-100">
							<figure>
								<a href="{{ route('front.product',  ['slug' => $feature_products[1]->slug , 'lang' => $sign]) }}">
									<img src="{{ $feature_products[1]->photo ? asset('assets/images/thumbnails/'.$feature_products[1]->thumbnail):asset('assets/images/noimage.png') }}" 
									@if(!$slang)
                                         @if($lang->id == 2)
                                                               
                                          alt="{{$feature_products[1]->alt_ar}}"        
                                          @else 
                                           alt="{{$feature_products[1]->alt}}"    
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                              alt="{{$feature_products[1]->alt_ar}}"    
                                          @else
                                               alt="{{$feature_products[1]->alt}}"    
                                          @endif
                                           @endif>

								</a>
								<div class="label-group">
									@if(!empty($feature_products[1]->features))
                                        @foreach($feature_products[1]->features as $key => $data1)
                                        
                                     	@if(!empty($feature_products[1]->features[$key]))
                                        <span class="product-label label-sale" style="">{{ $feature_products[1]->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$feature_products[1]->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
                                    @endif
  @if($feature_products[1]->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button onClick='renderImage("{{asset("assets/images/thumbnails/".$feature_products[1]->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$feature_products[1]->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif						</div>
                                <a href="{{ route('product.quickz',$feature_products[1]->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>
							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $feature_products[1]->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$feature_products[1]->category->name}}</a>
									</div>
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$feature_products[1]->slug , 'lang' => $sign] ) }}">
                                            @if(!$slang)
                                          @if($lang->id == 2)
                                         {!! $feature_products[1]->showName_ar() !!}
                                          @else 
                                          
                                        {{ $feature_products[1]->showName() }}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!! $feature_products[1]->showName_ar() !!}
                                          @else
                                          {{ $feature_products[1]->showName() }}
                                          @endif
                                      @endif
                                    </a>
								</h2>
								<div class="ratings-container">
									<div class="product-ratings">
										<span class="ratings" style="width:{{App\Models\Rating::ratings($feature_products[1]->id)}}%"></span><!-- End .ratings -->
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
									<span class="old-price">{{ $feature_products[1]->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $feature_products[1]->showPrice() }}</span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
						</div>
                        <div class="col-md-3 p-0">
                            <div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark grid-height-1-2 w-md-50 w-xs-100">
							<figure>
								<a href="{{ route('front.product',  ['slug' => $feature_products[2]->slug , 'lang' => $sign]) }}">
									<img src="{{ $feature_products[2]->photo ? asset('assets/images/thumbnails/'.$feature_products[2]->thumbnail):asset('assets/images/noimage.png') }}" 
									@if(!$slang)
                                         @if($lang->id == 2)
                                                               
                                          alt="{{$feature_products[2]->alt_ar}}"        
                                          @else 
                                           alt="{{$feature_products[2]->alt}}"    
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                              alt="{{$feature_products[2]->alt_ar}}"    
                                          @else
                                               alt="{{$feature_products[2]->alt}}"    
                                          @endif
                                           @endif>

								</a>
								<div class="label-group">
									@if(!empty($feature_products[2]->features))
                                        @foreach($feature_products[2]->features as $key => $data1)
                                        
                                     	@if(!empty($feature_products[2]->features[$key]))
                                        <span class="product-label label-sale" style="">{{ $feature_products[2]->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$feature_products[2]->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
                                    @endif
  @if($feature_products[2]->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button onClick='renderImage("{{asset("assets/images/thumbnails/".$feature_products[2]->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$feature_products[2]->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif							</div>
                                <a href="{{ route('product.quickz',$feature_products[2]->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>
							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $feature_products[2]->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$feature_products[2]->category->name}}</a>
									</div>
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$feature_products[2]->slug , 'lang' => $sign] ) }}">
                                            @if(!$slang)
                                          @if($lang->id == 2)
                                         {!! $feature_products[2]->showName_ar() !!}
                                          @else 
                                          
                                        {{ $feature_products[2]->showName() }}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!! $feature_products[2]->showName_ar() !!}
                                          @else
                                          {{ $feature_products[2]->showName() }}
                                          @endif
                                      @endif
                                    </a>
								</h2>
								<div class="ratings-container">
									<div class="product-ratings">
										<span class="ratings" style="width:{{App\Models\Rating::ratings($feature_products[2]->id)}}%"></span><!-- End .ratings -->
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
									<span class="old-price">{{ $feature_products[2]->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $feature_products[2]->showPrice() }}</span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
						</div>

						<div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark grid-height-1-2 w-md-50 w-xs-100">
							<figure>
								<a href="{{ route('front.product',  ['slug' => $feature_products[3]->slug , 'lang' => $sign]) }}">
									<img src="{{ $feature_products[3]->photo ? asset('assets/images/thumbnails/'.$feature_products[3]->thumbnail):asset('assets/images/noimage.png') }}" 
									@if(!$slang)
                                         @if($lang->id == 2)
                                                               
                                          alt="{{$feature_products[3]->alt_ar}}"        
                                          @else 
                                           alt="{{$feature_products[3]->alt}}"    
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                              alt="{{$feature_products[3]->alt_ar}}"    
                                          @else
                                               alt="{{$feature_products[3]->alt}}"    
                                          @endif
                                           @endif>

								</a>
								<div class="label-group">
									@if(!empty($feature_products[3]->features))
                                        @foreach($feature_products[3]->features as $key => $data1)
                                        
                                     	@if(!empty($feature_products[3]->features[$key]))
                                        <span class="product-label label-sale" style="">{{ $feature_products[3]->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$feature_products[3]->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
                                    @endif
  @if($feature_products[3]->emptyStock())
                                      <button class="btn">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                    <button onClick='renderImage("{{asset("assets/images/thumbnails/".$feature_products[3]->thumbnail)}}")' class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$feature_products[3]->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif						</div>
                                <a href="{{ route('product.quickz',$feature_products[3]->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>
							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $feature_products[3]->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$feature_products[3]->category->name}}</a>
									</div>
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$feature_products[3]->slug , 'lang' => $sign] ) }}">
                                            @if(!$slang)
                                          @if($lang->id == 2)
                                         {!! $feature_products[3]->showName_ar() !!}
                                          @else 
                                          
                                        {{ $feature_products[3]->showName() }}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!! $feature_products[3]->showName_ar() !!}
                                          @else
                                          {{ $feature_products[3]->showName() }}
                                          @endif
                                      @endif
                                    </a>
								</h2>
								<div class="ratings-container">
									<div class="product-ratings">
										<span class="ratings" style="width:{{App\Models\Rating::ratings($feature_products[3]->id)}}%"></span><!-- End .ratings -->
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
									<span class="old-price">{{ $feature_products[3]->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $feature_products[3]->showPrice() }}</span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
						</div>
                        </div>
						
						<div class="grid-col-sizer"></div>
					</div>
					@endif
				</div><!-- End .container -->
			</div><!-- End .section -->

			<div class="section bg-gray product-widgets-section">
				<div class="container">
					<div class="row">
					    @if($ps->top_rated ==1)
						<div class="col-lg-3 col-sm-6 pb-5 pb-md-0 mb-4">
							<h4 class="section-sub-title mb-2">{{ $langg->lang28}}</h4>
							@foreach($top_products->take(3) as $prod)
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
						@if($ps->best ==1)
						<div class="col-lg-3 col-sm-6 pb-5 pb-md-0 mb-4">
							<h4 class="section-sub-title mb-2">{{ $langg->lang27}}</h4>
							@foreach($best_products->take(3) as $prod)
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
						@if($ps->big ==1)
						<div class="col-lg-3 col-sm-6 pb-5 pb-md-0 mb-4">
							<h4 class="section-sub-title mb-2">{{ $langg->lang29}}</h4>
							@foreach($big_products->take(3) as $prod)
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
						@if(!empty($fix_banners[0]))
						<div class="col-lg-3 col-sm-6 pb-5 pb-md-0 mb-4">
							<div class="banner text-center top-shoes-banner banner-sm-vw-large">
								<figure>
									<img src="{{('assets/images/banners/'.$fix_banners[0]->photo)}}" alt="banner">
								</figure>

								<div class="banner-layer banner-layer-middle">
									<h3 class="m-b-2">
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
									</h3>
									<h4 class="text-primary m-b-3">
									    @if(!$slang)
                                          @if($lang->id == 2)
                                            {!!$banner[0]->title_ar!!}
                                          @else 
                                            {!!$banner[0]->title!!}
                                          @endif 
                                            @else  
                                              @if($slang == 2) 
                                                {!!$fix_banners[0]->title_ar!!}
                                              @else
                                                {!!$fix_banners[0]->title!!}
                                              @endif
                                          @endif
									</h4>
									<a href="{{$fix_banners[0]->link}}" class="btn btn-light btn-outline">
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
									</a>
								</div><!-- End .home-banner-content -->
							</div><!-- End .home-banner -->
						</div>
						@endif
						@if($ps->hot_sale ==1)
						<div class="col-lg-3 col-sm-6 pb-5 pb-md-0 mb-4">
							<h4 class="section-sub-title mb-2">{{ $langg->lang33}}</h4>
							@foreach($sale_products->take(3) as $prod)
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
						<div class="col-lg-3 col-sm-6 pb-5 pb-md-0 mb-4">
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
						<div class="col-lg-3 col-sm-6 pb-5 pb-md-0 mb-4">
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
						<div class="col-lg-3 col-sm-6 pb-5 pb-md-0 mb-4">
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
						@if($ps->flash_deal ==1)
						<div class="col-lg-3 col-sm-6 pb-5 pb-md-0 mb-4">
							<h4 class="section-sub-title mb-2">{{ $langg->lang244}}</h4>
							@foreach($discount_products->take(3) as $prod)
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

				</div>
			</div><!-- End .section -->

			<div class="container">
				<div class="newsletter-section mb-6">
					<div class="info-box icon-top text-center justify-content-center">
						<i class="far fa-envelope"></i>

						<div class="info-box-content">
							<h2 class="ls-n-10 mb-0">
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
							<p>
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
							</p>
						</div><!-- End .info-box-content -->
					</div><!-- End .info-box -->

					<div class="col-md-10 offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 offset-md-1 m-auto">
						<form class="mb-0 d-flex newsletter-form" action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
							<input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="{{ $langg->lang741 }}" required>
                                <button class="btn btn-dark" type="submit">
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
			</div><!-- End .container -->
		</main><!-- End .main -->