@extends('layouts.front_34')

@section('content')

<div class="acc-settings">
    <div class="row m-0">
        @include('includes.user-dashboard-34-sidebar')
        <div class="col-lg-10 col-md-9 hidden-classes mb-3">
            <div>
                <div class="settings-container">
                    <h3>{{ $langg->lang272 }}</h3>
                    <div class="no-orders">
                        <div class="edit-info-area-form">
                        <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        <form id="userform" action="{{route('user-reset-submit')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include('includes.admin.form-both') 
                            @if(!empty(Auth::user()->password))
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="password" name="cpass"  class="input-field form-control" placeholder="{{ $langg->lang273 }}" value="" required="">
                                </div>
                            </div>
                            @endif
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="password" name="newpass"  class="input-field form-control" placeholder="{{ $langg->lang274 }}" value="" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="password" name="renewpass"  class="input-field form-control" placeholder="{{ $langg->lang275 }}" value="" required="">
                                </div>
                            </div>
    
                            <div class="form-links">
                                <button class="submit-btn btn btn-success" type="submit">{{ $langg->lang276 }}</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

@endsection
