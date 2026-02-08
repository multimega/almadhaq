<!DOCTYPE html>
<html lang="en" dir="@if($langg->rtl != '1') ltr @else rtl @endif" class="@if($langg->rtl == '1') rtl @else ltr @endif">

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
        
                <meta property="og:url" content="{{ route('front.product', ['slug' => $prod->slug_ar,'lang'=> $sign]) }}">
              @else 
              <meta property="og:url" content="{{ route('front.product', ['slug' => $prod->slug,'lang'=> $sign]) }}">
              @endif 
          @else  
              @if($slang == 2) 
             <meta property="og:url" content="{{ route('front.product',['slug' => $prod->slug_ar,'lang'=> $sign]) }}">
              @else
            <meta property="og:url" content="{{ route('front.product',['slug' => $prod->slug,'lang'=> $sign]) }}">
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
        
                <meta itemprop="url" content="{{ route('front.product',['slug' => $prod->slug_ar,'lang' => $sign]) }}">
              @else 
              <meta itemprop="url" content="{{ route('front.product',['slug' => $prod->slug,'lang' => $sign]) }}">
              @endif 
          @else  
              @if($slang == 2) 
             <meta itemprop="url" content="{{ route('front.product', ['slug' => $prod->slug_ar,'lang' => $sign]) }}">
              @else
            <meta itemprop="url" content="{{ route('front.product',['slug' => $prod->slug,'lang' => $sign]) }}">
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


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">    
	<!-- favicon -->
	<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
	<!-- bootstrap -->
	
	<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{asset('assets/demo_25/assets/css/lightboxs.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	

	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">

@if($langg->rtl == "1")
        

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/plugin.rtl.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">

    <!--Updated CSS-->
 <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@else
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/demo_19/assets/css/custom.css')}}">

    <!--Updated CSS-->
 <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@endif
	<link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    #NewletterSuccessModal .modal-content{
        height: 400px;
        width: 400px;
        border-radius: 50%;
        background-image: url("https://maisonarabelle.com/assets/images/thumbnails/16584282961lUkUmH1.jpg");
        background-position: initial;
        background-repeat: no-repeat;
        background-size: cover;
        margin: auto;
        display: flex;
        align-items: center;
        flex-direction: row;
    }
    #NewletterSuccessModal.show{
        background: rgba(0,0,0,.4);
    }
    #NewletterSuccessModal .modal-body{
        overflow-y: unset;
    }
    #NewletterSuccessModal h3{
        color: #fff;
    }
    #NewletterSuccessModal p{
        color: #eee;
        font-size: 16px;
    }
    @media only screen and (max-width: 767px){
        #NewletterSuccessModal .modal-content{
            height: 300px;
            width: 300px;
        }
        
    }
    
    /* Floating Social Icons Styles */
    .floating-social-icons {
        position: fixed;
        right: 15px;
        top: 83%;
        transform: translateY(-50%);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .floating-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        position: relative;
        overflow: hidden;
    }
    
    .floating-icon:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(0,0,0,0.25);
        color: #fff;
        text-decoration: none;
    }
    
    .snapchat-icon {
        background: linear-gradient(45deg, #FFFC00, #FFE600);
        color: #000;
    }
    
    .instagram-icon {
        background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
        color: #fff;
    }
    
    .whatsapp-icon {
        background: #25D366;
        color: #fff;
    }
    
    .floating-icon i {
        font-size: 20px;
    }
    
    .floating-icon svg {
        width: 20px;
        height: 20px;
    }
    
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .floating-social-icons {
            right: 15px;
            gap: 10px;
            top: 81%;
        }
        
        .floating-icon {
            width: 45px;
            height: 45px;
        }
        
        .floating-icon i,
        .floating-icon svg {
            font-size: 18px;
            width: 18px;
            height: 18px;
        }
    }
</style>
	@yield('styles')
	
	
<!-- Snap Pixel Code -->
<script type='text/javascript'>
(function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
{a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
r.src=n;var u=t.getElementsByTagName(s)[0];
u.parentNode.insertBefore(r,u);})(window,document,
'https://sc-static.net/scevent.min.js');

snaptr('init', '69b9f581-4e2d-4f35-8239-e1eaa687531d', {});

snaptr('track', 'PAGE_VIEW');

</script>
<!-- End Snap Pixel Code -->

<!-- Snap Pixel Code -->
<script type='text/javascript'>
  (function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
  {a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
  a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
  r.src=n;var u=t.getElementsByTagName(s)[0];
  u.parentNode.insertBefore(r,u);})(window,document,
  'https://sc-static.net/scevent.min.js');
  
  snaptr('init', 'c30daa5a-58f5-4298-bb4a-9ac5dda5b379', {
  'user_email': '_INSERT_USER_EMAIL_'
  });
  
  snaptr('track', 'PAGE_VIEW');
  
  </script>
  <!-- End Snap Pixel Code -->
</head>
<script src="{{asset('assets/front/js/jquery.js')}}"></script>
<script src="{{asset('assets/front/js/lightbox.min.js')}}"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<body class="sss">

{{-- @if($gs->is_loader == 1)
	<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
@endif --}}

@if($gs->is_popup== 1)
    
    @if(isset($visited))

    <div style="display:none">
        <img src="{{asset('assets/images/'.$gs->popup_background)}}">
    </div>
    
    <!--  Starting of subscribe-pre-loader Area   -->
    <div class="subscribe-preloader-wrap" id="subscriptionForm" style="display: none;">
        <div class="newsletter-popup" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}});">
            <span class="preload-close">×</span>
            <div class="newsletter-popup-content">
                {{--<img src="{{asset('assets/images/'.$gs->logo)}}" alt="Logo" class="logo-newsletter">--}}
                <h2>{{$gs->popup_title}}</h2>
                <p>{{$gs->popup_text}}</p>
                <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
				    @csrf
                    <div class="row align-items-end">
    			        <div class="col-6">
    			            <div class="form-group">
    			                <label>{{ $langg->lang310 }}</label>
    			                <input type="text" class="form-control" name="name" placeholder="{{ $langg->lang310 }}" required>
    			            </div>
    			        </div>
    			        {{--
    			        <div class="col-6">
    			            <div class="form-group">
    			                <label>{{ $langg->lang1200 }}</label>
    			                <input type="date" class="form-control" name="newsletter-birthdate" placeholder="{{ $langg->lang1200 }}" required>
    			            </div>
    			        </div>
    			        --}}
    			        <div class="col-6">
    			            <div class="form-group">
    			                <label>{{ $langg->lang49 }}</label>
    			                <input type="email" class="form-control" id="newsletter-email" name="email" placeholder="{{ $langg->lang741 }}" required>
    			            </div>
    			        </div>
    			        <div class="col-6">
    			            <div class="form-group">
    		                    <button class="btn form-control font-weight-bold text-dark" type="submit">@if(!$slang)
                                   @if($lang->id == 2)
                                        اشترك  
                                      @else 
                                       SUBSCRIBE
                                      @endif 
                                       @else  
                                      @if($slang == 2) 
                                        اشترك 
                                      @else
                                       SUBSCRIBE
                                      @endif
                                    @endif
                                </button>
    			            </div>
    			        </div>
    			    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Ending of subscribe-pre-loader Area   -->


   
    @endif
@endif

<!-- Newsletter Modal Success -->
<div class="modal fade" id="NewletterSuccessModal" tabindex="-1" role="dialog" aria-labelledby="NewletterSuccessModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h3>Thank you for subscribing to our newsletter.</h3>
        <p>Here is your discount code: <b>NEWS10</b></p>
      </div>
    </div>
  </div>
</div>
{{--
    
	<section class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 remove-padding">
					<div class="content">
						<div class="left-content">
							<div class="list">
								
                							</div>
                						</div>
						<div class="right-content">
							<div class="list">
								<ul>
									@if(!Auth::guard('web')->check())
									<li class="login">
										<a href="{{ route('user.login') }}" class="sign-log">
											<div class="links">
												<span class="sign-in">{{ $langg->lang12 }}</span> <span>|</span>
											
											</div>
										</a>
									</li>
									
										<li class="login">
										<a href="{{ route('user-register') }}" class="sign-log">
											<div class="links">
											
												<span class="join">{{ $langg->lang13 }}</span>
											</div>
										</a>
									</li>
									@else
										<li class="profilearea my-dropdown">
											<a href="javascript: ;" id="profile-icon" class="profile carticon">
												<span class="text">
													<i class="far fa-user"></i>	{{ $langg->lang11 }} <i class="fas fa-chevron-down"></i>
												</span>
											</a>
											<div class="my-dropdown-menu profile-dropdown">
												<ul class="profile-links">
													<li>
														<a href="{{ route('user-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang221 }}</a>
													</li>
													@if(Auth::user()->IsVendor())
													<li>
														<a href="{{ route('vendor-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang222 }}</a>
													</li>
													@endif

													<li>
														<a href="{{ route('user-profile') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang205 }}</a>
													</li>

													<li>
														<a href="{{ route('user-logout') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang223 }}</a>
													</li>
												</ul>
											</div>
										</li>
									@endif


                        			@if($gs->reg_vendor == 1)
										<li>
                        				@if(Auth::check())
	                        				@if(Auth::guard('web')->user()->is_vendor == 2)
	                        					<a href="{{ route('vendor-dashboard') }}" class="sell-btn">{{ $langg->lang220 }}</a>
	                        				@else
	                        					<a href="{{ route('user-package') }}" class="sell-btn">{{ $langg->lang220 }}</a>
	                        				@endif
										</li>
                        				@else
										<li>
											<a href="javascript:;" data-toggle="modal" data-target="#vendor-login" class="sell-btn">{{ $langg->lang220 }}</a>
										</li>
										@endif
									@endif


								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
--}}
	<!-- Top Header Area End -->
    <div class="sticky-currency">
        <ul>
            @foreach(DB::table('currencies')->get() as $currency)
                <li>
                    <a class="d-flex align-items-center" href="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}>
                        
                        <img src="{{asset('assets/images/currency/'.$currency->image)}}" width="16px" height="10px">
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
                </li>
            @endforeach
        </ul>
    </div><!-- End Currency -->
   
	<!-- Logo Header Area Start -->
	<div class="sm-top-header d-flex justify-content-between align-items-center d-lg-none">
        <div class="d-flex align-items-center">
            <div class="dropdown">
              <button class="btn dropdown-toggle  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if($langg->rtl != "1") Language @else اللغة @endif
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('front.language',$lang1)}}">ENGLISH</a>
                <a class="dropdown-item" href="{{route('front.language',$lang2)}}">عربى</a>
              </div>
            </div>
            {{--
            <span class="separator"></span>
            <div class="dropdown">
              <button class="btn dropdown-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach(DB::table('currencies')->get() as $currency)
                    <a class="dropdown-item" href="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}">
                        <img src="{{asset('assets/images/currency/'.$currency->image)}}" width="16px">
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
            </div>
            --}}
        </div>
		<div class="header-icon-container">
            @if(!Auth::guard('web')->check()) 
                <a href="{{url('user/login')}}" class="header-icon wish search-color"><i class="fas fa-user"></i></a>
            @endif
    		@if(Auth::guard('web')->check())
			    <a href="{{ route('user-profile') }}" class="header-icon"><i class="far fa-user"></i></a>
			    <a href="{{ route('user-logout') }}" class="header-icon"><i class="fas fa-sign-out-alt"></i></a>
    			<a href="{{ route('user-wishlists') }}" class="header-icon wish">
    				<i class="far fa-heart"></i>
    				<span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
    			</a>
    		@else
    			<a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" class="header-icon wish">
    				<i class="far fa-heart"></i>
    				<span id="wishlist-count">0</span>
    			</a>
    		@endif
    		<a href="{{ route('product.compare',$sign) }}" class="header-icon wish compare-product">
    			<div class="icon">
    				<i class="fas fa-exchange-alt"></i>
    				<span id="compare-count">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
    			</div>
    		</a>
		</div>
    </div>
	<section class="logo-header py-3" style="background-color:#fff">
		<div class="container-fluid">
			<div class="d-flex align-items-center justify-content-between front-header">
			    <div class="header-center text-center">
                    <a href="{{route('front.index',$sign)}}" class="logo">
                        <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Alkitab Logo" style="width: 150px;">
                    </a>
                </div>
				<div class="d-flex align-items-center">
					<!--<button class="mobile-menu-toggler" type="button">-->
					<!--<i class="icon-menu"></i>-->
					<!--</button>-->
					{{--
					<div class="logo d-none d-lg-block">
						<a href="{{ route('front.index',$sign) }}">
							<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
						</a>
					</div>
					
					--}}
					<div class="remove-padding order-last order-sm-2 order-md-2">
    				    <nav hidden>
    						<div class="nav-header">
    							<button class="toggle-bar"><span class="fa fa-bars"></span></button>
    						</div>
    						<ul class="menu">
    							@if($gs->is_home == 1)
    							<li><a href="{{ route('front.index',$sign) }}">{{ $langg->lang17 }}</a></li>
    							@endif
    							<li class="position-relative show-ul"><a href="#">{{ $langg->lang14 }}</a>
    							    <ul class="hidden-ul">
    									@foreach($categories as $category)
                                            <li class="position-relative show-ul">
                                            <a class="li-ul-a" href="{{ route('front.category',['category' => $category->slug , 'lang' => $sign ]) }}"
                                                @if(count($category->subs) > 0 ) class="sf-with-ul" @endif
                                            >
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
                                            </a>
                                            @if(count($category->subs) > 0 )   
                                            <ul class="hidden-ul">
                                             @foreach($category->subs as $subcat)
        								    <li>
        									  <a class="li-ul-a" href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug ,'lang' => $sign])}}">
        
                              
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
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
    							@if($features[5]->status == 1 && $features[5]->active == 1 )
    								@foreach(DB::table('offers')->where('header','=',1)->get() as $data)
    								<li class="border-0"><a class="border-0" href="{{ route('front.offers',['slug' => $data->slug , 'lang' => $sign ]) }}"> 
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
                                        @endif</a>
                                    </li>
    							@endforeach
    							@endif
                                @if($gs->is_shop == 1)
    							 <li><a class="border-0" href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}</a></li>
    							 @endif
                                {{--
                                <li class="position-relative show-ul">
                                    <a href="#">{{ $langg->lang901 }}</a>
                                    <ul class="hidden-ul">
    				                    <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
    				                        @foreach(DB::table('pages')->where('header','=',1)->get() as $data)
    				     	             <li><a href="{{ route('front.page',['slug' => $data->slug , 'lang' => $sign ]) }}">
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
                                              @endif</a></li> 
                                              @endforeach
                                    	<li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
    							    </ul>
    							</li>
    							--}}
    							@if($gs->is_brand == 1)
						      	<li><a href="{{ route('front.brannds',$sign) }}">{{ $langg->lang236 }}</a></li>
				               @endif
                            
                             	@if($gs->is_contact == 1)
						       	<li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
							   @endif
    						</ul>
    
    					</nav>
    					
    					{{--<div class="search-box-wrapper">
    						<div class="search-box">
    							<div class="categori-container" id="catSelectForm">
    								<select name="category" id="category_select" class="categoris">
    									<option value="">{{ $langg->lang1 }}</option>
    									@foreach($categories as $data)
    									
    	                                    	@if(!$slang)
                                                  @if($lang->id == 2)
                                                  <option value="{{ $data->slug_ar }}" {{ Request::route('category') == $data->slug_ar ? 'selected' : '' }}>   {{ $data->name_ar }}</option>
                                                
                                                  @else 
                                                  <option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}>   {{ $data->name }} </option>
                                               
                                                  @endif 
                                                  @else  
                                                  @if($slang == 2) 
                                                  <option value="{{ $data->slug_ar }}" {{ Request::route('category') == $data->slug_ar ? 'selected' : '' }}>  {{ $data->name_ar }} </option>
                                                
                                                  @else
                                                  <option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}>  {{ $data->name }}  </option>
                                                
                                                  @endif
                                                   @endif
    								         	@endforeach
    							         	</select>
    							         </div>
    
    							<form id="searchForm" class="search-form" action="{{ route('front.category', ['category' => Request::route('category'),'subcategory' =>Request::route('subcategory'),'childcategory' =>Request::route('childcategory'),'lang' => $sign]) }}" method="GET">
    								@if (!empty(request()->input('sort')))
    									<input type="hidden" name="sort" value="{{ request()->input('sort') }}">
    								@endif
    								@if (!empty(request()->input('minprice')))
    									<input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
    								@endif
    								@if (!empty(request()->input('maxprice')))
    									<input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
    								@endif
    								<input type="text" id="prod_name" name="search" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" autocomplete="on">
    								<div class="autocomplete">
    								  <div id="myInputautocomplete-list" class="autocomplete-items">
    								  </div>
    								</div>
    								<button type="submit"><i class="icofont-search-1"></i></button>
    							</form>
    						</div>
    					</div>--}}
    				</div>
				</div>
				
				
				
				<div class="order-lg-last d-flex">
				    
				    <div class="d-none d-lg-flex align-items-center">
				        
						<div class="dropdown">
                          <button class="btn dropdown-toggle dropdown-toggle search-color " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-globe" style="font-size:21px"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('front.language',$lang1)}}">ENGLISH</a>
                            <a class="dropdown-item" href="{{route('front.language',$lang2)}}">عربى</a>
                          </div>
                        </div>
                        {{--
                        <span class="separator"></span>
                        <div class="dropdown">
                          <button class="btn dropdown-toggle dropdown-toggle search-color " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach(DB::table('currencies')->get() as $currency)
                                <a class="dropdown-item" href="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}">
                                    <img src="{{asset('assets/images/currency/'.$currency->image)}}" width="16px">
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
                        </div>
                        --}}
                        @if(!Auth::guard('web')->check()) 
                            <a href="{{url('user/login')}}" class="header-icon search-color  mr-3" style="font-size:21px"><i class="fas fa-user"></i></a>
                        @endif
                    </div>
					<div class="helpful-links d-flex align-items-center">
						<ul class="helpful-links-inner">
						    
						    
    						<li class="header-search header-search-popup header-search-category">
    							<a href="#" class="search-toggle search-color" role="button"><i class="fas fa-search"></i></a>
    							<form id="searchForm" action="{{ route('front.category',  [ 'category' => Request::route('category'),  'subcategory' =>Request::route('subcategory'),  'childcategory' =>Request::route('childcategory'), 'lang' =>$sign]) }}" method="GET">
									<div class="header-search-wrapper">
										<input type="search" class="form-control" name="search" id="q" placeholder="Search..." required>
										<div class="select-custom">
											<select name="category" id="category_select">
                                                <option value="">{{ $langg->lang1 }}</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->slug }}" {{ Request::route('category') == $category->slug ? 'selected' : '' }}>
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
                                                @endforeach
                                                </option>
                                                
                                            </select>
										</div><!-- End .select-custom -->
										<button class="btn bg-dark fas fa-search" type="submit"></button>
									</div><!-- End .header-search-wrapper -->
								</form>
    						</li>
						    
							<li class="my-dropdown mt-0" >
								<a href="javascript:;" class="cart carticon">
									<div class="icon">
										<i class="icofont-cart"></i>
										<span class="cart-quantity" id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
									</div>

								</a>
								
									<div class="my-dropdown-menu" id="cart-items">
									@include('load.cart')
								</div>
							</li>
						
							@if(Auth::guard('web')->check())
							<li class="wishlist d-none d-lg-inline-block">
            				  	<a href="{{ route('user-logout') }}" class="wish"><i class="fas fa-sign-out-alt"></i></a>
						    </li>
							<li class="wishlist d-none d-lg-inline-block">
            				    <a href="{{ route('user-profile') }}" class="wish"><i class="far fa-user"></i></a>
						    </li>
        				    <li class="wishlist d-none d-lg-inline-block mt-0"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang9 }}">
								<a href="{{ route('user-wishlists') }}" class="wish">
									<i class="far fa-heart"></i>
									<span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
								</a>
						    </li>
							@else
        				    <li class="wishlist d-none d-lg-inline-block mt-0"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang9 }}">
								<a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" class="wish">
									<i class="far fa-heart"></i>
									<span id="wishlist-count">0</span>
								</a>
						    </li>
							@endif
							<li class="compare d-none d-lg-inline-block mt-0"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang10 }}">
								<a href="{{ route('product.compare',$sign) }}" class="wish compare-product">
									<div class="icon">
										<i class="fas fa-exchange-alt"></i>
										<span id="compare-count">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
									</div>
								</a>
							</li>
							
							@if(Auth::guard('web')->check())
							    @if($not_fet->status == 1 && $not_fet->active == 1) 
                            	    <li class="my-dropdown mt-0"  	@if(!$slang)
                                          @if($lang->id == 2)
                                            style="margin-right: 12px;" 
                                             
                                              @endif 
                                          @else  
                                              @if($slang == 2) 
                                            style="margin-right: 12px;" 
                                             
                                              @endif
                                          @endif data-toggle="tooltip" data-placement="top" title="{{ $langg->lang808 }}">
                  
                  
                  
            								<a href="javascript:;" class="cart carticon">
            									<div class="icon">
            									<i class="fas fa-bell"></i>
            										<span class="cart-quantity" id="cart-count">{{ count(App\Models\Notifications::where('user_id', Auth::guard('web')->user()->id)->where('read_at','=',null)->get()) > 0 ? count(App\Models\Notifications::where('user_id', Auth::guard('web')->user()->id)->where('read_at','=',null)->get()) : '0' }}</span>
            									</div>
            
            								</a>
            								<div class="my-dropdown-menu" id="cart-items">
            									@include('load.notifications')
            								</div>
        							    </li>
                                        @endif
                            @endif
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Logo Header Area End -->
    {{--
	<!--Main-Menu Area Start-->
	<div class="mainmenu-area mainmenu-bb">
		<div class="container">
			<div class="row align-items-center mainmenu-area-innner">
				<div class="col-lg-3 col-md-6 categorimenu-wrapper remove-padding">
					<!--categorie menu start-->
					<div class="categories_menu">
						<div class="categories_title">
							<h2 class="categori_toggle"><i class="fa fa-bars"></i>  {{ $langg->lang14 }} <i class="fa fa-angle-down arrow-down"></i></h2>
						</div>
						<div class="categories_menu_inner">
							<ul>
								@php
								$i=1;
								@endphp
								@foreach($categories as $category)

								<li class="{{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 15 ? 'rx-child' : '' }}">
								@if(count($category->subs) > 0)
									<div class="img">
										<img src="{{ asset('assets/images/categories/'.$category->photo) }}" alt="">
									</div>
									<div class="link-area">
										<span>
		@if(!$slang)
              @if($lang->id == 2)
              <a href="{{ route('front.category',['category' => $category->slug_ar, 'lang' => $sign]) }}">
										    								<!--<option value="{{ $data->slug_ar }}" {{ Request::route('category') == $data->slug_ar ? 'selected' : '' }}> </option>-->
              {{ $category->name_ar }}
              @else 
              <a href="{{ route('front.category',['category' => $category->slug, 'lang' => $sign]) }}">
										    								<!--<option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}> </option>-->
              {{ $category->name }}
              @endif 
          @else  
              @if($slang == 2) 
              <a href="{{ route('front.category',['category' => $category->slug_ar, 'lang' => $sign]) }}">
										    								<!--<option value="{{ $data->slug_ar }}" {{ Request::route('category') == $data->slug_ar ? 'selected' : '' }}> </option>-->
              {{ $category->name_ar }}
              @else
              <a href="{{ route('front.category',['category' => $category->slug, 'lang' => $sign]) }}">
										    								<!--<option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}> </option>-->
              {{ $category->name }}
              @endif
          @endif
          </a></span>
										@if(count($category->subs) > 0)
										<a href="javascript:;">
											<i class="fa fa-angle-right" aria-hidden="true"></i>
										</a>
										@endif
									</div>

							      	@else
								
                            		  @if(!$slang)
                                          @if($lang->id == 2)
                                          	<a href="{{ route('front.category',['category' => $category->slug_ar, 'lang' => $sign]) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}">
                                          {{ $category->name_ar }}
                                          @else 
                                          	<a href="{{ route('front.category',['category' => $category->slug, 'lang' => $sign]) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}">
                                          {{ $category->name }}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          	<a href="{{ route('front.category',['category' => $category->slug_ar, 'lang' => $sign]) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}">
                                          {{ $category->name_ar }}
                                          @else
                                          	<a href="{{ route('front.category',['category' => $category->slug, 'lang' => $sign]) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}">
                                          {{ $category->name }}
                                          @endif
                                      @endif
                            									
									</a>

							        	@endif
    								   	@if(count($category->subs) > 0)
    
    									@php
    									$ck = 0;
    									foreach($category->subs as $subcat) {
    										if(count($subcat->childs) > 0) {
    											$ck = 1;
    											break;
    										}
    									}
    									@endphp
									<ul class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">
										@foreach($category->subs as $subcat)
											<li>
											
												  @if(!$slang)
                                                      @if($lang->id == 2)
                                                      	<a href="{{ route('front.subcat',['slug1' => $subcat->category->slug_ar, 'slug2' => $subcat->slug_ar,'lang' => $sign ]) }}">
                                                      {{$subcat->name_ar}}
                                                      @else 
                                                      	<a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug,'lang' => $sign ]) }}">
                                                      {{$subcat->name}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      	<a href="{{ route('front.subcat',['slug1' => $subcat->category->slug_ar, 'slug2' => $subcat->slug_ar,'lang' => $sign ]) }}">
                                                      {{$subcat->name_ar}}
                                                      @else
                                                      	<a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug,'lang' => $sign ]) }}">
                                                      {{$subcat->name}}
                                                      @endif
                                                  @endif
												    
												    </a>
												@if(count($subcat->childs) > 0)
													<div class="categorie_sub_menu">
														<ul>
															@foreach($subcat->childs as $childcat)
															<li>
													@if(!$slang)
                                                          @if($lang->id == 2)
                                                          <a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug_ar, 'slug2' => $childcat->subcategory->slug_ar, 'slug3' => $childcat->slug_ar,'lang' => $sign ]) }}">
                                                          {{$childcat->name_ar}}
                                                          @else 
                                                          <a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug,'lang' => $sign ]) }}">
                                                          {{$childcat->name}}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          <a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug_ar, 'slug2' => $childcat->subcategory->slug_ar, 'slug3' => $childcat->slug_ar,'lang' => $sign ]) }}">
                                                         {{$childcat->name_ar}}
                                                          @else
                                                          <a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug,'lang' => $sign ]) }}">
                                                          {{$childcat->name}}
                                                          @endif
                                                      @endif
				
															    
															    </a></li>
															@endforeach
														</ul>
													</div>
												@endif
											</li>
										@endforeach
									</ul>

									@endif

									</li>

									@php
									$i++;
									@endphp

									@if($i == 15)
						                <li>
						                <a href="{{ route('front.categories',$sign) }}"><i class="fas fa-plus"></i> {{ $langg->lang15 }} </a>
						                </li>
						                @break
									@endif


									@endforeach

							</ul>
						</div>
					</div>
					<!--categorie menu end-->
				</div>
				<div class="col-lg-9 col-md-6 mainmenu-wrapper remove-padding">
					<nav hidden>
						<div class="nav-header">
							<button class="toggle-bar"><span class="fa fa-bars"></span></button>
						</div>
						<ul class="menu">
							@if($gs->is_home == 1)
							<li><a href="{{ route('front.index',$sign) }}">{{ $langg->lang17 }}</a></li>
							@endif
							@if($gs->is_shop == 1)
							 <li><a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}</a></li>
							 @endif
								@if($gs->is_brand == 1)
							<li><a href="{{ route('front.brannds',$sign) }}">{{ $langg->lang806 }}</a></li>
							@endif
							<li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
							@if($gs->is_faq == 1)
							<li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
							@endif
							
							@foreach(DB::table('pages')->where('header','=',1)->get() as $data)
								<li>@if(!$slang)
                                      @if($lang->id == 2)
                                      <a href="{{ route('front.page',[ 'slug' => $data->slug_ar,'lang' => $sign ]) }}">
                                     {{ $data->title_ar }}
                                      @else 
                                      <a href="{{ route('front.page',[ 'slug' => $data->slug,'lang' => $sign ]) }}">
                                     {{ $data->title }}
                                      @endif 
                                  @else  
                                      @if($slang == 2) 
                                      <a href="{{ route('front.page',[ 'slug' => $data->slug_ar,'lang' => $sign ]) }}">
                                     {{ $data->title_ar }}
                                      @else
                                      <a href="{{ route('front.page',[ 'slug' => $data->slug,'lang' => $sign ]) }}">
                                      {{ $data->title }}
                                      @endif
                                  @endif</a></li>
							@endforeach
							@if($features[5]->status == 1 && $features[5]->active == 1 )
								@foreach(DB::table('offers')->where('header','=',1)->get() as $data)
								<li>@if(!$slang)
                                                          @if($lang->id == 2)
                                                          <a href="{{ route('front.offers',[ 'slug' => $data->slug_ar,'lang' => $sign ]) }}"> <span class="newicon" ></span>
                                                         {{ $data->name_ar }}
                                                          @else 
                                                          <a href="{{ route('front.offers',[ 'slug' => $data->slug,'lang' => $sign ]) }}"> <span class="newicon" ></span>
                                                         {{ $data->name }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          <a href="{{ route('front.offers',[ 'slug' => $data->slug_ar,'lang' => $sign ]) }}"> <span class="newicon" ></span>
                                                         {{ $data->name_ar }}
                                                          @else
                                                          <a href="{{ route('front.offers',[ 'slug' => $data->slug,'lang' => $sign ]) }}"> <span class="newicon" ></span>
                                                          {{ $data->name }}
                                                          @endif
                                                      @endif</a></li>
							@endforeach
							@endif
							
							@if($gs->is_contact == 1)
							<li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
							@endif
							<li>
								<a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn">{{ $langg->lang16 }}</a>
							</li>
						</ul>

					</nav>
				</div>
			</div>
		</div>
	</div>
	--}}
	<!--Main-Menu Area End-->

