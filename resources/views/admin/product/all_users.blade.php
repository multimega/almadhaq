@extends('layouts.admin')

@section('styles')
<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>
<style>
    
    /*DSADSADASD*/



button:focus,
input:focus,
textarea:focus,
select:focus {
  outline: none; }

.tabs {
  display: block;
  display: -webkit-flex;
  display: -moz-flex;
  display: flex;
  -webkit-flex-wrap: wrap;
  -moz-flex-wrap: wrap;
  flex-wrap: wrap;
  margin: 0;
  overflow: hidden; }
  .tabs .label [class^="tab"] label ,
  .tabs .label [class*=" tab"] label  {
   
    cursor: pointer;
    display: block;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1em;
    padding: 2rem 0;
    text-align: center; }
  .tabs [class^="tab"] [type="radio"],
  .tabs [class*=" tab"] [type="radio"] {
    border-bottom: 1px solid rgba(239, 237, 239, 0.5);
    cursor: pointer;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: block;
    width: 100%;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out; }
    .tabs [class^="tab"] [type="radio"]:hover, .tabs [class^="tab"] [type="radio"]:focus,
    .tabs [class*=" tab"] [type="radio"]:hover,
    .tabs [class*=" tab"] [type="radio"]:focus {
      border-bottom: 1px solid #1F224F; }
    .tabs [class^="tab"] [type="radio"]:checked,
    .tabs [class*=" tab"] [type="radio"]:checked {
      border-bottom: 2px solid #1F224F; }
    .tabs [class^="tab"] [type="radio"]:checked + div,
    .tabs [class*=" tab"] [type="radio"]:checked + div {
      opacity: 1; }
    .tabs [class^="tab"] [type="radio"] + div,
    .tabs [class*=" tab"] [type="radio"] + div {
      display: block;
      opacity: 0;
      padding: 2rem 0;
      width: 90%;
      -webkit-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out; }
  .tabs .tab-2 {
    width: 50%; }
    .tabs .tab-2 [type="radio"] + div {
      width: 200%;
      margin-left: 200%; }
    .tabs .tab-2 [type="radio"]:checked + div {
      margin-left: 0; }
    .tabs .tab-2:last-child [type="radio"] + div {
      margin-left: 100%; }
    .tabs .tab-2:last-child [type="radio"]:checked + div {
      margin-left: -100%; }
      
</style>
@endsection


@section('content')

@php $sign = App\Models\Currency::where('is_default',1)->first(); @endphp

<div class="content-area">
    <div class="home-head mb-4">
        <h3>{{ __('Affiliate') }} <span>Manage your affiliate</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/products') }}">{{ __("Products") }}</a></li>
                <li class="breadcrumb-item">{{ __("Affiliate") }}</li>
            </ol>
        </nav>
    </div>
    @include('includes.admin.navs.products_nav')
	<div>
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
					<div class="body-area" style="background: #f2f3f8;padding: 0">
                        <div class="default-box">
	                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
							<form id="geniusform" action="{{route('admin-prod-aff-add-users')}}" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
							    @include('includes.admin.form-both')

                                <input type="hidden" name="id" value="{{$id}}">
								<div class="row">
									<div class="col-lg-12">
									    <h4 class="heading">{{ __("All Users") }} *</h4>
									</div>
				                    <div class="col-sm-12">
				                        <div class="form-group mb-3">
				                            <label class="form-label" for="search">Search</label>
                                            <input type="search" name="search" id="search" class="form-control" />
                                        </div>
                                        <div id='areaSearch'>
				                            @include('admin.product.search_users')
				                        </div>
				                    </div>
								</div>
    							<div class="row mt-3">
    								<div class="col-lg-12 text-center">
    									<button class="main-light-btn py-3" type="submit">{{ __('Submit') }} <i class="fas fa-check ms-3"></i></button>
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

$('#is_discounts').on('change',function(){

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

<script type="text/javascript">
   
    $(document).ready(function(){
       $('#search').on('change',function(){
          var searchKey = $('#search').val();
          var _token = "{{csrf_token()}}";
          
        $.ajax({
        url: "{{route('admin-prod-aff-users',['prod_id' => $id])}}",
        type:"GET",
        data:{
          searchKey:searchKey,
          _token: _token
        },
        success:function(response){
         
          if(response) {
              $('#areaSearch').html(response);
          }
        },
       });
       });
    });

</script>
@endsection


