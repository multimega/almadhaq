@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<style>
@media only screen and (max-width: 667px){
    .home-slide, .category-slide{
        display: block !important;
    }
    .home-slider-container, .home-slide{
        height: 27vh !important;
    }
    .owl-carousel .owl-item .owl-lazy[src^=""], .owl-carousel .owl-item .owl-lazy:not([src]){
        max-height: unset !important;
    }
    .home-slide .slide-bg, .category-slide .slide-bg{
        bottom:unset !important;
        top:unset !important;
        left:unset !important;
        right:unset !important;
        position:unset !important;
        width: 100% !important;
        height: 27vh !important;
    }
    .home-slide-content{
        position: absolute;
        top: 55%;
        left: 13%;
    }
    .home-slider.owl-carousel .owl-dots{
        bottom: 1.3rem;
    }
}
</style>
        <main class="main">
            <div class="home-slider-container">
                <div class="home-slider owl-carousel owl-theme">
                   
                  @if($ps->slider == 1)
				   @if(count($sliders))
					@foreach($sliders as $data)
                    <div class="home-slide">
                        <div class="slide-bg owl-lazy"  data-src="{{asset('assets/images/sliders/'.$data->photo)}}"></div><!-- End .slide-bg -->
                        <div class="home-slide-content container">
                            <div class="row">
                                <div class="col-md-6 offset-md-6 col-lg-5 offset-lg-7">
                                        <h4 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">  @if(!$slang)
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
                                            @endif</h1>
                                          <h2> @if(!$slang)
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
                                                   @endif</h2>
                                                   
                                                 

										    	<h1 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}"> 
                                                    @if($lang->id == 2)
                                                     {{$data->details_text_ar}}
                                                    @else 
                                                       {{$data->details_text}}
                                                      @endif </h4>
                                      <a class="btn btn-secondary" href="{{$data->link}}">{{ $langg->lang25 }}</a>
                                           
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .home-slide-content -->
                    </div><!-- End .home-slide -->
                     @endforeach
                    @endif
                    @endif
                </div><!-- End .home-slider -->
            </div><!-- End .home-slider-container -->

            <div class="banners-group">
                <div class="row no-gutters">
                    
                     @forelse($top_small_banners as $banner)
                        <div class="col-md-6 col-lg-3">
                            <div class="banner banner-image">
                                <a href="{{$banner->link}}">
                                    <img src="{{asset('assets/images/banners/'.$banner->photo)}}" style="height:158px;"alt="banner">
                                </a>
                            </div>
                        </div>
                    @empty
                    
                      <div class="col-md-12 col-lg-12">
                            <div class="text-center">
                                <h1>no banners founded yet ! </h1>
                            </div>
                        </div>
                    
                    @endforelse;
                    
                       </div>
                  </div>
            
                  @foreach($categories->where('is_featured','=',1) as $cat)
                  @if($cat->directionz ==2)
            <div class="half-section">
                <div class="row no-gutters">
                    <div class="col-md-6 order-md-last half-img" style="background-image: url({{asset('assets/images/categories/'.$cat->image) }});">
                        <a href="{{$cat->link}}" class="half-title">
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
                                      @endif</a>
                                      </div>
                  

                    <div class="col-md-6">
                        <div class="half-content">
                            <div class="title-group">
                                <h2 class="subtitle">@if(!$slang)
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
                                 </h2>
                                <p> @if(!$slang)
                                  @if($lang->id == 2)
                                   {!! $cat->details_ar !!}
                                  @else 
                                 {!! $cat->details !!}
                                  @endif 
                                    @else
                                  @if($slang == 2) 
                                 {!! $cat->details_ar !!}
                                  @else
                                  {!!  $cat->details !!}
                                  
                                  @endif
                                      @endif</p>
                            </div>

                            <div class="products-slider owl-carousel owl-theme owl-nav-top">
                                   @foreach($cat->products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                     <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{$langg->lang55}}</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="#" class="product-category">@if(!$slang)
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
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                     <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <i class="fas fa-compare"></i>
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
                            </div><!-- End .products-slider -->
                        </div><!-- End .half-content -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .no-gutters -->
            </div><!-- End .half-section -->
         @else
          
            <div class="half-section">
                <div class="row no-gutters">
                    <div class="col-md-6 half-img" style="background-image: url({{asset('assets/images/categories/'.$cat->image) }});">
                        <a href="{{url($sign.'/category/'.$cat->slug)}}" class="half-title"> @if(!$slang)
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
                                      @endif</a>
                    </div>

                    <div class="col-md-6">
                        <div class="half-content">
                            <div class="title-group">
                                <h2 class="subtitle">@if(!$slang)
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
                                      @endif</h2>
                                <p>@if(!$slang)
                                  @if($lang->id == 2)
                                   {!!$cat->details_ar!!}
                                  @else 
                                 {!!$cat->details!!}
                                  @endif 
                                    @else
                                  @if($slang == 2) 
                                 {!!$cat->details_ar!!}
                                  @else
                                  {!!$cat->details!!}
                                      @endif
                                      @endif</p>
                            </div>

                            <div class="products-slider owl-carousel owl-theme owl-nav-top">
                                  @foreach($cat->products as $prod)
                          <div class="product-default inner-quickview inner-icon">
                              <figure>
                                   <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                       <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"  @if(!$slang)
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
                                     <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{$langg->lang55}}</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="#" class="product-category">   @if(!$slang)
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
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                     <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <i class="fas fa-compare"></i>
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
                                </div>
                            </div>
                        </div>
                        
                             @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @endif
            @endforeach
        
        
                  @if($ps->featured == 1)
            <div class="container-fluid products-bottom">
                <div class="title-group text-center">
                    <h2 class="subtitle">{{ $langg->lang26 }}</h2>
                </div>
                    <div class="owl-carousel owl-theme featured-products">
                       @foreach($feature_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                     <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{$langg->lang55}}</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="#" class="product-category">  @if(!$slang)
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
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                      <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <i class="fas fa-compare"></i>
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
                    </div><!-- End .featured-products -->
                </div><!-- End .container -->
            </div><!-- End .home-top-section -->
             @endif
             @if($ps->best == 1)
             <div class="container-fluid products-bottom">
                  <div class="title-group text-center">
                    <h2 class="title mb-3">{{ $langg->lang27 }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme featured-products">
                       @foreach($best_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                     <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{$langg->lang55}}</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
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
                                    @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                      <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <i class="fas fa-compare"></i>
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
                    </div><!-- End .featured-products -->
                </div><!-- End .container -->
            </div><!-- End .home-top-section -->
             @endif
              
             @if($ps->top_rated ==1)
                   <div class="container-fluid products-bottom">
                <div class="title-group text-center">
                    <h2 class="title mb-3">	{{ $langg->lang28 }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme featured-products">
                       @foreach($top_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:245px;"  @if(!$slang)
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
                                     <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
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
                                    @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                      <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <i class="fas fa-compare"></i>
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
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach
                    </div><!-- End .featured-products -->
                </div><!-- End .container -->
            </div><!-- End .home-top-section -->
             @endif
             
               @if($ps->big == 1)
                   <div class="container-fluid products-bottom">
                <div class="title-group text-center">
                    <h2 class="title mb-3">{{ $langg->lang29 }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme featured-products">
                       @foreach($big_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                                               @endif
                                                               
                                                               >
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
                                     <button class="btn-icon btn-add-cart add-to-cart" data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                    <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">Quick View</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="#" class="product-category">  @if(!$slang)
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
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                      <a class="paction add-compare add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  title="Add to Compare">
                                        <i class="fas fa-compare"></i>
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
                            </div><!-- End .product-details -->
                        </div>
                        @endforeach
                    </div><!-- End .featured-products -->
                </div><!-- End .container -->
            </div><!-- End .home-top-section -->
             @endif
             
    