@yield('content')



@php
$main=App\Models\Generalsetting::find(1);
$chunk= App\Models\Service::get()->take(3);
$categorys=App\Models\Category::where('status',1)->get();
$ch= App\Models\Service::orderby('id','desc')->get()->take(4);
@endphp



<section class="phone-navbar">
   <nav class="navbar show-on-phone">
        <a href="{{route('front.index',$sign)}}" class="{{ Route::is('front.index') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            {{ $langg->lang17 }}
        </a>
        <!--<a href="#categories">
            <i class="fas fa-th-large"></i>
            Categories
        </a>-->
        <a href="{{ route('front.cart',$sign) }}" class="cart {{ Route::is('front.cart') ? 'active' : '' }}">
            <span class="cart-count"  id="footer-cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
            <i class="fas fa-shopping-cart"></i>
           {{ $langg->lang3 }}
        </a>
        @if(!Auth::guard('web')->check()) 
            <a href="{{url('user/login')}}" class="{{ Route::is('user.login') ? 'active' : '' }}"> 
                <i class="fas fa-user"></i>
               {{ $langg->lang11 }}
            </a>
        @endif
        @if(Auth::guard('web')->check())
            <a href="{{ route('user-profile') }}" class="{{ Route::is('user-profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
             {{ $langg->lang11 }}
            </a>
        @endif

    </nav>
