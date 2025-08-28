    
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
                                                <a href="javascript:;">Bosta Requests</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                             </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="orders" style="text-align: center;">
                              <thead>
                                <tr>
                                    <th      style="text-align: center;">Number</th>
                                    <th      style="text-align: center;">First Name</th>
                                    <th      style="text-align: center;">Last Name</th>
                                    <th      style="text-align: center;"> Phone</th>
                                    <th      style="text-align: center;">Date</th>
                                    <th      style="text-align: center;">Status</th>
                                    <th      style="text-align: center;">Action</th>
                                   </tr>
                                  </thead>
                                    <tbody>
                                     
                                    <tr>
                                        
                                      @foreach($theresult['deliveries']  as $values )
                                      
                                    <td><strong>{{$values['trackingNumber']}}</strong></td>
                                    <td><strong>{{ $values['receiver']['firstName']}}</strong></td>
                                    <td><strong>{{ $values['receiver']['lastName']}}</strong></td>
                                    <td><strong>{{ $values['receiver']['phone']}}</strong></td>
                                    <td><strong>{{$values['createdAt']}}</strong></td>
                                    <td><strong>{{ $values['state']['value']}}</strong></td>
                
                                    <td>
                                     <a  class="btn btn-success" href="{{ url('admin/showsposta/'.$values['_id']) }}">Show</a>
                                      <br><br>
                            
                                      
                                            @if($values['state']['value'] == 'Pickup requested')

                                              <form  action="{{ route('deleteapi' ,$values['_id'])}}" method="post">
                                                   <input type="hidden" name="_method" value="DELETE">
                                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                   <button type="submit"class="btn btn-danger" onclick='return confirm("Are You sure!!")' >Terminate Request</button>
                                            
                                                </form>
                                                @endif
                                                </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                </div>
                             </section>
                           @endsection