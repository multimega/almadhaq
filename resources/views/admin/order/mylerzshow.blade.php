@extends('layouts.admin')
@section('styles')

<style type="text/css">
    .order-table-wrap table#example2 {
    margin: 10px 20px;
}

</style>

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
                                                <a href="javascript:;">Mylerz Requests</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Detail</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                             </div>
                                <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="orders" style="text-align: center;">
                              <thead>
                                <tr>
                                    <th data-field="number" style="text-align: center;">Bar code</th>
                                    <th data-field="number" style="text-align: center;">Description</th>
                                    <th data-field="number" style="text-align: center;">Service Type</th>
                                    <th data-field="number" style="text-align: center;">Service Category</th>
                                    <th data-field="number" style="text-align: center;">Customer Name</th>

                                   </tr>
                                  </thead>
                                    <tbody>
                                    <tr>
                                        
                                    <td><strong>{{ $m['Value']['Barcode']}}</strong></td>
                                    <td><strong>{{ $m['Value']['Description']}}</strong></td>
                                    <td><strong>{{ $m['Value']['ServiceType']}}</strong></td>
                                    <td><strong>{{ $m['Value']['ServiceCategory']}}</strong></td>
                                    <td><strong>{{ $m['Value']['CustomerName']}}</strong></td>

                                  </tr>
                                </tbody>
                                </div>
                                </div>
                                
                
@endsection



