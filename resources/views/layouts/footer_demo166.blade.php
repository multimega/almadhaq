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
</style>
<footer class="footer">
				<div class="feature-boxes-container pt-4">
					<div class="container">
						<div class="row">
							@foreach($chunk as $service)
							<div class="col-md-4">
								<div class="feature-box feature-rounded align-items-center">
									<i class="icon-{{$service->icon}} mb-0"></i>

									<div class="feature-box-content">
										<h3>
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
									</div><!-- End .feature-box-content -->
								</div><!-- End .feature-box -->
							</div><!-- End .col-md-4 -->
							@endforeach
						</div><!-- End .row -->
					</div><!-- End .container -->
				</div><!-- End .section-6 -->

				<div class="footer-middle">
					<div class="container">
						<div class="row">
							<div class="col-lg-3 mb-2 mb-md-0">
								<div class="widget">
									<h4 class="widget-title"> @if($langg->rtl != "1") CONTACT INFO @else  معلومات التواصل  @endif</h4>
									<ul class="contact-info">
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
											<span class="contact-info-label">Working Days/Hours:</span>
											Mon - Sun / 9:00 AM - 8:00 PM
										</li>
									</ul>
									<div class="social-icons mb-3 mb-lg-0">
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
								</div><!-- End .widget -->
							</div><!-- End .col-lg-3 -->

							<div class="col-lg-9">
								<div class="widget widget-newsletter d-md-flex d-block">
									<div class="col-md-6 pr-3 pl-0">
										<h4 class="widget-title">
										    @if(!$slang)
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
                                           @endif
										</h4>

										<p class="mb-lg-0">
										    @if(!$slang)
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
                                           @endif
										</p>
									</div>

									<div class="col-md-6 d-flex align-items-center pr-0 pl-0 pl-md-3 pr-md-3">
										<form action="{{route('front.subscribe')}}" id="subscribeform" method="POST" class="d-flex mb-0 w-100">
                  {{csrf_field()}}
											<input type="email" class="form-control mb-0" id="newsletter-email" name="newsletter-email" placeholder="{{ $langg->lang741 }}" required="">

											<input type="submit" class="btn btn-primary shadow-none" value="@if(!$slang)
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
									</div><!-- End .col-lg-6 -->
								</div><!-- End .widget -->

								<div class="row">
									<div class="col-sm-4">
										<div class="widget">
											<h4 class="widget-title">{{$langg->lang906}}</h4>

											<div class="links link-parts row mb-sm-0 mb-3">
												<ul class="link-part col-sm-6 mb-sm-0 mb-1">
												    <li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
                    					             <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
                    					             <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
												</ul>
											</div>
										</div><!-- End .widget -->
									</div><!-- End .col-sm-6 -->

									<div class="col-sm-4">
										<div class="widget">
											<h4 class="widget-title">{{$langg->mainfeaturees}}</h4>

											<div class="links link-parts row">
												<ul class="link-part col-sm-6 mb-sm-0 mb-1">
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
										</div><!-- End .widget -->
									</div><!-- End .col-sm-6 -->
								</div><!-- End .row -->
							</div><!-- End .col-lg-9 -->
						</div><!-- End .row -->
					</div><!-- End .container -->
				</div><!-- End .footer-middle -->
	<div class="copy-bg">
				<div class="footer-bottom">
					<div class="container d-flex justify-content-between align-items-center flex-wrap">
						<p class="footer-copyright py-3 pr-sm-4 pr-0 mb-0">
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

						<img src="{{ asset('assets/images/'.$main->paymentsicon)}}" alt="payment methods" class="footer-payments py-3">
					</div><!-- End .container -->
				</div><!-- End .footer-bottom -->
				</div>
			</footer>
		</div><!-- End .page-wrapper -->

		<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

		<div class="mobile-menu-container">
			<div class="mobile-menu-wrapper">
				<span class="mobile-menu-close"><i class="icon-cancel"></i></span>
				<nav class="mobile-nav">
					<ul class="mobile-menu">
						<li class="border-0">
							<a href="#">{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</a>
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
						<li class="border-0 mb-2">
							<a href="#">ENGLISH</a>
							<ul>
								<li><a href="{{route('front.language',$lang1)}}">ENGLISH</a></li>
                                <li><a href="{{route('front.language',$lang2)}}">عربى</a></li>
							</ul>
						</li>
						<li class="active border-0"><a href="{{url('/')}}">{{ $langg->lang17 }}</a></li>
										<li class="bordero-0"> <a class="bordero-0" href="#">{{ $langg->lang14 }}</a>
										<ul>
										@foreach($categories as $category)
										<li class="border-0">
											<a href="{{ route('front.category',['category' => $category->slug , 'lang' => $sign ]) }}" class="border-0">
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
    								    <li class="bordero-0">
    									  <a  class="bordero-0" href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug ,'lang' => $sign])}}" class="border-0">
    
                          
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
								<li class="bordero-0"><a class="bordero-0" href="{{ route('front.offers',['slug' => $data->slug , 'lang' => $sign ]) }}"> @if(!$slang)
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
							 <li class="bordero-0"><a class="bordero-0" href="{{ route('front.products',$sign) }}">{{ $langg->lang25 }}</a></li>
							 @endif
                            
                            <li class="bordero-0">
                                 <a class="bordero-0" href="#"> @if($langg->rtl != "1") PAGES  @else الصفحات   @endif</a>
                                   
                                     <ul>
                                
							                    <li class="bordero-0"><a class="bordero-0" href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
							                        @foreach(DB::table('pages')->where('header','=',1)->get() as $data)
							     	             <li class="bordero-0"><a class="bordero-0" href="{{ route('front.page',['slug' => $data->slug , 'lang' => $sign ]) }}">
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
                                	<li class="bordero-0"><a class="bordero-0" href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
					</ul>
				</nav><!-- End .mobile-nav -->
                       
				<div class="social-icons d-flex">
					@if(App\Models\Socialsetting::find(1)->f_status == 1)
                     <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon mr-3" target="_blank"><i class="icon-facebook"></i></a>
                        @endif
                         @if(App\Models\Socialsetting::find(1)->t_status == 1)
                         <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon mr-3" target="_blank"><i class="icon-twitter"></i></a>
                         @endif
                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                       <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon mr-3" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                      @endif
                      
                       @if(App\Models\Socialsetting::find(1)->i_status == 1)
                       <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="social-icon mr-3" target="_blank"><i class="icon-instagram"></i></a>
                      @endif
                        @if(App\Models\Socialsetting::find(1)->g_status == 1)
                       <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="social-icon mr-3" target="_blank"><i class="fab fa-google-plus"></i></a>
                      @endif
                      
                        @if(App\Models\Socialsetting::find(1)->d_status == 1)
                       <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon social-dribbble fab fa-dribbble mr-3" target="_blank"></a>
                      @endif
      
                        @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                      
                       <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="social-icon social-youtube fab fa-youtube" target="_blank"></a>
                    
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
    <script src="{{asset('assets/demo_166/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/demo_166/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/demo_166/assets/js/plugins.min.js')}}"></script>
    <script src="{{asset('assets/demo_166/assets/js/jquery.appear.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('assets/demo_166/assets/js/main.min.js')}}"></script>
	</body>
</html>
