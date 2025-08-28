@extends('layouts.admin') 


@section('content')  
<style>
.form-group{
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 14px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2D3274;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>

<input type="hidden" id="headerdata" value="{{ __("PRODUCT") }}">
<div class="content-area">
	<div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Products") }} <span> {{ __("Manage your products") }}</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item">{{ __("Products") }}</li>
            </ol>
        </nav>
    </div>
    @include('includes.admin.navs.products_nav')
	<div class="product-area">
		<div class="row">
			<div class="col-lg-12">
				<div class="mr-table allproduct default-box">
                    @include('includes.admin.form-success')  
                    <div class="default-box-body"> 
						<div class="table-responsiv">
							<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
								<thead>
									<tr>
				                        <th><div class="">
				                            <label class="container">{{ __("Check All") }}
				                            <input type="checkbox" name="checkall" id="checkall"> 
                                              <span class="checkmark"></span>
                                            </label>
				                            </div></th>
				                        <th>{{ __("Photo") }}</th>
				                        <th>{{ __("Name") }}</th>
				                        <th>{{ __("Type") }}</th>
				                        <th>{{ __("Stock") }}</th>
				                        <th>{{ __("Price") }}</th>
				                        <th>{{ __("Status") }}</th>
				                        <th>{{ __("Options") }}</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="row table-footer-btns mt-4">
							<div class="col-lg-12" style="display:contents">
								<form  action="{{route('admin-prod-all')}}" method="post" enctype="multipart/form-data" id="mass_deactivate_form"  style="margin-right: 5px;" >
								     {{csrf_field()}}
								     <input type="hidden" id="selected_products" name="selected_products" value="">
									<input class="main-light-btn bg-danger" id="deactivate-selected" type="submit" value="{{ __("deactivate Selected") }}">
								</form> 
								<form  action="{{route('admin-prod-activate')}}" method="post" enctype="multipart/form-data" id="mass_activate_form" style="margin-right: 5px;">
								     {{csrf_field()}}
								     <input type="hidden" id="selected_products_activate" name="selected_products_activate" value="">
									<input class="main-light-btn bg-primary" id="activate-selected" type="submit" value="{{ __("activate Selected") }}">
								</form>	
								<form  action="{{route('admin-prod-deleted')}}" method="post" enctype="multipart/form-data" id="mass_delete_form" style="margin-right: 5px;">
								     {{csrf_field()}}
								     <input type="hidden" id="selected_products_delete" name="selected_products_delete" value="">
									<input class="main-light-btn bg-danger" id="delete-selected" type="submit" value="{{ __("Delete Selected") }}">
								</form>
								<form  action="{{route('admin-pro-catalog')}}" method="post" enctype="multipart/form-data" id="mass_catalog_form" style="margin-right: 5px;">
								     {{csrf_field()}}
								     <input type="hidden" id="selected_products_catalog" name="selected_products_catalog" value="">
									<input class="main-light-btn bg-success" id="catalog-selected" type="submit" value="{{ __("Add Selected to Catalog") }}">
								</form>	
								<form  action="{{route('export-products')}}" method="post" style="margin-right: 5px;">
								     {{csrf_field()}}
								    <button class="main-light-btn">{{ __("Export All") }}</button>
								</form>
								<div class="" style="margin-right: 5px;">
								  <button  class="feature main-light-btn" id="feature-selected" data-bs-toggle="modal" data-bs-target="#modal3"> <i class="fas fa-star"></i>{{ __("Highlight") }} </button>     
								</div>
						    </div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- HIGHLIGHT MODAL --}}
