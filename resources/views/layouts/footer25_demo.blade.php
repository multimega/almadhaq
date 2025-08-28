


@php 
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$features= App\Models\Feature::all();
$categorys=App\Models\Category::where('status',1)->get();
$Pagesetting = App\Models\Pagesetting::find(1);
$main=App\Models\Generalsetting::find(1);
$feature_products =  App\Models\Product::where('featured','=',1)->where('status','=',1)->orderBy('id','desc')->take(8)->get();
$chunk= App\Models\Service::get()->take(3);
$ch= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp





     <footer class="footer" id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <p class="widget-newsletter-title">{{$langg->newsletter}}</p>
                        </div>
                        <div class="col-lg-4">
                            <p class="widget-newsletter-content">Get all the latest information on Events, Sales and Offers.<br>
                                <span class="widget-newsletter-content">Receive $10 coupon for first shopping.</span>
                            </p>
                        </div>
                        <div class="col-lg-5">
                            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                                {{csrf_field()}}
                                <div class="footer-submit-wrapper">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ $langg->lang741 }}" required>
                                    <button type="submit"  style="color:white; background-color:{{$gs->colors}}" class="btn">  @if(!$slang)
                                           @if($lang->id == 2)
                                                ابدأ  
                                              @else 
                                               Sign Up
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                                ابدأ 
                                              @else
                                               Sign Up
                                              @endif
                                   @endif 
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="footer-middle">
                    <div class="row row-sm">
                        <div class="col-lg-6 col-xl-4">
                            <a href="{{ route('front.index',$sign) }}">
                                <img src="{{asset('assets/images/'.$gs->footer_logo)}}" alt="Vowalaa Logo">
                            </a>
                            <div class="row row-sm">
                                <div class="col-sm-6">
                                    <div class="contact-widget">
                                        <h4 class="widget-title">{{$langg->lang155}}</h4>
                                        <a href="#">
                                            @if(!$slang)
                                             @if($lang->id == 2)
                                              {{ $gs->address_ar }}
                                              @else 
                                              {{ $gs->address }}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {{ $gs->address_ar }}
                                              @else
                                              {{ $gs->address }} 
                                              @endif
                                               @endif</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="contact-widget email">
                                        <h4 class="widget-title">{{$langg->lang209}}</h4>
                                        <a href="{{$main->email}}">{{$main->email}}</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="contact-widget">
                                        <h4 class="widget-title">{{$langg->lang210}}</h4>
                                        <a href="tel:">{{$main->phone }}</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="contact-widget">
                                        <h4 class="widget-title"></h4>
                                        <a href="#"></a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="social-icons mb-3">
                                        
                                    @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                     <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                     @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                     <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
                                    @endif
                                    @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                    @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
                                    @endif
                                    @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="social-icon" target="_blank"><i class="fab fa-google-plus"></i></a>
                                    @endif
                                    @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                                    @endif
                                    @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon" target="_blank"><i class="fab fa-dribbble"></i></a>
                                    @endif
                                    
                                      
                                    </div><!-- End .social-icons -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2">
                            <div class="widget">
                                <h4 class="widget-title">{{ $langg->lang11}}</h4>
                                <ul class="links link-parts">
                                    <div class="link-part">
                                        <li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
        					             <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
        					             <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
                                    </div>
                                </ul>
                            </div><!-- End .widget -->
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2">
                            <div class="widget">
                                <h4 class="widget-title"> @if($langg->rtl != "1") About  @else نحن   @endif</h4>
                                <ul class="links">
                                        	@foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
            							       <li>
            							    	<a href="{{ route('front.page',['slug' => $data->slug , 'lang' => $sign ]) }}">
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
                                                @endif
            							    	</a>
            						    	</li>
            						       	@endforeach
                                </ul>
                            </div><!-- End .widget -->
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2">
                            <div class="widget">
                                <h4 class="widget-title">{{$langg->mainfeaturees}}</h4>
                                <ul class="links">
                                   @foreach($chunk as $service)
                                               <li><a href="#">
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
                                                  @endif
                                                  </a></li>
                                                  @endforeach
                                                  
                                            
                                </ul>
                            </div><!-- End .widget -->
                        </div>
                    </div>
                </div>

               
                 <div>
                     
                	<div class="copy-bg">
                <div class="footer-bottom">
                    <p class="footer-copyright">
                        @if(!$slang)
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
                                      @endif
                    </p>
                    <img src="{{asset('assets/images/'.$main->paymentsicon)}}" width="180px" style="max-height: 24px">
                </div>
               </div>
               </div>
               
            </div>
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->


     <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-retweet"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active"><a href="index.html">{{ $langg->lang17 }}</a></li>
              
                    
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

													<li>
														<a href="{{ route('user-logout') }}">{{ $langg->lang223 }}</a>
						</li>
						
						@endif
					  
		  @endif
                    
                       <li>
                           <a href="#">{{ DB::table('languages')->where('id','=',Session::has('language') ? Session::get('language') : 1)->first()->language  }} </a>
                          
                          <ul>
                                    	@foreach(DB::table('languages')->get() as $language)
                            	
                                  	   <li  {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }}> <a href="{{route('front.language',$language->id)}}" > {{$language->language}}</a></li>
                                  
                                     @endforeach  
                         </ul>
                   
                   </li>
                   
                    <li>
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
                         
                   </li>
                    @if(isset($categorys))
                    @foreach($categorys as $data)
                    
                     <li>
                        <a href="{{ route('front.category', ['category' => $data->slug , 'lang' => $sign ]) }}"   @if(count($data->subs) > 0 )  class="sf-with-ul" @endif>
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
                                                      
                                                       <ul>
                                                         @foreach($data->subs as $subcat)
                                                     <li>  <a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug , 'lang' => $sign])}}">
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
                                                                 <ul>
                                                                @foreach($subcat->childs as $childcat)
														      	<li><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug , 'lang' => $sign ]) }}">
                                                        	     @if(!$slang)
                                                                  @if($lang->id == 2)
                                                                  {{$childcat->name_ar}}
                                                                  @else 
                                                                  {{$childcat->name}}
                                                                  @endif 
                                                                   @else
                                                                  @if($slang == 2) 
                                                                 {{$childcat->name_ar}}
                                                                  @else
                                                                  {{$childcat->name}}
                                                                  @endif
                                                                  @endif
                                                 </a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach   
                                        @endif
                   
                   
                 
                 
                      <li>
        
                                      <a href="#" class="sf-with-ul"> @if($langg->rtl != "1") PRODUCTS  @else المنتجات   @endif</a>
                                                        
                                           
                                            <ul> 
                                                 @foreach($feature_products as $prod) 
                                           
                                         <li> 
                                         <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign ])}}" >
                                             
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
							     	             <li><a href="{{ route('front.page',['slug' => $data->slug , 'lang' => $sign]) }}">
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
   
                                       @if(!Auth::guard('web')->check())
									<li class="login">
										<a href="{{ route('user.login') }}" class="sign-log">
											<div class="links">
												<span class="sign-in">{{ $langg->lang12 }}</span> <span>|</span>
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
										<a href="{{ route('user-dashboard') }}"> {{ $langg->lang11 }}</a>
									</li>
									
									 	<li>
														<a href="{{ route('user-logout') }}"> {{ $langg->lang223 }}</a>
										</li>
												
                               
						      @endif
                        </ul>
                    </li>
                    
                      <li>
								  <a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn">{{ $langg->lang16 }}</a>
					</li>
                    
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                   @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                     <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                     @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                     <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
                                     @endif
                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                      @endif
                                      
                                       @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
                                      @endif
                                      
                                      
                                      
                                        @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="social-icon" target="_blank"><i class="fab fa-google-plus"></i></a>
                                      @endif
                                      
                                        @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                       <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon" target="_blank"><i class="fab fa-dribble"></i></a>
                                      @endif
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->


  
   <!-- newsletter-popup-form -->
