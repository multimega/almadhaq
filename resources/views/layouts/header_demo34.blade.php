@php

    use App\Models\Compare;

    $slang = Session::get('language');

    $lang = DB::table('languages')->where('is_default', '=', 1)->first();

    $lang1 = App\Models\Language::find(1);

    $lang2 = App\Models\Language::find(2);

    $features = App\Models\Feature::all();
    $Pagesetting = App\Models\Pagesetting::find(1);
    $categorys = App\Models\Category::get();
    $oldCompare = Session::get('compare');
    $compare = new Compare($oldCompare);

    $products = $compare->items;

    $main = App\Models\Generalsetting::find(1);
    $chunk = App\Models\Service::get()->take(3);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if (isset($seo->title))



        <title>
            @if (!$slang)
                @if ($lang->id == 2)
                    {!! substr($seo->title_ar, 0, 50) . '-' !!}
                @else
                    {{ substr($seo->title, 0, 50) }}}}
                @endif
            @else
                @if ($slang == 2)
                    {!! substr($seo->title_ar, 0, 50) !!}
                @else
                    {{ substr($seo->title, 0, 11) }}
                @endif
            @endif
        </title>
    @endif



    @if (isset($seo->meta_keys))


        @if (!$slang)
            @if ($lang->id == 2)
                <meta name="keywords" content="{!! $seo->meta_keys_ar !!}">
            @else
                <meta name="keywords" content="{{ $seo->meta_keys }}">
            @endif
        @else
            @if ($slang == 2)
                <meta name="keywords" content="{!! $seo->meta_keys_ar !!}">
            @else
                <meta name="keywords" content="{{ $seo->meta_keys }}">
            @endif
        @endif


    @endif


    @if (isset($seo->meta_description))


        @if (!$slang)
            @if ($lang->id == 2)
                <meta name="description"
                    content="{{ $seo->meta_description_ar != null ? $seo->meta_description_ar : strip_tags($productt->description_ar) }}">
            @else
                <meta name="description"
                    content="{{ $seo->meta_description != null ? $seo->meta_description : strip_tags($seo->description) }}">
            @endif
        @else
            @if ($slang == 2)
                <meta name="description"
                    content="{{ $seo->meta_description_ar != null ? $seo->meta_description_ar : strip_tags($seo->meta_description_ar) }}">
            @else
                <meta name="description"
                    content="{{ $seo->meta_description != null ? $seo->meta_description : strip_tags($seo->description) }}">
            @endif
        @endif


    @endif


    @if (isset($seo->google_analytics))
        {!! $seo->google_analytics !!}
    @endif



    @if (isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">


        <title>
            @if (!$slang)
                @if ($lang->id == 2)
                    {{ $gs->title_ar }}
                @else
                    {{ $gs->title }}
                @endif
            @else
                @if ($slang == 2)
                    {{ $gs->title_ar }}
                @else
                    {{ $gs->title }}
                @endif
            @endif
        </title>
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
        <title>
            @if (!$slang)
                @if ($lang->id == 2)
                    {{ $gs->title_ar }}
                @else
                    {{ $gs->title }}
                @endif
            @else
                @if ($slang == 2)
                    {{ $gs->title_ar }}
                @else
                    {{ $gs->title }}
                @endif
            @endif
        </title>
    @elseif(isset($productt))

    @elseif(isset($productt))
        <meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag) : '' }}">
        <meta name="description"
            content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
        <meta property="og:title" content="{{ $productt->name }}" />
        <meta property="og:description"
            content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
        <meta property="og:image" content="{{ asset('assets/images/' . $productt->photo) }}" />
        <meta name="author" content="{{ $seo->meta_keys }}">
        <title>
            @if (!$slang)
                @if ($lang->id == 2)
                    {{ substr($productt->name_ar, 0, 20) . '-' }}{{ $gs->title_ar }}
                @else
                    {{ substr($productt->name, 0, 11) . '-' }}{{ $gs->title }}
                @endif
            @else
                @if ($slang == 2)
                    {{ substr($productt->name_ar, 0, 20) . '-' }}{{ $gs->title_ar }}
                @else
                    {{ substr($productt->name, 0, 11) . '-' }}{{ $gs->title }}
                @endif
            @endif
        </title>
    @else
        <meta name="author" content="{{ $seo->meta_keys }}">
        <title>
            @if (!$slang)
                @if ($lang->id == 2)
                    {{ $gs->title_ar }}
                @else
                    {{ $gs->title }}
                @endif
            @else
                @if ($slang == 2)
                    {{ $gs->title_ar }}
                @else
                    {{ $gs->title }}
                @endif
            @endif
        </title>
    @endif



    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/' . $gs->favicon) }}">

    <script type="text/javascript">
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700',
                    'Segoe Script:300,400,500,600,700'
                ]
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/front/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/toastr.css') }}">
    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/plugin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/animate.css') }}">
    <!-- jQuery Ui Css-->
    <link rel="stylesheet" href="{{ asset('assets/front/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/jquery-ui/jquery-ui.structure.min.css') }}">

    <!-- Main CSS File -->

    <!-- CSS FILES -->
    <link rel="stylesheet" href="{{ asset('assets/demo_34/assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/demo_34/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/demo_34/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/demo_34/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/demo_34/assets/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/demo_34/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/demo_34/assets/css/xzoom.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    @if ($langg->rtl == '1')
        <link rel="stylesheet" href="{{ asset('assets/demo_34/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/demo_34/assets/css/style-rtl.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/demo_34/assets/css/style.css') }}">
    @endif

