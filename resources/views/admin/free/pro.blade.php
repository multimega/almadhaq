                                                   
@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('COUPON') }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Products') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
											<li>
												<a href="{{ route('admin-coupon-index-free') }}">{{ __('Coupons') }}</a>
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
									                      
									                        <th>{{ __('Products') }}</th>
									                      
									                        
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
													 <tbody>
													     @foreach($pro as $p)
													     @php
													     $product = App\Models\Product::where('id',$p->product_id)->first();
													     @endphp
													     @if($product)
													     <tr>
													      <td>{{$product->name}}</td>
													    
													    
													     <td> <a href="javascript:;" data-href="{{route('admin-coupon-delete-piece-pro',$p->id)}}" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></td>   
													     </tr>
													     @endif
													     @endforeach
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

    
    





@endsection   