@if($gs->is_popup== 1)
@if(isset($visited))
    <div class="newsletter-popup mfp-hide" id="newsletter-popup-form" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}})">
        <div class="newsletter-popup-content">
            <img src="{{asset('assets/images/'.$gs->invoice_logo)}}" style="width:100%;height:57px;" alt="Logo" class="logo-newsletter">
            <h2>{{$gs->popup_title}}</h2>
            <p> {{$gs->popup_text}}</p>
            
            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                  {{csrf_field()}}
                <div class="input-group">
                    <input type="email"  class="form-control" id="newsletter-email" name="email" placeholder="Email address" required>
                    <input type="submit" class="btn" value="Go!" style="background-color:#000;color:#fff">
                </div>
            </form>
            <div class="newsletter-subscribe">
                
            </div>
        </div>
    </div>
    @endif
    @endif

  
     <!-- Add Cart Modal -->
    <div class="modal fade" id="addCartModal" tabindex="-1" role="dialog" aria-labelledby="addCartModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body add-cart-box text-center">
            <p>@if($langg->rtl != "1") You've just added this product to the<br>cart:  @else لقد قمت باضافة هذا المنتج الى  <br> :عربة التسوق   @endif</p>
            <h4 id="productTitle"></h4>
            <img src="" id="productImage" width="100" height="100" alt="adding cart image">
           <div class="btn-actions">
                <button class="btn-primary"><a href="{{route('front.cart',$sign)}}" style="color:#fff;"> @if($langg->rtl != "1") Go to cart page  @else اذهب الى عربة التسوق    @endif</a></button>
                 <button class="btn-primary"><a href="{{route('front.index',$sign)}}" style="color:#fff;"> @if($langg->rtl != "1") Continue  @else  استمر   @endif</a></button>
            </div>
          </div>
        </div>
      </div>
    </div>


   
    
    
    
    
     <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> <b>{{ $langg->lang772 }}</b> </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                        <div class="order-tracking-content">
                            <form id="track-form" class="track-form">
                                {{ csrf_field() }}
                                <input type="text" id="track-code" class="form-control"placeholder="{{ $langg->lang773 }}" required="">
                                <button type="submit" class="btn btn-success">{{ $langg->lang774 }}</button>
                                <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                            </form>
                        </div>

                        <div>
				           
							<div id="track-order">

							</div>
                        </div>

            </div>
            </div>
        </div>
    </div>
    
    
