@extends('layouts.admin') 

@section('content')  
<input type="hidden" id="headerdata" value="{{ __("CUSTOMER") }}">
<div class="content-area">
    <div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Customers") }} <span>{{ __("Manage your customers") }}</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item">{{ __("Customers") }}</li>
            </ol>
        </nav>
    </div>
    @include('includes/admin/navs/customers_nav')
	<div class="product-area">
		<div class="row">
			<div class="col-lg-12">
				<div class="mr-table allproduct default-box">
					@include('includes.admin.form-success') 
					<div class="table-responsiv">
						<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
			                        <th>{{ __("Name") }}</th>
			                        <th>{{ __("Email") }}</th>
			                        <th>{{ __("Options") }}</th>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __("Close") }}</button>
            </div>
        </div>
    </div>
</div>

{{-- ADD / EDIT MODAL ENDS --}}

{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
    		<h4 class="modal-title d-inline-block">{{ __("Confirm Delete") }}</h4>
    		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    	</div>
        <!-- Modal body -->
        <div class="modal-body">
            <p class="text-center">{{ __("You are about to delete this Customer.") }}</p>
            <p class="text-center mb-0">{{ __("Do you want to proceed?") }}</p>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __("Cancel") }}</button>
            <a class="btn btn-danger">{{ __("Delete") }}</a>
        </div>
    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}

{{-- MESSAGE MODAL --}}
<div class="sub-categori">
	<div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="vendorformLabel">{{ __("Send Message") }}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
				</div>
    			<div class="modal-body">
    				<div class="container-fluid p-0">
    					<div class="row">
    						<div class="col-md-12">
    							<div class="contact-form">
    								<form id="emailreply1" class="exp-form">
    									{{csrf_field()}}
										<input type="email" class="form-control eml-val mb-3" id="eml1" name="to" placeholder="{{ __("Email") }} *" value="" required="">
										<input type="text" class="form-control mb-3" id="subj1" name="subject" placeholder="{{ __("Subject") }} *" required="">
										<textarea class="form-control textarea mb-3" name="message" id="msg1" placeholder="{{ __("Your Message") }} *" required=""></textarea>
    									<button class="submit-btn" id="emlsub1" type="submit">{{ __("Send Message") }}</button>
    								</form>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
			</div>
		</div>
	</div>
</div>

{{-- MESSAGE MODAL ENDS --}}
@endsection    

@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-user-datatables') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
            			{ data: 'action', searchable: false, orderable: false }
                     ],
               language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
                drawCallback : function( settings ) {
                        $('.select').niceSelect();  
                }
            });
																
    </script>

{{-- DATA TABLE --}}
    
@endsection   