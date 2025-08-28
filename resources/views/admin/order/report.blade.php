@extends('layouts.admin') 

@section('styles')

<style type="text/css">
    
.input-field { 
    padding: 15px 20px; 
}

</style>

@endsection

@section('content')  

<input type="hidden" id="headerdata" value="{{ __('ORDER') }}">
             
             
                    <div class="content-area">
                        <div class="mr-breadcrumb">
                            <div class="row">
                                 @if(Session::has('flash_message'))
                                    <div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
                                   @endif 
                                
                                <div class="col-lg-12">
                                        <h4 class="heading">{{ __('Reports') }}</h4>
                                        <ul class="links">
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">{{ __('Orders') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin-order-report-index-form') }}">{{ __('back to form') }}</a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                     
                     
                        <div class="product-area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mr-table allproduct">
                                        @include('includes.admin.form-success') 
                                        <div class="table-responsiv">
                                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                                <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                             <th>{{ __('Name') }}</th>
                                                            <th>{{ __('Customer Email') }}</th>
                                                            <th>{{ __('Order Number') }}</th>
                                                            <th>{{ __('Order status') }}</th>
                                                            <th>{{ __('Total Qty') }}</th>
                                                            <th>{{ __('Total Cost') }}</th>
                                                              <th>{{ __('Created at') }}</th>
                                                              <th>{{ __('payment status') }}</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                     <tbody>
                                                       
                                                      @foreach($order as $o)
                                                        <tr>
                                                          <td>{{$o->customer_name}}</td>
                                                           <td>{{$o->customer_email}}</td>
                                                            <td>{{ $o->order_number}}</td>
                                                            <td>{{ $o->status }}</td>
                                                            <td>{{ $o->totalQty}}</td>
                                                            <td>{{$o->pay_amount}}</td>
                                                            <td>{{ $o->created_at }}</td>
                                                            <td>{{ $o->payment_status }}</td>
                                                        </tr>
                                                      @endforeach
                                                         
                                                     </tbody>
                                                     <tfooter>
                                                         <th>{{ __('Total :') }}</th>
                                                         <th>{{ $total }}</th>
                                                     </tfooter>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                      
                            <span class="display_currency" id="footer_sale_total" ></span>
                           
                     

@endsection    

@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">


      var table = $('#geniustable').DataTable({
          
            });
               
               
            
               
        /*      $(document).on('submit', 'form#assignchange', function(e) {
                e.preventDefault();
               
                  
                            var form = $('form#assignchange')
                            var start_date = $('#start_date').val();
                            var end_date = $('#end_date').val();
                            var data = form.serialize();
                                $.ajax({
                                    method: form.attr('method'),
                                    url: form.attr('action'),
                                    dataType: 'json',
                                    data: {end_date :end_date ,start_date :start_date},
                                    success: function(result) {
                                    
                                            table.ajax.reload();
                                        
                                         
                                    },
                                });
                      
               
            })    */                                             
    </script>



{{-- DATA TABLE --}}
    
@endsection   