@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('POINTS') }}">
					<div class="content-area">
						<div class="home-head mb-4 mb-md-5">
                    <h3>{{ __('Coupons By Points') }} </h3>
                        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin-points-index') }}">{{ __('Coupons By Points') }}</a></li>
                            </ol>
                        </nav>
                    </div>
						<!--<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Coupons By Points') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
											<li>
												<a href="{{ route('admin-points-index') }}">{{ __('Coupons By Points') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>-->
						
						<!-- Discount coupons -->
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct default-box">

                        @include('includes.admin.form-success')  

										<div class="table-responsiv">
										       <div class="col-sm-12 table-contents">
                                                <a class="add-btn" data-href="{{route('admin-pointss-create')}}" id="add-data" data-toggle="modal" data-target="#modal1">
                                                      <i class="fas fa-plus"></i> {{ __('Add Discount Coupon By Points') }}
                                                      </a>
                                                      </div>
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>{{ __('Code') }}</th>
									                        <th>{{ __('Points') }}</th>
									                        <th>{{ __('Type') }}</th>
									                        <th>{{ __('Amount') }}</th>
									                        <th>{{ __('Limit ') }}</th>
									                        <th>{{ __('days') }}</th>
									                        <th>{{ __('For') }}</th>
									                        <th>{{ __('Used') }}</th>
									                        <th>{{ __('Status') }}</th>
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						 <!-- Buy One Get One Coupons-->
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct default-box">

                        

										<div class="table-responsiv">
										     <div class="col-sm-12 table-contents">
                                                    	<a class="add-btn" data-href="{{route('admin-pointss-piece-create')}}" id="add-data" data-toggle="modal" data-target="#modal1">
                                                      <i class="fas fa-plus"></i> {{ __('Add Buy One Get One Coupon') }}
                                                      </a>
                                                      </div>
												<table id="geniustable1" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>{{ __('Code') }}</th>
									                        <th>{{ __('Points') }}</th>
									                        <th>{{ __('Product') }}</th>
									                        <th>{{ __('days') }}</th>
									                        <th>{{ __('For') }}</th>
									                        <th>{{ __('Used') }}</th>
									                        <th>{{ __('Status') }}</th>
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>	 
						
						
						<!--Take One Free Coupons-->
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct default-box">

                        

										<div class="table-responsiv">
										     <div class="col-sm-12 table-contents">
                                                    	<a class="add-btn" data-href="{{route('admin-pointss-free-create')}}" id="add-data" data-toggle="modal" data-target="#modal1">
                                                      <i class="fas fa-plus"></i> {{ __('Add Take One Free Coupon') }}
                                                      </a>
                                                      </div>
												<table id="geniustable2" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>{{ __('Code') }}</th>
									                        <th>{{ __('Points') }}</th>
									                        
									                        <th>{{ __('Product') }}</th>
									                        
									                           <th>{{ __('days') }}</th>
									                         <th>{{ __('For') }}</th>
									                         <th>{{ __('Used') }}</th>
									                        <th>{{ __('Status') }}</th>
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
					</div>



{{-- ADD / EDIT MODAL --}}

										<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
										
										
										<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
               ajax: '{{ route('admin-points-datatables') }}',
               columns: [
                        { data: 'code', name: 'code' },
                        { data: 'points', name: 'points' },
                        { data: 'type', name: 'type' },
                        { data: 'price', name: 'price' },
                        { data: 'limited', name: 'limited' },
                        { data: 'days', name: 'days' },
                             { data: 'user_id', name: 'user_id' },
                        { data: 'used', name: 'used' },
                   
                        { data: 'status', searchable: false, orderable: false},
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
			
            });
            
		var table = $('#geniustable1').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-points-piece-datatables') }}',
               columns: [
                        { data: 'code', name: 'code' },
                        { data: 'points', name: 'points' },
                      
                        { data: 'product_id', name: 'product_id' },
                        
                        { data: 'days', name: 'days' },
                        { data: 'user_id', name: 'user_id' },
                        { data: 'used', name: 'used' },
                   
                        { data: 'status', searchable: false, orderable: false},
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
			
            });	
            
            var table = $('#geniustable2').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-points-free-datatables') }}',
               columns: [
                        { data: 'code', name: 'code' },
                        { data: 'points', name: 'points' },
                      
                        { data: 'product_id', name: 'product_id' },
                        
                        { data: 'days', name: 'days' },
                        { data: 'user_id', name: 'user_id' },
                        { data: 'used', name: 'used' },
                   
                        { data: 'status', searchable: false, orderable: false},
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
			
            });

    /*  	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" data-href="{{route('admin-pointss-create')}}" id="add-data" data-toggle="modal" data-target="#modal1">'+
          '<i class="fas fa-plus"></i> {{ __('Add New Coupon By Points') }}'+
          '</a>'+
          '</div>');
      });*/											
									


{{-- DATA TABLE ENDS--}}






</script>

    





@endsection   