@php 
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$features= App\Models\Feature::all();
$categorys=App\Models\Category::where('status',1)->get();
$Pagesetting = App\Models\Pagesetting::find(1);
$main=App\Models\Generalsetting::find(1);
$chunk= App\Models\Service::get()->take(4);
$ch= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<style>
    p + div{
        position:absolute;
    }
</style>
<footer class="footer">
            <div class="instagram-box">
                <div class="container">
                    <div class="row row-sm">
                        <div class="col-md-12">
                            <div class="instagram-follow">
                                <div class="newsletter-widget">
                                    <div class="newsletter-info">
                                        <h3>{{$gs->popup_title}}</h3>
                                        <p>{{$gs->popup_text}}</p>
                                    </div>

                                    <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                                        <div class="submit-wrapper">
                                            <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="{{ $langg->lang741 }}" required>
                                    <button type="submit" class="btn">
                                        @if(!$slang)
                                           @if($lang->id == 2)
                                                اشترك  
                                              @else 
                                               SUBSCRIBE
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                                اشترك 
                                              @else
                                               SUBSCRIBE
                                              @endif
                                   @endif<i class="icon-angle-right"></i></button>
                                        </div><!-- End .header-search-wrapper -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="porto-content-box">
                    <h4>20$ OFF</h4>
                    <h3>GOVowalaa</h3>
                    <span>USE COUPONS</span>

                    <a href="#" class="box-close"><i class="icon-retweet"></i></a>
                </div>
                <!--<div class="Vowalaa-content-box">-->
                <!--    <h4>20$ OFF</h4>-->
                <!--    <h3>GOVowalaa</h3>-->
                <!--    <span>USE COUPONS</span>-->

                <!--    <a href="#" class="box-close"><i class="icon-retweet"></i></a>-->
                <!--</div>-->
            </div>

            <div class="container">
                <div class="footer-middle">
                    <div class="row row-sm">
                        <div class="col-lg-4">
                            @foreach($chunk as $service)
                            <div class="service-widget">
                                <img src="{{asset('assets/images/services/'.$service->photo)}}" style="width:30px;height:30px;">
                                <div class="service-content">
                                    <h3 class="service-title">
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
                                    </h3>
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
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="widget">
                                <h3 class="widget-title">{{ $langg->lang11}}</h3>
                                <div class="widget-content">
                                    <ul>
                                        <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang23 }}</a></li>
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
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget">
                                <h3 class="widget-title">{{ $langg->lang912 }}</h3>
                                <div class="widget-content">
                                    <ul>
                                        <li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
        					             <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
        					             <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget-group">
                                <div class="widget mb-4">
                                    <h3 class="widget-title">Follow Us</h3>
                                    <div class="widget-content">
                                    	<div class="social-icons">
			    @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                     
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                     
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                     
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="social-icon" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                     
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                    
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                     
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                     
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                    
                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon" target="_blank">
                                            <i class="fab fa-dribbble"></i>
                                        </a>
                                     
                                      @endif
                                       @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                   
                                        <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="social-icon" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    
                                      @endif
                                      
                                      
                                        @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                                      
                                       <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                                    
                                      @endif
			</div>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h3 class="widget-title">Payment Methods</h3>
                                    <div class="widget-content">
                                        <img src="{{ asset('assets/images/'.$main->paymentsicon)}}" alt="payment image" width="201" height="31">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                	<div class="copy-bg">
                <div class="footer-bottom">
                    <p>
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
                    <ul>
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
                    <li class="active"><a href="{{url('/')}}">{{ $langg->lang17 }}</a></li>
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
                                                     <li>  <a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug ,'lang' => $sign ])}}">
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
                    
                    <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
                    <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
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
						      <!--<li><a href="{{ route('user-dashboard') }}">{{ $langg->lang11}}</a></li>-->
                </ul>
            </nav><!-- End .mobile-nav -->

         	<div class="social-icons">
			    @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                     
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                     
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                     
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="social-icon" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                     
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                    
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                     
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                     
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                    
                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon" target="_blank">
                                            <i class="fab fa-dribbble"></i>
                                        </a>
                                     
                                      @endif
                                       @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                   
                                        <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="social-icon" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    
                                      @endif
                                      
                                      
                                        @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                                      
                                       <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                                    
                                      @endif
			</div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->
@if($gs->is_popup== 1)
@if(isset($visited))
    <!-- newsletter-popup-form -->
    <div class="newsletter-popup mfp-hide" id="newsletter-popup-form" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}})">
        <div class="newsletter-popup-content">
            <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Logo" class="logo-newsletter">
            <h2>{{$gs->popup_title}}</h2>
            <p>{{$gs->popup_text}}</p>
            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="{{ $langg->lang741 }}" required>
                    <input type="submit" class="btn" value="@if(!$slang)
                                           @if($lang->id == 2)
                                                اشترك  
                                              @else 
                                               SUBSCRIBE
                                              @endif 
                                               @else  
                                              @if($slang == 2) 
                                                اشترك 
                                              @else
                                               SUBSCRIBE
                                              @endif
                                   @endif">
                </div><!-- End .from-group -->
            </form>
            <div class="newsletter-subscribe">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1">
                        Don't show this popup again
                    </label>
                </div>
            </div>
        </div><!-- End .newsletter-popup-content -->
    </div><!-- End .newsletter-popup -->
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


<!-- Plugins JS File -->
    <script src="{{asset('assets/front/js/jquery.js')}}"></script>
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
	
	
	
    <script src="{{asset('assets/demo_23/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/demo_23/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/demo_23/assets/js/plugins.min.js')}}"></script>   
    <script src="{{asset('assets/demo_23/assets/js/plugins/isotope-docs.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('assets/demo_23/assets/js/main.min.js')}}"></script>
    
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
    
    $(function () {
        "use strict";
        $('.product-ajax-grid .product-ajax-grid-div').hide();    
        $('.product-ajax-grid .product-ajax-grid-div').slice(0,4).show();    
        $('.loadmore .load-more').click(function(){
            // $('.row').removeClass('custom-height');
            $('.product-ajax-grid .product-ajax-grid-div').show(300);
            $(this).hide();
        })
        
         
    });
    </script>
    
</body>
</html>
