<form id="scheduleForm" action="{{ route('admin-city-shipping-schedules-store', $city->id) }}" method="POST">
    {{ csrf_field() }}
    
    <div class="form-group">
        <label class="control-label" for="day_of_week">{{ __('Day of Week') }} *</label>
        <select class="form-control" name="day_of_week" id="day_of_week" required>
            <option value="">{{ __('Select Day') }}</option>
            @foreach($daysOfWeek as $key => $day)
                <option value="{{ $key }}">{{ __($day) }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="start_time">{{ __('Start Time') }} *</label>
                <input type="time" class="form-control" name="start_time" id="start_time" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="end_time">{{ __('End Time') }} *</label>
                <input type="time" class="form-control" name="end_time" id="end_time" required>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label" for="capacity">{{ __('Daily Capacity (Max Orders)') }} *</label>
        <input type="number" class="form-control" name="capacity" id="capacity" min="1" required>
        <small class="form-text text-muted">{{ __('Maximum number of orders per day for this time slot') }}</small>
    </div>
    
    <div class="form-group">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1" checked>
            <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
        </div>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ __('Create Schedule') }}</button>
    </div>
</form>

<script>
$(document).ready(function() {
    // Set modal title
    $('.modal-title').text('{{ __('Add New Shipping Schedule') }} - {{ $city->name }}');
    
    // Check for existing schedules on same day
    {{-- $('#day_of_week').on('change', function() {
        var selectedDay = $(this).val();
        if (selectedDay) {
                checkExistingSchedules(selectedDay); 
        }
    });
     --}}
     
    // Form validation
    $('#start_time, #end_time').on('change', function() {
        var startTime = $('#start_time').val();
        var endTime = $('#end_time').val();
        
        if (startTime && endTime && startTime >= endTime) {
            toastr.error('{{ __('End time must be after start time') }}');
            $('#end_time').val('');
        }
    });
    
    {{-- function checkExistingSchedules(day) {
        // You can add AJAX call here to check for overlapping schedules
        $.get('{{ route('admin-city-shipping-schedules-check', $city->id) }}', {
            day: day
        }).done(function(response) {
            if (response.existing && response.existing.length > 0) {
                var message = '{{ __('Existing schedules for this day:') }}\n';
                response.existing.forEach(function(schedule) {
                    message += '• ' + schedule.time_range + ' ({{ __('Capacity') }}: ' + schedule.capacity + ')\n';
                });
                toastr.info(message);
            }
        });
    }
     --}}
});
</script>

