@extends('layouts.front')
@section('content')
@php

$slang = Session::get('language');
$lang = DB::table('languages')->where('is_default','=',1)->first();


@endphp
<!-- favicon -->
<link rel="icon" type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}">

<div class="breadcrumb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">
          <li>
            <a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a>
          </li>

          <li>
            <a href="{{route('front.products',$sign)}}">{{ $langg->lang25 }}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<section class="sub-categori">
  <div class="container">
    <h3 style="
    color: #5a6c78;
    margin-left: 40px;
    letter-spacing: 10px;
    font-size: 24px;
    margin-bottom: 71px;
                            "></h3>
    <div class="row">

      @foreach ($products as $key => $prod)
      <div class="col-lg-3 col-md-3 col-6 remove-padding">

        @if(!$slang)
        @if($lang->id == 2)
        <a href="{{ route('front.product', ['slug' => $prod->slug_ar , 'lang' => $sign]) }}" class="item">
          @else
          <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="item">
            @endif
            @else
            @if($slang == 2)
            <a href="{{ route('front.product',['slug' => $prod->slug_ar , 'lang' => $sign]) }}" class="item">
              @else
              <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}" class="item">
                @endif
                @endif

                <div class="item-img">
                  @if(!empty($prod->features))
                  <div class="sell-area">
                    @foreach($prod->features as $key => $data1)
                    <span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key]
                      }}</span>
                    @endforeach
                  </div>
                  @endif
                  <div class="extra-list">
                    <ul>
                      <li>
                        @if(Auth::guard('web')->check())

                        <span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                          data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}"
                          data-placement="right"><i class="icofont-heart-alt"></i>
                        </span>

                        @else

                        <span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn"
                          data-target="#comment-log-reg" data-placement="right">
                          <i class="icofont-heart-alt"></i>
                        </span>

                        @endif
                      </li>
                      <li>
                        <span class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;"
                          data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal"
                          data-target="#quickview" data-placement="right"> <i class="icofont-eye"></i>
                        </span>
                      </li>
                      <li>
                        <span class="add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"
                          data-toggle="tooltip" data-placement="right" title="{{ $langg->lang57 }}"
                          data-placement="right">
                          <i class="icofont-exchange"></i>
                        </span>
                      </li>
                    </ul>
                  </div>
                  <img class="img-fluid"
                    src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                    alt="">
                </div>
                <div class="info">
                {{--
                  <div class="stars">
                    <div class="ratings">
                      <div class="empty-stars"></div>
                      <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
                    </div>
                  </div>
                --}}
                  <h4 class="name">@if(!$slang)
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
                    @endif</h4>

                    @if(isset($prod->featured_price))
                    <h6 class="price">{{ $prod->showFeaturedPrice() }} <del><small>{{ $prod->showPreviousPrice() }}</small></del></h6>
                    @else
                    <h6 class="price">{{ $prod->showPrice() }} <del><small>{{ $prod->showPreviousPrice() }}</small></del></h6>
                    @endif

                  <div class="item-cart-area">
                    @if($prod->product_type == "affiliate")
                    <span class="add-to-cart-btn affilate-btn"
                      data-href="{{ route('affiliate.product', ['slug' => $prod->slug ,'lang' => $sign]) }}"><i
                        class="icofont-cart"></i>
                      {{ $langg->lang251 }}
                    </span>
                    @else
                    @if($prod->emptyStock())
                    <span class="add-to-cart-btn cart-out-of-stock">
                      <i class="icofont-close-circled"></i> {{ $langg->lang78 }}
                    </span>
                    @else
                    <span class="add-to-cart add-to-cart-btn  addcrt"
                      data-href="{{ route('product.cart.add',$prod->id) }}">
                      <i class="icofont-cart"></i> {{ $langg->lang56 }}
                    </span>
                    <span class="add-to-cart-quick add-to-cart-btn"
                      data-href="{{ route('product.cart.quickadd',['id' => $prod->id , 'lang' => $sign]) }}">
                      <i class="icofont-cart"></i> {{ $langg->lang251 }}
                    </span>
                    @endif
                    @endif
                  </div>
                </div>
              </a>

      </div>
      @endforeach
      <div class="col-lg-12">
        <div class="page-center mt-5">
          {!! $products->appends(['search' => request()->input('search')])->links() !!}
        </div>
      </div>




    </div>
</section>
@endsection

@section('scripts')

<script>
  $(document).ready(function() {

    // when dynamic attribute changes
    $(".attribute-input, #sortby").on('change', function() {
      $("#ajaxLoader").show();
      filter();
    });

    // when price changed & clicked in search button
    $(".filter-btn").on('click', function(e) {
      e.preventDefault();
      $("#ajaxLoader").show();
      filter();
    });
  });

  function filter() {
    let filterlink = '';

    if ($("#prod_name").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?search='+$("#prod_name").val();
      } else {
        filterlink += '&search='+$("#prod_name").val();
      }
    }

    $(".attribute-input").each(function() {
      if ($(this).is(':checked')) {
        if (filterlink == '') {
          filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$(this).attr('name')+'='+$(this).val();
        } else {
          filterlink += '&'+$(this).attr('name')+'='+$(this).val();
        }
      }
    });

    if ($("#sortby").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$("#sortby").attr('name')+'='+$("#sortby").val();
      } else {
        filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
      }
    }

    if ($("#min_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$("#min_price").attr('name')+'='+$("#min_price").val();
      } else {
        filterlink += '&'+$("#min_price").attr('name')+'='+$("#min_price").val();
      }
    }

    if ($("#max_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$("#max_price").attr('name')+'='+$("#max_price").val();
      } else {
        filterlink += '&'+$("#max_price").attr('name')+'='+$("#max_price").val();
      }
    }

    // console.log(filterlink);
    console.log(encodeURI(filterlink));
    $("#ajaxContent").load(encodeURI(filterlink), function(data) {
      // add query string to pagination
      addToPagination();
      $("#ajaxLoader").fadeOut(1000);
    });
  }

  // append parameters to pagination links
  function addToPagination() {
    // add to attributes in pagination links
    $('ul.pagination li a').each(function() {
      let url = $(this).attr('href');
      let queryString = '?' + url.split('?')[1]; // "?page=1234...."

      let urlParams = new URLSearchParams(queryString);
      let page = urlParams.get('page'); // value of 'page' parameter

      let fullUrl = '{{route('front.category', [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}?page='+page+'&search='+'{{request()->input('search')}}';

      $(".attribute-input").each(function() {
        if ($(this).is(':checked')) {
          fullUrl += '&'+encodeURI($(this).attr('name'))+'='+encodeURI($(this).val());
        }
      });

      if ($("#sortby").val() != '') {
        fullUrl += '&sort='+encodeURI($("#sortby").val());
      }

      if ($("#min_price").val() != '') {
        fullUrl += '&min='+encodeURI($("#min_price").val());
      }

      if ($("#max_price").val() != '') {
        fullUrl += '&max='+encodeURI($("#max_price").val());
      }

      $(this).attr('href', fullUrl);
    });
  }

  $(document).on('click', '.categori-item-area .pagination li a', function (event) {
    event.preventDefault();
    if ($(this).attr('href') != '#' && $(this).attr('href')) {
      $('#preloader').show();
      $('#ajaxContent').load($(this).attr('href'), function (response, status, xhr) {
        if (status == "success") {
          $('#preloader').fadeOut();
          $("html,body").animate({
            scrollTop: 0
          }, 1);

          addToPagination();
        }
      });
    }
  });

</script>

<script type="text/javascript">
  $(function () {

    $("#slider-range").slider({
      range: true,
      orientation: "horizontal",
      min: 0,
      max: 10000000,
      values: [{{ isset($_GET['min']) ? $_GET['min'] : '0' }}, {{ isset($_GET['max']) ? $_GET['max'] : '10000000' }}],
      step: 5,

      slide: function (event, ui) {
        if (ui.values[0] == ui.values[1]) {
          return false;
        }

        $("#min_price").val(ui.values[0]);
        $("#max_price").val(ui.values[1]);
      }
    });

    $("#min_price").val($("#slider-range").slider("values", 0));
    $("#max_price").val($("#slider-range").slider("values", 1));

  });

</script>



@endsection