@extends('layouts.front_34')

@section('content')

@php 

$cur = Session::get('currency');
if( $cur){
    $currency = App\Models\Currency::find($cur);
}else{
    $currency = App\Models\Currency::where('is_default',1)->first();
}
    
$data = App\Models\Generalsetting::find(1); 
$message = App\Models\GlobalMessage::where('min','<', Auth::user()->points)->where(function ($query) {$query->where('max','>', Auth::user()->points);})->first();

@endphp

<div class="acc-settings">
    <div class="row m-0">
        @include('includes.user-dashboard-34-sidebar')
        <div class="col-lg-10 col-md-9 hidden-classes mb-3">
            @include('includes.form-success')
            @include('includes.form-error')
            <div>
                <div class="settings-container">
                    <h3>{{ $langg->lang809 }}</h3>
                    <div class="no-orders text-center">
                        <div>
                            <a href="{{url('/')}}" class="logo d-block mx-auto mb-3" style="width: 245px"  >
                                <img  src="{{asset('assets/images/coupon/'.$ref->photo)}}" alt="vowalla Logo" class="w-100">
                            </a>
                        </div> 
                        <div class="form-group ">
                            <label >{{ $langg->lang825 }}</label>
                            <label class="form-control">{{ $ref->code  }}</label>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection