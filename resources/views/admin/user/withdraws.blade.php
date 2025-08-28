@extends('layouts.admin')

@section('content')
<input type="hidden" id="headerdata" value="{{ __("WITHDRAW") }}">
<div class="content-area">
    <div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Withdraws") }} <span>{{ __("Manage your withdraws") }}</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item">{{ __("Withdraws") }}</li>
            </ol>
        </nav>
    </div>
    @include('includes/admin/navs/customers_nav')
    <div class="product-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="mr-table allproduct default-box">
                    @include('includes.admin.form-success')
                    <div class="table-responsiv">
                        <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ __("Email") }}</th>
                                    <th>{{ __("Phone") }}</th>
                                    <th>{{ __("Amount") }}</th>
                                    <th>{{ __("Method") }}</th>
                                    <th>{{ __("Withdraw Date") }}</th>
                                    <th>{{ __("Status") }}</th>
                                    <th>{{ __("Actions") }}</th>
                                </tr>
                            </thead>
                        </table>
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
                <img src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
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

{{-- ADD / EDIT MODAL ENDS --}}

{{-- ACCEPT MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __("Accept Withdraw") }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">{{ __("You are about to accept this Withdraw.") }}</p>
                <p class="text-center mb-0">{{ __("Do you want to proceed?") }}</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __("Cancel") }}</button>
                <a class="btn btn-success">{{ __("Accept") }}</a>
            </div>

        </div>
    </div>
</div>

{{-- ACCEPT MODAL ENDS --}}


{{-- REJECT MODAL --}}

<div class="modal fade" id="confirm-delete1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __("Reject Withdraw") }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">{{ __("You are about to reject this Withdraw.") }}</p>
                <p class="text-center mb-0">{{ __("Do you want to proceed?") }}</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __("Cancel") }}</button>
                <a class="btn btn-danger">{{ __("Reject") }}</a>
            </div>

        </div>
    </div>
</div>

{{-- REJECT MODAL ENDS --}}

@endsection

@section('scripts')

{{-- DATA TABLE --}}

<script type="text/javascript">
    var table = $('#geniustable').DataTable({
        ordering: false,
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin-withdraw-datatables') }}',
        columns: [{
                data: 'email',
                name: 'email'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'amount',
                name: 'amount'
            },
            {
                data: 'method',
                name: 'method'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                searchable: false,
                orderable: false
            }
        ],
        language: {
            processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
        }
    });

    $('#confirm-delete1').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

{{-- DATA TABLE --}}

@endsection