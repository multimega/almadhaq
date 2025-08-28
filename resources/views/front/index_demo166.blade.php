


@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

@endphp
<style>
.home-slider h3 {
    font-size: 1.5em;
}
.product-default.grid-item{
    position: relative;
}
.product-default.grid-item figure img{
    height: 100%;
}
</style>
<main class="main">
				<section class="section-1">
					<h2 class="d-none">Home Slider</h2>
					

					<div class="home-slider owl-carousel owl-theme show-nav-hover" data-owl-options="{
						'loop': false
					}">
                        @if($ps->slider == 1)
    				   @if(count($sliders))
    					@foreach($sliders as $data)
						<div class="banner">
							<img src="assets/images/sliders/{{$data->photo}}" width="1620" height="980" alt="slider-one">

							<div class="banner-layer banner-layer-middle">
								<h6>
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
								</h6>
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
								<a href="{{$data->link}}" class="btn btn-xl" role="button">{{ $langg->lang25 }}<i class="fas fa-chevron-right"></i></a>
							</div><!-- End .banner-layer.banner-layer-middle -->
						</div><!-- End .banner -->
                        @endforeach
                      @endif
                     @endif
					</div>
				    </section><!-- End .section-1 -->


                
				@if($ps->featured ==1)
				<section class="section-2 featured-collection mt-5">
					<div class="container">
						<h2 class="section-title">{{ $langg->lang26}}</h2>

						<div class="products-grid grid">
						    <div class="row">
							<div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark grid-height-2 col-xl-5 col-lg-6 col-md-6">
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
								    <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
								    @else
								    <button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$feature_products[0]->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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

							<div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark grid-height-2 col-xl-3 col-lg-6 col-sm-6">
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
								    <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
								    @else
								    <button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$feature_products[1]->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								    @endif
                                    
								</div>
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


                            <div class="col-xl-4 col-md-12 col-sm-12">
                                <div class="row">
							<div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark grid-height-1 col-xl-6 col-md-3 col-sm-6">
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
								    <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
								    @else
								    <button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$feature_products[2]->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								    @endif
								</div>
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

							<div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark grid-height-1 col-xl-6 col-md-3 col-sm-6">
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
								    <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
								    @else
								    <button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$feature_products[3]->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								    @endif
                                    
								</div>
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
                            <div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark grid-height-1 col-xl-6 col-md-3 col-sm-6">
								<figure>
								<a href="{{ route('front.product',  ['slug' => $feature_products[4]->slug , 'lang' => $sign]) }}">
									<img src="{{ $feature_products[4]->photo ? asset('assets/images/thumbnails/'.$feature_products[4]->thumbnail):asset('assets/images/noimage.png') }}" 
									@if(!$slang)
                                         @if($lang->id == 2)
                                                               
                                          alt="{{$feature_products[4]->alt_ar}}"        
                                          @else 
                                           alt="{{$feature_products[4]->alt}}"    
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                              alt="{{$feature_products[4]->alt_ar}}"    
                                          @else
                                               alt="{{$feature_products[4]->alt}}"    
                                          @endif
                                           @endif>

								</a>
								<div class="label-group">
									@if(!empty($feature_products[4]->features))
                                        @foreach($feature_products[4]->features as $key => $data1)
                                        
                                     	@if(!empty($feature_products[4]->features[$key]))
                                        <span class="product-label label-sale" style="">{{ $feature_products[4]->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$feature_products[4]->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
                                    @endif
                                    
                                    @if($feature_products[4]->emptyStock())
								    <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
								    @else
								    <button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$feature_products[4]->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								    @endif
								</div>
                                <a href="{{ route('product.quickz',$feature_products[4]->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>
							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $feature_products[4]->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$feature_products[4]->category->name}}</a>
									</div>
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$feature_products[4]->slug , 'lang' => $sign] ) }}">
                                            @if(!$slang)
                                          @if($lang->id == 2)
                                         {!! $feature_products[4]->showName_ar() !!}
                                          @else 
                                          
                                        {{ $feature_products[4]->showName() }}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!! $feature_products[4]->showName_ar() !!}
                                          @else
                                          {{ $feature_products[4]->showName() }}
                                          @endif
                                      @endif
                                    </a>
								</h2>
								<div class="ratings-container">
									<div class="product-ratings">
										<span class="ratings" style="width:{{App\Models\Rating::ratings($feature_products[4]->id)}}%"></span><!-- End .ratings -->
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
									<span class="old-price">{{ $feature_products[4]->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $feature_products[4]->showPrice() }}</span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
							</div>
                            <div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark grid-height-1 col-xl-6 col-md-3 col-sm-6">
								<figure>
								<a href="{{ route('front.product',  ['slug' => $feature_products[5]->slug , 'lang' => $sign]) }}">
									<img src="{{ $feature_products[5]->photo ? asset('assets/images/thumbnails/'.$feature_products[5]->thumbnail):asset('assets/images/noimage.png') }}" 
									@if(!$slang)
                                         @if($lang->id == 2)
                                                               
                                          alt="{{$feature_products[5]->alt_ar}}"        
                                          @else 
                                           alt="{{$feature_products[5]->alt}}"    
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                              alt="{{$feature_products[5]->alt_ar}}"    
                                          @else
                                               alt="{{$feature_products[5]->alt}}"    
                                          @endif
                                           @endif>

								</a>
								<div class="label-group">
									@if(!empty($feature_products[5]->features))
                                        @foreach($feature_products[5]->features as $key => $data1)
                                        
                                     	@if(!empty($feature_products[5]->features[$key]))
                                        <span class="product-label label-sale" style="">{{ $feature_products[5]->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                    @endif
								</div>
								<div class="btn-icon-group">
								    @if(Auth::guard('web')->check())
									<a href="javascript::" data-href="{{ route('user-wishlist-add',$feature_products[5]->id) }}" data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
									    <i class="icon-heart"></i>
									</a>
                                    @endif
                                    
                                    
                                    @if($feature_products[5]->emptyStock())
								    <button class="btn"><a href="javascript:;" class="cart-out-of-stock"><i class="icofont-close-circled"></i>{{ $langg->lang78 }}</a></button>
								    @else
								    <button class="btn-icon btn-add-cart add-to-cart paction" data-toggle="modal" data-href="{{ route('product.cart.add',$feature_products[5]->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
								    @endif
								</div>
                                <a href="{{ route('product.quickz',$feature_products[5]->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
							</figure>
							<div class="product-details">
								<div class="category-wrap">
									<div class="category-list">
										<a href="{{ route('front.category',['category' => $feature_products[5]->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$feature_products[5]->category->name}}</a>
									</div>
								</div>
								<h2 class="product-title">
									<a href="{{ route('front.product', ['slug' =>$feature_products[5]->slug , 'lang' => $sign] ) }}">
                                            @if(!$slang)
                                          @if($lang->id == 2)
                                         {!! $feature_products[5]->showName_ar() !!}
                                          @else 
                                          
                                        {{ $feature_products[5]->showName() }}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!! $feature_products[5]->showName_ar() !!}
                                          @else
                                          {{ $feature_products[5]->showName() }}
                                          @endif
                                      @endif
                                    </a>
								</h2>
								<div class="ratings-container">
									<div class="product-ratings">
										<span class="ratings" style="width:{{App\Models\Rating::ratings($feature_products[5]->id)}}%"></span><!-- End .ratings -->
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
									<span class="old-price">{{ $feature_products[5]->showPreviousPrice() }}</span>
                                    <span class="product-price">{{ $feature_products[5]->showPrice() }}</span>
								</div><!-- End .price-box -->
							</div><!-- End .product-details -->
							</div>
                            
							</div>
							</div>

							<div class="grid-col-sizer col-1"></div>
						</div>
						</div>
					</div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
				</section><!-- End .section-2 -->
                @endif
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
				<section class="section-3 product-collection">
					<div class="container">
					    @if($ps->top_rated ==1)
						<h2 class="section-title">{{ $langg->lang28}}</h2>

						<div class="products-slider owl-carousel owl-theme dots-top" data-owl-options="{
							'responsive': {
								'992': {
									'items': 6
								},
								'768': {
									'items': 4
								},
								'576': {
									'items': 3
								}
							}
						}">
							@foreach($top_products as $prod)
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
					        @endforeach
						</div><!-- End .products-slider -->
						@endif
						
						@if($ps->big ==1)
						<h2 class="section-title">{{ $langg->lang29}}</h2>

						<div class="products-slider owl-carousel owl-theme dots-top" data-owl-options="{
							'responsive': {
								'992': {
									'items': 6
								},
								'768': {
									'items': 4
								},
								'576': {
									'items': 3
								}
							}
						}">
							@foreach($big_products as $prod)
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
								   
									<button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
					@endforeach
						</div><!-- End .products-slider -->
						@endif
						
						@if($ps->best ==1)
						<h2 class="section-title">{{ $langg->lang27}}</h2>

						<div class="products-slider owl-carousel owl-theme dots-top" data-owl-options="{
							'responsive': {
								'992': {
									'items': 6
								},
								'768': {
									'items': 4
								},
								'576': {
									'items': 3
								}
							}
						}">
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
							@foreach($best_products as $prod)
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
				        	@endforeach
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
				        	
						</div><!-- End .products-slider -->
						@endif
						
						@if($ps->hot_sale ==1)
						<h2 class="section-title">{{ $langg->lang33}}</h2>

						<div class="products-slider owl-carousel owl-theme dots-top" data-owl-options="{
							'responsive': {
								'992': {
									'items': 6
								},
								'768': {
									'items': 4
								},
								'576': {
									'items': 3
								}
							}
						}">
							@foreach($sale_products as $prod)
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
					@endforeach
						</div><!-- End .products-slider -->
						@endif
						
						@if($ps->hot_sale ==1)
						<h2 class="section-title">{{ $langg->lang32}}</h2>

						<div class="products-slider owl-carousel owl-theme dots-top" data-owl-options="{
							'responsive': {
								'992': {
									'items': 6
								},
								'768': {
									'items': 4
								},
								'576': {
									'items': 3
								}
							}
						}">
							@foreach($trending_products as $prod)
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
					@endforeach
						</div><!-- End .products-slider -->
						@endif
						
						@if($ps->hot_sale ==1)
						<h2 class="section-title">{{ $langg->lang30}}</h2>

						<div class="products-slider owl-carousel owl-theme dots-top" data-owl-options="{
							'responsive': {
								'992': {
									'items': 6
								},
								'768': {
									'items': 4
								},
								'576': {
									'items': 3
								}
							}
						}">
							@foreach($hot_products as $prod)
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
					@endforeach
						</div><!-- End .products-slider -->
						@endif
						
						@if($ps->hot_sale ==1)
						<h2 class="section-title">{{ $langg->lang31}}</h2>

						<div class="products-slider owl-carousel owl-theme dots-top" data-owl-options="{
							'responsive': {
								'992': {
									'items': 6
								},
								'768': {
									'items': 4
								},
								'576': {
									'items': 3
								}
							}
						}">
							@foreach($latest_products as $prod)
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
					@endforeach
						</div><!-- End .products-slider -->
						@endif
					</div>
				</section><!-- End .section-3 -->














































