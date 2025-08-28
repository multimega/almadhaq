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
                                <img  src="{{asset('assets/images/'.$data->loyalty_photo)}}" alt="vowalla Logo" class="w-100">
                            </a>
                        </div> 
                        <div class="form-group ">
                            <label >{{ $langg->lang820 }}</label>
                            <label class="form-control">{{ $user->points  }}</label>
                        </div>
                        @if($message)
                            <label>{{ $langg->lang821 }}</label>
                            <div class="form-group " style="border: 1px solid #2c5295;">
                                {!! $message->message!!}
                            </div>
                        @endif
                        @if(!empty(Auth::user()->message))
                            <label>{{ trans('message')}}</label>
                            <div class="form-group " style="border: 1px solid #2c5295;">
                                {!! Auth::user()->message!!}
                            </div>
                        @endif
                        
                        <div class="row">
                            @foreach($coupons as $c)
                                <div class="col-lg-4" style="text-align: center;    margin-bottom: 20px;float:left">
                                    <div class="card">
                                        <img class="card-img-top" src="{{$c->photo ? asset('assets/images/coupon/'.$c->photo):asset('assets/images/noimage.png')}}" alt="Card image cap" style="height: 150px;width: auto;object-fit:contain;">
                                        <div class="card-block">
                                            {{ $langg->lang822 }} : 
                                            <h4><input value="{{$c->points}}" id="{{$c->id}}" class="card-title" style="font-weight: bolder;font-family: bold;text-align: center; width:100%" readonly="readonly" > </h4>
                                            @if($c->type == 0) <p class="card-text">{{ $langg->lang815 }} :  {{$c->price}}% </p>  @endif
                                            @if($c->type == 1) <p class="card-text">{{ $langg->lang815 }} :  {{$c->price * $currency->value }} {{$currency->sign }} </p>  @endif
                                            
                                            <p class="card-text">{{ $langg->lang816 }} :{{$c->limited * $currency->value }} {{$currency->sign }} </p>
                                            <p class="card-text">{{ $langg->lang823 }} : {{$c->times }} {{ $langg->lang824 }}</p>
                                            <p class="card-text">{{ $langg->lang817 }} : {{$c->days }} Days </p> 
                                        </div>
                                        <div class="toolti">
                                            <a href="{{route('user-add-coupon',$c->id)}}"  class="btn btn-success d-block mx-5 my-2">Buy</a>
                                        </div>
                                    </div>    
                                </div>
                            @endforeach 
                            
                            @foreach($piececoupons as $c)
                                <?php 
                                $pro = App\Models\Product::where('id',$c->product_id)->where('status',1)->first();
                                ?>
                                @if(!empty($pro)) 
                                <div class="col-lg-4" style="text-align: center;    margin-bottom: 20px;float:left">
                                    <div class="card" >
                                        <img class="card-img-top" src="{{$c->photo ? asset('assets/images/coupon/'.$c->photo):asset('assets/images/noimage.png')}}" alt="Card image cap" style="height: 150px;width: auto;object-fit:contain;">
                                        <div class="card-block">
                                            {{ $langg->lang822 }} : 
                                            <h4>  <input value="{{$c->points}}" id="{{$c->id}}" class="card-title" style="font-weight: bolder;font-family: bold;text-align: center; width:100%" readonly="readonly" > </h4>
                                            <p class="card-text">Buy : {{$c->buy}} or More</p>  
                                            <p class="card-text">Take : {{$c->take}} From</p>  
                                            
                                            <p class="card-text">{{$pro->name }}</p>  
                                            
                                            
                                            <p class="card-text">{{ $langg->lang823 }} : {{$c->times }} {{ $langg->lang824 }}</p>
                                            <p class="card-text">{{ $langg->lang817 }} : {{$c->days }} Days </p> 
                                        </div>
                                        <div class="toolti">
                                            <a href="{{route('user-add-piece-coupon',$c->id)}}"  class="btn btn-success d-block mx-5 my-2">Buy</a>
                                        </div>
                                    </div> 
                                </div>
                                @endif 
                            @endforeach   
                            
                            @foreach($freecoupons as $c)
                                <?php 
                                $pro = App\Models\Product::where('id',$c->product_id)->where('status',1)->first();
                                ?>
                                @if(!empty($pro)) 
                                <div class="col-lg-4" style="text-align: center;    margin-bottom: 20px;float:left">
                                    <div class="card" >
                                        <img class="card-img-top" src="{{$c->photo ? asset('assets/images/coupon/'.$c->photo):asset('assets/images/noimage.png')}}" alt="Card image cap" style="height: 150px;width: auto;object-fit:contain;">
                                        <div class="card-block">
                                            {{ $langg->lang822 }} : 
                                            <h4><input value="{{$c->points}}" id="{{$c->id}}" class="card-title" style="font-weight: bolder;font-family: bold;text-align: center; width:100%" readonly="readonly" > </h4>
                                            <p class="card-text">Take This Product Free</p> 
                                            <p class="card-text">{{$pro->name }}</p>
                                            <p class="card-text">{{ $langg->lang823 }} : {{$c->times }} {{ $langg->lang824 }}</p>
                                            <p class="card-text">{{ $langg->lang817 }} : {{$c->days }} Days </p> 
                                        </div>
                                        <div class="toolti">
                                            <a href="{{route('user-add-free-coupon',$c->id)}}"  class="btn btn-success d-block mx-5 my-2">Buy</a>
                                        </div>
                                    </div>    
                                </div>
                                @endif   
                            @endforeach   
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection