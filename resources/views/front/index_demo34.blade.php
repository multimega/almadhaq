@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);


@endphp
<!-- Start Home Slider -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
      @php
      $count = 0;
      @endphp
  @foreach($sliders as $data)
  @php
  $count++;
  @endphp
    <div class="carousel-item @if($count == 1) active @endif">
      <a href="{{$data->link}}">
        <img class="d-block w-100" src="{{asset('assets/images/sliders/'.$data->photo)}}" alt="">
      </a>
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
<!-- End Home Slider -->
<!-- Start Category -->
<div class="h-cat-sec px-4 pt-4 pb-1 mb-3">
  <div class="flex-row justify-content-center">
      @foreach($categories as $category) 
      <div class="column-1 text-center">
        <a href="{{ route('front.f-category',['category' => $category->slug ,'lang' => $sign ]) }}">
          <img src="{{'assets/images/categories/'.$category->photo}}">
          <p class="text-dark font-weight-bold m-auto">
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
          </p>
        </a>
      </div>
      @endforeach
  </div>  
</div>
<!-- End Category -->
<!-- Start Products -->
@if($ps->featured ==1)
<div class="h-products px-4 pt-4 pb-1 mb-3">
  <div class="products-head d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">{{ $langg->lang26 }}</h5>
    <a href="{{ route('front.f-products',$sign) }}">{{ $langg->lang25 }}</a>
  </div>
  <div class="owl-carousel owl-theme owl-products">
    @foreach($feature_products as $prod)
    <!-- Start Product -->
    <div class="product-box item">
      <div class="product-img">
        @if(Auth::guard('web')->check())
        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-wishlist paction add-wishlist add-to-wish">
          <i class="far fa-heart"></i>
        </a>
        @endif
        @if($prod->emptyStock())
          <button class="btn-cart-out-of-stock">
            <a href="javascript:;" class="cart-out-of-stock">
              <i class="icofont-close-circled"></i>
              {{ $langg->lang78 }}</a>
          </button>
        @else    
        <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="fas fa-shopping-bag"></i></button>
        @endif
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
      </div>
      <div class="product-desc px-2 pb-2">
        <a href="{{ route('front.product_34',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
          <div class="product-name">
            <h4>
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
            </h4>
          </div>
          <div class="product-price mb-2">
            <span class="current-price">{{ $prod->showPrice() }}</span>
            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
          </div>
          <div class="product-rating d-flex justify-content-between align-items-center">
            <div class="ratings d-flex">
              <div class="empty-stars"></div>
              <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
              ({{count($prod->ratings)}})
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Product -->  
    @endforeach
  </div>
</div>
@endif
<!-- End Products -->
<!-- Start Banner -->
@if($ps->large_banner ==1)
    @if(! empty($large_banners[0]))
    <div class="h-banner px-4 pt-4 pb-1 mb-3">
        <a href="{{$large_banners[0]->link}}">
            <img src="{{asset('assets/images/banners/'.$large_banners[0]->photo)}}" style="height: 200px;object-fit: cover;" alt="banner">
        </a>
    </div>
    @endif
@endif            
<!-- End Banner -->
<!-- Start Random Category -->
<div class="h-random-category px-4 pt-4 pb-1 mb-3">
  <div class="row">
    @foreach($fix_banners as $banner)
    <div class="col-md-3 col-sm-6 col-12 mb-3 fix-banner">
      <a href="{{$banner->link}}">
        <img src="{{('assets/images/banners/'.$banner->photo)}}">
        <span>@if(!$slang)
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
        </span>
      </a>
    </div>
    @endforeach
  </div>
</div>
<!-- End Random Category -->

