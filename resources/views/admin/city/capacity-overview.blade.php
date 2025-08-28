{{-- capacity-overview.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Daily Capacity Overview') }} - {{ $city->name }}</h4>
                <ul class="links">
                    <li><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li><a href="{{ route('admin-city-index') }}">{{ __('Cities') }}</a></li>
                    <li><a href="{{ route('admin-city-shipping-schedules', $city->id) }}">{{ __('Shipping Schedules') }}</a></li>
                    <li><a href="#">{{ __('Capacity Overview') }}</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="product-area">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="date-range">{{ __('Date Range') }}</label>
                    <select id="date-range" class="form-control">
                        <option value="7">{{ __('Next 7 days') }}</option>
                        <option value="14">{{ __('Next 14 days') }}</option>
                        <option value="30" selected>{{ __('Next 30 days') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <a href="{{ route('admin-city-shipping-schedules', $city->id) }}" class="btn btn-secondary mt-4">
                    <i class="fas fa-arrow-left"></i> {{ __('Back to Schedules') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="mr-table">
                    <div class="table-responsive">
                        <table id="capacityTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Day') }}</th>
                                    <th>{{ __('Time Slots') }}</th>
                                    <th>{{ __('Total Capacity') }}</th>
                                    <th>{{ __('Current Orders') }}</th>
                                    <th>{{ __('Available') }}</th>
                                    <th>{{ __('Utilization') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody id="capacity-data">
                                {{-- Data will be loaded via AJAX --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Total Capacity') }}</h5>
                        <h3 id="total-capacity">-</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Total Orders') }}</h5>
                        <h3 id="total-orders">-</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Available Slots') }}</h5>
                        <h3 id="available-slots">-</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Avg Utilization') }}</h5>
                        <h3 id="avg-utilization">-</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    loadCapacityData();
    
    $('#date-range').on('change', function() {
        loadCapacityData();
    });
    
    function loadCapacityData() {
        var days = $('#date-range').val();
        
        $.ajax({
            url: '{{ route('admin-city-shipping-capacity-data', $city->id) }}',
            data: { days: days },
            beforeSend: function() {
                $('#capacity-data').html('<tr><td colspan="8" class="text-center">{{ __('Loading...') }}</td></tr>');
            },
            success: function(response) {
                renderCapacityData(response.data);
                updateSummaryCards(response.summary);
            },
            error: function() {
                $('#capacity-data').html('<tr><td colspan="8" class="text-center text-danger">{{ __('Error loading data') }}</td></tr>');
            }
        });
    }
    
    function renderCapacityData(data) {
        var html = '';
        var groupedData = groupByDate(data);
        
        Object.keys(groupedData).forEach(function(date) {
            var dateData = groupedData[date];
            var totalCapacity = dateData.reduce((sum, item) => sum + item.capacity, 0);
            var totalOrders = dateData.reduce((sum, item) => sum + item.current_orders, 0);
            var totalAvailable = totalCapacity - totalOrders;
            var utilization = totalCapacity > 0 ? ((totalOrders / totalCapacity) * 100).toFixed(1) : 0;
            
            var statusClass = 'success';
            var statusText = '{{ __('Available') }}';
            
            if (utilization >= 100) {
                statusClass = 'danger';
                statusText = '{{ __('Full') }}';
            } else if (utilization >= 80) {
                statusClass = 'warning';
                statusText = '{{ __('Almost Full') }}';
            }
            
            var timeSlotsHtml = dateData.map(function(slot) {
                var slotUtilization = slot.capacity > 0 ? ((slot.current_orders / slot.capacity) * 100).toFixed(0) : 0;
                var slotStatusClass = slotUtilization >= 100 ? 'danger' : (slotUtilization >= 80 ? 'warning' : 'success');
                
                return `<div class="time-slot mb-1">
                    <small class="badge badge-${slotStatusClass}">
                        ${slot.time_slot}: ${slot.current_orders}/${slot.capacity} (${slotUtilization}%)
                    </small>
                </div>`;
            }).join('');
            
            html += `
                <tr>
                    <td>${formatDate(date)}</td>
                    <td>${getDayName(date)}</td>
                    <td>${timeSlotsHtml}</td>
                    <td><strong>${totalCapacity}</strong></td>
                    <td><strong>${totalOrders}</strong></td>
                    <td><strong>${totalAvailable}</strong></td>
                    <td>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-${statusClass}" role="progressbar" 
                                 style="width: ${Math.min(utilization, 100)}%" 
                                 aria-valuenow="${utilization}" aria-valuemin="0" aria-valuemax="100">
                                ${utilization}%
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-${statusClass}">${statusText}</span></td>
                </tr>
            `;
        });
        
        $('#capacity-data').html(html);
    }
    
    function updateSummaryCards(summary) {
        $('#total-capacity').text(summary.total_capacity || 0);
        $('#total-orders').text(summary.total_orders || 0);
        $('#available-slots').text(summary.available_slots || 0);
        $('#avg-utilization').text((summary.avg_utilization || 0) + '%');
    }
    
    function groupByDate(data) {
        return data.reduce(function(groups, item) {
            var date = item.date;
            if (!groups[date]) {
                groups[date] = [];
            }
            groups[date].push(item);
            return groups;
        }, {});
    }
    
    function formatDate(dateString) {
        var date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }
    
    function getDayName(dateString) {
        var date = new Date(dateString);
        return date.toLocaleDateString('en-US', { weekday: 'long' });
    }
});
</script>

<style>
.time-slot {
    display: inline-block;
    margin-right: 5px;
}

.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: none;
}

.progress {
    background-color: #e9ecef;
}

.progress-bar {
    font-size: 12px;
    line-height: 20px;
}

.badge {
    font-size: 0.75em;
}

.table th {
    border-top: none;
    font-weight: 600;
    background-color: #f8f9fa;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,0.075);
}

@media (max-width: 768px) {
    .time-slot {
        display: block;
        margin-bottom: 3px;
    }
    
    .card {
        margin-bottom: 15px;
    }
}
</style>
@endsection