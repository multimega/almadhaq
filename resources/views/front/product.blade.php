@extends('layouts.front')
<link rel="icon" type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
@php

    $slang = Session::get('language');
    $lang = DB::table('languages')->where('is_default','=',1)->first();
    $ps = App\Models\Pagesetting::find(1);
    $tool = DB::table('seotools')->find(1);
    $pro_id= App\Models\OfferProduct::get()->pluck('product_id');
    $prods = App\Models\Product::whereIn('id',$pro_id)->get();

    if (Session::has('currency')) {

    $curr = App\Models\Currency::find(Session::get('currency'));

    }else {

    $curr = App\Models\Currency::where('is_default','=',1)->first();
    }
@endphp


@section('prod_seo')
    @if(isset($tool->product_analytics ))

        {!! $tool->product_analytics !!}


    @endif

@stop

@section('gsearch')
    <script type="application/ld+json">
  {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
           {
        "@type": "ListItem",
        "position": 1,
        "item":{
                    "@type": "Website",
                    "@id": "{{url('/en')}}",
                    "name": "translation missing: en.general.breadcrumbs.home"
                }
      } ,{
        "@type": "ListItem",
        "position": 2,
     //   "name": " {{$productt->category->name}}",
        "item": {
                    "@type": "CollectionPage",
                    "@id": "{{route('front.category',['category' => $productt->category->slug,'lang' => $sign])}}",
                    "name": "{{$productt->category->name}}"
                }
      } @if(!empty($productt->subcategory)) ,{
        "@type": "ListItem",
        "position": 3,
      //  "name": "{{$productt->subcategory->name}}",
        "item": {
                    "@type": "CollectionPage",
                    "@id": "{{ route('front.subcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug,'lang'=>$sign]) }}",
                    "name": "{{$productt->subcategory->name}}"
                }

      }@endif @if(!empty($productt->childcategory)) ,{
        "@type": "ListItem",
        "position": 4,
      //  "name": "  {{$productt->childcategory->name}}",
         "item": {
                    "@type": "CollectionPage",
                    "@id": "{{ route('front.childcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug, 'slug3' => $productt->childcategory->slug,'lang' => $sign]) }}",
                    "name": "{{$productt->childcategory->name}}"
                }
      }@endif,{
        "@type": "ListItem",
        "position": @if(!empty($productt->subcategory) && !empty($productt->childcategory))
            5  @elseif(!empty($productt->subcategory) && empty($productt->childcategory)) 4 @else 3 @endif,
        "item": {
                    "@type": "WebPage",
                    "@id": "{{route('front.product',['slug' => $productt->slug , 'lang' => $sign])}}",
                    "name": "{{ $productt->name }}"
                }
      }]
    }

    </script>

    <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "{{$gs->title}}",
    "url": "{{url('/')}}",
    "potentialAction": {
      "@type": "SearchAction",
      "query-input": "required name=search",
      "target": "{{url('/category/?search={search}')}}"
    }
  }

    </script>
    <script type="application/ld+json">
  {
  "@context": "http://schema.org",
  "@type": "Product",
  @if(!empty($productt->brand->name))
            "brand": {"@type": "Brand","name": "{{$productt->brand->name}}"},
  @endif
        // "sku": "{{ $productt->sku }}",
  //"mpn": "",


  "description": "{{ $productt->details }}",
  "name": "{{ $productt->name }}",
  "url": "{{url('item',$productt->slug)}}",
  "image": "{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}",
  @if($productt->product_condition == 2 || $productt->product_condition == null)
            "itemCondition": "https://schema.org/NewCondition"  ,@endif
        "offers": {
          "@type": "Offer",
          "availability": @if($productt->emptyStock()) "https://schema.org/OutOfStock"   @else
            "http://schema.org/InStock" @endif,
    "url": "{{url('item',$productt->slug)}}",
    "price": "{{ $productt->price * $curr->value}}",
    "priceCurrency": "{{$curr->sign}}"
  },

  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "{{ App\Models\Rating::ratings($productt->id)/20 }}",
    "reviewCount": "{{ count($productt->ratings) }}"
  }
   @if(count($productt->ratings) > 0)

            ,"review": [
@foreach($productt->ratings as $key=>$review)
                {
                  "@type": "Review",
@if(!empty($review->user->name))
                    "author": "{{ $review->user->name }}",
      @endif
                "datePublished": "{{$review->created_at}}",
      "description": "{{$review->review}}",
       @if(!empty($review->user->name))
                    "name": "{{ $review->user->name }}",
       @endif
                "reviewRating": {
                  "@type": "Rating",
                  "bestRating": "5",
                  "ratingValue": "{{ $review->rating }}",
        "worstRating": "1"
      }
    }@if(count($productt->ratings)-1 != $key)  , @endif
            @endforeach



            ],
             "author": {
                    "@type": "Person",
                    "name": "Abdelazem"
                  }

@endif
        }

    </script>
    <script type="application/ld+json">
  {
  "@context":"https://schema.org",
  "@type":"Product",
  "productID":"{{$productt->id}}",
  	@if(!$slang)
            @if($lang->id == 2)
                "name": "{{$productt->name_ar}}",
              @else
                "name": "{{$productt->name}}",
              @endif
        @else
            @if($slang == 2)
                "name": "{{$productt->name_ar}}",
              @else
                "name": "{{$productt->name}}",
              @endif
        @endif

        @if(!$slang)
            @if($lang->id == 2)
                "description":"{{ $productt->details_ar }}",
              @else
                "description":"{{ $productt->details }}",
              @endif
        @else
            @if($slang == 2)
                "description":"{{ $productt->details_ar }}",
              @else
                "description":"{{ $productt->details }}",
              @endif
        @endif


        @if(!$slang)
            @if($lang->id == 2)
                "url":"{{url('item',$productt->slug_ar)}}",
              @else
                "url":"{{url('item',$productt->slug)}}",
              @endif
        @else
            @if($slang == 2)
                "url":"{{url('item',$productt->slug_ar)}}",
              @else
                "url":"{{url('item',$productt->slug)}}",
              @endif
        @endif


        "image":"{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}",

  @if(!empty($productt->brand->name))
            "brand":"{{$productt->brand->name}}",
  @endif


        @php
            if (!empty($prods)) {

                 foreach ($prods as $key => $prod) {


               if($prod->id == $productt->id) {

        @endphp
        "offers": [
          {
            "@type": "Offer",
            "price": "{{$prod->price}}",

      	@if(!$slang)
            @if($lang->id == 2)

                "priceCurrency": "{{$curr->name_ar}}",
              @else
                "priceCurrency": "{{$curr->name}}",
              @endif
        @else
            @if($slang == 2)
                "priceCurrency": "{{$curr->name_ar}}",
              @else
                "priceCurrency": "{{$curr->name}}",
              @endif
        @endif


        "itemCondition": "{{$productt->product_condition}}",
       @if($productt->stock>0)
            "availability": "InStock",
@else
            "availability": "Not Available",
@endif
        }
      ],

@php
            }else {
                continue;
            }
        }
     }
        @endphp
        }

    </script>

