@extends('layouts.admin') 

@section('content')  
<input type="hidden" id="headerdata" value="{{ __('ROLE') }}">
<div class="content-area">
    <div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Roles") }}</h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/main-settings') }}">{{ __("Main Settings") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/general-settings') }}">{{ __("General Settings") }}</a></li>
                <li class="breadcrumb-item">{{ __("Manage Roles") }}</li>
            </ol>
        </nav>
    </div>
    <div class="product-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="mr-table allproduct default-box">
                    @include('includes.admin.form-success')  
                    <div class="table-responsive">
                        <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th width="50%">{{ __('Permissions') }}</th>
                                    <th>{{ __('Options') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

  <div class="modal-header">
    <h4 class="modal-title">{{ __("Confirm Delete") }}</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
      </button>
  </div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __('You are about to delete this Role.') }}</p>
            <p class="text-center">{{ __('Do you want to proceed?') }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
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
               ajax: '{{ route('admin-role-datatables') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'section', name: 'section' },
                        { data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                  processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

        $(function() {
        $(".btn-area").append('<div class="col-sm-4 text-end">'+
          '<a class="main-dark-btn" href="{{route('admin-role-create')}}">'+
          '<i class="fas fa-plus"></i> {{ __("Add New Role") }}'+
          '</a>'+
          '</div>');
      });                     
                  
{{-- DATA TABLE ENDS--}}

</script>

@endsection   