@php


$slang = Session::get('language');
$lang = DB::table('languages')->where('is_default','=',1)->first();

$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);


$chunk= App\Models\Service::where('user_id','=',0)->get()->take(3);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(4);

@endphp
<style>
    .product-category img {
        height: 232px;
    }

    .sale-banner.banner h2 {
        font-size: 30px !important;
    }
</style>
<main class="main">
    <div class="home-slider owl-carousel owl-theme show-nav-hover nav-big">
        @if($ps->slider == 1)
        @if(count($sliders))
        @foreach($sliders as $data)
        <a href="{{$data->link}}">
            <div class="home-slide home-slide1 banner">
                <img class="slide-bg owl-lazy" src="assets/images/lazy.png"
                    data-src="assets/images/sliders/{{$data->photo}}" alt="home banner">
                <div class="banner-layer banner-layer-middle">

                    <h2 class="text-uppercase">
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
                    </h2>
                    <h3>
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
                    </h3>
                    <!--<h4 class="m-b-4">on Jackets</h4>-->

                    <!--<h5 class="text-uppercase">Starting at<span class="coupon-sale-text"><sup>$</sup>199<sup>99</sup></span></h5>-->
                    <!--<button class="btn btn-dark btn-xl" role="button">{{ $langg->lang25 }}</button>-->
                </div><!-- End .banner-layer -->
            </div><!-- End .home-slide -->
        </a>
        @endforeach
        @endif
        @endif
    </div><!-- End .home-slider -->

    <!--<section class="container">
				<h2 class="section-title ls-n-10 text-center pt-2 m-b-4">Shop By Category</h2>

				<div class="owl-carousel owl-theme nav-image-center show-nav-hover nav-outer cats-slider">
					@foreach($categories->where('is_featured','=',1) as $category)
					<div class="product-category">
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
					</div>
					@endforeach
				</div>
			</section>-->

    <section class="bg-gray banners-section text-center">
        <div class="container py-2">
            <div class="row">
                @foreach($fix_banners as $banner)
                <div class="col-6 col-lg-4 mb-4 mb-lg-0">
                    <a href="{{$banner->link}}">
                        <div class="home-banner banner banner-sm-vw mb-2">
                            <img src="{{('assets/images/banners/'.$banner->photo)}}">
                            <div class="">
                                <h3 class="m-b-2">
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
                                <h4 class="m-b-3">
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
                        </div>
                        <a href="{{$banner->link}}" class="btn" role="button">@if(!$slang)
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
                            @endif </a>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>



    <section class="container pb-3 mb-1">

        @if($ps->featured ==1)
        <h2 class="section-title ls-n-10 text-center pb-2 m-b-4">{{ $langg->lang26}}</h2>

        <div class="row py-4">
            @foreach($feature_products as $prod)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <button class="btn-icon btn-add-cart add-to-cart paction"
                                data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}"
                                    class="product-category">
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
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                class="btn-icon-wish paction add-wishlist add-to-wish">
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
                        <!--<div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>-->
                        @if(isset($prod->featured_price)) 
                        <div class="price-box">
                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showFeaturedPrice() }}</span></span>
                        </div><!-- End .price-box -->
                        @else
                        <div class="price-box">
                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span></span>
                        </div><!-- End .price-box -->
                        @endif
                       
                    </div><!-- End .product-details -->
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($ps->top_rated ==1)
        <h2 class="section-title ls-n-10 text-center pb-2 m-b-4">{{ $langg->lang28}}</h2>

        <div class="row py-4">
            @foreach($top_products as $prod)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <button class="btn-icon btn-add-cart add-to-cart paction"
                                data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}"
                                    class="product-category">
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
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                class="btn-icon-wish paction add-wishlist add-to-wish">
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
                        <!--<div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>-->
                        <div class="price-box">
                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span></span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($ps->big ==1)
        <h2 class="section-title ls-n-10 text-center pb-2 m-b-4">{{ $langg->lang29}}</h2>

        <div class="row py-4">
            @foreach($big_products as $prod)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <button class="btn-icon btn-add-cart add-to-cart paction"
                                data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}"
                                    class="product-category">
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
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                class="btn-icon-wish paction add-wishlist add-to-wish">
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
                        <!--<div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>-->
                        <div class="price-box">
                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span></span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($ps->best ==1)
        <h2 class="section-title ls-n-10 text-center pb-2 m-b-4">{{ $langg->lang27}}</h2>

        <div class="row py-4">
            @foreach($best_products as $prod)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <button class="btn-icon btn-add-cart add-to-cart paction"
                                data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}"
                                    class="product-category">
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
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                class="btn-icon-wish paction add-wishlist add-to-wish">
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
                        <!--<div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>-->
                        <div class="price-box">
                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span></span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($ps->hot_sale ==1)
        <h2 class="section-title ls-n-10 text-center pb-2 m-b-4">{{ $langg->lang33}}</h2>

        <div class="row py-4">
            @foreach($sale_products as $prod)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <button class="btn-icon btn-add-cart add-to-cart paction"
                                data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}"
                                    class="product-category">
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
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                class="btn-icon-wish paction add-wishlist add-to-wish">
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
                        <!--<div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>-->
                        <div class="price-box">
                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span></span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($ps->hot_sale ==1)
        <h2 class="section-title ls-n-10 text-center pb-2 m-b-4">{{ $langg->lang32}}</h2>

        <div class="row py-4">
            @foreach($trending_products as $prod)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <button class="btn-icon btn-add-cart add-to-cart paction"
                                data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}"
                                    class="product-category">
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
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                class="btn-icon-wish paction add-wishlist add-to-wish">
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
                        <!--<div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>-->
                        <div class="price-box">
                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span></span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($ps->hot_sale ==1)
        <h2 class="section-title ls-n-10 text-center pb-2 m-b-4">{{ $langg->lang30}}</h2>

        <div class="row py-4">
            @foreach($hot_products as $prod)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <button class="btn-icon btn-add-cart add-to-cart paction"
                                data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}"
                                    class="product-category">
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
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                class="btn-icon-wish paction add-wishlist add-to-wish">
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
                        <!--<div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>-->
                        <div class="price-box">
                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span></span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($ps->hot_sale ==1)
        <h2 class="section-title ls-n-10 text-center pb-2 m-b-4">{{ $langg->lang31}}</h2>

        <div class="row py-4">
            @foreach($latest_products as $prod)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <button class="btn-icon btn-add-cart add-to-cart paction"
                                data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}"
                                    class="product-category">
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
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                class="btn-icon-wish paction add-wishlist add-to-wish">
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
                        <!--<div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>-->
                        <div class="price-box">
                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span></span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($ps->flash_deal ==1)
        <h2 class="section-title ls-n-10 text-center pb-2 m-b-4">{{ $langg->lang244}}</h2>

        <div class="row py-4">
            @foreach($discount_products as $prod)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <img src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                                @if(!$slang) @if($lang->id == 2)

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
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <button class="btn-icon btn-add-cart add-to-cart paction"
                                data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
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
                                <a href="{{ route('front.category',['category' => $prod->category->slug ,'lang' => $sign ]) }}"
                                    class="product-category">
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
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                class="btn-icon-wish paction add-wishlist add-to-wish">
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
                        <!--<div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>-->
                        <div class="price-box">
                            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
                            <span class="product-price">{{ $prod->showPrice() }}</span></span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <hr class="mt-3 mb-6">

        <div class="row feature-boxes-container pt-2">
            @foreach($chunk as $key => $service )
            <div class="col-6 col-md-4">
                <div class="feature-box feature-box-simple text-center">
                    <a href="{{$key == 1 ? 'http://wa.me/+971501407102' : ''}}">
                        <img src="{{asset('assets/images/services/'.$service->photo)}}"
                            style="width:50px;height:50px;margin:auto;object-fit: contain;">
                        <div class="feature-box-content">
                            <h3 class="text-uppercase">
                                @if(!$slang)
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
                            </h3>
                            <h5>
                                @if(!$slang)

                                @if($lang->id == 2)
                                {!! $service->details_ar !!}

                                @else
                                {!! $service->details !!}

                                @endif
                                @else
                                @if($slang == 2)
                                {!! $service->details_ar !!}
                                @else
                                {!! $service->details !!}
                                @endif
                                @endif
                            </h5>

                            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>-->
                        </div><!-- End .feature-box-content -->
                    </a>
                </div><!-- End .feature-box -->
            </div><!-- End .col-lg-3 -->
            @endforeach
        </div><!-- End .row .feature-boxes-container-->
    </section>
</main><!-- End .main -->