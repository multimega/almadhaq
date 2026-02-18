<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$lang1  = App\Models\Language::find(1);
$lang2  = App\Models\Language::find(2);


$features= App\Models\Feature::all();
$not_fet = App\Models\Feature::where(['name'=>'Notifications'])->first();
$Pagesetting = App\Models\Pagesetting::find(1);
$categorys=App\Models\Category::get();
$ps = App\Models\Pagesetting::find(1);
  
$pro_id=  App\Models\OfferProduct::get()->pluck('product_id');
$prods = App\Models\Product::whereIn('id',$pro_id)->get();

  if (Session::has('currency')) {
        
              $curr =  App\Models\Currency::find(Session::get('currency'));
        
             }else {
    
                $curr =  App\Models\Currency::where('is_default','=',1)->first();
}

@endphp


 

    @if(isset($brand))
          @yield('brand')
          @endif


    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
		<title>  @if(!$slang)
              @if($lang->id == 2)
             {{$gs->title_ar}}
              @else 
              {{$gs->title}}
              @endif 
          @else  
              @if($slang == 2) 
              {{$gs->title_ar}}
              @else
              {{$gs->title}}
              @endif
          @endif</title>
          
      @elseif(isset($offers))
         @yield('offersmeta')
          
    
         
         
     @elseif(isset($cat->meta_description) || isset($cat->meta_description_ar) || isset($cat->meta_tag)  || isset($cat->tags)      || isset($cat->tags_ar) || isset($cat->name)  || isset($cat->name_ar)) 
         @yield('catmeta') 
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
          @if(!$slang)
              @if($lang->id == 2)
              <meta name="description" content="{{ $blog->meta_description_ar }}">
              @else 
              <meta name="description" content="{{ $blog->meta_description }}">
              @endif 
              @else  
              @if($slang == 2) 
               <meta name="description" content="{{ $blog->meta_description_ar }}">
              @else
               <meta name="description" content="{{ $blog->meta_description }}">
              @endif
             @endif
        
		<title>@if(!$slang)
              @if($lang->id == 2)
             {{$gs->title_ar}}
              @else 
              {{$gs->title}}
              @endif 
              @else  
              @if($slang == 2) 
              {{$gs->title_ar}}
              @else
              {{$gs->title}}
              @endif
             @endif</title>
            @elseif(isset($productt))
            
        	<title>	@if(!$slang)
              @if($lang->id == 2)
             {!!substr($productt->name_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else 
             {{substr($productt->name, 0,50)."-"}}{{$gs->title}}
              @endif 
          @else  
              @if($slang == 2) 
              {!!substr($productt->name_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else
              {{substr($productt->name, 0,50)."-"}}{{$gs->title}}
              @endif
          @endif</title>
          
          
		<meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
		
		@if(!$slang)
              @if($lang->id == 2)
       	<meta name="description" content="{{ $productt->meta_description_ar != null ? $productt->meta_description_ar : strip_tags($productt->description) }}">
              @else 
        <meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
              @endif 
          @else  
              @if($slang == 2) 
       	<meta name="description" content="{{ $productt->meta_description_ar != null ? $productt->meta_description_ar : strip_tags($productt->description) }}">
              @else
        <meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
              @endif
          @endif
          
         	@if(!$slang)
              @if($lang->id == 2)
        <meta property="og:title" content="{{$productt->title_ar}}" />
              @else 
        <meta property="og:title" content="{{$productt->title}}" />
              @endif 
          @else  
              @if($slang == 2) 
         <meta property="og:title" content="{{$productt->title_ar}}" />
              @else
       <meta property="og:title" content="{{$productt->title}}" />
              @endif
          @endif 
          
          
       
         
          	<meta property="og:image" content="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"/>
               <meta property="og:image:secure_url" content="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" />
          
         
          
           @if(isset($seo->product_analytics ))  
            
             @yield('prod_seo')
             


            @endif
          
          @if(!empty($productt->photo)) 
	    <meta property="og:image" content="{{asset('assets/images/products/'.$productt->photo)}}" />
	     <meta property="og:id" content="{{$productt->id}}" />
	    @endif
	   	@if(!$slang)
              @if($lang->id == 2)
          <meta name="author" content="{{$gs->title_ar}}">
              @else 
       <meta name="author" content="{{$gs->title}}">
              @endif 
          @else  
              @if($slang == 2) 
         <meta name="author" content="{{$gs->title_ar}}">
              @else
       <meta name="author" content="{{$gs->title}}">
              @endif
          @endif 
	  
	  
	  	@if(!$slang)
              @if($lang->id == 2)
        
                <meta property="og:url" content="{{ route('front.product_34', ['slug' => $prod->slug_ar,'lang'=> $sign]) }}">
              @else 
             <meta property="og:url" content="{{ route('front.product_34', ['slug' => $prod->slug,'lang'=> $sign]) }}">
              @endif 
          @else  
              @if($slang == 2) 
             <meta property="og:url" content="{{ route('front.product_34',['slug' => $prod->slug_ar,'lang'=> $sign]) }}">
              @endif
          @endif
   
          
          
        
           	<meta property="og:image" content="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}"/>
               <meta property="og:image:secure_url" content="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" />
          @if(!empty($productt->brand->name))
          <meta property="product:brand" content="{{$productt->brand->name}}">
          @endif
          
          @if($productt->stock>0)
          <meta property="product:availability" content="in stock">
          @else 
              <meta property="product:availability" content="Not Available">
          @endif
          
          @if(!empty($productt->product_condition))
          <meta property="product:condition" content="{{$productt->product_condition}}">
          @endif
          
           @if(!empty($productt->price))
           <meta property="product:price:amount" content="{{$productt->price}}">
           @endif
           
           
            
          
         
          
           
           
           @php
         
              if (Session::has('currency')) {
        
              $curr =  App\Models\Currency::find(Session::get('currency'));
        
             }else {
    
                $curr =  App\Models\Currency::where('is_default','=',1)->first();
            }
           @endphp
          	@if(!$slang)
              @if($lang->id == 2)
        
                 <meta property="product:price:currency" content="{{$curr->name_ar}}">
              @else 
               <meta property="product:price:currency" content="{{$curr->name}}">
              @endif 
          @else  
              @if($slang == 2) 
             <meta property="product:price:currency" content="{{$curr->name_ar}}">
              @else
          <meta property="product:price:currency" content="{{$curr->name}}">
              @endif
          @endif 
           
          
          
           <meta property="product:retailer_item_id" content="{{$productt->id}}">
         
            	@if(!$slang)
              @if($lang->id == 2)
        
        <meta property="product:item_group_id" content="{{$productt->category->name_ar}}">
              @else 
     <meta property="product:item_group_id" content="{{$productt->category->name}}">
              @endif 
          @else  
              @if($slang == 2) 
         <meta property="product:item_group_id" content="{{$productt->category->name_ar}}">
              @else
      <meta property="product:item_group_id" content="{{$productt->category->name}}">
              @endif
          @endif 
          
           
           <div itemscope itemtype="http://schema.org/Product">
               
                @if(!empty($productt->brand->name))
                 <meta  itemprop="brand" content="{{$productt->brand->name}}">
                @endif
             
             	@if(!$slang)
              @if($lang->id == 2)
        <meta itemprop="name" content="{{$productt->name_ar}}" />
              @else 
        <meta itemprop="name" content="{{$productt->name}}" />
              @endif 
          @else  
              @if($slang == 2) 
         <meta itemprop="name" content="{{$productt->name_ar}}" />
              @else
       <meta itemprop="name"  content="{{$productt->name}}" />
              @endif
          @endif 
          
          
           	@if(!$slang)
              @if($lang->id == 2)
       	<meta  itemprop="description" content="{{ $productt->meta_description_ar != null ? $productt->meta_description_ar : strip_tags($productt->description) }}">
              @else 
        <meta  itemprop="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
              @endif 
          @else  
              @if($slang == 2) 
       	<meta itemprop="description" content="{{ $productt->meta_description_ar != null ? $productt->meta_description_ar : strip_tags($productt->description) }}">
              @else
        <meta  itemprop="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
              @endif
          @endif
          
              
              <meta itemprop="productID" content="{{$productt->id}}">
              	@if(!$slang)
              @if($lang->id == 2)
        
                <meta itemprop="url" content="{{ route('front.product_34',['slug' => $prod->slug_ar,'lang' => $sign]) }}">
              @else 
              <meta itemprop="url" content="{{ route('front.product_34',['slug' => $prod->slug,'lang' => $sign]) }}">
              @endif 
          @else  
              @if($slang == 2) 
             <meta itemprop="url" content="{{ route('front.product_34', ['slug' => $prod->slug_ar,'lang' => $sign]) }}">
              @endif
          @endif
          
          
           	@if(!$slang)
              @if($lang->id == 2)
         <meta itemprop="Category" content="{{$productt->category->id}}" />
      
              @else 
         <meta itemprop="Category" content="{{$productt->category->id}}" />
              @endif 
          @else  
              @if($slang == 2) 
          <meta itemprop="Category" content="{{$productt->category->id}}" />
              @else
         <meta itemprop="Category" content="{{$productt->category->id}}" />
              @endif
          @endif 
          
          
          
          
          
         @if(!empty($productt->photo)) 
	           <meta property="og:image" content="{{asset('assets/images/'.$productt->photo)}}" />
	     @endif
            
            
             @php
   	if (!empty($prods)) {
			
			foreach ($prods as $key => $prod) {
			    
			    
		  if($prod->id == $productt->id) {	    
					
  @endphp
              
              <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
             @if($productt->stock>0)
                <link itemprop="availability" href="InStock">
            @else
                 <link itemprop="availability" href="Not Avialable">
            @endif
                <link itemprop="itemCondition" href="{{$productt->product_condition}}">
                <meta itemprop="price" content="{{$productt->price}}">
                
                	@if(!$slang)
              @if($lang->id == 2)
        
                 <meta itemprop="priceCurrency" content="{{$curr->name_ar}}">
              @else 
               <meta itemprop="priceCurrency" content="{{$curr->name}}">
              @endif 
          @else  
              @if($slang == 2) 
             <meta itemprop="priceCurrency" content="{{$curr->name_ar}}">
              @else
          <meta itemprop="priceCurrency" content="{{$curr->name}}">
              @endif
          @endif 
               
             </div>
             
             
              @php
		  }else {
		      continue;
		  }
      }
   }
  @endphp
       </div>
          
    @else
	    <meta name="keywords" content="{{ $seo->meta_keys }}">
	    <meta name="author" content="{{$gs->title}}">
		<title>	@if(!$slang)
              @if($lang->id == 2)
             {{$gs->title_ar}}
              @else 
              {{$gs->title}}
              @endif 
          @else  
              @if($slang == 2) 
              {{$gs->title_ar}}
              @else
              {{$gs->title}}
              @endif
          @endif</title>
          @endif
          
          
              @if(isset($seo->google_analytics))  
          
        {!! $seo->google_analytics !!}

  
       @endif
           <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "{{url('/')}}",
      "logo": "{{asset('assets/images/products/'.$gs->logo)}}"
    }
    </script>
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "{{$gs->title}}",
    "url": "{{url('/')}}",
    "description": "",
    "image": "{{asset('assets/images/products/'.$gs->logo)}}",
      "logo": "{{asset('assets/images/products/'.$gs->logo)}}",
      "sameAs": ["{{ App\Models\Socialsetting::find(1)->facebook }}", "{{ App\Models\Socialsetting::find(1)->twitter }}", "{{ App\Models\Socialsetting::find(1)->instagram }}"],
    "telephone": "{{$ps->phone}}",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "{{$ps->street}}",
      "addressLocality": "{{$ps->street_ar}}",
      "addressRegion": "Cairo",
      "postalCode": "11341",
      "addressCountry": "Egypt"
    }
  }
</script>


          	@yield('gsearch')
          <!-- Google Font -->
     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
	<!-- favicon -->
	<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
	<!-- bootstrap -->
	
	<!--<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">-->
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{asset('assets/demo_25/assets/css/lightboxs.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">

	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">

@if($langg->rtl == "1")

	<!-- stylesheet -->
	<!--<link rel="stylesheet" href="{{asset('assets/front/css/rtl/style.css')}}">-->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/plugin.rtl.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">

    <!--Updated CSS-->
 <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@else

	<!-- stylesheet -->
	<!--<link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">-->
	<link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">

    <!--Updated CSS-->
 <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@endif
<!-- CSS FILES -->
    <link rel="stylesheet" href="{{asset('assets/demo_34/assets/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('assets/demo_34/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/demo_34/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/demo_34/assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/demo_34/assets/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/demo_34/assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/demo_34/assets/css/xzoom.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    
    @if($langg->rtl == "1")
    
    <link rel="stylesheet" href="{{asset('assets/demo_34/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/demo_34/assets/css/style-rtl.css')}}">
    @else
        
    <link rel="stylesheet" href="{{asset('assets/demo_34/assets/css/style.css')}}">
    
       
    @endif




	@yield('styles')
<style>
     #contentContainer div a b {
        display:none;
    }
    li .categorie_sub_menu,
    .categories_menu_inner > ul > li > ul.categories_mega_menu {
        width: 210px;
    }
    .categories_menu_inner ul li ul.categories_mega_menu.open{
            padding: 0;
    }
    .categories_menu_inner > ul > li > ul.categories_mega_menu > li{
        position: relative;
        padding: 10px 15px;
        width: 100%;
    }
    .categories_menu_inner > ul > li ul.categories_mega_menu.column_1 li{
        padding: 10px 15px;
    }
    li .categorie_sub_menu{
        position: absolute;
        left: 100%;
        top: 0;
        background: #fff;
        padding: 10px 20px;
        display:none;
    }
    .categories_mega_menu.open li:hover .categorie_sub_menu{
        display: block;
    }
    .categories_menu_inner > ul > li > ul.categories_mega_menu ul li a {
        padding-left: 10px;
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }
    
</style>
</head>
<script src="{{asset('assets/front/js/jquery.js')}}"></script>
<script src="{{asset('assets/front/js/lightbox.min.js')}}"></script>
<body>

@if($gs->is_loader == 1)
	<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
@endif

@if($gs->is_popup== 1)

@if(isset($visited))
    <div style="display:none">
        <img src="{{asset('assets/images/'.$gs->popup_background)}}">
    </div>

    <!--  Starting of subscribe-pre-loader Area   -->
    <div class="subscribe-preloader-wrap" id="subscriptionForm" style="display: none;">
        <div class="subscribePreloader__thumb" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}});">
            <span class="preload-close"><i class="fas fa-times"></i></span>
            <div class="subscribePreloader__text text-center">
                <h1>{{$gs->popup_title}}</h1>
                <p>{{$gs->popup_text}}</p>
                <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="email" name="email"  placeholder="{{ $langg->lang741 }}" required="">
                        <button id="sub-btn" type="submit">{{ $langg->lang742 }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Ending of subscribe-pre-loader Area   -->

@endif

@endif


<!-- Start Top Navbar -->

<!-- For Small Screen -->
<nav class="navbar shown-mobile-nav navbar-expand-lg d-lg-none">
    <ul class="navbar-nav mr-auto w-100">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ship-span">
                    @if(Session::has('currency'))
                       
                       @if(!$slang)
                            @if($lang->id == 2)
                              {{  DB::table('currencies')->where('id','=',Session::get('currency'))->first()->name_ar }}
                            @else 
                              {{  DB::table('currencies')->where('id','=',Session::get('currency'))->first()->name }}
                            @endif 
                       @else  
                            @if($slang == 2) 
                               {{  DB::table('currencies')->where('id','=',Session::get('currency'))->first()->name_ar }}
                            @else
                              {{  DB::table('currencies')->where('id','=',Session::get('currency'))->first()->name }}
                            @endif
                       @endif
                    @else 
                        @if(!$slang)
                           @if($lang->id == 2)
                             اختر العملة
                           @else 
                            Select Currency
                           @endif 
                        @else  
                          @if($slang == 2) 
                            اختر العملة
                          @else
                            Select Currency
                          @endif
                       @endif 
                  @endif
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    	        @foreach(DB::table('currencies')->get() as $currency)
                    <a class="dropdown-item" href="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}"> 
                       @if(!$slang)
                            @if($lang->id == 2)
                              {{$currency->name_ar}}
                            @else 
                              {{$currency->name}}
                            @endif 
                        @else  
                            @if($slang == 2) 
                              {{$currency->name_ar}}
                            @else
                              {{$currency->name}}
                            @endif
                        @endif
                    </a>
                @endforeach
            </div>
        </li>
        
        @if($gs->is_language == 1)
        <li class="nav-item dropdown">
            <img src="{{asset('assets/demo_34/assets/images/flags/egypt.svg')}}">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!--<span class="d-inline-block mx-1">Ship to</span>-->
                <span class="">{{ DB::table('languages')->where('id','=',Session::has('language') ? Session::get('language') : 1)->first()->language  }}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('front.language',$lang1)}}" ><img src="{{asset('assets/demo_34/assets/images/flags/united_kingdom.png')}}"> ENGLISH</a>
                <a class="dropdown-item" href="{{route('front.language',$lang2)}}" ><img src="{{asset('assets/demo_34/assets/images/flags/egypt.svg')}}"> عربى</a>
            </div>
        </li>
        @endif
    </ul>
