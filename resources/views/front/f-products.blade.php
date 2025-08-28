@extends('layouts.front_34')
@section('content')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();


@endphp
<div class="breadcrumb-area">
   <div class="">
      <div class="row m-0">
         <div class="col-lg-12">
            <ul class="pages breadcrumb mb-0">
               <li class="breadcrumb-item">
                  <a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a>
               </li>
               
                 <li class="breadcrumb-item">
                  <a href="{{route('front.products',$sign)}}">{{ $langg->lang25 }}</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>

<section class="sub-categori">
   <div class="">
       <h3 style="
    color: #5a6c78;
    margin-left: 40px;
    letter-spacing: 10px;
    font-size: 24px;
    margin-bottom: 71px;
                            "></h3>
      <div class="row m-0">
					@foreach ($products as $key => $prod)
					    <!--Start A Product-->
						<div class="w-20">
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
                                    <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" 
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
                                        @endif
                                    >
                                </div>  <!--End Product Image-->
                                
                                <!--*******-->
                                <div class="product-desc px-2 pb-0">
									@if(!$slang)
                                        @if($lang->id == 2)
                                          <a href="{{ route('front.product_34',['slug' => $prod->slug_ar ,'lang' => $sign]) }}" class="item">
                                        @else 
                                           <a href="{{ route('front.product_34', ['slug' => $prod->slug ,'lang' => $sign]) }}" class="item">
                                        @endif 
                                    @else  
                                        @if($slang == 2) 
                                            <a href="{{ route('front.product_34', ['slug' => $prod->slug_ar ,'lang' => $sign]) }}" class="item">
                                        @else
                                            <a href="{{ route('front.product_34', ['slug' => $prod->slug ,'lang' => $sign]) }}" class="item">
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
                                            <!--<span class="percentage text-success">33%</span>-->
                                        </div>
                                        <div class="product-rating d-flex justify-content-between align-items-center">
                                            <!--<img src="assets/images/express.png">-->
                                            <span><i class="fas fa-star"></i> {{App\Models\Rating::ratings($prod->id)}}%</span>
                                        </div>
                                    </a>
                                </div> <!--End Product Description-->
                            </div>
						</div>
				        <!--End A Product-->	
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