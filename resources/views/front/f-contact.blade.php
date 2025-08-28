@extends('layouts.front_34')


@section('content')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();


@endphp

 <!-- Contact Us Area Start -->
    <section class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-section-title">
                           @if(!$slang)
            @if($lang->id == 2)
             {!! $ps->contact_title_ar !!}
                            {!! $ps->contact_text_ar !!}
              @else 
             {!! $ps->contact_title !!}
                            {!! $ps->contact_text !!}
              @endif 
          @else  
              @if($slang == 2) 
              {!! $ps->contact_title_ar !!}
                            {!! $ps->contact_text_ar !!}
              @else
             {!! $ps->contact_title !!}
                            {!! $ps->contact_text !!}
              @endif
          @endif            
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="left-area">
                        <div class="contact-form">
                            <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                            <form id="contactform" action="{{route('front.contact.submit')}}" method="POST">
                                {{csrf_field()}}
                                    @include('includes.admin.form-both')  

                                    <div class="form-input mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="{{ $langg->lang47 }} *" required="">
                                    </div>
                                    <div class="form-input mb-3">
                                        <input type="text" name="phone" class="form-control"  placeholder="{{ $langg->lang48 }} *">
                                    </div>
                                    <div class="form-input mb-3">
                                        <input type="email" name="email" class="form-control"  placeholder="{{ $langg->lang49 }} *" required="">
                                    </div>
                                    <div class="form-input mb-3">
                                        <textarea name="text" class="form-control" placeholder="{{ $langg->lang50 }} *" required=""></textarea>
                                    </div>
   
                                    @if($gs->is_capcha == 1)

                                    <ul class="captcha-area">
                                        <li>
                                            <p><img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code"></i></p>
                                        
                                        </li>
                                        <li>
                                                <input name="codes" type="text" class="input-field" placeholder="{{ $langg->lang51 }}" required="">
                                        </li>
                                    </ul>
                                    @endif
                                    <input type="hidden" name="to" value="{{ $ps->contact_email }}">
                                    <button class="submit-btn btn btn-primary text-white" type="submit">{{ $langg->lang52 }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div class="right-area">

                        @if($ps->site != null || $ps->email != null )
                        <div class="contact-info d-flex mb-3">
                            <div class="left ">
                                    <div class="icon">
                                            <i class="icofont-email"></i>
                                    </div>
                            </div>
                            <div class="content d-flex align-self-center">
                                <div class="content">
                                        @if($ps->site != null && $ps->email != null) 
                                        <a href="{{$ps->site}}" target="_blank">{{$ps->site}}</a>
                                        <a href="mailto:{{$ps->email}}">{{$ps->email}}</a>
                                        @elseif($ps->site != null)
                                        <a href="{{$ps->site}}" target="_blank">{{$ps->site}}</a>
                                        @else
                                        <a href="mailto:{{$ps->email}}">{{$ps->email}}</a>
                                        @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($ps->street != null) 
                        <div class="contact-info d-flex mb-3">
                                <div class="left">
                                        <div class="icon">
                                                <i class="icofont-google-map"></i>
                                        </div>
                                </div>
                                <div class="content d-flex align-self-center">
                                    <div class="content">
                                            <p>
                                                @if($ps->street != null) 
                                                    @if(!$slang)
            @if($lang->id == 2)
             {!! $ps->street_ar !!}
              @else 
              {!! $ps->street !!}
              @endif 
          @else  
              @if($slang == 2) 
               {!! $ps->street_ar !!}
              @else
             {!! $ps->street !!}
              @endif
          @endif   
                                                @endif
                                            </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($ps->phone != null || $ps->fax != null ) 
                            <div class="contact-info d-flex mb-3">
                                    <div class="left">
                                            <div class="icon">
                                                    <i class="icofont-smart-phone"></i>
                                            </div>
                                    </div>
                                    <div class="content d-flex align-self-center">
                                        <div class="content">
                                            @if($ps->phone != null && $ps->fax != null)
                                            <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>
                                            <a href="tel:{{$ps->fax}}">{{$ps->fax}}</a>
                                            @elseif($ps->phone != null)
                                            <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>
                                            @else
                                            <a href="tel:{{$ps->fax}}">{{$ps->fax}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        @endif

                        <hr class="my-5">
                                <div class="social-links">
                                    <h4 class="title">{{ $langg->lang53 }} :</h4>
                                    <ul class="list-unstyled">

                                     @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">
                                            <i class="fab fa-dribbble"></i>
                                        </a>
                                      </li>
                                      @endif
                                         @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="instagram" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                      </li>
                                      @endif
                                      
                                        @if(App\Models\Socialsetting::find(1)->ystatus == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="youtube" target="_blank">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                      </li>
                                      @endif
                                        </ul>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us Area End-->
     @if(!empty($ps->map))
     <div style="padding:1%">
      {!! $ps->map !!}   
     </div>
     
@endif

@endsection