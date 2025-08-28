@extends('layouts.load')
@section('content')
@include('includes.admin.form-error') 
<form id="geniusformdata" action="{{route('admin-cblog-create')}}" method="POST" class="exp-form" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<label>{{ __('Name') }} * <small>{{ __('(In Any Language)') }}</small></label>
				<input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" required="" value="">
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<label>{{ __('Arabic Name') }} * <small>{{ __('(Arabic)') }}</small></label>
				<input type="text" class="form-control" name="name_ar" placeholder="{{ __('Arabic Name') }}" required="" value="">
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<label>{{ __('Slug') }} * <small>{{ __('(In Any English)') }}</small></label>
				<input type="text" class="form-control" name="slug" placeholder="{{ __('Slug') }}" required="" value="">
			</div>
		</div>
	</div>
    <div class="row">
		<div class="col-lg-12 text-center">
			<button class="main-light-btn py-3" type="submit">{{ __('Create Category') }} <i class="fas fa-check ms-3"></i></button>
		</div>
	</div>
</form>
@endsection