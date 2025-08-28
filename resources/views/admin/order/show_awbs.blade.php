@extends('layouts.admin') 
@section('content')
  
                
                    
                        <section class="panel" style=" padding: 10px;">
                            <div class="mr-breadcrumb">
                            <div class="row">
                                <div class="col-lg-12">
                                        <ul class="links">
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                                            </li>
                                            <li> 
                                                 <a href="javascript:;">Abs Awbs </a>
                                            </li>
            
                                        </ul>
                                    </div>
                                </div>
                             </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="orders" style="text-align: center;">
                              <thead>
                                <tr>
                                    <th      style="text-align: center;">AWB</th>
                                    <th      style="text-align: center;">Pickup Date</th>
                                    <th      style="text-align: center;">Consignee Name</th>
                                    <th      style="text-align: center;"> Address</th>
                                    <th      style="text-align: center;">Phone</th>
                                    <th      style="text-align: center;">Mobile</th>
                                   </tr>
                                  </thead>
                                    <tbody>
                                     
                                    <tr>
                                        
                                      @foreach($m  as $value )
                                      
                                    <td><strong>{{$value['AWB']}}</strong></td>
                                    <td><strong>{{ $value['Pickup Date']}}</strong></td>
                                    <td><strong>{{ $value['Consignee Name']}}</strong></td>
                                    <td><strong>{{$value['Adress']}}</strong></td>
                                    <td><strong>{{ $value['Telephone']}}</strong></td>
                                    <td><strong>{{ $value['Mobile']}}</strong></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                </div>
                             </section>
                           @endsection