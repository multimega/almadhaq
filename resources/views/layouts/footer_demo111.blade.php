
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
  
  
  
  
  
    <footer class="footer appear-animate">
            <div class="footer-middle">
                <div class="container">
                    <div class="row row-sm">
                        <div class="col-lg-9">
                            <div class="row row-sm">
                                <div class="col-sm-4">
                                    <div class="widget">
                                        <h4 class="widget-title"> @if($langg->rtl != "1") CONTACT INFO @else  معلومات التواصل  @endif</h4>
                                        <ul class="contact-info">
                                            <li>
                                                <span class="contact-info-label">{{$langg->lang210}}:</span>Toll Free <a href="tel:">{{$main->phone }}</a>
                                            </li>
                                            <li>
                                                <span class="contact-info-label">{{$langg->lang209}}:</span> <a href="mailto:mail@example.com">{{$main->email }}</a>
                                            </li>
                                            
                                        </ul>
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
                                        </div>

                                    </div><!-- End .widget -->
                                </div><!-- End .col-md-3 -->
                                <div class="col-sm-4">
                                    <div class="widget">
                                       	<h4 class="widget-title pb-1">{{ $langg->lang499 }}</h4>

								<ul class="links">
									<li><a href="#">{{ $langg->lang19 }}</a></li>
									<li><a href="#">{{ $langg->lang772 }}</a></li>
									<li><a href="#">{{ $langg->lang602 }}</a></li>
									<li><a href="#">{{ $langg->lang962 }}</a></li>
									<li><a href="#">{{ $langg->lang963 }}</a></li>
									<li><a href="#">{{ $langg->lang906 }}</a></li>
								
									<li><a href="#">{{ $langg->lang93 }}</a></li>
								</ul>
                                    </div><!-- End .widget -->
                                </div><!-- End .col-md-5 -->

                                <div class="col-sm-4">
                                    <div class="widget">
                                        <h4 class="widget-title invisible">a</h4>
                                        <ul class="links">
                                            <li><a href="#">{{ $langg->lang912 }}</a></li>
                                           <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
                                            <li><a href="#">{{ $langg->lang11 }}</a></li>
                                            <li><a href="#">{{ $langg->lang964 }}</a></li>
                                        </ul>
                                    </div><!-- End .widget -->
                                </div><!-- End .col-md-5 -->


                            </div><!-- End .row -->
                        </div><!-- End .col-lg-8 -->

                        <div class="col-lg-3">
                            <div class="widget widget-newsletter">
                                <h4 class="widget-title">{{$langg->newsletter}}</h4>
                                <p> @if(!$slang)
                                                          @if($lang->id == 2)
                                                          {{$gs->subscribee_message_ar}}
                                                          @else 
                                                          
                                                          {{$gs->subscribee_message}}
                                                          @endif 
                                                      @else  
                                                          @if($slang == 2) 
                                                          {{$gs->subscribee_message_ar}}
                                                          @else
                                                           {{$gs->subscribee_message}}
                                                          @endif
                                                      @endif</p>
                              
                              
                              
                              
                              
                              
                                <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST" >
                               {{csrf_field()}}
                              
                                  
                              
                                <input type="email" class="form-control" name="email" id="email" required="" placeholder="{{ $langg->lang49 }}">
                                
                                  
                             
                              
                              <input type="submit" class="btn"   value = "{{ ($langg->rtl != '1')  ?    'Subscribe Now' :  'ابدأ' }}">
                                   
                                </form>
                            </div><!-- End .widget -->
                        </div><!-- End .col-lg-4 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-middle -->

            	<div class="copy-bg">
            	 <div style="background-color:{{$main->copyright_color}}">
            <div class="container">
                <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
                    <p class="footer-copyright"> {!! $main->copyright !!} </p>

                    <img src="{{ asset('assets/images/'.$main->paymentsicon)}}" alt="payment methods" class="footer-payments">
                </div><!-- End .footer-bottom -->
            </div><!-- End .container -->
            </div>
            </div>
            
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

  
	<div class="mobile-menu-container">
		<div class="mobile-menu-wrapper">
			<span class="mobile-menu-close"><i class="icon-cancel"></i></span>
			<nav class="mobile-nav">
				<ul class="mobile-menu mb-3">
					<li class="active"><a href="index.html">{{ route('front.index',$sign) }}</a></li>
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
														      	<li><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug , 'lang' => $sign]) }}">
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
						<a href="#">{{ $langg->lang901 }}<span class="tip tip-hot">{{ $langg->lang30 }}!</span></a>
						<ul>
							<li><a href="#">{{ $langg->lang900 }}</a></li>
							<li>
								<a href="#">{{ $langg->lang7 }}</a>
								<ul>
									<li><a href="#">{{ $langg->lang765 }}</a></li>
									<li><a href="#">{{ $langg->lang161 }}</a></li>
									<li><a href="#">{{ $langg->lang217 }}</a></li>
								</ul>
							</li>
						
							<li><a href="#">{{ $langg->lang906 }}</a></li>
						 
					
						 	
						 		@if(!Auth::guard('web')->check())
						         
						         <li>  <a href="{{ route('user.login') }}"  class="login-link"> {{ $langg->lang101 }} </a> </li>
  						
					     	@else 
        						       @if(Auth::user()->IsVendor())
        						       
        						            <li> 
        						            
        						            <a href="{{ route('vendor-dashboard') }}" class="login-link">{{ $langg->lang11 }} </a>
        						            
        						            </li>
        						             
        						             
        									   <li> 	<a href="{{ route('user-logout') }}" class="login-link">{{ $langg->lang223 }} </a> </li>
        										
        							   @else
        							   
        							      <li> 
        							            <a href="{{ route('user-dashboard') }}" class="login-link">{{ $langg->lang11 }} </a> </li>
        						             
        						             
        								    <li> 		<a href="{{ route('user-logout') }}" class="login-link">{{ $langg->lang223 }}</a> </li>
        							  
        					
        								@endif
								
							@endif
								
								 

						
						</ul>
					</li>
					<li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang35 }}</a>
						<ul>
							<li><a href="">{{ $langg->lang43 }}</a></li>
						</ul>
					</li>
					<li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang228 }}</a></li>
					<li><a href="#">{{ $langg->lang33 }}!<span class="tip tip-hot">{{ $langg->lang30 }}!</span></a></li>

				</ul>

				<ul class="mobile-menu">
				
					<li><a href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}</a></li>
					<li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang35 }}</a></li>
					<li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang228 }}</a></li>
					<li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
				</ul>
			</nav><!-- End .mobile-nav -->

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
		</div><!-- End .mobile-menu-wrapper -->
	</div><!-- End .mobile-menu-container -->




  
	<!-- Add Cart Modal -->
	
