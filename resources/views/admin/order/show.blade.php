@extends('layouts.admin')
     
@section('styles')

<style type="text/css">
    .order-table-wrap table#example2 {
    margin: 10px 20px;
}

</style>a

@endsection
@section('content')
    <div class="content-area">
                        <div class="mr-breadcrumb">
                            <div class="row">
                                <div class="col-lg-12">
                                        <h4 class="heading"> <a class="add-btn" href="javascript:history.back();"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                                        <ul class="links">
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Bosta Requests</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;"> Detail</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                             </div>
                                <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="orders" style="text-align: center;">
                              <thead>
                                <tr>
                                    <th data-field="number" style="text-align: center;">Number</th>
                                    <th data-field="number" style="text-align: center;">Address</th>
                                    <th data-field="number" style="text-align: center;">Shiped From</th>
                                    <th data-field="number" style="text-align: center;">Shiped To</th>
                                    <th data-field="progress" style="text-align: center;">Actions</th>
                                   </tr>
                                  </thead>
                                    <tbody>
                                    <tr>
                                        
                                    <td><strong>{{$theresult['trackingNumber']}}</strong></td>
                                    <td><strong>{{ $theresult['pickupAddress']['firstLine']}}</strong></td>
                                    <td><strong>{{ $theresult['pickupAddress']['city']['name']}}</strong></td>
                                    <td><strong>{{ $theresult['dropOffAddress']['city']['name']}}</strong></td>
                                    <td><strong>{{ $theresult['state']['value']}}</strong></td>
            
                                    </tr>
                                </tbody>
                                </div>
                                </div>
                                
                            
                 
  
@endsection