@stop
@section('content')

    <style>
        button:disabled {
            cursor: no-drop;
        }
    </style>

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="pages">

                        <li><a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a></li>
                        <li>
                            @if(!$slang)
                                @if($lang->id == 2)
                                    <a href="{{route('front.category',['category' => $productt->category->slug_ar ,'lang' => $sign])}}">
                                        {{$productt->category->name_ar}}
                                        @else
                                            <a href="{{route('front.category',['category' => $productt->category->slug,'lang' => $sign])}}">
                                                {{$productt->category->name}}
                                                @endif
                                                @else
                                                    @if($slang == 2)
                                                        <a href="{{route('front.category',['category' => $productt->category->slug_ar ,'lang' => $sign])}}">
                                                            {{$productt->category->name_ar}}
                                                            @else
                                                                <a href="{{route('front.category',['category' => $productt->category->slug ,'lang' => $sign])}}">
                                                                    {{$productt->category->name}}
                                                                    @endif
                                                                    @endif
                                                                </a>
                        </li>
                        @if(!empty($productt->subcategory))
                            <li>
                                @if(!$slang)
                                    @if($lang->id == 2)
                                        <a
                                                href="{{ route('front.subcat',['slug1' => $productt->category->slug_ar, 'slug2' => $productt->subcategory->slug_ar ,'lang' => $sign]) }}">
                                            {{$productt->subcategory->name_ar}}
                                            @else
                                                <a
                                                        href="{{ route('front.subcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug ,'lang' => $sign]) }}">
                                                    {{$productt->subcategory->name}}
                                                    @endif
                                                    @else
                                                        @if($slang == 2)
                                                            <a
                                                                    href="{{ route('front.subcat',['slug1' => $productt->category->slug_ar, 'slug2' => $productt->subcategory->slug_ar ,'lang' => $sign]) }}">
                                                                {{$productt->subcategory->name_ar}}
                                                                @else
                                                                    <a
                                                                            href="{{ route('front.subcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug ,'lang' => $sign]) }}">
                                                                        {{$productt->subcategory->name}}
                                                                        @endif
                                                                        @endif
                                                                    </a>
                            </li>
                        @endif
                        @if(!empty($productt->childcategory))
                            <li>
                                @if(!$slang)
                                    @if($lang->id == 2)
                                        <a
                                                href="{{ route('front.childcat',['slug1' => $productt->category->slug_ar, 'slug2' => $productt->subcategory->slug_ar, 'slug3' => $productt->childcategory->slug_ar,'lang' => $sign]) }}">
                                            {{$productt->childcategory->name_ar}}
                                            @else
                                                <a
                                                        href="{{ route('front.childcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug, 'slug3' => $productt->childcategory->slug,'lang' => $sign]) }}">
                                                    {{$productt->childcategory->name}}
                                                    @endif
                                                    @else
                                                        @if($slang == 2)
                                                            <a
                                                                    href="{{ route('front.childcat',['slug1' => $productt->category->slug_ar, 'slug2' => $productt->subcategory->slug_ar, 'slug3' => $productt->childcategory->slug_ar,'lang' => $sign]) }}">
                                                                {{$productt->childcategory->name_ar}}
                                                                @else
                                                                    <a
                                                                            href="{{ route('front.childcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug, 'slug3' => $productt->childcategory->slug,'lang' => $sign]) }}">
                                                                        {{$productt->childcategory->name}}
                                                                        @endif
                                                                        @endif


                                                                    </a>
                            </li>
                        @endif
                        <li>
                            @if(!$slang)
                                @if($lang->id == 2)
                                    <a href="{{ route('front.product', ['slug' => $productt->slug_ar , 'lang' => $sign ]) }}">
                                        {{ $productt->name_ar }}
                                        @else
                                            <a href="{{ route('front.product', ['slug' => $productt->slug , 'lang' => $sign ]) }}">
                                                {{ $productt->name }}
                                                @endif
                                                @else
                                                    @if($slang == 2)
                                                        <a href="{{ route('front.product',['slug' => $productt->slug_ar , 'lang' => $sign ]) }}">
                                                            {{ $productt->name_ar }}
                                                            @else
                                                                <a href="{{ route('front.product',['slug' => $productt->slug , 'lang' => $sign ]) }}">
                                                                    {{ $productt->name }}
                                                                    @endif
                                                                    @endif

                                                                </a>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Area Start -->
    <section class="product-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">

                        <div class="col-lg-5 col-md-12">

                            <div class="xzoom-container">
                                <a class="lightbox-color-img"
                                   href="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"
                                   data-lightbox="lightbox">
                                    <img class="xzoom5" id="xzoom-magnific"
                                         src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"
                                         xoriginal="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"
                                         @if(!$slang) @if($lang->id == 2)

                                         alt="{{$productt->alt_ar}}"
                                         @else
                                         alt="{{$productt->alt}}"
                                         @endif
                                         @else
                                         @if($slang == 2)
                                         alt="{{$productt->alt_ar}}"
                                         @else
                                         alt="{{$productt->alt}}"
                                            @endif
                                            @endif
                                    />
                                </a>
                                <div class="xzoom-thumbs">

                                    <div class="all-slider">

                                        <a href="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"
                                           data-lightbox="lightbox">
                                        <!--<a href="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}">-->
                                            <img class="xzoom-gallery5" width="80"
                                                 src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"
                                                 title="The description goes here" @if(!$slang) @if($lang->id == 2)

                                                 alt="{{$productt->alt_ar}}"
                                                 @else
                                                 alt="{{$productt->alt}}"
                                                 @endif
                                                 @else
                                                 @if($slang == 2)
                                                 alt="{{$productt->alt_ar}}"
                                                 @else
                                                 alt="{{$productt->alt}}"
                                                    @endif
                                                    @endif

                                            >
                                        </a>

                                        @foreach($productt->galleries as $gal)


                                            <a href="{{filter_var($gal->photo, FILTER_VALIDATE_URL) ? $gal->photo : asset('assets/images/galleries/'.$gal->photo)}}"
                                               data-lightbox="lightbox">
                                            <!--<a href="{{asset('assets/images/galleries/'.$gal->photo)}}">-->
                                                <img class="xzoom-gallery5" width="80"
                                                     src="{{filter_var($gal->photo, FILTER_VALIDATE_URL) ? $gal->photo :asset('assets/images/galleries/'.$gal->photo)}}"
                                                     title="The description goes here">
                                            </a>

                                        @endforeach

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-lg-7">
                            <div class="right-area">
                                <div class="product-info">
                                    <h4 class="product-name">
                                        @if(!$slang)
                                            @if($lang->id == 2)
                                                {{ $productt->name_ar }}
                                            @else
                                                {{ $productt->name }}
                                            @endif
                                        @else
                                            @if($slang == 2)
                                                {{ $productt->name_ar }}
                                            @else
                                                {{ $productt->name }}
                                            @endif
                                        @endif
                                    </h4>
                                    <div class="info-meta-1">
                                        <ul>
                                            {{--
                                            @if($productt->type == 'Physical')
                                            @if($productt->emptyStock())
                                            <li class="product-outstook">
                                              <p>
                                                <i class="icofont-close-circled"></i>
                                                {{ $langg->lang78 }}
                                              </p>
                                            </li>
                                            @else
                                            <li class="product-isstook">
                                              <p>
                                                <i class="icofont-check-circled"></i>
                                                {{ $gs->show_stock == 0 ? '' : $productt->stock }} {{ $langg->lang79 }}
                                              </p>
                                            </li>
                                            @endif
                                            @endif
                                            --}}
                                            {{--
                                            <li>
                                              <div class="ratings">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars" style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>
                                              </div>
                                            </li>
                                            <li class="review-count">
                                              <p>{{count($productt->ratings)}} {{ $langg->lang80 }}</p>
                                            </li>
                                            --}}
                                            @if($productt->product_condition != 0)
                                                <li>
                                                    <div class="{{ $productt->product_condition == 2 ? 'mybadge' : 'mybadge1' }}">
                                                        {{ $productt->product_condition == 2 ? 'New' : 'Used' }}
                                                    </div>
                                                </li>
                                            @endif
                                            @if($productt->free_ship == 1)
                                                <li>
                                                    <div class="mybadge" style="background:#c19514">
                                                        Free Shipping
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>


                                    <div class="product-price">
                                        {{--<p class="title">{{ $langg->lang87 }} :</p>--}}
                                        <p class="price">


                                            @if(!$slang)
                                                @if($lang->id == 2)
                                                    <span id="sizeprice_ar">{{ $productt->showPrice_ar() }}</span>
                                                @else
                                                    <span id="sizeprice">{{ $productt->showPrice() }}</span>
                                                @endif
                                            @else
                                                @if($slang == 2)
                                                    <span id="sizeprice_ar">{{ $productt->showPrice_ar() }}</span>
                                                @else
                                                    <span id="sizeprice">{{ $productt->showPrice() }}</span>
                                                @endif
                                            @endif

                                            <small>
                                                <del>@if(!$slang)
                                                        @if($lang->id == 2)
                                                            {{ $productt->showPreviousPrice_ar() }}
                                                        @else
                                                            {{ $productt->showPreviousPrice() }}
                                                        @endif
                                                    @else
                                                        @if($slang == 2)
                                                            {{ $productt->showPreviousPrice_ar() }}
                                                        @else
                                                            {{ $productt->showPreviousPrice() }}
                                                        @endif
                                                    @endif</del>
                                            </small>
                                        </p>
                                    <!--  @if($productt->youtube != null)-->
                                    <!--  <a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe">-->
                                        <!--    <i class="fas fa-play"></i>-->
                                        <!--  </a>-->
                                        <!--@endif-->
                                    </div>

                                    <div class="info-meta-2">
                                        <ul>

                                            @if($productt->type == 'License')

                                                @if($productt->platform != null)
                                                    <li>
                                                        <p>{{ $langg->lang82 }}: <b>{{ $productt->platform }}</b></p>
                                                    </li>
                                                @endif

                                                @if($productt->region != null)
                                                    <li>
                                                        <p>{{ $langg->lang83 }}: <b>{{ $productt->region }}</b></p>
                                                    </li>
                                                @endif

                                                @if($productt->licence_type != null)
                                                    <li>
                                                        <p>{{ $langg->lang84 }}: <b>{{ $productt->licence_type }}</b>
                                                        </p>
                                                    </li>
                                                @endif

                                            @endif

                                        </ul>

                                    </div>

                                    @php
                                        $colors = App\Models\Color::where('product_id',$productt->id)->where('size_qty','>', 0)->first();

                                        $sizes = App\Models\Color::where('product_id',$productt->id)->where('size_qty','>',
                                        0)->distinct('size')->get();
                                        $collection = collect($sizes);
                                        $unique_data = $collection->unique('size')->values()->all();
                                    @endphp
                                    @if(!empty($productt->size))
                                        <div class="product-size">
                                            <p class="title">{{ $langg->lang88 }} :</p>
                                            <ul class="siz-list siz-lists">
                                                @php
                                                    $co =
                                                    App\Models\Color::where('product_id',$productt->id)->where('size',$productt->size[0])->where('size_qty','>',
                                                    0)->get();
                                                    $is_first = true;
                                                @endphp
                                                @foreach($productt->size as $key => $data1)

                                                    <li class="{{ $is_first ? 'active' : '' }} sizes si"
                                                        id="{{$data1}}">
                                                          <span class="box boxs">{{ $data1 }}
                                                            <input type="hidden" class="size" value="{{ $data1 }}">
                                                            <input type="hidden" class="pro_id" value="{{$productt->id}}">
                                                            @if(!empty($productt->size_qty))
                                                                  @if($productt->size_qty[$key] > 0)
                                                                      <input type="hidden" class="size_qty" value="{{ $productt->size_qty[$key] }}">
                                                                      <input type="hidden" class="size_key" value="{{$key}}">
                                                                  @endif
                                                              @endif
                                                              @if(!empty($productt->size_price))
                                                                  <input type="hidden" class="size_price"
                                                                         value="{{ round($productt->size_price[$key] * $curr->value,2) }}">
                                                              @endif
                                                          </span>
                                                    </li>

                                                    @php
                                                        $is_first = false;
                                                    @endphp
                                                @endforeach
                                                <li>
                                            </ul>
                                        </div>
                                    @endif


                                    @if(!empty($productt->color))

                                        <div class="product-color">
                                            <p class="title">{{ $langg->lang89 }} :</p>
                                            <ul class="color-list color-list-box">
                                                @php
                                                    $is_first = true;
                                                @endphp
                                                @foreach($productt->color as $key => $data1)
                                                    <li class="{{ $is_first ? 'active' : '' }}">
                      <span class="box boxs" data-color="{{ $productt->color[$key] }}"
                            style="background-color: {{ $productt->color[$key] }}"></span>
                                                    </li>
                                                    @php
                                                        $is_first = false;
                                                    @endphp
                                                @endforeach

                                            </ul>
                                        </div>



                                    @elseif(!empty($colors))

                                        <div class="product-size">
                                            <p class="title">{{ $langg->lang88 }} :</p>
                                            <ul class="siz-list siz-list2">
                                                @php
                                                    $co =
                                                    App\Models\Color::where('product_id',$productt->id)->where('size',$colors->size)->where('size_qty','>',
                                                    0)->get();
                                                    $is_first = true;
                                                @endphp
                                                @foreach($unique_data as $key => $data1)
                                                    @if($data1->size_qty > 0)

                                                        <li class="{{ $is_first ? 'active' : '' }} sizes si"
                                                            id="{{$data1->size}}">
                      <span class="box boxz">{{ $data1->size }}
                        <input type="hidden" class="size" value="{{ $data1->size }}">
                        <input type="hidden" class="size_qty" value="{{ $data1->size_qty}}">
                        <input type="hidden" class="size_key" value="{{$key}}">
                        <input type="hidden" class="pro_id" value="{{$productt->id}}">
                        <input type="hidden" class="size_price"
                               value="{{ round($data1->size_price * $curr->value,2) }}">

                      </span>
                                                        </li>
                                                    @endif
                                                    @php
                                                        $is_first = false;
                                                    @endphp
                                                @endforeach
                                                <li>
                                            </ul>
                                        </div>





                                        <div class="product-color">
                                            <p class="title">{{ $langg->lang89 }} :</p>
                                            @php

                                                $is_first = true;

                                            @endphp

                                            <ul class="color-list color-list2  show">
                                                @foreach($co as $key => $data1)
                                                    @if($data1->size_qty > 0)
                                                        <li class=" click  {{ $is_first ? 'active' : '' }}">
                      <span class="box boxz" data-color="{{ $data1->colors }}"
                            style="background-color: {{ $data1->colors }}">

                        <input type="hidden" class="color_qty" value="{{ $data1->size_qty }}">
                        <input type="hidden" class="color_price" value="{{ $data1->size_price * $curr->value }}">
                        @if (isset($data1->image))
                              <input type="hidden" class="color_img"
                                     value='{{ asset("assets/images/product-colors\/") . $data1->image }}'>
                          @else
                              <input type="hidden" class="color_img"
                                     value='{{ asset('assets/images/products/' . $productt->photo) }}'>
                          @endif
                      </span>
                                                        </li>
                                                    @endif
                                                    @php
                                                        $is_first = false;
                                                    @endphp
                                                @endforeach

                                            </ul>

                                            <ul class="color-listss color-lists">


                                            </ul>
                                        </div>

                                    @endif

                                    @if(!empty($productt->size_qty))

                                        <input type="hidden" id="stock" value="{{ $productt->size_qty[0] }}">
                                    @else
                                        @php
                                            $stck = (string)$productt->stock;
                                        @endphp
                                        @if($stck != null)
                                            <input type="hidden" id="stock" value="{{ $stck }}">
                                        @elseif($productt->type != 'Physical')
                                            <input type="hidden" id="stock" value="0">
                                        @else
                                            <input type="hidden" id="stock" value="">
                                        @endif

                                    @endif
                                    <input type="hidden" id="product_price"
                                           value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                                    <input type="hidden" id="product_id" value="{{ $productt->id }}">
                                    <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
                                    <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">
                                    <input type="hidden" id="curr_sign_ar" value="{{ $curr->name_ar }}">
                                    <div class="info-meta-3">
                                        <ul class="meta-list">
                                            @if($productt->product_type != "affiliate")
                                                <li class="d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}">
                                                    <div class="qty">
                                                        <ul>
                                                            <li>
                                                                <span class="qtminus">
                                                                  <i class="icofont-minus"></i>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="qttotal">1</span>
                                                            </li>
                                                            <li>
                                                                <span class="qtplus">
                                                                  <i class="icofont-plus"></i>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
                                        <ul class="meta-list meta-list-btn">
                                            @if (!empty($productt->attributes))
                                                @php
                                                    $attrArr = json_decode($productt->attributes, true);
                                                @endphp
                                            @endif
                                            @if (!empty($attrArr))
                                                <div class="product-attributes my-4">
                                                    <div class="row">
                                                        @foreach ($attrArr as $attrKey => $attrVal)
                                                            @if (array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1)

                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-2">
                                                                    @php
                                                                        $atrr = App\Models\Attribute::where('input_name',$attrKey)->first();
                                                                    @endphp

                                                                    <!--{{ str_replace("_", " ", $attrKey) }}-->
                                                                        <strong for="" class="text-capitalize">
                                                                            @if($atrr)
                                                                                @if(!$slang)
                                                                                    @if($lang->id == 2)
                                                                                        {{$atrr->name_ar}}
                                                                                    @else
                                                                                        {{$atrr->name}}
                                                                                    @endif
                                                                                @else
                                                                                    @if($slang == 2)
                                                                                        {{$atrr->name_ar}}
                                                                                    @else
                                                                                        {{$atrr->name}}
                                                                                    @endif
                                                                                @endif
                                                                            @else

                                                                                {{ str_replace("_", " ", $attrKey) }}
                                                                            @endif

                                                                            :</strong>
                                                                        <div class="">
                                                                            @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                                                                @php
                                                                                    $atrroption = App\Models\AttributeOption::where('name',$optionVal)->first();
                                                                                @endphp
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="hidden" class="keys"
                                                                                           value="">
                                                                                    <input type="hidden" class="values"
                                                                                           value="">
                                                                                    <input type="radio"
                                                                                           id="{{$attrKey}}{{ $optionKey }}"
                                                                                           name="{{ $attrKey }}"
                                                                                           class="custom-control-input product-attr product-attr1 product-attr2"
                                                                                           data-key="{{ $attrKey }}"
                                                                                           data-price="{{ $attrVal['prices'][$optionKey] * $curr->value }}"
                                                                                           value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                                                                                    <label class="custom-control-label"
                                                                                           for="{{$attrKey}}{{ $optionKey }}">
                                                                                    <!--{{ $optionVal }}-->
                                                                                        @if($atrroption)
                                                                                            @if(!$slang)
                                                                                                @if($lang->id == 2)
                                                                                                    {{$atrroption->name_ar}}
                                                                                                @else
                                                                                                    {{$atrroption->name}}
                                                                                                @endif
                                                                                            @else
                                                                                                @if($slang == 2)
                                                                                                    {{$atrroption->name_ar}}
                                                                                                @else
                                                                                                    {{$atrroption->name}}
                                                                                                @endif
                                                                                            @endif
                                                                                        @else

                                                                                            {{ $optionVal }}
                                                                                        @endif

                                                                                        @if (!empty($attrVal['prices'][$optionKey]))
                                                                                            +
                                                                                            {{$curr->sign}} {{$attrVal['prices'][$optionKey] * $curr->value}}
                                                                                        @endif
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            @if($productt->product_type == "affiliate")

                                                <li class="addtocart">
                                                    <a href="{{ route('affiliate.product', ['slug' => $productt->slug , 'lang' => $sign ]) }}"
                                                       target="_blank"><i
                                                                class="icofont-cart"></i> {{ $langg->lang251 }}</a>
                                                </li>
                                            @else
                                                @if($productt->emptyStock())
                                                    <li class="addtocart">
                                                        <a href="javascript:;" class="cart-out-of-stock">
                                                            <i class="icofont-close-circled"></i>
                                                            {{ $langg->lang78 }}</a>
                                                    </li>
                                                @else

                                                    {{-- Add To Cart Button --}}
                                                    <li class="addtocart ">
                                                        <a href="javascript:;" id="addcrt"><i
                                                                    class="icofont-cart"></i>{{ $langg->lang90 }}</a>
                                                    </li>

                                                    {{-- Buy Now Button --}}
                                                    <li class="addtocart ">
                                                        <a href="javascript:;" id="buynow"><i
                                                                    class="icofont-cart"></i>{{ $langg->lang251 }}</a>
                                                    </li>
                                                @endif

                                            @endif

                                            @if(Auth::guard('web')->check())
                                                <li class="favorite">
                                                    <a href="javascript:;" class="add-to-wish"
                                                       data-href="{{ route('user-wishlist-add',$productt->id) }}"><i
                                                                class="icofont-heart-alt"></i></a>
                                                </li>
                                            @else
                                                <li class="favorite">
                                                    <a href="javascript:;" data-toggle="modal"
                                                       data-target="#comment-log-reg"><i
                                                                class="icofont-heart-alt"></i></a>
                                                </li>
                                            @endif
                                            <li class="compare">
                                                <a href="javascript:;" class="add-to-compare"
                                                   data-href="{{ route('product.compare.add',$productt->id) }}"><i
                                                            class="icofont-exchange"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--<div class="social-links social-sharing a2a_kit a2a_kit_size_32" >-->
                                    <!--  <ul class="link-list social-links">-->
                                    <!--    <li>-->
                                    <!--      <a class="facebook a2a_button_facebook" href=""  >-->
                                    <!--        <i class="fab fa-facebook-f"></i>-->
                                    <!--      </a>-->
                                    <!--    </li> -->

                                    <!--    <li>-->
                                    <!--      <a class="instagram a2a_button_instagram" href="">-->
                                    <!--        <i class="fab fa-instagram"></i>-->
                                    <!--      </a>-->
                                    <!--    </li>-->
                                    <!--    <li>-->
                                    <!--      <a class="twitter a2a_button_twitter" href="">-->
                                    <!--        <i class="fab fa-twitter"></i>-->
                                    <!--      </a>-->
                                    <!--    </li>-->
                                    <!--    <li>-->
                                    <!--      <a class="linkedin a2a_button_linkedin" href="">-->
                                    <!--        <i class="fab fa-linkedin-in"></i>-->
                                    <!--      </a>-->
                                    <!--    </li>-->
                                    <!--    <li>-->
                                    <!--      <a class="pinterest a2a_button_pinterest" href="">-->
                                    <!--        <i class="fab fa-pinterest-p"></i>-->
                                    <!--      </a>-->
                                    <!--    </li>-->
                                    <!--  </ul>-->
                                    <!--</div>-->
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>

                                    <!--<script src="https://checkout.tabby.ai/tabby-promo.js"></script>


                                    <div id="tabby-promo" class="mb-2">

                                    </div>-->

                                    @if($productt->ship != null)
                                        <p class="estimate-time">{{ $langg->lang86 }}: <b> {{ $productt->ship }}</b></p>
                                @endif
                                <!--  @if( $productt->sku != null )
                                    <p class="p-sku">
{{ $langg->lang77 }}: <span class="idno">{{ $productt->sku }}</span>
                </p>
                @endif
                                @if($gs->is_report)

                                    {{-- PRODUCT REPORT SECTION --}}

                                    @if(Auth::guard('web')->check())

                                        <div class="report-area">
                                          <a href="javascript:;" data-toggle="modal" data-target="#report-modal"><i class="fas fa-flag"></i> {{
                    $langg->lang776 }}</a>
                </div>

                @else

                                        <div class="report-area">
                                          <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i class="fas fa-flag"></i>
{{ $langg->lang776 }}</a>
                </div>
                @endif

                                    {{-- PRODUCT REPORT SECTION ENDS --}}

                                @endif
                                        -->


                                </div>

                                <!-- Description & RETURN POLICY Box-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="product-details-tab">
                                            <div class="top-menu-area">
                                                <ul class="tab-menu">
                                                    <li><a href="#tabs-1">{{ $langg->lang92 }}</a></li>
                                                    <li><a href="#tabs-2">{{ $langg->lang93 }}</a></li>
                                                    {{--<li><a href="#tabs-3">{{ $langg->lang94 }}({{ count($productt->ratings) }})</a></li>--}}
                                                    @if($gs->is_comment == 1)
                                                        <li><a href="#tabs-4">{{ $langg->lang95 }}(<span
                                                                        id="comment_count">{{ count($productt->comments)
                                }}</span>)</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="tab-content-wrapper">
                                                <div id="tabs-1" class="tab-content-area">
                                                    <p>

                                                    @if(!$slang)
                                                        @if($lang->id == 2)
                                                            {!! $productt->details_ar !!}
                                                        @else
                                                            {!! $productt->details !!}
                                                        @endif
                                                    @else
                                                        @if($slang == 2)
                                                            {!! $productt->details_ar !!}
                                                        @else
                                                            {!! $productt->details !!}
                                                        @endif
                                                    @endif


                                                    @if($productt->youtube != null)
                                                        <div class="contvad">
                                                            <iframe class="responsive-iframe" width="560" height="315"
                                                                    src="{{ $productt->youtube }}"
                                                                    frameborder="0"
                                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                                    allowfullscreen></iframe>
                                                        </div>
                                                        @endif


                                                        </p>
                                                </div>
                                                <div id="tabs-2" class="tab-content-area">
                                                    <p>

                                                        @if(!$slang)
                                                            @if($lang->id == 2)
                                                                {!! $productt->policy_ar !!}
                                                            @else
                                                                {!! $productt->policy !!}
                                                            @endif
                                                        @else
                                                            @if($slang == 2)
                                                                {!! $productt->policy_ar !!}
                                                            @else
                                                                {!! $productt->policy !!}
                                                            @endif
                                                        @endif

                                                    </p>
                                                </div>
                                                {{--
                                                <div id="tabs-3" class="tab-content-area">
                                                  <div class="heading-area">
                                                    <h4 class="title">
                                                      {{ $langg->lang96 }}
                                                    </h4>
                                                    <div class="reating-area">
                                                      <div class="stars"><span id="star-rating">{{App\Models\Rating::rating($productt->id)}}</span> <i
                                                          class="fas fa-star"></i>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div id="replay-area">
                                                    <div id="reviews-section">
                                                      @if(count($productt->ratings) > 0)
                                                      <ul class="all-replay">
                                                        @foreach($productt->ratings as $review)
                                                        <li>
                                                          <div class="single-review">
                                                            <div class="left-area">
                                                              @if(!empty($review->user->photo))
                                                              <img
                                                                src="{{ $review->user->photo ? asset('assets/images/users/'.$review->user->photo):asset('assets/images/noimage.png') }}">
                                                              @endif
                                                              @if(!empty($review->user->name))
                                                              <h5 class="name">{{ $review->user->name }}</h5>
                                                              @endif
                                                              <p class="date">
                                                                {{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}
                                                              </p>
                                                            </div>
                                                            <div class="right-area">
                                                              <div class="header-area">
                                                                <div class="stars-area">
                                                                  <ul class="starss">
                                                                    <div class="ratings">
                                                                      <div class="empty-stars"></div>
                                                                      <div class="full-stars" style="width:{{$review->rating*20}}%"></div>
                                                                    </div>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                              <div class="review-body">
                                                                <p>
                                                                  {{$review->review}}
                                                                </p>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          @endforeach
                                                        </li>
                                                      </ul>
                                                      @else
                                                      <p>{{ $langg->lang97 }}</p>
                                                      @endif
                                                    </div>
                                                    @if(Auth::guard('web')->check())
                                                    <div class="review-area">
                                                      <h4 class="title">{{ $langg->lang98 }}</h4>
                                                      <div class="star-area">
                                                        <ul class="star-list">
                                                          <li class="stars" data-val="1">
                                                            <i class="fas fa-star"></i>
                                                          </li>
                                                          <li class="stars" data-val="2">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                          </li>
                                                          <li class="stars" data-val="3">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                          </li>
                                                          <li class="stars" data-val="4">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                          </li>
                                                          <li class="stars active" data-val="5">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                          </li>
                                                        </ul>
                                                      </div>
                                                    </div>
                                                    <div class="write-comment-area">
                                                      <div class="gocover"
                                                        style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                                      </div>
                                                      <form id="reviewform" action="{{route('front.review.submit')}}"
                                                        data-href="{{ route('front.reviews',$productt->id) }}" method="POST">
                                                        @include('includes.admin.form-both')
                                                        {{ csrf_field() }}
                                                        <input type="hidden" id="rating" name="rating" value="5">
                                                        <input type="hidden" name="user_id" value="{{Auth::guard('web')->user()->id}}">
                                                        <input type="hidden" name="product_id" value="{{$productt->id}}">
                                                        <div class="row">
                                                          <div class="col-lg-12">
                                                            <textarea name="review" placeholder="{{ $langg->lang99 }}" required=""></textarea>
                                                          </div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="col-lg-12">
                                                            <button class="submit-btn" type="submit">{{ $langg->lang100 }}</button>
                                                          </div>
                                                        </div>
                                                      </form>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                      <div class="col-lg-12">
                                                        <br>
                                                        <h5 class="text-center"><a href="javascript:;" data-toggle="modal"
                                                            data-target="#comment-log-reg" class="btn login-btn mr-1">{{ $langg->lang101 }}</a> {{
                                                          $langg->lang102 }}</h5>
                                                        <br>
                                                      </div>
                                                    </div>
                                                    @endif
                                                  </div>
                                                </div>
                                                --}}
                                                @if($gs->is_comment == 1)
                                                    <div id="tabs-4" class="tab-content-area">
                                                        <div id="comment-area">

                                                            @include('includes.comment-replies')

                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3">

                    @if(!empty($productt->whole_sell_qty))
                        <div class="table-area wholesell-details-page">
                            <h3>{{ $langg->lang770 }}</h3>
                            <table class="table">
                                <tr>
                                    <th>{{ $langg->lang768 }}</th>
                                    <th>{{ $langg->lang769 }}</th>
                                </tr>
                                @foreach($productt->whole_sell_qty as $key => $data1)
                                    <tr>
                                        <td>{{ $productt->whole_sell_qty[$key] }}+</td>
                                        <td>{{ $productt->whole_sell_discount[$key] }}% {{ $langg->lang771 }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif


                <!--      <div class="seller-info mt-3">
        <div class="content">
          <h4 class="title">
            {{ $langg->lang246 }}
                        </h4>

                        <p class="stor-name">
@if( $productt->user_id  != 0)
                        @if(isset($productt->user))
                            {{ $productt->user->shop_name }}

                            @if($productt->user->checkStatus())
                            <br>
                            <a class="verify-link" href="javascript:;"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang783 }}">
                  {{--  {{ $langg->lang783 }}  --}}
                                    <i class="fas fa-check-circle"></i>

                                  </a>
