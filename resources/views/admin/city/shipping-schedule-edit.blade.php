
{{-- EDIT FORM (shipping-schedule-edit.blade.php) --}}
<form id="scheduleForm" action="{{ route('admin-city-shipping-schedules-update', $schedule->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    
    <div class="form-group">
        <label class="control-label" for="day_of_week">{{ __('Day of Week') }} *</label>
        <select class="form-control" name="day_of_week" id="day_of_week" required>
            <option value="">{{ __('Select Day') }}</option>
            @foreach($daysOfWeek as $key => $day)
                <option value="{{ $key }}" {{ $schedule->day_of_week == $key ? 'selected' : '' }}>
                    {{ __($day) }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="start_time">{{ __('Start Time') }} *</label>
                <input type="time" class="form-control" name="start_time" id="start_time" 
                       value="{{ $schedule->start_time->format('H:i') }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="end_time">{{ __('End Time') }} *</label>
                <input type="time" class="form-control" name="end_time" id="end_time" 
                       value="{{ $schedule->end_time->format('H:i') }}" required>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label" for="capacity">{{ __('Daily Capacity (Max Orders)') }} *</label>
        <input type="number" class="form-control" name="capacity" id="capacity" 
               min="1" value="{{ $schedule->capacity }}" required>
        <small class="form-text text-muted">
            {{ __('Maximum number of orders per day for this time slot') }}
        </small>
    </div>
    
    @php
        $todayCapacity = $schedule->getDateCapacity(now());
        $totalFutureOrders = $schedule->dateCapacities()
            ->where('shipping_date', '>=', now()->format('Y-m-d'))
            ->sum('current_orders');
    @endphp
    
    @if($totalFutureOrders > 0)
    <div class="alert alert-info">
        <h6>{{ __('Current Usage:') }}</h6>
        <ul class="mb-0">
            <li>{{ __('Today:') }} {{ $todayCapacity->current_orders }} {{ __('orders') }}</li>
            <li>{{ __('Future orders:') }} {{ $totalFutureOrders }} {{ __('total') }}</li>
        </ul>
        <small class="text-muted">
            {{ __('Reducing capacity may affect future deliveries if they exceed the new limit.') }}
        </small>
    </div>
    @endif
    
    <div class="form-group">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1" {{ $schedule->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
        </div>
        @if(!$schedule->is_active)
        <small class="form-text text-warning">
            {{ __('Inactive schedules will not accept new orders but existing orders remain valid.') }}
        </small>
        @endif
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ __('Update Schedule') }}</button>
    </div>
</form>

<script>
$(document).ready(function() {
    // Set modal title
    $('.modal-title').text('{{ __('Edit Shipping Schedule') }} - {{ $schedule->city->name }}');
    
    // Form validation
    $('#start_time, #end_time').on('change', function() {
        var startTime = $('#start_time').val();
        var endTime = $('#end_time').val();
        
        if (startTime && endTime && startTime >= endTime) {
            toastr.error('{{ __('End time must be after start time') }}');
            $('#end_time').val('{{ $schedule->end_time->format('H:i') }}');
        }
    });
    
    // Capacity validation with warning
    $('#capacity').on('change', function() {
        var newCapacity = parseInt($(this).val());
        var currentCapacity = {{ $schedule->capacity }};
        var futureOrders = {{ $totalFutureOrders }};
        
        if (newCapacity < futureOrders) {
            toastr.warning('{{ __('Warning: New capacity is less than existing future orders (:count)', ['count' => $totalFutureOrders]) }}');
        }
        
        if (newCapacity < 1) {
            toastr.error('{{ __('Capacity must be at least 1') }}');
            $(this).val(currentCapacity);
        }
    });
    
    // Status change warning
    $('#is_active').on('change', function() {
        if (!$(this).is(':checked')) {
            if ({{ $totalFutureOrders }} > 0) {
                if (!confirm('{{ __('This schedule has :count future orders. Deactivating will prevent new orders but existing orders will remain. Continue?', ['count' => $totalFutureOrders]) }}')) {
                    $(this).prop('checked', true);
                }
            }
        }
    });
});
</script>