                                                   
@extends('layouts.admin') 

@section('content')  
<input type="hidden" id="headerdata" value="{{ __('COUPON') }}">
<div class="content-area">
	<div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Products") }} </h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item">{{ __("Products") }}</li>
            </ol>
        </nav>
    </div>
	<div class="product-area">
		<div class="row">
			<div class="col-lg-12">
				<div class="mr-table allproduct default-box">
					<div class="table-responsiv">
						<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
			                        <th>{{ __('Products') }}</th>
			                        <th>{{ __('Options') }}</th>
								</tr>
							</thead>
						    <tbody>
					            @include('includes.admin.form-success')  
							     @forelse($users as $u)
							     @php
							     $user = App\Models\User::where('id',$u->user_id)->first();
							     @endphp
							     <tr>
							        <td>{{!empty($user->name) ? $user->name : "user deleted"}}</td>
							        <td> <a href="javascript:;" data-href="{{route('admin-prod-remove-aff-user',$u->id)}}" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></td>   
							     </tr>
							     @empty
							        <tr>
							            <td colspan="2">No Users Found</td>
						            </tr> 
							     @endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
        <p class="text-center">{{ __('You are about to delete this Coupon.') }}</p>
        <p class="text-center mb-0">{{ __('Do you want to proceed?') }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-danger">{{ __('Delete') }}</a>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection  

@section('scripts')
{{-- DATA TABLE --}}
@endsection   