</head>

<body>

    <!-- Start Top Navbar -->

    <!-- For Small Screen -->
    <nav class="navbar shown-mobile-nav navbar-expand-lg d-lg-none">
        <ul class="navbar-nav mr-auto w-100">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="ship-span">
                        @if (Session::has('currency'))

                            @if (!$slang)
                                @if ($lang->id == 2)
                                    {{ DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->name_ar }}
                                @else
                                    {{ DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->name }}
                                @endif
                            @else
                                @if ($slang == 2)
                                    {{ DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->name_ar }}
                                @else
                                    {{ DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->name }}
                                @endif
                            @endif
                        @else
                            @if (!$slang)
                                @if ($lang->id == 2)
                                    اختر العملة
                                @else
                                    Select Currency
                                @endif
                            @else
                                @if ($slang == 2)
                                    اختر العملة
                                @else
                                    Select Currency
                                @endif
                            @endif
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach (DB::table('currencies')->get() as $currency)
                        <a class="dropdown-item" href="{{ route('front.currency', $currency->id) }}"
                            {{ Session::has('currency') ? (Session::get('currency') == $currency->id ? 'selected' : '') : (DB::table('currencies')->where('is_default', '=', 1)->first()->id == $currency->id ? 'selected' : '') }}">
                            @if (!$slang)
                                @if ($lang->id == 2)
                                    {{ $currency->name_ar }}
                                @else
                                    {{ $currency->name }}
                                @endif
                            @else
                                @if ($slang == 2)
                                    {{ $currency->name_ar }}
                                @else
                                    {{ $currency->name }}
                                @endif
                            @endif
                        </a>
                    @endforeach
                </div>
            </li>

            @if ($gs->is_language == 1)
                <li class="nav-item dropdown">
                    <img src="{{ asset('assets/demo_34/assets/images/flags/egypt.svg') }}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!--<span class="d-inline-block mx-1">Ship to</span>-->
                        <span
                            class="">{{ DB::table('languages')->where('id', '=', Session::has('language') ? Session::get('language') : 1)->first()->language }}</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach (DB::table('currencies')->get() as $currency)
                            <a class="dropdown-item" href="{{ route('front.currency', $currency->id) }}"
                                {{ Session::has('currency') ? (Session::get('currency') == $currency->id ? 'selected' : '') : (DB::table('currencies')->where('is_default', '=', 1)->first()->id == $currency->id ? 'selected' : '') }}">
                                @if (!$slang)
                                    @if ($lang->id == 2)
                                        {{ $currency->name_ar }}
                                    @else
                                        {{ $currency->name }}
                                    @endif
                                @else
                                    @if ($slang == 2)
                                        {{ $currency->name_ar }}
                                    @else
                                        {{ $currency->name }}
                                    @endif
                                @endif
                            </a>
                        @endforeach
                    </div>
                </li>
            @endif
        </ul>
    </nav>

    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/' . $gs->logo) }}" alt="Vowalla Logo" class="w-100">
        </a>
        <ul class="navbar-nav mr-auto w-100">
            <form class="form-inline my-2 my-lg-0 flex-grow-1" id="searchForm"
                action="{{ route('front.category', ['category' => Request::route('category'), 'subcategory' => Request::route('subcategory'), 'childcategory' => Request::route('childcategory'), 'lang' => $sign]) }}"
                method="GET">
                @if (!empty(request()->input('sort')))
                    <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                @endif
                @if (!empty(request()->input('minprice')))
                    <input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
                @endif
                @if (!empty(request()->input('maxprice')))
                    <input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
                @endif
                <input class="form-control mr-sm-2 flex-grow-1" id="prod_name" type="search" name="search"
                    placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" aria-label="Search"
                    autocomplete="on">
            </form>
            <li class="nav-item dropdown d-none d-lg-flex">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="ship-span">
                        @if (Session::has('currency'))

                            @if (!$slang)
                                @if ($lang->id == 2)
                                    {{ DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->name_ar }}
                                @else
                                    {{ DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->name }}
                                @endif
                            @else
                                @if ($slang == 2)
                                    {{ DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->name_ar }}
                                @else
                                    {{ DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->name }}
                                @endif
                            @endif
                        @else
                            @if (!$slang)
                                @if ($lang->id == 2)
                                    اختر العملة
                                @else
                                    Select Currency
                                @endif
                            @else
                                @if ($slang == 2)
                                    اختر العملة
                                @else
                                    Select Currency
                                @endif
                            @endif
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach (DB::table('currencies')->get() as $currency)
                        <a class="dropdown-item" href="{{ route('front.currency', $currency->id) }}"
                            {{ Session::has('currency') ? (Session::get('currency') == $currency->id ? 'selected' : '') : (DB::table('currencies')->where('is_default', '=', 1)->first()->id == $currency->id ? 'selected' : '') }}">
                            @if (!$slang)
                                @if ($lang->id == 2)
                                    {{ $currency->name_ar }}
                                @else
                                    {{ $currency->name }}
                                @endif
                            @else
                                @if ($slang == 2)
                                    {{ $currency->name_ar }}
                                @else
                                    {{ $currency->name }}
                                @endif
                            @endif
                        </a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown d-none d-lg-flex">
                <img src="{{ asset('assets/demo_34/assets/images/flags/egypt.svg') }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span
                        class="ship-span">{{ DB::table('languages')->where('id', '=', Session::has('language') ? Session::get('language') : 1)->first()->language }}</span>
                    <!--<br>-->
                    <!--Egypt-->
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('front.language', $lang1) }}"><img
                            src="{{ asset('assets/demo_34/assets/images/flags/united_kingdom.png') }}"> ENGLISH</a>
                    <a class="dropdown-item" href="{{ route('front.language', $lang2) }}"><img
                            src="{{ asset('assets/demo_34/assets/images/flags/egypt.svg') }}"> عربى</a>
                </div>
            </li>
            <li class="nav-item">
                @if (!Auth::guard('web')->check())
                    <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModal"><i
                            class="far fa-user"></i> {{ $langg->lang12 }}</a>
                @else
                    <a class="nav-link" href="{{ route('user-dashboard-34') }}">{{ $langg->lang11 }}</a>
                @endif
            </li>
            @if (Auth::guard('web')->check())
                <li class="nav-item cart">
                    <a href="{{ route('user-wishlists-34') }}" class="nav-link">
                        <i class="far fa-heart"></i>
                        <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                    </a>
                </li>
            @endif
            <li class="nav-item cart">
                <a class="nav-link" href="{{ route('front.f-cart', $sign) }}"> <i class="fas fa-shopping-cart"></i>
                    <span
                        id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                </a>
            </li>

            @if (Auth::guard('web')->check())
                <a class="nav-link" href="{{ route('user-logout') }}"><i class="fas fa-sign-out-alt"></i></a>
            @endif
        </ul>
    </nav>
    <!-- End Top Navbar -->

    <!-- Start Bottom Nav -->
    <div class="bottom-nav">
        <div class="row m-0 w-100">
            <div class="w-30 p-0 left-sidebar">
                <div class="all-categories-side">
                    <a href="#">Menu</a><i class="fas fa-sort-down"></i>
                </div>
                <div class="menu show w-30">
                    <div class="side-category">
                        <span class="left-span-cat"><a
                                href="{{ route('front.index', $sign) }}">{{ $langg->lang17 }}</a></span>
                        @foreach (DB::table('pages')->where('header', '=', 1)->get() as $data)
                            <span class="left-span-cat"><a
                                    href="{{ route('front.page', ['slug' => $data->slug, 'lang' => $sign]) }}">
                                    @if (!$slang)
                                        @if ($lang->id == 2)
                                            {{ $data->title_ar }}
                                        @else
                                            {{ $data->title }}
                                        @endif
                                    @else
                                        @if ($slang == 2)
                                            {{ $data->title_ar }}
                                        @else
                                            {{ $data->title }}
                                        @endif
                                    @endif
                                </a></span>
                        @endforeach
                        <span class="left-span-cat"><a
                                href="{{ route('front.f-contact', $sign) }}">{{ $langg->lang20 }}</a></span>
                        @if ($gs->is_brand == 1)
                            <span class="left-span-cat"><a
                                    href="{{ route('front.f-brannds', $sign) }}">{{ $langg->lang806 }}</a></span>
                        @endif
                        <span class="left-span-cat"><a
                                href="{{ route('front.f-blog', $sign) }}">{{ $langg->lang18 }}</a></span>
                        @if ($gs->is_faq == 1)
                            <span class="left-span-cat"><a
                                    href="{{ route('front.f-faq', $sign) }}">{{ $langg->lang19 }}</a></span>
                        @endif

                        @if ($features[5]->status == 1 && $features[5]->active == 1)
                            @foreach (DB::table('offers')->where('header', '=', 1)->get() as $data)
                                <span class="left-span-cat">
                                    <a href="{{ route('front.f-offers', ['slug' => $data->slug, 'lang' => $sign]) }}">
                                        @if (!$slang)
                                            @if ($lang->id == 2)
                                                {{ $data->name_ar }}
                                            @else
                                                {{ $data->name }}
                                            @endif
                                        @else
                                            @if ($slang == 2)
                                                {{ $data->name_ar }}
                                            @else
                                                {{ $data->name }}
                                            @endif
                                        @endif
                                    </a>
                                </span>
                            @endforeach
                        @endif
                        <!--    <span class="left-span-cat" data-id="side-sub-pages">-->
                        <!--        <a href="#">{{ $langg->lang901 }}</a>-->
                        <!-- Start Sub Category -->
                        <!--        <div class="side-sub-category" id="side-sub-pages">-->
                        <!--            <h3>{{ $langg->lang901 }}</h3>-->
                        <!--            <hr class="mt-0">-->
                        <!--            <div class="sub-categories">-->
                        <!--                <div class="column">-->
                        <!--                    <ul class="list-unstyled">-->
                        <!--                        <li><a href="{{ route('front.blog', $sign) }}">{{ $langg->lang18 }}</a></li>-->
                        <!--                        @foreach (DB::table('pages')->where('header', '=', 1)->get() as $data)
