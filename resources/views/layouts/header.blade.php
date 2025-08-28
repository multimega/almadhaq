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



  
@if(isset($seo->meta_keys))  


        @if(!$slang)
              @if($lang->id == 2)
             <meta name="keywords" content="{!! $seo->meta_keys !!}">
              @else 
             <meta name="keywords" content="{{ $seo->meta_keys }}">
              @endif 
          @else  
              @if($slang == 2) 
             <meta name="keywords" content="{!! $seo->meta_keys !!}">
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
          
   

    {!! $seo->facebook_pixel !!}
    
    
    
    
    
          	@yield('gsearch')
          <!-- Google Font -->
     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
	<!-- favicon -->
	<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">

	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">

@if($langg->rtl == "1")

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/fonts/Cairo.ttf')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/custom.css')}}">
		<link rel="stylesheet" href="{{asset('assets/front/css/rtl/plugin.rtl.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">

    <!--Updated CSS-->
 <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@else

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">

    <!--Updated CSS-->
 <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@endif



	@yield('styles')
<style>
     #contentContainer div a b {
        display:none;
    }
    
</style>




</head>
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

@endif

@endif


	<section class="top-header" >
		<div class="container">
			<div class="row">
				<div class="col-lg-12 remove-padding">
					<div class="content">
						<div class="left-content">
							<div class="list">
								<ul>


									@if($gs->is_language == 1)
									<li>
										<div class="language-selector">
											<i class="fas fa-globe-americas"></i>
											<select name="language" class="language selectors nice">
										@foreach(DB::table('languages')->get() as $language)
											<option value="{{route('front.language',$language->id)}}" {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }} >{{$language->language}}</option>
										@endforeach
											</select>
										</div>
									</li>
									@endif

									@if($gs->is_currency == 1)
									<li>
										<div class="currency-selector">
								<span>{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</span>
										<select name="currency" class="currency selectors nice">
										@foreach(DB::table('currencies')->get() as $currency)
											<option value="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }} >	@if(!$slang)
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
                                                @endif</option>
            										@endforeach
            										</select>
            										</div>
            									</li>
            									@endif


                								</ul>
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
	<!-- Top Header Area End -->

	<!-- Logo Header Area Start -->
	<section class="logo-header" style="background-color:{{$gs->header_color}}">
		<div class="container">
			<div class="row ">
				<div class="col-lg-2 col-sm-6 col-5 remove-padding">
					<div class="logo">
						<a href="{{ route('front.index',$sign) }}">
						    
						    
						    	@if(!$slang)
              @if($lang->id == 2)
            	<img src="{{asset('assets/images/'.$gs->logo_ar)}}" alt="">
              
              @else 
             	<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
             
              @endif 
          @else  
              @if($slang == 2) 
             	<img src="{{asset('assets/images/'.$gs->logo_ar)}}" alt="">
              @else
             	<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
              @endif
          @endif
						    
						
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-sm-12 remove-padding order-last order-sm-2 order-md-2">
					<div class="search-box-wrapper">
						<div class="search-box">
							<div class="categori-container" id="catSelectForm">
								<select name="category" id="category_select" class="categoris">
									<option value="">{{ $langg->lang1 }}</option>
									@foreach($categories as $data)
								
	                                    	@if(!$slang)
                                              @if($lang->id == 2)
                                              	<option value="{{ $data->slug_ar }}" {{ Request::route('category') == $data->slug_ar ? 'selected' : '' }}>{{ $data->name_ar }} </option>
                                              
                                              @else 
                                              	<option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}>   {{ $data->name }}</option>
                                            
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              	<option value="{{ $data->slug_ar }}" {{ Request::route('category') == $data->slug_ar ? 'selected' : '' }}>    {{ $data->name_ar }}</option>
                                           
                                              @else
                                              	<option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}>   {{ $data->name }} </option>
                                            
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
					</div>
				</div>
				<div class="col-lg-2 col-sm-6 col-7 remove-padding order-lg-last">
					<div class="helpful-links">
						<ul class="helpful-links-inner">
							<li class="my-dropdown"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang3 }}">
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
							<li class="wishlist"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang9 }}">
								@if(Auth::guard('web')->check())
									<a href="{{ route('user-wishlists') }}" class="wish">
										<i class="far fa-heart"></i>
										<span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
									</a>
								@else
									<a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" class="wish">
										<i class="far fa-heart"></i>
										<span id="wishlist-count">0</span>
									</a>
								@endif
							</li>
							<li class="compare"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang10 }}">
								<a href="{{ route('product.compare',$sign) }}" class="wish compare-product">
									<div class="icon">
										<i class="fas fa-exchange-alt"></i>
										<span id="compare-count">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
									</div>
								</a>
							</li>
                    
                    
                    
                      
                       
                    	@if(Auth::guard('web')->check())
                    	 
                    	      @if($not_fet->status == 1  && $not_fet->active == 1)    
                            	<li class="my-dropdown" 	@if(!$slang)
              @if($lang->id == 2)
            style="margin-right: 12px;" 
             
              @endif 
          @else  
              @if($slang == 2) 
            style="margin-right: 12px;" 
             
              @endif
          @endif  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang808 }}">
          
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
										    								
              {{ $category->name_ar }}
              @else 
              <a href="{{ route('front.category',['category' => $category->slug, 'lang' => $sign]) }}">
										    								
              {{ $category->name }}
              @endif 
          @else  
              @if($slang == 2) 
              <a href="{{ route('front.category',['category' => $category->slug_ar, 'lang' => $sign]) }}">
										    								
              {{ $category->name_ar }}
              @else
              <a href="{{ route('front.category',['category' => $category->slug , 'lang' => $sign ]) }}">
                  
										    								
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
                                          <a href="{{ route('front.category',['category' => $category->slug_ar,'lang' => $sign]) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}">
                                          {{ $category->name_ar }}
                                          @else
                                          <a href="{{ route('front.category',['category' => $category->slug,'lang' => $sign]) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}">
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
                                                      	<a href="{{ route('front.subcat',['slug1' => $subcat->category->slug_ar, 'slug2' => $subcat->slug_ar,'lang' => $sign]) }}">
                                                      {{$subcat->name_ar}}
                                                      @else 
                                                      	<a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug,'lang' => $sign]) }}">
                                                      {{$subcat->name}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      	<a href="{{ route('front.subcat',['slug1' => $subcat->category->slug_ar, 'slug2' => $subcat->slug_ar,'lang' => $sign]) }}">
                                                      {{$subcat->name_ar}}
                                                      @else
                                                      	<a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug,'lang' => $sign]) }}">
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
                                                          <a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug_ar, 'slug2' => $childcat->subcategory->slug_ar, 'slug3' => $childcat->slug_ar,'lang' => $sign]) }}">
                                                          {{$childcat->name_ar}}
                                                          @else 
                                                          <a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug,'lang' => $sign]) }}">
                                                          {{$childcat->name}}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          <a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug_ar, 'slug2' => $childcat->subcategory->slug_ar, 'slug3' => $childcat->slug_ar,'lang' => $sign]) }}">
                                                         {{$childcat->name_ar}}
                                                          @else
                                                          <a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug,'lang' => $sign]) }}">
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
							<li><a href="{{ route('front.brannds',$sign) }}">{{ $langg->lang236 }}</a></li>
							@endif
				
				
				    			<li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
							
							@if($gs->is_faq == 1)
							<li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
							@endif
							@foreach(DB::table('pages')->where('header','=',1)->get() as $data)
								<li>@if(!$slang)
                                                          @if($lang->id == 2)
                                                          <a href="{{ route('front.page',['slug' => $data->slug_ar,'lang' => $sign ]) }}">
                                                         {{ $data->title_ar }}
                                                          @else 
                                                          <a href="{{ route('front.page',['slug' => $data->slug,'lang' => $sign ]) }}">
                                                         {{ $data->title }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          <a href="{{ route('front.page',['slug' => $data->slug_ar,'lang' => $sign ]) }}">
                                                         {{ $data->title_ar }}
                                                          @else
                                                          <a href="{{ route('front.page',['slug' => $data->slug,'lang' => $sign ]) }}">
                                                          {{ $data->title }}
                                                          @endif
                                                      @endif</a></li>
							@endforeach
							@if($features[5]->status == 1 && $features[5]->active == 1 )
								@foreach(DB::table('offers')->where('header','=',1)->get() as $data)
								<li>
								    
								    @if(!$slang)
                                                          @if($lang->id == 2)
                                                          <a href="{{ route('front.offers',['slug' => $data->slug_ar,'lang' => $sign]) }}">
								    <span class="newicon" ></span>
                                                         {{ $data->name_ar }}
                                                          @else 
                                                          <a href="{{ route('front.offers',['slug' => $data->slug,'lang' => $sign]) }}">
								    <span class="newicon" ></span>
                                                         {{ $data->name }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          <a href="{{ route('front.offers',['slug' => $data->slug_ar,'lang' => $sign]) }}">
								    <span class="newicon" ></span>
                                                         {{ $data->name_ar }}
                                                          @else
                                                          <a href="{{ route('front.offers',['slug' => $data->slug,'lang' => $sign]) }}">
								    <span class="newicon" ></span>
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