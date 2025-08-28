@php 
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$features= App\Models\Feature::all();
$categorys=App\Models\Category::where('status',1)->get();
$Pagesetting = App\Models\Pagesetting::find(1);
$main=App\Models\Generalsetting::find(1);
$chunk= App\Models\Service::get()->take(3);
$ch= App\Models\Service::orderby('id','desc')->get()->take(3);
$lang1  = App\Models\Language::find(1);

$lang2  = App\Models\Language::find(2);
@endphp
<style>
    .footer-copyright + div{
        position: absolute;
    }
    [class^="icon-"]:before, [class*=" icon-"]:before{
        line-height: unset;
    }
    footer .product-widget figure img {
        height: unset;
    }
</style>
<footer class="footer appear-animate">
			<div class="container">
				<div class="footer-top">
					<div class="row row-sm">
						<div class="col-lg-5">
							<div class="widget widget-about">
								<h4 class="widget-title">About Us</h4>
								<a href="{{url('/')}}" class="logo mb-2">
									<img src="{{asset('assets/images/'.$gs->logo)}}" alt="Vowalaa Logo" class="footer-logo" width="111" height="46">
								</a>
								
    							<p class="mb-3">
    							    @if(!$slang)
                                     @if($lang->id == 2)
                                      {{ $gs->footer_ar }}
                                      @else 
                                      {{ $gs->footer }}
                                      @endif 
                                      @else  
                                      @if($slang == 2) 
                                      {{ $gs->footer_ar }}
                                      @else
                                      {{ $gs->footer }} 
                                      @endif
                                       @endif
    							</p>
							</div><!-- End .widget -->

							<div>
								<div class="widget">
									<h4 class="widget-title">@if($langg->rtl != "1") CONTACT INFO @else  معلومات التواصل  @endif</h4>
									<ul class="contact-info d-flex flex-wrap">
										<li>
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
    										<span class="contact-info-label">{{$langg->lang210}}:</span><a href="tel:">{{$main->phone }}</a>
    									</li>
    									<li>
    										<span class="contact-info-label">{{$langg->lang209}}:</span> <a href="mailto:{{$main->email }}">{{$main->email }}</a>
    									</li>
										<li>
											<span class="contact-info-label">Working Days/Hours:</span>Mon - Sun / 9:00 AM - 8:00 PM
										</li>
									</ul>
								</div><!-- End .widget -->
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
								</div>
							</div><!-- End .widget -->
						</div><!-- End .col-lg-6 -->
						<div class="col-lg-3 col-sm-6">
							<div class="widget">
								<h4 class="widget-title">{{ $langg->lang26}}</h4>
								@foreach($feature_products->take(3) as $prod)
								<div class="product-default left-details product-widget">
									<figure>
									    <a href="{{ route('front.product',  ['slug' => $prod->slug , 'lang' => $sign]) }}">
									<img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" 
									@if(!$slang)
                                         @if($lang->id == 2)
                                                               
                                          alt="{{$prod->alt_ar}}"        
                                          @else 
                                           alt="{{$prod->alt}}"    
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                              alt="{{$prod->alt_ar}}"    
                                          @else
                                               alt="{{$prod->alt}}"    
                                          @endif
                                           @endif>
                                           <img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" width="95" height="95" alt="product"
									@if(!$slang)
                                         @if($lang->id == 2)
                                                               
                                          alt="{{$prod->alt_ar}}"        
                                          @else 
                                           alt="{{$prod->alt}}"    
                                          @endif 
                                          @else  
                                          @if($slang == 2) 
                                              alt="{{$prod->alt_ar}}"    
                                          @else
                                               alt="{{$prod->alt}}"    
                                          @endif
                                           @endif>
								</a>
									</figure>
									<div class="product-details">
										<h2 class="product-title">
        								 <a href="{{ route('front.product', ['slug' => $prod->slug , 'lang' => $sign]) }}">
                                               @if(!$slang)
                                          @if($lang->id == 2)
                                         {!! $prod->showName_ar() !!}
                                          @else 
                                          
                                        {{ $prod->showName() }}
                                          @endif 
                                      @else  
                                          @if($slang == 2) 
                                          {!! $prod->showName_ar() !!}
                                          @else
                                          {{ $prod->showName() }}
                                          @endif
                                      @endif
                                                </a>
        								</h2>
										<div class="ratings-container">
											<div class="product-ratings">
												<span class="ratings" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></span><!-- End .ratings -->
												<span class="tooltiptext tooltip-top"></span>
											</div><!-- End .product-ratings -->
										</div><!-- End .product-container -->
										<div class="price-box">
								            <span class="old-price">{{ $prod->showPreviousPrice() }}</span>
											<span class="product-price text-dark">{{ $prod->showPrice() }}</span>
										</div><!-- End .price-box -->
									</div><!-- End .product-details -->
								</div>
								@endforeach
							</div><!-- End .widget -->
						</div>
						<div class="col-lg-4 col-sm-6">
							<div class="widget">
								<h4 class="widget-title">Twitter Feed</h4>

								<div class="twitter-feed">
									<div class="twitter-feed-content">
										<a class="d-inline-block align-top text-dark" href="#">
											<i class="mr-1 icon-twitter"></i>
										</a>
										<p class="d-inline-block">Oops, our twitter feed is unavailable right now.<br>
										<a class="meta" href="http://twitter.com/swtheme">Follow us on Twitter</a></p>

									</div><!-- End .twitter-feed-content -->
								</div><!-- End .twitter-feed -->
							</div><!-- End .widget -->
						</div>
					</div><!-- End .row -->
				</div>
			</div>

			<div class="container">
				<div class="footer-middle">
					<div class="row">
						<div class="col-lg-5 mb-4 mb-lg-0">
							<div class="widget">
								<h4 class="widget-title">{{$langg->lang906}}</h4>

								<div class="links link-parts row">
									<ul class="link-part col-sm-6 mb-0">
										<li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
        					             <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
        					             <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
									</ul>

									<ul class="link-part col-sm-6 mb-0">
										<li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
        					             <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
        					             <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
									</ul>
								</div>
							</div>
						</div><!-- End .col-lg-3 -->

						<div class="col-lg-7">
							<div class="widget">
								<h4 class="widget-title">{{$langg->mainfeaturees}}</h4>

								<div class="links link-parts row">
									<ul class="link-part col-sm-6 mb-0">
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

									<ul class="link-part col-sm-6 mb-0">
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
						</div><!-- End .col-lg-3 -->
					</div><!-- End .row -->
				</div><!-- End .footer-middle -->
			</div>

	<div class="copy-bg">
			<div class="container">
				<div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
					<p class="footer-copyright py-3 pr-4 mb-0">
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

					<img src="{{ asset('assets/images/'.$main->paymentsicon)}}" alt="payment" width="240" height="52" class="footer-payments py-3" />
				</div><!-- End .footer-bottom -->
			</div><!-- End .container -->
			</div>
		</footer><!-- End .footer -->
	</div><!-- End .page-wrapper -->

	<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

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
                <button class="btn-primary"><a href="{{url('carts')}}" style="color:#fff;"> @if($langg->rtl != "1") Go to cart page  @else اذهب الى عربة التسوق    @endif</a></button>
                 <button class="btn-primary"><a href="{{url('/')}}" style="color:#fff;"> @if($langg->rtl != "1") Continue  @else  استمر   @endif</a></button>
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
	<!--<script src="{{asset('assets/front/js/main.js')}}"></script>-->
	<!-- custom -->
	<script src="{{asset('assets/front/js/custom.js')}}"></script>
	<!-- Plugins JS File -->
    <script src="{{asset('assets/demo_155/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/demo_155/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/demo_155/assets/js/plugins.min.js')}}"></script>
    <script src="{{asset('assets/demo_155/assets/js/jquery.appear.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('assets/demo_155/assets/js/main.min.js')}}"></script>
</body>
</html>
