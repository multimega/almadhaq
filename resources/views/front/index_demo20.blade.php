
@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<style>
    .home-slider-container{
        height:95vh;
        min-height:unset;
    }
    .carousel.slide{
        height:95vh !important;
    }
    
    .product-section-slider::after,
    .product-section-slider::before{
        content:unset;
    }
    @media only screen and (min-width:768px) and (max-width:1024px){
        .home-slider-container{
            height:50vh;
            min-height:unset;
        }
        .carousel.slide{
            height:50vh !important;
        }
        .header-middle.sticky-header .logo img{
            height:50px;
        }
    }
    @media only screen and (max-width:767px){
        .sticky-header.fixed{
            padding-top:1.2rem;
            padding-bottom:1.4rem;
        }
        .header-middle.sticky-header .logo img{
            height:32px !important;
            width:auto !important;
        }
        .home-slider-container{
            height:40vh;
            min-height:unset;
        }
        .carousel.slide{
            height:40vh !important;
        }
        .carousel-caption {
            bottom: 4%;
        }
        .carousel.slide .btn{
            padding: 1rem 2.2rem;
        }
        
    }
        
        .carousel.slide{
            height:100%;
            position:unset;
            width: 100%;
        }
        .carousel-inner,
        .carousel-item{
            height:100% !important
        }
        
        .carousel-item img{
            width: 100%;
            height: 100%;
        }
        .carousel-caption{
            bottom:13%;
            margin-right:unset !important;
            text-align:left;
        }
        .carousel-caption h5{
            font-size:2.5rem;
        }
        
        .carousel-caption p{
            font-size:22px;
        }
        .product-action{
            margin-bottom: 10px;
        }
        .add-cart,
        .add-wishlist,
        .add-compare{
            background: #f5f5f5;
            height: 34px;
            padding-left:10px;
            padding-right:10px;
            cursor:pointer;
        }
        .add-compare{
            position: absolute;
            right: 80px;
        }
        .add-wishlist{
            position: absolute;
            left: 80px;
        }
        .add-cart{
            margin-right:3px;
            margin-left:3px;
            margin:auto;
            z-index:555;
        }
        .add-wishlist::before {
            content: '\e88a';
        }
        
        .add-compare::before {
            content: '\e810';
        }
        
        .add-cart:hover span{
            color:#fff;
        }
        .product:hover .add-compare{
            right:0;
        }
        .product:hover .add-wishlist{
            left:0;
        }
