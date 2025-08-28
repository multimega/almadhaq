@extends('layouts.front')


@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$tool = DB::table('seotools')->find(1);


@endphp


@section('brand')

   
   @if(isset($brand->name) ||  isset($brand->name_ar)) 
       
        <title>	@if(!$slang)
              @if($lang->id == 2)
             {!!substr($brand->name_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else 
             {{substr($brand->name, 0,50)."-"}}{{$gs->title}}
              @endif 
          @else  
              @if($slang == 2) 
              {!!substr($brand->name_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else
              {{substr($brand->name, 0,50)."-"}}{{$gs->title}}
              @endif
          @endif</title>
   @endif


     
   
   @if(isset($brand->meta_keys) ||  isset($brand->meta_keys_ar)) 
       
          
          @if(!$slang)
              @if($lang->id == 2)
            
                @if(isset($brand->meta_keys))
	        <meta name="keywords" content="{!!$brand->meta_keys_ar!!}">
	     @endif
	   
              @else 
                  @if(isset($brand->meta_keys))
                 <meta name="keywords" content="{{$brand->meta_keys}}">
	       @endif
              @endif 


              @else  
                 @if($slang == 2) 

                   @if(isset($brand->meta_keys_ar))
                 <meta name="keywords" content="{!!$brand->meta_keys_ar!!}">
	           @endif
              @else

                   @if(isset($offers->meta_keys))
                  <meta name="keywords" content="{{$brand->meta_keys}}">
                    @endif
              @endif
          @endif

   @endif



   @if(isset($brand->meta_description) ||  isset($brand->meta_description_ar)) 
       
          
          @if(!$slang)
              @if($lang->id == 2)
            
                @if(isset($brand->meta_description_ar))
	        <meta name="description" content="{!!$brand->meta_description_ar!!}">
	     @endif
	   
              @else 
                  @if(isset($brand->meta_description))
                 <meta name="description" content="{{$brand->meta_description}}">
	       @endif
              @endif 


              @else  
                 @if($slang == 2) 

                   @if(isset($brand->meta_description_ar))
                 <meta name="description" content="{!!$brand->meta_description_ar!!}">
	           @endif
              @else

                   @if(isset($brand->meta_description))
                  <meta name="description" content="{{$brand->meta_description}}">
                    @endif
              @endif
          @endif

   @endif

   
  
       @if(isset($tool->brand_analytics ))  
          
            {!! $seo->brand_analytics !!}


            @endif




@stop

@section('content')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();

@endphp
<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <ul class="pages">
               <li>
                  <a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a>
               </li>
               @if (!empty($brand))
               <li>
                 
              @if(!$slang)
              @if($lang->id == 2)
               <a href="{{route('front.singlebrands',['slug' => $brand->slug_ar ,'lang' => $sign ]  )}}">
              {{ $brand->name_ar }}
              @else 
               <a href="{{route('front.singlebrands', ['slug' => $brand->slug ,'lang' => $sign ])}}">
              {{ $brand->name }}
              @endif 
              @else  
              @if($slang == 2) 
               <a href="{{route('front.singlebrands',['slug' => $brand->slug_ar ,'lang' => $sign ]   )}}">
              {{ $brand->name_ar }}
              @else
               <a href="{{route('front.singlebrands',['slug' => $brand->slug ,'lang' => $sign ]   )}}">
              {{ $brand->name }}
              @endif
              @endif</a>
               </li>
               @endif
              
            </ul>
         </div>
      </div>
   </div>
</div>
	<section class="banner-section">
			<div class="container">
					<div class="row">
							<div class="col-lg-12 remove-padding">
								<div class="img">
									<a class="banner-effect" href="">
										<img src="{{ asset('assets/images/brands/'.$brand->photo)}}" style="height:350px;" alt="">
									</a>
								</div>
							</div>
					</div>
		    	</div>
		  </section>


<section class="sub-categori">
   <div class="container">
      <div class="row">
         @include('includes.catalog')
         <div class="col-lg-12 order-first order-lg-last ajax-loader-parent">
            <div class="right-area" id="app">

               @include('includes.filter')
                              @include('includes.product.brand-products')

              </div>

            </div>
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
      filterlink += '{{ route('front.singlebrands', ['slug' => $slug,
      'lang' => $slang]) }}' + '?search=' + encodeURIComponent($("#prod_name").val());
    } else {
      filterlink += '&search=' + encodeURIComponent($("#prod_name").val());
    }
  }

  $(".attribute-input").each(function () {
    if ($(this).is(':checked')) {
      if (filterlink == '') {
        filterlink += '{{ route('front.singlebrands', ['slug' => $slug, 'lang' => $slang]) }}' + '?' + encodeURIComponent($(this).attr('name')) + '=' + encodeURIComponent($(this).val());
      } else {
        filterlink += '&' + encodeURIComponent($(this).attr('name')) + '=' + encodeURIComponent($(this).val());
      }
    }
  });

  if ($("#sortby").val() != '') {
    if (filterlink == '') {
      filterlink += '{{ route('front.singlebrands', ['slug' => $slug, 'lang' => $slang]) }}' + '?' + encodeURIComponent($("#sortby").attr('name')) + '=' + encodeURIComponent($("#sortby").val());
    } else {
      filterlink += '&' + encodeURIComponent($("#sortby").attr('name')) + '=' + encodeURIComponent($("#sortby").val()) + '&slug=' + encodeURIComponent('{{ $slug }}');
    }
  }

  if ($("#min_price").val() != '') {
    if (filterlink == '') {
      filterlink += '{{ route('front.singlebrands', ['slug' => $slug, 'lang' => $slang]) }}' + '?' + encodeURIComponent($("#min_price").attr('name')) + '=' + encodeURIComponent($("#min_price").val());
    } else {
      filterlink += '&' + encodeURIComponent($("#min_price").attr('name')) + '=' + encodeURIComponent($("#min_price").val());
    }
  }

  if ($("#max_price").val() != '') {
    if (filterlink == '') {
      filterlink += '{{ route('front.singlebrands', ['slug' => $slug, 'lang' => $slang]) }}' + '?' + encodeURIComponent($("#max_price").attr('name')) + '=' + encodeURIComponent($("#max_price").val());
    } else {
      filterlink += '&' + encodeURIComponent($("#max_price").attr('name')) + '=' + encodeURIComponent($("#max_price").val());
    }
  }

  // console.log(filterlink);
  console.log(encodeURI(filterlink));
  $("#ajaxContent").load(encodeURI(filterlink), function (data) {
    // add query string to pagination
    addToPagination();
    $("#ajaxLoader").fadeOut(1000);
  });
}

//   // append parameters to pagination links
  function addToPagination() {
    // add to attributes in pagination links
    $('ul.pagination li a').each(function() {
      let url = $(this).attr('href');
      let queryString = '?' + url.split('?')[1]; // "?page=1234...."

      let urlParams = new URLSearchParams(queryString);
      let page = urlParams.get('page'); // value of 'page' parameter

      let fullUrl = '{{ route('front.singlebrands', ['slug' => $slug, 'lang' => $slang]) }}?page='+page+'&slug='+'{{ $slug }}'+'&search='+'{{request()->input('search')}}';

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