<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modal3" aria-hidden="true">
    <div class="modal-dialog highlight" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="content-area p-0">
                	<div class="social-links-area p-0">
                	    <div class="add-product-content">
                    		<div class="row">
                    			<div class="col-lg-12">
                    				<div class="product-description">
                    					<div class="body-area p-0">
                							@include('includes.admin.form-error') 
                							<form id="geniusformdata" action="{{route('admin-pro-features')}}" class="exp-form" method="POST" enctype="multipart/form-data">
                								{{csrf_field()}}
                
                								<div class="row">
                									<div class="col-lg-12">
                									    <div class="form-group d-flex align-items-center justify-content-between">
                										    <h6>{{ __("Highlight in") }} {{ $langg->lang26 }} *</h6>
                										    <label class="switch">
                					                            <input type="checkbox" name="featured" value="1">
                					                            <span class="slider round"></span>
                						                    </label>
                										</div>
                									</div>
                									<div class="col-lg-12">
                									    <div class="form-group d-flex align-items-center justify-content-between">
                										    <h6>{{ __("Highlight in") }} {{ $langg->lang27 }} *</h6>
                										    <label class="switch">
                					                            <input type="checkbox" name="best" value="1">
                					                        <span class="slider round"></span>
                						                    </label>
                										</div>
                									</div>
                									<div class="col-lg-12">
                									    <div class="form-group d-flex align-items-center justify-content-between">
                										    <h6>{{ __("Highlight in") }} {{ $langg->lang28 }} *</h6>
                										    <label class="switch">
                					                            <input type="checkbox" name="top" value="1">
                					                        <span class="slider round"></span>
                						                    </label>
                										</div>
                									</div>
                									<div class="col-lg-12">
                									    <div class="form-group d-flex align-items-center justify-content-between">
                										    <h6>{{ __("Highlight in") }} {{ $langg->lang29 }} *</h6>
                										    <label class="switch">
                					                            <input type="checkbox" name="big" value="1">
                					                        <span class="slider round"></span>
                						                    </label>
                										</div>
                									</div>
                									<div class="col-lg-12">
                									    <div class="form-group d-flex align-items-center justify-content-between">
                										    <h6>{{ __("Highlight in") }} {{ $langg->lang30 }} *</h6>
                										    <label class="switch">
                					                            <input type="checkbox" name="hot" value="1">
                					                        <span class="slider round"></span>
                						                    </label>
                										</div>
                									</div>
                									<div class="col-lg-12">
                									    <div class="form-group d-flex align-items-center justify-content-between">
                										    <h6>{{ __("Highlight in") }} {{ $langg->lang31 }} *</h6>
                										    <label class="switch">
                					                            <input type="checkbox" name="latest" value="1">
                					                        <span class="slider round"></span>
                						                    </label>
                										</div>
                									</div>
                									<div class="col-lg-12">
                									    <div class="form-group d-flex align-items-center justify-content-between">
                										    <h6>{{ __("Highlight in") }} {{ $langg->lang32 }} *</h6>
                										    <label class="switch">
                					                            <input type="checkbox" name="trending" value="1">
                					                        <span class="slider round"></span>
                						                    </label>
                										</div>
                									</div>
                									<div class="col-lg-12">
                									    <div class="form-group d-flex align-items-center justify-content-between">
                										    <h6>{{ __("Highlight in") }} {{ $langg->lang33 }} *</h6>
                										    <label class="switch">
                					                            <input type="checkbox" name="sale" value="1">
                					                        <span class="slider round"></span>
                						                    </label>
                										</div>
                									</div>
                									<div class="col-lg-12">
                									    <div class="form-group d-flex align-items-center justify-content-between">
                										    <h6>{{ __("Highlight in") }} {{ $langg->lang244 }} *</h6>
                										    <label class="switch">
                					                            <input type="checkbox" name="is_discount" id="is_discount" value="1">
                					                        <span class="slider round"></span>
                						                    </label>
                										</div>
                									</div>
                								</div>
                								<div class="showbox">
                									<div class="row">
                										<div class="col-lg-12">
                    									    <div class="form-group">
                    									        <label>{{ __("Discount Date") }} *</label>
                    									        <input type="date" class="form-control" name="discount_date"  placeholder="{{ __("Enter Date") }}" id="discount_date">
                    									    </div>
                										</div>
                									</div>
                								</div>
                								<div class="row">
                								    <input type="hidden" id="selected_products_feature" name="selected_products_feature" value="">
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
    	    </div>
        	<div class="modal-footer">
        	    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __("Close") }}</button>
        	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2" aria-hidden="true">
    <div class="modal-dialog highlight" role="document">
        <div class="modal-content">
            <div class="submit-loader">
                <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
            </div>
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __("Close") }}</button>
            </div>
        </div>
    </div>
</div>

{{-- HIGHLIGHT ENDS --}}

{{-- CATALOG MODAL --}}

<div class="modal fade" id="catalog-modal" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header">
		<h4 class="modal-title d-inline-block">{{ __("Update Status") }}</h4>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>


      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __("You are about to change the status of this Product.") }}</p>
            <p class="text-center mb-0">{{ __("Do you want to proceed?") }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __("Cancel") }}</button>
            <a class="btn btn-success btn-ok">{{ __("Proceed") }}</a>
      </div>

    </div>
  </div>
