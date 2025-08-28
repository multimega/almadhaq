@extends('layouts.front')
@section('content')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$gs=App\Models\GeneralSetting::find(1);

@endphp
<div class="breadcrumb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">
          <li>
            <a href="{{ route('front.index',$sign) }}">
              {{ $langg->lang17 }}
            </a>
          </li>
          <li>
            <a href="{{ route('payment.return') }}">
              {{ $langg->lang169 }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<section class="tempcart">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="content-box section-padding add-product-1">
                        
                               <div class="row">
                                 <div class="col-lg-12">
                                     <div class="product__header">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-12">
                                  
                                        </div>
                                             
                                <div class="col-md-12" >
                                <div class="dashboard-content">
                                <section class="text-center">
                                    <div class="container">
                                        <h1 class="jumbotron-heading">Vapulus Payment</h1>
=                                    </div>
                                </section>
                                
                                <div class="container">
                                    <div class="row">
                                        <div class="contents col-12">
                                             <form action="{{route('payments.vapulus')}}" method="post">
                                                 @csrf
                                                
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="col-md-8 control-label" for="cardNumber">Card number:</label>
                                                    <div class="col-md-8">
                                                        <input type="number" id="cardNumber"  name="cardNumber" class="form-control input-md"   required/>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-md-8 control-label" for="cardMonth"> Card Expiry</label>
                                                    <div class="col-md-8">
                                                        <input type="number" id="cardexp" name="cardexp"  class="form-control input-md" placeholder="EX:2105"  required/>
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label class="col-md-8 control-label" for="cardCVC">Security code:</label>
                                                    <div class="col-md-8">
                                                        <input type="number" id="cardCVC"  name="cardCvc" class="form-control input-md"   placeholder="EX:123" required />
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <label class="col-md-8 control-label" for="cardCVC">Holder Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text"   name="name" class="form-control input-md"  required/>
                                                    </div>
                                                </div>
                                              
                                               <div class="form-group">
                                                    <label class="col-md-8 control-label" for="cardCVC">Email</label>
                                                    <div class="col-md-8">
                                                        <input type="email"   name="email" class="form-control input-md" required />
                                                    </div>
                                                </div>
                                              
                                              <div class="form-group">
                                                    <label class="col-md-8 control-label" for="cardCVC">Mobile Number</label>
                                                    <div class="col-md-8">
                                                        <input type="number"   name="mobileNumber" class="form-control input-md"  required/>
                                                    </div>
                                                </div>
                                                
                                               <div class="form-group">
                                                    <label class="col-md-8 control-label" for="cardCVC">Amount in EGP</label>
                                                    <div class="col-md-8">
                                                        <input type="text"   name="amount"  class="form-control input-md" value="{{round($order->pay_amount * $order->currency_value,2)}}" readonly  />
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <div class="col-md-8">
                                                        <input type="hidden"   name="order_id" class="form-control input-md" value="{{$order->id}}"  />
                                                    </div>
                                                </div>
                                                <br>
                                            

                                              <div class="form-group">
                                                  
                                               <div class="row justify-content-center">

                                                     <button class="btn btn-success btn-lg" type="submit">Pay</button>
                                                 
                                                 </div>
                                                 
                                               </div>
                                               
                                             </fieldset>

                                            </form>
                                         
                                        </div>
                                    </div>
                           
                                                                                    
                                                        
                                           
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
               
            </div>


  </section>

@endsection