<!-- Start Products -->
@if($ps->best ==1)
<div class="h-products px-4 pt-4 pb-1 mb-3">
  <div class="products-head d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">{{ $langg->lang27 }}</h5>
    <a href="{{ route('front.f-products',$sign) }}">{{ $langg->lang25 }}</a>
  </div>
  <div class="owl-carousel owl-theme owl-products">
    @foreach($best_products as $prod)
    <!-- Start Product -->
    <div class="product-box item">
      <div class="product-img">
        @if(Auth::guard('web')->check())
        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-wishlist paction add-wishlist add-to-wish">
          <i class="far fa-heart"></i>
        </a>
        @endif
        @if($prod->emptyStock())
          <button class="btn-cart-out-of-stock">
            <a href="javascript:;" class="cart-out-of-stock">
              <i class="icofont-close-circled"></i>
              {{ $langg->lang78 }}</a>
          </button>
        @else    
        <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="fas fa-shopping-bag"></i></button>
        @endif
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
      </div>
      <div class="product-desc px-2 pb-2">
        <a href="{{ route('front.product_34',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
          <div class="product-name">
            <h4>
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
            </h4>
          </div>
          <div class="product-price mb-2">
            <span class="current-price">{{ $prod->showPrice() }}</span>
            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
          </div>
          <div class="product-rating d-flex justify-content-between align-items-center">
            <div class="ratings d-flex">
              <div class="empty-stars"></div>
              <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
              ({{count($prod->ratings)}})
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Product -->  
    @endforeach
  </div>
</div>
@endif
<!-- End Products -->
<!-- Start Products -->
@if($ps->top_rated ==1)
<div class="h-products px-4 pt-4 pb-1 mb-3">
  <div class="products-head d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">{{ $langg->lang28 }}</h5>
    <a href="{{ route('front.f-products',$sign) }}">{{ $langg->lang25 }}</a>
  </div>
  <div class="owl-carousel owl-theme owl-products">
    @foreach($top_products as $prod)
    <!-- Start Product -->
    <div class="product-box item">
      <div class="product-img">
        @if(Auth::guard('web')->check())
        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-wishlist paction add-wishlist add-to-wish">
          <i class="far fa-heart"></i>
        </a>
        @endif
        @if($prod->emptyStock())
          <button class="btn-cart-out-of-stock">
            <a href="javascript:;" class="cart-out-of-stock">
              <i class="icofont-close-circled"></i>
              {{ $langg->lang78 }}</a>
          </button>
        @else    
        <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="fas fa-shopping-bag"></i></button>
        @endif
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
      </div>
      <div class="product-desc px-2 pb-2">
        <a href="{{ route('front.product_34',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
          <div class="product-name">
            <h4>
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
            </h4>
          </div>
          <div class="product-price mb-2">
            <span class="current-price">{{ $prod->showPrice() }}</span>
            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
          </div>
          <div class="product-rating d-flex justify-content-between align-items-center">
            <div class="ratings d-flex">
              <div class="empty-stars"></div>
              <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
              ({{count($prod->ratings)}})
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Product -->  
    @endforeach
  </div>
</div>
@endif
<!-- End Products -->
<!-- Start Products -->
@if($ps->big ==1)
<div class="h-products px-4 pt-4 pb-1 mb-3">
  <div class="products-head d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">{{ $langg->lang29 }}</h5>
    <a href="{{ route('front.f-products',$sign) }}">{{ $langg->lang25 }}</a>
  </div>
  <div class="owl-carousel owl-theme owl-products">
    @foreach($big_products as $prod)
    <!-- Start Product -->
    <div class="product-box item">
      <div class="product-img">
        @if(Auth::guard('web')->check())
        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-wishlist paction add-wishlist add-to-wish">
          <i class="far fa-heart"></i>
        </a>
        @endif
        @if($prod->emptyStock())
          <button class="btn-cart-out-of-stock">
            <a href="javascript:;" class="cart-out-of-stock">
              <i class="icofont-close-circled"></i>
              {{ $langg->lang78 }}</a>
          </button>
        @else    
        <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="fas fa-shopping-bag"></i></button>
        @endif
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
      </div>
      <div class="product-desc px-2 pb-2">
        <a href="{{ route('front.product_34',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
          <div class="product-name">
            <h4>
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
            </h4>
          </div>
          <div class="product-price mb-2">
            <span class="current-price">{{ $prod->showPrice() }}</span>
            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
          </div>
          <div class="product-rating d-flex justify-content-between align-items-center">
            <div class="ratings d-flex">
              <div class="empty-stars"></div>
              <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
              ({{count($prod->ratings)}})
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Product -->  
    @endforeach
  </div>