</section>

<footer class="footer" style="background-color:{{$gs->footer_color}}">
	<div class="footer-middle">
		<div class="container">
			<div class="row">
			    <!--<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
			        <div class="widget-newsletter-info">
					<h5 class="widget-newsletter-title text-uppercase m-b-1 ">{{$gs->popup_title}}</h5>
					<p class="widget-newsletter-content mb-0">{{$gs->popup_text}}</p>
				</div>
				<form id="form-subscribe">
				    @csrf
				    
					<div class="footer-submit-wrapper">
					    <div class="row">
					        <div class="col-sm-12">
					            <div class="form-group">
					                <label class="">{{ $langg->lang310 }}</label>
					                <input type="text" class="form-control" name="name" placeholder="{{ $langg->lang310 }}" id="newsletter-name" required>
					                @error('name')
					                    <span class="alert-danger">{{$message}}</span>
					                @enderror
					            </div>
					        </div>
					        {{--
					        <div class="col-sm-12">
					            <div class="form-group">
					                <label class="text-white">{{ $langg->lang1200 }}</label>
					                <input type="date" class="form-control" name="birth_date" placeholder="{{ $langg->lang1200 }}" id="newsletter-birth-date" required>
					                @error('birthdate')
					                    <span class="alert-danger">{{$message}}</span>
					                @enderror
					            </div>
					        </div>
					        --}}
					        <div class="col-sm-12">
					            <div class="form-group">
					                <label class="text-white">{{ $langg->lang49 }}</label>
					                <input type="email" class="form-control" id="newsletter-email" name="email" placeholder="{{ $langg->lang741 }}" required>
					                @error('email')
					                    <span class="alert-danger">{{$message}}</span>
					                @enderror
					            </div>
					        </div>
					        <div class="col-sm-12">
					            <div class="form-group">
				                    <button class="btn form-control font-weight-bold text-dark bg-white" type="submit">@if(!$slang)
                                       @if($lang->id == 2)
                                            اشترك  
                                          @else 
                                           SUBSCRIBE
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            اشترك 
                                          @else
                                           SUBSCRIBE
                                          @endif
                                        @endif
                                    </button>
					            </div>
					        </div>
					    </div>
					</div>
				</form>
			    </div>-->
				<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="widget">
						<h4 class="widget-title">@if($langg->rtl != "1") CONTACT INFO @else  معلومات التواصل  @endif</h4>

						<div class="row">
							<div class="col-sm-12">
								<div class="contact-widget">
									<h4 class="widget-title">{{$langg->lang155}}:</h4>
									<p>
									    @if(!$slang)
                                          @if($lang->id == 2)
                                          {{ $gs->address_ar }}
                                          @else 
                                          {{ $gs->address }}
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                          {{ $gs->address_ar }}
                                          @else
                                          {{ $gs->address }} 
                                          @endif
                                           @endif
									</p>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="contact-widget email">
									<h4 class="widget-title">{{$langg->lang209}}</h4>
									<a href="mailto:{{$main->email }}"><p>{{$main->email }}</p></a>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="contact-widget">
									<h4 class="widget-title">{{$langg->lang210}}</h4>
									<a href="tel:{{$main->phone }}" class="dir-ltr"><p>{{$main->phone }}</p></a>
								</div>
							</div>
							<!--<div class="col-sm-12">
								<div class="contact-widget">
									<h4 class="widget-title">WORKING DAYS/HOURS</h4>
									<a href="#">Mon - Sun / 9:00 AM - 8:00 PM</a>
								</div>
							</div>-->
						</div>
						<div class="row">
						    				<div class="social-icons">
	                            @if(App\Models\Socialsetting::find(1)->f_status == 1)
                             
                                <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon facebook-color" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                             
                              @endif

                              @if(App\Models\Socialsetting::find(1)->g_status == 1)
                             
                                <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="social-icon" target="_blank">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                             
                              @endif

                              @if(App\Models\Socialsetting::find(1)->t_status == 1)
                            
                                <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon twitter-color" target="_blank">
									<img src="{{asset("assets/images/x-twitter.svg")}}" alt="...">
                                </a>
                        
                              @endif

                              @if(App\Models\Socialsetting::find(1)->l_status == 1)
                             
                                <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                             
                              @endif

                              @if(App\Models\Socialsetting::find(1)->d_status == 1)
                            
                                <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon" target="_blank">
                                    <!--<i class="fab fa-tiktok"></i>-->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="15">
                                        <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                        <path fill="#fff" d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                                </a>
                             
                              @endif
                               @if(App\Models\Socialsetting::find(1)->i_status == 1)
                           
                                <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="social-icon insta-color" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            
                              @endif
                              
                              
                                @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                              
                               <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                            
                              @endif
	</div><!-- End .social-icons -->
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="widget">
						<h4 class="widget-title">{{$langg->lang906}}</h4>
						<ul class="links link-parts">
							<div class="link-part">
							    <li><a href="{{ route('front.faq',$sign) }}"><p>{{ $langg->lang19 }}</p></a></li>
					            <li><a href="{{ route('front.blog',$sign) }}"><p>{{ $langg->lang18 }}</p></a></li>
                                @foreach(DB::table('pages')->where('header','=',1)->get() as $data)
		     	                    <li>
	     	                            <a href="{{ route('front.page',['slug' => $data->slug , 'lang' => $sign ]) }}">
			     	                       <p> @if(!$slang)
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
                                            @endif</p>
                                        </a>
                                    </li> 
                                @endforeach
                        	    <li><a href="{{ route('front.contact',$sign) }}"><p>{{ $langg->lang20 }}</p></a></li>
							</div>
							<!--<div class="link-part col-xl-8">-->
							<!--	<li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>-->
	<!--				             <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>-->
	<!--				             <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>-->
							<!--</div>-->
						</ul>
					</div><!-- End .widget -->
				</div>
				<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
				    
					<div class="widget">
						<h4 class="widget-title">{{$langg->mainfeaturees}}</h4>
						<ul class="links link-parts">
							<div class="link-part">
								@foreach($chunk as $service )
                                
                               <p  style="margin-bottom:10px;">
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
                                  </p>
                                  @endforeach
							</div>
							<!--<div class="link-part col-xl-6">-->
							<!--	@foreach($chunk as $service)-->
            
 <!--                              <li><a href="#">-->
 <!--                                     @if(!$slang)-->
 <!--                                     @if($lang->id == 2)-->
 <!--                                       {{ $service->title_ar }}-->
 <!--                                     @else -->
 <!--                                    	{{ $service->title }}-->
 <!--                                     @endif -->
 <!--                                      @else  -->
 <!--                                     @if($slang == 2) -->
 <!--                                     	{{ $service->title_ar }}-->
 <!--                                     @else-->
 <!--                                     	{{ $service->title }}-->
 <!--                                     @endif-->
 <!--                                 @endif-->
 <!--                                 </a></li>-->
 <!--                                 @endforeach-->
							<!--</div>-->
						</ul>
					</div><!-- End .widget -->
					
					
				</div>
			</div>
		</div>
	</div>

	<div class="copy-bg" style="background-color:{{$gs->copyright_color}}">
	<div class="footer-bottom py-2">
		<div class="container d-flex align-items-center justify-content-center justify-content-lg-between flex-wrap">
			<p class="footer-copyright py-3 pr-4 mb-0">
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
			</p>

			<img src="{{ asset('assets/images/'.$main->paymentsicon)}}" alt="payment" style="max-width: 400px" />
		</div>
	</div>
	</div>
</footer>

{{--
	<!-- Footer Area Start -->
	<footer class="footer" id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-4">
					<div class="footer-info-area">
						<div class="footer-logo">
							<a href="{{ route('front.index',$sign) }}" class="logo-link">
								<img src="{{asset('assets/images/'.$gs->footer_logo)}}" alt="">
							</a>
						</div>
						<div class="text">
							<p>@if(!$slang)
              @if($lang->id == 2)
             {!! $gs->footer_ar !!}
              @else 
             {!! $gs->footer !!}
              @endif 
          @else  
              @if($slang == 2) 
              {!! $gs->footer_ar !!}
              @else
             {!! $gs->footer !!}
              @endif
          @endif
									
							</p>
						</div>
					</div>
					<div class="fotter-social-links">
						<ul>

                               	     @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                      </li>
                                      @endif
                                      
                                       @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                                       <li>
                                       <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                                       </li>
                                      @endif
                                      

                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon" target="_blank">
                                            <!--<i class="fab fa-tiktok"></i>-->
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="15">
                                                <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                                <path fill="#fff" d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                                        </a>
                                      </li>
                                      @endif
                                      @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="instagram" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                      </li>
                                      @endif

						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="footer-widget info-link-widget">
						<h4 class="title">
								{{ $langg->lang21 }}
						</h4>
						<ul class="link-list">
					    
							<li>
								<a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn"><i class="fas fa-angle-double-right"></i>{{ $langg->lang16 }}</a>
							</li>
							<li>
								<a href="{{ route('front.index',$sign) }}">
									<i class="fas fa-angle-double-right"></i>{{ $langg->lang22 }}
								</a>
							</li>
                            
		                    <li>
		                        <a href="{{ route('front.blog',$sign) }}"><i class="fas fa-angle-double-right"></i>{{ $langg->lang18 }}</a>
	                        </li>
							@foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
							<li>
								@if(!$slang)
                                      @if($lang->id == 2)
                                      <a href="{{ route('front.page',[ 'slug' => $data->slug_ar,'lang' => $sign ]) }}">
                        									<i class="fas fa-angle-double-right"></i>
                                    {{ $data->title_ar }}
                                      @else 
                                      <a href="{{ route('front.page',[ 'slug' => $data->slug,'lang' => $sign ]) }}">
                        									<i class="fas fa-angle-double-right"></i>
                                     {{ $data->title }}
                                      @endif 
                                  @else  
                                      @if($slang == 2) 
                                      <a href="{{ route('front.page',[ 'slug' => $data->slug_ar,'lang' => $sign ]) }}">
                        									<i class="fas fa-angle-double-right"></i>
                                     {{ $data->title_ar }}
                                      @else
                                      <a href="{{ route('front.page',[ 'slug' => $data->slug,'lang' => $sign ]) }}">
                        									<i class="fas fa-angle-double-right"></i>
                                     {{ $data->title }}
                                      @endif
                                  @endif
								</a>
							</li>
							@endforeach

							<li>
								<a href="{{ route('front.contact',$sign) }}">
									<i class="fas fa-angle-double-right"></i>{{ $langg->lang23 }}
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">
							{{ $langg->lang24 }}
						</h4>
						<ul class="post-list">
							@foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(3)->get() as $blog)
							<li>
								<div class="post">
								  <div class="post-img">
									<img style="width: 73px; height: 59px;" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
								  </div>
								  <div class="post-details">
									<a href="{{ route('front.blogshow',[ 'id' =>$blog->id ,'lang' => $sign ]) }}">
										<h4 class="post-title">
										@if(!$slang)
                                          @if($lang->id == 2)
                                        {{strlen($blog->title_ar) > 100 ? substr($blog->title_ar,0,100)." .." : $blog->title_ar}}
                                          @else 
                                         {{strlen($blog->title) > 45 ? substr($blog->title,0,45)." .." : $blog->title}}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {{strlen($blog->title_ar) > 100 ? substr($blog->title_ar,0,100)." .." : $blog->title_ar}}
                                          @else
                                        {{strlen($blog->title) > 45 ? substr($blog->title,0,45)." .." : $blog->title}}
                                          @endif
                                      @endif	
										</h4>
									</a>
									<p class="date">
										{{ date('M d - Y',(strtotime($blog->created_at))) }}
									</p>
								  </div>
								</div>
							  </li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="copy-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
							<div class="content">
								<div class="content">
									<p>@if(!$slang)
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
                                      @endif</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Area End -->
--}}
	<!-- Back to Top Start -->
	<div class="bottomtotop">
		<i class="fas fa-chevron-right" style="margin-bottom: -40px;"></i>
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
											<input type="email" name="email" placeholder="{{ $langg->lang173 }}"
												required="">
											<i class="icofont-user-alt-5"></i>
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
				                <input type="email" name="email" placeholder="{{ $langg->lang173 }}" required="">
				                <i class="icofont-user-alt-5"></i>
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
		<div class="modal-dialog quickview-modal  modal-dialog-centered modal-lg" role="document">
		  <div class="modal-content">
		   @if($gs->is_loader)
			<div class="submit-loader">
				<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
			</div>
			@endif
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
                        <!-- dhdfhdfh-->
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
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
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
	<!-- jquery -->
	<script src="{{asset('assets/front/js/jquery.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
	{{-- <script src="{{asset('assets/front/js/vue.js')}}"></script> --}}
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- popper -->
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
    <script>
       /* $(document).on("click", ".quick-view", function () {
      var $this = $("#quickview");
        var $this = $(this);
      console.log(1);
       $this.find(".modal-header").hide();
       $this.find(".modal-body").hide();
      $this.find(".modal-content").css("border", "none");
      $(".submit-loader").show();
      $(".quick-view-modal").load(
        $(".submit-loader").hide();
              $this.find(".modal-header").show();
              $this.find(".modal-body").show();
              $this.find(".modal-content").css("border", "1px solid #00000033");
              $(".quick-all-slider").owlCarousel({
                loop: true,
                dots: false,
                nav: true,
                navText: [
                  "<i class='fa fa-angle-left'></i>",
                  "<i class='fa fa-angle-right'></i>",
                ],
                margin: 0,
                autoplay: false,
                items: 4,
                autoplayTimeout: 6000,
                smartSpeed: 1000,
                responsive: {
                  0: {
                    items: 4,
                  },
                  768: {
                    items: 4,
                  },
                },
              });
      );

      return false;
    });*/

	 $(document).ready(function(){
	     $('form#form-subscribe').submit(function(event){
	       console.log("Test")
	        event.preventDefault();
	        let sub_name = $('input#newsletter-name').val();
	        let sub_email  = $('input#newsletter-email').val();
	        let sub_birth_date = $('input#newsletter-birth-date').val();
	         
	         $.ajax({
	             type: "POST",
	             url: "{{route('front.subscribe')}}",
	             data: {
	                 name : sub_name,
	                 birth_date: sub_birth_date,
	                 email: sub_email,
	                 _token: "{{csrf_token()}}"
	             },
	             success: function(response) {
	               if(response.errors){
	                   if(response.errors.email){
	                       toastr.error(response.errors.email[0]);
	                   }
	                   
	                   if(response.errors.name){
	                       toastr.error(response.errors.name[0]);
	                   }
	                   
	                   if(response.errors.birth_date){
	                       toastr.error(response.errors.birth_date[0]);
	                   }
	               }else {
	                   $("#NewletterSuccessModal").modal('show');
	                   //toastr.success(response.msg);
	                   $('form#form-subscribe').trigger('reset');
	               }
	               
	                
	             }
	         });
	     });
	     
	 });
        $(".search-toggle").click(function (e) {
            if($(this).hasClass("show")){
                $(this).removeClass("show");
                $(".header-search-wrapper").removeClass("show");
                $(".header-search").removeClass("show");
            }else{
                $(this).addClass("show");
                $(".header-search-wrapper").addClass("show");
                $(".header-search").addClass("show");
            }
            e.stopPropagation()
        })
        
        $(document).on("click", function(e) {
            if($(".search-toggle").hasClass("show")){
                if ($(e.target).is(".header-search-wrapper *") === false ) {
                    console.log($(e.target))
                    $(".search-toggle").removeClass("show");
                    $(".header-search-wrapper").removeClass("show");
                    $(".header-search").removeClass("show");
                }
            }
        });
        
        $(document).ready(function() {
      $('#carouselExampleIndicators').carousel({
        interval: 2000
      });
});
    </script>
    
    <script>
  // Add to Cart Event
  function snapAddToCart({
    price,
    currency,
    item_ids,
    item_category,
    number_items,
    uuid_c1,
    user_email,
    user_phone_number,
    user_hashed_email,
    user_hashed_phone_number,
    firstname,
    lastname,
    geo_city,
    geo_region
  }) {
    snaptr('track', 'ADD_CART', {
      price,
      currency,
      item_ids,
      item_category,
      number_items,
      uuid_c1,
      user_email,
      user_phone_number,
      user_hashed_email,
      user_hashed_phone_number,
      firstname,
      lastname,
      geo_city,
      geo_region
    });
  }

  // Add to Wishlist Event
  function snapAddToWishlist({
    item_ids,
    item_category,
    number_items,
    uuid_c1,
    user_email,
    user_phone_number,
    user_hashed_email,
    user_hashed_phone_number
  }) {
    snaptr('track', 'ADD_TO_WISHLIST', {
      item_ids,
      item_category,
      number_items,
      uuid_c1,
      user_email,
      user_phone_number,
      user_hashed_email,
      user_hashed_phone_number
    });
  }

  // Purchase Event
  function snapPurchase({
    price,
    currency,
    transaction_id,
    item_ids,
    item_category,
    number_items,
    uuid_c1,
    user_email,
    user_phone_number,
    user_hashed_email,
    user_hashed_phone_number
  }) {
    snaptr('track', 'PURCHASE', {
      price,
      currency,
      transaction_id,
      item_ids,
      item_category,
      number_items,
      uuid_c1,
      user_email,
      user_phone_number,
      user_hashed_email,
      user_hashed_phone_number
    });
  }

  // Sign Up Event
  function snapSignUp({
    sign_up_method,
    uuid_c1,
    user_email,
    user_phone_number,
    user_hashed_email,
    user_hashed_phone_number
  }) {
    snaptr('track', 'SIGN_UP', {
      sign_up_method,
      uuid_c1,
      user_email,
      user_phone_number,
      user_hashed_email,
      user_hashed_phone_number
    });
  }
  
</script>

    <!-- Floating Social Icons -->
    <div class="floating-social-icons">
        @if(App\Models\Socialsetting::find(1)->d_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="floating-icon snapchat-icon" target="_blank" title="Snapchat">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20">
                <path fill="#000" d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/>
            </svg>
        </a>
        @endif
        
        @if(App\Models\Socialsetting::find(1)->i_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="floating-icon instagram-icon" target="_blank" title="Instagram">
            <i class="fab fa-instagram"></i>
        </a>
        @endif
        
        <a href="https://wa.me/{{$main->phone }}" class="floating-icon whatsapp-icon" target="_blank" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    <!-- End Floating Social Icons -->

</body>

</html>