</nav>

<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand" href="{{url('/')}}">
      <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Vowalla Logo" class="w-100">
  </a>
    <ul class="navbar-nav mr-auto w-100">
        <form class="form-inline my-2 my-lg-0 flex-grow-1"  id="searchForm" action="{{ route('front.category',[ 'category' => Request::route('category'),  'subcategory' =>Request::route('subcategory'),  'childcategory' =>Request::route('childcategory'), 'lang' =>$sign]) }}" method="GET">
            @if (!empty(request()->input('sort')))
				<input type="hidden" name="sort" value="{{ request()->input('sort') }}">
			@endif
			@if (!empty(request()->input('minprice')))
				<input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
			@endif
			@if (!empty(request()->input('maxprice')))
				<input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
			@endif
            <input class="form-control mr-sm-2 flex-grow-1" id="prod_name" type="search" name="search" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" aria-label="Search" autocomplete="on">
        </form>
        <li class="nav-item dropdown d-none d-lg-flex">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ship-span">
                    @if(Session::has('currency'))
                       
                       @if(!$slang)
                            @if($lang->id == 2)
                              {{  DB::table('currencies')->where('id','=',Session::get('currency'))->first()->name_ar }}
                            @else 
                              {{  DB::table('currencies')->where('id','=',Session::get('currency'))->first()->name }}
                            @endif 
                       @else  
                            @if($slang == 2) 
                               {{  DB::table('currencies')->where('id','=',Session::get('currency'))->first()->name_ar }}
                            @else
                              {{  DB::table('currencies')->where('id','=',Session::get('currency'))->first()->name }}
                            @endif
                       @endif
                    @else 
                        @if(!$slang)
                           @if($lang->id == 2)
                             اختر العملة
                           @else 
                            Select Currency
                           @endif 
                        @else  
                          @if($slang == 2) 
                            اختر العملة
                          @else
                            Select Currency
                          @endif
                       @endif 
                  @endif
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    	        @foreach(DB::table('currencies')->get() as $currency)
                    <a class="dropdown-item" href="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}"> 
                       @if(!$slang)
                            @if($lang->id == 2)
                              {{$currency->name_ar}}
                            @else 
                              {{$currency->name}}
                            @endif 
                        @else  
                            @if($slang == 2) 
                              {{$currency->name_ar}}
                            @else
                              {{$currency->name}}
                            @endif
                        @endif
                    </a>
                @endforeach
            </div>
        </li>
        
        <li class="nav-item dropdown d-none d-lg-flex">
            <img src="{{asset('assets/demo_34/assets/images/flags/egypt.svg')}}">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ship-span">{{ DB::table('languages')->where('id','=',Session::has('language') ? Session::get('language') : 1)->first()->language  }}</span>
                <!--<br>-->
                <!--Egypt-->
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    	        <a class="dropdown-item" href="{{route('front.language',$lang1)}}" ><img src="{{asset('assets/demo_34/assets/images/flags/united_kingdom.png')}}"> ENGLISH</a>
                <a class="dropdown-item" href="{{route('front.language',$lang2)}}" ><img src="{{asset('assets/demo_34/assets/images/flags/egypt.svg')}}"> عربى</a>
            </div>
        </li>
        <li class="nav-item">
            @if(!Auth::guard('web')->check())
                <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModal"><i class="far fa-user"></i> {{ $langg->lang12 }}</a>
            @else
                <a class="nav-link" href="{{ route('user-dashboard-34') }}">{{ $langg->lang11 }}</a>
            @endif
        </li>
        @if(Auth::guard('web')->check())
        <li class="nav-item cart">
            <a href="{{ route('user-wishlists-34') }}" class="nav-link">
                <i class="far fa-heart"></i>
                <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
            </a>
        </li>
         @endif
        <li class="nav-item cart">
            <a class="nav-link" href="{{route('front.f-cart',$sign)}}"> <i class="fas fa-shopping-cart"></i>
                <span id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
            </a>
        </li>
        
        @if(Auth::guard('web')->check())
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
                    <span class="left-span-cat"><a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a></span>
                    @foreach(DB::table('pages')->where('header','=',1)->get() as $data)
                    <span class="left-span-cat"><a href="{{ route('front.page', ['slug' => $data->slug , 'lang' => $sign ]) }}">
                        @if(!$slang)
                          @if($lang->id == 2)
                         {{ $data->title_ar }}
                          @else
                         {{ $data->title }}
                          @endif 
                        @else  
                          @if($slang == 2) 
                         {{ $data->title_ar }}
                          @else
                          {{ $data->title }}
                          @endif
                        @endif
                    </a></span>
                    @endforeach
                    <span class="left-span-cat"><a href="{{ route('front.f-contact',$sign) }}">{{ $langg->lang20 }}</a></span>
                	@if($gs->is_brand == 1)
					<span class="left-span-cat"><a href="{{ route('front.f-brannds',$sign) }}">{{ $langg->lang806 }}</a></span>
					@endif
					<span class="left-span-cat"><a href="{{ route('front.f-blog',$sign) }}">{{ $langg->lang18 }}</a></span>
					@if($gs->is_faq == 1)
					<span class="left-span-cat"><a href="{{ route('front.f-faq',$sign) }}">{{ $langg->lang19 }}</a></span>
					@endif
                    
                    @if($features[5]->status == 1 && $features[5]->active == 1 )
					@foreach(DB::table('offers')->where('header','=',1)->get() as $data)
					<span class="left-span-cat">
					    <a href="{{ route('front.f-offers',['slug' => $data->slug ,'lang' => $sign]) }}">
					    @if(!$slang)
                          @if($lang->id == 2)
                            {{ $data->name_ar }}
                          @else 
                            {{ $data->name }}
                          @endif 
                        @else  
                          @if($slang == 2) 
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
                <!--        <a href="#">{{$langg->lang901}}</a>-->
                        <!-- Start Sub Category -->
                <!--        <div class="side-sub-category" id="side-sub-pages">-->
                <!--            <h3>{{$langg->lang901}}</h3>-->
                <!--            <hr class="mt-0">-->
                <!--            <div class="sub-categories">-->
                <!--                <div class="column">-->
                <!--                    <ul class="list-unstyled">-->
                <!--                        <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>-->
                <!--                        @foreach(DB::table('pages')->where('header','=',1)->get() as $data)-->
                <!--                        <li>-->
                <!--                            <a href="{{ route('front.page', ['slug' => $data->slug , 'lang' => $sign ]) }}">-->
					     	     <!--               @if(!$slang)-->
                <!--                                  @if($lang->id == 2)-->
                <!--                                 {{ $data->title_ar }}-->
                <!--                                  @else-->
                <!--                                 {{ $data->title }}-->
                <!--                                  @endif -->
                <!--                                @else  -->
                <!--                                  @if($slang == 2) -->
                <!--                                 {{ $data->title_ar }}-->
                <!--                                  @else-->
                <!--                                  {{ $data->title }}-->
                <!--                                  @endif-->
                <!--                                @endif-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        @endforeach-->
                <!--                        <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>-->
                <!--                        @if(!Auth::check())-->
                <!--                            <li><a href="{{url('user/login')}}">{{ $langg->lang12 }}</a></li>-->
                <!--                        @else-->
        							 <!--   	<li><a href="{{ route('user-logout') }}">{{ $langg->lang223 }}</a></li>-->
                <!--                        @endif-->
                                        
                <!--                        @if($features[5]->status == 1 && $features[5]->active == 1 )-->
        								<!--@foreach(DB::table('offers')->where('header','=',1)->get() as $data)-->
        								<!--<li>-->
        								<!--    <a href="{{ route('front.offers',['slug' => $data->slug ,'lang' => $sign]) }}">-->
        								<!--    @if(!$slang)-->
                <!--                              @if($lang->id == 2)-->
                <!--                                {{ $data->name_ar }}-->
                <!--                              @else -->
                <!--                                {{ $data->name }}-->
                <!--                              @endif -->
                <!--                            @else  -->
                <!--                              @if($slang == 2) -->
                <!--                                {{ $data->name_ar }}-->
                <!--                              @else-->
                <!--                                {{ $data->name }}-->
                <!--                              @endif-->
                <!--                            @endif-->
                <!--                            </a>-->
                <!--                        </li>-->
            				<!--			@endforeach-->
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
                @if(isset($categorys))
                    @foreach($categorys->where('is_featured','=',1) as $data) 
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.f-category', ['category' => $data->slug ,'lang' => $sign ]) }}" data-id="{{$data->slug}}">
                            @if(!$slang)
                              @if($lang->id == 2)
                              {{ $data->name_ar }}
                              @else 
                              {{ $data->name }}
                              @endif 
                              @else  
                              @if($slang == 2) 
                              {{ $data->name_ar }}
                              @else
                              {{ $data->name }} 
                              @endif
                            @endif
                        </a>
                        <!-- Start Mega Menu -->
                        <div class="mega-menu" id="{{$data->slug}}">
                            <div class="row">
                                <div class="col-md-2">
                                    <h5>
                                        @if(!$slang)
                                          @if($lang->id == 2)
                                          {{ $data->name_ar }}
                                          @else 
                                          {{ $data->name }}
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                          {{ $data->name_ar }}
                                          @else
                                          {{ $data->name }} 
                                          @endif
                                        @endif
                                    </h5>
                                    @if(count($data->subs) > 0 ) 
                                    <ul class="list-unstyled">
                                        @foreach($data->subs as $subcat)
                                        <li>
                                            <a  href="{{ route('front.f-subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug, 'lang' => $sign ])}}">
                                             @if(!$slang)
                                              @if($lang->id == 2)
                                                {{$subcat->name_ar}}
                                              @else 
                                               {{$subcat->name}}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                               {{$subcat->name_ar}}
                                              @else
                                               {{$subcat->name}}
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
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/drop-brand-03.png')}}">
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#">
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/drop-brand-04.png')}}">
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#">
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/drop-brand-05.png')}}">
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#">
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/drop-brand-09.png')}}">
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#">
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/drop-brand-03.png')}}">
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#">
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/drop-brand-04.png')}}">
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#">
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/drop-brand-05.png')}}">
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#">
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/drop-brand-09.png')}}">
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#">
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/drop-brand-09.png')}}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row cat-ex">
                                        <div class="col-md-7 px-1">
                                            <a href="#">
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/en_drop-01.png')}}">
                                            </a>
                                        </div>
                                        <div class="col-md-5 px-1">
                                            <a href="#">
                                                <img src="{{asset('assets/demo_34/assets/images/navigation/en_drop-02.png')}}">
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

