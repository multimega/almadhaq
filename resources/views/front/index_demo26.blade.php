@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<style>
    .home-slide{
        background-position: center;
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }
    .home-slide-content.right{
        text-align: right;
    }
    
    .home-slide-content.left{
        text-align: left;
    }
    
    .home-slide-content.center{
        text-align: center;
    }
    .owl-carousel .owl-nav.disabled{
        display:block;
    }
    .home-banners .home-banner{
        height:250px;
    }
    .inner-icon:hover .btn-icon{
        background: transparent;
    }
    @media only screen and (max-width: 600px) {
  .home .banner-content h2{
          font-size:1.2erm;
  }
  .footer img{
      width:30%;
  }
  
}

</style>
<main class="home main">
    <div class="home-top">
        @if($ps->slider == 1)
        <div class="home-slider owl-carousel owl-carousel-lazy">
            
            @foreach($sliders as $data)
            <div class="home-slide" class="owl-lazy" style="background-image: url('assets/images/sliders/{{$data->photo}}')">
                <img class="owl-lazy" src="{{asset('assets/demo_26/assets/images/lazy.png')}}" data-src="" alt="slider image">
                <div class="container">
                    <div class="row row-sm">
                        
                    @if($data->position == 'slide-one')
                        <div class="home-slide-content col-12 left">
                   
                    @elseif($data->position == 'slide-two')
                        <div class="home-slide-content col-12 center">
                   
                    
                   @elseif($data->position == 'slide-three')
                        <div class="home-slide-content col-12 right">
                            
                    @else 
                    
                         <div class="home-slide-content col-12">
                             
                    @endif
                            <h2 class="home-slide-title" style="color:{{$data->title_color}};font-size:{{$data->title_size}}" data-animation="animated {{$data->title_anime}}">
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
                        </div><!-- End .home-slide-content -->
                    </div>
                </div>
            </div><!-- End .home-slide -->
            @endforeach
        </div>
    </div><!-- End .home-slider -->
    @endif


    <section class="category-banner container text-center mt-6">
        <h1>{{$langg->lang970}}</h1>
        <p>{{$langg->lang970}}</p>

       
        <div class="row row-sm">
           
           
            @if(!empty($fix_banners[0]))
            <div class="col-12 col-md-8 col-xl-6 mb-2">
                <img src="{{asset('assets/images/banners/'.$fix_banners[0]->photo)}}">
                <div class="row row-sm banner-content v-middle">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <h2 class="mb-2 font-large"><span>{!! $fix_banners[0]->title_ar !!}</span>{!! $fix_banners[0]->subtitle_ar!!}</h2>
                        <a href="{{$fix_banners[0]->link}}"><i>{!! $fix_banners[0]->btn_ar !!}</i></a>
                    </div>
                </div>
            </div>
           @endif 
            
            
             @if(!empty($fix_banners[1]))
            <div class="col-6 col-md-4 col-xl-3 mb-2">
                <img src="{{asset('assets/images/banners/'.$fix_banners[1]->photo)}}">
                <div class="banner-content v-bottom mb-4">
                    <h2>{!! $fix_banners[1]->title_ar !!}</h2>
                    <a href="{{$fix_banners[1]->link}}"><i class="font-small">{!! $fix_banners[1]->btn_ar  !!}</i></a>
                </div>
            </div>
            @endif
            
            
            
            @if(!empty($fix_banners[2]))
            <div class="col-6 col-md-4 col-xl-3 mb-2">
                <img src="{{asset('assets/images/banners/'.$fix_banners[2]->photo)}}">
                <div class="banner-content v-stretch">
                    <h2 class="font-small mt-4">{!!  $fix_banners[2]->title_ar  !!}</h2>
                    <a href="{{$fix_banners[2]->link}}" class="mb-3"><i>{!!  $fix_banners[2]->btn_ar   !!}</i></a>
                </div>
            </div>
            
            @endif
            
            
             @if(!empty($fix_banners[3]))
            <div class="col-6 col-md-4 col-xl-3 mb-2">
                <img src="{{asset('assets/images/banners/'.$fix_banners[3]->photo)}}">
                <div class="banner-content v-top mt-4">
                    <h2>{!!  $fix_banners[3]->title_ar   !!}</h2>
                    <a href="{{$fix_banners[3]->link}}"><i class="font-small"></i>{!!   $fix_banners[3]->btn_ar    !!}</a>
                </div>
            </div>
            @endif
            
            
            
            
             @if(!empty($fix_banners[4]))
            <div class="col-6 col-md-4 col-xl-3 mb-2">
                <img src="{{asset('assets/images/banners/'.$fix_banners[4]->photo)}}">
                <div class="banner-content v-stretch">
                    <h2 class="mt-4">{!! $fix_banners[4]->title_ar   !!}</h2>
                    <a href="#" class="mb-3"><i class="font-small">{!! $fix_banners[4]->btn_ar   !!}</i></a>
                </div>
            </div>
            
            @endif
            
            
         @if(!empty($fix_banners[5]))   
            <div class="col-md-4 mb-3 visible-md">
                <img src="{{asset('assets/images/banners/'.$fix_banners[5]->photo)}}">
                <div class="banner-content v-bottom mb-4">
                    <h2>{!!  $fix_banners[5]->title_ar  !!}</h2>
                    <a href="#"><i class="font-small">{!!  $fix_banners[5]->btn_ar  !!}</i></a>
                </div>
            </div>
            
            @endif
            
            
            
             @if(!empty($fix_banners[6])) 
            <div class="col-12 col-md-8 col-xl-6 mb-2">
                <img src="{{asset('assets/images/banners/'.$fix_banners[6]->photo)}}">
                <div class="banner-content v-stretch">
                    <h2 class="font-large mt-6">{!! $fix_banners[6]->title_ar  !!}</h2>
                    <a href="#" class="mb-6"><i class="font-large">{!!  $fix_banners[6]->btn_ar  !!}</i></a>
                </div>
            </div>
            
            @endif
            
            
        </div>
    </section>

    
      @if($ps->service ==1 )

    <section class="container mt-1 mb-1" id="service">
        <div class="row row-sm">
            @foreach($chunk as $service )
            <div class="col-md-3">
                <div class="service-widget">
                   <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">
                    <div class="service-content">
                        <h2>@if(!$slang) 
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
                        </h2>
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
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    
    @endif
    
    @if($ps->featured ==1)
    <section class="home-products-intro container mt-4 mb-4">
        
          <h2 class="subtitle">{{ $langg->lang26}}</h2>
        <div class="row row-sm">
            @foreach($feature_products as $prod)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
                        <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}"
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
                            <img src="{{ $prod->photo  ? asset('assets/images/thumbnails/'.$prod->thumbnail) : asset('assets/images/noimage.png') }}" class="hover-image"
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
                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">{{$langg->lang55}}</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                              @if(!empty($prod->category->slug))
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                              @endif
                            </div>
                             @if(Auth::guard('web')->check())
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                            <span>{{ $langg->lang54 }}</span>
                                        </a>
                                        @endif
                        
                        </div>
                        <h2 class="product-title">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
    </section>
    @endif

    <section class="home-banners">
        <div class="home-banner" style="background-color : #e2e2e0;">
            <div class="banner-content text-center">
                <h2>{{$langg->lang970}}</h2>
                <p>{{$langg->lang970}}</p>
            </div>
        </div>
      
      
          @if($ps->featured_category == 1)
      
        @foreach($categories->where('is_featured','=',1) as $cat)  
       
       
        <a href="{{ route('front.category', ['category' => $cat->slug , 'lang' => $sign ]) }}" class="home-banner">
            <img src="{{asset('assets/images/categories/'.$cat->image) }}">
            <div class="banner-content text-center v-bottom">
                <h2 style="font-size:18px;"> 
                
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
                </h2>
            </div>
        </a>
        
        
        @endforeach
        @endif
      
   
   
   
    </section>

    @if($ps->top_rated ==1)
    <section class="home-products-intro container mt-8 mb-4">
        
         <h2 class="subtitle">{{ $langg->lang28}}</h2>
        <div class="row row-sm">
            @foreach($top_products as $prod)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}"
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
                              <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}"
                             class="hover-image" @if(!$slang)
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
                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">{{$langg->lang55}}</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                                 @if(!empty($prod->category->slug))
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                               @endif
                            </div>
                             @if(Auth::guard('web')->check())
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                            <span>{{ $langg->lang54 }}</span>
                                        </a>
                                        @endif
                        
                        </div>
                        <h2 class="product-title">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
    </section>
    @endif
    
    @if($ps->best ==1)
    <section class="home-products-intro container mt-8 mb-4">
          <h2 class="subtitle">{{ $langg->lang27}}</h2>
        <div class="row row-sm">
            @foreach($best_products as $prod)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}"
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
                             <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">{{$langg->lang55}}</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                                 @if(!empty($prod->category->slug))
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                               @endif
                            </div>
                             @if(Auth::guard('web')->check())
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                            <span>{{ $langg->lang54 }}</span>
                                        </a>
                                        @endif
                        
                        </div>
                        <h2 class="product-title">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
    </section>
    @endif
