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
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}">


    <link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
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

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('assets/demo_155/assets/css/bootstrap.min.css')}}">
    
    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/demo_155/assets/vendor/fontawesome-free/css/all.min.css')}}">
    @if($langg->rtl == "1")
	<link rel="stylesheet" href="{{asset('assets/demo_155/assets/css/style.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/demo_155/assets/css/style-rtl.css')}}">
	 <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

 @else
    
    <link rel="stylesheet" href="{{asset('assets/demo_155/assets/css/style.min.css')}}">
     <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">
                             
   
@endif
</head>

<body>
    <div class="page-wrapper">
		<header class="header">
			<div class="header-top bg-dark top-header">
				<div class="container">
          
					<div class="header-right">
						<nav class="top-menu text-upper">
							<ul class="d-lg-flex d-none mb-0">
								<li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
								<li><a href="contact.html">Contact</a></li>
							</ul>
						</nav>

						<div class="header-dropdowns">
							<div class="header-dropdown">
								<a href="#">{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</a>
								<div class="header-menu">
									<ul class="text-center">
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
							</div>

							<div class="header-dropdown text-nowrap">
								<a href="#" class="text-white">ENG</a>
								<div class="header-menu">
									<ul>
										<li><a href="{{route('front.language',$lang1)}}">ENGLISH</a></li>
                                        <li><a href="{{route('front.language',$lang2)}}">عربى</a></li>
									</ul>
								</div><!-- End .header-menu -->
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="header-middle sticky-header">
				<div class="container">
					<div class="header-left">
						<a href="{{route('front.index',$sign)}}" class="logo">
                            <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Porto Logo">
                        </a>
					</div><!-- End .header-left -->

					<div class="header-right">
						<a href="#" class="popup-menu-toggler mr-2 pr-1"><i class="toggler-icon"></i></a>

						<div class="separator"></div>

						<div class="popup-menu">
							<button title="Close (Esc)" type="button" class="mfp-close popup-menu-close"></button>
							<nav>
								<ul class="popup-menu-ul">
									<li class=""><a href="{{url('/')}}">{{ $langg->lang17 }}</a></li>
									
									 <li class=""><a href="{{url('/')}}">{{ $langg->lang14 }}</a>
									    <ul>
									    @foreach($categories as $category)
										<li>
											<a href="{{ route('front.category',['category' => $category->slug , 'lang' => $sign ]) }}">
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
                                            <ul>
												@foreach($category->subs as $subcat)
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
										</li>
										@if($features[5]->status == 1 && $features[5]->active == 1 )
								@foreach(DB::table('offers')->where('header','=',1)->get() as $data)
								<li class="border-0"><a class="border-0" href="{{ route('front.offers',['slug' => $data->slug , 'lang' => $sign ]) }}"> @if(!$slang)
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
							 <li><a class="border-0" href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}</a></li>
							 @endif
                            
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
								</ul>
							</nav>
						</div><!-- End .popup-menu -->

						<div class="header-search header-search-popup header-search-category d-none d-sm-block">
							<a href="#" class="search-toggle btn icon-search-3 p-0 mr-2 ml-2" role="button"></a>

							<form id="searchForm" action="{{ route('front.category',  [ 'category' => Request::route('category'),  'subcategory' =>Request::route('subcategory'),  'childcategory' =>Request::route('childcategory'), 'lang' =>$sign]) }}" method="GET">
								<div class="header-search-wrapper rounded-0">
						    		<input type="search" class="form-control rounded-0 bg-white" name="q" id="q" placeholder="Search..." required="">
									<button class="btn fas fa-search rounded-0 p-0" type="submit"></button>
								</div><!-- End .header-search-wrapper -->
							</form>
						</div>

						<div class="separator"></div>
                        
                         @if(Auth::guard('web')->check()) 
                        <a href="{{url('user/login')}}" class="header-icon login-link mr-3 ml-3">
                            <i class="icon-user-2"></i>
                        </a>
                        @else
                            <a href="{{ route('user-wishlists') }}" class="header-icon mr-3 ml-1"><i class="icon-wishlist-2"></i> <span class="cart-count badge-circle">
                                @if(Auth::user())
                                {{ count(Auth::user()->wishlists) }}
                                @endif
                                <span></span></a>
                         @endif

						<div class="separator"></div>

						<div class="dropdown cart-dropdown">
							<a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
								<i class="icon-shopping-cart"></i>
								<span class="cart-count badge-circle">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
							</a>

							<div class="dropdown-menu" >
									<div class="dropdownmenu-wrapper">
									    @if(Session::has('cart'))
										<div class="dropdown-cart-header">
											<span>{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} {{ $langg->lang4 }}</span>
                                            <a href="{{route('front.cart',$sign)}}" class="float-right"> {{ $langg->lang5 }} </a>
										</div><!-- End .dropdown-cart-header -->

										<div class="dropdown-cart-products">
											@foreach(Session::get('cart')->items as $product)
											<div class="product cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
												<div class="product-details">
													<h4 class="product-title">
														<a href="{{ route('front.product',$product['item']['slug']) }}">
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
        														<span class="cart-product-qty"id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span>
        														x 
        														<span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
													        @else 
													            <span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>
													        @endif 
													   @else
													        @if($slang == 2) 
													        <span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>
													        x
													        <span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
													        @else
													        <span id="prct{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
													        x
													        <span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>
													        @endif
												        @endif
													</span>
												</div><!-- End .product-details -->

												<figure class="product-image-container">
													<a href="{{ route('front.product', $product['item']['slug']) }}" class="product-image">
                                                        <img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="product" width="80" height="80">
                                                    </a>
													<a class="cart-remove btn-remove icon-cancel" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" title="Remove Product"></a>
												
												</figure>
											</div><!-- End .product -->
											@endforeach
										</div><!-- End .cart-product -->

										<div class="dropdown-cart-total">
											<span>{{ $langg->lang6 }}:</span>

										    <span class="cart-total-price  cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span>
										</div><!-- End .dropdown-cart-total -->

										<div class="dropdown-cart-action">
											<a href="{{route('front.checkout',$sign)}}" class="btn btn-primary btn-block">{{ $langg->lang7 }}</a>
										</div><!-- End .dropdown-cart-total -->
									</div><!-- End .dropdownmenu-wrapper -->
									@else 
								        <h3>{{ $langg->lang8 }}<h3/>
									@endif
								</div><!-- End .dropdown-menu -->
						</div><!-- End .dropdown -->
					</div><!-- End .header-right -->
				</div><!-- End .container -->
			</div><!-- End .header-middle -->
		</header><!-- End .header -->
