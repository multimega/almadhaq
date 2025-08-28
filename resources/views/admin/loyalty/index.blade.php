@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('Loyalty Program') }}">
					<div class="content-area">
						 <div class="home-head mb-4 mb-md-5">
                    <h3>{{ __('Loyalty Program') }} </h3>
                    <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('loyalty') }}">{{ __('Loyalty Program') }}</a></li>
                        </ol>
                    </nav>
                </div>
						<!--<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Loyalty Program') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
											<li>
												<a href="{{ route('loyalty') }}">{{ __('Loyalty Program') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>-->
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct default-box">

                        @include('includes.admin.form-success')  

										<div class="table-responsiv">
										     <div class="col-sm-12 table-contents">
                                                    	<a class="add-btn" data-href="{{route('admin-points-edits')}}" id="add-data" data-bs-toggle="modal" data-bs-target="#modal1">
                                                      <i class="fas fa-edit"></i> {{ __('Edit Points For 1 Pound') }}
                                                      </a>
                                                      </div>  <br>
                                                      <div class="col-sm-12 table-contents">
                                                    	<a class="add-btn" data-href="{{route('admin-points-create')}}" id="add-data" data-bs-toggle="modal" data-bs-target="#modal1">
                                                      <i class="fas fa-plus"></i> {{ __('Add Points') }}
                                                      </a>
                                                      </div>
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												    
													<thead>
														<tr>
									                        <th>{{ __('name') }}</th>
									                        <th>{{ __('Email') }}</th>
									                        <th>{{ __('Points') }}</th>
									                      
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>	
						<div class="product-area" style="margin-top:20px">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct default-box">

                        @include('includes.admin.form-success')  

										<div class="table-responsiv">
										    <div class="col-sm-12 table-contents">
                                                    	<a class="add-btn" data-href="{{route('admin-message-create')}}" id="add-data" data-bs-toggle="modal" data-bs-target="#modal1">
                                                      <i class="fas fa-plus"></i> {{ __('Add Message To User') }}
                                                      </a>
                                                      </div>
												<table id="geniustable1" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												    
													<thead>
														<tr>
									                        <th>{{ __('name') }}</th>
									                        <th>{{ __('Email') }}</th>
									                        <th>{{ __('Message') }}</th>
									                      
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
					<!--	<div class="product-area" style="margin-top:20px">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct default-box">

                        @include('includes.admin.form-success')  

										<div class="table-responsiv">
										    <div class="col-sm-12 table-contents">
                                                    	<a class="add-btn" data-href="{{route('admin-global-message-create')}}" id="add-data" data-bs-toggle="modal" data-bs-target="#modal1">
                                                      <i class="fas fa-plus"></i> {{ __('Add Global Messages ') }}
                                                      </a>
                                                      </div>
												<table id="geniustable2" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												    
													<thead>
														<tr>
									                        <th>{{ __('From') }}</th>
									                        <th>{{ __('To') }}</th>
									                        <th>{{ __('Message') }}</th>
									                      
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
					</div>-->



{{-- ADD / EDIT MODAL --}}

										<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
										
										
										<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
											</div>
										</div>
										</div>
</div>

{{-- ADD / EDIT MODAL ENDS --}}




{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
			<button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __('You are about to delete this Coupon.') }}</p>
            <p class="text-center">{{ __('Do you want to proceed?') }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection    



@section('scripts')


{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('datatables-loyalty-points') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'points', name: 'points' },
                      
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();	
				}
            });

      /*	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" data-href="{{route('admin-coupon-create')}}" id="add-data" data-toggle="modal" data-target="#modal1">'+
          '<i class="fas fa-plus"></i> {{ __('Add Points') }}'+
          '</a>'+
          '</div>');
      });		*/									
									


{{-- DATA TABLE ENDS--}}


</script>
 <script type="text/javascript">

		var table = $('#geniustable1').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('datatables-loyalty-messages') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'message', name: 'message' },
                      
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();	
				}
            });

    /*  	$(function() {
        $(".btn-area1").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" data-href="{{route('admin-coupon-create')}}" id="add-data" data-toggle="modal" data-target="#modal2">'+
          '<i class="fas fa-plus"></i> {{ __('Add Points') }}'+
          '</a>'+
          '</div>');
      });		*/									
									


{{-- DATA TABLE ENDS--}}


</script> 
<script type="text/javascript">

		var table = $('#geniustable2').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('datatables-loyalty-global') }}',
               columns: [
                        { data: 'min', name: 'min' },
                        { data: 'max', name: 'max' },
                        { data: 'message', name: 'message' },
                      
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();	
				}
            });

    /*  	$(function() {
        $(".btn-area1").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" data-href="{{route('admin-coupon-create')}}" id="add-data" data-toggle="modal" data-target="#modal2">'+
          '<i class="fas fa-plus"></i> {{ __('Add Points') }}'+
          '</a>'+
          '</div>');
      });		*/									
									


{{-- DATA TABLE ENDS--}}


</script>

    





@endsection   