@extends('layouts.admin') 

@section('content')  
<div class="content-area">
    <div class="home-head mb-4">
        <h3>{{ __('Disputes') }} <span>Manage your disputes</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.support-manager') }}">{{ __('Support Manager') }}</a></li>
                <li class="breadcrumb-item">{{ __("Disputes") }}</li>
            </ol>
        </nav>
    </div>
    <div class="product-area">
      <div class="row">
        <div class="col-lg-12">
          <div class="mr-table allproduct default-box">
            @include('includes.admin.form-success')
            <div class="table-responsiv">
                <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>{{ __('Name') }}</th>
                      <th>{{ __('Subject') }}</th>
                      <th>{{ __('Order Number') }}</th>
                      <th>{{ __('Date') }}</th>
                      <th>{{ __('Actions') }}</th>
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
                <h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">{{ __('You are about to delete this Dispute. Every messages under this dispute will be deleted.') }}</p>
                <p class="text-center mb-0">{{ __('Do you want to proceed?') }}</p>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger">{{ __('Delete') }}</a>
            </div>
        </div>
    </div>
</div>

{{-- DELETE MODAL ENDS --}}


{{-- MESSAGE MODAL --}}
<div class="sub-categori">
    <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorformLabel">{{ __('Add Dispute') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-form">
                                    <form id="emailreply1" class="exp-form">
                                        {{csrf_field()}}
                                        <input type="email" class="form-control eml-val mb-3" id="eml1" name="to" placeholder="{{ __('Email') }} *" value="" required="">
                                        <input type="text" class="form-control mb-3" id="order" name="order_number" placeholder="{{ __('Order Numebr') }} *" value="" required="">
                                        <input type="text" class="form-control mb-3" id="subj1" name="subject" placeholder="{{ __('Subject') }} *" required="">
                                        <textarea class="form-control textarea mb-3" name="message" id="msg1" placeholder="{{ __('Your Message') }} *" required=""></textarea>
                                        <input type="hidden" name="type" value="Dispute">
                                        <button class="submit-btn" id="emlsub1" type="submit">{{ __('Send Message') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MESSAGE MODAL ENDS --}}

@endsection    



@section('scripts')

    <script type="text/javascript">

    var table = $('#geniustable').DataTable({
         ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-message-datatables','Dispute') }}',
               columns: [
                  { data: 'name', name: 'name' },
                  { data: 'subject', name: 'subject' },
                  { data: 'order_number', name: 'order_number' },
                  { data: 'created_at', name: 'created_at'},
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
        $(".btn-area").append('<div class="col-sm-4 text-end">'+
          '<a class="main-dark-btn" href="javascript:;" data-bs-toggle="modal" data-bs-target="#vendorform"><i class="fas fa-envelope"></i> {{ __('Add Dispute') }}</a>'+'</div>');
      });                       
      

    </script>


@endsection   