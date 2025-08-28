@php 
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$features= App\Models\Feature::all();
$categorys=App\Models\Category::where('status',1)->get();
$Pagesetting = App\Models\Pagesetting::find(1);
$main=App\Models\Generalsetting::find(1);
$chunk= App\Models\Service::get()->take(3);
$ch= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp
<style>
    .footer-bottom p + div{
        position: absolute;
    }
</style>        
<a href="https://wa.me/+201063037436" class="float" target="_blank">
<i class="fab fa-whatsapp my-float"></i></a>
<footer class="footer">
            <!--<div class="instagram-box">-->
            <!--    <div class="owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{-->
            <!--        'loop' : true,-->
            <!--        'nav': false,-->
            <!--        'dots': false,-->
            <!--        'margin' : 0,-->
            <!--        'autoHeight': true,-->
            <!--        'autoplay': true,-->
            <!--        'autoplayTimeout': 5000,-->
            <!--        'responsive': {-->
            <!--          '0': {-->
            <!--            'items': 2-->
            <!--          },-->
            <!--          '480': {-->
            <!--            'items': 3-->
            <!--          },-->
            <!--          '768': {-->
            <!--            'items': 5-->
            <!--          },-->
            <!--          '950': {-->
            <!--            'items': 7-->
            <!--          },-->
            <!--          '1200' : {-->
            <!--            'items' : 9-->
            <!--          },-->
            <!--          '1400': {-->
            <!--            'items': 11-->
            <!--          }-->
            <!--        }-->
            <!--    }">-->
            <!--        <img src="assets/images/instagram/instagram1.jpg" alt="instagram">-->
            <!--        <img src="assets/images/instagram/instagram2.jpg" alt="instagram">-->
            <!--        <img src="assets/images/instagram/instagram3.jpg" alt="instagram">-->
            <!--        <img src="assets/images/instagram/instagram4.jpg" alt="instagram">-->
            <!--        <img src="assets/images/instagram/instagram5.jpg" alt="instagram">-->
            <!--        <img src="assets/images/instagram/instagram1.jpg" alt="instagram">-->
            <!--        <img src="assets/images/instagram/instagram6.jpg" alt="instagram">-->
            <!--        <img src="assets/images/instagram/instagram7.jpg" alt="instagram">-->
            <!--        <img src="assets/images/instagram/instagram8.jpg" alt="instagram">-->
            <!--        <img src="assets/images/instagram/instagram9.jpg" alt="instagram">-->
            <!--        <img src="assets/images/instagram/instagram10.jpg" alt="instagram">-->
            <!--    </div>-->

            <!--    <div class="instagram-follow">-->
            <!--        <div class="brand">-->
            <!--            <h3>instagram</h3>-->
            <!--            <p>@Vowalaaecommerce</p>-->
            <!--        </div>-->
            <!--        <i class="fab fa-instagram"></i>-->
            <!--        <button class="btn btn-dark">FOLLOW</button>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="footer-top">
                <div class="container">
                    <div class="row row-sm">
                        <div class="col-md-7">
                            <div class="widget">
                                <h3 class="widget-title">{{ $langg->lang912 }}</h3>
                                <div class="widget-content">
                                    <p style="margin-right: 8rem;">
                                        @if(!$slang)
                                             @if($lang->id == 2)
                                              {!! $gs->footer_ar !!}
                                              @else 
                                              {!! $gs->footer !!}
                                              @endif 
                                              @else  
                                              @if($slang == 2) 
                                              {!! $gs->footer_ar !!}
                                              @else
                                              {!! $gs->footer !!} 
                                              @endif
                                               @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="widget">
                                <h3 class="widget-title">{{ $langg->lang20 }}</h3>
                                <div class="widget-content ul-separate">
                                    <ul>
                                        <li class="subwidget">
                                            <h4 class="subwidget-title">{{$langg->lang155}}</h4>
                                            <p>@if(!$slang)
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
                                               @endif</p>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="subwidget">
                                            <h4 class="subwidget-title">{{$langg->lang210}}</h4>
                                            <a href="tel:{{$main->phone }}"> {{$main->phone }}</a>
                                        </li>
                                        <li class="subwidget">
                                            <h4 class="subwidget-title">{{$langg->lang209}}</h4>
                                            <a href="mailto:{{$main->email}}">{{$main->email}}</a>
                                        </li>
                                    </ul>   
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-middle">
                <div class="container">
                    <div class="row row-sm">
                        <div class="col-md-4">
                            <div class="widget">
                                <h3 class="widget-title">{{ $langg->lang11}}</h3>
                                <div class="widget-content row row-sm">
                                    <div class="col-xl-12">
                                        <ul>
                                            <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang23 }}</a></li>
                                                    <li> @if(!Auth::guard('web')->check()) 
                                <a href="{{url('user/login')}}" class="header-user">
                                    
                                        {{ $langg->lang12 }}|{{ $langg->lang13 }}
                                    
                                </a>
                        
                        
                        
                         	@else 
        						       @if(Auth::user()->IsVendor())
        						       
        						             
                		                 <a href="{{ route('vendor-dashboard') }}" class="header-user">
                                              
                                                    {{ $langg->lang11 }}
                                               
                                            </a>
                            						               

        										
        							   @else
        							   
        						              <a href="{{ route('user-dashboard') }}" class="header-user">
                                                
                                                
                                                    {{ $langg->lang11 }}
                                              
                                            </a>

        					
        								@endif
								
							@endif</li>
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
                        </div>
                        <div class="col-md-6">
                            <div class="widget">
                                <h3 class="widget-title">{{$langg->mainfeaturees}}</h3>
                                <div class="widget-content row row-sm">
                                    <div class="col-xl-12">
                                        <ul>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
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
                </div>
            </div>
            
            	<div class="copy-bg">
            <div class="footer-bottom">
                <div class="container">
                    <p>@if(!$slang)
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
                    <img src="{{ asset('assets/images/'.$main->paymentsicon)}}">
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
                    <li class="active"><a href="{{url('front.index',$sign)}}">{{ $langg->lang17 }}</a></li>
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
                    <a href="{{ route('front.category',['category' => $data->slug , 'lang' => $sign ]) }}"   @if(count($data->subs) > 0 )  class="sf-with-ul" @endif>
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
                                                     <li>  <a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug ,'lang' => $sign])}}">
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
														      	<li><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug ,'lang' => $sign]) }}">
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
                    <li><a href="{{ route('front.contact' ,$sign) }}">{{ $langg->lang20 }}</a></li>
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
			</div>
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
	
	
    <!-- Plugins JS File -->
    <script src="{{asset('assets/demo_21/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/demo_21/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/demo_21/assets/js/plugins.min.js')}}"></script>
    <script src="{{asset('assets/demo_21/assets/js/plugins/isotope-docs.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('assets/demo_21/assets/js/main.min.js')}}"></script>
    
    
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