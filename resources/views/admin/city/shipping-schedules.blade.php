@extends('layouts.admin') 
@section('styles')
<style>
.toast-error {
    background-color: #f2dede !important;
    color: #a94442 !important;
}

</style>
@endsection
@section('content')  
<input type="hidden" id="headerdata" value="{{ __('Shipping Schedules') }} - {{ $city->name }}">
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Shipping Schedules') }} - {{ $city->name }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-city-index') }}">{{ __('Cities') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin-city-shipping-schedules', $city->id) }}">{{ __('Shipping Schedules') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="product-area">
        
        <div class="row">
            <div class="col-lg-12">
                
                <div class="btn-area mb-3">
                    <!--<div class="row">-->
                    <!--    <div class="col-sm-6">-->
                    <!--        <a class="add-btn btn btn-primary" data-href="{{route('admin-city-shipping-schedules-create', $city->id)}}" id="add-data" data-bs-toggle="modal" data-bs-target="#modal1">-->
                    <!--            <i class="fas fa-plus"></i> {{ __('Add New Schedule') }}-->
                    <!--        </a>-->
                    <!--    </div>-->
                       
                    <!--</div>-->
                </div>
                        
                <div class="mr-table allproduct">
                    @include('includes.admin.form-success')

                    <div class="table-responsiv">
                        <table id="schedulesTable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ __('Day') }}</th>
                                    <th>{{ __('Time Range') }}</th>
                                    <th>{{ __('Capacity') }}</th>
                                    <th>{{ __('Today Orders') }}</th>
                                    <th>{{ __('Next Available') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                @php
                                    $todayCapacity = $schedule->getDateCapacity(now());
                                    $nextAvailable = $schedule->getNextAvailableDate();
                                @endphp
                                <tr>
                                    <td>{{ ucfirst($schedule->day_of_week) }}</td>
                                    <td>{{ $schedule->time_range }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $schedule->capacity }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $todayCapacity->current_orders >= $schedule->capacity ? 'danger' : 'success' }}">
                                            {{ $todayCapacity->current_orders }} / {{ $schedule->capacity }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($nextAvailable)
                                            <small class="text-muted">
                                                {{ $nextAvailable->format('M j') }}
                                                <br>
                                                <span class="badge bg-info">
                                                    {{ $schedule->getRemainingCapacityForDate($nextAvailable) }} {{ __('available') }}
                                                </span>
                                            </small>
                                        @else
                                            <span class="badge bg-warning">{{ __('No capacity') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $schedule->is_active ? 'success' : 'secondary' }}">
                                            {{ $schedule->is_active ? __('Active') : __('Inactive') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-list">
                                            <a data-href="{{ route('admin-city-shipping-schedules-edit', $schedule->id) }}" 
                                               class="edit" data-bs-toggle="modal" data-bs-target="#modal1">
                                                <i class="fas fa-edit"></i>{{ __('Edit') }}
                                            </a>
                    
                                            <a href="javascript:;" 
                                               data-href="{{ route('admin-city-shipping-schedules-delete', $schedule->id) }}" 
                                               data-bs-toggle="modal" data-bs-target="#confirm-delete" 
                                               class="delete">
                                                <i class="fas fa-trash-alt"></i>{{ __('Delete') }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
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
            <!--<div class="submit-loader">-->
            <!--    <img src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">-->
            <!--</div>-->
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Confirm Delete') }}</h4>
                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">{{ __('You are about to delete this shipping schedule.') }}</p>
                <p class="text-center text-warning">
                    <strong>{{ __('Warning:') }}</strong> {{ __('This will also delete all associated capacity records and may affect existing orders.') }}
                </p>
                <p class="text-center">{{ __('Do you want to proceed?') }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger btn-delete-ok">{{ __('Delete') }}</a>
            </div>
        </div>
    </div>
</div>

@endsection    

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        '<a class="add-btn" data-href="{{route('admin-city-shipping-schedules-create', $city->id)}}" id="add-data" data-bs-toggle="modal" data-bs-target="#modal1">'+
        '<i class="fas fa-plus"></i> {{ __('Add New Schedule') }}'+
        '</a>'+
        '</div>');
        
    var table = $('#schedulesTable').DataTable({
        ordering: true,
        order: [[0, 'asc'], [1, 'asc']],
        language: {
            processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
        }
    });

    // Handle modal loading for Add/Edit
    $(document).on('click', '#add-data, .edit', function(e) {
        e.preventDefault();
        var url = $(this).data('href');
        
        $('.submit-loader').show();
        $('.modal-body').empty();
        $('.modal-title').empty();
        
        $.get(url, function(data) {
            $('.modal-body').html(data);
            $('.submit-loader').hide();
        }).fail(function() {
            $('.modal-body').html('<div class="alert alert-danger">Error loading form</div>');
            $('.submit-loader').hide();
        });
    });

    // Handle form submission with AJAX
    $(document).on('submit', '#modal1 form', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var formData = new FormData(this);
        var url = form.attr('action');
        var method = form.attr('method') || 'POST';
        
        $('.submit-loader').show();
        
        // Clear previous errors
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');
        
        $.ajax({
            url: url,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.submit-loader').hide();
                
                if (response.success) {
                    $('#modal1').modal('hide');
                    
                    // Show success message
                    toastr.success(response.message);
                    
                    // Reload the table
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    // Handle validation errors
                    if (response.errors) {
                        $.each(response.errors, function(field, messages) {
                            var input = form.find('[name="' + field + '"]');
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                        });
                    } else if (response.message) {
                        toastr.error(response.message);
                    }
                }
            },
            error: function(xhr) {
                $('.submit-loader').hide();
                
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors || {};
                    $.each(errors, function(field, messages) {
                        var input = form.find('[name="' + field + '"]');
                        input.addClass('is-invalid');
                        input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                    });
                } else {
                    toastr.error('An error occurred. Please try again.');
                }
            }
        });
    });

    // Handle delete confirmation
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var url = $(this).data('href');
        $('.btn-delete-ok').attr('href', url);
    });

    // Handle delete action
    $(document).on('click', '.btn-delete-ok', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#confirm-delete').modal('hide');
                
                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                $('#confirm-delete').modal('hide');
                toastr.error('An error occurred. Please try again.');
            }
        });
    });

    // Initialize toastr if not already done
    if (typeof toastr !== 'undefined') {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
    }
});
</script>
@endsection