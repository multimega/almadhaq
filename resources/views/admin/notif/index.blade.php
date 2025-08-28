@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('Notifications') }}">
					<div class="content-area">
                <div class="home-head mb-4 mb-md-5">
                    <h3>{{ __('Notifications') }} </h3>
                    <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                            <li class="breadcrumb-item">	<a href="{{ route('admin-notif-index') }}">{{ __('Notifications') }}</a></li>
                        </ol>
                    </nav>
                </div>
<!--						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Notifications') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
										
											<li>
												<a href="{{ route('admin-notif-index') }}">{{ __('Notifications') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
-->						<div class="product-area">
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
									                            </div></th>
									                        <th >{{ __('User') }}</th>
									                        <th>{{ __('Type') }}</th>
									                        <th>{{ __('For') }}</th>
									                        <th>{{ __('created at') }}</th>
									                        <th>{{ __('Read at') }}</th>
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
												</table>
										</div>
										
												<div class="row" style="margin-top: 31px;">
										<div class="col-lg-12" style="display:contents">
							
									
									<form  action="{{route('admin-noti-deleted')}}" method="post" enctype="multipart/form-data" id="mass_delete_form" style="margin-right: 5px;">
									     {{csrf_field()}}
									     <input type="hidden" id="selected_products_delete" name="selected_products_delete" value="">
										<input class="main-light-btn bg-danger" id="delete-selected" type="submit" value="{{ __("Delete Selected") }}">
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
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
											</div>
										</div>
										</div>
</div>

{{-- ADD / EDIT MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __('You are about to delete this Page.') }}</p>
            <p class="text-center">{{ __('Do you want to proceed?') }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}


@endsection    



@section('scripts')

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-notif-datatables') }}',
               columns: [
                        { data: 'checkbox', name: 'checkbox' },
                        { data: 'user_id', name: 'user_id' },
            			{ data: 'linked', searchable: false, orderable: false },
            			{ data: 'linked_id', searchable: false, orderable: false },
            			{ data: 'created_at', searchable: false, orderable: false },
            			{ data: 'read_at', searchable: false, orderable: false },
            			{ data: 'action', searchable: false, orderable: false }

                     ],
               language: {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();	
				}
            });

      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 text-right">'+
        	'<a class="add-btn" data-href="{{route('admin-notif-create')}}" id="add-data" data-bs-toggle="modal" data-bs-target="#modal1">'+
          '<i class="fas fa-plus"></i> {{ __('Add New Notifications') }}'+
          '</a>'+
          '</div>');
      });												
							
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