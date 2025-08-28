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

<!-- Start Footer -->
<div class="top-footer px-1 pt-4 pb-1">
  <div class="row m-0">
    <div class="col-lg-5 col-12 mb-2">
      <h4 class="m-0">We're Always Here To Help You</h4>
      <p class="m-0">Reach out to us through any of these support channels</p>  
    </div>
    <div class="col-lg-7 col-12 d-flex align-items-center mb-2">
      <div class="row w-100">
        <div class="col-md-7 d-flex align-items-center mb-2">
          <div class="top-footer-icon"><i class="far fa-envelope"></i></div>
          <a href="mailto:{{$main->email}}">
            <div class="top-footer-content">
              <h5 class="m-0">{{$langg->lang209}}</h5>
              <p class="m-0">{{$main->email}}</p>
            </div>
          </a>
        </div>
        <div class="col-md-5 d-flex align-items-center mb-2">
          <div class="top-footer-icon"><i class="fas fa-phone-volume"></i></div>
          <a href="tel:{{$main->phone }}">
            <div class="top-footer-content">
              <h5 class="m-0">{{$langg->lang210}}</h5>
              <p class="m-0">{{$main->phone }}</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="middle-footer px-4 pt-4 pb-4">
  <div class="row">
    <div class="col-md-4 col-6">
      <h5>{{ $langg->lang11 }}</h5>
      <ul class="list-unstyled">
        <li> 
            @if(!Auth::guard('web')->check()) 
                <a href="{{url('user/login')}}">
                    {{ $langg->lang12 }} | {{ $langg->lang13 }}
                </a>
         	@else 
    	        @if(Auth::user()->IsVendor())
                    <a href="{{ route('vendor-dashboard') }}">
                        {{ $langg->lang11 }}
                    </a>
         	    @else
                    <a href="{{ route('user-dashboard-34') }}">
                        {{ $langg->lang11 }}
                    </a>
    			@endif
								
			@endif
		</li>
        <li><a href="{{ route('front.f-contact',$sign) }}">{{ $langg->lang23 }}</a></li>
      <!--  @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)-->
	     <!--   <li>-->
	    	<!--    <a href="{{ route('front.page',['slug' => $data->slug , 'lang' => $sign ]) }}">-->
    		<!--		@if(!$slang)-->
      <!--                @if($lang->id == 2)-->
      <!--                  {{ $data->title_ar }}-->
      <!--                    @else -->
      <!--                   {{ $data->title }}-->
      <!--                     @endif -->
      <!--                     @else  -->
      <!--                    @if($slang == 2) -->
      <!--                   {{ $data->title_ar }}-->
      <!--                    @else-->
      <!--                   {{ $data->title }}-->
      <!--                  @endif-->
      <!--              @endif-->
		    <!--	</a>-->
	    	<!--</li>-->
      <!-- 	@endforeach-->
      </ul>
    </div>
    <div class="col-md-4 col-6">
      <h5>{{$langg->lang906}}</h5>
      <ul class="list-unstyled">
         <li><a href="{{ route('front.f-faq',$sign) }}">{{ $langg->lang19 }}</a></li>
         <li><a href="{{ route('front.f-blog',$sign) }}">{{ $langg->lang18 }}</a></li>
         <li><a href="{{ route('front.f-contact',$sign) }}">{{ $langg->lang20 }}</a></li>
      </ul>
    </div>
    <div class="col-md-4 col-6">
      <h5>{{$langg->mainfeaturees}}</h5>
      <ul class="list-unstyled">
        @foreach($chunk as $service)
           <li>
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
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  <div class="social-links mt-3 d-md-flex justify-content-between align-content-center">
    <div class="apps mb-2">
      <h5>Download Now</h5>
      <a href="#">
        <img src="{{asset('assets/demo_34/assets/images/apps/appstore.png')}}">
      </a>
      <a href="#">
        <img src="{{asset('assets/demo_34/assets/images/apps/googleplay.jpg')}}">
      </a>
    </div>
    <div class="social-media mb-2">
      <h5>Follow us</h5>
       @if(App\Models\Socialsetting::find(1)->f_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="social-icon" target="_blank">
            <i class="fab fa-facebook-f"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->g_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" target="_blank">
            <i class="fab fa-google-plus-g"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->t_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->l_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" target="_blank">
            <i class="fab fa-linkedin-in"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->d_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" target="_blank">
            <i class="fab fa-dribbble"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->i_status == 1)
        <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
      @endif
      @if(App\Models\Socialsetting::find(1)->ystatus == 1)
       <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" target="_blank">
           <i class="fab fa-youtube"></i>
       </a>
      @endif
    </div>
  </div>
</div>
<div class="bottom-footer px-4 pt-4 pb-3 d-lg-flex justify-content-between align-items-center">
  <div class="copy-right justify-content-center">
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
  </div>
  <div class="bootom-footer-img">
    <img src="{{ asset('assets/images/'.$main->paymentsicon)}}">
  </div>
  <div class="bootom-footer-links">
    <a href="#">Careers</a>
    <a href="warranty.php">Warrnty Policy</a>
    <a href="terms.php">Terms of use</a>
    <a href="terms-sale.php">Terms of sale</a>
    <a href="privacy.php">Privacy Policy</a>
  </div>
</div>
<!-- End Footer -->

    <!-- newsletter-popup-form -->
    <div class="newsletter-popup mfp-hide" id="newsletter-popup-form" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}})">
        <div class="newsletter-popup-content">
            <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Logo" class="logo-newsletter">
            <h2>{{$gs->popup_title}}</h2>
            <p>{{$gs->popup_text}}</p>
            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="{{ $langg->lang741 }}" required>
                    <input type="submit" class="btn" value="
                    @if(!$slang)
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
                <button class="btn-primary"><a href="{{route('front.f-cart',$sign)}}" style="color:#fff;"> @if($langg->rtl != "1") Go to cart page  @else اذهب الى عربة التسوق    @endif</a></button>
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
	
    
    <script src="{{asset('assets/demo_34/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/demo_34/assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/demo_34/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/demo_34/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/demo_34/assets/js/xzoom.min.js')}}"></script>
    <script src="{{asset('assets/demo_34/assets/js/setup.js')}}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>   
    <script src="{{asset('assets/demo_34/assets/js/main.js')}}"></script>
    
    <!--||||||||||||||-->
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
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</body>
</html>