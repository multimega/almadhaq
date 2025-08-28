@php 
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$features= App\Models\Feature::all();
$categorys=App\Models\Category::where('status',1)->get();
$Pagesetting = App\Models\Pagesetting::find(1);
$main=App\Models\Generalsetting::find(1);
$chunk= App\Models\Service::where('user_id','=',0)->get()->take(4);
$ch= App\Models\Service::orderby('id','desc')->get()->take(4);
$lang1  = App\Models\Language::find(1);

$lang2  = App\Models\Language::find(2);
@endphp
<style>
    #NewletterSuccessModal .modal-content{
        height: 400px;
        width: 400px;
        border-radius: 50%;
        background-image: url("https://maisonarabelle.com/assets/images/thumbnails/16584282961lUkUmH1.jpg");
        background-position: initial;
        background-repeat: no-repeat;
        background-size: cover;
        margin: auto;
        display: flex;
        align-items: center;
        flex-direction: row;
    }
    #NewletterSuccessModal.show{
        background: rgba(0,0,0,.4);
    }
    #NewletterSuccessModal .modal-body{
        overflow-y: unset;
    }
    #NewletterSuccessModal h3{
        color: #fff;
    }
    #NewletterSuccessModal p{
        color: #eee;
        font-size: 16px;
    }
    @media only screen and (max-width: 767px){
        #NewletterSuccessModal .modal-content{
            height: 300px;
            width: 300px;
        }
        
    }