<div class="modal fade login-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body login-form signin-form">
        <h5 class="modal-title text-center" id="exampleModalLabel">Welcome Back!</h5>
        <h3 class="text-center">Sign in to your account</h3>
        <span class="d-block text-center mb-3">Don't have an account? <a href="" class="go-to-signup-login">Sign Up</a></span>
        @include('includes.admin.form-login')
        <form  class="mloginform" action="{{ route('user.login.submit-34') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group mx-4">
                <label for="phone-login">{{ $langg->lang184 }}</label>
                <input type="tel" name="phone" class="form-control" id="phone-login" aria-describedby="phoneHelp" required>
            </div>
            <div class="form-group mx-4">
                <label for="password-login">{{ $langg->lang174 }}</label>
                <input type="password" name="password" class="form-control pass_id" id="password-login">
                <span class="pass-icon"><i class="fas fa-eye toggle-password"></i></span>
            </div>
            <div class="form-group mx-4">
                <input type="checkbox" name="remember" id="mrp" {{ old('remember') ? 'checked' : '' }}>
                <label for="mrp">{{ $langg->lang175 }}</label>
            </div>
            <a href="{{ route('user-forgot') }}" class="d-block text-center">{{ $langg->lang176 }}</a>
            <button type="submit" class="btn btn-primary">{{ $langg->lang178 }}</button>
        </form>
      </div>
      <!-- Sign up -->
      <div class="modal-body signup-modal login-form signin-form">
        <h5 class="modal-title text-center" id="exampleModalLabel">Create an account</h5>
        <span class="d-block text-center mb-3">Already have an account? <a href="" class="go-to-signup-login">Sign in</a></span>
        @include('includes.admin.form-login')
        <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
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
                <label for="exampleInputEmail1">{{ $langg->lang183 }}</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" required>
            </div>
            <div class="form-group mx-4">
                <label for="Password10">{{ $langg->lang186 }}</label>
                <input type="password" name="password" class="form-control pass_id" id="Password10" required>
                <span class="pass-icon"><i class="fas fa-eye toggle-password"></i></span>
            </div>
            <div class="form-group mx-4">
                <label for="Password10">{{ $langg->lang187 }}</label>
                <input type="password" name="password_confirmation" class="form-control pass_id" id="Password10" required>
                <span class="pass-icon"><i class="fas fa-eye toggle-password"></i></span>
            </div>
            
            @if($features[3]->status == 1 && $features[3]->active == 1 )
            <div class="form-group mx-4">
                <label for="refelar_code">{{ $langg->lang830 }}</label>
                <input type="text" name="refelar_code" class="form-control" id="refelar_code">
                <i class="icofont-code"></i>
            </div>
            @endif
            @if($gs->is_capcha == 1)

            <ul class="captcha-area">
                <li>
                  <p><img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
                      class="fas fa-sync-alt pointer refresh_code "></i></p>
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

