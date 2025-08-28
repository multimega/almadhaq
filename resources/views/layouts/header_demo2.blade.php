<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
<style>
@media only screen and (max-width: 400px){
    
    .home-slider-container, .home-slide{height: 50vh;}
    .header.header-transparent{position: relative;}
    .header-transparent .header-middle:not(.fixed){background-color: #514f65;}
}

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
@media only screen and (min-width: 600px) {
  .dis{display: none;}
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
    



    <link rel="stylesheet" href="{{asset('assets/demo_2/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	
	 @if($langg->rtl == "1")
      
		<link rel="stylesheet" href="{{asset('assets/demo_2/assets/css/style.min-rtl.css')}}">
	    <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">


 @else
 
    
   <link rel="stylesheet" href="{{asset('assets/demo_2/assets/css/style.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">
 

@endif
     <link rel="stylesheet" href="{{asset('assets/demo_2/assets/fontawesome/css/all.css')}}" > 
    <link rel="stylesheet" type="text/css" href="{{asset('assets/demo_2/assets/vendor/fontawesome-free/css/all.min.css')}}">
    </head>
</head>
<body>
    <div class="page-wrapper">
        <header class="header header-transparent">
            <div class="header-middle sticky-header top-header">
                <div class="container">
                    <div class="header-left">
                        <a href="{{route('front.index',$sign)}}" class="logo">
                            <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Porto Logo">
                        </a>
                    </div>

                    <div class="header-right">
                        <div class="row header-row header-row-top">
                             <div class="header-dropdown dropdown-expanded dis">
                                <a href="#">{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</a>
                                   <div class="header-menu">
                                        <ul>
                                        	@foreach(DB::table('currencies')->get() as $currency)
                                         <li style="color:black;"><a href="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}"> 
                                           
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
                                </div>
                            <div class="header-dropdown dropdown-expanded dis">
                             <a href="#">ENG</a>
                                    <div class="header-menu">
                                        <ul>
                                           <li style="color:black;"><a href="{{route('front.language',$lang1)}}">ENGLISH</a></li>
                                           <li style="color:black;"><a href="{{route('front.language',$lang2)}}">عربى</a></li>  
                                        </ul>
                                    </div>
                                </div>
                            <div class="header-dropdown dropdown-expanded hidden-lg">
                                <a href="#">{{$langg->links}}</a>
                                <div class="header-menu">
                                    <ul>
                                    
                             
                                     @if(Auth::guard('web')->check())
                                         <li><a href="{{ route('user-profile') }}"> {{ $langg->lang11}}  </a></li>
                                    <li><a href="{{ route('user-wishlists') }}">{{ $langg->lang9 }}</a></li>
                                     @endif
                                    <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
                                    <li><a href="{{route('front.contact',$sign)}}">{{ $langg->lang20 }}</a></li>
                                      @if(!Auth::check()) 
                                      <li> <a href="{{url('user/login')}}">{{ $langg->lang12 }}</a></li>
                                        @else
        							    	<li>
										    	<a href="{{ route('user-logout') }}">{{ $langg->lang223 }}</a>
									    	</li>
                                         @endif  
                                       
                                    </ul>
                                </div>
                                
                            </div>
                            <div class="header-search">
                                <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                                <div class="header-search-wrapper">
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
                                
	                             <input type="text" id="prod_name" class="form-control" name="search" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" autocomplete="on">
	                              	
						      	<div class="complete">
						
								  <div id="myInputautocomplet" class="autocomplete-items">
								      
								  </div>
								  </div>
                                        <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                                    </form>
                                </div><!-- End .header-search-wrapper -->
                            </div><!-- End .header-search -->
                        </div><!-- End .header-row -->

                        <div class="row header-row header-row-bottom">
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
                                         <li> <a href="{{ route('front.category', ['category' => $data->slug , 'lang' => $sign ] ) }}"   @if(count($data->subs) > 0 )  class="sf-with-ul" @endif>
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
												  <a  href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug ,'lang' => $sign ])}}">
        
                                                                
                                                                  
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
        							                 	<li><a href="{{ route('front.page', ['slug' => $data->slug , 'lang' => $sign ]) }}">@if(!$slang)
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
                        
                            <button class="mobile-menu-toggler" type="button">
                                <i class="icon-menu"></i>
                            </button>
                            <div class="header-dropdowns">
                               <div class="header-dropdown">
                                <a href="#">{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</a>
                                   <div class="header-menu">
                                        <ul>
                                        	@foreach(DB::table('currencies')->get() as $currency)
                                         <li style="color:black;"><a href="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}"> 
                                           
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
                                    <a href="#">ENG</a>
                                    <div class="header-menu">
                                        <ul>
                                           <li style="color:black;"><a href="{{route('front.language',$lang1)}}">ENGLISH</a></li>
                                           <li style="color:black;"><a href="{{route('front.language',$lang2)}}">عربى</a></li>  
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div><!-- End .header-dropown -->
                            </div><!-- End .header-dropdowns -->

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
                                            
                                            <figure class="product-image-container">
                                            		<a href="{{ route('front.product', ['slug' => $product['item']['slug'] , 'lang' => $sign ]) }}" class="product-image">
													<img  src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" style="width:100px;height:auto;" alt="product">
                                                </a>
                                               	
	                                             </figure>
	                                           <div class="product-details">
                                                <h4 class="product-title">
                                                     <a href="{{ route('front.product',['slug' => $product['item']['slug'] , 'lang' => $sign ]) }}"><h4 class="product-title"> @if(!$slang)
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
                                            <a class="cart-remove btn-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" title="Remove Product">
                                                <i class="icon-cancel"></i></a>
                                                
                                            
                                          </div><!-- End .product -->
                                             @endforeach
                                       </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total cart-total">
                                        <span>{{ $langg->lang6 }}</span>
                                        <span class="cart-total-price">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span>
                                    </div><!-- End .dropdown-cart-total -->

                                   <div class="dropdown-cart-action">
                                    <a href="{{route('front.cart',$sign)}}" class="btn btn-primary">{{ $langg->lang5 }}</a>
                                             &nbsp; &nbsp; 
                                      
                                    <a href="{{route('front.checkout',$sign)}}"class="btn btn-outline-primary">{{ $langg->lang7 }}</a>
                                    
                                    </div>
                                     @else 
									  <h3>{{ $langg->lang8 }}<h3/>
									@endif
                                </div><!-- End .dropdownmenu-wrapper -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .dropdown --
                          
                          
                          
                        </div><!-- End .header-row -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->
