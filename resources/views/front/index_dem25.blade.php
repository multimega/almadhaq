
@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();

$categorys = App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp

<main class="main home">
    
            <div class="container">
                <div class="row row-sm">
                    <div class="col-lg-9">
                        <div class="home-slider owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                            'items' : 1,
                            'margin' : 0,
                            'nav' : true,
                            'dots' : false
                        }">
                            
                            
                            @if($ps->slider == 1)
            				@if(count($sliders))
            				@foreach($sliders as $data)
                            <div class="home-slide" style="background-image: url('assets/images/sliders/{{$data->photo}}')">
                                <div class="slide-content">
                                    <h2 class="text-right" style="color:{{$data->title_color}};size:{{$data->title_size}}" > @if(!$slang)
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
                                    <div class="skew-box-group">
                                        <span class="skew-box" style="color:{{$data->subtitle_color}};size:{{$data->subtitle_size}}" >
                                        
                                      
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
                                        <h3 class="sale-off skew-box" style="color:{{$data->title_color}};size:{{$data->title_size}}">
                                          <span>
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
                                          </span>
                                        </h3>
                                    </div>
                                          @if(!empty($data->link)) 
                            
                                             <button class="btn" style="background-color:#87001D;color:#fff;">
                                                 <a href="{{$data->link}}">
                                                     
                                                
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
                                             </button>
                                     
                                            @endif
                                    
                                </div>
                                
                            </div>
                            @endforeach
                            @endif
                            @endif
                          
                        </div>
                    </div>
                    
                     @if($ps->flash_deal  == 1)
                    <div class="col-lg-3">
                        <div class="product-slider owl-carousel owl-theme" data-toggle="owl">
                           
                            @foreach($discount_products as $prod)
                            <div class="product-slide">
                                <h3>{{ $langg->lang244}}</h3>
                                <div class="product-default">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                            <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"   @if(!$slang)
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
                                <div class="count-down-panel text-center">
                                    <h4>@if($langg->rtl != "1") OFFER ENDS IN:  @else      : العرض مستمر لمدة  @endif
                                    <?php 

$now = time(); // or your date as well
$your_date = strtotime("$prod->discount_date");
$datediff =  $your_date- $now;
 


