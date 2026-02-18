@extends('layouts.front')

@section('content')
    @php
        $features = App\Models\Feature::all();
    @endphp
    <section class="login-signup">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <nav class="comment-log-reg-tabmenu">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link login active" id="nav-log-tab" data-toggle="tab" href="#nav-log"
                                role="tab" aria-controls="nav-log" aria-selected="true">
                                {{ $langg->lang197 }}
                            </a>
                            <a class="nav-item nav-link" id="nav-reg-tab" data-toggle="tab" href="#nav-reg" role="tab"
                                aria-controls="nav-reg" aria-selected="false">
                                {{ $langg->lang198 }}
                            </a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab">
                            <div class="login-area">
                                <div class="header-area">
                                    <h4 class="title">{{ $langg->lang172 }}</h4>
                                </div>
                                <div class="login-form signin-form">
                                    @include('includes.admin.form-login')
                                    <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-input">
                                            <input type="tel" name="phone" placeholder="{{ $langg->lang184 }}"
                                                required="">
                                            <i class="icofont-phone"></i>
                                        </div>
                                        <div class="form-input">
                                            <input type="password" class="Password" name="password"
                                                placeholder="{{ $langg->lang174 }}" required="">
                                            <i class="icofont-ui-password"></i>
                                        </div>
                                        <div class="form-forgot-pass">
                                            <div class="left">
                                                <input type="checkbox" name="remember" id="mrp"
                                                    {{ old('remember') ? 'checked' : '' }}>
                                                <label for="mrp">{{ $langg->lang175 }}</label>
                                            </div>
                                            <div class="right">
                                                <a href="{{ route('user-forgot') }}">
                                                    {{ $langg->lang176 }}
                                                </a>
                                            </div>
                                        </div>
                                        <input type="hidden" name="modal" value="1">
                                        <input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
                                        <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
                                        <!-- @if (App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check == 1)
    <div class="social-area">
                                    <h3 class="title">{{ $langg->lang179 }}</h3>
                                    <p class="text">{{ $langg->lang180 }}</p>
                                    <ul class="social-links">
                                      @if (App\Models\Socialsetting::find(1)->f_check == 1)
    <li>
                                        <a href="{{ route('social-provider', 'facebook') }}">
                                          <i class="fab fa-facebook-f"></i>
                                        </a>
                                      </li>
    @endif
                                      @if (App\Models\Socialsetting::find(1)->g_check == 1)
    <li>
                                        <a href="{{ route('social-provider', 'google') }}">
                                          <i class="fab fa-google-plus-g"></i>
                                        </a>
                                      </li>
    @endif
                                    </ul>
                                  </div>
    @endif-->
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-reg-tab">
                            <div class="login-area signup-area">
                                <div class="header-area">
                                    <h4 class="title">{{ $langg->lang181 }}</h4>
                                </div>
                                <div class="login-form signup-form">
                                    @include('includes.admin.form-login')
                                    <form class="mregisterform" action="{{ route('user-register-submit') }}"
                                        method="POST">
                                        {{ csrf_field() }}

                                        <div class="form-input">
                                            <input type="text" class="User Name" name="name"
                                                placeholder="{{ $langg->lang182 }}" required="">
                                            <i class="icofont-user-alt-5"></i>
                                        </div>



                                        <div class="form-input">
                                            <input type="text" class="User Name" name="phone"
                                                placeholder="{{ $langg->lang184 }}" required="">
                                            <i class="icofont-phone"></i>
                                        </div>

                                        <!-- <div class="form-input">
                                    <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
                                    <i class="icofont-location-pin"></i>
                                  </div>-->

                                        <div class="form-input">
                                            <input type="password" class="Password" name="password"
                                                placeholder="{{ $langg->lang186 }}" required="">
                                            <i class="icofont-ui-password"></i>
                                        </div>

                                        <div class="form-input">
                                            <input type="password" class="Password" name="password_confirmation"
                                                placeholder="{{ $langg->lang187 }}" required="">
                                            <i class="icofont-ui-password"></i>
                                        </div>

                                        @if ($features[3]->status == 1 && $features[3]->active == 1)
                                            <div class="form-input">
                                                <input type="text" class="User Name" name="refelar_code"
                                                    placeholder="{{ $langg->lang830 }}">
                                                <i class="icofont-code"></i>
                                            </div>
                                        @endif

                                        @if ($gs->is_capcha == 1)
                                            <div class="captcha-area">
                                                <header>Captcha</header>
                                                <div class="input_field captch_box">
                                                    <input type="text" value="" disabled />
                                                    <button class="refresh_button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                        </svg>

                                                    </button>
                                                </div>
                                                <div class="input_field captch_input">
                                                    <input type="text" placeholder="{{ $langg->lang51 }}" required />
                                                </div>
                                                <div class="message">That's true</div>
                                            </div>
                                        @endif

                                        <input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
                                        <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