@if($ps->big ==1)
    <section class="home-products-intro container mt-8 mb-4">
         <h2 class="subtitle">{{ $langg->lang29}}</h2>
        <div class="row row-sm">
            @foreach($big_products as $prod)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}"
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
                             <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">{{$langg->lang55}}</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
   @if(!empty($prod->category->slug))
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                               @endif                            </div>
                              @if(Auth::guard('web')->check())
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                            <span>{{ $langg->lang54 }}</span>
                                        </a>
                                        @endif
                        
                        </div>
                        <h2 class="product-title">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
    </section>
    @endif
    @if($ps->hot_sale ==1)
    
     
    <section class="home-products-intro container mt-8 mb-4">
          <h2 class="subtitle">{{ $langg->lang32}}</h2>
        <div class="row row-sm">
            @foreach($trending_products as $prod)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
                        <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}"
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
                           <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">{{$langg->lang55}}</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
   @if(!empty($prod->category->slug))
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                               @endif                            </div>
                              @if(Auth::guard('web')->check())
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                            <span>{{ $langg->lang54 }}</span>
                                        </a>
                                        @endif
                        
                        </div>
                        <h2 class="product-title">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
    </section>
    @endif
    @if($ps->hot_sale ==1)
    <section class="home-products-intro container mt-8 mb-4">
        
          <h2 class="subtitle">{{ $langg->lang30}}</h2>
        <div class="row row-sm">
            @foreach($hot_products as $prod)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}"
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
                             <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">{{$langg->lang55}}</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
   @if(!empty($prod->category->slug))
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                               @endif                            </div>
                              @if(Auth::guard('web')->check())
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                            <span>{{ $langg->lang54 }}</span>
                                        </a>
                                        @endif
                        
                        </div>
                        <h2 class="product-title">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
    </section>
    @endif
    @if($ps->hot_sale ==1)
    <section class="home-products-intro container mt-8 mb-4">
           <h2 class="subtitle subtitle-line mb-5"><span>{{ $langg->lang33}}</span></h2>
        
        <div class="row row-sm">
            @foreach($sale_products as $prod)
              
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ]) }}">
                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}"
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
                            <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">{{$langg->lang55}}</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
   @if(!empty($prod->category->slug))
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                               @endif                            </div>
                              @if(Auth::guard('web')->check())
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                            <span>{{ $langg->lang54 }}</span>
                                        </a>
                                        @endif
                        
                        </div>
                        <h2 class="product-title">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
    </section>
    @endif
    @if($ps->hot_sale ==1)
    <section class="home-products-intro container mt-8 mb-4">
        
           <h2 class="subtitle subtitle-line mb-5"><span>{{ $langg->lang31}}</span></h2>
        <div class="row row-sm">
            @foreach($latest_products as $prod)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}"
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
                            <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">{{$langg->lang55}}</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
   @if(!empty($prod->category->slug))
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                               @endif                            </div>
                             @if(Auth::guard('web')->check())
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                            <span>{{ $langg->lang54 }}</span>
                                        </a>
                                        @endif
                        
                        </div>
                        <h2 class="product-title">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
    </section>
    @endif
    @if($ps->flash_deal ==1)
    <section class="home-products-intro container mt-8 mb-4">
        
         <h2 class="subtitle">{{ $langg->lang244}}</h2>
        <div class="row row-sm">
            @foreach($discount_products as $prod)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
                         <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}"
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
                             <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail)  : asset('assets/images/noimage.png') }}" class="hover-image" @if(!$slang)
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
                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="{{$langg->lang55}}">{{$langg->lang55}}</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
   @if(!empty($prod->category->slug))
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">{{$prod->category->name}}</a>
                               @endif                            </div>
                            
                            
                             @if(Auth::guard('web')->check())
                                        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                            <span>{{ $langg->lang54 }}</span>
                                        </a>
                                        @endif
                        
                        </div>
                        <h2 class="product-title">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
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
    </section>
    @endif
    
    @if($ps->partners == 1)
    <section class="partners-panel mt-2 mb-6 has-bod-tb">
        <div class="container partners-carousel owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{
            'loop' : false,
            'nav': false,
            'dots': true,
            'margin' : 85,
            'autoHeight': true,
            'autoplay': true,
            'autoplayTimeout': 5000,
            'responsive': {
              '0': {
                'items': 2,
                'margin': 0
              },
              '768': {
                'items': 3
              },
              '992' : {
                'items' : 4
              },
              '1200': {
                'items': 5
              }
            }
        }">
            @foreach($partners as $j)
            <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo" style="width:160px;height:60px">
            @endforeach
        </div>
    </section>
    @endif
</main><!-- End .main -->