'














                @if(!empty($fix_banners[0]))
				<section class="section-4 container">
					<div class="newsletter-section bg-img">
						<div class="banner">
							<img src="{{('assets/images/banners/'.$fix_banners[0]->photo)}}" alt="desc" width="1000" height="400">

							<div class="banner-layer banner-layer-middle text-right">
								<h4>
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
								</h4>
								<h3>
									<!--<b class="text-white position-relative">BIG SALE</b>-->
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
								</h3>
								<a href="{{$fix_banners[0]->link}}" class="btn btn-xl" role="button">@if(!$slang)
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
                                          @endif<i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
				</section><!-- End .section-4 -->
                @endif
                 @if($ps->flash_deal ==1)

				<section class="section-5 product-collection">
					<div class="container">
						<h2 class="section-title">{{ $langg->lang244}}</h2>

						<div class="row product-ajax-grid">
						    @foreach($discount_products as $prod)
							<div class="product-default inner-quickview inner-icon col-xl-2 col-md-3 col-sm-4 col-6">
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
							</div><!-- End .product-default -->
                            @endforeach
							
						</div><!-- End .row -->

						<div class="load-more text-center loadmore">
							<a href="#" class="btn btn-xl loadmore" role="button">LOAD MORE...</a>
						</div>
					</div>
				</section><!-- End .section-5 -->
				@endif
			</main><!-- End .main -->