</style>
        <main class="main">
            <div class="home-slider-container" style="">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
      @foreach($sliders as $data)
    <div class="carousel-item" id="active-slider">
      <img src="{{('assets/images/sliders/'.$data->photo)}}" alt="...">
      <div class="carousel-caption d-block">
        <h5>@if(!$slang)
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
          @endif</h5>
        <p>@if(!$slang)
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
                                          @endif</p>
                                          <a class="btn btn-secondary" href="{{$data->link}}">{{ $langg->lang25 }}</a>
      </div>
    </div>
    @endforeach
   
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
            </div><!-- End .home-slider-container -->
            
            @if($ps->featured ==1)
            <div class="container-fluid">
                
                <h2 class="subtitle text-center">{{ $langg->lang26}}</h2>
        
                <div class="featured-products owl-carousel owl-theme">
                    @foreach($feature_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                        </figure>
                        <div class="product-details">
                            <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                    

                             
                                <!--<a data-href="{{ route('product.cart.add',$prod->id) }}"   class="paction add-cart btn-add-cart  add-to-cart" title="Add to Cart">-->
                                <!--    <span>{{$langg->lang56}}</span>-->
                                <!--</a>-->
                                
                                 @if($prod->emptyStock())
                                      <button class="btn" style="z-index:9">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                          
                                     <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal" data-target="#addCartModal" class="paction add-cart add-to-cart" title="Add to Cart">
                                    <span>{{$langg->lang56}}</span>
                                </a>
                                
                                    @endif
                                
                                <!--here  -->
                                

                                <a data-href="{{ route('product.compare.add',$prod->id) }}"  class="paction add-compare" title="Add to Compare">
                                    <span>Add to Compare</span>
                                </a>
                            </div><!-- End .product-action -->
                        
                            <!--<ul class="config-swatch-list">-->
                            <!--    <li class="active">-->
                            <!--        <a href="#" style="background-color: #2d3e50;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #e84c3d;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #3598dc;"></a>-->
                            <!--    </li>-->
                            <!--</ul>-->

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
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-produts -->
                
            </div><!-- End .container-fluid -->
            @endif
            <div class="mb-5 mb-md-7 mb-lg-9"></div><!-- margin -->
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            @if($ps->best ==1)
            <div class="container-fluid">
                
                <h2 class="subtitle text-center">{{ $langg->lang27}}</h2>
        
                <div class="featured-products owl-carousel owl-theme">
                    @foreach($best_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                        </figure>
                        <div class="product-details">
                            <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                    

                             
                                
                                 @if($prod->emptyStock())
                                      <button class="btn" style="z-index:9">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal" class="paction add-cart add-to-cart" title="Add to Cart">
                                    <span>{{$langg->lang56}}</span>
                                </a>
                                
                                    @endif
                                    
                                    

                                <a data-href="{{ route('product.compare.add',$prod->id) }}"  class="paction add-compare" title="Add to Compare">
                                    <span>Add to Compare</span>
                                </a>
                            </div><!-- End .product-action -->
                            <!--<ul class="config-swatch-list">-->
                            <!--    <li class="active">-->
                            <!--        <a href="#" style="background-color: #2d3e50;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #e84c3d;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #3598dc;"></a>-->
                            <!--    </li>-->
                            <!--</ul>-->

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
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-produts -->
                
            </div><!-- End .container-fluid -->
            @endif
            <div class="mb-5 mb-md-7 mb-lg-9"></div><!-- margin -->
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            @if($ps->top_rated ==1)
            <div class="container-fluid">
                
                <h2 class="subtitle text-center">{{ $langg->lang28}}</h2>
        
                <div class="featured-products owl-carousel owl-theme">
                    @foreach($top_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                        </figure>
                        <div class="product-details">
                            <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                    

                               @if($prod->emptyStock())
                                      <button class="btn" style="z-index:9">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal" class="paction add-cart add-to-cart" title="Add to Cart">
                                    <span>{{$langg->lang56}}</span>
                                </a>
                                
                                    @endif

                                <a data-href="{{ route('product.compare.add',$prod->id) }}"  class="paction add-compare" title="Add to Compare">
                                    <span>Add to Compare</span>
                                </a>
                            </div><!-- End .product-action -->
                            <!--<ul class="config-swatch-list">-->
                            <!--    <li class="active">-->
                            <!--        <a href="#" style="background-color: #2d3e50;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #e84c3d;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #3598dc;"></a>-->
                            <!--    </li>-->
                            <!--</ul>-->

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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-produts -->
                
            </div><!-- End .container-fluid -->
            @endif
            <div class="mb-5 mb-md-7 mb-lg-9"></div><!-- margin -->
            @if($ps->big ==1)
            <div class="container-fluid">
                
                <h2 class="subtitle text-center">{{ $langg->lang29}}</h2>
        
                <div class="featured-products owl-carousel owl-theme">
                    @foreach($big_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                        </figure>
                        <div class="product-details">
                            <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                    

                                @if($prod->emptyStock())
                                      <button class="btn" style="z-index:9">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a  data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal" class="paction add-cart add-to-cart" title="Add to Cart">
                                    <span>{{$langg->lang56}}</span>
                                </a>
                                
                                    @endif
                                <a data-href="{{ route('product.compare.add',$prod->id) }}"  class="paction add-compare" title="Add to Compare">
                                    <span>Add to Compare</span>
                                </a>
                            </div><!-- End .product-action -->
                            <!--<ul class="config-swatch-list">-->
                            <!--    <li class="active">-->
                            <!--        <a href="#" style="background-color: #2d3e50;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #e84c3d;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #3598dc;"></a>-->
                            <!--    </li>-->
                            <!--</ul>-->

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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-produts -->
                
            </div><!-- End .container-fluid -->
            @endif
            <div class="mb-5 mb-md-7 mb-lg-9"></div><!-- margin -->
            
            @if($ps->hot_sale ==1)
            <div class="container-fluid">
                
                <h2 class="subtitle text-center">{{ $langg->lang31}}</h2>
        
                <div class="featured-products owl-carousel owl-theme">
                    @foreach($latest_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                        </figure>
                        <div class="product-details">
                            <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                    

                                @if($prod->emptyStock())
                                      <button class="btn" style="z-index:9">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal" class="paction add-cart add-to-cart" title="Add to Cart">
                                    <span>{{$langg->lang56}}</span>
                                </a>
                                
                                    @endif

                                <a data-href="{{ route('product.compare.add',$prod->id) }}"  class="paction add-compare" title="Add to Compare">
                                    <span>Add to Compare</span>
                                </a>
                            </div><!-- End .product-action -->
                            <!--<ul class="config-swatch-list">-->
                            <!--    <li class="active">-->
                            <!--        <a href="#" style="background-color: #2d3e50;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #e84c3d;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #3598dc;"></a>-->
                            <!--    </li>-->
                            <!--</ul>-->

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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-produts -->
                
            </div><!-- End .container-fluid -->
            @endif
            <div class="mb-5 mb-md-7 mb-lg-9"></div><!-- margin -->
            
            @if($ps->hot_sale ==1)
            <div class="container-fluid">
                
                <h2 class="subtitle text-center">{{ $langg->lang32}}</h2>
        
                <div class="featured-products owl-carousel owl-theme">
                    @foreach($trending_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                        </figure>
                        <div class="product-details">
                            <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                    

                                @if($prod->emptyStock())
                                      <button class="btn" style="z-index:9">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal" class="paction add-cart add-to-cart" title="Add to Cart">
                                    <span>{{$langg->lang56}}</span>
                                </a>
                                
                                    @endif

                                <a data-href="{{ route('product.compare.add',$prod->id) }}"  class="paction add-compare" title="Add to Compare">
                                    <span>Add to Compare</span>
                                </a>
                            </div><!-- End .product-action -->
                            <!--<ul class="config-swatch-list">-->
                            <!--    <li class="active">-->
                            <!--        <a href="#" style="background-color: #2d3e50;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #e84c3d;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #3598dc;"></a>-->
                            <!--    </li>-->
                            <!--</ul>-->

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
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-produts -->
                
            </div><!-- End .container-fluid -->
            @endif
            <div class="mb-5 mb-md-7 mb-lg-9"></div><!-- margin -->
            
            @if($ps->hot_sale ==1)
            <div class="container-fluid">
                
                <h2 class="subtitle text-center">{{ $langg->lang33}}</h2>
        
                <div class="featured-products owl-carousel owl-theme">
                    @foreach($hot_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                        </figure>
                        <div class="product-details">
                            <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                    

                                 @if($prod->emptyStock())
                                      <button class="btn" style="z-index:9">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal" class="paction add-cart add-to-cart" title="Add to Cart">
                                    <span>{{$langg->lang56}}</span>
                                </a>
                                
                                    @endif

                                <a data-href="{{ route('product.compare.add',$prod->id) }}"  class="paction add-compare" title="Add to Compare">
                                    <span>Add to Compare</span>
                                </a>
                            </div><!-- End .product-action -->
                            <!--<ul class="config-swatch-list">-->
                            <!--    <li class="active">-->
                            <!--        <a href="#" style="background-color: #2d3e50;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #e84c3d;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #3598dc;"></a>-->
                            <!--    </li>-->
                            <!--</ul>-->

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
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-produts -->
                
            </div><!-- End .container-fluid -->
            @endif
            <div class="mb-5 mb-md-7 mb-lg-9"></div><!-- margin -->
            
            
            @if($ps->flash_deal ==1)
            <div class="container-fluid">
                
                <h2 class="subtitle text-center">{{ $langg->lang244}}</h2>
        
                <div class="featured-products owl-carousel owl-theme">
                    @foreach($discount_products as $prod)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}" class="product-image">
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
                            @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                        </figure>
                        <div class="product-details">
                            <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                    

                                @if($prod->emptyStock())
                                      <button class="btn" style="z-index:9">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal" class="paction add-cart add-to-cart" title="Add to Cart">
                                    <span>{{$langg->lang56}}</span>
                                </a>
                                
                                    @endif

                                <a data-href="{{ route('product.compare.add',$prod->id) }}"  class="paction add-compare" title="Add to Compare">
                                    <span>Add to Compare</span>
                                </a>
                            </div><!-- End .product-action -->
                            <!--<ul class="config-swatch-list">-->
                            <!--    <li class="active">-->
                            <!--        <a href="#" style="background-color: #2d3e50;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #e84c3d;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #3598dc;"></a>-->
                            <!--    </li>-->
                            <!--</ul>-->

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
                            <div class="price-box">
                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                <span class="product-price">{{ $prod->showPrice() }}</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .featured-produts -->
                
            </div><!-- End .container-fluid -->
            @endif
            <div class="mb-5 mb-md-7 mb-lg-9"></div><!-- margin -->
            
            <div class="product-slider-section">
                <div class="product-section-slider owl-carousel owl-carousel-lazy owl-theme owl-theme-light">
                    
                    @foreach($fix_banners as $banner_data)
                    <div class="product-section-slide">
                        <div class="slide-bg owl-lazy" data-src="{{('assets/images/banners/'.$banner_data->photo)}}"></div><!-- End .slide-bg -->

                        <div class="container-fluid product-slide-content">
                            <div class="row">
                                <div class="col-sm-6 offset-sm-6 col-lg-5 offset-lg-7">
                                    <h3>{!!$banner_data->title!!}</h3>
                                    <p>{!!$banner_data->subtitle!!}</p>

                                    <!--<img src="assets/images/product-section-slider/img-1.png" alt="img">-->
                                    <a href="{{$banner_data->link}}" class="btn btn-white">{{ $langg->lang25 }}</a>
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .product-slide-content -->
                    </div><!-- .product-section-slide -->
                    @endforeach

                </div><!-- End .product-section-slider -->
            </div><!-- End .product-slider-section -->

            <div class="products-filter-container">
                <div class="container-fluid">
                    <div class="row align-items-lg-stretch">
                        <aside class="filter-sidebar col-lg-2">
                            <div class="sidebar-wrapper">
                                <h3>Sort By</h3>

                                <ul class="check-filter-list">
                                    @foreach($categorys as $data)
                                    <li><a href="{{ route('front.category', ['category' => $data->slug , 'lang' => $sign]) }}"   @if(count($data->subs) > 0 )  class="sf-with-ul" @endif>
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
                                               @endif</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End .sidebar-wrapper -->
                        </aside><!-- End .col-lg-3 -->

                        <div class="col-lg-10">
                            <div class="row row-sm justify-content-center">
                                @foreach($feature_products as $prod)
                                <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                                    <div class="product">
                                        <figure class="product-image-container">
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
                            @if(!empty($prod->features))
                                @foreach($prod->features as $key => $data1)
                                
                             	@if(!empty($prod->features[$key]))
                                <span class="product-label label-sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }} </span>
                                 @endif
                                @endforeach 
                                @endif
                        </figure>
                        <div class="product-details">
                            <div class="product-action">
                                    @if(Auth::guard('web')->check())
                                    <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                        <span>{{ $langg->lang54 }}</span>
                                    </a>
                                    @endif
                                    

                                 @if($prod->emptyStock())
                                      <button class="btn" style="z-index:9">
                                        <a href="javascript:;" class="cart-out-of-stock">
                                          <i class="icofont-close-circled"></i>
                                          {{ $langg->lang78 }}</a>
                                      </button>
                                    @else    
                                     <a onClick='renderImage("{{asset("assets/images/thumbnails/".$prod->thumbnail)}}")' data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal" class="paction add-cart add-to-cart" title="Add to Cart">
                                    <span>{{$langg->lang56}}</span>
                                </a>
                                
                                    @endif

                                <a data-href="{{ route('product.compare.add',$prod->id) }}"  class="paction add-compare" title="Add to Compare">
                                    <span>Add to Compare</span>
                                </a>
                            </div><!-- End .product-action -->
                            <!--<ul class="config-swatch-list">-->
                            <!--    <li class="active">-->
                            <!--        <a href="#" style="background-color: #2d3e50;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #e84c3d;"></a>-->
                            <!--    </li>-->
                            <!--    <li>-->
                            <!--        <a href="#" style="background-color: #3598dc;"></a>-->
                            <!--    </li>-->
                            <!--</ul>-->

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
                                            <div class="price-box">
                                                <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                                <span class="product-price">{{ $prod->showPrice() }}</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div><!-- End .product -->
                                </div><!-- End .col-lg-3 -->
                                @endforeach
                            </div><!-- End .row -->

                            <div class="product-more-container">
                                <a class="btn btn-outline-dark">Load More</a>
                            </div><!-- End .product-more-container -->
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container-fluid -->
            </div><!-- End .produts-filter-container-->

            @if(!empty($fix_banners[0]))
            
            <div class="explore-section" style="background-image: url({{asset('assets/images/banners/'.$fix_banners[0]->photo)}});">
                <div class="container">
                    <h3>{!!$fix_banners[0]->title!!}</h3>
                    <a href="{{$fix_banners[0]->link}}" class="btn btn-white">{{ $langg->lang25 }}</a>
                </div><!-- End .container -->
            </div><!-- End .explore-section -->
            @endif
        </main><!-- End .main -->
        

        