@extends('layouts.front_34')

@section('content')

<div class="acc-settings">
    <div class="row m-0">
        @include('includes.user-dashboard-34-sidebar')
        <div class="col-lg-10 col-md-9 hidden-classes mb-3">
            <div>
                <div class="settings-container">
                    <div class="settings-header d-flex justify-content-between align-items-center">
                        <h3>{{ $langg->lang813 }}</h3>
    					<a data-toggle="modal" data-target="#update-add" class="btn btn-success" href="javascript:;"> <i class="fas fa-envelope"></i> {{ $langg->lang958 }}</a>
					</div>
					<div class="no-orders">
                        <div class="mr-table allproduct message-area  mt-4">
						    @include('includes.form-success')
							<div class="table-responsive">
								<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>{{$langg->lang156}}</th>
											<th>{{$langg->lang158}}</th>
											<th>{{$langg->lang155}}</th>
											<th>{{$langg->lang159}}</th>
											<th>{{$langg->lang282}}</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach($address as $a)
                                        <tr>
                                            <td>{{$a->country}}</td>
											<td>{{$a->city}}</td>
											<td>{{$a->address}}</td>
										    <td>{{$a->phone}}</td>
											<td>
											    <a href="#" data-id="1" data-toggle="modal" data-target="#update-img{{$a->id}}" alt="" title="Edit Address">
											        <i class="fas fa-edit text-success"></i>
												</a>
												<a href="{{route('user-address-delete',$a->id)}}" ><i class="fas fa-trash text-danger"></i></a>
											</td> 
                                        </tr>
                                        <div class="modal fade" id="update-img{{$a->id}}" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header py-2" style="background: #045c0c;">
                                                        <button type="button" class="close" data-dismiss="modal" style="top: 11px">&times;</button>
                                                        <h5 class="modal-title text-white">{{$langg->lang959}}</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="updateImageResult"></div>
                                                        <form id="updateImage" action="{{route('user-address-update-34',$a->id)}}" method="post" enctype="multipart/form-data">
                                                                    {{csrf_field()}}
                                                                    <label class="heading">{{$langg->lang156}} *</label>  
                                                                    <select name="country" class="form-control mb-3" required>
                                                                    @include('includes.countries')
                                                                    </select>
                                                                    <label class="heading">{{$langg->lang158}} *</label>
                                                                    <select name="city" class="form-control mb-3" required>
                                                                        <option value="{{ $a->city}}"> {{ $a->city}}</option>
                                                                    </select>
                                                                    <label class="heading">{{$langg->lang155}} *</label>
                                                                    <textarea name="address" class="form-control mb-3" required>{{ $a->address}}</textarea>
                                                                    <label class="heading">{{$langg->lang159}} </label>
                                                                    <input type="number" class="form-control mb-3" name="phone" value="{{ $a->phone}}" >
                                                                    <input type="hidden" value="" class="field_id" name="field_id"/>
                                                                    <input type="submit" class="btn btn-success updatebtn" name="editImage"value="Save"/>
                                                                </form>
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
                                            <div class="modal-header py-2" style="background: #045c0c;">
                                                <button type="button" class="close" data-dismiss="modal" style="top: 11px">&times;</button>
                                                <h5 class="modal-title text-white">{{$langg->lang958}}</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div id="updateImageResult"></div>
                                                <form id="updateImages" action="{{route('user-address-store-34')}}" method="post" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <label class="heading">{{$langg->lang156}} *</label>
                                                    <select name="country" class="form-control mb-3" required>
                                                        @include('includes.countries')
                                                    </select>
                                                    <label class="heading">{{$langg->lang158}} *</label>
                                                    <select name="city" class="form-control mb-3" required>
                                                        <option value=" {{ !empty(Auth::guard('web')->user()->city) ? Auth::guard('web')->user()->city  : '' }}"> {{ !empty(Auth::guard('web')->user()->city) ? Auth::guard('web')->user()->city  : '' }} </option>
                                                    </select>
                                                    <label class="heading">{{$langg->lang155}} *</label>
                                                    <textarea name="address" class="form-control mb-3" required></textarea>
                                                    <label class="heading">{{$langg->lang159}} </label>
                                                    <input type="number" class="form-control mb-3" name="phone" value="" >
                                                    <input type="hidden" value="" class="field_id" name="field_id"/>
                                                    <input type="submit" class="btn btn-success updatebtn" name="editaddress" value="Save"/>
                                                </form>
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
</div>

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
