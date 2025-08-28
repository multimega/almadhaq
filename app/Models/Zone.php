<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Zone extends Model {
    protected $table = 'zone';
    protected $fillable = array('name','name_ar','country_id','zone_id','allow_cash');
    public $timestamps = false;
    
    
      /**
     * Get the country that owns the zone
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Get the shipping schedules for this city
     */
    public function shippingSchedules()
    {
        return $this->hasMany(CityShippingSchedule::class, 'city_id');
    }

    /**
     * Get active shipping schedules
     */
    public function activeShippingSchedules()
    {
        return $this->hasMany(CityShippingSchedule::class, 'city_id')->active();
    }


  /**
 * Get the next available shipping slot for this city
 */
public function getNextAvailableShippingSlot()
{
    $schedules = $this->activeShippingSchedules()->get();
    
    if ($schedules->isEmpty()) {
        return null;
    }

    $nextAvailable = null;
    $earliestDate = null;

    foreach ($schedules as $schedule) {
        $nextDate = $schedule->getNextAvailableDate();
        
        if ($nextDate && ($earliestDate === null || $nextDate->lt($earliestDate))) {
            $earliestDate = $nextDate;
            $nextAvailable = [
                'schedule_id' => $schedule->id,
                'schedule' => $schedule,
                'date' => $nextDate,
                'day' => $nextDate->format('l'),
                'formatted_date' => $nextDate->format('M j, Y'),
                'time_range' => $schedule->time_range,
                'remaining_capacity' => $schedule->getRemainingCapacityForDate($nextDate)
            ];
        }
    }

    return $nextAvailable;
}

/**
 * Get all available shipping slots for the next 7 days
 */
public function getAvailableShippingSlotsForWeek()
{
    $schedules = $this->activeShippingSchedules()->get();
    $availableSlots = collect();
    
    for ($i = 0; $i < 7; $i++) {
        $date = Carbon::now()->addDays($i);
        $dayName = strtolower($date->format('l'));
        
        $daySchedules = $schedules->where('day_of_week', $dayName);
        
        foreach ($daySchedules as $schedule) {
            if ($schedule->hasAvailableCapacityForDate($date)) {
                $availableSlots->push([
                    'schedule_id' => $schedule->id,
                    'date' => $date->copy(),
                    'day' => $date->format('l'),
                    'formatted_date' => $date->format('M j, Y'),
                    'time_range' => $schedule->time_range,
                    'remaining_capacity' => $schedule->getRemainingCapacityForDate($date)
                ]);
            }
        }
    }
    
    return $availableSlots->sortBy('date');
}

/**
 * Get available slots for a longer period (useful for admin/planning)
 */
public function getAvailableShippingSlotsForPeriod($days = 30)
{
    $schedules = $this->activeShippingSchedules()->get();
    $availableSlots = collect();
    
    for ($i = 0; $i < $days; $i++) {
        $date = Carbon::now()->addDays($i);
        $dayName = strtolower($date->format('l'));
        
        $daySchedules = $schedules->where('day_of_week', $dayName);
        
        foreach ($daySchedules as $schedule) {
            $availableSlots->push([
                'schedule_id' => $schedule->id,
                'date' => $date->copy(),
                'day' => $date->format('l'),
                'formatted_date' => $date->format('M j, Y'),
                'time_range' => $schedule->time_range,
                'capacity' => $schedule->capacity,
                'current_orders' => $schedule->getDateCapacity($date)->current_orders,
                'remaining_capacity' => $schedule->getRemainingCapacityForDate($date),
                'is_available' => $schedule->hasAvailableCapacityForDate($date)
            ]);
        }
    }
    
    return $availableSlots->sortBy('date');
}

}
