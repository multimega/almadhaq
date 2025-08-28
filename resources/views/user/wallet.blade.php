@extends('layouts.front')
@section('content')

@php 

     $cur = Session::get('currency');
      if( $cur){
          $currency = App\Models\Currency::find($cur);
      }else{
          $currency = App\Models\Currency::where('is_default',1)->first();
      }
 $data = App\Models\Generalsetting::find(1); 

@endphp
<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
          @include('includes.form-success')
          <div class="user-profile-details">
          <div class="row">
                            
                                <div class="col-sm-12" style="text-align: center;">
                                     
                                              <div style="text-align: center;">
                                         <a href="{{url('/')}}" class="logo" style="width: 245px"  >
                                          <img  src="{{asset('assets/images/'.$data->wallet_photo)}}" alt="vowalla Logo" style="max-width: 50%; */">
                                          </a>
                                     </div> 
                                          <div class="form-group ">
                                                <label >{{ $langg->lang811 }}</label>
                                                <label class="form-control">
                                                        {{ $user->refunds * $currency->value }} {{$currency->sign}}
                                                </label>
                                              </div>
                                        
                                        </div>
                                    </div>
          </div>
        </div>
      </div>
    </div>
  </section>



@endsection