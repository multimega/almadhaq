<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>

.autocomplete {
  position: relative;
  display: block;
}

.autocomplete-items {
  position: absolute;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0px;
  right: 0;
}

.autocomplete-items div {
  padding: 5px;
  cursor: pointer;
  width:56%;
  color: #fff;
  font-size: 15px;
  text-align: left;
  background:#fff;
}


#myUL {
  /* Remove default list styling */
  list-style-type: none;
  padding: 0;
  margin: 0;
  background:#fff;

}



#myUL li a {
  margin-top: -1px; /* Prevent double borders */
  padding:5px; 
  text-decoration: none; /* Remove default text underline */
  font-size:14px; /* Increase the font-size */
  color: black; /* Add a black text color */
  display: block; /* Make it into a block element to fill the whole list */
  
}

#myUL li a:hover:not(.header) {
    
  background-color: #eee; /* Add a hover effect to all links, except for headers */
}


</style>

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
   $gs = App\Models\Generalsetting::find(1);
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
        {!! $seo->facebook_pixel !!}
    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,600,700,800','Poppins:300,400,500,600,700','Segoe Script:300,400,500,600,700' ] }
        };
        (function(d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    
    
    
    



    <link rel="stylesheet" href="{{asset('assets/demo_4/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/demo_4/assets/vendor/fontawesome-free/css/all.min.css')}}">

	    @if($langg->rtl == "1")
    <link rel="stylesheet" href="{{asset('assets/demo_4/assets/css/style.min.css')}}">
            <link rel="stylesheet" href="{{asset('assets/demo_4/assets/css/style-rtl.css')}}">
            
             <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

         
       @else
    <link rel="stylesheet" href="{{asset('assets/demo_4/assets/css/style.min.css')}}">
    
   
              <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

       @endif
    
    </head>
<body> 
    <div class="page-wrapper" class="top-header">
        <header class="header" class="top-header" style="background-color: {{$gs->colors}}">
            <div class="top-notice text-white">
        		<div class="container text-center">
        			<h5 class="d-inline-block mb-0 mr-2">Get Up to <b>40% OFF</b> New-Season Styles</h5>
        			<a href="category.html" class="category">MEN</a>
        			<a href="category.html" class="category ml-2 mr-3">WOMEN</a>
        			<small>* Limited time only</small>
        			<button title="Close (Esc)" type="button" class="mfp-close"></button>
        		</div><!-- End .container -->
        	</div>
            <div class="header-top top-header">
                <div class="container">
                    <div class="header-left header-dropdowns">
                        <p class="welcome-msg">    @if(!$slang)
                              @if($lang->id == 2)
                             {!! $main->messagee_ar !!}
                              @else 
                              
                              {{ $main->messagee }}
                              @endif 
                          @else  
                              @if($slang == 2) 
                                  {!! $main->messagee_ar !!}
                              @else
                              {{ $main->messagee }}
                              @endif
                          @endif </p>


                    </div><!-- End .header-left -->

                    <div class="header-right">
                        
                        <div class="header-dropdown dropdown-expanded">
                            <a href="#">{{$langg->links}}</a>
                            <div class="header-menu">
                                <ul>
                                    @if(Auth::guard('web')->check())
                                 
                                    <li><a href="{{ route('user-wishlists') }}">{{ $langg->lang9 }}</a></li>
                                     @endif
     
                                    <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
                                    <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang23 }}</a></li>
                                     @if(!Auth::check())
                                      <li> <a href="{{url('user/login')}}">{{ $langg->lang12 }}</a>
                                      </li>
                                        @else
                                        	<li>
														<a href="{{ route('user-dashboard') }}">{{ $langg->lang11 }}</a>
										   </li>
        							    	<li>
        							    	    
										    	<a href="{{ route('user-logout') }}">{{ $langg->lang223 }}</a>
									    	</li>
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
                        <a href="{{route('front.index',$sign)}}" class="logo">
                            <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Porto Logo">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search">
                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                            
                            <form id="searchForm" class="search-form" action="{{ route('front.category', [ 'category' => Request::route('category'),  'subcategory' =>Request::route('subcategory'),  'childcategory' =>Request::route('childcategory'), 'lang' =>$sign]) }}" method="GET">
                          	    
                          	    
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
	                               <input type="text" id="prod_name" class="form-control" name="search" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" autocomplete="on">
	                              	
						      	<div class="complete">
						      	    
								  <div id="myInputautocomplet" class="autocomplete-items">
								      
								  </div>
								  </div>
								 
								   <div class="select-custom">
                                       	<select name="category" id="category_select" class="categoris">
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
                    </div><!-- End .headeer-center -->

                    <div class="header-right">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                     
                        <div class="header-contact">
                            <span>{{$langg->callnow  }}</span>
                            <a href="tel:{{$main->phone}}"><strong>{{$main->header_phone}}</strong></a>
                        </div><!-- End .header-contact -->

                      <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
						 	      <span class="cart-count cart-quantity"  id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                            </a>

                           <div class="dropdown-menu" >
                                <div class="dropdownmenu-wrapper" id="cart-items">
                                      @if(Session::has('cart'))
                                    <div class="dropdown-cart-products">
                                              @foreach(Session::get('cart')->items as $product) 
                                        <div class="product cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                     <a href="{{ route('front.product',['slug' => $product['item']['slug'], 'lang' => $sign]) }}"><h4 class="product-title"> @if(!$slang)
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
                                              @endif</h4></a>
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
        																		x <span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
                         @endif
                         
                          @endif

                                                </span>
                                            </div>

                                            <figure class="product-image-container">
                                            		<a href="{{ route('front.product', ['slug' => $product['item']['slug'], 'lang' => $sign]) }}" class="product-image">
													<img  src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" style="width:100px;height:auto;" alt="product">
                                                </a>
                                               	<a class="cart-remove btn-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" title="Remove Product">
                                                <i class="icon-cancel"></i></a>
                                                
	                                             </figure>
                                          </div><!-- End .product -->
                                             @endforeach
                                       </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>{{ $langg->lang6 }}</span>
                                        <span class="cart-total-price  cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span>
                                    </div><!-- End .dropdown-cart-total -->

                                   <div class="dropdown-cart-action">
                                    <a href="{{route('front.cart',$sign)}}" class="btn">{{ $langg->lang5 }}</a>
                                             &nbsp; &nbsp; 
                                      
                                    <a href="{{route('front.checkout',$sign)}}" class="btn btn-block">{{ $langg->lang7 }}</a>
                                    
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
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            
                                  @if($gs->is_home == 1)
						        	<li><a href="{{ route('front.index',$sign) }}">{{ $langg->lang17 }}</a></li>
							        @endif
							        <li>
                                   <li>
                                    <a href="#">{{ $langg->lang14 }} </a>
                                    <ul>

                                          @if(isset($categorys))
                                          @foreach($categorys as $data) 
                                         <li> <a href="{{ route('front.category', ['category' =>$data->slug, 'lang' => $sign]) }}"   @if(count($data->subs) > 0 )  class="sf-with-ul" @endif>
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

                                                @if(count($data->subs) > 0 )   
                                                <ul>
                                                 @foreach($data->subs as $subcat)
											    <li>
												  <a  href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug , 'lang' => $sign])}}">
        
                                                                
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
                                                    @endif
                                                  </li>
                                                  
							     	  <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
        						    	@foreach(DB::table('pages')->where('header','=',1)->get() as $data)
        								<li><a href="{{ route('front.page',['slug' => $data->slug ,'lang' => $sign ]) }}">@if(!$slang)
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
            							@if($gs->is_contact == 1)
            							<li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
            							@endif
            						
									 
                                  	    <li>
							            	<a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn">{{ $langg->lang16 }}</a>
							            </li>
                                      
                                        
									
									
                            
                            
                            
                            
                        </ul>
                    </nav>
                </div><!-- End .header-bottom -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->