@endif

                        @else
                            {{ $langg->lang247 }}
                        @endif
                    @else
                        {{ App\Models\Admin::find(1)->shop_name }}
                    @endif
                        </p>

                        <div class="total-product">

@if( $productt->user_id  != 0)
                    <p>{{ App\Models\Product::where('user_id','=',$productt->user_id)->get()->count() }}</p>
          @else
                    <p>{{ App\Models\Product::where('user_id','=',0)->get()->count() }}</p>
          @endif
                        <span>{{ $langg->lang248 }}</span>
          </div>
        </div>
    @if( $productt->user_id  != 0)
                    <a href="{{ route('front.vendor',str_replace(' ', '-', $productt->user->shop_name)) }}" class="view-stor">{{ $langg->lang249 }}</a>
    @endif

                    {{-- CONTACT SELLER --}}


                        <div class="contact-seller">

{{-- If The Product Belongs To A Vendor --}}

                    @if($productt->user_id != 0)


                    <ul class="list">


                      @if(Auth::guard('web')->check())

                        <li>

@if(
                        Auth::guard('web')->user()->favorites()->where('vendor_id','=',$productt->user->id)->get()->count() >
                        0)

                            <a  class="view-stor" href="javascript:;">
                              <i class="icofont-check"></i>
{{ $langg->lang225 }}
                                    </a>

