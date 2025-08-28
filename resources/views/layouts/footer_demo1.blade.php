@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$main=App\Models\Generalsetting::find(1);
$categorys=App\Models\Category::get();
$services = DB::table('services')->get();

 @endphp
       
       <div class="footer-top footer"  id="footer" >
                <div class="container-fluid">
                    <div class="footer-left widget-newsletter">
                        <div class="widget-newsletter-info">
                            <a href="#" class="widget-newsletter-title">{{ $langg->newsletter }}</a>
                            <p class="widget-newsletter-content">{{$main->subscribee_message}}</p>
                        </div>
                
                            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                                  {{csrf_field()}}
                            <div class="footer-submit-wrapper">
                                <input  type="email"    name="email" class="form-control" placeholder="{{ $langg->lang741 }}" required>
                                <button type="submit" class="btn">{{ $langg->lang742 }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="footer-right">
                        <div class="social-icons">
                            <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-middle" style="background-color:{{$gs->footer_color}}>
                    <div class="container-fluid">
                    <div class="row row-sm">
                        <div class="col-lg-6">
                            <div class="widget">
                                <h4 class="widget-title">{{ $langg->lang23 }}</h4>

                                <div class="row row-sm">
                                    <div class="col-sm-6">
                                        <div class="contact-widget">
                                            <h4 class="widget-title">{{ $langg->address}}</h4>
                                            <a href="#">{{$main->address}}</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="contact-widget email">
                                            <h4 class="widget-title">EMAIL</h4>
                                            <a href="mailto:mail@example.com">{{$main->email}}</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="contact-widget">
                                            <h4 class="widget-title">PHONE</h4>
                                            <a href="#">{{$main->phone }}</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="contact-widget">
                                            <h4 class="widget-title">{{ $langg->workinghour }}</h4>
                                            <a href="#">{{$main->address_ar}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4>
                                <ul class="links link-parts">
                                    <div class="link-part">
                                        <li><a href="{{ route('front.contact',$sign) }}">{{ $langg->lang23 }}</a></li>
                                    </div>
                                    <div class="link-part">
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
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">{{ $langg->mainfeaturees }}</h4>
                                <ul class="links link-parts">
                                    <div class="link-part">    
                                       		@foreach($services->chunk(4) as $chunk)
                                       			@foreach($chunk as $service)
                                        <li><a href="#">@if(!$slang)
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
                                         @endforeach
                                      
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

         	<div class="copy-bg">
            <div class="footer-bottom">
                <div class="container-fluid">
                    <p class="footer-copyright">{!! $main->copyright !!}</p>
                    <img src="{{ asset('assets/images/'.$main->paymentsicon)}}" alt="payment image">
                </div>
            </div>
            </div>
        </footer>
        </div>
        
        
    <div class="mobile-menu-overlay"></div>
    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-retweet"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                   <li><a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a></li>
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
														      	<li><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug, 'lang' => $sign]) }}">
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
                                        <li><a href="{{ route('user.login')}}"class="login-link">Login</a></li>
                                          @endif
                                  </ul>
                                 </li>
                              </ul>
                        </nav>

                         <div class="social-icons">
                            <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                         </div><!-- End .social-icons -->
                      </div><!-- End .mobile-menu-wrapper -->
                  </div><!-- End .mobile-menu-container -->
@if($gs->is_popup== 1)
@if(isset($visited))
    <div class="newsletter-popup mfp-hide" id="" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}})">
        <div class="newsletter-popup-content">
            <img src="{{asset('designdemos/assets/images/logo-black.png')}}" alt="Logo" class="logo-newsletter">
            <h2>{{$gs->popup_title}}</h2>
                  <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                     {{csrf_field()}}
                <div class="input-group">
                    <input type="email" class="form-control"  name="email" placeholder="Email address" required>
                    <input type="submit" class="btn" value="Go!">
                </div>
            </form>
            <div class="newsletter-subscribe">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1">
                      {{$gs->popup_text}}
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
            <p>You've just added this product to the<br>cart:</p>
            <h4 id="productTitle"></h4>

            <div class="btn-actions">
                <a href="{{route('front.cart',$sign)}}"><button class="btn-primary">Go to cart page</button></a>
                <a href="{{route('front.index',$sign)}}"><button class="btn-primary">Continue</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>
    

<script type="text/javascript">

  var mainurl = "{{url('/')}}";
  var gs      = {!! json_encode($gs) !!};
  var langg    = {!! json_encode($langg) !!};

</script>


	<script src="{{asset('assets/front/js/jquery.js')}}"></script>
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
	<script src="{{asset('assets/demo_1/assets/js/jquery.min.js')}}"></script>
	
	<script src="{{asset('assets/demo_1/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/demo_1/assets/js/plugins.min.js')}}"></script>
    <script src="{{asset('assets/demo_1/assets/js/main.min.js')}}"></script>

	<!-- popper -->
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


    
     
	  @if($gs->is_talkto == 1)
    <!--Start of Tawk.to Script-->
      {!! $gs->talkto !!}
    <!--End of Tawk.to Script-->
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