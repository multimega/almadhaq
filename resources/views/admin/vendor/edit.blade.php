@extends('layouts.load')
@section('content')

<div class="content-area">
	<div class="add-product-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
					<div class="body-area">
    					@include('includes.admin.form-error') 
    					<form id="geniusformdata" action="{{ route('admin-vendor-edit',$data->id) }}" method="POST" class="exp-form" enctype="multipart/form-data">
    						{{csrf_field()}}
    						<div class="row">
    							<div class="col-lg-12">
    								<div class="form-group">
    								    <label>{{ __("Email") }} *</label>
    								    <input type="email" class="form-control" name="email" placeholder="{{ __("Email Address") }}" value="{{ $data->email }}" disabled="">
    								</div>
    							</div>
    							<div class="col-lg-12">
    								<div class="form-group">
    								    <label>{{ __("Shop Name") }} *</label>
    								    <input type="text" class="form-control" name="shop_name" placeholder="{{ __("Shop Name") }}" required="" value="{{ $data->shop_name }}">
    								</div>
    							</div>
    							<div class="col-lg-12">
    								<div class="form-group">
    								    <label>{{ __("Shop Details") }} *</label>
    								    <textarea class="nic-edit form-control" name="shop_details" placeholder="{{ __("Details") }}">{{ $data->shop_details }}</textarea> 
    								</div>
    							</div>
    							<div class="col-lg-12">
    								<div class="form-group">
    								    <label>{{ __("Owner Name") }} *</label>
    								    <input type="text" class="form-control" name="owner_name" placeholder="{{ __("Owner Name") }}" required="" value="{{ $data->owner_name }}">
    								</div>
    							</div>
    							<div class="col-lg-12">
    								<div class="form-group">
    								    <label>{{ __("Shop Number") }} *</label>
    								    <input type="text" class="form-control" name="shop_number" placeholder="{{ __("Shop Number") }}" required="" value="{{ $data->shop_number }}">
    								</div>
    							</div>
    							<div class="col-lg-12">
    								<div class="form-group">
    								    <label>{{ __("Shop Address") }} *</label>
    								    <input type="text" class="form-control" name="shop_address" placeholder="{{ __("Shop Address") }}" required="" value="{{ $data->shop_address }}">
    								</div>
    							</div>
    							<div class="col-lg-12">
    								<div class="form-group">
    								    <label>{{ __("Registration Number") }} <small>{{ __("(This Field is Optional)") }}</small></label>
    								    <input type="text" class="form-control" name="reg_number" placeholder="{{ __("Registration Number") }}" value="{{ $data->reg_number }}">
    								</div>
    							</div>
    							<div class="col-lg-12">
    								<div class="form-group">
    								    <label>{{ __("Message") }} <small>{{ __("(This Field is Optional)") }}</small></label>
    								    <input type="text" class="form-control" name="shop_message" placeholder="{{ __("Message") }}" value="{{ $data->shop_message }}">
    								</div>
    							</div>
    						</div>
                            <div class="row">
                                <div class="col-lg-12 mt-4 text-end">
    								<button class="main-dark-btn py-3" type="submit">{{ __("Submit") }}</button>
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