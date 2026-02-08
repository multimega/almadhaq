<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    @php 
 
 
use App\Models\Compare;

$slang = Session::get('language');

$lang  = DB::table('languages')->where('is_default','=',1)->first();

$lang1  = App\Models\Language::find(1);

$lang2  = App\Models\Language::find(2);


$features= App\Models\Feature::all();
$Pagesetting = App\Models\Pagesetting::find(1);
$categorys=App\Models\Category::get();
$oldCompare = Session::get('compare');
$compare = new Compare($oldCompare);

$products = $compare->items;

$main=App\Models\Generalsetting::find(1);
$chunk= App\Models\Service::get()->take(3);
@endphp

    @if(isset($seo->title) )  


  
          <title>	@if(!$slang)
              @if($lang->id == 2)
             {!!substr($seo->title_ar, 0,50)."-"!!}
              @else 
             {{substr($seo->title, 0,50)}}}}
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
          @endif<</title>
          @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
		<title>
		  @if(!$slang)
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
	    <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
	    <meta property="og:image" content="{{asset('assets/images/'.$productt->photo)}}" />
	    <meta name="author" content="Vowalaa">
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
	   
	    <meta name="author" content="Vowalaa">
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
    <!-- Favicon -->
    
    
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}">
    

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('assets/demo_10/assets/css/bootstrap.min.css')}}">
    
  	<link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">

	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">
  @if($langg->rtl == "1")
             <link rel="stylesheet" href="{{asset('assets/demo_10/assets/css/style.min.css')}}">
            <link rel="stylesheet" href="{{asset('assets/demo_10/assets/css/style.min-rtl.css')}}">
           <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

     @else
        
        <link rel="stylesheet" href="{{asset('assets/demo_10/assets/css/style.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

       
    @endif
    
    <!-- Main CSS File -->
 
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

  // Achievement Unlocked Event (Snap Pixel)
  function snapAchievementUnlocked(params) {
    var opts = {};
    if (params.level != null) opts.level = params.level;
    if (params.uuid_c1 != null) opts.uuid_c1 = params.uuid_c1;
    if (params.price != null) opts.price = params.price;
    if (params.currency != null) opts.currency = params.currency;
    if (params.transaction_id != null) opts.transaction_id = params.transaction_id;
    if (params.item_ids != null) opts.item_ids = params.item_ids;
    if (params.item_category != null) opts.item_category = params.item_category;
    if (params.att_status != null) opts.att_status = params.att_status;
    if (params.brands != null) opts.brands = params.brands;
    if (params.client_deduplication_id != null) opts.client_deduplication_id = params.client_deduplication_id;
    if (params.customer_status != null) opts.customer_status = params.customer_status;
    if (params.data_use != null) opts.data_use = params.data_use;
    if (params.delivery_method != null) opts.delivery_method = params.delivery_method;
    if (params.event_tag != null) opts.event_tag = params.event_tag;
    if (params.number_items != null) opts.number_items = params.number_items;
    if (params.description != null) opts.description = params.description;
    if (params.search_string != null) opts.search_string = params.search_string;
    if (params.payment_info_available != null) opts.payment_info_available = params.payment_info_available;
    if (params.sign_up_method != null) opts.sign_up_method = params.sign_up_method;
    if (params.success != null) opts.success = params.success;
    if (params.user_email != null) opts.user_email = params.user_email;
    if (params.user_phone_number != null) opts.user_phone_number = params.user_phone_number;
    if (params.user_hashed_email != null) opts.user_hashed_email = params.user_hashed_email;
    if (params.user_hashed_phone_number != null) opts.user_hashed_phone_number = params.user_hashed_phone_number;
    if (params.firstname != null) opts.firstname = params.firstname;
    if (params.lastname != null) opts.lastname = params.lastname;
    if (params.age != null) opts.age = params.age;
    if (params.geo_city != null) opts.geo_city = params.geo_city;
    if (params.geo_country != null) opts.geo_country = params.geo_country;
    if (params.geo_postal_code != null) opts.geo_postal_code = params.geo_postal_code;
    if (params.geo_region != null) opts.geo_region = params.geo_region;
    snaptr('track', 'ACHIEVEMENT_UNLOCKED', opts);
  }
