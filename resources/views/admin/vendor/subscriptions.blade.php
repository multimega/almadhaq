@extends('layouts.admin') 

@section('content')  
                    <input type="hidden" id="headerdata" value="{{ __("SUBSCRIPTIONS") }}">
                    <div class="content-area">
                        <div class="home-head mb-4 mb-md-5">
                            <h3>{{ __("Vendor Subscriptions") }} </h3>
                            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin-vendor-index') }}">{{ __("Vendors") }}</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin-vendor-subs') }}">{{ __("Vendor Subscriptions") }}</a></li>
                                </ol>
                            </nav>
                        </div>
                        @include('includes/admin/navs/vendors_nav')
                        <div class="product-area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mr-table allproduct default-box">
                                        @include('includes.admin.form-success') 
                                        <div class="table-responsiv">
                                                <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __("Vendor Name") }}</th>
                                                            <th>{{ __("Plan") }}</th>
                                                            <th>{{ __("Method") }}</th>
                                                            <th>{{ __("Transcation ID") }}</th>
                                                            <th>{{ __("Purchase Time") }}</th>
                                                            <th>{{ __("Options") }}</th>
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
                                <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
                            </div>
                            <div class="modal-header">
                                <h5 class="modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
                            </div>
                        </div>
                    </div>

                </div>

{{-- ADD / EDIT MODAL ENDS --}}

@endsection    

@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">

        var table = $('#geniustable').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-vendor-subs-datatables') }}',
               columns: [
                        { data: 'name', searchable: false, orderable: false },
                        { data: 'title', name: 'title' },
                        { data: 'method', name: 'method' },
                        { data: 'txnid', name: 'txnid' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'action', searchable: false, orderable: false }
                     ],
               language : {
                    processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });
                           
    </script>

{{-- DATA TABLE --}}
    
@endsection   