@extends('layouts.load')

@section('styles')

<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">

@endsection

@section('content')

						<div class="content-area p-0">
							<div class="social-links-area p-0">
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">
											@include('includes.admin.form-error') 
											<form id="geniusformdata" action="{{route('admin-pro-features')}}" class="exp-form" method="POST" enctype="multipart/form-data">
												{{csrf_field()}}

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading">{{ __("Highlight in") }} {{ $langg->lang26 }} *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="featured" value="1" >
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading">{{ __("Highlight in") }}  {{ $langg->lang27 }} *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="best" value="1" >
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading">{{ __("Highlight in") }}  {{ $langg->lang28 }} *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="top" value="1" >
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading">{{ __("Highlight in") }}  {{ $langg->lang29 }} *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="big" value="1" >
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading">{{ __("Highlight in") }}  {{ $langg->lang30 }} *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="hot" value="1" >
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>


												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading">{{ __("Highlight in") }} {{ $langg->lang31 }} *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="latest" value="1" >
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading">{{ __("Highlight in") }} {{ $langg->lang32 }} *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="trending" value="1">
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading">{{ __("Highlight in") }} {{ $langg->lang33 }} *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="sale" value="1" >
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="row">
													<div class="col-lg-8">
														<div class="left-area">
																<h4 class="heading">{{ __("Highlight in") }} {{ $langg->lang244 }} *</h4>
														</div>
													</div>
									                  <div class="col-sm-3">
									                    <label class="switch">
									                      <input type="checkbox" name="is_discount" id="is_discount" value="1" >
									                      <span class="slider round"></span>
									                    </label>
									                  </div>
												</div>

												<div class="showbox">

												<div class="row">
													<div class="col-lg-6">
														<div class="left-area">
																<h4 class="heading">{{ __("Discount Date") }} *</h4>
														</div>
													</div>
									                  <div class="col-sm-6">
									                      <input type="text" class="input-field" name="discount_date"  placeholder="{{ __("Enter Date") }}" id="discount_date" value="">

									                  </div>
												</div>
												</div>
												<div class="row">
													<div class="col-lg-5">
														<div class="left-area">
															 <input type="hidden" id="selected_products_feature" name="selected_products_feature" value="">
														</div>
													</div>
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
						</div>

@endsection

@section('scripts')

<script type="text/javascript">

$('#is_discount').on('change',function(){

if(this.checked)
{
	$(this).parent().parent().parent().next().removeClass('showbox');
	$('#discount').prop('required',true);
	$('#discount_date').prop('required',true);
}

else {
	$(this).parent().parent().parent().next().addClass('showbox');
	$('#discount').prop('required',false);
	$('#discount_date').prop('required',false);
}

});

    var dateToday = new Date();
    var dates =  $( "#discount_date" ).datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: dateToday,
});

</script>
@endsection
