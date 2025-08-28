@php
$slang = Session::get('language');
$lang = DB::table('languages')->where('is_default','=',1)->first();
$categorys = App\Models\Category::get();
$categoriesChunk = $categories->take(6);
$main = App\Models\Generalsetting::find(1);
$chunk = App\Models\Service::get()->take(4);
$chunkss = App\Models\Service::orderby('id','desc')->get()->take(3);
$bootstrapClasses = ['0'=>'4','1'=>'5','2'=>'3','3'=>'4','4'=>'3','5'=>'5'];
@endphp
<style>
    .home-slide,
    .home-slider .owl-carousel.owl-drag .owl-item,
    .home-slider .owl-carousel.owl-drag .owl-item img {
        height: 480px
    }

    .home-slider::after,
    .boxed-slider::after,
    .home-slider::before,
    .boxed-slider::before {
        content: unset;
    }

    @media only screen and (min-width:768px) and (max-width:991px) {

        .home-slide,
        .home-slider .owl-carousel.owl-drag .owl-item,
        .home-slider .owl-carousel.owl-drag .owl-item img {
            height: 320px !important
        }
    }

    @media only screen and (max-width:767px) {

        .home-slide,
        .home-slider .owl-carousel.owl-drag .owl-item,
        .home-slider .owl-carousel.owl-drag .owl-item img {
            height: 170px !important
        }
    }

    .product-title {
        width: 100%;
        text-align: center;
    }

    .banner-offers .home-banner a:hover {
        color: #fff;
    }

    .partners-panel .owl-carousel .owl-nav.disabled {
        display: block;
    }
</style>
<main class="home main">
    <div class="container">
        <section>
            <div class="row row-sm align-items-center">
                <div class="col-lg-8">
                    <div class="home-slider owl-carousel owl-carousel-lazy owl-theme">
                        @if($ps->slider == 1)
                        @if(count($sliders))
                        @foreach($sliders as $data)

                        <div class="home-slide" class="owl-lazy">
                            <img class="owl-lazy" src="assets/images/lazy.png" data-src="" alt="slider image">
                            <img src="{{('assets/images/sliders/'.$data->photo)}}">
                            <div class="home-slide-content2">
                                <!--<span>up to <strong>40%</strong> off</span>-->
                                <h2>@if(!$slang)
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
                                @if(!empty($data->link))
                                <a href="{{$data->link}}" class="btn btn-dark">{{ $langg->lang25 }}</a>
                                @endif

                            </div>
                        </div>
                        @endforeach
                        @endif
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <form action="#" method="get" class="find-form">
                        <h3>{{ $langg->lang2500 }}</h3>
                        <div class="select-custom">
                            <select class="form-control" id="byCategory">
                                <option disabled="" selected="" hidden="">{{ $langg->lang2501 }}</option>
                                 @php
                                $brands = \App\Models\Brand::all();
                                @endphp

                                @foreach($brands as $brand)
                                <option>

                                    <a
                                        href="{{route('front.singlebrands',['slug' => $brand->slug , 'lang' => $sign ])}}">
                                        @if(!$slang)
                                        @if($lang->id == 2)
                                        {{ $brand->name_ar }}
                                        @else
                                        {{ $brand->name }}
                                        @endif

                                        @else
                                        @if($slang == 2)
                                        {{ $brand->name_ar }}
                                        @else
                                        {{ $brand->name }}
                                        @endif
                                        @endif
                                    </a>
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="select-custom">
                            <select class="form-control" id="byBrand">
                                <option disabled="" selected="" hidden="">{{ $langg->lang2502 }}</option>
                                 @foreach($categories->where('is_featured','=',1) as $cat)
                                <option>
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
                                </option>
                                @endforeach


                            </select>
                        </div>
                    </form>
                    @if(!empty($fix_banners[0]))
                    <div class="home-banner mb-2"
                        style="background-image: url('assets/images/banners/{{$fix_banners[0]->photo}}')">
                        <div class="row row-sm">
                            <div class="col-7" style="display : flex;justify-content: flex-end;">
                                <div class="banner-content">
                                    <h3>{!!$fix_banners[0]->title!!}</h3>
                                    <p>{!!$fix_banners[0]->subtitle!!}</p>
                                    <a href="{{$fix_banners[0]->link}}" target="_blank">
                                        <button class="btn">{{ $langg->lang25 }}</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>



        <section class="featured-categories">
            <h2>{{ $langg->lang2503 }}</h2>

            <div class="row row-sm">
                @forelse($categoriesChunk as $key => $category)
                <div class="col-5 col-md-{{$bootstrapClasses[$key]}}">
                    <div class="product-category content-left-bottom hidden-count overlay-darker">
                        <a href="{{ route('front.category',['category' => $category->slug,  'lang' => $sign ]) }}">
                            <figure>
                                <img src="{{asset('assets/images/categories/'.$category->photo) }}">
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
                            </div>
                        </a>
                    </div>
                </div>
                @empty

                <div class="col-12 col-md-12">
                    <h1 class="text-center">no category founded yet !</h1>
                </div>
                @endforelse
            </div>
        </section>

        {{-- here --}}
        @if($ps->featured ==1)
        <section class="featured-products">
            <h2>{{ $langg->lang26}}</h2>
            <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'loop': false,
                        'dots': false,
                        'nav' : true,
                        'margin': 20,
                        'items': 2,
                        'autoplay' : false,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                @foreach($feature_products as $prod)
                <div class="product-default inner-icon inner-icon-inline  center-details">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
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
                                data-target="#addCartModal"><i class="icon-bag"></i></button>
                            @endif


                            @if(Auth::guard('web')->check())
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish"
                                title="{{ $langg->lang54 }}">
                                <span>{{ $langg->lang54 }}</span>
                            </a>
                            @endif
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-icon btn-quickview"
                                title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                @endif</a>
                        </h2>
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
        <section class="featured-products">
            <h2>{{ $langg->lang28}}</h2>
            <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'loop': false,
                        'dots': false,
                        'nav' : true,
                        'margin': 20,
                        'items': 2,
                        'autoplay' : false,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                @foreach($top_products as $prod)
                <div class="product-default inner-icon inner-icon-inline  center-details">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
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
                        <div class="btn-icon-group">



                            @if($prod->emptyStock())
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <a data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal" class="btn-icon btn-add-cart add-to-cart"
                                title="Add to Cart">
                                <span data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"
                                    title="{{ $langg->lang54 }}"><i class="icon-bag"></i></span>
                            </a>
                            @endif
                            @if(Auth::guard('web')->check())
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish"
                                title="{{ $langg->lang54 }}">
                                <span>{{ $langg->lang54 }}</span>
                            </a>
                            @endif
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-icon btn-quickview"
                                title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                @endif</a>
                        </h2>
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
        <section class="featured-products">
            <h2>{{ $langg->lang29}}</h2>
            <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'loop': false,
                        'dots': false,
                        'nav' : true,
                        'margin': 20,
                        'items': 2,
                        'autoplay' : false,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                @foreach($big_products as $prod)
                <div class="product-default inner-icon inner-icon-inline  center-details">
                    <figure>
                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"  @if(!$slang)
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
                                        </a>                        <div class="btn-icon-group">

                            @if($prod->emptyStock())
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <a data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal" class="btn-icon btn-add-cart add-to-cart"
                                title="Add to Cart">
                                <span data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"
                                    title="{{ $langg->lang54 }}"><i class="icon-bag"></i></span>
                            </a>
                            @endif
                            @if(Auth::guard('web')->check())
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish"
                                title="{{ $langg->lang54 }}">
                                <span>{{ $langg->lang54 }}</span>
                            </a>
                            @endif
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-icon btn-quickview"
                                title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                @endif</a>
                        </h2>
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
        @if($ps->best ==1)
        <section class="featured-products">
            <h2>{{ $langg->lang27}}</h2>
            <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'loop': false,
                        'dots': false,
                        'nav' : true,
                        'margin': 20,
                        'items': 2,
                        'autoplay' : false,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                @foreach($best_products as $prod)
                <div class="product-default inner-icon inner-icon-inline  center-details">
                    <figure>
                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
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
                        <div class="btn-icon-group">

                            @if($prod->emptyStock())
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <a data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal" class="btn-icon btn-add-cart add-to-cart"
                                title="Add to Cart">
                                <span data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"
                                    title="{{ $langg->lang54 }}"><i class="icon-bag"></i></span>
                            </a>
                            @endif
                            @if(Auth::guard('web')->check())
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish"
                                title="{{ $langg->lang54 }}">
                                <span>{{ $langg->lang54 }}</span>
                            </a>
                            @endif
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-icon btn-quickview"
                                title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                @endif</a>
                        </h2>
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
        <section class="featured-products">
            <h2>{{ $langg->lang33}}</h2>
            <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'loop': false,
                        'dots': false,
                        'nav' : true,
                        'margin': 20,
                        'items': 2,
                        'autoplay' : false,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                @foreach($sale_products as $prod)
                <div class="product-default inner-icon inner-icon-inline  center-details">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
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
                        <div class="btn-icon-group">

                            @if($prod->emptyStock())
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <a data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal" class="btn-icon btn-add-cart add-to-cart"
                                title="Add to Cart">
                                <span data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"
                                    title="{{ $langg->lang54 }}"><i class="icon-bag"></i></span>
                            </a>
                            @endif
                            @if(Auth::guard('web')->check())
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish"
                                title="{{ $langg->lang54 }}">
                                <span>{{ $langg->lang54 }}</span>
                            </a>
                            @endif
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-icon btn-quickview"
                                title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                @endif</a>
                        </h2>
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
        <section class="featured-products">
            <h2>{{ $langg->lang32}}</h2>
            <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'loop': false,
                        'dots': false,
                        'nav' : true,
                        'margin': 20,
                        'items': 2,
                        'autoplay' : false,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                @foreach($trending_products as $prod)
                <div class="product-default inner-icon inner-icon-inline  center-details">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
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
                        <div class="btn-icon-group">

                            @if($prod->emptyStock())
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <a data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal" class="btn-icon btn-add-cart add-to-cart"
                                title="Add to Cart">
                                <span data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"
                                    title="{{ $langg->lang54 }}"><i class="icon-bag"></i></span>
                            </a>
                            @endif
                            @if(Auth::guard('web')->check())
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish"
                                title="{{ $langg->lang54 }}">
                                <span>{{ $langg->lang54 }}</span>
                            </a>
                            @endif
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-icon btn-quickview"
                                title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                @endif</a>
                        </h2>
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
        <section class="featured-products">
            <h2>{{ $langg->lang30}}</h2>
            <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'loop': false,
                        'dots': false,
                        'nav' : true,
                        'margin': 20,
                        'items': 2,
                        'autoplay' : false,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                @foreach($hot_products as $prod)
                <div class="product-default inner-icon inner-icon-inline  center-details">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
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
                        <div class="btn-icon-group">

                            @if($prod->emptyStock())
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <a data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal" class="btn-icon btn-add-cart add-to-cart"
                                title="Add to Cart">
                                <span data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"
                                    title="{{ $langg->lang54 }}"><i class="icon-bag"></i></span>
                            </a>
                            @endif
                            @if(Auth::guard('web')->check())
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish"
                                title="{{ $langg->lang54 }}">
                                <span>{{ $langg->lang54 }}</span>
                            </a>
                            @endif
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-icon btn-quickview"
                                title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                @endif</a>
                        </h2>
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
        <section class="featured-products">
            <h2>{{ $langg->lang31}}</h2>
            <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'loop': false,
                        'dots': false,
                        'nav' : true,
                        'margin': 20,
                        'items': 2,
                        'autoplay' : false,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                @foreach($latest_products as $prod)
                <div class="product-default inner-icon inner-icon-inline  center-details">
                    <figure>
                        <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
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
                        <div class="btn-icon-group">

                            @if($prod->emptyStock())
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <a data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal" class="btn-icon btn-add-cart add-to-cart"
                                title="Add to Cart">
                                <span data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"
                                    title="{{ $langg->lang54 }}"><i class="icon-bag"></i></span>
                            </a>
                            @endif
                            @if(Auth::guard('web')->check())
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish"
                                title="{{ $langg->lang54 }}">
                                <span>{{ $langg->lang54 }}</span>
                            </a>
                            @endif
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-icon btn-quickview"
                                title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                @endif</a>
                        </h2>
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
        @if($ps->flash_deal ==1)
        <section class="featured-products">
            <h2>{{ $langg->lang244}}</h2>
            <div class="owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'loop': false,
                        'dots': false,
                        'nav' : true,
                        'margin': 20,
                        'items': 2,
                        'autoplay' : false,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">
                @foreach($discount_products as $prod)
                <div class="product-default inner-icon inner-icon-inline  center-details">
                    <figure>
                        <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                            <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
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
                        <div class="btn-icon-group">

                            @if($prod->emptyStock())
                            <button class="btn">
                                <a href="javascript:;" class="cart-out-of-stock">
                                    <i class="icofont-close-circled"></i>
                                    {{ $langg->lang78 }}</a>
                            </button>
                            @else
                            <a data-href="{{ route('product.cart.add',$prod->id) }}" data-toggle="modal"
                                data-target="#addCartModal" class="btn-icon btn-add-cart add-to-cart"
                                title="Add to Cart">
                                <span data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"
                                    title="{{ $langg->lang54 }}"><i class="icon-bag"></i></span>
                            </a>
                            @endif
                            @if(Auth::guard('web')->check())
                            <a href="javascript::" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                                data-toggle="tooltip" class="btn-icon btn-icon-wish paction add-wishlist add-to-wish"
                                title="{{ $langg->lang54 }}">
                                <span>{{ $langg->lang54 }}</span>
                            </a>
                            @endif
                            <a href="{{ route('product.quickz',$prod->id) }}" class="btn-icon btn-quickview"
                                title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">@if(!$slang)
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
                                @endif</a>
                        </h2>
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
        <section>
            <h2>{{ $langg->lang2504 }}</h2>

            <div class="banner-offers row row-sm">
                @if(!empty($fix_banners[0]))
                <div class="col-md-6">
                    <div class="home-banner">
                        <img src="assets/images/banners/{{$fix_banners[0]->photo}}">
                        <div class="banner-content">
                            <h3>{!!$fix_banners[0]->title!!}</h3>
                            <p>{!!$fix_banners[0]->subtitle!!}</p>
                            <button class="btn"><a href="{{$fix_banners[0]->link}}">{{ $langg->lang25 }}</a></button>
                        </div>
                    </div>
                </div>
                @endif
                @if(!empty($fix_banners[1]))
                <div class="col-md-6">
                    <div class="home-banner">
                        <img src="assets/images/banners/{{$fix_banners[1]->photo}}">
                        <div class="banner-content">
                            <h3>{!!$fix_banners[1]->title!!}</h3>
                            <p>{!!$fix_banners[1]->subtitle!!}</p>
                            <button class="btn"><a href="{{$fix_banners[1]->link}}">{{ $langg->lang25 }}</a></button>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if($gs->is_popup== 1)
            @if(isset($visited))
            <div class="home-banner banner-deals" style="background-image: url(assets/images/newsletter_popup_bg.jpg)">
                <div class="banner-content">
                    <h3>@if(!$slang)
                                       @if($lang->id == 2)
                                            {{$gs->popup_title_ar}}  
                                          @else 
                                           {{$gs->popup_title}}
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            {{$gs->popup_title_ar}} 
                                          @else
                                           {{$gs->popup_title}}
                                          @endif
                                   @endif</h3>
                    <p>@if(!$slang)
                                       @if($lang->id == 2)
                                            {{$gs->popup_text_ar}}  
                                          @else 
                                           {{$gs->popup_text}}
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            {{$gs->popup_text_ar}} 
                                          @else
                                           {{$gs->popup_text}}
                                          @endif
                                   @endif</p>
                    <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                        <div class="submit-wrapper">
                            <input type="email" class="form-control" id="newsletter-email" name="newsletter-email"
                                placeholder="{{ $langg->lang741 }}" required>
                            <button class="btn" type="submit">@if(!$slang)
                                @if($lang->id == 2)
                                ابدأ
                                @else
                                Sign Up
                                @endif
                                @else
                                @if($slang == 2)
                                ابدأ
                                @else
                                Sign Up
                                @endif
                                @endif</button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div>
            </div>
             @endif
            @endif 

        </section>

        <section class="partners-panel">
            <div class="partners-carousel owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{
                        'loop' : true,
                        'nav': true,
                        'dots': false,
                        'margin' : 40,
                        'autoHeight': true,
                        'autoplay': false,
                        'autoplayTimeout': 5000,
                        'responsive': {
                          '0': {
                            'items': 2,
                            'margin': 10
                          },
                          '655': {
                            'items': 3
                          },
                          '960' : {
                            'items' : 4
                          },
                          '1200': {
                            'items': 5
                          }
                        }
                    }">
                @if($ps->partners == 1)
                @foreach($partners as $j)
                <img src="{{asset('assets/images/partner/'.$j->photo)}}" alt="logo" style="width:160px;height:60px">
                @endforeach
                @endif
            </div>
        </section>
    </div>
</main><!-- End .main -->