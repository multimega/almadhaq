@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);


@endphp
<style>
@media only screen and (max-width: 575px) {
  .home-slide {
    height: 209px;
    
  }
  header .header-search .header-search-wrapper {
    right:0;     
  }
}
.home-banner .banner-content .cross-txt::after,
.home-banner .banner-content .cross-txt::before{
    content:unset;
}
.add-to-wish{
    font-size: 14px;
}

</style>


              <main class="home main">
                  
            <div class="top-slider owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                'items' : 1,
                'margin' : 0,
                'nav': true,
                'dots': false
            }">
                
                
                 @if($ps->slider == 1)
				   @if(count($sliders))
					@foreach($sliders as $data)

                <div class="home-slide">
                    <div class="slide-content" style="background-image: url('assets/images/sliders/{{$data->photo}}');color:#fff">
                        
                        
                        <!--<img class="img-fluid"  src="{{asset('assets/images/sliders/'.$data->photo)}}">-->
                       
                        
                       
                        <div class="content-rightr" style="text-align:{{$data->position}}">
                            <span style="color:{{$data->subtitle_color}};size:{{$data->subtitle_size}}">
                                
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
                                
                            </span>
                            <h2 style="color:{{$data->title_color}};size:{{$data->title_size}}"> @if(!$slang)
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
                              
                            <h4 class="" style="color:{{$data->details_color}};size:{{$data->details_size}}"> @if($lang->id == 2)
                                                     {{$data->details_text_ar}}
                                                    @else 
                                                       {{$data->details_text}}
                                                      @endif </h4>
                            
                            
                            
                             <a class="btn btn-secondary" href="{{$data->link}}">{{ $langg->lang25 }}</a>
                            
                            
                            <!--@if(!empty($data->link)) -->
                            
                            <!-- <button class="btn" style="background-color:#87001D;color:#fff;"><a href="{{$data->link}}">{{ $langg->lang25 }}</a></button>-->
                     
                            <!--@endif-->
                     
                     
                     
                     
                     
                     
                     
                     
                        </div>
                    </div>
                </div> 
              
             @endforeach
                    @endif
                    @endif
            
            
            </div>
            
            
         

    
            <div class="container">
               
               @if($ps->featured == 1)
                <section class="product-panel">
                    <div class="section-title">
                        <h2>{{ $langg->lang26 }} </h2>
                    </div>
                    
                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 4,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav' : true,
                        'responsive': {
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
                        
                       
                          
                            @foreach($feature_products  as $key => $prod)
                            
                          
                        <div class="product-default inner-quickview inner-icon center-details">
                            <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:100%;"  @if(!$slang)
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
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" style="background-color:#4DB7B3" title="Quick View">
                                    
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

																<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icon-heart" ></i>
																</span>

																@else

																<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																	<i class="icon-heart"></i>
																</span>

										@endif
                                </div>
                                <h2 class="product-title" style="overflow-wrap:break-word;width:13em;">
                                     <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                  
                                               
                                                                     
                                              @if(!$slang)
                                                              @if($lang->id == 2)
                                                              {{ $prod->name_ar }}
                                                              @else 
                                                              {{  $prod->name }}
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                              {{ $prod->name_ar }}
                                                              @else
                                                              {{  $prod->name }} 
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
                </section>
                @endif
                
                
                
                
                    
                
                    	@if($ps->featured_category == 1)
                    
                 	
                
                   <div class="product-cat-box owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                    'margin': 0,
                    'items': 2,
                    'loop' : false,
                    'autoplayTimeout': 5000,
                    'dots': false,
                    'nav' : true,
                    'responsive': {
                        '0' : {
                            'items' : 2
                        },
                        '768': {
                            'items': 3
                        },
                        '992' : {
                            'items' : 4
                        },
                        '1200': {
                            'items': 4
                        }
                    }
                }">
                      
                     
                    
                         @foreach($categories->where('is_featured','=',1) as $cat)  
                      
                         
                         <div class="product-cat" style="width:auto;height:100px;padding:0px 5px; ">
                        
                        
                        	<span class="left">
								<img src="{{asset('assets/images/categories/'.$cat->image) }}" alt="">
							</span>
                        <span>
                           <a href="{{ route('front.category',['category' => $cat->slug , 'lang' => $sign]) }}" class="single-category">  @if(!$slang)
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
                                 </a>
                            </span>
                            
                    </div>
                   
                    
                    @endforeach
                    
                </div>
                
                @endif
               
            
                
                
               
               
                @if($ps->best == 1)
                <section class="product-panel">
                    <div class="section-title">
                        <h2>{{ $langg->lang27 }} </h2>
                    </div>
                    
                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 4,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav' : true,
                        'responsive': {
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
                        
                       
                          
                            @foreach($best_products  as $key => $prod)
                            
                          
                        <div class="product-default inner-quickview inner-icon center-details">
                            <figure>
                                <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:100%;"  @if(!$slang)
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
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" style="background-color: #4DB7B3" title="Quick View">
                                    
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

																<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icon-heart" ></i>
																</span>

																@else

																<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																	<i class="icon-heart"></i>
																</span>

										@endif
                                </div>
                                <h2 class="product-title" style="overflow-wrap:break-word;width:13em;">
                                     <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                  
                                               
                                                                     
                                              @if(!$slang)
                                                              @if($lang->id == 2)
                                                              {{ $prod->name_ar }}
                                                              @else 
                                                              {{  $prod->name }}
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                              {{ $prod->name_ar }}
                                                              @else
                                                              {{  $prod->name }} 
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
                </section>
                @endif
                
            </div>
            
 
 @foreach($large_banners as $key=>$banner)
            <div class="home-banner mb-1">
                @if($key%2==0)
                <div class="banner-left" style="position:relative">
                    <img src="{{asset('assets/images/banners/'.$banner->photo)}}">
                    <div class="banner-content" style="margin-left: 0;left: 0;right:0;transform: translateX(0);text-align: center;margin: auto;">
                        <span>{!! $banner->title !!}</span>
                        <h3 class="my-3"><a href="#" class="btn">{!! $banner->subtitle !!} </a></h3>
                        <h4 class="cross-txt">{!! $banner->subtitle !!}</h4>
                    </div>
                </div>
                @else
                <div class="banner-right">
                    <img src="{{asset('assets/images/banners/'.$banner->photo)}}">
                     <div class="banner-content">
                        <span>{!! $banner->title !!}</span>
                        <h3><a href="#" class="btn">{!! $banner->subtitle !!} </a></h3>
                        <h4 class="cross-txt">{!! $banner->subtitle !!}</h4>
                    </div>
                </div>
                @endif
            </div>
            
        @endforeach

       
            

           
            <div class="container">
                   @if($ps->hot_sale ==1)
                <section class="product-panel">
                    <div class="section-title">
                        <h2>{{ $langg->lang32 }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 4,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav' : true,
                        'responsive': {
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
                        
                        
                          @foreach($trending_products as  $prod)
                            
                          
                        <div class="product-default inner-quickview inner-icon center-details">
                            <figure>
                                <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:100%;"  @if(!$slang)
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
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" style="background-color:#4DB7B3" title="Quick View">
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
                                     @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                </div>
                                <h2 class="product-title" style="overflow-wrap:break-word;width:13em;">
                                     <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                  
                                                @if(!$slang)
                                                              @if($lang->id == 2)
                                                              {{ $prod->name_ar }}
                                                              @else 
                                                              {{  $prod->name }}
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                              {{ $prod->name_ar }}
                                                              @else
                                                              {{  $prod->name }} 
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
                </section>
                
                @endif
                
                
                  @if($ps->top_rated ==1)
                <section class="product-panel">
                    <div class="section-title">
                        <h2>{{ $langg->lang28 }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 4,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav' : true,
                        'responsive': {
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
                        
                        
                          @foreach($top_products as  $prod)
                            
                          
                        <div class="product-default inner-quickview inner-icon center-details">
                            <figure>
                                <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:100%;" @if(!$slang)
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
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" style="background-color:#4DB7B3" title="Quick View">
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
                                     @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                </div>
                                <h2 class="product-title" style="overflow-wrap:break-word;width:13em;">
                                     <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                  
                                                @if(!$slang)
                                                              @if($lang->id == 2)
                                                              {{ $prod->name_ar }}
                                                              @else 
                                                              {{  $prod->name }}
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                              {{ $prod->name_ar }}
                                                              @else
                                                              {{  $prod->name }} 
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
                </section>
                
                @endif
                
                
                
                
                  @if($ps->big ==1)
                <section class="product-panel">
                    <div class="section-title">
                        <h2>{{ $langg->lang29 }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 4,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav' : true,
                        'responsive': {
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
                        
                        
                          @foreach($big_products as  $prod)
                            
                          
                        <div class="product-default inner-quickview inner-icon center-details">
                            <figure>
                                <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:100%;" @if(!$slang)
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
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" style="background-color:#4DB7B3" title="Quick View">
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
                               
                                {{$prod->category->name_ar }}
                                  
                                     @else 
                                  
                                 {{ $prod->category->name }}

                                  @endif 
                                     
                                @else
                                  @if($slang == 2) 
                                     {{ $prod->category->name_ar }}

                                  @else
                                 {{ $prod->category->name }}

                                    @endif  @endif</a>
                                    </div>
                                     @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                </div>
                                <h2 class="product-title" style="overflow-wrap:break-word;width:13em;">
                                     <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                  
                                                @if(!$slang)
                                                              @if($lang->id == 2)
                                                              {{ $prod->name_ar }}
                                                              @else 
                                                              {{  $prod->name }}
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                              {{ $prod->name_ar }}
                                                              @else
                                                              {{  $prod->name }} 
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
                </section>
                
                @endif
                
                
                
                
                    @if($ps->hot_sale ==1)
                <section class="product-panel">
                    <div class="section-title">
                        <h2>{{ $langg->lang31 }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 4,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav' : true,
                        'responsive': {
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
                        
                        
                          @foreach($latest_products as  $prod)
                            
                          
                        <div class="product-default inner-quickview inner-icon center-details">
                            <figure>
                                <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:100%;" @if(!$slang)
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
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" style="background-color:#4DB7B3" title="Quick View">
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
                               
                                {{$prod->category->name_ar }}
                                  
                                     @else 
                                  
                                 {{ $prod->category->name }}

                                  @endif 
                                    @else 
                                  @if($slang == 2) 
                                     {{ $prod->category->name_ar }}

                                  @else
                                 {{ $prod->category->name }}

                                   @endif   @endif</a>
                                    </div>
                                     @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                </div>
                                <h2 class="product-title" style="overflow-wrap:break-word;width:13em;">
                                     <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                  
                                                @if(!$slang)
                                                              @if($lang->id == 2)
                                                              {{ $prod->name_ar }}
                                                              @else 
                                                              {{  $prod->name }}
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                              {{ $prod->name_ar }}
                                                              @else
                                                              {{  $prod->name }} 
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
                </section>
                
                @endif
                
                
                
                
                 
               
                
                
                
                   @if($ps->hot_sale ==1)
                <section class="product-panel">
                    <div class="section-title">
                        <h2>{{ $langg->lang30 }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 4,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav' : true,
                        'responsive': {
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
                        
                        
                          @foreach($hot_products as  $prod)
                            
                          
                        <div class="product-default inner-quickview inner-icon center-details">
                            <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:100%;" @if(!$slang)
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
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" style="background-color:#4DB7B3" title="Quick View">
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
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">   @if(!$slang)  @if($lang->id == 2)
                               
                                {{$prod->category->name_ar }}
                                  
                                     @else 
                                  
                                 {{ $prod->category->name }}

                                  @endif 
                                     @else
                                  @if($slang == 2) 
                                     {{ $prod->category->name_ar }}

                                  @else
                                 {{ $prod->category->name }}

                                  @endif    @endif</a>
                                    </div>
                                     @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                </div>
                                <h2 class="product-title" style="overflow-wrap:break-word;width:13em;">
                                     <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                  
                                                @if(!$slang)
                                                              @if($lang->id == 2)
                                                              {{ $prod->name_ar }}
                                                              @else 
                                                              {{  $prod->name }}
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                              {{ $prod->name_ar }}
                                                              @else
                                                              {{  $prod->name }} 
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
                </section>
                
                @endif
                
                
                
                  @if($ps->hot_sale ==1)
                <section class="product-panel">
                    <div class="section-title">
                        <h2>{{ $langg->lang33 }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 4,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav' : true,
                        'responsive': {
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
                        
                        
                          @foreach($sale_products as  $prod)
                            
                          
                        <div class="product-default inner-quickview inner-icon center-details">
                            <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:100%;" @if(!$slang)
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
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" style="background-color:#4DB7B3" title="Quick View">
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
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">   @if(!$slang)  @if($lang->id == 2)
                               
                                {{$prod->category->name_ar }}
                                  
                                     @else 
                                  
                                 {{ $prod->category->name }}

                                  @endif 
                                  @else   
                                  @if($slang == 2) 
                                     {{ $prod->category->name_ar }}

                                  @else
                                 {{ $prod->category->name }}

                                    @endif  @endif</a>
                                    </div>
                                     @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                </div>
                                <h2 class="product-title" style="overflow-wrap:break-word;width:13em;">
                                     <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                  
                                                @if(!$slang)
                                                              @if($lang->id == 2)
                                                              {{ $prod->name_ar }}
                                                              @else 
                                                              {{  $prod->name }}
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                              {{ $prod->name_ar }}
                                                              @else
                                                              {{  $prod->name }} 
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
                </section>
                
                @endif
                
                
                
                
                
                
                
                
                  @if($ps->flash_deal  == 1)
                <section class="product-panel">
                    <div class="section-title">
                        <h2>{{ $langg->lang244 }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 4,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav' : true,
                        'responsive': {
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
                        
                        
                          @foreach($discount_products as  $prod)
                            
                          
                        <div class="product-default inner-quickview inner-icon center-details">
                            <figure>
                                <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign])}}">
                                    <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" style="width:100%; height:100%;" @if(!$slang)
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
                                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    @endif
                                </div>
                                <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" style="background-color:#4DB7B3" title="Quick View">
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
                                        <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}" class="product-category">    @if(!$slang)  @if($lang->id == 2)
                               
                                {{$prod->category->name_ar }}
                                  
                                     @else 
                                  
                                 {{ $prod->category->name }}

                                  @endif 
                                    @else 
                                  @if($slang == 2) 
                                     {{ $prod->category->name_ar }}

                                  @else
                                 {{ $prod->category->name }}

                                    @endif  @endif</a>
                                    </div>
                                     @if(Auth::guard('web')->check())
                                    <a data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-to-wish btn-icon-wish"><i class="icon-heart"></i></a>
                                     @endif
                                </div>
                                <h2 class="product-title" style="overflow-wrap:break-word;width:13em;">
                                     <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
                                                  
                                                @if(!$slang)
                                                              @if($lang->id == 2)
                                                              {{ $prod->name_ar }}
                                                              @else 
                                                              {{  $prod->name }}
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                              {{ $prod->name_ar }}
                                                              @else
                                                              {{  $prod->name }} 
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
                </section>
                
                @endif
                
                  <div class="row row-sm mb-5 home-banner4">
                      
            @foreach( $bottom_small_banners as $key => $bottom_small_banner)
                 
                 @if($key%2 == 0)
                    <div class="col-6">
                        <div class="row row-sm home-banner4-white">
                            <div class="col-md-4" >
                                <span>{!! $bottom_small_banner->title !!}</span>
                                <h3>{!! $bottom_small_banner->title !!}</h3>
                            </div>
                            <div class="col-md-4">
                                <div class="banner-image" style="background-image: url('assets/images/banners/{{$bottom_small_banner->photo}}');background-repeat:no-repeat;background-position:center center;opacity:0.4;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn"><a href="{{$bottom_small_banner->link}}"> @if(!$slang)
                                              @if($lang->id == 2)
                                                     تسوق كل شئ
                                              @else 
                                               Shop All Sale
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                                 تسوق كل شئ
                                              @else
                                              Shop All Sale
                                              @endif
                                @endif</a></button>
                            </div>
                        </div>
                    </div>
                  
                  @else
                     <div class="col-6" >
                        <div class="row row-sm home-banner4-primary " style="background-color:{{$gs->colors}}">
                            <div class="col-md-4">
                                <span>{!! $bottom_small_banner->title !!}</span>
                                <h3>{!! $bottom_small_banner->title !!}</h3>
                            </div>
                            <div class="col-md-4">
                                <div class="banner-image" style="background-image: url('assets/images/banners/{{$bottom_small_banner->photo}}');background-repeat:no-repeat;background-position:center center;opacity:0.3;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn"><a href="{{$bottom_small_banner->link}}"> @if(!$slang)
                                              @if($lang->id == 2)
                                                     تشوق كل شئ
                                              @else 
                                               Shop All Sale
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                                 تشوق كل شئ
                                              @else
                                              Shop All Sale
                                              @endif
                                @endif</a></button>
                            </div>
                        </div>
                    </div>
                     
                   
                  @endif 
                @endforeach
                  
                   
                </div>
                </div>
                
        </main><!-- End .main -->