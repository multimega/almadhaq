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
        position: absolute;
    }
</style>
<footer class="footer">
			<div class="container">
				<div class="footer-middle">
					<div class="row">
						<div class="col-lg-4 col-xl-3 col-sm-6 pb-5 pb-sm-0">
							<div class="widget">
								<h4 class="widget-title"> {{$langg->lang20}}</h4>
								<ul class="contact-info">
									<li>
										<i class="icon-direction"></i>
										<span class="contact-info-label">{{$langg->lang155}}:</span>
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
                                               @endif
									</li>
									<li>
										<i class="icon-phone-1"></i>
										<span class="contact-info-label">{{$langg->lang210}}:</span><a href="tel:">{{$main->phone }}</a>
									</li>
									<li>
										<i class="icon-envolope"></i>
										<span class="contact-info-label">{{$langg->lang209}}:</span> <a href="mailto:{{$main->email }}">{{$main->email }}</a>
									</li>
								</ul>
							</div><!-- End .widget -->
						</div><!-- End .col-lg-3 -->

						<div class="col-xl-2 offset-xl-1 col-lg-2 col-sm-3 pb-5 pb-sm-0">
							<div class="widget">
								<h4 class="widget-title">{{$langg->lang906}}</h4>

								<ul class="links">
									<li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
    					             <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
    					             <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
								</ul>
							</div><!-- End .widget -->
						</div><!-- End .col-md-3 -->

						<div class="col-xl-2 col-lg-3 col-sm-3 pb-5 pb-sm-0">
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
						</div><!-- End .col-md-5 -->

						<div class="col-lg-3 offset-xl-1 offset-lg-0 offset-sm-6 col-sm-6">
							<div class="widget widget-newsletter">
								<h4 class="widget-title">@if(!$slang)
                                       @if($lang->id == 2)
                                            {{$gs->popup_title_ar}}  
                                          @else 
                                           {{$gs->popup_title}}
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            {{$gs->popup_title_ar}} 
                                          @else
                                           {{$gs->popup_title}}
                                          @endif
                                   @endif</h4>

								<p class="mb-2 mr-3">@if(!$slang)
                                       @if($lang->id == 2)
                                            {{$gs->popup_text_ar}}  
                                          @else 
                                           {{$gs->popup_text}}
                                          @endif 
                                           @else  
                                          @if($slang == 2) 
                                            {{$gs->popup_text_ar}} 
                                          @else
                                           {{$gs->popup_text}}
                                          @endif
                                   @endif</p>

								<form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                  {{csrf_field()}}
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
								</form>
							</div><!-- End .widget -->
						</div><!-- End .col-lg-9 -->
					</div><!-- End .row -->
				</div><!-- End .footer-middle -->
	<div class="copy-bg">
				<div class="footer-bottom d-flex flex-column flex-lg-row align-items-sm-center">
					<p class="footer-copyright mb-lg-0">
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

					<div class="social-icons ml-lg-auto">
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
					</div><!-- End .social-icons -->
				</div><!-- End .footer-bottom -->
			</div>
			</div><!-- End .container -->
		</footer><!-- End .footer -->
	</div><!-- End .page-wrapper -->

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
	
    <script src="{{asset('assets/front/js/popper.min.js')}}"></script>
	 bootstrap 
	<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
	 plugin js
	<script src="{{asset('assets/front/js/plugin.js')}}" defer></script>
	<script src="{{asset('assets/front/js/xzoom.min.js')}}" defer></script>
	<script src="{{asset('assets/front/js/jquery.hammer.min.js')}}" defer></script>
	<script src="{{asset('assets/front/js/setup.js')}}" defer></script>

	<script src="{{asset('assets/front/js/toastr.js')}}" defer></script>
	 <!--main -->
	<script src="{{asset('assets/front/js/main.js')}}"></script>
	 <!--custom -->
	<script src="{{asset('assets/front/js/custom.js')}}" defer></script>

    <!--<script src="{{asset('assets/front/js/js.min.js')}}" defer></script>-->
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}" defer></script>
    
    <script src="{{asset('assets/demo_222/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/demo_222/assets/js/bootstrap.bundle.min.js')}}" defer></script>
    <script src="{{asset('assets/demo_222/assets/js/plugins.min.js')}}" defer></script>

    <!-- Main JS File -->
    <script src="{{asset('assets/demo_222/assets/js/main.js')}}"></script>
</body>
</html>