@yield('content')


@php
$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);

@endphp
<!-- Start Footer -->
<div class="top-footer px-1 pt-4 pb-1">
  <div class="row m-0">
    <div class="col-lg-5 col-12 mb-2">
      <h4 class="m-0">We're Always Here To Help You</h4>
      <p class="m-0">Reach out to us through any of these support channels</p>  
    </div>
    <div class="col-lg-7 col-12 d-flex align-items-center mb-2">
      <div class="row w-100">
        <div class="col-md-7 d-flex align-items-center mb-2">
          <div class="top-footer-icon"><i class="far fa-envelope"></i></div>
          <a href="mailto:{{$main->email}}">
            <div class="top-footer-content">
              <h5 class="m-0">{{$langg->lang209}}</h5>
              <p class="m-0">{{$main->email}}</p>            
            </div>
          </a>
        </div>
        <div class="col-md-5 d-flex align-items-center mb-2">
          <div class="top-footer-icon"><i class="fas fa-phone-volume"></i></div>
          <a href="tel:{{$main->phone }}">
            <div class="top-footer-content">
              <h5 class="m-0">{{$langg->lang210}}</h5>
              <p class="m-0">{{$main->phone }}</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="middle-footer px-4 pt-4 pb-4">
  <div class="row">
    <div class="col-md-4 col-6">
      <h5>{{ $langg->lang11 }}</h5>
      <ul class="list-unstyled">
        <li> 
            @if(!Auth::guard('web')->check()) 
                <a href="{{url('user/login')}}">
                    {{ $langg->lang12 }} | {{ $langg->lang13 }}
                </a>
         	@else 
    	        @if(Auth::user()->IsVendor())
                    <a href="{{ route('vendor-dashboard') }}">
                        {{ $langg->lang11 }}
                    </a>
         	    @else
                    <a href="{{ route('user-dashboard-34') }}">
                        {{ $langg->lang11 }}
                    </a>
    			@endif
								
			@endif
		</li>
        <li><a href="{{ route('front.f-contact',$sign) }}">{{ $langg->lang23 }}</a></li>
      <!--  @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)-->
	     <!--   <li>-->
	    	<!--    <a href="{{ route('front.page',['slug' => $data->slug , 'lang' => $sign ]) }}">-->
    		<!--		@if(!$slang)-->
      <!--                @if($lang->id == 2)-->
      <!--                  {{ $data->title_ar }}-->
      <!--                    @else -->
      <!--                   {{ $data->title }}-->
      <!--                     @endif -->
      <!--                     @else  -->
      <!--                    @if($slang == 2) -->
      <!--                   {{ $data->title_ar }}-->
      <!--                    @else-->
      <!--                   {{ $data->title }}-->
      <!--                  @endif-->
      <!--              @endif-->
		    <!--	</a>-->
	    	<!--</li>-->
      <!-- 	@endforeach-->
      </ul>
    </div>
    <div class="col-md-4 col-6">
      <h5>{{$langg->lang906}}</h5>
      <ul class="list-unstyled">
         <li><a href="{{ route('front.f-faq',$sign) }}">{{ $langg->lang19 }}</a></li>
         <li><a href="{{ route('front.f-blog',$sign) }}">{{ $langg->lang18 }}</a></li>
         <li><a href="{{ route('front.f-contact',$sign) }}">{{ $langg->lang20 }}</a></li>
      </ul>
    </div>
    <div class="col-md-4 col-6">
      <h5>{{$langg->mainfeaturees}}</h5>
      <ul class="list-unstyled">
        @foreach($chunk as $service)
           <li>
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
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  <div class="social-links mt-3 d-md-flex justify-content-between align-content-center">
    <div class="apps mb-2">
      <h5>Download Now</h5>
      <a href="#">
        <img src="{{asset('assets/demo_34/assets/images/apps/appstore.png')}}">
      </a>
      <a href="#">
        <img src="{{asset('assets/demo_34/assets/images/apps/googleplay.jpg')}}">
      </a>
    </div>
    <div class="social-media mb-2">
      <h5>Follow us</h5>
       @if(App\Models\Socialsetting::find(1)->f_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon" target="_blank">
            <i class="fab fa-facebook-f"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->g_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" target="_blank">
            <i class="fab fa-google-plus-g"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->t_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->l_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" target="_blank">
            <i class="fab fa-linkedin-in"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->d_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" target="_blank">
            <i class="fab fa-dribbble"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->i_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->ystatus == 1)
       <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" target="_blank">
           <i class="fab fa-youtube"></i>
       </a>
      @endif
    </div>
  </div>
</div>
<div class="bottom-footer px-4 pt-4 pb-3 d-lg-flex justify-content-between align-items-center">
  <div class="copy-right justify-content-center">
      @if(!$slang)
          @if($lang->id == 2)
        {!! $gs->copyright_ar !!}
          @else 
        {!! $gs->copyright !!}
          @endif 
      @else  
          @if($slang == 2) 
         {!! $gs->copyright_ar !!}
          @else
        {!! $gs->copyright !!}
          @endif
      @endif
  </div>
  <div class="bootom-footer-img">
    <img src="{{ asset('assets/images/'.$main->paymentsicon)}}">
  </div>
  <div class="bootom-footer-links">
    <a href="#">Careers</a>
    <a href="warranty.php">Warrnty Policy</a>
    <a href="terms.php">Terms of use</a>
    <a href="terms-sale.php">Terms of sale</a>
    <a href="privacy.php">Privacy Policy</a>
  </div>
</div>
<!-- End Footer -->

	
	<!-- Back to Top Start -->
	<div class="bottomtotop">
		<i class="fas fa-chevron-right" style="margin-bottom: 44px;"></i>
	</div>
	<!-- Back to Top End -->

	<!-- LOGIN MODAL -->
	<div class="modal fade" id="comment-log-reg" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<nav class="comment-log-reg-tabmenu">
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link login active" id="nav-log-tab1" data-toggle="tab" href="#nav-log1"
								role="tab" aria-controls="nav-log" aria-selected="true">
								{{ $langg->lang197 }}
							</a>
							<a class="nav-item nav-link" id="nav-reg-tab1" data-toggle="tab" href="#nav-reg1" role="tab"
								aria-controls="nav-reg" aria-selected="false">
								{{ $langg->lang198 }}
							</a>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-log1" role="tabpanel"
							aria-labelledby="nav-log-tab1">
							<div class="login-area">
								<div class="header-area">
									<h4 class="title">{{ $langg->lang172 }}</h4>
								</div>
								<div class="login-form signin-form">
									@include('includes.admin.form-login')
									<form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
										{{ csrf_field() }}
										<div class="form-input">
											<input type="tel" name="phone" placeholder="{{ $langg->lang184 }}"
												required="">
											<i class="icofont-phone"></i>
										</div>
										<div class="form-input">
											<input type="password" class="Password" name="password"
												placeholder="{{ $langg->lang174 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>
										<div class="form-forgot-pass">
											<div class="left">
												<input type="checkbox" name="remember" id="mrp"
													{{ old('remember') ? 'checked' : '' }}>
												<label for="mrp">{{ $langg->lang175 }}</label>
											</div>
											<div class="right">
												<a href="javascript:;" id="show-forgot">
													{{ $langg->lang176 }}
												</a>
											</div>
										</div>
										<input type="hidden" name="modal" value="1">
										<input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
										<button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
										@if(App\Models\Socialsetting::find(1)->f_check == 1 ||
										App\Models\Socialsetting::find(1)->g_check == 1)
										<div class="social-area">
											<h3 class="title">{{ $langg->lang179 }}</h3>
											<p class="text">{{ $langg->lang180 }}</p>
											<ul class="social-links">
												@if(App\Models\Socialsetting::find(1)->f_check == 1)
												<li>
													<a href="{{ route('social-provider','facebook') }}">
														<i class="fab fa-facebook-f"></i>
													</a>
												</li>
												@endif
												@if(App\Models\Socialsetting::find(1)->g_check == 1)
												<li>
													<a href="{{ route('social-provider','google') }}">
														<i class="fab fa-google-plus-g"></i>
													</a>
												</li>
												@endif
											</ul>
										</div>
										@endif
									</form>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="nav-reg1" role="tabpanel" aria-labelledby="nav-reg-tab1">
							<div class="login-area signup-area">
								<div class="header-area">
									<h4 class="title">{{ $langg->lang181 }}</h4>
								</div>
								<div class="login-form signup-form">
									@include('includes.admin.form-login')
									<form class="mregisterform" action="{{route('user-register-submit')}}"
										method="POST">
										{{ csrf_field() }}

										<div class="form-input">
											<input type="text" class="User Name" name="name"
												placeholder="{{ $langg->lang182 }}" required="">
											<i class="icofont-user-alt-5"></i>
										</div>

										<div class="form-input">
											<input type="email" class="User Name" name="email"
												placeholder="{{ $langg->lang183 }}" required="">
											<i class="icofont-email"></i>
										</div>

										<div class="form-input">
											<input type="text" class="User Name" name="phone"
												placeholder="{{ $langg->lang184 }}" required="">
											<i class="icofont-phone"></i>
										</div>

									<!--	<div class="form-input">
											<input type="text" class="User Name" name="address"
												placeholder="{{ $langg->lang185 }}" required="">
											<i class="icofont-location-pin"></i>
										</div>-->

										<div class="form-input">
											<input type="password" class="Password" name="password"
												placeholder="{{ $langg->lang186 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>

										<div class="form-input">
											<input type="password" class="Password" name="password_confirmation"
												placeholder="{{ $langg->lang187 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>
                                     @if($features[3]->status == 1 && $features[3]->active == 1 )
                                            <div class="form-input">
                                            <input type="text" class="User Name" name="refelar_code" placeholder="{{ $langg->lang830 }}" >
                                            <i class="icofont-code"></i>
                                          </div>
                                          @endif

										@if($gs->is_capcha == 1)

										<ul class="captcha-area">
											<li>
												<p><img class="codeimg1"
														src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
														class="fas fa-sync-alt pointer refresh_code "></i></p>
											</li>
										</ul>

										<div class="form-input">
											<input type="text" class="Password" name="codes"
												placeholder="{{ $langg->lang51 }}" required="">
											<i class="icofont-refresh"></i>
										</div>


										@endif

										<input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
										<button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- LOGIN MODAL ENDS -->

	<!-- FORGOT MODAL -->
	<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="login-area">
						<div class="header-area forgot-passwor-area">
							<h4 class="title">{{ $langg->lang191 }} </h4>
							<p class="text">{{ $langg->lang192 }} </p>
						</div>
						<div class="login-form">
							@include('includes.admin.form-login')
							<form id="mforgotform" action="{{route('user-forgot-submit')}}" method="POST">
								{{ csrf_field() }}
								<div class="form-input">
									<input type="email" name="email" class="User Name"
										placeholder="{{ $langg->lang193 }}" required="">
									<i class="icofont-user-alt-5"></i>
								</div>
								<div class="to-login-page">
									<a href="javascript:;" id="show-login">
										{{ $langg->lang194 }}
									</a>
								</div>
								<input class="fauthdata" type="hidden" value="{{ $langg->lang195 }}">
								<button type="submit" class="submit-btn">{{ $langg->lang196 }}</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- FORGOT MODAL ENDS -->


