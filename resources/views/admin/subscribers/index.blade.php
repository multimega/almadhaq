@extends('layouts.admin') 

@section('content')  

<div class="content-area">
	<div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Subscribers") }} </h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item">{{ __("Subscribers") }}</li>
            </ol>
        </nav>
    </div>
	<div class="product-area">
		<div class="row">
			<div class="col-lg-12">
				<div class="mr-table allproduct default-box">
                    @include('includes.admin.form-both')  
					<div class="table-responsiv">
						<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
			                        <th>{{ __("#Sl") }}</th>
			                        <th>{{ __("Email") }}</th>
			                        <th>Name</th>
			                        <th>Birth Date</th>
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

<script type="text/javascript">

		$('#example').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-subs-datatables') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'email', name: 'email' },
                        { data: 'name', name: 'name'},
                        { data: 'birth_date', name: 'birth_date'}
                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });								
					
      	$(function() {
        $(".btn-area").append('<div class="col-4 text-end">'+
        	'<a class="main-dark-btn" href="{{route('admin-subs-download')}}">'+
          '<i class="fa fa-download"></i> {{ __("Download") }}'+
          '</a>'+
          '</div>');
      });	

</script>
@endsection   