</div>

{{-- CATALOG MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header">
		<h4 class="modal-title d-inline-block">{{ __("Confirm Delete") }}</h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __("You are about to delete this Product.") }}</p>
            <p class="text-center mb-0">{{ __("Do you want to proceed?") }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __("Cancel") }}</button>
            <a class="btn btn-danger btn-ok">{{ __("Delete") }}</a>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}


{{-- GALLERY MODAL --}}

<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">{{ __("Image Gallery") }}</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
    			<div class="top-area">
    				<div class="row">
					    <div class="col-sm-12 text-center mb-3">( <small>{{ __("You can upload multiple Images") }}.</small> )</div>
    					<div class="col-md-10 col-8">
							<form  method="POST" enctype="multipart/form-data" id="form-gallery">
								{{ csrf_field() }}
    							<input type="hidden" id="pid" name="product_id" value="">
    							<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
    						    <label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
						    </form>
						</div>
    					<div class="col-md-2 col-4">
    						<a href="javascript:;" class="upload-done-btn main-bg-dark text-white" data-bs-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
    					</div>
    				</div>
    			</div>
    			<div class="gallery-images mt-3">
    				<div class="selected-image">
    					<div class="row"></div>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
</div>


{{-- GALLERY MODAL ENDS --}}

@endsection    



@section('scripts')


{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
		        
		        
			   ordering: false,
               processing: true,
               serverSide: true,
                buttons: ['copy','csv','excel','pdf','print'],
               ajax: '{{ route('admin-prod-datatables') }}',
               columns: [
                        { data: 'checkbox', name: 'checkbox' },
                        { data: 'thumbnail', name: 'thumbnail' },
                        { data: 'name', name: 'name' },
                        { data: 'type', name: 'type' },
                        { data: 'stock', name: 'stock' },
                        { data: 'price', name: 'price' },
                        { data: 'status', searchable: false, orderable: false},
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();	
				}
            });

      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="main-dark-btn" href="{{route('admin-prod-types')}}">'+
          '<i class="fas fa-plus"></i> <span class="remove-mobile">{{ __("Add New Product") }}<span>'+
          '</a>'+
          '</div>');
      });											
									


{{-- DATA TABLE ENDS--}}


</script>


<script type="text/javascript">
	

// Gallery Section Update

    $(document).on("click", ".set-gallery" , function(){
        var pid = $(this).find('input[type=hidden]').val();
        $('#pid').val(pid);
        $('.selected-image .row').html('');
            $.ajax({
                    type: "GET",
                    url:"{{ route('admin-gallery-show') }}",
                    data:{id:pid},
                    success:function(data){
                      if(data[0] == 0)
                      {
	                    $('.selected-image .row').addClass('justify-content-center');
	      				$('.selected-image .row').html('<h3>{{ __("No Images Found.") }}</h3>');
     				  }
                      else {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();      
                          var arr = $.map(data[1], function(el) {
                          return el });

                          for(var k in arr)
                          {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
                          }                         
                       }
 
                    }
                  });
      });


  $(document).on('click', '.remove-img' ,function() {
    var id = $(this).find('input[type=hidden]').val();
    $(this).parent().parent().remove();
	    $.ajax({
	        type: "GET",
	        url:"{{ route('admin-gallery-delete') }}",
	        data:{id:id}
	    });
  });

  $(document).on('click', '#prod_gallery' ,function() {
    $('#uploadgallery').click();
  });
                                        
                                
  $("#uploadgallery").change(function(){
    $("#form-gallery").submit();  
  });

  $(document).on('submit', '#form-gallery' ,function() {
		  $.ajax({
		   url:"{{ route('admin-gallery-store') }}",
		   method:"POST",
		   data:new FormData(this),
		   dataType:'JSON',
		   contentType: false,
		   cache: false,
		   processData: false,
		   success:function(data)
		   {
		    if(data != 0)
		    {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();   
		        var arr = $.map(data, function(el) {
		        return el });
		        for(var k in arr)
		           {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
		            }          
		    }
		                     
		                       }

		  });
		  return false;
 }); 


// Gallery Section Update Ends	


</script>





<script type="text/javascript">

$("#checkall").change(function() {
    if(this.checked) {
     
          $(".all").prop('checked',true);
      
    }
    else
    {
       $(".all").prop('checked',false);
      
    }
});

