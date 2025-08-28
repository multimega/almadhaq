<!DOCTYPE html>
<html lang="en">
<head>

 <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>

.head-icon,
.wishlist-icon{
    position: relative;
    font-size: 24px;
    margin: 0 7px;

}
.wishlist-icon #wishlist-count{
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 1.6rem;
    height: 1.6rem;
    position: absolute;
    right: 1.4rem;
    line-height: 1;
    top: -.1rem;
    border-radius: 50%;
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    background-color: #ed7e63;
    right: -2px;
    top:4px;
}
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

$feature_products =  App\Models\Product::where('featured','=',1)->where('status','=',1)->orderBy('id','desc')->take(8)->get();
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
   
          @elseif(isset($productt))
		<meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
		<meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
	    <meta property="og:title" content="{{$productt->name}}" />
	    <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
	    <meta property="og:image" content="{{asset('assets/images/'.$productt->photo)}}" />
	    <meta name="author" content="{{ $seo->meta_keys }}">
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
	 
	    <meta name="author" content="{{ $seo->meta_keys }}">
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
    

     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">


     <link rel="stylesheet" href="{{asset('assets/demo_55/assets/css/bootstrap.min.css')}}">


	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
	
	 	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">
	

  
      @if($langg->rtl == "1")
      <link rel="stylesheet" href="{{asset('assets/demo_55/assets/css/style.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/demo_55/assets/css/style.min-rtl.css')}}">
       <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

    @else
        
      <link rel="stylesheet" href="{{asset('assets/demo_55/assets/css/style.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

    @endif
 
    
    </head>

 <div class="page-wrapper">
        <header class="header">
            <div class="header-top top-header">
                <div class="container">
                    <div class="header-left header-dropdowns">
                        <p class="welcome-msg">{{$gs->messagee}}</p>
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        
                        <div class="header-dropdown dropdown-expanded">
                            <a href="#">{{$langg->links}}</a>
                            <div class="header-menu">
                                <ul>
                                    @if(Auth::guard('web')->check())
                                  <li><a href="{{ route('user-wishlists') }}">{{ $langg->lang9 }}</a></li>
                                 @endif          
                                
                                @if($features[5]->status == 1 && $features[5]->active == 1 )
								@foreach(DB::table('offers')->where('header','=',1)->get() as $data)
								<li>@if(!$slang)
                                                          @if($lang->id == 2)
                                                          <a href="{{ route('front.offers',['slug' => $data->slug_ar,'lang' => $sign]) }}">
								    <!--<span class="newicon" ></span>-->
                                                         {{ $data->name_ar }}
                                                          @else 
                                                          <a href="{{ route('front.offers',['slug' => $data->slug,'lang' => $sign]) }}">
								    <!--<span class="newicon" ></span>-->
                                                         {{ $data->name }}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          <a href="{{ route('front.offers',['slug' => $data->slug_ar,'lang' => $sign]) }}">
								    <!--<span class="newicon" ></span>-->
                                                         {{ $data->name_ar }}
                                                          @else
                                                          <a href="{{ route('front.offers',['slug' => $data->slug,'lang' => $sign]) }}">
								    <!--<span class="newicon" ></span>-->
                                                          {{ $data->name }}
                                                          @endif
                                                      @endif</li>
						                          	@endforeach
						                         	@endif
                            
                                	@if(!Auth::guard('web')->check())
									<li class="login">
										<a href="{{ route('user.login') }}" class="sign-log">
											<div class="links">
												<span class="sign-in">{{ $langg->lang12 }}</span> 
												<span class="join">{{ $langg->lang13 }}</span>
											</div>
										</a>
									</li>
								
							   	    @elseif(Auth::user()->IsVendor())
								
									<li>
										<a href="{{ route('vendor-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang11 }}</a>
								
									</li>
						    
                        			@elseif($gs->reg_vendor == 1)
									
                        				@if(Auth::check())
	                        				@if(Auth::guard('web')->user()->is_vendor == 2)
	                        				
	                        				    <li>
	                        					<a href="{{ route('user-package') }}" class="sell-btn">{{ $langg->lang11 }}</a>
	                        					</li>
	                        				@endif
									
									@endif
                        			
							       @else 
										
									<li>
										<a href="{{ route('user-dashboard') }}"> {{ $langg->lang11}}  </a>
									</li>
									
									 	<li>
										<a href="{{ route('user-logout') }}"> {{ $langg->lang223 }}</a>
										</li>
												
                               
						           @endif
                                </ul>
                            </div><!-- End .header-menu -->
                        </div><!-- End .header-dropown -->
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

                        	@if($gs->is_language == 1)
                        <div class="header-dropdown">
                            <a href="#">  {{ DB::table('languages')->where('id','=',Session::has('language') ? Session::get('language') : 1)->first()->language  }}</a>
                            <div class="header-menu">
                                <ul>
                                    	@foreach(DB::table('languages')->get() as $language)
                            	
                                  	   <li  {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }}> <a href="{{route('front.language',$language->id)}}" > {{$language->language}}</a></li>
                                  
                                     @endforeach  
                                </ul>
                            </div><!-- End .header-menu -->
                        </div><!-- End .header-dropown -->
                       @endif
                        <div class="dropdown compare-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-retweet"></i>  {{$langg->lang10}}<span id="compare-count"> {{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
                            </a>

                            <div class="dropdown-menu" >
                                <div class="dropdownmenu-wrapper">
                                   @if(Session::has('compare'))
                                    <ul class="compare-products">
                                        @if(isset($products))
                                         @foreach($products as $product)
                                        <li class="product">
                                            <a  href="javascript:;"  class="btn-remove compare-remove" title="Remove Product"><i class="icon-cancel compare-remove"  data-href="{{ route('product.compare.remove',$product['item']['id']) }}"></i></a>
                                            <h4 class="product-title"><a href="{{ route('front.product', ['slug' => $product['item']['slug']  , 'lang' =>$sign ]) }}">
                                                 
                                                  &nbsp; &nbsp; &nbsp;
                                                 
                                                  @if(!$slang)
                                                   @if($lang->id == 2)
                                                     {{ substr($product['item']['name_ar'],0,80).'...' }}
                                                      @else 
                                                    {{ substr($product['item']['name'],0,20).'...' }}
                                                      @endif
                                                      @else
                                                   
                                                      @if($slang == 2) 
                                                      {{ substr($product['item']['name_ar'],0,80).'...' }}
                                                      @else
                                                       {{ substr($product['item']['name'],0,20).'...' }}
                                                      @endif
                                                      @endif
                                                
                                                </a>
                                                
                                                </h4>
                                        </li>
                                      @endforeach
                                      @endif      
                                    </ul>
                                
                                    <div class="compare-actions">
                                       
                                        <a href="{{url('item/compare/view')}}" class="btn btn-primary">{{$langg->lang10}} </a>
                                    </div>
                                      @else
        				            <h4 class="text-center">{{ $langg->lang60 }}</h4>
        				             @endif
                                </div><!-- End .dropdownmenu-wrapper -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .dropdown -->
                    
                        <span class="seperate">|</span>
                        <div class="share-links d-none d-xl-block">
                            @if(App\Models\Socialsetting::find(1)->f_status == 1)
                         <a href="{{ App\Models\Socialsetting::find(1)->facebook }}"  rel="nofollow" class="social-icon share-facebook icon-facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            @endif
                             @if(App\Models\Socialsetting::find(1)->t_status == 1)
                             <a href="{{ App\Models\Socialsetting::find(1)->twitter }}"  rel="nofollow" class="social-icon share-twitter icon-twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                             @endif
                          @if(App\Models\Socialsetting::find(1)->l_status == 1)
                           <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}"  rel="nofollow" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                          @endif
                          
                           @if(App\Models\Socialsetting::find(1)->i_status == 1)
                           <a href="{{ App\Models\Socialsetting::find(1)->instagram }}"  rel="nofollow" class="social-icon share-instagram icon-instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                          @endif
                          
                          
                          
                            @if(App\Models\Socialsetting::find(1)->g_status == 1)
                           <a href="{{ App\Models\Socialsetting::find(1)->gplus }}"  rel="nofollow" class="social-icon" target="_blank"><i class="fab fa-google-plus"></i></a>
                          @endif
                          
                            @if(App\Models\Socialsetting::find(1)->d_status == 1)
                           <a href="{{ App\Models\Socialsetting::find(1)->dribble }}"  rel="nofollow" class="social-icon" target="_blank"><i class="fab fa-dribble"></i></a>
                          @endif
              
                          @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                          
                           <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                        
                          @endif
                        </div>
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

             @if($langg->rtl != "1")
            
            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                       
                         <a href="{{url('/')}}" class="logo">
                             <img src="{{asset('assets/images/'.$gs->logo)}}" alt="4ary Logo">
                         </a>
                        
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search">
                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                            <form action="{{ route('front.category', ['category'=>$data->slug, 'lang'=>$sign]) }}" method="get">
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
                                    <input type="search" class="form-control"  name="q" id="q" placeholder="{{ $langg->lang2 }}"  value="{{ request()->input('search') }}" autocomplete="on" required>
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
                    </div><!-- End .headeer-center -->

                    <div class="header-right">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                        <div class="header-contact">
                            <span>Call us now</span>
                            <a href="tel:{{$main->phone}}"><strong>{{$gs->phone}}</strong></a>
                        </div><!-- End .header-contact -->

                       <div class="dropdown cart-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
        					   <span class="cart-count cart-quantity"  id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                         </a>
                         
                             
								@include('load.carts')
							

							
                            
                         </div>
                       
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
            
            
            
            
            
            
               @else
                 <div class="header-middle">
                <div class="container">
                     <div class="header-right">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                        <div class="header-contact">
                            <span>{{$langg->callnow}}</span>
                            <a href="tel:{{$main->phone}}"><strong>{{$main->header_phone}}</strong></a>
                        </div>
                        @if(Auth::guard('web')->check())
                        <a href="{{ route('user-wishlists') }}" class="Vowalaa-icon wishlist-icon">
                            <i class="far fa-heart"></i>
                            <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                        </a>
                        @endif
                          <div class="dropdown cart-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
        					   <span class="cart-count"  id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                         </a>
                         	
							
								@include('load.carts')
							
							
                            
                         </div>
                       
                    </div><!-- End .header-right -->
                   

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
                                    <button style="color:white; background-color:{{$gs->colors}}" class="btn" type="submit"><i class="icon-magnifier"></i></button>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->
                    </div><!-- End .headeer-center -->
                           <div class="header-left">
                                <a href="{{url('/')}}" class="logo">
                                    <img src="{{asset('assets/images/'.$gs->logo)}}"   alt="Porto Logo">
                                </a>
                            </div>
                   
                </div>
            </div>
            @endif
            
            
            
            
            
            
            
            
            
            
            
            
            

           
            <div class="header-bottom sticky-header">
                <div class="container">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li class="active"> <a href="{{url('/')}}">{{ $langg->lang17 }}</a></li>
                            <li>
                                <a href="#" class="sf-with-ul">{{ $langg->lang14 }}</a>
                                
                                  @if(isset($categorys))
                                                <ul class="submenu">
                                                  
                                          @foreach($categorys as $data) 
                                         <li> <a href="{{ route('front.category', $data->slug) }}"   @if(count($data->subs) > 0 )  class="sf-with-ul" @endif>
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
												  <a  href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug ,'lang' => $sign])}}">
        
                                          
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
                            <li class="megamenu-container">
                                <a href="#" class="sf-with-ul"> @if($langg->rtl != "1") PRODUCTS  @else المنتجات   @endif</a>
                                                        
                                           
                                            <ul> 
                                                 @foreach($feature_products as $prod) 
                                           
                                         <li> 
                                         <a href="{{ route('front.product', $prod->slug)}}" >
                                             
                                               @if(!$slang)
                                              @if($lang->id == 2)
                                              {{ $prod->name_ar }}
                                              @else 
                                              {{ $prod->name }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $prod->name_ar }}
                                              @else
                                              {{ $prod->name }} 
                                              @endif
                                               @endif
                                               </a>

                                              
                                         </li>
                                        
                                        @endforeach
                                        </ul>
                                      
                              
                            </li>
                            <li>
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
                                    
                                </ul>
                            </li>
                         
                            <li><a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn">{{ $langg->lang16 }}</a></li>
                        </ul>
                    </nav>
                </div><!-- End .header-bottom -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->
        
        
        