@else

                            <a class="favorite-prod view-stor"
                              data-href="{{ route('user-favorite',['data1' => Auth::guard('web')->user()->id, 'data2' => $productt->user->id]) }}"
                          href="javascript:;">
                          <i class="icofont-plus"></i>
                          {{ $langg->lang224 }}
                                    </a>


@endif

                                </li>





                                <li>
                                  <a  class="view-stor" href="javascript:;" data-toggle="modal" data-target="#vendorform1">
                                    <i class="icofont-ui-chat"></i>
{{ $langg->lang81 }}
                                </a>
                              </li>
@else

                        <li>

                          <a  class="view-stor" href="javascript:;" data-toggle="modal" data-target="#comment-log-reg">
                            <i class="icofont-plus"></i>
{{ $langg->lang224 }}
                                </a>


                              </li>

                              <li>

                                <a  class="view-stor" href="javascript:;" data-toggle="modal" data-target="#comment-log-reg">
                                  <i class="icofont-ui-chat"></i>
{{ $langg->lang81 }}
                                </a>
                              </li>

@endif

                            </ul>


{{-- VENDOR PART ENDS HERE :) --}}
                    @else


                        {{-- If The Product Belongs To Admin  --}}

                            <ul class="list">
@if(Auth::guard('web')->check())
                        <li>
                          <a class="view-stor"  href="javascript:;" data-toggle="modal" data-target="#vendorform">
                            <i class="icofont-ui-chat"></i>
{{ $langg->lang81 }}
                                </a>
                              </li>
