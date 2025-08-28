@extends('layouts.front')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
 $tool = DB::table('seotools')->find(1);

@endphp


@section('catmeta')

  

    @if((isset($cat->name) || isset($cat->name_ar)) && (!isset($subcat->name) && !isset($subcat->name_ar))  && (!isset($childcat->name) && !isset($childcat->name_ar)))

              <title>	@if(!$slang)
              @if($lang->id == 2)
             {!!substr($cat->name_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else 
             {{substr($cat->name, 0,50)."-"}}{{$gs->title}}
              @endif 
          @else  
              @if($slang == 2) 
              {!!substr($cat->name_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else
              {{substr($cat->name, 0,50)."-"}}{{$gs->title}}
              @endif
          @endif</title>
    @endif
    
    
   @if(isset($cat->meta_tag)) 
        <meta name="keywords" content="{{ $cat->meta_tag }}">

   @endif

    @if(isset($cat->meta_description) || isset($cat->meta_description_ar) )
          @if(!$slang)
              @if($lang->id == 2)
              @if(isset($cat->meta_description_ar))

              <meta name="description" content="{{ $cat->meta_description_ar }}">
               @endif

              @else 
              
              @if(isset($cat->meta_description))

              <meta name="description" content="{{ $cat->meta_description }}">
              @endif

              @endif 
              @else  
              @if($slang == 2) 

              @if(isset($cat->meta_description_ar))
               <meta name="description" content="{{ $cat->meta_description_ar }}">
              @endif

              @else


               @if(isset($cat->meta_description))
               <meta name="description" content="{{ $cat->meta_description }}">
               @endif


              @endif
             @endif 

   @endif
    

  @if(isset($cat->tags) ||isset($cat->tags_ar))
	  
	  
	    @if(!$slang)
              @if($lang->id == 2)
            
                @if(isset($cat->tags_ar))
	      <meta name="tag" content="{{$cat->tags_ar}}">
	     @endif
	   
              @else 
                  @if(isset($cat->tags))
                <meta name="tag" content="{{$cat->tags}}">
	       @endif
              @endif 


              @else  
                 @if($slang == 2) 

                   @if(isset($cat->tags_ar))
                 <meta name="tag" content="{{$cat->tags_ar}}">
	           @endif
              @else

                   @if(isset($cat->tags))
                   <meta name="tag" content="{{$cat->tags}}">
                    @endif
              @endif
          @endif
	   
	    @endif


    



    

         
    @if((isset($subcat->name) && isset($subcat->name_ar))  && ( isset($cat->name) || isset($cat->name_ar)) && (!isset($childcat->name) && !isset($childcat->name_ar)))

              <title>	@if(!$slang)
              @if($lang->id == 2)
             {{substr($subcat->name_ar, 0,50)."-"}}{{$gs->title_ar}}
              @else 
             {{substr($subcat->name, 0,50)."-"}}{{$gs->title}}
              @endif 
          @else  
              @if($slang == 2) 
              {!!substr($subcat->name_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else
              {{substr($subcat->name, 0,50)."-"}}{{$gs->title}}
              @endif
          @endif</title>
    @endif




      

        @if(isset($subcat->meta_tag)) 
        <meta name="keywords" content="{{ $subcat->meta_tag }}">

   @endif

    @if(isset($subcat->meta_description) || isset($subcat->meta_description_ar) )
          @if(!$slang)
              @if($lang->id == 2)
              @if(isset($subcat->meta_description_ar))

              <meta name="description" content="{{ $subcat->meta_description_ar }}">
               @endif

              @else 
              
              @if(isset($subcat->meta_description))

              <meta name="description" content="{{ $subcat->meta_description }}">
              @endif

              @endif 
              @else  
              @if($slang == 2) 

              @if(isset($subcat->meta_description_ar))
               <meta name="description" content="{{ $subcat->meta_description_ar }}">
              @endif

              @else


               @if(isset($subcat->meta_description))
               <meta name="description" content="{{ $subcat->meta_description }}">
               @endif


              @endif
             @endif 

   @endif
    

  @if(isset($subcat->tags) ||isset($subcat->tags_ar))
	  
	  
	    @if(!$slang)
              @if($lang->id == 2)
            
                @if(isset($subcat->tags_ar))
	      <meta name="tag" content="{{$subcat->tags_ar}}">
	     @endif
	   
              @else 
                  @if(isset($subcat->tags))
                <meta name="tag" content="{{$subcat->tags}}">
	       @endif
              @endif 


              @else  
                 @if($slang == 2) 

                   @if(isset($subcat->tags_ar))
                 <meta name="tag" content="{{$subcat->tags_ar}}">
	           @endif
              @else

                   @if(isset($subcat->tags))
                   <meta name="tag" content="{{$subcat->tags}}">
                    @endif
              @endif
          @endif
	   
	    @endif






   
   @if((isset($childcat->name) && isset($childcat->name_ar)) && (isset($cat->name) || isset($cat->name_ar) ) && ( isset($subcat->name) && isset($subcat->name_ar)))

              <title>	@if(!$slang)
              @if($lang->id == 2)
             {!!substr($childcat->name_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else 
             {{substr($childcat->name, 0,50)."-"}}{{$gs->title}}
              @endif 
          @else  
              @if($slang == 2) 
              {!!substr($childcat->name_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else
              {{substr($childcat->name, 0,11)."-"}}{{$gs->title}}
              @endif
          @endif</title>
    @endif



       @if(isset($childcat->meta_tag)) 
        <meta name="keywords" content="{{ $childcat->meta_tag }}">

   @endif

    @if(isset($childcat->meta_description) || isset($childcat->meta_description_ar) )
          @if(!$slang)
              @if($lang->id == 2)
              @if(isset($childcat->meta_description_ar))

              <meta name="description" content="{{ $childcat->meta_description_ar }}">
               @endif

              @else 
              
              @if(isset($childcat->meta_description))

              <meta name="description" content="{{ $childcat->meta_description }}">
              @endif

              @endif 
              @else  
              @if($slang == 2) 

              @if(isset($childcat->meta_description_ar))
               <meta name="description" content="{{ $childcat->meta_description_ar }}">
              @endif

              @else


               @if(isset($childcat->meta_description))
               <meta name="description" content="{{ $childcat->meta_description }}">
               @endif


              @endif
             @endif 

   @endif
    

  @if(isset($childcat->tags) ||isset($childcat->tags_ar))
	  
	  
	    @if(!$slang)
              @if($lang->id == 2)
            
                @if(isset($childcat->tags_ar))
	      <meta name="tag" content="{{$childcat->tags_ar}}">
	     @endif
	   
              @else 
                  @if(isset($childcat->tags))
                <meta name="tag" content="{{$childcat->tags}}">
	       @endif
              @endif 


              @else  
                 @if($slang == 2) 

                   @if(isset($childcat->tags_ar))
                 <meta name="tag" content="{{$childcat->tags_ar}}">
	           @endif
              @else

                   @if(isset($childcat->tags))
                   <meta name="tag" content="{{$childcat->tags}}">
                    @endif
              @endif
          @endif
	   
	    @endif


     @if (!empty($cat) && empty($subcat) && empty($childcat))
     @if(isset($tool->category_analytics ))  
          
            {!! $tool->category_analytics !!}


        @endif

    @endif


   
       @if (!empty($subcat) && !empty($cat) && empty($childcat))
     @if(isset($tool->subcategory_analytics ))  
          
            {!! $tool->subcategory_analytics !!}


        @endif

    @endif



  
     @if (!empty($childcat)&& !empty($subcat) && !empty($cat))
     @if(isset($tool->childcategory_analytics ))  
          
            {!! $tool->childcategory_analytics !!}


        @endif

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
                    "@id": "{{url('/')}}",
                    "name": "translation missing: en.general.breadcrumbs.home"
                } 
      }  @if (!empty($cat)),{
        "@type": "ListItem",
        "position": 2,
    
        "item": {
                    "@type": "CollectionPage",
                    "@id": "{{route('front.category',['category' => $cat->slug_ar, 'lang' => $sign])}}",
                    "name": "{{$cat->name}}"
                } 
      }@endif @if(!empty($subcat)) ,{
        "@type": "ListItem",
        "position": 3,
      
        "item": {
                    "@type": "CollectionPage",
                    "@id": "{{route('front.category',['category' => $cat->slug_ar,'subcategory' => $subcat->slug, 'lang' => $sign])}}",
                    "name": "{{$subcat->name}}"
                } 
       
      }@endif @if(!empty($childcat)) ,{
        "@type": "ListItem",
        "position": 4,
     
         "item": {
                    "@type": "CollectionPage",
                    "@id": "{{route('front.category',['category' => $cat->slug_ar,'subcategory' => $subcat->slug, 'childcategory' => $childcat->slug, 'lang' => $sign])}}",
                    "name": "{{$childcat->name}}"
                } 
      }@endif]
    }
    </script>






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
               <a href="{{route('front.category', ['category' => $cat->slug_ar, 'lang' => $sign])}}">
              {{ $cat->name_ar }}
              @else 
               <a href="{{route('front.category',['category' => $cat->slug, 'lang' => $sign])}}">
              {{ $cat->name }}
              @endif 
          @else  
              @if($slang == 2) 
               <a href="{{route('front.category',['category' => $cat->slug_ar, 'lang' => $sign])}}">
              {{ $cat->name_ar }}
              @else
               <a href="{{route('front.category', ['category' => $cat->slug, 'lang' => $sign])}}">
              {{ $cat->name }}
              @endif
          @endif</a>
               </li>
               @endif
               @if (!empty($subcat))
               <li>
                             
                  @if(!$slang)
              @if($lang->id == 2)
               <a href="{{route('front.category',['category' => $cat->slug_ar,'subcategory' => $subcat->slug_ar, 'lang' => $sign])}}"> 
              {{ $subcat->name_ar }}
              @else 
               <a href="{{route('front.category',['category' => $cat->slug,'subcategory' => $subcat->slug, 'lang' => $sign])}}"> 
              {{ $subcat->name }}
              @endif 
          @else  
              @if($slang == 2) 
               <a href="{{route('front.category', ['category' => $cat->slug_ar,'subcategory' => $subcat->slug_ar, 'lang' => $sign])}}"> 
              {{ $subcat->name_ar }}
              @else
               <a href="{{route('front.category', ['category' => $cat->slug,'subcategory' => $subcat->slug, 'lang' => $sign])}}"> 
              {{ $subcat->name }}
              @endif
          @endif</a>
               </li>
               @endif
               @if (!empty($childcat))
               <li>
                 
                                   @if(!$slang)
              @if($lang->id == 2)
               <a href="{{route('front.category', ['category' => $cat->slug_ar,'subcategory' => $subcat->slug_ar, 'childcategory' => $childcat->slug_ar, 'lang' => $sign])}}">
              {{ $childcat->name_ar }}
              @else 
               <a href="{{route('front.category', ['category' => $cat->slug ,'subcategory' => $subcat->slug, 'childcategory' => $childcat->slug, 'lang' => $sign])}}">
              {{ $childcat->name }}
              @endif 
          @else  
              @if($slang == 2) 
               <a href="{{route('front.category', ['category' => $cat->slug_ar,'subcategory' => $subcat->slug_ar, 'childcategory' => $childcat->slug_ar, 'lang' => $sign])}}">
              {{ $childcat->name_ar }}
              @else
               <a href="{{route('front.category', ['category' => $cat->slug,'subcategory' => $subcat->slug, 'childcategory' => $childcat->slug, 'lang' => $sign])}}">
              {{ $childcat->name }}
              @endif
          @endif</a>
               </li>
               @endif
               @if (empty($childcat) && empty($subcat) && empty($cat))
               <li>
                  <a href="{{route('front.category',$sign)}}">{{ $langg->lang36 }}</a>
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
             
             @if (!empty($cat) && empty($subcat) && empty($childcat))

          <div class="cat_desc">
              

                      @if(!$slang)
              @if($lang->id == 2)
                {!!$cat->details_ar!!}
              @else 
              {!!$cat->details!!}
              @endif 
          @else  
              @if($slang == 2) 
              {!!$cat->details_ar!!}
              @else
                 {!!$cat->details!!}
              @endif
          @endif

            
         </div>
 
       @endif
              


       @if (!empty($subcat) && !empty($cat) && empty($childcat))

          <div class="subcat_desc">
              

                      @if(!$slang)
              @if($lang->id == 2)
                {!!$subcat->details_ar!!}
              @else 
              {!!$subcat->details!!}
              @endif 
          @else  
              @if($slang == 2) 
              {!!$subcat->details_ar!!}
              @else
                 {!!$subcat->details!!}
              @endif
          @endif

            <br><br>
         </div>
 
@endif
     
              


 @if (!empty($childcat)&& !empty($subcat) && !empty($cat))

          <div class="childcat_desc">
              

                      @if(!$slang)
              @if($lang->id == 2)
                {!!$childcat->details_ar!!}
              @else 
              {!!$childcat->details!!}
              @endif 
          @else  
              @if($slang == 2) 
              {!!$childcat->details_ar!!}
              @else
                 {!!$childcat->details!!}
              @endif
          @endif

           <br><br>  
         </div>
    
 @endif            
   
            <div class="right-area" id="app">

               @include('includes.filter')
               <div class="categori-item-area">
                 <div class="row" id="ajaxContent">
                   @include('includes.product.filtered-products')
                 </div>
                 @if($gs->is_loader)
                 <div id="ajaxLoader" class="ajax-loader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center rgba(0,0,0,.6);"></div>
                 @endif               
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
        filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' ;
        console.log(filterlink);
      } else {
        filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
      }
    }

    // if ($("#min_price").val() != '') {
    //   if (filterlink == '') {
    //     filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$("#min_price").attr('name')+'='+$("#min_price").val();
    //   } else {
    //     filterlink += '&'+$("#min_price").attr('name')+'='+$("#min_price").val();
    //   }
    // }

    // if ($("#max_price").val() != '') {
    //   if (filterlink == '') {
    //     filterlink += '{{route('front.category', [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$("#max_price").attr('name')+'='+$("#max_price").val();
    //   } else {
    //     filterlink += '&'+$("#max_price").attr('name')+'='+$("#max_price").val();
    //   }
    // }

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

      // if ($("#min_price").val() != '') {
      //   fullUrl += '&min='+encodeURI($("#min_price").val());
      // }

      // if ($("#max_price").val() != '') {
      //   fullUrl += '&max='+encodeURI($("#max_price").val());
      // }

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