<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	@php 

   $slang = Session::get('language');
   $lang  = DB::table('languages')->where('is_default','=',1)->first();
   $features= App\Models\Feature::all();
   $not_fet = App\Models\Feature::where(['name'=>'Notifications'])->first();
   $Pagesetting = App\Models\Pagesetting::find(1);
   $ps = App\Models\Pagesetting::find(1);

@endphp



    @if(isset($seo->title) )  


  
          <title>	@if(!$slang)
              @if($lang->id == 2)
             {!!substr($seo->title_ar, 0,50)."-"!!}
              @else 
             {{substr($seo->title, 0,50)}}
              @endif 
          @else  
              @if($slang == 2) 
              {!!substr($seo->title_ar, 0,50)!!}
              @else
              {{substr($seo->title, 0,11)}}
              @endif
          @endif</title>

@endif



@if(isset($seo->meta_keys))  


        @if(!$slang)
              @if($lang->id == 2)
             <meta name="keywords" content="{!! $seo->meta_keys_ar !!}">
              @else 
             <meta name="keywords" content="{{ $seo->meta_keys }}">
              @endif 
          @else  
              @if($slang == 2) 
             <meta name="keywords" content="{!! $seo->meta_keys_ar !!}">
              @else
              <meta name="keywords" content="{{ $seo->meta_keys }}">
              @endif
          @endif
         

@endif


@if(isset($seo->meta_description))  


        @if(!$slang)
              @if($lang->id == 2)
              <meta name="description" content="{{ $seo->meta_description_ar != null ? $seo->meta_description_ar : strip_tags($productt->description_ar) }}">
              @else 
              <meta name="description" content="{{ $seo->meta_description != null ? $seo->meta_description : strip_tags($seo->description) }}">
              @endif 
          @else  
              @if($slang == 2) 
           <meta name="description" content="{{ $seo->meta_description_ar != null ? $seo->meta_description_ar  : strip_tags($seo->meta_description_ar ) }}">
              @else
             <meta name="description" content="{{ $seo->meta_description != null ? $seo->meta_description : strip_tags($seo->description) }}">
              @endif
          @endif
         

@endif


@if(isset($seo->google_analytics))  
          
     {!! $seo->google_analytics !!}


@endif



    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
		<title>@yield('title') - @if(!$slang)
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
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
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
            
		<meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
		<meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
	    <meta property="og:title" content="{{$productt->name}}" />
	    <meta property="og:id" content="{{$productt->id}}" />
	    <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
	    <meta property="og:image" content="{{asset('assets/images/'.$productt->photo)}}" />
	    <meta name="author" content="{{$gs->title}}">
    	<title>	@if(!$slang)
              @if($lang->id == 2)
             {{substr($productt->name_ar, 0,20)."-"}}{{$gs->title_ar}}
              @else 
             {{substr($productt->name, 0,11)."-"}}{{$gs->title}}
              @endif 
          @else  
              @if($slang == 2) 
              {{substr($productt->name_ar, 0,20)."-"}}{{$gs->title_ar}}
              @else
              {{substr($productt->name, 0,11)."-"}}{{$gs->title}}
              @endif
          @endif</title>
    @else
	  
	    <meta name="+author" content="{{$gs->title}}">
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

    {!! $seo->facebook_pixel !!}
    
          	@yield('gsearch')
          <!-- Google Font -->

	<script type="text/javascript">
		WebFontConfig = {
			google: { families: [ 'Open+Sans:300,400,600,700','Poppins:300,400,500,600,700,800', 'Playfair+Display:900' ] }
		};
		(function(d) {
			var wf = d.createElement('script'), s = d.scripts[0];
			wf.src = 'assets/demo-11/assets/js/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore(wf, s);
		})(document);
	</script>



     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
	<!-- favicon -->
	<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset('assets/demo-11/assets/css/bootstrap.min.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">

	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">

@if($langg->rtl == "1")
    <link rel="stylesheet" href="{{asset('assets/demo-11/assets/css/style.min.css')}}">
	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/demo-11/assets/css/style.min-rtl.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">


  

@else

	<!-- stylesheet -->

	<link rel="stylesheet" href="{{asset('assets/demo-11/assets/css/style.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">


   

@endif

	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/demo-11/assets/css/animate.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/demo-11/assets/vendor/fontawesome-free/css/all.min.css')}}">



	@yield('styles')
<style>
     #contentContainer div a b {
        display:none;
    }
    
</style>

</head>