<script type="text/javascript">

  var mainurl = "{{url('/'.$sign)}}";
  var gs      = {!! json_encode($gs) !!};
  var langg    = {!! json_encode($langg) !!};

</script>
<?php 
if($features[4]->status == 1 && $features[4]->active == 1 ){
?>
<script type="text/javascript">
    (function () {
        var whatsappNum = {{$Pagesetting->w_phone}}; 
        var whatsappNumToString = '"'+whatsappNum+'"';
        var options = {
            facebook: {{$Pagesetting->page_id}}, // Facebook page ID
            whatsapp: whatsappNumToString, // WhatsApp number
            call_to_action: "Message us", // Call to action
            button_color: "{{$gs->colors}}", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "facebook,whatsapp", // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();


</script>

<?php 
}
?>
 
 
 
 
   <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>
    <script src="{{asset('assets/front/js/jquery.js')}}"></script>
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
	
    <script src="{{asset('assets/demo_25/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/demo_25/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/demo_25/assets/js/plugins.min.js')}}"></script>
      
     <script src="{{asset('assets/demo_25/assets/js/jquery.countdown/jquery.countdown.min.js')}}"></script>
      <script src="{{asset('assets/demo_25/assets/js/plugins/isotope-docs.min.js')}}"></script>
       <script src="{{asset('assets/demo_25/assets/js/main_init.min.js')}}"></script>
    
    <script src="{{asset('assets/demo_25/assets/js/main.js')}}"></script>

     <script src="{{asset('assets/front/js/popper.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
	<!-- plugin js-->
	<script src="{{asset('assets/front/js/plugin.js')}}"></script>
	<script src="{{asset('assets/front/js/xzoom.min.js')}}"></script>
	<script src="{{asset('assets/front/js/jquery.hammer.min.js')}}"></script>
	<script src="{{asset('assets/front/js/setup.js')}}"></script>

	<script src="{{asset('assets/front/js/toastr.js')}}"></script>
	<!-- main -->
	<script src="{{asset('assets/front/js/main.js')}}"></script>
	<!-- custom -->
	<script src="{{asset('assets/front/js/custom.js')}}"></script>
  {!! $seo->google_analytics !!}

  @if($gs->is_talkto == 1)
    <!--Start of Tawk.to Script-->
      {!! $gs->talkto !!}
    <!--End of Tawk.to Script-->
  @endif
 @if($gs->is_messenger == 1)
    <!--Start of drift.to Script-->
      {!! $gs->messenger !!}
    <!--End of drift.to Script-->
  @endif
	@yield('scripts')
	@yield('js')

 <script>
	 
	 $('#prod_name').on('keyup',function(){
       var search = encodeURIComponent($(this).val());
        if(search == ""){
          $(".autocomplete").hide();
        
        }
        
      else{
        $(".autocomplete").show();
        $("#myInputautocomplet").load(mainurl+'/autosearch/producct/'+search);

         }
      });
    
    </script>

</body>
</html>