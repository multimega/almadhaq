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
    <div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Affiliate Categories") }} <span>{{ __("Manage your affiliate categories") }}</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin-import-affiliate-index') }}">{{ __("All Affiliate Categories") }}</a></li>
                <li class="breadcrumb-item">{{ __("Add Affiliate Category") }}</li>
            </ol>
        </nav>
    </div>
	<div class="add-product-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
				    <div class="body-area" style="background: #f2f3f8;padding: 0">
                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        <form id="geniusform" action="{{route('admin-affiliate-settings-store')}}" method="POST" class="exp-form" enctype="multipart/form-data">
                            {{csrf_field()}}
        					@include('includes.admin.form-both')
    					    <div class="default-box">
    						    <div class="row">
        							<div class="col-lg-12">
        								<div class="form-group">
        								    <label>{{ __('Affiliate Category Name') }}* <small>{{ __('(In Any Language)') }}</small></label>
        								    <input type="text" class="form-control" placeholder="{{ __('Enter Affiliate Name') }}" name="affiliate_name" required="">
        								</div>
        							</div>
        							<div class="col-lg-12">
        								<div class="form-group">
        								    <label>{{ __('Type') }}*</label>
        								    <select id="type" name="type" class="form-control" required="">
                                                <option value="">{{ __('Choose a type') }}</option>
                                                <option value="0">{{ __('Percentage') }}</option>
                                                <option value="1">{{ __('Amount') }}</option>
                                            </select>
        								</div>
        							</div>
            					    <div class="row hidden m-0">
                                        <div class="col-lg-12 p-0">
                                            <div class="form-group">
                                                <label></label>
                                                <input type="text" class="form-control less-width" name="amount" placeholder="" required="" value="">
                                            </div>
                                        </div>
                                    </div>
        						</div>
    						</div>
    						<div class="row">
								<div class="col-lg-12 text-center">
									<button class="main-light-btn py-3" type="submit">{{ __('Create Affiliate') }} <i class="fas fa-check ms-3"></i></button>
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
          selector.find('label').html('{{ __('Affiliate Percentage') }} *');
          selector.find('input').attr("placeholder", "{{ __('Enter Percentage') }}").next().html('%');
          selector.css('display','flex');
        }
        else if(val == 1){
          selector.find('label').html('{{ __('Affiliate Amount') }} *');
          selector.find('input').attr("placeholder", "{{ __('Enter Amount') }}").next().html('$');
          selector.css('display','flex');
        }
      }
});
</script>

<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection