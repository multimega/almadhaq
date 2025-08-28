@extends('layouts.front_34')

@php

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$ps = App\Models\Pagesetting::find(1);
 $tool = DB::table('seotools')->find(1);
$pro_id=  App\Models\OfferProduct::get()->pluck('product_id');
$prods = App\Models\Product::whereIn('id',$pro_id)->get();

  if (Session::has('currency')) {

              $curr =  App\Models\Currency::find(Session::get('currency'));

             }else {

                $curr =  App\Models\Currency::where('is_default','=',1)->first();
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
        "position": @if(!empty($productt->subcategory) && !empty($productt->childcategory)) 5  @elseif(!empty($productt->subcategory) && empty($productt->childcategory)) 4 @else 3 @endif,
        "item": {
                    "@type": "WebPage",
                    "@id": "{{route('front.product_34',['slug' => $productt->slug , 'lang' => $sign])}}",
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
  "sku": "{{ $productt->sku }}",
  "mpn": "",


  "description": "{{ $productt->details }}",
  "name": "{{ $productt->name }}",
  "url": "{{url('item',$productt->slug)}}",
  "image": "{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}",
  @if($productt->product_condition == 2 || $productt->product_condition == null) "itemCondition": "https://schema.org/NewCondition"  ,@endif
  "offers": {
    "@type": "Offer",
    "availability": @if($productt->emptyStock()) "https://schema.org/OutOfStock"   @else "http://schema.org/InStock" @endif,
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

<!-- Start Shipping Aside -->
<!--<div class="shipping-aside">-->
<!--    <div class="shipping-aside-container">-->
<!--        <div class="bg-white mb-3 py-3">-->
<!--            <div class="px-3 py-2 shipping-aside-head d-flex justify-content-between align-items-center">-->
<!--                <h4>Delivery Locations</h4>-->
<!--                <h4 class="close-aside">x</h4>-->
<!--            </div>-->
<!--            <div class="mx-3">-->
<!--                <input type="text" class="form-control" placeholder="Location">-->
<!--            </div>-->
<!--        </div>-->

<!--        <div class="bg-white mb-3 p-3">-->
<!--            <div class="shipping-locations">-->
<!--                <ul class="unstyled-list p-0">-->
<!--                    <li class="d-flex justify-content-between align-items-center"><span>Cairo</span><input type="radio" name="adress"></li>-->
<!--                    <li class="d-flex justify-content-between align-items-center"><span>Mansoura</span><input type="radio" name="adress"></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- End Shipping Aside -->
<!-- Start Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a></li>
    <li class="breadcrumb-item">
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
          <li class="breadcrumb-item">
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
          <li class="breadcrumb-item">
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
          <li class="breadcrumb-item active" aria-current="page">
          @if(!$slang)
              @if($lang->id == 2)
              <a href="{{ route('front.product_34', ['slug' => $productt->slug_ar , 'lang' => $sign ]) }}">
              {{ $productt->name_ar }}
              @else
              <a href="{{ route('front.product_34', ['slug' => $productt->slug , 'lang' => $sign ]) }}">
              {{ $productt->name }}
              @endif
          @else
              @if($slang == 2)
              <a href="{{ route('front.product_34',['slug' => $productt->slug_ar , 'lang' => $sign ]) }}">
              {{ $productt->name_ar }}
              @else
              <a href="{{ route('front.product_34',['slug' => $productt->slug , 'lang' => $sign ]) }}">
              {{ $productt->name }}
              @endif
          @endif

          </a>
        </li>
  </ol>
</nav>
<!-- End Breadcrumb -->
<div class="item-p px-3 py-4">
    <div class="row m-0">
        <div class="col-md-5">
            <div class="xzoom-container d-flex">
                <img class="xzoom" id="xzoom-default" src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" xoriginal="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"
                @if(!$slang)
              @if($lang->id == 2)

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
               @endif/>
                <div class="xzoom-thumbs">
                    <a href="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" class="d-block"><img class="xzoom-gallery" width="80" src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"  xpreview="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"
                     @if(!$slang)
                      @if($lang->id == 2)

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
                       @endif>
                    </a>
                    @foreach($productt->galleries as $gal)
                    <a href="{{filter_var($gal->photo, FILTER_VALIDATE_URL) ? $gal->photo :asset('assets/images/galleries/'.$gal->photo)}}" class="d-block"><img class="xzoom-gallery" width="80" src="{{filter_var($gal->photo, FILTER_VALIDATE_URL) ? $gal->photo : asset('assets/images/galleries/'.$gal->photo)}}"  xpreview="{{filter_var($gal->photo, FILTER_VALIDATE_URL) ? $gal->photo : asset('assets/images/galleries/'.$gal->photo)}}" title="The description goes here"></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="i-p-item-info">
                <h4 class="i-p-brand-name">
                    @if($productt->brand)
                    {{ $productt->brand->name}}
                    @endif
                </h4>
                <h3 class="i-p-product-name">
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
                </h3>
                <span>
                    @if($productt->type == 'Physical')
                      @if($productt->emptyStock())
                        <p class="text-danger">
                            <i class="far fa-check-circle"></i>
                          {{ $langg->lang78 }}
                        </p>
                      @else
                        <p class="text-success">
                            <i class="far fa-check-circle"></i>
                          {{ $gs->show_stock == 0 ? '' : $productt->stock }} {{ $langg->lang79 }}
                        </p>
                        <span>
                              <div class="ratings">
                                <div class="empty-stars"></div>
                                <div class="full-stars" style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>
                              </div>
                              <span class="review-count d-inline-block">
                                <p>{{count($productt->ratings)}} {{ $langg->lang80 }}</p>
                              </span>
                        </span>
                      @endif
                    @endif

                </span>
                @if( $productt->sku != null )
                    <span>{{ $langg->lang77 }}: {{ $productt->sku }}</span>
                @endif
                <span>Was: <span class="was">
                    @if(!$slang)
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
                    @endif
                </span></span>

                @if(!$slang)
                    @if($lang->id == 2)
                    <span>Now: <span class="now">{{ $productt->showPrice_ar() }}</span></span>
                    @else
                    <span>Now: <span class="now">{{ $productt->showPrice() }}</span></span>
                    @endif
                @else
                    @if($slang == 2)
                    <span>Now: <span class="now">{{ $productt->showPrice_ar() }}</span></span>
                    @else
                    <span>Now: <span class="now">{{ $productt->showPrice() }}</span></span>
                    @endif
                @endif
                <!--<span>Saving: <strong>50 EGP</strong> <div class="alert alert-success">20%</div></span> -->
                <!--<img src="assets/images/item.gif" class="w-100"> -->
                <!--<p class="shiping-to-btn mt-4">-->
                <!--    <span>Cairo</span>-->
                <!--    <span class="or">Ship to</span>-->
                <!--    <span><i class="fas fa-chevron-right"></i></span>    -->
                <!--</p>  -->
                <!--*******************************************************************-->
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
                            <p>{{ $langg->lang84 }}: <b>{{ $productt->licence_type }}</b></p>
                          </li>
                          @endif

                      @endif
                    </ul>
                </div>

                @php
                  $colors = App\Models\Color::where('product_id',$productt->id)->where('size_qty','>', 0)->first();

                    $sizes = App\Models\Color::where('product_id',$productt->id)->where('size_qty','>', 0)->distinct('size')->get();
                    $collection = collect($sizes);
                    $unique_data = $collection->unique('size')->values()->all();
                @endphp
                @if(!empty($productt->size))
                  <div class="product-size">
                    <p class="title">{{ $langg->lang88 }} :</p>
                    <ul class="siz-list siz-lists">
                      @php
                      $co = App\Models\Color::where('product_id',$productt->id)->where('size',$productt->size[0])->where('size_qty','>', 0)->get();
                      $is_first = true;
                      @endphp
                      @foreach($productt->size as $key => $data1)
                        <li class="{{ $is_first ? 'active' : '' }} sizes si" id="{{$data1}}">
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
                                    <input type="hidden" class="size_price" value="{{ round($productt->size_price[$key] * $curr->value,2) }}">
                                @endif
                            </span>
                        </li>

                          @php
                          $is_first = false;
                          @endphp
                      @endforeach
                    </ul>
                  </div>
                  @endif


                  @if(!empty($productt->color))

                      <div class="product-color">
                        <p class="title">{{ $langg->lang89 }} :</p>
                        <ul class="color-list color-list-box" >
                          @php
                            $is_first = true;
                          @endphp
                          @foreach($productt->color as $key => $data1)
                              <li class="{{ $is_first ? 'active' : '' }}">
                                <span class="box boxs" data-color="{{ $productt->color[$key] }}" style="background-color: {{ $productt->color[$key] }}"></span>
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
                              $co = App\Models\Color::where('product_id',$productt->id)->where('size',$colors->size)->where('size_qty','>', 0)->get();
                              $is_first = true;
                          @endphp
                          @foreach($unique_data as $key => $data1)
                              @if($data1->size_qty > 0)
                                  <li class="{{ $is_first ? 'active' : '' }} sizes si" id="{{$data1->size}}">
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
                                    <span class="box boxz" data-color="{{ $data1->colors }}" style="background-color: {{ $data1->colors }}">

                                          <input type="hidden" class="color_qty"  value="{{ $data1->size_qty }}">
                                          <input type="hidden" class="color_price"  value="{{ $data1->size_price }}">
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

                  <input type="hidden" id="product_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                  <input type="hidden" id="product_id" value="{{ $productt->id }}">
                  <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
                  <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">
                  <input type="hidden" id="curr_sign_ar" value="{{ $curr->name_ar }}">
                  <div class="info-meta-3">
                    <ul class="meta-list p-0">
                      @if($productt->product_type != "affiliate")
                      <li class="d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}">
                        <div class="qty">
                          <ul class="list-unstyled d-flex">
                            <li>
                              <span class="qtminus d-flex align-items-center justify-content-center" style="border:0">
                                <i class="icofont-minus"></i>
                              </span>
                            </li>
                            <li>
                              <span class="qttotal d-flex align-items-center justify-content-center" style="border:0">1</span>
                            </li>
                            <li>
                              <span class="qtplus d-flex align-items-center justify-content-center" style="border:0">
                                <i class="icofont-plus"></i>
                              </span>
                            </li>
                          </ul>
                        </div>
                      </li>
                      @endif
                    </ul>
                    </div>
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
                                    <input type="hidden" class="keys" value="">
                                    <input type="hidden" class="values" value="">
                                    <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}" class="custom-control-input product-attr product-attr1 product-attr2"  data-key="{{ $attrKey }}" data-price = "{{ $attrVal['prices'][$optionKey] * $curr->value }}" value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}"><!--{{ $optionVal }}-->
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
                                      {{$curr->sign}}  {{$attrVal['prices'][$optionKey] * $curr->value}}
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
                <!--*******************************************************************-->

                @if($productt->product_type == "affiliate")

                  <button class="addtocart btn btn-primary">
                    <a href="{{ route('affiliate.product', ['slug' => $productt->slug , 'lang' => $sign ]) }}" class="text-white" target="_blank"><i
                        class="icofont-cart"></i> {{ $langg->lang251 }}</a>
                  </button>
                @else
                    @if($productt->emptyStock())
                      <button class="addtocart btn btn-primary">
                        <a href="javascript:;" class="cart-out-of-stock text-white">
                          <i class="icofont-close-circled"></i>
                          {{ $langg->lang78 }}</a>
                      </button>
                    @else
                      <button class="addtocart btn btn-primary "  >
                        <a href="javascript:;"   id="addcrt" class="text-white"><i class="icofont-cart"></i>{{ $langg->lang90 }}</a>
                      </button>

                      <button class="addtocart btn btn-primary " >
                        <a href="{{ route('product.cart.quickadd',['id' => $productt->id , 'lang' => $sign]) }}" class="text-white"><i
                            class="icofont-cart"></i>{{ $langg->lang251 }}</a>
                      </button>
                    @endif
                @endif

            </div>
        </div>
        <div class="col-lg-3">
            <div class="categori  mt-30">
                <div class="section-top">
                    <h2 class="section-title">
                        {{ $langg->lang245 }}
                    </h2>
                </div>
                <div class="hot-and-new-item-slider owl-carousel owl-theme">

                  @foreach($vendors->chunk(3) as $chunk)
                    <!--<div class="item-slide">-->
                    <!--  <ul class="item-list">-->
                        @foreach($chunk as $prod)
                          @include('includes.product.list-product')
                        @endforeach
                    <!--  </ul>-->
                    <!--</div>-->
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row m-0">
    <div class="col-md-8 m-auto">
      <div class="item-shiffle-sec mt-5">
        <ul class="list-unstyled">
            <li class="active" data-id="tab1">{{ $langg->lang92 }}</li>
            <li data-id="tab2">{{ $langg->lang93 }}</li>
            <li data-id="tab3">{{ $langg->lang94 }}({{ count($productt->ratings) }})</li>
        </ul>
        <div class="item-shiffle-desc">
            <div id="tab1">
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
                        <iframe class="responsive-iframe" width="560" height="315" src="{{ $productt->youtube }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    @endif
                </p>

            </div>
            <div id="tab2">
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
            <div id="tab3">
                <div class="heading-area">
                      <h4 class="title">
                        {{ $langg->lang96 }}
                      </h4>
                      <div class="reating-area">
                        <div class="stars"><span id="star-rating">{{App\Models\Rating::rating($productt->id)}}</span> <i
                            class="fas fa-star"></i></div>
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
                                  src="{{ $review->user->photo ? asset('assets/images/users/'.$review->user->photo):asset('assets/images/noimage.png') }}"

                                  >
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
                          <ul class="star-list list-unstyled d-flex">
                            <li class="stars" data-val="1">
                              <i class="fas fa-star"></i>
                            </li>
                            ||
                            <li class="stars" data-val="2">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                            </li>
                            ||
                            <li class="stars" data-val="3">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                            </li>
                            ||
                            <li class="stars" data-val="4">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                            </li>
                            ||
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
                          <div class="row mb-3">
                            <div class="col-lg-12">
                              <textarea name="review" placeholder="{{ $langg->lang99 }}" class="form-control" required=""></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12">
                              <button class="submit-btn btn btn-success" type="submit">{{ $langg->lang100 }}</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      @else
                      <div class="row">
                        <div class="col-lg-12">
                          <br>
                          <h5 class="text-center"><a href="javascript:;" data-toggle="modal" data-target="#exampleModal"
                              class="btn login-btn mr-1">{{ $langg->lang101 }}</a> {{ $langg->lang102 }}</h5>
                          <br>
                        </div>
                      </div>
                      @endif
                    </div>
            </div>
        </div>
    </div>
    </div>
</div>
<div class="customer-also-viewed mt-3">
    <div class="h-products px-4 pt-4 pb-1 mb-3">
    <div class="products-head d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0">Customer Also Viewed</h5>
    </div>
    <div class="owl-carousel owl-theme owl-products">
        <!-- Start Product -->
        @foreach($productt->category->products()->where('status','=',1)->where('id','!=',$productt->id)->take(8)->get() as $prod)
        <div class="product-box">
            <div class="product-img">
                @if(Auth::guard('web')->check())
                <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-wishlist paction add-wishlist add-to-wish">
                  <i class="far fa-heart"></i>
                </a>
                @endif
                @if($prod->product_type == "affiliate")
					<button class="add-to-cart-btn affilate-btn btn-add-cart"
						data-href="{{ route('affiliate.product',  ['slug' => $prod->slug, 'lang' => $sign]) }}"><i class="fas fa-shopping-bag"></i>
					</button>
				@else
                    @if($prod->emptyStock())
                      <button class="btn-cart-out-of-stock">
                        <a href="javascript:;" class="cart-out-of-stock">
                          <i class="icofont-close-circled"></i>
                          {{ $langg->lang78 }}</a>
                      </button>
                    @else
                    <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="fas fa-shopping-bag"></i></button>
                    @endif
                @endif
                <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}">
            </div>
            <div class="product-desc px-2 pb-2">
                @if(!$slang)
                      @if($lang->id == 2)
                        <a href="{{ route('front.product_34', ['slug' => $prod->slug_ar ,'lang' => $sign]) }}">
                      @else
                        <a href="{{ route('front.product_34', ['slug' => $prod->slug ,'lang' => $sign]) }}">
                      @endif
                @else
                      @if($slang == 2)
                        <a href="{{ route('front.product_34',  ['slug' => $prod->slug_ar ,'lang' => $sign]) }}">
                      @else
                        <a href="{{ route('front.product_34',  ['slug' => $prod->slug ,'lang' => $sign]) }}">
                      @endif
                 @endif
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
                        <span class="current-price">
                            @if(!$slang)
                              @if($lang->id == 2)
                                {{ $prod->showPrice_ar() }}
                              @else
                                {{ $prod->showPrice() }}
                              @endif
                          @else
                              @if($slang == 2)
                                {{ $prod->showPrice_ar() }}
                              @else
                                {{ $prod->showPrice() }}
                              @endif
                          @endif
                        </span>
                        <span class="old-price">
                            @if(!$slang)
                                  @if($lang->id == 2)
                                    {{ $prod->showPreviousPrice_ar() }}
                                  @else
                                    {{ $prod->showPreviousPrice() }}
                                  @endif
                            @else
                                  @if($slang == 2)
                                    {{ $prod->showPreviousPrice_ar() }}
                                  @else
                                    {{ $prod->showPreviousPrice() }}
                                  @endif
                            @endif
                        </span>
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
        @endforeach
        <!-- End Product -->
    </div>
</div>

@endsection