</div>
@endif
<!-- End Products -->
<!-- Start Products -->
@if($ps->hot_sale ==1)
<div class="h-products px-4 pt-4 pb-1 mb-3">
  <div class="products-head d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">{{ $langg->lang32 }}</h5>
    <a href="{{ route('front.f-products',$sign) }}">{{ $langg->lang25 }}</a>
  </div>
  <div class="owl-carousel owl-theme owl-products">
    @foreach($trending_products as $prod)
    <!-- Start Product -->
    <div class="product-box item">
      <div class="product-img">
        @if(Auth::guard('web')->check())
        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-wishlist paction add-wishlist add-to-wish">
          <i class="far fa-heart"></i>
        </a>
        @endif
        @if($prod->emptyStock())
          <button class="btn-cart-out-of-stock">
            <a href="javascript:;" class="cart-out-of-stock">
              <i class="icofont-close-circled"></i>
              {{ $langg->lang78 }}</a>
          </button>
        @else    
        <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="fas fa-shopping-bag"></i></button>
        @endif
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
      </div>
      <div class="product-desc px-2 pb-2">
        <a href="{{ route('front.product_34',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
          <div class="product-name">
            <h4>
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
            </h4>
          </div>
          <div class="product-price mb-2">
            <span class="current-price">{{ $prod->showPrice() }}</span>
            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
          </div>
          <div class="product-rating d-flex justify-content-between align-items-center">
            <div class="ratings d-flex">
              <div class="empty-stars"></div>
              <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
              ({{count($prod->ratings)}})
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Product -->  
    @endforeach
  </div>
</div>
@endif
<!-- End Products -->
<!-- Start Products -->
@if($ps->hot_sale ==1)
<div class="h-products px-4 pt-4 pb-1 mb-3">
  <div class="products-head d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">{{ $langg->lang33 }}</h5>
    <a href="{{ route('front.f-products',$sign) }}">{{ $langg->lang25 }}</a>
  </div>
  <div class="owl-carousel owl-theme owl-products">
    @foreach($hot_products as $prod)
    <!-- Start Product -->
    <div class="product-box item">
      <div class="product-img">
        @if(Auth::guard('web')->check())
        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-wishlist paction add-wishlist add-to-wish">
          <i class="far fa-heart"></i>
        </a>
        @endif
        @if($prod->emptyStock())
          <button class="btn-cart-out-of-stock">
            <a href="javascript:;" class="cart-out-of-stock">
              <i class="icofont-close-circled"></i>
              {{ $langg->lang78 }}</a>
          </button>
        @else    
        <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="fas fa-shopping-bag"></i></button>
        @endif
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
      </div>
      <div class="product-desc px-2 pb-2">
        <a href="{{ route('front.product_34',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
          <div class="product-name">
            <h4>
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
            </h4>
          </div>
          <div class="product-price mb-2">
            <span class="current-price">{{ $prod->showPrice() }}</span>
            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
          </div>
          <div class="product-rating d-flex justify-content-between align-items-center">
            <div class="ratings d-flex">
              <div class="empty-stars"></div>
              <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
              ({{count($prod->ratings)}})
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Product -->  
    @endforeach
  </div>
