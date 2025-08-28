@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<main class="main">
			<section class="section-1 home-slider section-bg bg-img bg-fixed" style="background-image: url({{('assets/images/banners/'.$large_banners[0]->photo)}});">
				<div class="container position-relative">
					<div class="banner-layer banner-layer-middle float-right ml-auto text-right">
						<h2 class="m-b-2">
						    @if(!$slang)
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
                                  @endif
						</h2>
						<h3 class="text-uppercase rotated-upto-text mb-0 position-relative">
						    @if(!$slang)
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
                                  @endif
						</h3>

						<hr class="divider-short-thick">

						<!--<h5 class="text-uppercase d-inline-block mb-0 ls-n-20 pr-1 pt-2">Starting at <span>$<strong>39</strong>99</span></h5>-->
						<a href="{{$large_banners[0]->link}}" class="btn btn-dark btn-xl btn-icon-right" role="button">@if(!$slang)
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
                                        @endif <i class="fas fa-long-arrow-alt-right"></i></a>
					</div><!-- End .section-content -->
				</div><!-- End .container -->
			</section><!-- End .section-1 -->

			<section class="section-2 home-slider slider-left section-bg bg-img bg-fixed" style="background-image: url({{('assets/images/banners/'.$large_banners[1]->photo)}});">
				<div class="container position-relative">
					<div class="banner-layer banner-layer-middle float-right ml-auto text-left">
					    <h2 class="m-b-2 text-white">
						    @if(!$slang)
                                      @if($lang->id == 2)
                                    {!!$large_banners[1]->subtitle_ar!!}
                                      @else 
                                      {!!$large_banners[1]->subtitle!!}
                                      @endif 
                                  @else  
                                      @if($slang == 2) 
                                      {!!$large_banners[1]->subtitle_ar!!}
                                      @else
                                      {!!$large_banners[1]->subtitle!!}
                                      @endif
                                  @endif
						</h2>
						<h3 class="text-uppercase rotated-upto-text mb-0 position-relative text-white">
						    @if(!$slang)
                                  @if($lang->id == 2)
                                    {!!$large_banners[1]->title_ar!!}
                                  @else 
                                    {!!$large_banners[1]->title!!}
                                  @endif 
                                    @else  
                                      @if($slang == 2) 
                                        {!!$large_banners[1]->title_ar!!}
                                      @else
                                        {!!$large_banners[1]->title!!}
                                      @endif
                                  @endif
						</h3>

						<hr class="divider-short-thick border-white">

						<!--<h5 class="text-uppercase d-inline-block mb-0 ls-n-20 pr-1 pt-2 text-white">Starting at <span>$<strong>39</strong>99</span></h5>-->
						<a href="{{$large_banners[1]->link}}" class="btn btn-light btn-xl btn-icon-right" role="button">@if(!$slang)
                                           @if($lang->id == 2)
                                            {!!$large_banners[1]->btn_ar!!}  
                                          @else 
                                           {!!$large_banners[1]->button!!}  
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            {!!$large_banners[1]->btn_ar!!}  
                                          @else
                                           {!!$large_banners[1]->button!!}  
                                          @endif
                                        @endif <i class="fas fa-long-arrow-alt-right"></i></a>
					</div><!-- End .section-content -->
				</div><!-- End .container -->
			</section><!-- End .section-2 -->

			<section class="section-3 category-section d-block d-md-flex">
			    @if(!empty($fix_banners[0]))
				<div class="col-md-6 col-12 banner banner-1 bg-img d-flex align-items-center appear-animate" data-animation-duration="1200" style="background-image: url({{('assets/images/banners/'.$fix_banners[0]->photo)}}); animation-delay: 0ms; animation-duration: 1200ms;">
					<div class="banner-content">
						<h3 class="title">
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
						<p class="subtitle">
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
                              @endif<
						</p>
						<div class="mb-0">
							<a href="{{$fix_banners[0]->link}}" role="button" class="btn btn-primary btn-borders btn-lg btn-outline-dark">
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
						</div>
					</div><!-- End .banner-content -->
				</div><!-- End .banner -->
                @endif
                @if(!empty($fix_banners[1]))
				<div class="col-md-6 col-12 banner banner-1 bg-img d-flex align-items-center appear-animate" data-animation-duration="1200" style="background-image: url({{('assets/images/banners/'.$fix_banners[1]->photo)}}); animation-delay: 0ms; animation-duration: 1200ms;">
					<div class="banner-content">
						<h3 class="title">
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
						<p class="subtitle">
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
						</p>
						<div class="mb-0">
							<a href="{{$fix_banners[1]->link}}" role="button" class="btn btn-primary btn-borders btn-lg btn-outline-dark">
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
							</a>
						</div>
					</div><!-- End .banner-content -->
				</div><!-- End .banner -->
				@endif
			</section><!-- End .section-3 -->

            @if($ps->featured ==1)
			<section class="section-4 product-collection bg-fixed" style="background-image: url({{('assets/images/banners/'.$fix_banners[0]->photo)}});">
				<div class="container text-center">
					<div class="title-group">
						<h2 class="text-white m-b-1">{{ $langg->lang26}}</h2>
						<!--<h5 class="text-uppercase d-inline-block mb-0 ls-n-20 pt-2 text-white mb-4">Starting at <span>$<strong>29</strong>99</span></h5>-->
					</div><!-- .End .title-group -->
				</div><!-- End .container -->

				<div class="container">
					<div class="products-slider owl-carousel owl-theme nav-image-center show-nav-hover nav-outer nav-white" data-owl-options="{
						'dots': false,
						'nav': true
					}">
					    @foreach($feature_products as $prod)	
						<div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeInRightShorter">
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
                                        <span class="product-label label-sale" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
									<button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								</div>
								<a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>

							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
                                    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
									@endif
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign] ) }}">
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
						</div><!-- End .product-default -->
						@endforeach
					</div><!-- End .section-products-carousel -->
				</div><!-- End .container -->
			</section><!-- End .section-4 -->
            @endif
            
            @if($ps->top_rated ==1)
			<section class="section-5 d-block d-md-flex">
				<div class="col-md-6 col-12 banner d-flex align-items-center appear-animate order-last bg-img bg-fixed bg-right" data-animation-duration="1200" style="background-image: url(&quot;assets/images/bg-4.jpg&quot;); animation-delay: 0ms; animation-duration: 1200ms;">
					<div class="banner-content">
						<h3 class="title">{{ $langg->lang28}}</h3>
						<!--<p class="subtitle">Check out this week's hottest styles.</p>-->
						<div class="mb-0">
							<a href="{{ route('front.products',$sign) }}" role="button" class="btn btn-borders btn-lg btn-outline-dark btn-dark">
								{{ $langg->lang25 }}
							</a>
						</div>
					</div><!-- End .banner-content -->
				</div><!-- End .banner -->
            
				<div class="col-md-6 col-12 bg-secondary product-part">
					<div class="products-slider owl-carousel owl-theme" data-owl-options="{
							'items': 2,
							'nav': true,
							'responsive' : {
								'576' : {
									'items' : 2
								},
								'992' : {
									'items' : 2
								}
							}
						}">
                        @foreach($top_products as $prod)
                        <div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeInRightShorter">
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
                                        <span class="product-label label-sale" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
									<button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								</div>
								<a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>

							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
                                    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
									@endif
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign] ) }}">
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
						</div><!-- End .product-default -->
                        @endforeach
						
					</div>
				</div><!-- End .col-md-6 -->
			</section><!-- End .section-5 -->
            @endif
            @if($ps->big ==1)
			<section class="section-6 d-block d-md-flex">
				<div class="col-md-6 col-12 banner d-flex align-items-center appear-animate bg-img bg-fixed bg-left" data-animation-duration="1200" style="background-image: url(&quot;assets/images/bg-5.jpg&quot;); animation-delay: 0ms; animation-duration: 1200ms;">
					<div class="banner-content ml-auto text-right">
						<h3 class="title">{{ $langg->lang29}}</h3>
						<!--<p class="subtitle">Check out this week's hottest styles.</p>-->
						<div class="mb-0">
							<a href="{{ route('front.products',$sign) }}" role="button" class="btn btn-borders btn-lg btn-outline-dark btn-dark">
								{{ $langg->lang25 }}
							</a>
						</div>
					</div><!-- End .banner-content -->
				</div><!-- End .banner -->

				<div class="col-md-6 col-12 bg-secondary product-part">
					<div class="products-slider owl-carousel owl-theme" data-owl-options="{
							'items': 2,
							'nav': true,
							'responsive' : {
								'576' : {
									'items' : 2
								},
								'992' : {
									'items' : 2
								}
							}
						}">
                        @foreach($big_products as $prod)
                        <div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeInRightShorter">
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
                                        <span class="product-label label-sale" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
									<button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								</div>
								<a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>

							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
                                    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
									@endif
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign] ) }}">
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
						</div><!-- End .product-default -->
                        @endforeach
						
						
					</div>
				</div><!-- End .col-md-6 -->
			</section><!-- End .section-6 -->
            @endif
            
            @if($ps->best ==1)
			<section class="section-5 d-block d-md-flex">
				<div class="col-md-6 col-12 banner d-flex align-items-center appear-animate order-last bg-img bg-fixed bg-right" data-animation-duration="1200" style="background-image: url(&quot;assets/images/bg-4.jpg&quot;); animation-delay: 0ms; animation-duration: 1200ms;">
					<div class="banner-content">
						<h3 class="title">{{ $langg->lang27}}</h3>
						<!--<p class="subtitle">Check out this week's hottest styles.</p>-->
						<div class="mb-0">
							<a href="{{ route('front.products',$sign) }}" role="button" class="btn btn-borders btn-lg btn-outline-dark btn-dark">
								{{ $langg->lang25 }}
							</a>
						</div>
					</div><!-- End .banner-content -->
				</div><!-- End .banner -->
            
				<div class="col-md-6 col-12 bg-secondary product-part">
					<div class="products-slider owl-carousel owl-theme" data-owl-options="{
							'items': 2,
							'nav': true,
							'responsive' : {
								'576' : {
									'items' : 2
								},
								'992' : {
									'items' : 2
								}
							}
						}">
                        @foreach($best_products as $prod)
                        <div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeInRightShorter">
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
                                        <span class="product-label label-sale" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
									<button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								</div>
								<a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>

							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
                                    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
									@endif
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign] ) }}">
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
						</div><!-- End .product-default -->
                        @endforeach
						
					</div>
				</div><!-- End .col-md-6 -->
			</section><!-- End .section-5 -->
            @endif
            @if($ps->hot_sale ==1)
			<section class="section-6 d-block d-md-flex">
				<div class="col-md-6 col-12 banner d-flex align-items-center appear-animate bg-img bg-fixed bg-left" data-animation-duration="1200" style="background-image: url(&quot;assets/images/bg-5.jpg&quot;); animation-delay: 0ms; animation-duration: 1200ms;">
					<div class="banner-content ml-auto text-right">
						<h3 class="title">{{ $langg->lang33}}</h3>
						<!--<p class="subtitle">Check out this week's hottest styles.</p>-->
						<div class="mb-0">
							<a href="{{ route('front.products',$sign) }}" role="button" class="btn btn-borders btn-lg btn-outline-dark btn-dark">
								{{ $langg->lang25 }}
							</a>
						</div>
					</div><!-- End .banner-content -->
				</div><!-- End .banner -->

				<div class="col-md-6 col-12 bg-secondary product-part">
					<div class="products-slider owl-carousel owl-theme" data-owl-options="{
							'items': 2,
							'nav': true,
							'responsive' : {
								'576' : {
									'items' : 2
								},
								'992' : {
									'items' : 2
								}
							}
						}">
                        @foreach($sale_products as $prod)
                        <div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeInRightShorter">
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
                                        <span class="product-label label-sale" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
									<button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								</div>
								<a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>

							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
                                    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
									@endif
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign] ) }}">
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
						</div><!-- End .product-default -->
                        @endforeach
						
						
					</div>
				</div><!-- End .col-md-6 -->
			</section><!-- End .section-6 -->
            @endif
            
            @if($ps->hot_sale ==1)
			<section class="section-5 d-block d-md-flex">
				<div class="col-md-6 col-12 banner d-flex align-items-center appear-animate order-last bg-img bg-fixed bg-right" data-animation-duration="1200" style="background-image: url(&quot;assets/images/bg-4.jpg&quot;); animation-delay: 0ms; animation-duration: 1200ms;">
					<div class="banner-content">
						<h3 class="title">{{ $langg->lang32}}</h3>
						<!--<p class="subtitle">Check out this week's hottest styles.</p>-->
						<div class="mb-0">
							<a href="{{ route('front.products',$sign) }}" role="button" class="btn btn-borders btn-lg btn-outline-dark btn-dark">
								{{ $langg->lang25 }}
							</a>
						</div>
					</div><!-- End .banner-content -->
				</div><!-- End .banner -->
            
				<div class="col-md-6 col-12 bg-secondary product-part">
					<div class="products-slider owl-carousel owl-theme" data-owl-options="{
							'items': 2,
							'nav': true,
							'responsive' : {
								'576' : {
									'items' : 2
								},
								'992' : {
									'items' : 2
								}
							}
						}">
                        @foreach($trending_products as $prod)
                        <div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeInRightShorter">
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
                                        <span class="product-label label-sale" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
									<button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								</div>
								<a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>

							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
                                    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
									@endif
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign] ) }}">
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
						</div><!-- End .product-default -->
                        @endforeach
						
					</div>
				</div><!-- End .col-md-6 -->
			</section><!-- End .section-5 -->
            @endif
            @if($ps->hot_sale ==1)
			<section class="section-6 d-block d-md-flex">
				<div class="col-md-6 col-12 banner d-flex align-items-center appear-animate bg-img bg-fixed bg-left" data-animation-duration="1200" style="background-image: url(&quot;assets/images/bg-5.jpg&quot;); animation-delay: 0ms; animation-duration: 1200ms;">
					<div class="banner-content ml-auto text-right">
						<h3 class="title">{{ $langg->lang30}}</h3>
						<!--<p class="subtitle">Check out this week's hottest styles.</p>-->
						<div class="mb-0">
							<a href="{{ route('front.products',$sign) }}" role="button" class="btn btn-borders btn-lg btn-outline-dark btn-dark">
								{{ $langg->lang25 }}
							</a>
						</div>
					</div><!-- End .banner-content -->
				</div><!-- End .banner -->

				<div class="col-md-6 col-12 bg-secondary product-part">
					<div class="products-slider owl-carousel owl-theme" data-owl-options="{
							'items': 2,
							'nav': true,
							'responsive' : {
								'576' : {
									'items' : 2
								},
								'992' : {
									'items' : 2
								}
							}
						}">
                        @foreach($hot_products as $prod)
                        <div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeInRightShorter">
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
                                        <span class="product-label label-sale" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
									<button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								</div>
								<a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>

							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
                                    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
									@endif
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign] ) }}">
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
						</div><!-- End .product-default -->
                        @endforeach
						
						
					</div>
				</div><!-- End .col-md-6 -->
			</section><!-- End .section-6 -->
            @endif
            
            @if($ps->hot_sale ==1)
			<section class="section-5 d-block d-md-flex">
				<div class="col-md-6 col-12 banner d-flex align-items-center appear-animate order-last bg-img bg-fixed bg-right" data-animation-duration="1200" style="background-image: url(&quot;assets/images/bg-4.jpg&quot;); animation-delay: 0ms; animation-duration: 1200ms;">
					<div class="banner-content">
						<h3 class="title">{{ $langg->lang31}}</h3>
						<!--<p class="subtitle">Check out this week's hottest styles.</p>-->
						<div class="mb-0">
							<a href="{{ route('front.products',$sign) }}" role="button" class="btn btn-borders btn-lg btn-outline-dark btn-dark">
								{{ $langg->lang25 }}
							</a>
						</div>
					</div><!-- End .banner-content -->
				</div><!-- End .banner -->
            
				<div class="col-md-6 col-12 bg-secondary product-part">
					<div class="products-slider owl-carousel owl-theme" data-owl-options="{
							'items': 2,
							'nav': true,
							'responsive' : {
								'576' : {
									'items' : 2
								},
								'992' : {
									'items' : 2
								}
							}
						}">
                        @foreach($latest_products as $prod)
                        <div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeInRightShorter">
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
                                        <span class="product-label label-sale" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
									<button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								</div>
								<a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>

							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
                                    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
									@endif
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign] ) }}">
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
						</div><!-- End .product-default -->
                        @endforeach
						
					</div>
				</div><!-- End .col-md-6 -->
			</section><!-- End .section-5 -->
            @endif
            @if($ps->flash_deal ==1)
			<section class="section-6 d-block d-md-flex">
				<div class="col-md-6 col-12 banner d-flex align-items-center appear-animate bg-img bg-fixed bg-left" data-animation-duration="1200" style="background-image: url(&quot;assets/images/bg-5.jpg&quot;); animation-delay: 0ms; animation-duration: 1200ms;">
					<div class="banner-content ml-auto text-right">
						<h3 class="title">{{ $langg->lang244}}</h3>
						<!--<p class="subtitle">Check out this week's hottest styles.</p>-->
						<div class="mb-0">
							<a href="{{ route('front.products',$sign) }}" role="button" class="btn btn-borders btn-lg btn-outline-dark btn-dark">
								{{ $langg->lang25 }}
							</a>
						</div>
					</div><!-- End .banner-content -->
				</div><!-- End .banner -->

				<div class="col-md-6 col-12 bg-secondary product-part">
					<div class="products-slider owl-carousel owl-theme" data-owl-options="{
							'items': 2,
							'nav': true,
							'responsive' : {
								'576' : {
									'items' : 2
								},
								'992' : {
									'items' : 2
								}
							}
						}">
                        @foreach($discount_products as $prod)
                        <div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeInRightShorter">
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
                                        <span class="product-label label-sale" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
									<button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								</div>
								<a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>

							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
                                    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
									@endif
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign] ) }}">
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
						</div><!-- End .product-default -->
                        @endforeach
						
						
					</div>
				</div><!-- End .col-md-6 -->
			</section><!-- End .section-6 -->
            @endif
			<section class="section-7 newsletter-section bg-image bg-fixed" style="background-image: url({{('assets/images/banners/'.$fix_banners[0]->photo)}});">
				<div class="container d-flex justify-content-center">
					<div class="col-md-10 col-xl-7 col-lg-8 p-0">
						<div class="info-box icon-top text-center justify-content-center">
							<div class="info-box-content">
								<h2 class="ls-n-20 text-white">{{$langg->newsletter}}</h2>
								<p><p> {{$gs->popup_text}}</p></p>
							</div><!-- End .info-box-content -->
						</div><!-- End .info-box -->

						<form action="{{route('front.subscribe')}}" id="subscribeform" method="POST" class="mb-0 d-flex newsletter-form">
                            {{csrf_field()}}
							<input type="email"  class="form-control border-0" id="newsletter-email" name="email" placeholder="Email address"  size="40" required>
							<button type="submit" class="btn btn-dark bg-primary border-0">Subscribe</button>
						</form>
					</div><!-- End .col-md-10.col-xl-7.col-lg-8 -->
				</div><!-- End container -->
			</section><!-- End .section-7 -->

			<section class="section-8 home-slider slider-left section-bg bg-img bg-fixed" style="background-image: url({{('assets/images/banners/'.$large_banners[1]->photo)}});">
				<div class="container position-relative">
					<div class="banner-layer banner-layer-middle float-right ml-auto text-left">
					    <h2 class="m-b-2 text-dark">
						    @if(!$slang)
                                      @if($lang->id == 2)
                                    {!!$large_banners[1]->subtitle_ar!!}
                                      @else 
                                      {!!$large_banners[1]->subtitle!!}
                                      @endif 
                                  @else  
                                      @if($slang == 2) 
                                      {!!$large_banners[1]->subtitle_ar!!}
                                      @else
                                      {!!$large_banners[1]->subtitle!!}
                                      @endif
                                  @endif
						</h2>
						<h3 class="text-uppercase rotated-upto-text mb-0 position-relative text-dark">
						    @if(!$slang)
                                  @if($lang->id == 2)
                                    {!!$large_banners[1]->title_ar!!}
                                  @else 
                                    {!!$large_banners[1]->title!!}
                                  @endif 
                                    @else  
                                      @if($slang == 2) 
                                        {!!$large_banners[1]->title_ar!!}
                                      @else
                                        {!!$large_banners[1]->title!!}
                                      @endif
                                  @endif
						</h3>

						<hr class="divider-short-thick border-white">

						<!--<h5 class="text-uppercase d-inline-block mb-0 ls-n-20 pr-1 pt-2 text-white">Starting at <span>$<strong>39</strong>99</span></h5>-->
						<a href="{{$large_banners[1]->link}}" class="btn btn-light btn-xl btn-icon-right" role="button">@if(!$slang)
                                           @if($lang->id == 2)
                                            {!!$large_banners[1]->btn_ar!!}  
                                          @else 
                                           {!!$large_banners[1]->button!!}  
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            {!!$large_banners[1]->btn_ar!!}  
                                          @else
                                           {!!$large_banners[1]->button!!}  
                                          @endif
                                        @endif <i class="fas fa-long-arrow-alt-right"></i></a>
					</div><!-- End .section-content -->
				</div><!-- End .container -->
			</section><!-- End .section-2 -->

			@if($ps->featured ==1)
			<section class="section-9 product-collection bg-fixed" style="background-image: url({{('assets/images/banners/'.$fix_banners[0]->photo)}});">
				<div class="container text-center">
					<div class="title-group">
						<h2 class="text-white m-b-1">{{ $langg->lang26}}</h2>
						<!--<h5 class="text-uppercase d-inline-block mb-0 ls-n-20 pt-2 text-white mb-4">Starting at <span>$<strong>29</strong>99</span></h5>-->
					</div><!-- .End .title-group -->
				</div><!-- End .container -->

				<div class="container">
					<div class="products-slider owl-carousel owl-theme nav-image-center show-nav-hover nav-outer nav-white" data-owl-options="{
						'dots': false,
						'nav': true
					}">
					    @foreach($feature_products as $prod)	
						<div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeInRightShorter">
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
                                        <span class="product-label label-sale" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
									<button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								</div>
								<a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>

							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
									</div>
                                    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
									@endif
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign] ) }}">
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
						</div><!-- End .product-default -->
						@endforeach
					</div><!-- End .section-products-carousel -->
				</div><!-- End .container -->
			</section><!-- End .section-9 -->
            @endif
		</main><!-- End .main -->