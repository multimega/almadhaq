@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('Features') }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Features') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
											<li>
												<a href="{{ route('features') }}">{{ __('Features') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">

                       @if(Session::has('flash_message')) 
                         <div class="alert alert-danger text-center"><em> {!! session('flash_message') !!}</em></div>
                         @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block" align="center">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>{{ __('id') }}</th>
									                        <th>{{ __('name') }}</th>
									                      
									                        <th>{{ __('Status') }}</th>
									                       
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
					</div>




                        @endsection    



@section('scripts')


{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('datatables-features') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                       
                        { data: 'status', searchable: false, orderable: false},
            		

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();	
				}
            });
											
									


{{-- DATA TABLE ENDS--}}


</script>

    





@endsection   