@if($gs->is_popup== 1)
@if(isset($visited))
    <div class="newsletter-popup mfp-hide" id="newsletter-popup-form" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}})">
        <div class="newsletter-popup-content">
            <img src="{{asset('assets/images/'.$gs->logo)}}" style="width:100%;height:57px;" alt="Logo" class="logo-newsletter">
            <h2>{{$gs->popup_title}}</h2>
            <p> {{$gs->popup_text}}</p>
            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                  {{csrf_field()}}
                <div class="input-group">
                    <input type="email"  class="form-control" id="newsletter-email" name="email" placeholder="Email address" required>
                    <input type="submit" class="btn" value="Go!">
                </div>
            </form>
            <div class="newsletter-subscribe">
                
            </div>
        </div>
    </div>
    @endif  
@endif 

	<div class="modal fade" id="addCartModal" tabindex="-1" role="dialog" aria-labelledby="addCartModal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-body add-cart-box text-center">
			<p>@if($langg->rtl != "1") You've just added this product to the<br>cart:  @else لقد قمت باضافة هذا المنتج الى  <br> :عربة التسوق   @endif</p>
			<h4 id="productTitle"></h4>
			<img src="#" id="productImage" width="100" height="100" alt="adding cart image">
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




    <script src="{{asset('assets/front/js/jquery.js')}}"></script>
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
	
    <script src="{{asset('assets/demo-11/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/demo-11/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/demo-11/assets/js/plugins.min.js')}}"></script>
     <script src="{{asset('assets/demo-11/assets/js/jquery.appear.min.js')}}"></script> 
    <script src="{{asset('assets/demo-11/assets/js/main.min.js')}}"></script>

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
	<!-- Plugins JS File -->

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
