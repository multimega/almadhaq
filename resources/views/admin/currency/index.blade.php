@extends('layouts.admin') 

@section('content')  
<input type="hidden" id="headerdata" value="{{ __('CURRENCY') }}">
<div class="content-area">
    <div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Currencies") }}</h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/main-settings') }}">{{ __("Main Settings") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/general-settings') }}">{{ __("General Settings") }}</a></li>
                <li class="breadcrumb-item">{{ __("Currencies") }}</li>
            </ol>
        </nav>
    </div>
    <div class="product-area">
        <div class="row">
            <div class="col-lg-12">
				<div class="default-box d-flex align-items-center">
					<h4 class="title">{{ __('Currency') }}: </h4>
                    <div class="action-list">
                        <select class="process select droplinks {{ $gs->is_currency== 1 ? 'drop-success' : 'drop-danger' }}">
                          <option data-val="1" value="{{route('admin-gs-iscurrency',1)}}" {{ $gs->is_currency == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                          <option data-val="0" value="{{route('admin-gs-iscurrency',0)}}" {{ $gs->is_currency == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                        </select>
                    </div>
				</div>  
                <div class="mr-table allproduct default-box">
                    @include('includes.admin.form-success') 
					<div class="table-responsive">
						<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
			                        <th>{{ __('Name') }}</th>
			                        <th>{{ __('Sign') }}</th>
			                        <th>{{ __('Value') }}</th>
			                        <th>Image</th>
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
					<button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
				</div>
			</div>
		</div>
</div>

{{-- ADD / EDIT MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header ">
		<h4 class="modal-title ">{{ __('Confirm Delete') }}</h4>
			<button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __('You are about to delete this Currency.') }}</p>
            <p class="text-center">{{ __('Do you want to proceed?') }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}


@endsection    



@section('scripts')

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-currency-datatables') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'sign', name: 'sign' },
                        { data: 'value', name: 'value' },
                        { data: 'image', name: 'image' },
            			{ data: 'action', searchable: false, orderable: false }

                     ],
               language: {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 text-end">'+
        	'<a class="main-dark-btn" data-href="{{route('admin-currency-create')}}" id="add-data" data-bs-toggle="modal" data-bs-target="#modal1">'+
          '<i class="fas fa-plus"></i> {{ __('Add New Currency') }}'+
          '</a>'+
          '</div>');
      });												
									
    </script>
@endsection   