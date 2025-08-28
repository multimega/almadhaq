@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);


@endphp
<style>
    .product-label.label-cut:after{
        content: '|';
        display:inline-block
    }
    .home-product .product-label.label-cut:last-of-type:after{
        content:'';
    }
    .category-books img{
        height:180px;
    }
    .home-banner-middle {
        height: 200px;
        background-color: #3256F4;
        background-size: cover;
        background-position: 50% 50%;
        background-image: url('{{('assets/images/banners/'.$fix_banners[0]->photo)}}') !important;
    }
    .banner-content br{
        display: none;
    }
    .category-books .banner-content button span{
        margin-bottom: 0;
    }
</style>
<main>
            @if($ps->featured_category == 1)
            <div class="home-top">
                <div class="home-slider owl-carousel owl-carousel-lazy">
                   
                    @foreach($categories->where('is_featured','=',1) as $category) 
                    <div class="home-slide text-center" class="owl-lazy" style="background-image: url('assets/images/categories/{{$category->photo}}')">
                        <img class="owl-lazy" src="" alt="slider image">
                        <div class="home-slide-content">
                            <h2>
                                
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
                                
                            </h2>
                            <span style="color:#fff;opacity: 0.6;"> {{$category->products->count()}} product</span>
                            <a href="{{ route('front.category',['category' => $category->slug ,'lang' => $sign ]) }}">View all products<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div><!-- End .home-slide-content -->
                        <div class="home-product">
                            <figure>
                                <a href="{{ route('front.product', ['slug' => $category->products[0]->slug , 'lang' => $sign]) }}"><img src="{{  $category->products[0]->photo ? asset('assets/images/thumbnails/'. $category->products[0]->thumbnail):asset('assets/images/noimage.png') }}"></a>
                                <a href="{{ route('product.quickz', $category->products[0]->id) }}" class="btn btn-quickview">{{ $langg->lang55 }}</a>
                            </figure>
                            <div class="product-details">
                                <h2 class="product-title">
                                    <a href="{{ route('front.product', ['slug' => $category->products[0]->slug , 'lang' => $sign]) }}">
                                          @if(!$slang)
                                                              @if($lang->id == 2)
                                                              {{ $category->products[0]->name_ar }}
                                                              @else 
                                                              {{  $category->products[0]->name }}
                                                              @endif 
                                                              @else  
                                                              @if($slang == 2) 
                                                              {{ $category->products[0]->name_ar }}
                                                              @else
                                                              {{  $category->products[0]->name }} 
                                                              @endif
                                              @endif
                                         
                                    </a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{App\Models\Rating::ratings( $category->products[0]->id)}}%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">{{  $category->products[0]->showPreviousPrice() }}</span>
                                    <span class="product-price">{{  $category->products[0]->showPrice() }}</span>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .home-slide -->
                   @endforeach
                </div>
            </div>
            @endif
            
            @if($ps->featured ==1)
            <section class="container mt-4" id="bestsellers">
                
                    <div class="section-title">
                        <h2>{{ $langg->lang26}}</h2>
                        <a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="section-content row row-sm">
                        <div class="col-md-6 col-xl-4">
                            <div class="home-banner text-center">
                                <div class="banner-content">
                                    <span> 
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
                                    </span>
                                    <h2> @if(!$slang)
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
                                              @endif</h2>
                                    <!--<p>* SELECTED BOOKS</p>-->
                                </div>
                                <img src="{{('assets/images/banners/'.$fix_banners[0]->photo)}}">
                                <a href="{{$fix_banners[0]->link}}"><button class="btn btn-primary">
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
                                    <i class="fas fa-long-arrow-alt-right"></i></button></a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-8 home-products-intro">
                            <div class="row row-sm">
                                @foreach($feature_products as $prod)
                                <div class="col-6 col-sm-4 col-xl-3 home-product">
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
                                </a>
                                        @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut" style="">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                        <div class="btn-icons">
                                
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a>
                                    </figure>
                                    <div class="product-details">
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
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </section>
            @endif
            <section class="bg-white pb-5" style="margin-top : 5.5rem;">
                <div class="container">
                    <div class="row row-sm category-books">
                         @foreach($fix_banners as $banner)
                        <div class="col-lg-4 col-md-6 home-banner">
                            <img src="{{('assets/images/banners/'.$banner->photo)}}" class="w-100">
                            <div class="banner-content">
                                <h2>
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
                                </h2>
                                <h4 class="mb-3 text-uppercase text-white">
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
                                <a href="{{$banner->link}}"><button class="btn">
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
                                </button></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <section class="home-products-intro">
                        @if($ps->top_rated ==1)
                        <div class="section-title">
                            <h2>{{ $langg->lang28}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                        <div class="row row-sm">
                            @foreach($top_products as $prod)
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="home-product">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
                                        @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                          <div class="btn-icons">
                                
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <h2 class="product-category">{{$prod->category->name}}</h2>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                            @endif
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
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @if($ps->best ==1)
                        <div class="section-title">
                            <h2>{{ $langg->lang27}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                        <div class="row row-sm">
                            @foreach($top_products as $prod)
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="home-product">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
                                        @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                         <div class="btn-icons">
                                
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <h2 class="product-category">{{$prod->category->name}}</h2>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                            @endif
                                        </div>
                                        <h2 class="product-title">
                                            <a href="{{ route('front.product',['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @if($ps->big ==1)
                        <div class="section-title">
                            <h2>{{ $langg->lang29}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                        <div class="row row-sm">
                            @foreach($big_products as $prod)
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="home-product">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
                                        @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                         <div class="btn-icons">
                                
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <h2 class="product-category">{{$prod->category->name}}</h2>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                            @endif
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
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </section>
                </div>
            </section>
            @if(!empty($fix_banners[0]))
            <section class="home-banner home-banner-middle" style="margin-bottom: 4.5rem;" style="background-image: url('{{('assets/images/banners/'.$fix_banners[0]->photo)}}') !important">
                <div class="container">
                    <div class="banner-content">
                        <span> 
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
                        </span>
                        <h2> @if(!$slang)
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
                                  @endif</h2>
                        <!--<p>* SELECTED BOOKS</p>-->
                    </div>
                    <a href="{{$fix_banners[0]->link}}"><button class="btn">
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
                        <i class="fas fa-long-arrow-alt-right"></i></button></a>
                
                </div>
            </section>
            @endif
            <section class="home-products-intro container">
                @if($ps->hot_sale ==1)
                        <div class="section-title">
                            <h2>{{ $langg->lang33}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                        <div class="row row-sm">
                            @foreach($sale_products as $prod)
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="home-product">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
                                        @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                          <div class="btn-icons">
                                
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <h2 class="product-category">{{$prod->category->name}}</h2>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                            @endif
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
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @if($ps->hot_sale ==1)
                        <div class="section-title">
                            <h2>{{ $langg->lang32}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                        <div class="row row-sm">
                            @foreach($trending_products as $prod)
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="home-product">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
                                        @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                          <div class="btn-icons">
                                
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <h2 class="product-category">{{$prod->category->name}}</h2>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                            @endif
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
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @if($ps->hot_sale ==1)
                        <div class="section-title">
                            <h2>{{ $langg->lang30}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                        <div class="row row-sm">
                            @foreach($hot_products as $prod)
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="home-product">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
                                        @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                         <div class="btn-icons">
                                
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <h2 class="product-category">{{$prod->category->name}}</h2>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                            @endif
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
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @if($ps->hot_sale ==1)
                        <div class="section-title">
                            <h2>{{ $langg->lang31}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                        <div class="row row-sm">
                            @foreach($latest_products as $prod)
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="home-product">
                                    <figure>
                                        <a href="{{ route('front.product', ['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
                                        @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                         <div class="btn-icons">
                                
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <h2 class="product-category">{{$prod->category->name}}</h2>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                            @endif
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
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @if($ps->flash_deal ==1)
                        <div class="section-title">
                            <h2>{{ $langg->lang244}}</h2>
                            <a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}<i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                        <div class="row row-sm">
                            @foreach($discount_products as $prod)
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="home-product">
                                    <figure>
                                        <a href="{{ route('front.product',['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
                                        @if(!empty($prod->features))
                                        @foreach($prod->features as $key => $data1)
                                        
                                     	@if(!empty($prod->features[$key]))
                                        <span class="product-label label-cut">{{ $prod->features[$key] }} </span>
                                         @endif
                                        @endforeach 
                                        @endif
                                          <div class="btn-icons">
                                
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
                                        <a href="{{ route('product.quickz',$prod->id) }}" class="btn-quickview" title="Quick View">{{ $langg->lang55 }}</a> 
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <h2 class="product-category">{{$prod->category->name}}</h2>
                                            @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"  class="btn-icon btn-icon-wish paction add-wishlist add-to-wish" title="{{ $langg->lang54 }}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                            @endif
                                        </div>
                                        <h2 class="product-title">
                                            <a href="{{ route('front.product',['slug' =>$prod->slug , 'lang' => $sign]) }}">
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
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                                            <span class="product-price">{{ $prod->showPrice() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
            </section>
        </main><!-- End .main -->