$(".all").change(function() {
  
       $("#checkall").prop('checked',false);
      
    
});


      $(document).on('click', '#deactivate-selected', function(e){
                e.preventDefault();
                var selected_rows = getSelectedRows();
                
                if(selected_rows.length > 0){
                    $('input#selected_products').val(selected_rows);
                
                    
                    var form = $('form#mass_deactivate_form')
                                 form.submit() 
                            var data = form.serialize();
                                $.ajax({
                                    method: form.attr('method'),
                                    url: form.attr('action'),
                                    dataType: 'json',
                                    data: data,
                                    success: function(result) {
                                        if (result.success == true) {
                                            toastr.success(result.msg);
                                            product_table.ajax.reload();
                                            form
                                            .find('#selected_products')
                                            .val('');
                                        } else {
                                            toastr.error(result.msg);
                                        }
                                    },
                                });
                        
                    
                } else{
                    $('input#selected_products').val('');
                   
                }    
        
      }); 
          
            $(document).on('click', '#activate-selected', function(e){
                e.preventDefault();
                var selected_rows = getSelectedRows();
                
                if(selected_rows.length > 0){
                    $('input#selected_products_activate').val(selected_rows);
                
                    
                    var form = $('form#mass_activate_form')
                                 form.submit() 
                            var data = form.serialize();
                                $.ajax({
                                    method: form.attr('method'),
                                    url: form.attr('action'),
                                    dataType: 'json',
                                    data: data,
                                    success: function(result) {
                                        if (result.success == true) {
                                            toastr.success(result.msg);
                                            product_table.ajax.reload();
                                            form
                                            .find('#selected_products_activate')
                                            .val('');
                                        } else {
                                            toastr.error(result.msg);
                                        }
                                    },
                                });
                        
                    
                } else{
                    $('input#selected_products_activate').val('');
                   
                }    
        
      }); 
       $(document).on('click', '#delete-selected', function(e){
                e.preventDefault();
                var selected_rows = getSelectedRows();
                
                if(selected_rows.length > 0){
                    $('input#selected_products_delete').val(selected_rows);
                
                    
                    var form = $('form#mass_delete_form')
                                 form.submit() 
                            var data = form.serialize();
                                $.ajax({
                                    method: form.attr('method'),
                                    url: form.attr('action'),
                                    dataType: 'json',
                                    data: data,
                                    success: function(result) {
                                        if (result.success == true) {
                                            toastr.success(result.msg);
                                            product_table.ajax.reload();
                                            form
                                            .find('#selected_products_delete')
                                            .val('');
                                        } else {
                                            toastr.error(result.msg);
                                        }
                                    },
                                });
                        
                    
                } else{
                    $('input#selected_products_delete').val('');
                   
                }    
        
      });     
      $(document).on('click', '#catalog-selected', function(e){
                e.preventDefault();
                var selected_rows = getSelectedRows();
                
                if(selected_rows.length > 0){
                    $('input#selected_products_catalog').val(selected_rows);
                
                    
                    var form = $('form#mass_catalog_form')
                                 form.submit() 
                            var data = form.serialize();
                                $.ajax({
                                    method: form.attr('method'),
                                    url: form.attr('action'),
                                    dataType: 'json',
                                    data: data,
                                    success: function(result) {
                                        if (result.success == true) {
                                            toastr.success(result.msg);
                                            product_table.ajax.reload();
                                            form
                                            .find('#selected_products_catalog')
                                            .val('');
                                        } else {
                                            toastr.error(result.msg);
                                        }
                                    },
                                });
                        
                    
                } else{
                    $('input#selected_products_catalog').val('');
                   
                }    
        
      });   
      
      $(document).on('click', '#feature-selected', function(e){
                e.preventDefault();
                var selected_rows = getSelectedRows();
                
                if(selected_rows.length > 0){
                    $('input#selected_products_feature').val(selected_rows);
                
              
                        
                    
                } else{
                    $('input#selected_products_catalog').val('');
                    $('#modal3').modal('hide');
                   
                }    
        
      }); 
      
         function getSelectedRows() {
            var selected_rows = [];
            var i = 0;
            $('.row-select:checked').each(function () {
                selected_rows[i++] = $(this).val();
            });

            return selected_rows; 
        }  
            
            
</script>

<script type="text/javascript">

$('#is_discount').on('change',function(){

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

//     var dateToday = new Date();
//     var dates =  $( "#discount_date" ).datepicker({
//         changeMonth: true,
//         changeYear: true,
//         minDate: dateToday,
// });

</script>
@endsection   