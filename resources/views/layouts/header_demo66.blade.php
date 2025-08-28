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
			wf.src = 'assets/demo_66/assets/js/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore(wf, s);
		})(document);
	</script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
	<!-- favicon -->
	<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset('assets/demo_66/assets/css/bootstrap.min.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">

	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">

@if($langg->rtl == "1")

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/demo_66/assets/css/style.min-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('assets/demo_66/assets/css/bootstrap.min.rtl.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

  

@else

	<!-- stylesheet -->

	<link rel="stylesheet" href="{{asset('assets/demo_66/assets/css/style.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
 <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">


   

@endif

	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/demo_66/assets/vendor/fontawesome-free/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/demo_66/assets/vendor/simple-line-icons/css/simple-line-icons.min.css')}}">



	@yield('styles')
<style>
     #contentContainer div a b {
        display:none;
    }
    
</style>




</head>


	<div class="page-wrapper">
		<div class="top-notice text-white bg-dark">
			<div class="container text-center">
				<h5 class="d-inline-block mb-0 mr-2">{{$langg->lang941}}</h5>
			   @if(!empty($categories[0]))
				<a href="{{ route('front.category',[ 'category' => $categories[0]->slug , 'lang' =>$sign ]) }}" class="category">
				    
				    	@if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $categories[0]->name_ar }}
                                              @else 
                                              {{ $categories[0]->name }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $categories[0]->name_ar }}
                                              @else
                                              {{ $categories[0]->name }} 
                                              @endif
                                               @endif
				    
				</a>
				@endif
				
			@if(!empty($categories[1]))
				<a href="{{ route('front.category',[ 'category' => $categories[1]->slug , 'lang' =>$sign ]) }}" class="category">
				    
				    	@if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $categories[1]->name_ar }}
                                              @else 
                                              {{ $categories[1]->name }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $categories[1]->name_ar }}
                                              @else
                                              {{ $categories[1]->name }} 
                                              @endif
                                               @endif
				    
				</a>
				@endif
				<small>{{$langg->lang941}}</small>
				<button title="Close (Esc)" type="button" class="mfp-close">×</button>
			</div><!-- End .container -->
		</div><!-- End .top-notice -->

		<header class="header">
			<div class="header-top bg-primary text-uppercase top-header">
				<div class="container">
					<div class="header-left">
					    
					   @if($gs->is_language == 1)
					     
					      	<div class="header-dropdown">
							<a href="#" class="pl-0">
							    
							    
							    @if(Session::has('language'))
							    
							    @php
							   
							   
							    $llng  =  DB::table('languages')->where('id','=',Session::has('language'))->first();
							    
							    @endphp
							    
							    @if($llng->sign == 'en') 
							    
							      <img src="{{asset('assets/demo_66/assets/images/flags/en.png')}}" alt="England flag">
							    
							    
							    @else
							             <img src="{{asset('assets/demo_66/assets/images/flags/ar.jpg')}}" style="width:16px;height:11px;"  alt="Egypt flag">
							    @endif
							    
							    @else
							      
							         @php
							   
							   
							    $llng  =  DB::table('languages')->where('id','=',1)->first();
							    
							    @endphp
							    
							    @if($llng->sign == 'en') 
							       <img src="{{asset('assets/demo_66/assets/images/flags/en.png')}}" alt="England flag">
							    @else
							       <img src="{{asset('assets/demo_66/assets/images/flags/ar.jpg')}}" style="width:16px;height:11px;" alt="Egypt flag">
							    @endif
							    @endif
							    

							      {{ DB::table('languages')->where('id','=',Session::has('language') ? Session::get('language') : 1)->first()->language  }}
							      
							    
							    </a>
							<div class="header-menu">
								<ul style="direction: rtl;">
								    
							    	@foreach(DB::table('languages')->get() as $language)
                            	
                            	   <li {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }}> 
                            	
                            	       
                            	       <a href="{{route('front.language',$language->id)}}" > {{$language->language}}
                            	       
                            	          @if($language->sign == 'en') 
							    
							               <img src="{{asset('assets/demo_66/assets/images/flags/en.png')}}" alt="England flag">
							    
							    
							               @else
							               
							               
							              <img src="{{asset('assets/demo_66/assets/images/flags/ar.jpg')}}" style="width:16px;height:11px;" alt="Egypt flag">
							               
							                @endif       
                            	       </a>
                            	   
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

					<div class="header-right header-dropdowns ml-0 ml-sm-auto">
						<p class="top-message mb-0 mr-lg-5 pr-3 d-none d-sm-block"> @if(!$slang)
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
                                                    @endif</p>
						<div class="header-dropdown dropdown-expanded mr-3">
							<a href="#">{{$langg->links}}</a>
							<div class="header-menu">
								<ul>
									<li class="pr-3">	<a  href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn">{{ $langg->lang16 }}</a></li>
								
								
									@foreach(DB::table('pages')->where('header','=',1)->get() as $data)
								<li>@if(!$slang)
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
							
									@if($gs->is_shop == 1)
							           <li><a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}</a></li>
							        @endif
									<li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
									@if($gs->is_contact == 1)
					            		<li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
							       @endif
									@if($gs->is_faq == 1)
						             	<li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
							      @endif
								</ul>
							</div><!-- End .header-menu -->
						</div><!-- End .header-dropown -->

						<span class="separator"></span>

						<div class="social-icons">
					            	 @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                     <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon " target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                     @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                     <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon " target="_blank"><i class="fab fa-twitter"></i></a>
                                     @endif
                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon " target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                      @endif
                                      
                                       @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="social-icon " target="_blank"><i class="fab fa-instagram"></i></a>
                                      @endif
                                      
                                      
                                      
                                        @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="social-icon" target="_blank"><i class="fab fa-google-plus"></i></a>
                                      @endif
                                      
                                        @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon" target="_blank"><i class="fab fa-dribble"></i></a>
                                      @endif
                                      @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                                      
                                       <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                                    
                                      @endif
                                      
                                      
						</div><!-- End .social-icons -->
					</div><!-- End .header-right -->
				</div><!-- End .container -->
			</div><!-- End .header-top -->

			<div class="header-middle text-dark">
				<div class="container">
					<div class="header-left col-lg-2 w-auto pl-0">
						<button class="mobile-menu-toggler mr-2" type="button">
							<i class="icon-menu"></i>
						</button>
						<a href="{{ route('front.index',$sign) }}" class="logo">
						    
						    
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
					</div><!-- End .header-left -->

					<div class="header-right w-lg-max pl-2">
						<div class="header-search header-icon header-search-inline header-search-category w-lg-max mr-lg-4">
							<a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
						  <form action="{{ route('front.category', ['category' => Request::route('category'),'subcategory' =>Request::route('subcategory'),'childcategory' =>Request::route('childcategory'),'lang' => $sign]) }}" method="get">
                               
                               
                                 	@if (!empty(request()->input('sort')))
									<input type="hidden" name="sort" value="{{ request()->input('sort') }}">
    								@endif
    								@if (!empty(request()->input('minprice')))
    									<input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
    								@endif
    								@if (!empty(request()->input('maxprice')))
    									<input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
    								@endif
                               
                                <div class="header-search-wrapper">
                                    <input type="text" class="form-control tl-r" name="search" id="prod_name" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" autocomplete="on" required>
                                    	<div class="complete">
								            <div id="myInputautocomplet" class="autocomplete-items">
								      
								     </div>
					    	         </div>
                                    
                                    <div class="select-custom">
                                        <select id="cat" name="cat">
                                            <option value="">{{ $langg->lang1 }}</option>
                                         @foreach($categories as $data)
									           <option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}> 
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
                                              </option>
								              @endforeach
                                            
                                            
                                        </select>
                                    </div><!-- End .select-custom -->
                                    <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                                </div><!-- End .header-search-wrapper -->
                            </form>
						</div><!-- End .header-search -->

						<div class="header-contact d-none d-lg-flex align-items-center pr-xl-5 mr-3 ml-xl-5">
							<i class="icon-phone-2"></i>
							<h6 class="pt-1 line-height-1">{{ $langg->callnow }}<a href="tel:{{$main->phone}}" class="d-block text-dark ls-10 pt-1">{{$gs->phone}}</a></h6>
						</div><!-- End .header-contact -->

					
					    
					     	@if(!Auth::guard('web')->check())
						         
						           <a href="{{ route('user.login') }}" class="header-icon"><i class="icon-user-2"></i></a>
						
					     	@else 
        						       @if(Auth::user()->IsVendor())
        						       
        						                <a href="{{ route('vendor-dashboard') }}" class="header-icon"><i class="icon-user-2"></i></a>
        						             
        						             
        										<a href="{{ route('user-logout') }}" class="header-icon"><i class="fa fa-logout"></i></a>
        										
        							   @else
        							   
        							   
        							            <a href="{{ route('user-dashboard') }}" class="header-icon"><i class="icon-user-2"></i></a>
        						             
        						             
        										<a href="{{ route('user-logout') }}" class="header-icon"><i class="fa fa-logout"></i></a>
        							   
        					
        								@endif
								
							@endif
								
								  @if(Auth::guard('web')->check())
                                
                                   	<a href="{{ route('user-wishlists') }}" class="header-icon"><i class="icon-wishlist-2"></i></a>
                                   	
                                 @endif 


					     	<div class="dropdown cart-dropdown">
							<a href="#" class="dropdown-toggle dropdown-arrow" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
								<i class="icon-shopping-cart"></i>
								  
								   @if(Session::has('cart'))
								  <span class="cart-count badge-circle"  id="cart-count">{{count(Session::get('cart')->items)}}</span>
								  
								  @else
								  
								   <span class="cart-count badge-circle" id="cart-count">0</span>
								  
								  @endif
							</a>

							<div class="dropdown-menu" id="cart-items">
								<div class="dropdownmenu-wrapper">
								    
								      @if(Session::has('cart'))
									<div class="dropdown-cart-header">
										<span class="cart-count" id="cart-count">{{count(Session::get('cart')->items)}}</span>

									     <a href="{{route('front.cart',$sign)}}" class="float-right"> {{ $langg->lang5 }} </a>
									</div>
									<!-- End .dropdown-cart-header -->

									<div class="dropdown-cart-products">
									
									  @foreach(Session::get('cart')->items as $product)
										<div class="product cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
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
													<span class="cart-product-qty"></span>
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
        						x          <span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
                         @endif
                         
                          @endif
												</span>
											</div><!-- End .product-details -->

											<figure class="product-image-container">
										
                                               <a href="{{ route('front.product',['slug' => $product['item']['slug'] , 'lang' => $sign ]) }}" class="product-image">
                                                    <img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}"  alt="product" >
                                                </a>
                                              	<a onClick="refreshCart()" class="cart-remove btn-remove icon-cancel" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" title="Remove Product">
                                                <i class="icon-retweet"></i>
                                                </a>
                                                	
											</figure>
										</div><!-- End .product -->

                                       @endforeach									
 									</div><!-- End .cart-product -->

									<div class="dropdown-cart-total">
										<span>{{ $langg->lang6 }}</span>

										<span class="cart-total-price float-right">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span>
									</div><!-- End .dropdown-cart-total -->

									<div class="dropdown-cart-action">
									  <a href="{{route('front.checkout',$sign)}}" class="btn btn-dark btn-block">{{ $langg->lang7 }}</a>
									</div><!-- End .dropdown-cart-total -->
									  @else 
									  <h3>{{ $langg->lang8 }}<h3/>
									@endif
								</div><!-- End .dropdownmenu-wrapper -->
							</div><!-- End .dropdown-menu -->
						</div><!-- End .dropdown -->
					</div><!-- End .header-right -->
				</div><!-- End .container -->
			</div><!-- End .header-middle -->
		</header><!-- End .header -->
<script>
function refreshCart()
{
    setInterval(function(){ 
       
       location.reload();
    }, 1000);
}    

</script>
		