@else
                        <li>
                          <a class="view-stor" href="javascript:;" data-toggle="modal" data-target="#comment-log-reg">
                            <i class="icofont-ui-chat"></i>
{{ $langg->lang81 }}
                                </a>
                              </li>

@endif

                            </ul>

@endif

                        </div>

{{-- CONTACT SELLER ENDS --}}

                        </div>
-->@if(!empty($productt->brand->slug))
                        <div class="seller-info mt-3">
                            <div class="content">
                                @if(!$slang)
                                    @if($lang->id == 2)
                                        <a href="{{route('front.singlebrands',['slug' => $productt->brand->slug_ar , 'lang' => $sign ])}}"><img
                                                    src="{{asset('assets/images/brands/'.$productt->brand->photo)}}"/></a>
                                    @else
                                        <a href="{{route('front.singlebrands',['slug' => $productt->brand->slug , 'lang' => $sign ])}}"><img
                                                    src="{{asset('assets/images/brands/'.$productt->brand->photo)}}"/></a>
                                    @endif
                                @else
                                    @if($slang == 2)
                                        <a href="{{route('front.singlebrands',['slug' => $productt->brand->slug_ar , 'lang' => $sign ])}}"><img
                                                    src="{{asset('assets/images/brands/'.$productt->brand->photo)}}"/></a>
                                    @else
                                        <a href="{{route('front.singlebrands',['slug' => $productt->brand->slug , 'lang' => $sign ])}}"><img
                                                    src="{{asset('assets/images/brands/'.$productt->brand->photo)}}"/></a>
                                    @endif
                                @endif


                            </div>
                        </div>
                    @endif


                    <div class="categori  mt-30">
                        <div class="section-top">
                            <h2 class="section-title">
                                {{ $langg->lang245 }}
                            </h2>
                        </div>
                        <div class="hot-and-new-item-slider">

                            @foreach($vendors->chunk(3) as $chunk)
                                <div class="item-slide">
                                    <ul class="item-list">
                                        @foreach($chunk as $prod)
                                            @include('includes.product.list-product')
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach

                        </div>

                    </div>


                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">

                </div>
            </div>
        </div>
        <!-- Trending Item Area Start -->
        <div class="trending">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 remove-padding">
                        <div class="section-top">
                            <h2 class="section-title">
                                {{ $langg->lang216 }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 remove-padding">
                        <div class="trending-item-slider">
                            @foreach($productt->category->products()->where('status','=',1)->where('id','!=',$productt->id)->take(8)->get()
                            as $prod)
                                @include('includes.product.slider-product')
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @if(count($related) > 0)
            <div class="trending">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 remove-padding">
                            <div class="section-top">
                                <h2 class="section-title">
                                    @lang('Other Products')
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 remove-padding">
                            <div class="trending-item-slider">
                                @foreach($related as $p)
                                    @php
                                        $prod = App\Models\Product::where('id','=',$p->related_id)->first();
                                    @endphp

                                    @include('includes.product.related')
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Tranding Item Area End -->

        @endif
    </section>
    <!-- Product Details Area End -->



    {{-- MESSAGE MODAL --}}
    <div class="message-modal">
        <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vendorformLabel">{{ $langg->lang118 }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-form">
                                        <form id="emailreply1">
                                            {{csrf_field()}}
                                            <ul>
                                                <li>
                                                    <input type="text" class="input-field" id="subj1" name="subject"
                                                           placeholder="{{ $langg->lang119}}" required="">
                                                </li>
                                                <li>
                        <textarea class="input-field textarea" name="message" id="msg1"
                                  placeholder="{{ $langg->lang120 }}" required=""></textarea>
                                                </li>
                                                <input type="hidden" name="type" value="Ticket">
                                            </ul>
                                            <button class="submit-btn" id="emlsub"
                                                    type="submit">{{ $langg->lang118 }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MESSAGE MODAL ENDS --}}


        @if(Auth::guard('web')->check())

            @if($productt->user_id != 0)

                {{-- MESSAGE VENDOR MODAL --}}


                <div class="modal" id="vendorform1" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel1"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="vendorformLabel1">{{ $langg->lang118 }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid p-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="contact-form">
                                                <form id="emailreply">
                                                    {{csrf_field()}}
                                                    <ul>

                                                        <li>
                                                            <input type="text" class="input-field" readonly=""
                                                                   placeholder="Send To {{ $productt->user->shop_name }}"
                                                                   readonly="">
                                                        </li>

                                                        <li>
                                                            <input type="text" class="input-field" id="subj"
                                                                   name="subject"
                                                                   placeholder="{{ $langg->lang119}}" required="">
                                                        </li>

                                                        <li>
                        <textarea class="input-field textarea" name="message" id="msg"
                                  placeholder="{{ $langg->lang120 }}" required=""></textarea>
                                                        </li>

                                                        <input type="hidden" name="email"
                                                               value="{{ Auth::guard('web')->user()->email }}">
                                                        <input type="hidden" name="name"
                                                               value="{{ Auth::guard('web')->user()->name }}">
                                                        <input type="hidden" name="user_id"
                                                               value="{{ Auth::guard('web')->user()->id }}">
                                                        <input type="hidden" name="vendor_id"
                                                               value="{{ $productt->user->id }}">

                                                    </ul>
                                                    <button class="submit-btn" id="emlsub1"
                                                            type="submit">{{ $langg->lang118 }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- MESSAGE VENDOR MODAL ENDS --}}


            @endif

        @endif

    </div>


    @if($gs->is_report)

        @if(Auth::check())

            {{-- REPORT MODAL SECTION --}}

            <div class="modal fade" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="report-modal-Title"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="gocover"
                                 style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                            </div>

                            <div class="login-area">
                                <div class="header-area forgot-passwor-area">
                                    <h4 class="title">{{ $langg->lang777 }}</h4>
                                    <p class="text">{{ $langg->lang778 }}</p>
                                </div>
                                <div class="login-form">

                                    <form id="reportform" action="{{ route('product.report') }}" method="POST">

                                        @include('includes.admin.form-login')

                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="product_id" value="{{ $productt->id }}">
                                        <div class="form-input">
                                            <input type="text" name="title" class="User Name"
                                                   placeholder="{{ $langg->lang779 }}" required="">
                                            <i class="icofont-notepad"></i>
                                        </div>

                                        <div class="form-input">
                                            <textarea name="note" class="User Name" placeholder="{{ $langg->lang780 }}"
                                                      required=""></textarea>
                                        </div>

                                        <button type="submit" class="submit-btn">{{ $langg->lang196 }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- REPORT MODAL SECTION ENDS --}}

        @endif

    @endif

