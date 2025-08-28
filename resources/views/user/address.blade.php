@extends('layouts.front')
@section('content')


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area">
								<h4 class="title">
							{{ $langg->lang813 }}
						        <button data-id="1" class="btn btn-primary"
                                 data-toggle="modal" data-target="#update-add" alt=""
                                 title="Add Address"> + {{$langg->lang958}}</button>
								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
							    	@include('includes.form-success')
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{$langg->lang156}}</th>
														<th>{{$langg->lang158}}</th>
														<th>{{$langg->lang155}}</th>
														<th>{{$langg->lang153}}</th>
													
													
														<th>{{ $langg->lang282 }}</th>
														
													</tr>
												</thead>
												<tbody>
													 @foreach($address as $a)
													 
												
													<tr>
														<td>
														 {{$a->country}} 
														</td>
														<td>
															 {{$a->city}} 
														</td>
														<td>
																 {{$a->address}} 
														</td>
														<td>
																{{$a->phone}}
														</td>
													
														<td> 
															<a href="#" data-id="1"
                                                                     data-toggle="modal" data-target="#update-img{{$a->id}}" alt=""
                                                                     title="Edit Address"><i class="fa fas-edit"></i>
                                                                     
																Edit
															</a>
																 <a href="{{route('user-address-delete',$a->id)}}" ><i class="fa fa-trash"></i></a>
														</td>
													
													</tr>
													
													  <div class="modal fade" id="update-img{{$a->id}}" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{$langg->lang959}}</h4>
                    </div>
                    <div class="modal-body">
                        <div id="updateImageResult"></div>
                        <div class="row">
                            <div class="col-lg-9 pull-left">
                             <form id="updateImage" action="{{route('user-address-update-34',$a->id)}}" method="post"
                                      enctype="multipart/form-data">
                                     
                                    {{csrf_field()}}
                                     <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{$langg->lang156}} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7 form-group">
                              <select name="country" class="form-control" required>
                                 @include('includes.countries')
                              </select>
                          
                          </div> 
                   
                        </div>   
                           <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{$langg->lang158}} *</h4>
                               
                            </div>
                          </div>
                          <div class="col-lg-7 form-group" >
                            <select name="city" class="form-control" required>
                               <option value="{{ $a->city}}"> {{ $a->city}}</option>

                                  
                              </select>
                          </div>
                        </div>   
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{$langg->lang155}} *</h4>
                               
                            </div>
                          </div>
                          <div class="col-lg-7 form-group">
                           <textarea name="address" class="form-control" required>{{ $a->address}}</textarea>
                          </div>
                        </div>     
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{$langg->lang153}} </h4>
                               
                            </div>
                          </div>
                          <div class="col-lg-7 form-group">
                           <input type="number" class="form-control" name="phone" value="{{ $a->phone}}" >
                          </div>
                        </div>  
                                    <input type="hidden" value="" class="field_id" name="field_id"/>
                                    <input type="submit" class="btn btn-primary updatebtn" name="editImage"
                                           value="Save"/>
                              </form>
                           
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
													@endforeach
												</tbody>
											</table>
		<div class="modal fade" id="update-add" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{$langg->lang958}}</h4>
                    </div>
                    <div class="modal-body">
                        <div id="updateImageResult"></div>
                        <div class="row">
                            <div class="col-lg-9 pull-left">
                             <form id="updateImages" action="{{route('user-address-store')}}" method="post"
                                      enctype="multipart/form-data">
                                     
                                    {{csrf_field()}}
                                  
                         <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{$langg->lang156}} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7 form-group">
                              <select name="country" class="form-control" required>
                                 @include('includes.countries')
                              </select>
                          
                          </div> 
                   
                        </div>   
                           <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{$langg->lang158}} *</h4>
                               
                            </div>
                          </div>
                          <div class="col-lg-7 form-group" >
                            <select name="city" class="form-control" required>
                               <option value=" {{ !empty(Auth::guard('web')->user()->city) ? Auth::guard('web')->user()->city  : '' }}"> {{ !empty(Auth::guard('web')->user()->city) ? Auth::guard('web')->user()->city  : '' }} </option>

                                  
                              </select>
                          </div>
                        </div>   
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{$langg->lang155}} *</h4>
                               
                            </div>
                          </div>
                          <div class="col-lg-7 form-group">
                           <textarea name="address" class="form-control" required></textarea>
                          </div>
                        </div>     
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{$langg->lang153}} </h4>
                               
                            </div>
                          </div>
                          <div class="col-lg-7 form-group">
                           <input type="number" class="form-control" name="phone" value="" >
                          </div>
                        </div>  
                                   
                                    <input type="hidden" value="" class="field_id" name="field_id"/>
                                    <input type="submit" class="btn btn-primary updatebtn" name="editaddress"
                                           value="Save"/>
                              </form>
                           
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

@section('js')

		<script>
      
              $(document).ready(function(){
             $("Select[name='country']").change(function(){
        
              var id= $(this).val();
              var url = "{{ url ('/cities')}}";
              var token = $("input[name='_token']").val();
              $.ajax({
                  url: url,
                  method: 'POST',
                  data: {id:id, _token:token},
                  success: function(data) {
                      $("[name='city']").html('');
                    $("[name='city']").html(data.options);
                     
                  }
                });
              });
        
           });
           
           
           
</script>
@stop