</div>
@endif
<!-- End Products -->
<!-- Start Products -->
@if($ps->flash_deal ==1)
<div class="h-products px-4 pt-4 pb-1 mb-3">
  <div class="products-head d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">{{ $langg->lang244 }}</h5>
    <a href="{{ route('front.f-products',$sign) }}">{{ $langg->lang25 }}</a>
  </div>
  <div class="owl-carousel owl-theme owl-products">
    @foreach($discount_products as $prod)
    <!-- Start Product -->
    <div class="product-box item">
      <div class="product-img">
        @if(Auth::guard('web')->check())
        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-wishlist paction add-wishlist add-to-wish">
          <i class="far fa-heart"></i>
        </a>
        @endif
        @if($prod->emptyStock())
          <button class="btn-cart-out-of-stock">
            <a href="javascript:;" class="cart-out-of-stock">
              <i class="icofont-close-circled"></i>
              {{ $langg->lang78 }}</a>
          </button>
        @else    
        <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="fas fa-shopping-bag"></i></button>
        @endif
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
      </div>
      <div class="product-desc px-2 pb-2">
        <a href="{{ route('front.product_34',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
          <div class="product-name">
            <h4>
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
            </h4>
          </div>
          <div class="product-price mb-2">
            <span class="current-price">{{ $prod->showPrice() }}</span>
            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
          </div>
          <div class="product-rating d-flex justify-content-between align-items-center">
            <div class="ratings d-flex">
              <div class="empty-stars"></div>
              <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
              ({{count($prod->ratings)}})
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Product -->  
    @endforeach
  </div>
</div>
@endif
<!-- End Products -->
<!-- Start Products -->
@if($ps->hot_sale ==1)
<div class="h-products px-4 pt-4 pb-1 mb-3">
  <div class="products-head d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">{{ $langg->lang31 }}</h5>
    <a href="{{ route('front.f-products',$sign) }}">{{ $langg->lang25 }}</a>
  </div>
  <div class="owl-carousel owl-theme owl-products">
    @foreach($latest_products as $prod)
    <!-- Start Product -->
    <div class="product-box item">
      <div class="product-img">
        @if(Auth::guard('web')->check())
        <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-wishlist paction add-wishlist add-to-wish">
          <i class="far fa-heart"></i>
        </a>
        @endif
        @if($prod->emptyStock())
          <button class="btn-cart-out-of-stock">
            <a href="javascript:;" class="cart-out-of-stock">
              <i class="icofont-close-circled"></i>
              {{ $langg->lang78 }}</a>
          </button>
        @else    
        <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="fas fa-shopping-bag"></i></button>
        @endif
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
      </div>
      <div class="product-desc px-2 pb-2">
        <a href="{{ route('front.product_34',  ['slug' => $prod->slug , 'lang' => $sign ]) }}">
          <div class="product-name">
            <h4>
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
            </h4>
          </div>
          <div class="product-price mb-2">
            <span class="current-price">{{ $prod->showPrice() }}</span>
            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
          </div>
          <div class="product-rating d-flex justify-content-between align-items-center">
            <div class="ratings d-flex">
              <div class="empty-stars"></div>
              <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
              ({{count($prod->ratings)}})
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Product -->  
    @endforeach
  </div>
</div>
@endif
<!-- End Products -->
<!-- Start Partners -->
@if($ps->partners == 1)
<div class="h-brands px-4 pt-4 pb-1 mb-3">
  <div class="products-head d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">Partners</h5>
  </div>
  <div class="owl-carousel owl-theme owl-partners">
    <!-- Start Partner -->
    @foreach($partners as $j)
    <div class="brand-box item">
        <img src="{{asset('assets/images/partner/'.$j->photo)}}">
    </div>
    @endforeach
    <!-- End Partner -->
  </div>
</div>
@endif
<!-- End Partners -->

<!-- Start Banner -->
<!--<div class="h-banner px-4 pt-4 pb-1 mb-3">-->
<!--  <a href="category-filter.php">-->
<!--    <img src="assets/images/midbanner.gif">-->
<!--  </a>-->
<!--</div>-->
<!-- End Banner -->
