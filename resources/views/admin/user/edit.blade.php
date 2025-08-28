@extends('layouts.load')
@section('content')
<?php
$features= App\Models\Feature::all();
?>
						<!--<div class="content-area">-->
						<!--	<div class="add-product-content">-->
						<!--		<div class="row">-->
						<!--			<div class="col-lg-12">-->
						<!--				<div class="product-description">-->
						<!--					<div class="body-area">-->
@include('includes.admin.form-error') 
<form id="geniusformdata" action="{{ route('admin-user-edit',$data->id) }}" method="POST" class="exp-form" enctype="multipart/form-data">
	{{csrf_field()}}
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>{{ __("Customer Profile Image") }} </label>
                <div class="img-upload">
                	@if($data->is_provider == 1)
                        <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset($data->photo):asset('assets/images/noimage.png') }});">
                	@else
                        <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/users/'.$data->photo):asset('assets/images/noimage.png') }});">
                    @endif
                        @if($data->is_provider != 1)
                            <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __("Upload Image") }}</label>
                            <input type="file" name="photo" class="img-upload" id="image-upload">
                        @endif
                        </div>
                        <p class="text">{{ __("Prefered Size: (600x600) or Square Sized Image") }}</p>
                    </div>
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<label>{{ __("Name") }} </label>
				<input type="text" class="form-control" name="name" placeholder="{{ __("User Name") }}" required="" value="{{ $data->name }}">
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label>{{ __("Email") }} </label>
				<input type="email" class="form-control" name="email" placeholder="{{ __("Email Address") }}" value="{{ $data->email }}" disabled="">
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label>{{ __("Phone") }} </label>
				<input type="text" class="form-control" name="phone" placeholder="{{ __("Phone Number") }}" required="" value="{{ $data->phone }}">
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label>{{ __("City") }} </label>
			    <input type="text" class="form-control" name="city" placeholder="{{ __("City") }}" value="{{ $data->city }}">
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<label>{{ __("Address") }} </label>
				<input type="text" class="form-control" name="address" placeholder="{{ __("Address") }}" required="" value="{{ $data->address }}">
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label>{{ __("Fax") }} </label>
			    <input type="text" class="form-control" name="fax" placeholder="{{ __("Fax") }}" value="{{ $data->fax }}">
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label>{{ __("Postal Code") }} </label>
			    <input type="text" class="form-control" name="zip" placeholder="{{ __("Postal Code") }}" value="{{ $data->zip }}">
			</div>
		</div>
		@if($features[2]->status == 1 && $features[2]->active == 1 )
		<div class="col-lg-6">
			<div class="form-group">
				<label>{{ __("Wallet") }} </label>
			    <input type="number" class="form-control" name="refunds" placeholder="{{ __("Wallet") }}" value="{{ $data->refunds}}">
			</div>
		</div>
	    @endif
	    @if($features[1]->status == 1 && $features[1]->active == 1 )
	    <div class="col-lg-6">
			<div class="form-group">
				<label>{{ __("Points") }} </label>
		        <input type="number" class="form-control" name="points" placeholder="{{ __("Points") }}" value="{{ $data->points}}">
			</div>
		</div>
	    @endif
	</div>
    <div class="row">
		<div class="col-lg-12 text-center">
			<button class="main-light-btn py-3" type="submit">{{ __('Save') }} <i class="fas fa-check ms-3"></i></button>
		</div>
	</div>
</form>


<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->

@endsection