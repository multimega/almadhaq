@extends('layouts.front')


@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$tool = DB::table('seotools')->find(1);


@endphp


@section('offersmeta')

   
   @if(isset($offers->title) ||  isset($offers->title_ar)) 
       
        <title>	@if(!$slang)
              @if($lang->id == 2)
             {!!substr($offers->title_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else 
             {{substr($offers->title, 0,50)."-"}}{{$gs->title}}
              @endif 
          @else  
              @if($slang == 2) 
              {!!substr($offers->title_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else
              {{substr($offers->title, 0,50)."-"}}{{$gs->title}}
              @endif
          @endif</title>
   @endif


     
   
   @if(isset($offers->meta_keys) ||  isset($offers->meta_keys_ar)) 
       
          
          @if(!$slang)
              @if($lang->id == 2)
            
                @if(isset($offers->meta_keys))
	        <meta name="keywords" content="{!!$offers->meta_keys_ar!!}">
	     @endif
	   
              @else 
                  @if(isset($offers->meta_keys))
                 <meta name="keywords" content="{{$offers->meta_keys}}">
	       @endif
              @endif 


              @else  
                 @if($slang == 2) 

                   @if(isset($offers->meta_keys_ar))
                 <meta name="keywords" content="{!!$offers->meta_keys_ar!!}">
	           @endif
              @else

                   @if(isset($offers->meta_keys))
                  <meta name="keywords" content="{{$offers->meta_keys}}">
                    @endif
              @endif
          @endif

   @endif



   @if(isset($offers->meta_description) ||  isset($offers->meta_description_ar)) 
       
          
          @if(!$slang)
              @if($lang->id == 2)
            
                @if(isset($offers->meta_description_ar))
	        <meta name="description" content="{!!$offers->meta_description_ar!!}">
	     @endif
	   
              @else 
                  @if(isset($offers->meta_description))
                 <meta name="description" content="{{$offers->meta_description}}">
	       @endif
              @endif 


              @else  
                 @if($slang == 2) 

                   @if(isset($offers->meta_description_ar))
                 <meta name="description" content="{!!$offers->meta_description_ar!!}">
	           @endif
              @else

                   @if(isset($offers->meta_description))
                  <meta name="description" content="{{$offers->meta_description}}">
                    @endif
              @endif
          @endif

   @endif

   
  
          @if(isset($tool->offer_analytics ))  
          
            {!! $seo->offer_analytics !!}


            @endif




@stop


@section('content')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();


@endphp
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <ul class="pages">
               <li>
                  <a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a>
               </li>
               @if (!empty($cat))
               <li>
                
             @if(!$slang)
              @if($lang->id == 2)
                <a href="{{route('front.category',[ 'category' => $cat->slug_ar ,'lang' => $sign ])}}">
              {{ $cat->name_ar }}
              @else 
                <a href="{{route('front.category',[ 'category' => $cat->slug ,'lang' => $sign ])}}">
              {{ $cat->name }}
              @endif 
          @else  
              @if($slang == 2) 
                <a href="{{route('front.category', [ 'category' => $cat->slug_ar ,'lang' => $sign ])}}">
              {{ $cat->name_ar }}
              @else
                <a href="{{route('front.category', [ 'category' => $cat->slug ,'lang' => $sign ])}}">
              {{ $cat->name }}
              @endif
          @endif</a>
               </li>
               @endif
               @if (!empty($subcat))
               <li>
                          
                  @if(!$slang)
              @if($lang->id == 2)
                <a href="{{route('front.category',  [ 'category' => $cat->slug_ar , 'subcategory' => $subcat->slug_ar ,'lang' => $sign ])}}">   
              {{ $subcat->name_ar }}
              @else 
                <a href="{{route('front.category',  [ 'category' => $cat->slug , 'subcategory' => $subcat->slug ,'lang' => $sign ])}}">   
              {{ $subcat->name }}
              @endif 
          @else  
              @if($slang == 2) 
                <a href="{{route('front.category', [ 'category' => $cat->slug_ar , 'subcategory' => $subcat->slug_ar ,'lang' => $sign ])}}">   
              {{ $subcat->name_ar }}
              @else
                <a href="{{route('front.category',  [ 'category' => $cat->slug , 'subcategory' => $subcat->slug ,'lang' => $sign ])}}">   
              {{ $subcat->name }}
              @endif
          @endif</a>
               </li>
               @endif
               @if (!empty($childcat))
               <li>
                 
                                   @if(!$slang)
              @if($lang->id == 2)
               <a href="{{route('front.category', [ 'category' => $cat->slug_ar , 'subcategory' => $subcat->slug_ar,  'childcategory' => $childcat->slug_ar ,'lang' => $sign ])}}">
              {{ $childcat->name_ar }}
              @else 
               <a href="{{route('front.category',  [ 'category' => $cat->slug , 'subcategory' => $subcat->slug,  'childcategory' => $childcat->slug ,'lang' => $sign ])}}">
              {{ $childcat->name }}
              @endif 
          @else  
              @if($slang == 2) 
               <a href="{{route('front.category',  [ 'category' => $cat->slug_ar , 'subcategory' => $subcat->slug_ar,  'childcategory' => $childcat->slug_ar ,'lang' => $sign ])}}">
              {{ $childcat->name_ar }}
              @else
               <a href="{{route('front.category',  [ 'category' => $cat->slug , 'subcategory' => $subcat->slug,  'childcategory' => $childcat->slug ,'lang' => $sign ])}}">
              {{ $childcat->name }}
              @endif
          @endif</a>
               </li>
               @endif
               @if (empty($childcat) && empty($subcat) && empty($cat))
               <li>
                @if(!$slang)
                                                          @if($lang->id == 2)
                                                            <a href="{{route('front.offers',['slug' => $offers->slug_ar , 'lang' => $sign ])}}">
                                                        {{ $offers->name_ar }}
                                                          @else 
                                                            <a href="{{route('front.offers',['slug' => $offers->slug , 'lang' => $sign ])}}">
                                                        {{ $offers->name }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                            <a href="{{route('front.offers',['slug' => $offers->slug_ar , 'lang' => $sign ])}}">
                                                         {{ $offers->name_ar }}
                                                          @else
                                                            <a href="{{route('front.offers',['slug' => $offers->slug , 'lang' => $sign ])}}">
                                                         {{ $offers->name }}
                                                          @endif
                                                      @endif</a>
               </li>
               @endif

            </ul>
         </div>
      </div>
   </div>
</div>
<!-- Breadcrumb Area End -->
<!-- SubCategori Area Start -->
<section class="sub-categori">
   <div class="container">
      <div class="row">
         @include('includes.catalog')
         <div class="col-lg-12 order-first order-lg-last ajax-loader-parent">
            <div class="right-area" id="app">

             <!--  @include('includes.filter')-->
               <div class="categori-item-area">
                 <div class="row" id="ajaxContent">
                   @include('includes.product.filtered-products')
                 </div>
                 <div id="ajaxLoader" class="ajax-loader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center rgba(0,0,0,.6);"></div>
               </div>

            </div>
         </div>
      </div>
   </div>
</section>
<!-- SubCategori Area End -->
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
        filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?search='+$("#prod_name").val();
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
        filterlink += '{{route('front.category', [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$("#min_price").attr('name')+'='+$("#min_price").val();
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

      let fullUrl = '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}?page='+page+'&search='+'{{request()->input('search')}}';

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
      max: 10000,
      values: [{{ isset($_GET['min']) ? $_GET['min'] : '0' }}, {{ isset($_GET['max']) ? $_GET['max'] : '10000' }}],
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