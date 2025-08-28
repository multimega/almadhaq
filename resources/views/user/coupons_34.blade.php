@extends('layouts.front_34')

@section('content')
<style>
.toolti {
  position: relative;
  display: inline-block;
}

.toolti .tooltiptex {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 100%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}

.toolti .tooltiptex::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.toolti:hover .tooltiptex {
  visibility: visible;
  opacity: 1;
}
</style>
@php 
    $cur = Session::get('currency');
        if( $cur){
            $currency = App\Models\Currency::find($cur);
    }else{
        $currency = App\Models\Currency::where('is_default',1)->first();
    }
    $data = App\Models\Generalsetting::find(1); 
@endphp

<div class="acc-settings">
    <div class="row m-0">
        @include('includes.user-dashboard-34-sidebar')
        <div class="col-lg-10 col-md-9 hidden-classes mb-3">
            <div>
                <div class="settings-container">
                    <div class="no-orders text-center">
                        <div class="row">
                            <div class="col-lg-12" style="text-align: center;">
                            @foreach($coupons as $c)
                                <?php 
                                    $data= App\Models\Procoupon::where('code_id', $c->id)->pluck('product_id');
                                    $pro = App\Models\Product::whereIN('id',$data)->where('status',1)->get();
                                ?>
                                @if(date('Y-m-d', strtotime($c->start_date )) <= date('Y-m-d', strtotime($mytime)) &&  date('Y-m-d', strtotime($c->start_date )) <=   date('Y-m-d', strtotime($c->end_date ))  &&  date('Y-m-d', strtotime($c->end_date )) >= date('Y-m-d', strtotime($mytime)) )
                                <div class="col-lg-4" style="text-align: center;    margin-bottom: 20px;float:left">     
                                    <div class="card" >
                                        <img class="card-img-top" src="{{$c->photo ? asset('assets/images/coupon/'.$c->photo):asset('assets/images/noimage.png')}}" alt="Card image cap" style="height: 233px;">
                                        <div class="card-block">
                                            {{ $langg->lang814 }} : 
                                            <h4>  <input value="{{$c->code}}" id="{{$c->id}}" class="card-title" style="font-weight: bolder;font-family: bold;text-align: center; width:100%" readonly="readonly" > </h4>
                                            @if($c->type == 0) <p class="card-text">{{ $langg->lang815 }} {{$c->price}}% </p>  @endif
                                            @if($c->type == 1) <p class="card-text">{{ $langg->lang815 }} {{$c->price * $currency->value }} {{$currency->sign }} </p>  @endif
                                            <p class="card-text">{{ $langg->lang816 }} {{$c->limited * $currency->value }} {{$currency->sign }} </p>
                                            @if(count($pro) > 0)                                          
                                               @foreach($pro as $p)
                                                <p class="card-text">* {{$p->name}}</p> 
                                                @endforeach
                                            @elseif(count($data) > 0)
                                                <p class="card-text"> Products not avaliable</p> 
                                            @else
                                                <p class="card-text">For All Products</p>
                                            @endif
                                        </div>
                                        @if($c->end_date ) <p class="card-text">{{ $langg->lang817 }} : {{$c->end_date }} </p> @else  <p class="card-text">{{ $langg->lang823 }} {{$c->times  }} {{ $langg->lang824 }} </p> @endif
                                        <div class="toolti">
                                            <button onclick="myFunction({{$c->id}})" onmouseout="outFunc()" class="btn btn-success my-2">
                                                <span class="tooltiptex" id="{{$c->id}}">Copy to clipboard</span>
                                                {{ $langg->lang818 }}
                                            </button><br>
                                        </div>
                                    </div>    
                                </div>
                                @endif            
                            @endforeach   
                                     
                            @foreach($pieces as $c)
                                <?php 
                                    $data= App\Models\Propiece::where('code_id', $c->id)->pluck('product_id');
                                    $pro = App\Models\Product::whereIN('id',$data)->where('status',1)->get();
                                ?>
                                @if(!empty($pro)) 
                                <div class="col-md-4" style="text-align: center;margin-bottom: 20px;float:left">
                                    <div class="card" >
                                        <img class="card-img-top" src="{{$c->photo ? asset('assets/images/coupon/'.$c->photo):asset('assets/images/noimage.png')}}" alt="Card image cap" style="height: 233px;">
                                        <div class="card-block">
                                            {{ $langg->lang814 }} : 
                                            <h4>  <input value="{{$c->code}}" id="{{$c->rand}}" class="card-title" style="font-weight: bolder;font-family: bold;text-align: center;width:100%" readonly="readonly" > </h4>
                                            <p class="card-text">Buy More Than : {{$c->buy}} </p>  
                                            <p class="card-text">Take : {{$c->take}} From </p>  
                                            @foreach($pro as $p)
                                            <p class="card-text">* {{$p->name}}</p> 
                                            @endforeach
                                        </div>
                                        <div class="toolti">
                                            <button onclick="myFunction({{$c->rand}})" onmouseout="outFunc()" class="btn btn-success my-2">
                                                <span class="tooltiptex" id="{{$c->rand}}">Copy to clipboard</span>
                                                {{ $langg->lang818 }}
                                            </button><br>
                                        </div>
                                    </div>    
                                </div>
                                @endif
                            @endforeach        
                                     
                            @foreach($free as $c)
                               <?php 
                                $data= App\Models\Profree::where('code_id', $c->id)->pluck('product_id');
                                $pro = App\Models\Product::whereIN('id',$data)->where('status',1)->get();
                               ?>
                                @if(!empty($pro))
                                <div class="col-md-4" style="text-align: center;margin-bottom: 20px;float:left">
                                    <div class="card" >
                                        <img class="card-img-top" src="{{$c->photo ? asset('assets/images/coupon/'.$c->photo):asset('assets/images/noimage.png')}}" alt="Card image cap" style="height: 233px;">
                                        <div class="card-block">
                                            {{ $langg->lang814 }} : 
                                            <h4>  <input value="{{$c->code}}" id="{{$c->rand}}" class="card-title" style="font-weight: bolder;font-family: bold;text-align: center;width:100%" readonly="readonly" > </h4>
                                            <p class="card-text">{{ $langg->lang819 }} </p>  
                                            @foreach($pro as $p)
                                            <p class="card-text">* {{$p->name}}</p> 
                                            @endforeach
                                        </div>
                                        <div class="toolti">
                                            <button onclick="myFunction({{$c->rand}})" onmouseout="outFunc()" class="btn btn-success my-2">
                                                <span class="tooltiptex" id="{{$c->rand}}">Copy to clipboard</span>
                                                {{ $langg->lang818 }}
                                            </button><br>
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
</div>


<script>
function myFunction(id) {
  var copyText = document.getElementById(id);
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  
  var tooltip = document.getElementsByClassName("tooltiptex");
  tooltip.innerHTML = "Copied: " + copyText.value();
}

function outFunc() {
  var tooltip = document.getElementsByClassName("tooltiptex");
  tooltip.innerHTML = "Copy to clipboard";
}
</script>

@endsection