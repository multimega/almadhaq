                                                   
@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('zones') }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Cities') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
											<li>
												<a href="{{ route('admin-zones-index') }}">{{ __('Zones') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">

                        @include('includes.admin.form-success')  

										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                      
									                        <th>{{ __('City') }}</th>
									                      
									                        
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
													 <tbody>
													     @forelse($city as $p)
													  
													     <tr>
													      <td>{{$p->name}}</td>
													    
													    
													     <td> <a href="javascript:;" data-href="{{route('admin-zones-delete-city',$p->id)}}" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></td>   
													     </tr>
													     
													     @empty
													      <tr>
													      <td>No Cities</td>
													    
													    
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
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection    



@section('scripts')


{{-- DATA TABLE --}}

    
    





@endsection   
