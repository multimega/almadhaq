@extends('layouts.load')
@section('content')

<div class="content-area">
	<div class="add-product-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
					<div class="body-area">
    					@include('includes.admin.form-error') 
    					<form id="geniusformdata" action="{{route('admin-vendor-verify-submit',$data->id)}}" method="POST" class="exp-form" enctype="multipart/form-data">
    						{{csrf_field()}}
    						<div class="row">
    							<div class="col-lg-12">
    								<div class="form-group">
    									<label>{{ __('Details') }} * <small>{{ __('(In Any Language)') }}</small></label>
    									<textarea class="form-control" name="details" required="" placeholder="{{ __('Enter Verification Details') }}" rows="5"></textarea> 
    								</div>
    							</div>
    						</div>
                            <input type="hidden" name="user_id" value="{{ $data->id }}">
    						<div class="row">
    						    <div class="col-lg-12 mt-4 text-end">
    								<button class="main-dark-btn py-3" type="submit">{{ __("Send") }}</button>
    							</div>
    						</div>
    					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection