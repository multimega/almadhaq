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
    <link rel="stylesheet" href="{{asset('assets/demo_16/assets/css/bootstrap.min.css')}}">
   	<link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">

	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">
	
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('assets/demo_16/assets/css/style.min.css')}}">
     <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

</head>
<body>
    <div class="page-wrapper">
        <header class="header header-transparent">
            <div class="header-wrapper">
                <div class="header-top top-header">
                    <div class="container">
                        <div class="header-left header-dropdowns">
                            <div class="header-dropdown">
                                <a href="#">{{ DB::table('languages')->where('id','=',Session::has('language') ? Session::get('language') : 1)->first()->language  }}</a>
                                <div class="header-menu">
                                    <ul>
                                        @foreach(DB::table('languages')->get() as $language)
                            	
                                  	   <li  {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }}> <a href="{{route('front.language',$language->id)}}" > {{$language->language}}</a></li>
                                  
                                     @endforeach
                                    </ul>
                                </div><!-- End .header-menu -->
                            </div><!-- End .header-dropown -->

                            <div class="header-dropdown">
                                <a href="#">@if(Session::has('currency'))
                                   
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
                                                            العملة
                                                              @else 
                                                              Currency
                                                              @endif 
                                                               @else  
                                                              @if($slang == 2) 
                                                              العملة
                                                              @else
                                                              Currency
                                                              @endif
                                                              @endif 
                                                              @endif</a>
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
                            <div class="dropdown cart-dropdown">
                                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <span class="cart-info cart-quantity" >Cart $<span class="cart-amount cart-quantity">0.00</span></span>
                                     <!--<span class="cart-count">2</span> -->
                                </a>

                                <div class="dropdown-menu" >
                                   <div class="dropdownmenu-wrapper" id="cart-items">
                                    @if(Session::has('cart'))
                                    <div class="dropdown-cart-header">
                                        <span>{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} {{ $langg->lang4 }}</span>

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
                                                    <a href="{{ route('front.product', ['slug' => $product['item']['slug'] , 'lang' => $sign ]) }}" class="product-image">
                                                        <img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="product">
                                                    </a>
                                                    <a  class="cart-remove btn-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" title="Remove Product"><i class="icon-retweet"></i></a>
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
                </div><!-- End .header-top -->

                <div class="header-middle">
                    <div class="container">
                        <div class="header-left">
                            <a  href="{{route('front.index',$sign)}}" class="logo">
                                <img src="{{asset('assets/images/'.$gs->logo)}}" alt="vowalla Logo">
                            </a>
                        </div><!-- End .header-left -->

                        <div class="header-right">

                            <button class="mobile-menu-toggler" type="button">
                                <i class="icon-menu"></i>
                            </button>

                            <div class="header-search">
                                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                                <div class="header-search-wrapper">
                                    <form id="searchForm" class="search-form" action="{{ route('front.category', [ 'category' => Request::route('category'),  'subcategory' =>Request::route('subcategory'),  'childcategory' =>Request::route('childcategory'), 'lang' =>$sign]) }}" method="GET">
                                        <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                                        <button class="btn" type="submit"><i class="icon-search"></i></button>
                                    </form>
                                </div><!-- End .header-search-wrapper -->
                            </div><!-- End .header-search -->

                            <nav class="main-nav">
                                <ul class="menu  menu-vertical sf-arrows">
                                    <li class="active"><a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a></li>
                                <li>
                                    <a href="#" class="sf-with-ul">{{ $langg->lang14 }}</a>
                                    <div class="megamenu megamenu-fixed-width" style="width:240px">
                                        <div class="row">
                                            <div class="col-lg-12">
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
@if(!Auth::guard('web')->check())
								
			        <li>	<a href="{{ route('user.login') }}" class="sign-log">{{ $langg->lang13 }}</a> </li>
								
					  @else
					    
					    	@if(Auth::user()->IsVendor())
													<li>
														<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang11 }}</a>
													</li>
														<li>
														<a href="{{ route('user-logout') }}">{{ $langg->lang223 }}</a>
					                      	</li>
													
							
					    	@else
						  
						  	<li>
														<a href="{{ route('user-profile') }}">{{ $langg->lang11 }}</a>
													</li>

						<!--							<li>-->
						<!--								<a href="{{ route('user-logout') }}">{{ $langg->lang223 }}</a>-->
						<!--</li>-->
						
						@endif
					  
		  @endif
                                </ul>
                            </nav>

                            <div class="header-dropdown dropdown-expanded">
                                <a href="#">Links</a>
                                <div class="header-menu">
                                    <ul>
                                        <li><a href="{{ route('front.contact',$sign) }}" class="sf-with-ul">{{ $langg->lang20 }}</a></li>
                                    </ul>
                                </div><!-- End .header-menu -->
                            </div><!-- End .header-dropown -->
                        </div><!-- End .header-right -->
                    </div><!-- End .container -->
                </div><!-- End .header-middle -->

                <div class="header-bottom">
                    <div class="container mb-2">
                        <div class="header-left">
                            <div class="social-icons">
                                @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                     <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
                                    @endif
                                     @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                     <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
                                     @endif
                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon" target="_blank"><i class="icon-linkedin"></i></a>
                                      @endif
                                      
                                       @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
                                      @endif
                                      
                                      
                                      
                                        @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="social-icon" target="_blank"><i class="icon-google"></i></a>
                                      @endif
                                      
                                        @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon" target="_blank"><i class="icon-dribble"></i></a>
                                      @endif
                            </div><!-- End .social-icons -->
                        </div><!-- End .header-left -->

                        <div class="header-right">
                            <div class="header-contact">
                                <i class="icon-phone"></i>
                                <a href="tel:{{$main->header_phone}}">{{$main->header_phone}}</a>
                            </div><!-- End .header-contact -->
                        </div><!-- End .header-right -->
                    </div><!-- End .container -->
                    <p class="header-copyright">@if(!$slang)
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
                </div><!-- End .header-bottom -->

            </div><!-- End .header-wrapper -->
        </header><!-- End .header -->