@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>
@endsection
@section('content')

@php
$sign = App\Models\Currency::where('is_default',1)->first();
@endphp


						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ __("Affiliate Category") }} <a class="add-btn" href="{{ route('admin-import-affiliate-index') }}"><i class="fas fa-arrow-left"></i> {{ __("Back") }}</a></h4>
											<ul class="links">
												<li>
													<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
												</li>
											<li>
												<a href="javascript:;">{{ __("Affiliate Categories") }} </a>
											</li>
											<li>
												<a href="{{ route('admin-import-affiliate-index') }}">{{ __("All Affiliate Categories") }}</a>
											</li>
												<li>
													<a href="{{ route('admin-affilate-settings-create') }}">{{ __("Add Affiliate Category") }}</a>
												</li>
											</ul>
									</div>
								</div>
							</div>
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">

					                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
					                      <form id="geniusform" action="{{route('admin-affiliate-setting-update',$data->id)}}" method="POST" enctype="multipart/form-data">
					                        {{csrf_field()}}

                        					@include('includes.admin.form-both')

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Affiliate Category Name') }}* </h4>
																<p class="sub-heading">(In Any Language)</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" placeholder="{{ __('Enter Affiliate Name') }}" name="affiliate_name" required="" value="{{$data->affiliate_name}}">
													</div>
												</div>
												
												
											   
                                                 <div class="row">
                                          <div class="col-lg-4">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Type') }} *</h4>
                                            </div>
                                          </div>
                                          <div class="col-lg-7">
                                              <select id="type" name="type" required="">
                                                <option value="">{{ __('Choose a type') }}</option>
                                                <option value="0" {{$data->type == 0 ? "selected":""}}>{{ __('Percentage') }}</option>
                                                <option value="1" {{$data->type == 1 ? "selected":""}}>{{ __('Amount') }}</option>
                                              </select>
                                          </div>
                                        </div>
                
                                        <div class="row hidden">
                                          <div class="col-lg-4">
                                            <div class="left-area">
                                                <h4 class="heading"></h4>
                                            </div>
                                          </div>
                                          <div class="col-lg-3">
                                            <input type="text" class="input-field less-width" name="amount" placeholder="" required="" value="{{$data->amount}}"><span></span>
                                          </div>
                                        </div>
											
											     	<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															
														</div>
													</div>
													<div class="col-lg-7 text-center">
														<button class="addProductSubmit-btn" type="submit">{{ __("Edit Affiliate") }}</button>
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

@section('scripts')

		<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
		<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>


  <script type="text/javascript">
  
   {{-- Coupon Function --}}

(function () {

      var val = $('#type').val();
      var selector = $('#type').parent().parent().next();
      if(val == "")
      {
        selector.hide();
      }
      else {
        if(val == 0)
        {
          selector.find('.heading').html('{{ __('Percentage') }} *');
          selector.find('input').attr("placeholder", "{{ __('Enter Percentage') }}").next().html('%');
          selector.css('display','flex');
        }
        else if(val == 1){
          selector.find('.heading').html('{{ __('Amount') }} *');
          selector.find('input').attr("placeholder", "{{ __('Enter Amount') }}").next().html('$');
          selector.css('display','flex');
        }
      }
})();

{{-- Coupon Type --}}
  
    $('#type').on('change', function() {
      var val = $(this).val();
      var selector = $(this).parent().parent().next();
      if(val == "")
      {
        selector.hide();
      }
      else {
        if(val == 0)
        {
          selector.find('.heading').html('{{ __('Affiliate Percentage') }} *');
          selector.find('input').attr("placeholder", "{{ __('Enter Percentage') }}").next().html('%');
          selector.css('display','flex');
        }
        else if(val == 1){
          selector.find('.heading').html('{{ __('Affiliate Amount') }} *');
          selector.find('input').attr("placeholder", "{{ __('Enter Amount') }}").next().html('$');
          selector.css('display','flex');
        }
      }
    });
    
    


  
  </script>


<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection