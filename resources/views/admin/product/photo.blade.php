

@extends('layouts.load')

@section('styles')

<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<style>
    .form-group{
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
</style>

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>

 
@endsection

@section('content')

<div class="content-area p-0">
	<div class="social-links-area p-0">
	    <div class="add-product-content">
    		<div class="row">
    			<div class="col-lg-12">
    				<div class="product-description">
    					<div class="body-area p-0">
							@include('includes.admin.form-error') 
							<form id="geniusformdata" action="{{route('admin-photo-updates',$data->id)}}" class="exp-form" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}

								<div class="row">
								  
    					                        <div class="col-lg-12">
                                                    <div class="form-group">
            			                                <label>{{ __('Feature Hover Image') }} *</label>
            			                                <div class="panel panel-body">
                                                    		<img class="span4 mobile text-center" src="{{asset('assets/images/products/'.$data->photo)}}" id="landscapes2" style="overflow: hidden; width: 100%; height: 400px; border: 1px dashed black;">
                                                        </div>
                                                        <input class="d-inline-block mybtn1 sm-btn mybtn1 mt-1 mb-2" type="file" onchange="document.getElementById('landscapes2').src = window.URL.createObjectURL(this.files[0])" id="hover_photo" name="photo" value="{{ $data->photo }}">
                                                        <span class='span-img-size'>{{ __('image size') }} 205px X 205px</span>
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
</div>

@endsection

@section('scripts')

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>

<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

<script type="text/javascript">

$('.cropme').simpleCropper();

$('#crop-image').on('click',function(){
$('.cropme').click();
});

$('.mobile').on('click',function(){
$('#feature_mobile_photo').click();
});


</script>

 <script type="text/javascript">
  $(document).ready(function() {

    let html = `<img src="{{ empty($data->photo) ? asset('assets/images/noimage.png') : filter_var($data->photo, FILTER_VALIDATE_URL) ? $data->photo : asset('assets/images/products/'.$data->photo) }}" alt="">`;
    $(".span4.cropme").html(html);  
    
    let htmls = `<img src="{{ empty($data->mobile_photo) ? asset('assets/images/noimage.png') : filter_var($data->mobile_photo, FILTER_VALIDATE_URL) ? $data->mobile_photo : asset('assets/images/products/'.$data->mobile_photo) }}" alt="">`;
    $(".mobile").html(htmls);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  });


  $('.ok').on('click', function () {

 setTimeout(
    function() {


  	var img = $('#feature_photo').val();
  
    
      $.ajax({
        url: "{{route('admin-prod-upload-update',$data->id)}}",
        type: "POST",
        data: {"image":img},
        success: function (data) {
          if (data.status) {
            $('#feature_photo').val(data.file_name);
          }
          if ((data.errors)) {
            for(var error in data.errors)
            {
              $.notify(data.errors[error], "danger");
            }
          }
        }
      });
   
    
     
        
   
      

    }, 1000); 
    




    });  
    
    $('.ok_mobile').on('click', function () {

 setTimeout(
    function() {


  
  	var imgg = $('#feature_mobile_photo').val();
   
        $.ajax({
        url: "{{route('admin-prod-upload-mobile-update',$data->id)}}",
        type: "POST",
        data: {"image":imgg},
        success: function (data) {
          if (data.status) {
            $('#feature_mobile_photo').val(data.file_name);
          }
          if ((data.errors)) {
            for(var error in data.errors)
            {
              $.notify(data.errors[error], "danger");
            }
          }
        }
      });
        
    
      

    }, 1000); 
    




    });

  </script>

<script type="text/javascript">

$('#is_discounts').on('change',function(){

if(this.checked)
{
	$(this).parent().parent().parent().parent().next().removeClass('showbox');
	$('#discount').prop('required',true);
	$('#discount_date').prop('required',true);
}

else {
	$(this).parent().parent().parent().parent().next().addClass('showbox');
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
