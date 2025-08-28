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
$chunk= App\Models\Service::get();
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
    
    
    
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '205379671105164');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=205379671105164&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1814998431972870');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1814998431972870&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


    
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
    <link rel="stylesheet" href="{{asset('assets/demo_3/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/demo_3/assets/vendor/fontawesome-free/css/all.min.css')}}">

  @if($langg->rtl == "1")
             <link rel="stylesheet" href="{{asset('assets/demo_3/assets/css/style.css')}}">
            <link rel="stylesheet" href="{{asset('assets/demo_3/assets/css/style.min-rtl.css')}}">
            <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

     @else
        
        <link rel="stylesheet" href="{{asset('assets/demo_3/assets/css/style.css')}}">
         <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

                                    
       
    @endif
    
    <!-- Main CSS File -->
 
</head>
<body>
    <div class="page-wrapper">
		<div class="top-notice bg-primary">
			<div class="owl-carousel info-boxes-slider" data-owl-options="{
				'items': 1,
				'dots': false,
				'loop': false,
				'responsive': {
					'768': {
						'items': 2
					},
					'992': {
						'items': 3
					}
				}
			}">
			    @foreach($chunk as $service)
				<div class="info-box info-box-icon-left">
				    
				    <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">

					<div class="info-box-content">
						<h4>
						    @if(!$slang) 
                            @if($lang->id == 2)
                             {{ $service->title_ar }}
                              @else 
                             	{{ $service->title }}
                              @endif 
                              @else
                           
                              @if($slang == 2) 
                              	{{ $service->title_ar }}
                              @else
                              	{{ $service->title }}
                              @endif
                              @endif</h4>
                            <p>
                                @if(!$slang)

                                @if($lang->id == 2)
                                 {{ $service->details_ar }}
                                 
                              @else 
                             	{{ $service->details }}
                             	
                              @endif 
                              @else
                              @if($slang == 2) 
                              	{{ $service->details_ar }}
                              @else
                              	{{ $service->details }}
                              @endif
                              @endif
						</h4>
					</div><!-- End .info-box-content -->
				</div><!-- End .info-box -->
                @endforeach
			</div><!-- End .owl-carousel -->
		</div>
		<header class="header">
			<div class="header-top top-header">
				<div class="container">
					<div class="header-left d-none d-sm-block">
						<h6 class="telephone mb-0">{{$langg->callnow}} {{$main->header_phone}}</h6>
					</div><!-- End .header-left -->

					<div class="header-right w-sm-100">
						<div class="header-dropdown dropdown-expanded mr-auto mr-sm-3">
							<a href="#">{{ $langg->links}}</a>
							<div class="header-menu">
								<ul>
									<li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
                                    <li><a href="{{url('contact',$sign)}}">{{ $langg->lang20 }}</a></li>
								</ul>
							</div><!-- End .header-menu -->
						</div><!-- End .header-dropown -->

						<span class="separator"></span>

						<div class="social-icons">
						    @if(App\Models\Socialsetting::find(1)->f_status == 1)
                             <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                                @endif
                                 @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                 <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                                 @endif
                              @if(App\Models\Socialsetting::find(1)->l_status == 1)
                               <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"></a>
                              @endif
                              
                               @if(App\Models\Socialsetting::find(1)->i_status == 1)
                               <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                              @endif
                                @if(App\Models\Socialsetting::find(1)->g_status == 1)
                               <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="social-icon social-google fab fa-google-plus" target="_blank"></a>
                              @endif
                              
                                @if(App\Models\Socialsetting::find(1)->d_status == 1)
                               <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon social-dribbble fab fa-dribbble" target="_blank"></a>
                              @endif
                              
                                  @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                                  
                                   <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="social-icon social-youtube fab fa-youtube" target="_blank"></a>
                                
                                  @endif
						</div><!-- End .social-icons -->
					</div><!-- End .header-right -->
				</div><!-- End .container -->
			</div><!-- End .header-top -->

			<div class="header-mobile-merge">
				<div class="header-middle header-align-center">
					<div class="container">
						<div class="header-left d-none d-lg-block">
							<div class="header-dropdowns font2">
								<div class="header-dropdown switcher">
									<a href="#">{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</a>
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

								<div class="header-dropdown switcher">
									<a href="#">ENG</a>
									<div class="header-menu">
										<ul>
											<li><a href="{{route('front.language',$lang1)}}">ENGLISH</a></li>
                                            <li><a href="{{route('front.language',$lang2)}}">عربى</a></li>
										</ul>
									</div><!-- End .header-menu -->
								</div><!-- End .header-dropown -->
							</div><!-- End .header-dropdowns -->						
						</div><!-- End .header-left -->

						<div class="header-center">
							<button class="mobile-menu-toggler d-lg-none mr-1 mr-md-3" type="button">
								<i class="icon-menu"></i>
							</button>

							<a href="{{route('front.index',$sign)}}" class="logo">
                                <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Porto Logo">
                            </a>
						</div><!-- End .headeer-center -->

						<div class="header-right">
							<div class="header-search header-search-inline header-icon">
								<a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
								<form id="searchForm" action="{{ route('front.category',  [ 'category' => Request::route('category'),  'subcategory' =>Request::route('subcategory'),  'childcategory' =>Request::route('childcategory'), 'lang' =>$sign]) }}" method="GET">
									<div class="header-search-wrapper">
										<input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
										<button class="btn icon-search-3" type="submit"></button>
									</div><!-- End .header-search-wrapper -->
								</form>
							</div><!-- End .header-search -->
						</div><!-- End .header-right -->
					</div><!-- End .container -->
				</div><!-- End .header-middle -->

				<div class="header-bottom sticky-header">
					<div class="container">
						<div class="header-left">
							<nav class="main-nav">
								<ul class="menu">
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
						</div><!-- .header-left -->

						<div class="header-right">
						    @if(Auth::guard('web')->check())
                                <a href="{{ route('user-wishlists') }}" class="header-icon">
                                    <i class="icon-wishlist-2"></i> {{ count(Auth::user()->wishlists) }}
                                </a>
                               
                             @endif

							<div class="dropdown cart-dropdown">
								<a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
									<i class="icon-bag-2"></i>
									<span class="cart-count cart-quantity" id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
								</a>

								<div class="dropdown-menu" >
									<div class="dropdownmenu-wrapper" id="cart-items">
									    @if(Session::has('cart'))
										<div class="dropdown-cart-header">
										<span>{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }} {{ $langg->lang4 }}</span>

                                        <a href="{{route('front.cart',$sign)}}"> {{ $langg->lang5 }} </a>
										</div><!-- End .dropdown-cart-header -->
										@foreach(Session::get('cart')->items as $product)
										<div class="dropdown-cart-products">
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
												 <a href="{{ route('front.product', ['slug' => $product['item']['slug'] , 'lang' => $sign ]) }}" class="product-image">
                                                        <img style="width:100px;height:auto;object-fit:cover;" src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="product">
                                                    </a>
													<a onClick="refreshCart()" class="cart-remove btn-remove icon-cancel" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" title="Remove Product"></a>
												</figure>
											</div><!-- End .product -->
										</div><!-- End .cart-product -->
										@endforeach
										
										<div class="dropdown-cart-total">
											<span>{{ $langg->lang6 }}</span>
											
											<span class="cart-total-price float-right cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span>
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
					</div><!-- End .container-->
				</div><!-- End .header-bottom -->
			</div>
		</header><!-- End .header -->
		
		<script>
    function refreshCart()
    {
        setInterval(function(){ 
           
           location.reload();
        }, 1000);
    }    
    
</script>
		