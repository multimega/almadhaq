@extends('layouts.front')
@section('content')
@php 


$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();

@endphp
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">
          <li>
            <a href="">
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

@if(!empty($order))

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Starting of Dashboard data-table area -->
                    <div class="content-box section-padding add-product-1">
                        <div class="top-area">
                                <div class="content">
                                    <h4 class="heading">
                                        {{ $langg->razorpay}}
                                    </h4>
                                    <p class="text">
                                        {{ $langg->order_text }}
                                    </p>
                                  </div>
                                     <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                                            {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">

                                            <div class="col-md-6">
                                              
                                                <?php   
                                                
                                                  $price= round($order->pay_amount/15.68);
 
                                                   
                                                   ?>
                                                <input id="amount" type="hidden" class="form-control" name="amount" value="{{$price}}" autofocus>
                
                                                @if ($errors->has('amount'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                                <button type="submit" class="btn btn-primary">
                                                    Pay with Paypal
                                                </button>
                                    </form>
                                 </div>
                        <div class="row">
                            <div class="col-lg-12">

                                    <div class="product__header">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-12">
                                                <div class="product-header-title">
                                        </div>   
                                    </div>
                                        @include('includes.form-success')
                                            <div class="col-md-12" id="tempview">
                                                <div class="dashboard-content">
                                                    <div class="view-order-page" id="print">

                                                            
                                                

                                                </div>
                                            </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif
  </section>

@endsection

@if(!empty($order))

<script>
     var fullUrlLink = location.href;
     
   if (  fullUrlLink.search("PayerID") > 0) {
       window.location.href="{{url('editorder/'.$order->id)}}"
   }else{
      

    }
      
  </script>

@endif

  