<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="pre-header">
                <div>
                    <div class="container">
                       {{$langg->lang941}}<small>{{$langg->lang941}}</small>
                    </div>
                    <button class="mfp-close"></button>
                </div>
            </div>

            <div class="header-top top-header">
                <div class="header-row container">
                
            
                    
                    
                    	<div class="header-left">
					    
					   @if($gs->is_language == 1)
					     
					      	<div class="header-dropdown">
							<a href="#" class="pl-0">
							    
							    
							    @if(Session::has('language'))
							    
							    @php
							   
							   
							    $llng  =  DB::table('languages')->where('id','=',Session::has('language'))->first();
							    
							    @endphp
							    
							  
							    
							    @else
							      
							         @php
							   
							   
							    $llng  =  DB::table('languages')->where('id','=',1)->first();
							    
							    @endphp
							    
							  
							    @endif
							    

							      {{ DB::table('languages')->where('id','=',Session::has('language') ? Session::get('language') : 1)->first()->language  }}
							      
							    
							    </a>
							<div class="header-menu">
								<ul>
								    
							    	@foreach(DB::table('languages')->get() as $language)
                            	
                            	   <li {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }}> 
                            	
                            	       
                            	       
                            	       <a href="{{route('front.language',$language->id)}}" > {{$language->language}}</a>
                            	   
                            	   </li>
                                  
                                 @endforeach  
								    
								
								</ul>
							</div><!-- End .header-menu -->
						</div><!-- End .header-dropown -->
						
						@endif

						<div class="header-dropdown ml-4">
						     <a href="#">
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
                                
                                                     </a>
                                            <div class="header-menu">
                                               <ul>
                                            @foreach(DB::table('currencies')->get() as $currency)
                                            <li><a href="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}"> 
                                                   
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
                                                    @endif</a></li>
                                            @endforeach
                                </ul>
                            </div><!-- End .header-menu -->
						</div><!-- End .header-dropown -->
					</div><!-- End .header-left -->
                    
                    
                    
                    <div class="header-right">
                        <div class="wel-msg text-uppercase d-none d-lg-block">
                            @if(!$slang)
                                                   @if($lang->id == 2)
                                                     {{$gs->messagee_ar}} 
                                                      @else 
                                                     {{$gs->messagee}} 
                                                      @endif 
                                                       @else  
                                                      @if($slang == 2) 
                                                     {{$gs->messagee_ar}} 
                                                      @else
                                                     {{$gs->messagee}} 
                                                      @endif
                                                    @endif
                            
                        </div>
                        <span class="separator d-none d-xl-block"></span>
                        <ul class="top-links mega-menu show-arrow d-none d-sm-inline-block">
                           
                           
                        
                            
                            	@if(!Auth::guard('web')->check())
						         
						           
						           
						            <li class="menu-item">
                                        <a class="login" href="{{ route('user.login') }}">{{ $langg->lang171 }}</a>
                                     </li>
						
					     	@else 
        						       @if(Auth::user()->IsVendor())
        						       
        						               
        						               <li class="menu-item narrow"><a href="{{ route('vendor-dashboard') }}">{{ $langg->lang11 }}</a></li>
        						               <li class="menu-item narrow"><a href="{{ route('user-logout') }}">{{ $langg->lang207 }}</a></li>
        						             
        									
        										
        							   @else
        							   
        						             
        						             
        									     <li class="menu-item narrow"><a href="{{ route('user-dashboard') }}">{{ $langg->lang11 }}</a></li>
        						                 <li class="menu-item narrow"><a href="{{ route('user-logout') }}">{{ $langg->lang207 }}</a></li>
        							   
        					
        								@endif
								
							@endif
								
								  @if(Auth::guard('web')->check())
                                
                                 
                                   	
                                   	 <li class="menu-item narrow"><a href="{{ route('user-wishlists') }}">{{ $langg->lang168 }}</a></li>
                                   	
                                 @endif 
                            
                            
                            @foreach(DB::table('pages')->where('header','=',1)->get() as $data)
								<li class="menu-item narrow">@if(!$slang)
                                                          @if($lang->id == 2)
                                                          <a href="{{ route('front.page',['slug' => $data->slug_ar, 'lang' => $sign ]) }}">
                                                         {{ $data->title_ar }}
                                                          @else 
                                                          <a href="{{ route('front.page',['slug' => $data->slug, 'lang' => $sign ]) }}">
                                                         {{ $data->title }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          <a href="{{ route('front.page',['slug' => $data->slug_ar, 'lang' => $sign ]) }}">
                                                         {{ $data->title_ar }}
                                                          @else
                                                          <a href="{{ route('front.page',['slug' => $data->slug_ar, 'lang' => $sign ]) }}">
                                                          {{ $data->title }}
                                                          @endif
                                                      @endif</a></li>
							@endforeach
                         
                            <li class="menu-item narrow"><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
                           
                         
                            
                            
                            	@if($gs->is_shop == 1)
							 <li  class="menu-item narrow"><a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}</a></li>
							 @endif
							@if($gs->is_brand == 1)
							<li  class="menu-item narrow"><a href="{{ route('front.brannds',$sign) }}">{{ $langg->lang236 }}</a></li>
							@endif
                           
                        </ul>
                        <span class="separator d-none d-xl-block"></span>
                        <div class="share-links d-none d-xl-block">
                            @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                     <a href="{{ App\Models\Socialsetting::find(1)->facebook }}"  rel="nofollow" class="social-icon share-facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                     @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                     <a href="{{ App\Models\Socialsetting::find(1)->twitter }}"  rel="nofollow" class="social-icon share-twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                                     @endif
                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}"  rel="nofollow" class="social-icon share-facebook" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                      @endif
                                      
                                       @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->instagram }}"  rel="nofollow" class="social-icon share-instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                                      @endif
                                      
                                      
                                      
                                        @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->gplus }}"  rel="nofollow" class="social-icon" target="_blank"><i class="fab fa-google-plus"></i></a>
                                      @endif
                                      
                                        @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->dribble }}"  rel="nofollow" class="social-icon" target="_blank"><i class="fab fa-dribble"></i></a>
                                      @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                        <div class="header-contact d-none d-lg-flex align-items-center pl-1 mr-lg-5 pr-xl-2">
                            <i class="icon-phone-2"></i>
                            <h6>{{ $langg->callnow }}<a href="tel:{{$main->phone}}" class="text-dark font1">+123 5678 890</a></h6>
                        </div>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                      
                      
                      
                        
                        	<a href="{{ route('front.index',$sign) }}" class="logo">
						    
						    
						    	@if(!$slang)
              @if($lang->id == 2)
            	<img src="{{asset('assets/images/'.$gs->logo_ar)}}"  width="104" height="41" alt="">
              
              @else 
             	<img src="{{asset('assets/images/'.$gs->logo)}}"   width="104" height="41" alt="">
             
              @endif 
          @else  
              @if($slang == 2) 
             	<img src="{{asset('assets/images/'.$gs->logo_ar)}}"   width="104" height="41" alt="">
              @else
             	<img src="{{asset('assets/images/'.$gs->logo)}}"  width="104" height="41" alt="">
              @endif
          @endif
						    
						
						</a>
                        
                        
                    </div><!-- End .headeer-center -->

                    <div class="header-right">
                        
                        
                        	@if(!Auth::guard('web')->check())
						         
						           <a href="{{ route('user.login') }}"  class="header-icon"><i class="icon-user-2"></i></a>
						
					     	@else 
        						       @if(Auth::user()->IsVendor())
        						       
        						                <a href="{{ route('vendor-dashboard') }}"  class="header-icon login-link"><i class="icon-user-2"></i></a>
        						             
        						             
        										<a href="{{ route('user-logout') }}"  class="header-icon login-link"><i class="fa fa-logout"></i></a>
        										
        							   @else
        							   
        							   
        							            <a href="{{ route('user-dashboard') }}"  class="header-icon login-link"><i class="icon-user-2"></i></a>
        						             
        						             
        										<a href="{{ route('user-logout') }}"  class="header-icon login-link"><i class="fa fa-logout"></i></a>
        							   
        					
        								@endif
								
							@endif
                    
                        
                        
                        
                        	  @if(Auth::guard('web')->check())
                                
                                   	<a href="{{ route('user-wishlists') }}" class="header-icon"><i class="icon-wishlist-2"></i></a>
                                   	
                                 @endif 

                        
                  
                        
                        
                        <div class="header-search header-search-popup header-search-category d-none d-sm-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                            <form id="searchForm" class="search-form" action="{{ route('front.category',  [ 'category' => Request::route('category'),  'subcategory' =>Request::route('subcategory'),  'childcategory' =>Request::route('childcategory'), 'lang' =>$sign]) }}" method="GET">
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="q" id="q" placeholder="I'm searching for..." required="">
                                    <div class="select-custom">
                                          <select id="cat" name="cat">
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
                                    <button class="btn icon-search-3" type="submit"></button>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div>
                      
                      
                           <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle dropdown-arrow" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-shopping-cart"></i>
                                
                                  <span class="cart-count" id="cart-count">	{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                            </a>
                            
                            
                            <div class="dropdown-menu" id="cart-items">
                                <div class="dropdownmenu-wrapper">
                                    
                                     @if(Session::has('cart')) 
                                    <div class="dropdown-cart-header">
                                        <span class="cart-count" id="cart-count"> {{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} Items</span>

                                       
                                        
                                        
                                         <a href="{{route('front.cart',$sign)}}" class="float-right"> {{ $langg->lang5 }} </a>
                                    </div><!-- End .dropdown-cart-header -->

                                    <div class="dropdown-cart-products">
                               
                               
                                 @foreach(Session::get('cart')->items as $product)
                                        <div class="product  cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                   	<a href="{{ route('front.product',['slug' => $product['item']['slug'] , 'lang' => $sign ]) }}">
													    @if(!$slang)
                                              @if($lang->id == 2)
                                              
                                             {!!strlen($product['item']['name_ar']) > 100 ? substr($product['item']['name_ar'],0,100).'...' : $product['item']['name_ar']!!}
                                              @else 
                                              {{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}
                                              @endif 
                                                @else  
                                              @if($slang == 2) 
                                              {!!strlen($product['item']['name_ar']) > 100 ? substr($product['item']['name_ar'],0,100).'...' : $product['item']['name_ar']!!}
                                              @else
                                             {{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}
                                              @endif
                                              @endif
													</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">1</span>
                                                     @if(!$slang)
                                                    @if($lang->id == 2)
              
              
                                                 <span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
           																	x 		<span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>
																	
                                  @else 
                                																		<span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>															x <span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
                                  @endif 
                                  
                                  @else 
                                  
                                @if($slang == 2) 
                         <span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
           																	x 		<span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>
                         @else
                    																		<span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>
        																		x <span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
                         @endif
                         
                          @endif
                                                </span>
                                            </div><!-- End .product-details -->

                                            <figure class="product-image-container">
                                             
                                                
                                                 <a href="{{ route('front.product',['slug' => $product['item']['slug'] , 'lang' => $sign ]) }}" class="product-image">
                                                    <img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="product"  width="80" height="80">
                                                </a>
                                                <a  onClick="refreshCart()" class="btn-remove icon-cancel cart-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}"  title="Remove Product"></a>
                                            </figure>
                                        </div><!-- End .product -->
                                 @endforeach
                                      
                                    </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>{{ $langg->lang6 }}:</span>

                                        <span class="cart-total-price cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                       
                                        
                                        <a href="{{route('front.checkout',$sign)}}" class="btn btn-primary btn-block">{{ $langg->lang7 }}</a>
                                        
                                    </div><!-- End .dropdown-cart-total -->
                                    
                                    @else 
									  <h3>{{ $langg->lang8 }}<h3/>
									@endif
                                </div><!-- End .dropdownmenu-wrapper -->
                            </div><!-- End .dropdown-menu -->
                        </div>
                             

                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
            
            
            

            <div class="header-bottom sticky-header">
                <div class="container">
                    <nav class="main-nav d-none d-lg-flex">
                        <div class="header-left">
                            <ul class="menu sf-arrows">
                              
                                  <li class="active"><a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a></li>
                              
                              
                                    <li>
                                    <a href="#" class="sf-with-ul">{{ $langg->lang14 }}</a>
                                   
                                                <ul>
                                                    @foreach($categories as $category)
                                                        <li>
                                                            <a href="{{ route('front.category',['category' => $category->slug ,'lang' => $sign ]) }}">
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
                                                        </li>
                                                        @endforeach
                                                </ul>
                                           
                                </li>
                                 
                                 
                                 
                              <li>
                                 <a href="#" class="sf-with-ul"> @if($langg->rtl != "1") PAGES  @else الصفحات   @endif</a>
                                 
                                   
                                   
                                     <ul>
                        
    				                    <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}    </a></li>
    				                      @foreach(DB::table('pages')->where('header','=',1)->get() as $data)
    				     	             <li><a href="{{ route('front.page',['slug' => $data->slug ,'lang' => $sign ]) }}">
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
                        </ul>
                        
                     
                 
                            </li>
                                
                                
                                
                                
                                  @if($features[5]->status == 1 && $features[5]->active == 1 )
								@foreach(DB::table('offers')->where('header','=',1)->get() as $data)
								<li><a href="{{ route('front.offers',['slug' => $data->slug ,'lang' => $sign ]) }}"> <span class="newicon" ></span>@if(!$slang)
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
                                                      @endif</a></li>
							@endforeach
							@endif
                                  
                                
                                
                                   	@if($gs->is_brand == 1)
						             	<li><a href="{{ route('front.brannds',$sign) }}">{{ $langg->lang806 }}</a></li>
					          		@endif
                               
                                   @foreach(DB::table('pages')->where('header','=',1)->get() as $data)
    				     	             <li><a href="{{ route('front.page',['slug' => $data->slug ,'lang' => $sign ]) }}">
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
                        </div>
                        <!--<div class="header-right">-->
                        <!--    <div class="menu-custom-block">-->
                        <!--        <a href="#">Special Offer!</a>-->
                                
                        <!--    </div>-->
                        <!--</div>-->
                    </nav>
                </div><!-- End .header-bottom -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->
        
<script>
    
    function refreshCart()
    {
        setInterval(function(){
        location.reload()
        }, 1000);
        
    }
</script>        