<!-- VENDOR LOGIN MODAL -->
	<div class="modal fade" id="vendor-login" tabindex="-1" role="dialog" aria-labelledby="vendor-login-Title" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" style="transition: .5s;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<nav class="comment-log-reg-tabmenu">
					<div class="nav nav-tabs" id="nav-tab1" role="tablist">
						<a class="nav-item nav-link login active" id="nav-log-tab11" data-toggle="tab" href="#nav-log11" role="tab" aria-controls="nav-log" aria-selected="true">
							{{ $langg->lang234 }}
						</a>
						<a class="nav-item nav-link" id="nav-reg-tab11" data-toggle="tab" href="#nav-reg11" role="tab" aria-controls="nav-reg" aria-selected="false">
							{{ $langg->lang235 }}
						</a>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-log11" role="tabpanel" aria-labelledby="nav-log-tab">
				        <div class="login-area">
				          <div class="login-form signin-form">
				                @include('includes.admin.form-login')
				            <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
				              {{ csrf_field() }}
				              <div class="form-input">
				                <input type="tel" name="phone" placeholder="{{ $langg->lang184 }}" required="">
				                <i class="icofont-phone"></i>
				              </div>
				              <div class="form-input">
				                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang174 }}" required="">
				                <i class="icofont-ui-password"></i>
				              </div>
				              <div class="form-forgot-pass">
				                <div class="left">
				                  <input type="checkbox" name="remember"  id="mrp1" {{ old('remember') ? 'checked' : '' }}>
				                  <label for="mrp1">{{ $langg->lang175 }}</label>
				                </div>
				                <div class="right">
				                  <a href="javascript:;" id="show-forgot1">
				                    {{ $langg->lang176 }}
				                  </a>
				                </div>
				              </div>
				              <input type="hidden" name="modal"  value="1">
				               <input type="hidden" name="vendor"  value="1">
				              <input class="mauthdata" type="hidden"  value="{{ $langg->lang177 }}">
				              <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
					              @if(App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check == 1)
					              <div class="social-area">
					                  <h3 class="title">{{ $langg->lang179 }}</h3>
					                  <p class="text">{{ $langg->lang180 }}</p>
					                  <ul class="social-links">
					                    @if(App\Models\Socialsetting::find(1)->f_check == 1)
					                    <li>
					                      <a href="{{ route('social-provider','facebook') }}">
					                        <i class="fab fa-facebook-f"></i>
					                      </a>
					                    </li>
					                    @endif
					                    @if(App\Models\Socialsetting::find(1)->g_check == 1)
					                    <li>
					                      <a href="{{ route('social-provider','google') }}">
					                        <i class="fab fa-google-plus-g"></i>
					                      </a>
					                    </li>
					                    @endif
					                  </ul>
					              </div>
					              @endif
				            </form>
				          </div>
				        </div>
					</div>
					<div class="tab-pane fade" id="nav-reg11" role="tabpanel" aria-labelledby="nav-reg-tab">
                <div class="login-area signup-area">
                    <div class="login-form signup-form">
                       @include('includes.admin.form-login')
                        <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
                          {{ csrf_field() }}

                          <div class="row">

                          <div class="col-lg-6">
                            <div class="form-input">
                                <input type="text" class="User Name" name="name" placeholder="{{ $langg->lang182 }}" required="">
                                <i class="icofont-user-alt-5"></i>
                            	</div>
                           </div>

                           <div class="col-lg-6">
 <div class="form-input">
                                <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
                                <i class="icofont-email"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">
    <div class="form-input">
                                <input type="text" class="User Name" name="phone" placeholder="{{ $langg->lang184 }}" required="">
                                <i class="icofont-phone"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">