</style>
<footer class="footer" style="background-color:{{$gs->footer_color}}">
			<div class="footer-top">
				<div class="container d-flex align-items-center justify-content-between flex-wrap">
					<div class="footer-left d-md-flex align-items-center">
						<div class="widget-newsletter-info">
							<h5 class="widget-newsletter-title text-uppercase m-b-1 text-white">{{$gs->popup_title}}</h5>
							<p class="widget-newsletter-content mb-0">{{$gs->popup_text}}</p>
						</div>
						<form id="form-subscribe">
						    @csrf
						    
							<div class="footer-submit-wrapper">
							    <div class="row align-items-end">
							        <div class="col-sm-12 col-lg-5">
							            <div class="form-group">
							                <label class="text-white">{{ $langg->lang310 }}</label>
							                <input type="text" class="form-control" name="name" placeholder="{{ $langg->lang310 }}" id="newsletter-name" required>
							                @error('name')
							                    <span class="alert-danger">{{$message}}</span>
							                @enderror
							            </div>
							        </div>
							        {{--
							        <div class="col-lg-4 col-6">
							            <div class="form-group">
							                <label class="text-white">{{ $langg->lang1200 }}</label>
							                <input type="date" class="form-control" name="birth_date" placeholder="{{ $langg->lang1200 }}" id="newsletter-birth-date" required>
							                @error('birthdate')
							                    <span class="alert-danger">{{$message}}</span>
							                @enderror
							            </div>
							        </div>
							        --}}
							        <div class="col-sm-12 col-lg-5">
							            <div class="form-group">
							                <label class="text-white">{{ $langg->lang49 }}</label>
							                <input type="email" class="form-control w-100" id="newsletter-email" name="email" placeholder="{{ $langg->lang741 }}" required>
							                @error('email')
							                    <span class="alert-danger">{{$message}}</span>
							                @enderror
							            </div>
							        </div>
							        <div class="col-sm-12 col-lg-2">
										<div class="form-group">
											<button class="btn form-control font-weight-bold text-dark" type="submit">@if(!$slang)
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
												@endif
											</button>
										</div>
							        </div>
							    </div>
							</div>
						</form>
					</div>
					<div class="footer-right">
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
											<img src="{{asset("assets/images/x-twitter.svg")}}" alt="...">
                                        </a>
                                
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                     
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                     
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                    
                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon" target="_blank">
                                            <!--<i class="fab fa-tiktok"></i>-->
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="15">
                                                <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                                <path fill="#fff" d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
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
					</div>
				</div>
			</div>
			<div class="footer-middle">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-xl-4">
							<div class="widget">
								<h4 class="widget-title">@if($langg->rtl != "1") CONTACT INFO @else  معلومات التواصل  @endif</h4>

								<div class="row">
									<div class="col-sm-6">
										<div class="contact-widget">
											<h4 class="widget-title">{{$langg->lang155}}:</h4>
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
                                                   @endif
											</a>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="contact-widget email">
											<h4 class="widget-title">{{$langg->lang209}}</h4>
											<a href="mailto:{{$main->email }}">{{$main->email }}</a>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="contact-widget">
											<h4 class="widget-title">{{$langg->lang210}}</h4>
											<a href="tel:{{$main->phone }}" class="dir-ltr">{{$main->phone }}</a>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="contact-widget">
											<h4 class="widget-title">WORKING DAYS/HOURS</h4>
											<a href="#">Mon - Sun / 9:00 AM - 8:00 PM</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6 col-lg-3 col-xl-4">
							<div class="widget">
								<h4 class="widget-title">{{$langg->lang906}}</h4>
								<ul class="links link-parts row">
									<div class="link-part col-xl-4">
									    <li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>
        					            <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>
		                                @foreach(DB::table('pages')->where('header','=',1)->get() as $data)
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
                                	    <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>
									</div>
									<!--<div class="link-part col-xl-8">-->
									<!--	<li><a href="{{ route('front.faq',$sign) }}">{{ $langg->lang19 }}</a></li>-->
        	<!--				             <li><a href="{{ route('front.blog',$sign) }}">{{ $langg->lang18 }}</a></li>-->
        	<!--				             <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang20 }}</a></li>-->
									<!--</div>-->
								</ul>
							</div><!-- End .widget -->
						</div>
						<div class="col-6 col-lg-3 col-xl-4">
						    
							<div class="widget">
								<h4 class="widget-title">{{$langg->mainfeaturees}}</h4>
								<ul class="links link-parts row">
									<div class="link-part col-xl-6">
										@foreach($chunk as $service )
                                        
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
									</div>
									<!--<div class="link-part col-xl-6">-->
									<!--	@foreach($chunk as $service)-->
                    
         <!--                              <li><a href="#">-->
         <!--                                     @if(!$slang)-->
         <!--                                     @if($lang->id == 2)-->
         <!--                                       {{ $service->title_ar }}-->
         <!--                                     @else -->
         <!--                                    	{{ $service->title }}-->
         <!--                                     @endif -->
         <!--                                      @else  -->
         <!--                                     @if($slang == 2) -->
         <!--                                     	{{ $service->title_ar }}-->
         <!--                                     @else-->
         <!--                                     	{{ $service->title }}-->
         <!--                                     @endif-->
         <!--                                 @endif-->
         <!--                                 </a></li>-->
         <!--                                 @endforeach-->
									<!--</div>-->
								</ul>
							</div><!-- End .widget -->
							
							
						</div>
					</div>
				</div>
			</div>

			<div class="copy-bg">
			<div class="footer-bottom">
				<div class="container top-border d-flex align-items-center justify-content-center justify-content-lg-between flex-wrap">
					<p class="footer-copyright py-3 pr-4 mb-0" style="color:{{$gs->copyright_color}}">
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

					<img src="{{ asset('assets/images/'.$main->paymentsicon)}}" alt="payment" height="52" style="max-width: 400px" class="py-3" />
				</div>
			</div>
			</div>
		</footer>
	</div><!-- End .page-wrapper -->

	<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

	<div class="mobile-menu-container">
			<div class="mobile-menu-wrapper">
				<span class="mobile-menu-close"><i class="icon-cancel"></i></span>
				<nav class="mobile-nav">
					<ul class="mobile-menu">
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
                            {{--
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
					            </li>
                                                      --}}
				</nav><!-- End .mobile-nav -->
                       
				<div class="social-icons d-flex">
					@if(App\Models\Socialsetting::find(1)->f_status == 1)
                     <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon mr-3" target="_blank"><i class="icon-facebook"></i></a>
                        @endif
                         @if(App\Models\Socialsetting::find(1)->t_status == 1)
                         <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon mr-3" target="_blank"><img src="{{asset("assets/images/x-twitter.svg")}}" alt="..."></a>
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
                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="social-icon" target="_blank">
                            <!--<i class="fab fa-tiktok"></i>-->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="15">
                                <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                <path fill="#fff" d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                        </a>
                      @endif
                      
                        @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                      
                       <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="social-icon social-youtube fab fa-youtube" target="_blank"></a>
                    
                      @endif
				</div><!-- End .social-icons -->
			</div><!-- End .mobile-menu-wrapper -->
		</div><!-- End .mobile-menu-container -->

		<!-- newsletter-popup-form -->
		
