
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
@endphp


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
	    <meta name="keywords" content="{{ $seo->meta_keys }}">
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
          <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">

          <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}">
    
    <link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
	
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">

	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">


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
    
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KWP5HD2C');</script>
<!-- End Google Tag Manager -->
    
    <link rel="stylesheet" href="{{asset('assets/demo_19/assets/fontawesome/css/all.css')}}" > 
    <link rel="stylesheet" href="{{asset('assets/demo_19/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	
    


@if($langg->rtl == "1")
       <link rel="stylesheet" href="{{asset('assets/demo_19/assets/css/style.min.css')}}">
	   <link rel="stylesheet" href="{{asset('assets/demo_19/assets/css/style.min-rtl.css')}}">
	   <link rel="stylesheet" href="{{asset('assets/demo_19/assets/css/custom.css')}}">
	  <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">


 @else
 
    
    <link rel="stylesheet" href="{{asset('assets/demo_19/assets/css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/demo_19/assets/css/custom.css')}}">
     <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">


@endif
   
    
    
</head>


<body class="homepage" data-spy="scroll" data-target="#category-list" data-offset="130">
    <div class="page-wrapper">
        <header class="header header-transparent">
            <div class="header-middle sticky-header top-header">
                <div class="container-fluid phone-container">
                    <div class="header-left">
                        <a href="{{url('/')}}" class="logo">
                            <img src="{{asset('assets/images/'.$gs->logo)}}" class="logo-dark" alt="vowalla Logo">
                            @if(!empty($gs->light_logo))
                            <img src="{{asset('assets/images/'.$gs->light_logo)}}" class="logo-light" alt="vowalla Logo">
                            @endif
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="active"><a href="{{url('/')}}">{{ $langg->lang17 }}</a></li>
                                <li>
                                   
                                               
                                      <a href="#" class="sf-with-ul">{{ $langg->lang14 }}</a>
                                   
                                                   @if(isset($categorys))
                                                      <ul class="submenu">
                                                    
                                          @foreach($categorys as $data) 
                                         <li> <a href="{{ route('front.category', ['category' => $data->slug , 'lang' => $sign ]) }}"   @if(count($data->subs) > 0 )  class="sf-with-ul" @endif>
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
                                @if($gs->is_brand == 1)
						      	<li><a href="{{ route('front.brannds',$sign) }}">{{ $langg->lang236 }}</a></li>
				               @endif
                            
                             	@if($gs->is_contact == 1)
						       	<li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
							   @endif
							   
                                  <li>
								  <a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn">{{ $langg->lang16 }}</a>
						      	</li>
						      	
						      		@foreach(DB::table('offers')->where('header','=',1)->get() as $data)
							            	<li>@if(!$slang)
                                                          @if($lang->id == 2)
                                                          <a href="{{ route('front.offers',['slug' => $data->slug_ar , 'lang' => $sign ]) }}"> <span class="newicon" ></span>
                                                         {{ $data->name_ar }}
                                                          @else 
                                                          <a href="{{ route('front.offers',['slug' => $data->slug , 'lang' => $sign ]) }}"> <span class="newicon" ></span>
                                                         {{ $data->name }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          <a href="{{ route('front.offers',['slug' => $data->slug_ar , 'lang' => $sign ]) }}"> <span class="newicon" ></span>
                                                         {{ $data->name_ar }}
                                                          @else
                                                          <a href="{{ route('front.offers',['slug' => $data->slug , 'lang' => $sign ]) }}"> <span class="newicon" ></span>
                                                          {{ $data->name }}
                                                          @endif
                                                      @endif</a></li>
							@endforeach
                                 
                               
                               
                            </ul>
                        </nav>

                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>

                        <div class="header-contact">
                            <i class="icon-phone-1"></i>
                            <a href="tel:{{$main->phone}}">{{$main->phone}}</a></a>
									
										
                        </div><!-- End .header-contact -->
                        
                        <div class="header-dropdowns">
                            <div class="header-dropdown">
                                <a href="#">{{$langg->links}}</a>
                                <div class="header-menu">
                                    <ul>
                                        @if(Auth::guard('web')->check())
                                      
                                          <li style="color:white;" ><a href="{{ route('user-wishlists') }}">{{ $langg->lang9 }}</a></li>
                                        @endif
                                       <li style="color:white;" ><a href="{{ route('product.compare',$sign) }}">{{ $langg->lang10 }}</a></li>
                                      <li  style="color:white;"><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
                                     <li style="color:white;"><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
                                    	@if(!Auth::guard('web')->check())
								
								 <li style="color:white;" >
										<a href="{{ route('user.login') }}" class="sign-log">
											
												<span class="sign-in">{{ $langg->lang12 }}</span> <span style="margin-left: 10px;"><i class="fas fa-user" style="font-size: 12px;color: #393b3f;margin-top: 6px;"></i></span>
												
										
										</a>
										
								</li>
								
									
								   @else 
								   
								   
								     @if(Auth::user()->IsVendor())
								
								        
												
								           <li style="color:white;" >		<a href="{{ route('vendor-dashboard') }}"> {{ $langg->lang11 }}</a></li>
								
							 					
						                	<li>
														<a href="{{ route('user-logout') }}"> {{ $langg->lang223 }}</a>
									    	</li>
										
									@else
										
										
								
								          <li style="color:white;" >		<a href="{{ route('user-dashboard') }}">{{ $langg->lang11 }}</a></li>

									
									 	
						                  <li style="color:white;" >	<a href="{{ route('user-logout') }}"> {{ $langg->lang223 }} </a> </li>
								@endif		
												
                               
						      @endif
									
							  
									
							    
							 
								
									
							
							  	
                        		@if($gs->reg_vendor == 1)
									
                        				@if(Auth::check())
	                        				@if(Auth::guard('web')->user()->is_vendor == 2)
	                        				
	                        				    
	                        			 <li style="color:white;" >	<a href="{{ route('user-package') }}" class="sell-btn">{{ $langg->lang11 }}</a></li>
	                        					
	                        				@endif
									
									@endif
									
								@endif
                        		
									
										
							    
                        
                                    
                                    </ul>
                                </div><!-- End .header-menu -->
                            </div><!-- End .header-dropown -->

                            <!--<div class="header-dropdown">
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
                                                              العملة
                                                              @else 
                                                               Select Currency
                                                              @endif 
                                                               @else  
                                                              @if($slang == 2) 
                                                               العملة
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
                                </div>
                            </div>-->
                            <!-- End .header-dropown -->

                          	@if($gs->is_language == 1)
                	
                        <div class="header-dropdown">
                            <a href="#">{{ DB::table('languages')->where('id','=',Session::has('language') ? Session::get('language') : 1)->first()->language  }} </a>
                            <div class="header-menu">
                                <ul>
                                    
                            	@foreach(DB::table('languages')->get() as $language)
                            	
                            	   <li  {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }}> <a href="{{route('front.language',$language->id)}}" >{{$language->language}}</a></li>
                                  
                                 @endforeach  
                                    
                            </ul>
                            </div><!-- End .header-menu -->
                        </div><!-- End .header-dropown -->
                    @endif

                        @if(!Auth::check()) 
                          <a href="{{url('user/login')}}"><i class="far fa-user" style="color:#fff;"></i></a>
                            @else
						   <a href="{{ route('user-profile') }}"><i class="far fa-user" style="color:#fff;"></i></a>
						  	<a href="{{ route('user-logout') }}"><i class="fas fa-sign-out-alt" style="color:#fff;"></i></a>
						  	
                             @endif 
                             @if(Auth::guard('web')->check())
                            <a href="{{ route('user-wishlists') }}"><i class="far fa-heart" style="color:#fff;"></i></a>
                             @endif
                             
                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="minicart-icon"></i>
                               
                                
                                
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
                                        <span>{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} {{ $langg->lang4 }}</span>

                                        <a href="{{route('front.cart',$sign)}}"> {{ $langg->lang5 }} </a>
                                    </div><!-- End .dropdown-cart-header -->
                                    
                                    <div class="dropdown-cart-products">
                                        @foreach(Session::get('cart')->items as $product)
                                            <div class="product cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
                                                <div class="product-details">
                                                    <h4 class="product-title">
                                                        <a href="{{ route('front.product',['slug' => $product['item']['slug'] , 'lang'=> $sign ]) }}">
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
              
              
                                    <span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>x<span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>
																	
                                  @else 
                                <span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>x<span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
                                  @endif 
                                  
                                  @else 
                                  
                                @if($slang == 2) 
                         <span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>x <span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>
                         @else
						<span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>x<span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
                         @endif
                         
                          @endif

                            </span>
                                                </div><!-- End .product-details -->

                                                <figure class="product-image-container">
                                                    <a href="{{ route('front.product', ['slug' => $product['item']['slug'] , 'lang'=> $sign ]) }}" class="product-image">
                                                        <img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="product">
                                                    </a>
                                                    <a  class="cart-remove btn-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" title="Remove Product">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </figure>
                                            </div><!-- End .product -->
                                            @endforeach
                                            </div>
                                    <div class="dropdown-cart-total">
                                        <span>{{ $langg->lang6 }}</span>

                                        <span class="cart-total-price cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="{{route('front.checkout',$sign)}}" class="btn btn-block">{{ $langg->lang7 }}</a>
                                    </div><!-- End .dropdown-cart-total -->
                                @else 
								  <h3>{{ $langg->lang8 }}<h3/>
								@endif
								</div><!-- End .dropdownmenu-wrapper -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .dropdown -->
                        
                    </div><!-- End .header-right -->
                </div><!-- End .container-fluid -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->