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
    .footer-copyright + div{
        /*margin:auto;*/
    }
</style>


        <section class="phone-navbar">
           <nav class="navbar show-on-phone">
                <a href="{{route('front.index',$sign)}}" class="{{ Route::is('front.index') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                   {{ $langg->lang17 }}
                </a>
                <!--<a href="#categories">
                    <i class="fas fa-th-large"></i>
                    Categories
                </a>-->
                <a href="{{ route('front.cart',$sign) }}" class="cart {{ Route::is('front.cart') ? 'active' : '' }}">
                    <span class="cart-count"  id="footer-cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                    <i class="fas fa-shopping-cart"></i>
                    {{ $langg->lang3 }}
                </a>
                @if(!Auth::guard('web')->check()) 
                    <a href="{{url('user/login')}}" class="{{ Route::is('user.login') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                       {{ $langg->lang11 }}
                    </a>
                @endif
                @if(Auth::guard('web')->check())
                    <a href="{{ route('user-profile') }}" class="{{ Route::is('user-profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        {{ $langg->lang11 }}
                    </a>
                @endif
        
            </nav>
        </section>
            <footer class="footer" >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="widget">
                                <h4 class="widget-title">{{ $langg->lang20 }}</h4>
                                <ul class="contact-info">
                                    <li>
                                        <span class="contact-info-label">{{$langg->lang155}}:</span>@if(!$slang)
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
                                               @endif
                                    </li>
                                    <li>
                                        <span class="contact-info-label">{{$langg->lang184}}:</span> <a href="tel:{{$main->phone }}">{{$main->phone }}</a>
                                    </li>
                                </ul>
                            </div><!-- End .widget -->
                         	<div class="social-icons" style="margin-bottom:2.4rem;">
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
                                                <i class="fab fa-snapchat-ghost"></i>
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
    			
    			
    			
    			<!-- End .social-icons -->
    
                        </div>
                        <!-- End .col-lg-3 -->
                        <div class="col-md-4">
                                                <div class="widget">
                                                    <h4 class="widget-title">{{ $langg->lang11}}</h4>
            
                                                    <div class="">
                                                            <ul class="links">
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
                                                        <!--</div><!-- End .col-sm-6 -->
                                                        <!--<div class="col-sm-6 col-md-5">-->
                                                        <!--    <ul class="links">-->
                                                        <!--        <li><a href="#">Orders History</a></li>-->
                                                        <!--        <li><a href="#">Advanced Search</a></li>-->
                                                        <!--        <li><a href="#" class="login-link">Login</a></li>-->
                                                        <!--    </ul>-->
                                                        <!--</div><!-- End .col-sm-6 -->
                                                    </div><!-- End .row -->
                                                </div><!-- End .widget -->
                                            </div><!-- End .col-md-5 -->
            
                        <div class="col-md-4">
                                                <div class="widget">
                                                    <h4 class="widget-title">{{$langg->mainfeaturees}}</h4>
                                                        <div class="">
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
                                                        </div>
                                                        <!--<div class="col-sm-6">-->
                                                        <!--    <ul class="links">-->
                                                        <!--        <li><a href="#">Powerful Admin Panel</a></li>-->
                                                        <!--        <li><a href="#">Mobile & Retina Optimized</a></li>-->
                                                        <!--    </ul>-->
                                                        <!--</div><!-- End .col-sm-6 -->
                                                        
                                                    <!--</div><!-- End .row -->
                                                </div><!-- End .widget -->
                                            </div><!-- End .col-md-7 -->
                        
                            <!--<div class="footer-top">
                                <div class="widget widget-newsletter">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4 class="widget-title">{{$langg->newsletter}}</h4>
                                            <p>Get all the latest information on Events,Sales and Offers. Sign up for newsletter today</p>
                                        </div> 
            
                                        <div class="col-lg-6">
                                            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                                             {{csrf_field()}}
                                                <input type="email" class="form-control" placeholder="{{ $langg->lang741 }}" required>
            
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
                                            </form>
                                        </div> 
                                    </div> 
                                </div> 
                            </div>
                             <hr class="mb-1">-->
                             <!-- End .footer-top -->
                            
    
                         
                    </div>
                    <hr class="mb-1">
                    <div class="copy-bg">   
                      
                            <div class="footer-bottom">
                                <p class="footer-copyright" style="">
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
            
                                <img src="{{ asset('assets/images/'.$main->paymentsicon)}}" alt="payment methods" class="footer-payments">
                            </div>
                        <!-- End .footer-bottom -->
                         
                    </div>
                </div>
             
        <!-- End .container -->
        </footer>
        <!-- End .footer -->
        
    </div><!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active"><a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a></li>
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
                                                     <li>  <a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug,'lang' => $sign])}}">
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
														      	<li><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug,'lang'=> $sign]) }}">
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
                                            <i class="fab fa-snapchat-ghost"></i>
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
<!--@if($gs->is_popup== 1)
    @if(isset($visited))
        <div class="newsletter-popup mfp-hide" id="newsletter-popup-form" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}})">
        <div class="newsletter-popup-content">
            <img src="{{asset('assets/images/'.$gs->logo)}}" style="width:100%;height:57px;" alt="Logo" class="logo-newsletter">
            <h2>{{$gs->popup_title}}</h2>
            <p> {{$gs->popup_text}}</p>
            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                  {{csrf_field()}}
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="{{ $langg->lang741 }}" required>
                    <input type="submit" style="color:white; background-color:{{$gs->colors}}" class="btn" value="@if(!$slang)
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
                                   @endif ">
                </div>
            </form>
            <div class="newsletter-subscribe">
                
            </div>
        </div>
    </div>
    @endif
@endif-->
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
    <script src="{{asset('assets/demo_10/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/demo_10/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/demo_10/assets/js/plugins.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('assets/demo_10/assets/js/main.min.js')}}"></script>
    
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
    <script>
    $(function () {
    "use strict";
        $('#active-slider:first').addClass('active');
    });
    </script>
    
    
</body>
</html>