@if($gs->is_popup== 1)
    @if(isset($visited))
    <div class="newsletter-popup mfp-hide" id="newsletter-popup-form" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}})">
        <div class="newsletter-popup-content">
            {{--<img src="{{asset('assets/images/'.$gs->logo)}}" alt="Logo" class="logo-newsletter">--}}
            <h2>{{$gs->popup_title}}</h2>
            <p>{{$gs->popup_text}}</p>
            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
			    @csrf
                <div class="row align-items-end">
			        <div class="col-6">
			            <div class="form-group">
			                <label>{{ $langg->lang310 }}</label>
			                <input type="text" class="form-control" name="name" placeholder="{{ $langg->lang310 }}" required>
			            </div>
			        </div>
			        {{--
			        <div class="col-6">
			            <div class="form-group">
			                <label>{{ $langg->lang1200 }}</label>
			                <input type="date" class="form-control" name="newsletter-birthdate" placeholder="{{ $langg->lang1200 }}" required>
			            </div>
			        </div>
			        --}}
			        <div class="col-6">
			            <div class="form-group">
			                <label>{{ $langg->lang49 }}</label>
			                <input type="email" class="form-control" id="newsletter-email" name="email" placeholder="{{ $langg->lang741 }}" required>
			            </div>
			        </div>
			        <div class="col-6">
			            <div class="form-group">
		                    <button class="btn form-control font-weight-bold text-dark" type="submit">@if(!$slang)
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
                                @endif
                            </button>
			            </div>
			        </div>
			    </div>
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

    <!-- Newsletter Modal Success -->
    <div class="modal fade" id="NewletterSuccessModal" tabindex="-1" role="dialog" aria-labelledby="NewletterSuccessModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body text-center">
            <h3>Thank you for subscribing to our newsletter.</h3>
            <p>Here is your discount code: <b>NEWS10</b></p>
          </div>
        </div>
      </div>
    </div>
    
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
    <script src="{{asset('assets/demo_11111/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/demo_11111/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/demo_11111/assets/js/plugins.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('assets/demo_11111/assets/js/main.min.js')}}"></script>
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
	 $(document).ready(function(){
	     $('form#form-subscribe').submit(function(event){
	       console.log("Test")
	        event.preventDefault();
	        let sub_name = $('input#newsletter-name').val();
	        let sub_email  = $('input#newsletter-email').val();
	        let sub_birth_date = $('input#newsletter-birth-date').val();
	         
	         $.ajax({
	             type: "POST",
	             url: "{{route('front.subscribe')}}",
	             data: {
	                 name : sub_name,
	                 birth_date: sub_birth_date,
	                 email: sub_email,
	                 _token: "{{csrf_token()}}"
	             },
	             success: function(response) {
	               if(response.errors){
	                   if(response.errors.email){
	                       toastr.error(response.errors.email[0]);
	                   }
	                   
	                   if(response.errors.name){
	                       toastr.error(response.errors.name[0]);
	                   }
	                   
	                   if(response.errors.birth_date){
	                       toastr.error(response.errors.birth_date[0]);
	                   }
	               }else {
	                   $("#NewletterSuccessModal").modal('show');
	                   //toastr.success(response.msg);
	                   $('form#form-subscribe').trigger('reset');
	               }
	               
	                
	             }
	         });
	     });
	     
	 });
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