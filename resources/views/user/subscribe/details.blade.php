@extends('layouts.front')
@section('content')
<!-- User Dashbord Area Start -->
<section class="user-dashbord">
    <div class="container">
        <div class="row">
            @include('includes.user-dashboard-sidebar')
            <div class="col-lg-8">
                <div class="user-profile-details">
                    <div class="order-details">

                        


                        <div class="header-area">
                            <h4 class="title">
                              My Package Details
                            </h4>
                        </div>
                        <div class="view-order-page">
                            <h3 class="order-code">"Package" {{$pro->name}} [{{$subscribe->status}}]
                            </h3>
                     
                            <p class="order-date">{{ $langg->lang301 }} {{date('d-M-Y',strtotime($subscribe->created_at))}}
                            </p>

             
                            <div class="shipping-add-area">
                                <div class="row">
                               
                                    <div class="col-md-6">
                                        <h5>Package Dates</h5>
                                      
                                       <p class="order-date">Start Date :  {{date('d-M-Y',strtotime($subscribe->start_date))}} </p>
                                       <p class="order-date">End Trial Date :  {{date('d-M-Y',strtotime($subscribe->trial_end_date))}} </p>
                                       <p class="order-date">End Date :  {{date('d-M-Y',strtotime($subscribe->end_date))}} </p>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="shipping-add-area">
                                <div class="row">
                               
                                    <div class="col-md-6">
                                        <h5>Package Details</h5>
                                      
                                        <p>{!! $subscribe->package_details !!}</p>
                                       
                                    </div>
                                </div>
                            </div>
                            @if(!empty($order))
                            <div class="billing-add-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{ $langg->lang287 }}</h5>
                                        <address>
                                            {{ $langg->lang288 }} {{$order->customer_name}}<br>
                                            {{ $langg->lang289 }} {{$order->customer_email}}<br>
                                            {{ $langg->lang290 }} {{$order->customer_phone}}<br>
                                          
                                            {{ $langg->lang291 }} {{$order->customer_address}}<br>
                                            {{$order->customer_country}} - {{$order->customer_city}} - {{$order->customer_zip}}
                                        </address>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ $langg->lang292 }}</h5>

                                        <p>{{ $langg->lang798 }}
                                             {!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>". $langg->lang799 ."</span>":"<span class='badge badge-success'>". $langg->lang800 ."</span>" !!}
                                        </p>



                                        <p>{{ $langg->lang293 }}
                                            {{$order->currency_sign}}{{ round($subscribe->package_price * $order->currency_value , 2) }}
                                        </p>
                                        <p>{{ $langg->lang294 }} {{$order->method}}</p>

                                        @if($order->method != "Cash On Delivery")
                                        @if($order->method=="Stripe")
                                        {{$order->method}} {{ $langg->lang295 }} <p>{{$order->charge_id}}</p>
                                        @endif
                                        {{$order->method}} {{ $langg->lang296 }} <p id="ttn"> {{$order->txnid}}</p>

                                        <a id="tid" style="cursor: pointer;" class="mybtn2">{{ $langg->lang297 }}</a> 

                                        <form id="tform">
                                            <input style="display: none; width: 100%;" type="text" id="tin" placeholder="{{ $langg->lang299 }}" required="" class="mb-3">
                                            <input type="hidden" id="oid" value="{{$order->id}}">

                                            <button style="display: none; padding: 5px 15px; height: auto; width: auto; line-height: unset;" id="tbtn" type="submit" class="mybtn1">{{ $langg->lang300 }}</button>
                                                
                                                <a style="display: none; cursor: pointer;  padding: 5px 15px; height: auto; width: auto; line-height: unset;" id="tc"  class="mybtn1">{{ $langg->lang298 }}</a>
                                                
                                                {{-- Change 1 --}}
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @else
                             <div class="billing-add-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{ $langg->lang287 }}</h5>
                                        <address>
                                            {{ $langg->lang288 }} {{$user->name}}<br>
                                            {{ $langg->lang289 }} {{$user->email}}<br>
                                            {{ $langg->lang290 }} {{$user->phone}}<br>
                                          
                                            {{ $langg->lang291 }} {{$user->address}}<br>
                                            {{$user->country}} - {{$user->city}} - {{$user->zip}}
                                        </address>
                                    </div>
                              
                                </div>
                            </div>
                            
                            @endif
                        
                            <br>




                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ $langg->lang319 }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="text-center">{{ $langg->lang320 }} <span id="key"></span></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $langg->lang321 }}</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

<script type="text/javascript">
    $('#example').dataTable({
        "ordering": false,
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': false,
        'responsive': true
    });
</script>
<script>
    $(document).on("click", "#tid", function (e) {
        $(this).hide();
        $("#tc").show();
        $("#tin").show();
        $("#tbtn").show();
    });
    $(document).on("click", "#tc", function (e) {
        $(this).hide();
        $("#tid").show();
        $("#tin").hide();
        $("#tbtn").hide();
    });
    $(document).on("submit", "#tform", function (e) {
        var oid = $("#oid").val();
        var tin = $("#tin").val();
        $.ajax({
            type: "GET",
            url: "{{URL::to('user/json/trans')}}",
            data: {
                id: oid,
                tin: tin
            },
            success: function (data) {
                $("#ttn").html(data);
                $("#tin").val("");
                $("#tid").show();
                $("#tin").hide();
                $("#tbtn").hide();
                $("#tc").hide();
            }
        });
        return false;
    });
</script>
<script type="text/javascript">
    $(document).on('click', '#license', function (e) {
        var id = $(this).parent().find('input[type=hidden]').val();
        $('#key').html(id);
    });
</script>
@endsection