<div class="form-input">
                                <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
                                <i class="icofont-location-pin"></i>
                            </div>
                           	</div>

                           <div class="col-lg-6">
 <div class="form-input">
                                <input type="text" class="User Name" name="shop_name" placeholder="{{ $langg->lang238 }}" required="">
                                <i class="icofont-cart-alt"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="User Name" name="owner_name" placeholder="{{ $langg->lang239 }}" required="">
                                <i class="icofont-cart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

<div class="form-input">
                                <input type="text" class="User Name" name="shop_number" placeholder="{{ $langg->lang240 }}" required="">
                                <i class="icofont-shopping-cart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="User Name" name="shop_address" placeholder="{{ $langg->lang241 }}" required="">
                                <i class="icofont-opencart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

<div class="form-input">
                                <input type="text" class="User Name" name="reg_number" placeholder="{{ $langg->lang242 }}" required="">
                                <i class="icofont-ui-cart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="User Name" name="shop_message" placeholder="{{ $langg->lang243 }}" required="">
                                <i class="icofont-envelope"></i>
                            </div>
                           	</div>

                           <div class="col-lg-6">
  <div class="form-input">
                                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}" required="">
                                <i class="icofont-ui-password"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">
 								<div class="form-input">
                                <input type="password" class="Password" name="password_confirmation" placeholder="{{ $langg->lang187 }}" required="">
                                <i class="icofont-ui-password"></i>
                            	</div>
                           	</div>

                            @if($gs->is_capcha == 1)

<div class="col-lg-6">


                            <ul class="captcha-area">
                                <li>
                                 	<p>
                                 		<img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i>
                                 	</p>

                                </li>
                            </ul>


</div>

<div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
                                <i class="icofont-refresh"></i>

                            </div>



                          </div>

                          @endif

				            <input type="hidden" name="vendor"  value="1">
                            <input class="mprocessdata" type="hidden"  value="{{ $langg->lang188 }}">
                            <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

                           	</div>




                        </form>
                    </div>
                </div>
					</div>
				</div>
      </div>
    </div>
  </div>
</div>
<!-- VENDOR LOGIN MODAL ENDS -->

<!-- Product Quick View Modal -->

	  <div class="modal fade" id="quickview" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog quickview-modal modal-dialog-centered modal-lg" role="document">
		  <div class="modal-content">
			<div class="submit-loader">
				<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
			</div>
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<div class="container quick-view-modal">

				</div>
			</div>
		  </div>
		</div>
	  </div>
<!-- Product Quick View Modal -->

<!-- Order Tracking modal Start-->
    <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> <b>{{ $langg->lang772 }}</b> </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                        <div class="order-tracking-content">
                            <form id="track-form" class="track-form">
                                {{ csrf_field() }}
                                <input type="text" id="track-code" placeholder="{{ $langg->lang773 }}" required="">
                                <button type="submit" class="mybtn1">{{ $langg->lang774 }}</button>
                                <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                            </form>
                        </div>

                        <div>
				            <div class="submit-loader d-none">
								<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
							</div>
							<div id="track-order">

							</div>
                        </div>

            </div>
            </div>
        </div>
    </div>
<!-- Order Tracking modal End -->

<script type="text/javascript">
  var mainurl = "{{url('/'.$sign)}}";
   var mainurl2 = "{{url('/')}}";
  var gs      = {!! json_encode($gs) !!};
  var langg    = {!! json_encode($langg) !!};
  var mainurl2 = "{{url('/')}}";

</script>
<?php 
if($features[4]->status == 1 && $features[4]->active == 1 ){
?>
<script type="text/javascript">
    (function () {
        var whatsappNum = {{$Pagesetting->w_phone}}; 
        var whatsappNumToString = '"'+whatsappNum+'"';
        var options = {
            facebook: {{$Pagesetting->page_id}}, // Facebook page ID
            whatsapp: whatsappNumToString, // WhatsApp number
            call_to_action: "Message us", // Call to action
            button_color: "{{$gs->colors}}", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "facebook,whatsapp", // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();


</script>

<?php 
}
?>
	<script src="{{asset('assets/front/js/jquery.js')}}"></script>
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
	
    
    <script src="{{asset('assets/demo_34/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/demo_34/assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/demo_34/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/demo_34/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/demo_34/assets/js/xzoom.min.js')}}"></script>
    <script src="{{asset('assets/demo_34/assets/js/setup.js')}}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>   
    <script src="{{asset('assets/demo_34/assets/js/main.js')}}"></script>
    
    <!--||||||||||||||-->
    <script src="{{asset('assets/front/js/popper.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
	<!-- plugin js-->
	<script src="{{asset('assets/front/js/plugin.js')}}"></script>
	<script src="{{asset('assets/front/js/xzoom.min.js')}}"></script>
	<script src="{{asset('assets/front/js/jquery.hammer.min.js')}}"></script>
	<script src="{{asset('assets/front/js/setup.js')}}"></script>

	<script src="{{asset('assets/front/js/toastr.js')}}"></script>
	<!-- main -->
	<script src="{{asset('assets/front/js/main.js')}}"></script>
	<!-- custom -->
	<script src="{{asset('assets/front/js/custom.js')}}"></script>
  
    {!! $seo->google_analytics !!}

  @if($gs->is_talkto == 1)
    <!--Start of Tawk.to Script-->
      {!! $gs->talkto !!}
    <!--End of Tawk.to Script-->
  @endif 
  @if($gs->is_drift == 1)
    <!--Start of drift.to Script-->
      {!! $gs->drift !!}
    <!--End of drift.to Script-->
  @endif 
  @if($gs->is_messenger == 1)
    <!--Start of drift.to Script-->
      {!! $gs->messenger !!}
    <!--End of drift.to Script-->
  @endif

	@yield('scripts')
	@yield('js')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</body>

</html>