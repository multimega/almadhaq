@extends('layouts.admin')

@section('content')
<style>
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
					<input type="hidden" id="headerdata" value="{{ __("SUB CATEGORY") }}">
<input type="hidden" id="attribute_data" value="{{ __('ADD NEW ATTRIBUTE') }}">
					<div class="content-area">
					    <div class="home-head mb-4 mb-md-5">
                            <h3>{{ __("Sub Categories") }} <span>{{ __("Manage your sub categories") }}</span></h3>
                            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                                    <li class="breadcrumb-item">{{ __("Sub Categories") }}</li>
                                </ol>
                            </nav>
                        </div>
					    @include('includes.admin.navs.categories_nav')
						<!--<div class="mr-breadcrumb">-->
						<!--	<div class="row">-->
						<!--		<div class="col-lg-12">-->
						<!--				<h4 class="heading">{{ __("Sub Categories") }}</h4>-->
						<!--				<ul class="links">-->
						<!--					<li>-->
						<!--						<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>-->
						<!--					</li>-->
						<!--					<li><a href="javascript:;">{{ __("Manage Categories") }}</a></li>-->
						<!--					<li>-->
						<!--						<a href="{{ route('admin-subcat-index') }}">{{ __("Sub Categories") }}</a>-->
						<!--					</li>-->
						<!--				</ul>-->
						<!--		</div>-->
						<!--	</div>-->
						<!--</div>-->
						  @if (Session::has('error'))
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems.<br><br>
                                <ul>
                                   
                                        <li>{{ Session::get('error') }}</li>
                                   
                                </ul>
                            </div>
                        @endif
                         @if ($message = Session::get('success'))
                            <div class="alert alert-success " align="center">
                                <button type="button" class="close" data-bs-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct default-box">

                                        @include('includes.admin.form-success')

										<div class="table-responsiv">
											<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
													     <th  width="2%"><div class="">
								                            <label class="container">{{ __("Check All") }}
								                            <input type="checkbox" name="checkall" id="checkall"> 
								                            

                                                              <span class="checkmark"></span>
                                                            </label>
								                            </div>
							                            </th>
														<th>{{ __("Category") }}</th>
                    			                        <th>{{ __("Name") }}</th>
                    			                        <th>{{ __("Slug") }}</th>
                    															<th>{{ __('Attributes') }}</th>
                    			                        <th>{{ __("Status") }}</th>
                    			                        <th>{{ __("Options") }}</th>
													</tr>
												</thead>
											</table>
										</div>
										<div class="row table-footer-btns mt-4">
    										<div class="col-lg-12" style="display:contents">
    										    
            									<form  action="{{route('admin-subcat-all')}}" method="post" enctype="multipart/form-data" id="mass_deactivate_form"  style="margin-right: 5px;" >
            									     {{csrf_field()}}
            									     <input type="hidden" id="selected_products" name="selected_products" value="">
            										<input class="btn btn-xs btn-danger" id="deactivate-selected" type="submit" value="{{ __("deactivate Selected") }}">
            									</form>	   
            										    
            									<form  action="{{route('admin-subcat-activate')}}" method="post" enctype="multipart/form-data" id="mass_activate_form" style="margin-right: 5px;">
            									     {{csrf_field()}}
            									     <input type="hidden" id="selected_products_activate" name="selected_products_activate" value="">
            										<input class="btn btn-xs btn-primary" id="activate-selected" type="submit" value="{{ __("activate Selected") }}">
            									</form>	
            									
            									<form  action="{{route('admin-subcat-deleted')}}" method="post" enctype="multipart/form-data" id="mass_delete_form" style="margin-right: 5px;">
            									     {{csrf_field()}}
            									     <input type="hidden" id="selected_products_delete" name="selected_products_delete" value="">
            										<input class="btn btn-xs btn-danger" id="delete-selected" type="submit" value="{{ __("Delete Selected") }}">
            									</form>
            								</div>
        								</div>
									</div>
								</div>
							</div>
						</div>
					</div>

{{-- ADD / EDIT MODAL --}}

										<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">

										<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __("Close") }}</button>
											</div>
										</div>
										</div>
</div>

{{-- ADD / EDIT MODAL ENDS --}}

{{-- ATTRIBUTE MODAL --}}

										<div class="modal fade" id="attribute" tabindex="-1" role="dialog" aria-labelledby="attribute" aria-hidden="true">

										<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('Close') }}</button>
											</div>
										</div>
										</div>
</div>

{{-- ATTRIBUTE MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header">
		<h4 class="modal-title d-inline-block">{{ __("Confirm Delete") }}</h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __("You are about to delete this Category. Everything under this category will be deleted.") }}</p>
            <p class="text-center">{{ __("Do you want to proceed?") }}</p>
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

@endsection


@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
		     
                
			   ordering: false,
               processing: true,
               serverSide: true,
               
               ajax: '{{ route('admin-subcat-datatables') }}',
                
               columns: [
                      { data: 'checkbox', name: 'checkbox' },
               			{ data: 'category', searchable: false, orderable: false},
                        { data: 'name', name: 'name' },
                        { data: 'slug', name: 'slug' },
                        { data: 'attributes', name: 'attributes', searchable: false, orderable: false },
                        { data: 'status', searchable: false, orderable: false},
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                  
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
                buttons: [
        {
            extend: 'excel',
            text: '<span class="fa fa-file-excel-o"></span> Excel Export',
            exportOptions: {
                modifier: {
                    search: 'applied',
                    order: 'applied'
                }
            }
        }
    ],
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();
				}
            });

      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="main-dark-btn" data-href="{{route('admin-subcat-create')}}" id="add-data" data-bs-toggle="modal" data-bs-target="#modal1">'+
          '<i class="fas fa-plus"></i> {{{ __("Add New Sub Category") }}}'+
          '</a>'+
          '</div>');
      });

{{-- DATA TABLE ENDS--}}

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

      

         function getSelectedRows() {
            var selected_rows = [];
            var i = 0;
            $('.row-select:checked').each(function () {
                selected_rows[i++] = $(this).val();
            });

            return selected_rows; 
        }  
            
            
</script>
@endsection