-->
                        <!--                        <li>-->
                        <!--                            <a href="{{ route('front.page', ['slug' => $data->slug, 'lang' => $sign]) }}">-->
                        <!--               @if (!$slang)
-->
                        <!--                                  @if ($lang->id == 2)
-->
                        <!--                                 {{ $data->title_ar }}-->
                    <!--                                  @else-->
                        <!--                                 {{ $data->title }}-->
                        <!--
@endif -->
                        <!--
@else
-->
                        <!--                                  @if ($slang == 2)
-->
                        <!--                                 {{ $data->title_ar }}-->
                    <!--                                  @else-->
                        <!--                                  {{ $data->title }}-->
                        <!--
@endif-->
                        <!--
@endif-->
                        <!--                            </a>-->
                        <!--                        </li>-->
                        <!--
@endforeach-->
                        <!--                        <li><a href="{{ route('front.contact', $sign) }}">{{ $langg->lang20 }}</a></li>-->
                        <!--                        @if (!Auth::check())
-->
                        <!--                            <li><a href="{{ url('user/login') }}">{{ $langg->lang12 }}</a></li>-->
                    <!--                        @else-->
                        <!--   	<li><a href="{{ route('user-logout') }}">{{ $langg->lang223 }}</a></li>-->
                        <!--
@endif-->

                        <!--                        @if ($features[5]->status == 1 && $features[5]->active == 1)-->
                        <!--@foreach (DB::table('offers')->where('header', '=', 1)->get() as $data)
-->
                        <!--<li>-->
                        <!--    <a href="{{ route('front.offers', ['slug' => $data->slug, 'lang' => $sign]) }}">-->
                        <!--    @if (!$slang)
-->
                        <!--                              @if ($lang->id == 2)
-->
                        <!--                                {{ $data->name_ar }}-->
                        <!--
@else
-->
                        <!--                                {{ $data->name }}-->
                        <!--
@endif -->
                        <!--
@else
-->
                        <!--                              @if ($slang == 2)
-->
                        <!--                                {{ $data->name_ar }}-->
                    <!--                              @else-->
                        <!--                                {{ $data->name }}-->
                        <!--
@endif-->
                        <!--
@endif-->
                        <!--                            </a>-->
                        <!--                        </li>-->
                        <!--
@endforeach-->
                        <!--			@endif-->
                        <!--                    </ul>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </span>-->

                    </div>
                </div>
            </div>
            <!-- End Col-md-2 -->
            <div class="w-70">
                <ul class="bottom-nav mr-auto w-100">
                    @if (isset($categorys))
                        @foreach ($categorys->where('is_featured', '=', 1) as $data)
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('front.f-category', ['category' => $data->slug, 'lang' => $sign]) }}"
                                    data-id="{{ $data->slug }}">
                                    @if (!$slang)
                                        @if ($lang->id == 2)
                                            {{ $data->name_ar }}
                                        @else
                                            {{ $data->name }}
                                        @endif
                                    @else
                                        @if ($slang == 2)
                                            {{ $data->name_ar }}
                                        @else
                                            {{ $data->name }}
                                        @endif
                                    @endif
                                </a>
                                <!-- Start Mega Menu -->
                                <div class="mega-menu" id="{{ $data->slug }}">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h5>
                                                @if (!$slang)
                                                    @if ($lang->id == 2)
                                                        {{ $data->name_ar }}
                                                    @else
                                                        {{ $data->name }}
                                                    @endif
                                                @else
                                                    @if ($slang == 2)
                                                        {{ $data->name_ar }}
                                                    @else
                                                        {{ $data->name }}
                                                    @endif
                                                @endif
                                            </h5>
                                            @if (count($data->subs) > 0)
                                                <ul class="list-unstyled">
                                                    @foreach ($data->subs as $subcat)
                                                        <li>
                                                            <a
                                                                href="{{ route('front.f-subcat', ['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug, 'lang' => $sign]) }}">
                                                                @if (!$slang)
                                                                    @if ($lang->id == 2)
                                                                        {{ $subcat->name_ar }}
                                                                    @else
                                                                        {{ $subcat->name }}
                                                                    @endif
                                                                @else
                                                                    @if ($slang == 2)
                                                                        {{ $subcat->name_ar }}
                                                                    @else
                                                                        {{ $subcat->name }}
                                                                    @endif
                                                                @endif
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                        <div class="col-md-4 brands">
                                            <h5>Top Brands</h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/drop-brand-03.png') }}">
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/drop-brand-04.png') }}">
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/drop-brand-05.png') }}">
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/drop-brand-09.png') }}">
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/drop-brand-03.png') }}">
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/drop-brand-04.png') }}">
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/drop-brand-05.png') }}">
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/drop-brand-09.png') }}">
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/drop-brand-09.png') }}">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row cat-ex">
                                                <div class="col-md-7 px-1">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/en_drop-01.png') }}">
                                                    </a>
                                                </div>
                                                <div class="col-md-5 px-1">
                                                    <a href="#">
                                                        <img
                                                            src="{{ asset('assets/demo_34/assets/images/navigation/en_drop-02.png') }}">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Mega Menu -->
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- End Bottom Nav -->
    <!-- Sign in Modal -->
    <!-- Modal -->
    <div class="modal fade login-modal" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body login-form signin-form">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Welcome Back!</h5>
                    <h3 class="text-center">Sign in to your account</h3>
                    <span class="d-block text-center mb-3">Don't have an account? <a href=""
                            class="go-to-signup-login">Sign Up</a></span>
                    @include('includes.admin.form-login')
                    <form class="mloginform" action="{{ route('user.login.submit-34') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group mx-4">
                            <label for="phone-login">{{ $langg->lang184 }}</label>
                            <input type="tel" name="phone" class="form-control" id="phone-login"
                                aria-describedby="phoneHelp" required>
                        </div>
                        <div class="form-group mx-4">
                            <label for="password-login">{{ $langg->lang174 }}</label>
                            <input type="password" name="password" class="form-control pass_id" id="password-login">
                            <span class="pass-icon"><i class="fas fa-eye toggle-password"></i></span>
                        </div>
                        <div class="form-group mx-4">
                            <input type="checkbox" name="remember" id="mrp"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="mrp">{{ $langg->lang175 }}</label>
                        </div>
                        <a href="{{ route('user-forgot') }}" class="d-block text-center">{{ $langg->lang176 }}</a>
                        <button type="submit" class="btn btn-primary">{{ $langg->lang178 }}</button>
                    </form>
                </div>
                <!-- Sign up -->
                <div class="modal-body signup-modal login-form signin-form">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Create an account</h5>
                    <span class="d-block text-center mb-3">Already have an account? <a href=""
                            class="go-to-signup-login">Sign in</a></span>
                    @include('includes.admin.form-login')
                    <form class="mregisterform" action="{{ route('user-register-submit') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group mx-4">
                            <label for="name">{{ $langg->lang182 }}</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group mx-4">
                            <label for="phone">{{ $langg->lang184 }}</label>
                            <input type="text" name="phone" class="form-control" id="phone" required>
                        </div>

                        <div class="form-group mx-4">
                            <label for="Password10">{{ $langg->lang186 }}</label>
                            <input type="password" name="password" class="form-control pass_id" id="Password10"
                                required>
                            <span class="pass-icon"><i class="fas fa-eye toggle-password"></i></span>
                        </div>
                        <div class="form-group mx-4">
                            <label for="Password10">{{ $langg->lang187 }}</label>
                            <input type="password" name="password_confirmation" class="form-control pass_id"
                                id="Password10" required>
                            <span class="pass-icon"><i class="fas fa-eye toggle-password"></i></span>
                        </div>

                        @if ($features[3]->status == 1 && $features[3]->active == 1)
                            <div class="form-group mx-4">
                                <label for="refelar_code">{{ $langg->lang830 }}</label>
                                <input type="text" name="refelar_code" class="form-control" id="refelar_code">
                                <i class="icofont-code"></i>
                            </div>
                        @endif
                        @if ($gs->is_capcha == 1)
                            <ul class="captcha-area">
                                <li>
                                    <p><img class="codeimg1" src="{{ asset('assets/images/capcha_code.png') }}"
                                            alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i></p>
                                </li>
                            </ul>
                            <div class="form-group mx-4">
                                <label for="code">{{ $langg->lang51 }}</label>
                                <input type="text" name="codes" class="form-control Password" id="code">
                                <i class="icofont-code"></i>
                            </div>
                        @endif
                        <input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
                        <button type="submit" class="btn btn-primary">{{ $langg->lang189 }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