</script>

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
<body>
    <div class="page-wrapper">
        
        <!--<div class="top-notice text-white bg-dark">
			<div class="container text-center">
				<h5 class="d-inline-block mb-0">Get Up to <b>40% OFF</b> New-Season Styles </h5>
				<small>* Limited time only.</small>
				<button title="Close (Esc)" type="button" class="mfp-close"></button>
			</div> 
		</div> 
        -->
        
        <header class="header">
            <div class="header-top top-header">
                <div class="container">
                    <div class="header-left header-dropdowns d-md-block d-none">
                        <p class="top-message text-uppercase">FREE Returns. Standard Shipping Orders $99+</p>
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <div class="header-dropdown dropdown-expanded">
                            <a href="#">{{ $langg->links }}</a>
                            <div class="header-menu">
                                <ul>
                                    @if(Auth::guard('web')->check())
                                      <li><a href="{{ route('user-profile') }}"> {{ $langg->lang11}}  </a></li>
                                    <li><a href="{{ route('user-wishlists') }}">{{ $langg->lang9 }}</a></li>
                                     @endif
                                    <!--<li><a href="#">DAILY DEAL</a></li>-->
                                    <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
                                    <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang23 }}</a></li>
                                    @if(!auth()->check())
                                    <li><a href="{{url('user/login')}}">{{ $langg->lang12 }}</a></li>
                                    @endif
                                </ul>
                            </div><!-- End .header-menu -->
                        </div><!-- End .header-dropown -->
                        <span class="separator"></span>

						<div class="header-dropdown">
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

						<div class="header-dropdown ml-0 ml-md-4 mr-auto mr-sm-3 mr-md-0">
							<a href="#">{{ DB::table('languages')->where('id','=',Session::has('language') ? Session::get('language') : 1)->first()->language  }}</a>
							<div class="header-menu">
								
								<ul>
									
                                    @foreach(DB::table('languages')->get() as $language)
                            	
                                  	   <li  {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }}> <a href="{{route('front.language',$language->id)}}" > {{$language->language}}</a></li>
                                  
                                     @endforeach
								</ul>
							</div><!-- End .header-menu -->
						</div><!-- End .header-dropown -->
                        <span class="separator"></span>

						<div class="social-icons">
							
							    @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                      @endif
                                        @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                      @endif
                                    
                                      @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">
                                            <i class="fab fa-dribbble"></i>
                                        </a>
                                      @endif
                                       @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                        <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="instagram" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                      @endif
                                      
                                      
                                        @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="instagram" target="_blank"><i class="fab fa-youtube"></i></a>
                                    
                                      @endif
						</div><!-- End .social-icons -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <a  href="{{route('front.index',$sign)}}" class="logo">
                            <img src="{{asset('assets/images/'.$gs->logo)}}" alt="vowalla Logo">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search">
                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                            <form id="searchForm" class="search-form" action="{{ route('front.category', [ 'category' => Request::route('category'),  'subcategory' =>Request::route('subcategory'),  'childcategory' =>Request::route('childcategory'), 'lang' =>$sign]) }}" method="GET">
                          	   
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
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
                                    <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->
                    </div><!-- End .headeer-center -->

                    <div class="header-right">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                        <div class="header-contact">
                            <i class="fas fa-phone"></i>
							<h6 class="pt-1 d-inline-block line-height-1 pr-2">Call us now<a href="tel:{{$main->header_phone}}" class="d-block text-dark pt-1 font1">{{$main->header_phone}}</a></h6>
                            
                        </div><!-- End .header-contact -->
                        @if(!Auth::guard('web')->check()) 
                        <a href="{{url('user/login')}}" class="header-user">
                            <i class="far fa-user"></i>
                        </a>
                        @else
                        <a href="{{ route('user-wishlists') }}" class="Vowalaa-icon wishlist-icon">
                            <i class="far fa-heart"></i>
                            <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                        </a>
                        @endif
                        
                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                   <span class="cart-quantity cart-count" id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} </span>

                            </a>

                            <div class="dropdown-menu" >
                                 <div class="dropdownmenu-wrapper" id="cart-items">
                                    @if(Session::has('cart'))
                                    <div class="dropdown-cart-header">
                                       <span class="cart-quantity">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} </span> {{ $langg->lang4 }}

                                        <a href="{{route('front.cart',$sign)}}"> {{ $langg->lang5 }} </a>
                                    </div><!-- End .dropdown-cart-header -->
                                    
                                    <div class="dropdown-cart-products">
                                        @foreach(Session::get('cart')->items as $product)
                                            <div class="product cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
                                                <div class="product-details">
                                                    <h4 class="product-title">
                                                        <a href="{{ route('front.product',['slug' => $product['item']['slug'] , 'lang' => $sign ]) }}">
                                                            @if(!$slang)
                                                              @if($lang->id == 2)
                                                              
                                                             {{strlen($product['item']['name_ar']) > 100 ? substr($product['item']['name_ar'],0,100).'...' : $product['item']['name_ar']}}
                                                              @else 
                                                              {{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}
                                                              @endif 
                                                                @else  
                                                              @if($slang == 2) 
                                                              {{strlen($product['item']['name_ar']) > 100 ? substr($product['item']['name_ar'],0,100).'...' : $product['item']['name_ar']}}
                                                              @else
                                                             {{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}
                                                              @endif
                                                              @endif
                                                        </a>
                                                    </h4>

                                                    <span class="cart-product-info">
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
                                                        <img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="product">
                                                    </a>
                                                    <a  class="cart-remove btn-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" title="Remove Product"><i class="fas fa-times"></i></a>
                                                </figure>
                                            </div><!-- End .product -->
                                            @endforeach
                                            
                                        </div><!-- End .cart-product -->
                                        <div class='action-total'>
                                            <div class="dropdown-cart-total">
                                                <span>{{ $langg->lang6 }}</span>
    
                                                 <span class="cart-total-price  cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span>
                                            </div><!-- End .dropdown-cart-total -->
    
                                            <div class="dropdown-cart-action">
                                                <a href="{{route('front.checkout',$sign)}}" class="btn btn-block">{{ $langg->lang7 }}</a>
                                            </div><!-- End .dropdown-cart-total -->
                                        </div>
                                        @else 
    									  <h3>{{ $langg->lang8 }}<h3/>
    									@endif
                                    </div><!-- End .dropdownmenu-wrapper -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <nav class="main-nav" style="background-color: {{$gs->colors}}">
                        <ul class="menu sf-arrows">
                                <li class="active"><a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a></li>
                                <li>
                                    <a href="#" class="sf-with-ul">{{ $langg->lang14 }}</a>
                                    <div class="megamenu megamenu-fixed-width" style="width:240px">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul>
                                                    @foreach($categories as $category)
                                                        <li>
                                                            <a href="{{ route('front.category',['category' =>$category->slug, 'lang' => $sign ]) }}">
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
                                            </div><!-- End .col-lg-8 -->
                                            
                                        </div>
                                    </div><!-- End .megamenu -->
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
							
								@if($gs->is_shop == 1)
							 <li><a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}</a></li>
							 @endif
                            
                            <li class="sf-with-ul">
                                 <a href="#"> @if($langg->rtl != "1") PAGES  @else الصفحات   @endif</a>
                                   
                                     <ul>
                                
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
   
                                        @if(!Auth::check())
                                      <li> <a href="{{url('user/login')}}">{{ $langg->lang12 }}</a>
                                      </li>
                                        @else
        							    	<li>
										    	<a href="{{ route('user-logout') }}">{{ $langg->lang223 }}</a>
									    	</li>
                                         @endif
                                         </li>
                            </ul>
                    </nav>
                </div><!-- End .header-bottom -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->