@endsection


@section('scripts')

    <script type="text/javascript">
        $(document).on("submit", "#emailreply1", function () {
            var token = $(this).find('input[name=_token]').val();
            var subject = $(this).find('input[name=subject]').val();
            var message = $(this).find('textarea[name=message]').val();
            var $type = $(this).find('input[name=type]').val();
            $('#subj1').prop('disabled', true);
            $('#msg1').prop('disabled', true);
            $('#emlsub').prop('disabled', true);
            $.ajax({
                type: 'post',
                url: "{{URL::to('/user/admin/user/send/message')}}",
                data: {
                    '_token': token,
                    'subject': subject,
                    'message': message,
                    'type': $type
                },
                success: function (data) {
                    $('#subj1').prop('disabled', false);
                    $('#msg1').prop('disabled', false);
                    $('#subj1').val('');
                    $('#msg1').val('');
                    $('#emlsub').prop('disabled', false);
                    if (data == 0)
                        toastr.error("Oops Something Goes Wrong !!");
                    else
                        toastr.success("Message Sent !!");
                    $('.close').click();
                }

            });
            return false;
        });

    </script>


    <script type="text/javascript">
        $(document).on("submit", "#emailreply", function () {
            var token = $(this).find('input[name=_token]').val();
            var subject = $(this).find('input[name=subject]').val();
            var message = $(this).find('textarea[name=message]').val();
            var email = $(this).find('input[name=email]').val();
            var name = $(this).find('input[name=name]').val();
            var user_id = $(this).find('input[name=user_id]').val();
            var vendor_id = $(this).find('input[name=vendor_id]').val();
            $('#subj').prop('disabled', true);
            $('#msg').prop('disabled', true);
            $('#emlsub').prop('disabled', true);
            $.ajax({
                type: 'post',
                url: "{{URL::to('/vendor/contact')}}",
                data: {
                    '_token': token,
                    'subject': subject,
                    'message': message,
                    'email': email,
                    'name': name,
                    'user_id': user_id,
                    'vendor_id': vendor_id
                },
                success: function () {
                    $('#subj').prop('disabled', false);
                    $('#msg').prop('disabled', false);
                    $('#subj').val('');
                    $('#msg').val('');
                    $('#emlsub').prop('disabled', false);
                    toastr.success("{{ $langg->message_sent }}");
                    $('.ti-close').click();
                }
            });
            return false;
        });

    </script>

    <script type="text/javascript">
        $("li.sizes").click(function () {
            $("ul.color-lists").addClass("color-list");

            @if(!empty($colors->id))
            $("li.hide").hide();
            @endif

            $("ul.show").remove();

            var idd = $(".pro_id").val();
            var size = this.id;
            var url = "{{ route('colorss')}}";
            // alert("clicked:" + size );
            var token = $("input[name='_token']").val();

            $.ajax({
                url: url,
                method: 'POST',
                data: {idd: idd, size: size, _token: token},
                success: function (data) {

                    $("ul.color-lists").html('');
                    $("ul.color-lists").html(data.option);
                    $("li.click").click();

                },

            });

        });


        $(document).on('click', '.click', function () {
            $("li.hide").show();
        });
    </script>


    <script>
        new window.TabbyPromo({
            selector: '#tabby-promo',
            currency: '{{ $curr->name }}', // or SAR, BHD, KWD, EGP
            lang: '{{ Request::segment(1) }}', // or ar
            price: '{{ $productt->getPrice() }}',
        });
    </script>

@endsection