echo '   ' . round($datediff / (60 * 60 * 24)) ;

  ?>  ايام
                                    </h4>
                                </div>
                            </div>
                            @endforeach
                           
                        </div>
                    </div>
                </div>
                 @endif
                 
                @if($ps->service == 1) 
                <section class="service-section mb-4">
                    
                @foreach($chunk as $key=>$data )
                     <div class="col-md-6 col-xl-3">
                        <div class="service-widget">
                              @if($key == 0)
                                       <i class="service-icon icon-shipping"></i>
                                    @endif
                                    @if($key == 1)
                                     
                                       <i class="service-icon icon-money"></i>
                        
                                   @endif
                                    @if($key == 2)
                                     <i class="service-icon icon-support"></i>
                                   @endif
                                    @if($key == 3)
                                       <i class="service-icon icon-secure-payment"></i>
                                   @endif
                           
                            <div class="service-content">
                                <h3 class="service-title">@if(!$slang)
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
                                      @endif </h3>
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
                            </div>
                        </div>
                    </div>
                @endforeach
                   
                </section>
                @endif
               
                @if($ps->best ==1)
                <section class="product-panel">
                    <div class="section-title">
                        <h2>{{ $langg->lang27}}</h2>
                    </div>

                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 0,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav': true,
                        'responsive': {
                            '576': {
                                'items': 3
                            },
                            '992': {
                                'items': 4
                            },
                            '1200': {
                                'items' : 5
                            }
                        }
                    }">
                        
                         @foreach($best_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                                        <a href="{{ route('front.category',['category' => $prod->category->slug , 'lang' => $sign]) }}" class="product-category">
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

											<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icon-heart"></i>
											</span>

									@endif
                                    
                                </div>
                                <h2 class="product-title">
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
                <div class="row row-sm">
                    
                    <div class="col-lg-6">
                        <a href="{{$fix_banners[0]->link}}">
                         
                           @if(!empty($fix_banners[0]))
                            <div class="banner-product bg-grey" style="background-image: url('assets/images/banners/{{$fix_banners[0]->photo}}');background-position : 50%;background-color:{{$gs->colors}}">
                                <h2>{!!   $fix_banners[0]->title !!}</h2>
                                <div class="ml-3 primary-background">
                                    <h3 class="skew-box">{!! $fix_banners[0]->subtitle !!}</h3>
                                     <h4 class="skew-box"><span class=" product-price"></span><span class="old-price"></span></h4>
                                </div>
                            </div>
                            @endif
                        </a>
                    </div>
                    
                    <div class="col-lg-6">
                        @if(!empty($fix_banners[1]))
                        <a href="{{$fix_banners[1]->link}}">
                            
                            <div class="banner-product bg-grey" style="background-image: url('assets/images/banners/{{$fix_banners[1]->photo}}');
                                background-position : 48% 10%;background-color:{{$gs->colors}}">
                                <h2>{!! $fix_banners[1]->title  !!}</h2>
                                <div class="ml-3 secondary-background">
                                    <h3 class="skew-box">{!! $fix_banners[1]->subtitle  !!}</h3>
                                    <h4 class="skew-box"><span class=" product-price"></span><span class="old-price"></span></h4>
                                </div>
                            </div>
                            
                        </a>
                        @endif
                    </div>
                </div>
              	@if($ps->featured_category == 1)
                <section class="product-category-panel mb-6">
                    <div class="section-title">
                        <h2>{{$langg->lang930}}</h2>
                    </div>

                    <div class="product-category-intro owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{
                        'margin': 0,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav': true,
                        'responsive': {
                            '480': {
                                'items': 3
                            },
                            '576': {   
                                'items' : 4;
                            },
                            '768': {
                                'items': 5
                            },
                            '992': {
                                'items' : 6
                            },
                            '1200' : {
                                'items' : 7
                            }
                        }
                    }">
                         @foreach($categories->where('is_featured','=',1) as $cat)
                        <a href="{{ route('front.category',['category' => $cat->slug , 'lang' => $sign]) }}">	<img style="width:50px;height:50px;border-radius:50%;" src="{{asset('assets/images/categories/'.$cat->photo) }}" >
                           
                           
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
                        
                        
                        </a>
                        @endforeach
                        
                      
                    </div>
                </section>
                @endif
            </div>
            
            
            
            
        @if($ps->hot_sale ==1)
         <section class="bg-grey pt-3 pb-3">
                <div class="container">
                    <section class="product-panel mt-5 mb-5">
                        <div class="section-title mb-2">
                            <h2>{{ $langg->lang33}} <a href="{{ route('front.products',$sign) }}">( {{$langg->lang471}} )</a></h2>
                        </div>
                                             
                        <div class="grid margin-2">
                            <div class="grid-item height-x2 col-md-8 col-lg-9 col-xl-5col-2">
                                <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                                    'items' : 1,
                                    'margin' : 0,
                                    'nav' : true,
                                    'dots' : false
                                }">
                                    <img src="{{$sale_products[0]->photo ? asset('assets/images/thumbnails/'.$sale_products[0]->thumbnail):asset('assets/images/noimage.png') }}" 
                                        
                                          @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
                                                              alt="{{$sale_products[0]->alt_ar}}"        
                                                              @else 
                                                               alt="{{$sale_products[0]->alt}}"    
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                                  alt="{{$sale_products[0]->alt_ar}}"    
                                                              @else
                                                                   alt="{{$sale_products[0]->alt}}"    
                                                              @endif
                                                               @endif
                                    >
                                    <img src="{{ $sale_products[0]->photo ? asset('assets/images/thumbnails/'.$sale_products[0]->thumbnail):asset('assets/images/noimage.png') }}"      
                                          @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
                                                              alt="{{$sale_products[0]->alt_ar}}"        
                                                              @else 
                                                               alt="{{$sale_products[0]->alt}}"    
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                                  alt="{{$sale_products[0]->alt_ar}}"    
                                                              @else
                                                                   alt="{{$sale_products[0]->alt}}"    
                                                              @endif
                                                               @endif>
                                    <img src="{{ $sale_products[0]->photo ? asset('assets/images/thumbnails/'.$sale_products[0]->thumbnail):asset('assets/images/noimage.png') }}"     
                                          @if(!$slang)
                                                              @if($lang->id == 2)
                                                               
                                                              alt="{{$sale_products[0]->alt_ar}}"        
                                                              @else 
                                                               alt="{{$sale_products[0]->alt}}"    
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                                  alt="{{$sale_products[0]->alt_ar}}"    
                                                              @else
                                                                   alt="{{$sale_products[0]->alt}}"    
                                                              @endif
                                                               @endif >
                                </div>
                            </div>
                            
                             @foreach($sale_products as $prod)
                            
                            <div class="grid-item height-x1 col-md-4 col-6 col-lg-3 col-xl-5col">
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
                                    </figure>
                                    <div class="product-details">
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
                </div>
            </section>
        @endif
             
              

          
          
          
          
         @if($ps->hot_sale ==1)
            <div class="container">
                <section class="product-panel mt-6">
                    <div class="section-title">
                        <h2>{{ $langg->lang31}} </h2>
                    </div>

                    <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 0,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'dots': false,
                        'nav': true,
                        'responsive': {
                            '576': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            },
                            '1200': {
                                'items' : 5
                            }
                        }
                    }">
                        
                         @foreach($latest_products as $prod)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                
                                     
                                       <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
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

											<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icon-heart"></i>
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
                                                      @endif
                                                
                                </a> 
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:0%"></span><!-- End .ratings -->
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
            </div>
         @endif
         

         
         
        <div class="home-banner">
            @if(isset($large_banners[0]) && !empty($large_banners[0]))
            <a href='{{$large_banners[0]->link}}' style="height:250px; width:25%">
                <div class="image-container">
                    <img src="{{asset('assets/images/banners/'.$large_banners[0]->photo)}}" style="object-fit:cover">
                </div>
            </a>
            @endif
            <div class="info-group">
                <div class="">
                    @if(isset($large_banners[0]) && !empty($large_banners[0]))
                    <p>{!! $large_banners[0]->subtitle !!}</p>
                    <h2>{!! $large_banners[0]->title !!}</h2>
                    @endif
                </div>
                <div>
                    @if(isset($large_banners[0]) && !empty($large_banners[0]))
                    <a href="{{$large_banners[0]->link}}">{!! $large_banners[0]->button !!}</a>
                    @endif
                </div>
                <!--<div class="skew-box-group">-->
                    <!--<span class="skew-box">@if(!empty($large_banners[0])){{$large_banners[0]->subtitle}}@endif</span>-->
                <!--    <h3 class="sale-off skew-box"><span></span></h3>-->
                <!--</div>-->
                <!--<div class="">-->
                    
                <!--    <button class="btn">@if(!empty($large_banners[0])){{$large_banners[0]->button}}@endif</button>-->
                <!--</div>-->
                </div>
            
        </div>
        
        
        
        <div class='container'>
		
		
	   @foreach($categorys  as $cat)
	    
	    
	     @if(count($cat->subs) > 0 )
		
        <section class="detailed-category mt-5 mb-5">
            <div class="section-title mb-0 no-border">
                <h2>  @if(!$slang)
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
  @endif <a href="{{route('front.category', ['category' => $cat->slug , 'lang' => $sign])}}">( {{$langg->lang471}} )</a></h2>
            </div>


            <div class="grid">
               
                <div class="col-5 col-lg-2 height-x2 grid-item">
                    <div class="category-lists" style="height:auto;">
                        
                         @foreach($cat->subs as $subcat)
                                <a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug ,'lang' => $sign]) }}">@if(!$slang)
                                
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
                              
                              
                        @endforeach
                   
                         
                    </div>
                </div>
               
                <div class="col-7 col-lg-3 height-x2 grid-item">
                    <div class="owl-carousel owl-theme owl-height" data-toggle="owl" data-owl-options="{
                        'items' : 1,
                        'margin' : 0,
                        'nav' : false,
                        'dots' : false
                    }">
                        <div class="home-slide" style="background-image: url('assets/images/banners/{{$fix_banners[0]->photo}}');">
                            @if(!empty($fix_banners[0]))
                            <div class="slide-content">
                                <h2 class="text-center">{!! $fix_banners[0]->title !!}</h2>
                                <div class="skew-box-group">
                                    <span class="skew-box">{!! $fix_banners[0]->subtitle !!}</span>
                                    <h3 class="sale-off skew-box"><span></span></h3>
                                </div>
                                <a href="{{$fix_banners[0]->link}}" target="_blank" class="btn btn-info">{!! $fix_banners[0]->button !!}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                @foreach($cat->products as $key=>$prod)
                
                @if($key == 0) 
                <div class="col-12 col-md-8 col-lg-4-big height-x1 grid-item">
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                        </figure>
                        <div class="product-details">
                            <h2 class="product-title">
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
                            </h2>
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                </div>
                @endif
                
                 @if($key == 1) 
                <div class="col-6 col-md-4 col-lg-2-big height-x2 grid-item">
                     <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                        </figure>
                        <div class="product-details">
                            <h2 class="product-title">
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
                            </h2>
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                </div>
                @endif
                 @if($key == 2) 
                <div class="col-6 col-md-4 col-lg-2-big height-x1 grid-item">
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
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
                        </figure>
                        <div class="product-details">
                            <h2 class="product-title">
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
                            </h2>
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                </div>
                @endif
                 @if($key == 3) 
                <div class="col-6 col-md-4 col-lg-2-big height-x1 grid-item">
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
                        </figure>
                        <div class="product-details">
                            <h2 class="product-title">
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
                            </h2>
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                </div>
                @endif
                  @endforeach
            </div>
           
        </section>
       
        @endif
		
		@endforeach
      

        
        
    
    
    
    
     @if($ps->top_rated ==1)
        <section class="product-panel mt-6">
            <div class="section-title">
                <h2>{{ $langg->lang28}} </h2>
            </div>

            <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                'margin': 0,
                'items': 2,
                'autoplayTimeout': 5000,
                'dots': false,
                'nav': true,
                'responsive': {
                    '559': {
                        'items': 3
                    },
                    '975': {
                        'items': 4
                    },
                    '1200': {
                        'items' : 5
                    }
                }
            }">
                
                 @foreach($top_products as $prod)
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',['slug' => $prod->slug , 'lang' => $sign]) }}">
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

									<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icon-heart"></i>
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
    
    
    
  	  	@if($ps->partners == 1)
          <section class="container mt-3 mb-7" id="topBrands">
            <div class="section-title mb-6">
                <h2>{{ $langg->lang236 }}</h2>
            </div>
            <div class="partners-carousel owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{
                'loop' : true,
                'nav': false,
                'dots': true,
                'autoHeight': true,
                'autoplay': true,
                'autoplayTimeout': 5000,
                'responsive': {
                  '0': {
                    'items': 2,
                    'margin': 0
                  },
                  '480': {
                    'items': 3
                  },
                  '768': {
                    'items': 4
                  },
                  '992': {
                    'items': 5
                  }
                }
            }">
                 @foreach($partners as $j)
                <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo">
                @endforeach
                
            </div>
        </section>
        @endif
       
           
           

            
</main><!-- End .main -->