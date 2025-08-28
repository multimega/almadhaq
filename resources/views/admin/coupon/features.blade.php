@extends('layouts.admin') 

@section('content')  
<input type="hidden" id="headerdata" value="{{ __('Features') }}">
<div class="content-area">
    <div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Features") }}</h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/main-settings') }}">{{ __("Main Settings") }}</a></li>
                <li class="breadcrumb-item">{{ __("Features") }}</li>
            </ol>
        </nav>
    </div>
    <div class="product-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="mr-table allproduct default-box">
                    @if(Session::has('flash_message')) 
                        <div class="alert alert-danger text-center"><em> {!! session('flash_message') !!}</em></div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block" align="center">
                            <button type="button" class="btn-close" data-bs-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
    				<div class="table-responsive">
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