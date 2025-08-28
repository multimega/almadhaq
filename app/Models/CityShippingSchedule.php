<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CityShippingSchedule extends Model
{
    protected $fillable = [
        'city_id',
        'day_of_week',
        'start_time',
        'end_time',
        'capacity',
        'is_active'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_active' => 'boolean'
    ];

    /**
     * Get the city that owns the shipping schedule
     */
    public function city()
    {
        return $this->belongsTo(Zone::class, 'city_id');
    }

    /**
     * Get the date capacity records for this schedule
     */
    public function dateCapacities()
    {
        return $this->hasMany(CityShippingDateCapacity::class, 'schedule_id');
    }

    /**
     * Check if this schedule has available capacity for a specific date
     */
    public function hasAvailableCapacityForDate($date)
    {
        $dateCapacity = $this->getDateCapacity($date);
        return $dateCapacity->current_orders < $this->capacity;
    }

    /**
     * Get remaining capacity for a specific date
     */
    public function getRemainingCapacityForDate($date)
    {
        $dateCapacity = $this->getDateCapacity($date);
        return $this->capacity - $dateCapacity->current_orders;
    }

    /**
     * Get or create date capacity record for a specific date
     */
    public function getDateCapacity($date)
    {
        return CityShippingDateCapacity::getOrCreateForDate(
            $this->id,
            $this->city_id,
            Carbon::parse($date)->format('Y-m-d')
        );
    }

    /**
     * Get the next available date for this schedule
     */
    public function getNextAvailableDate()
    {
        $today = Carbon::now();
        $dayIndex = $this->getDayIndex($this->day_of_week);
        
        // Start from today and look for the next available date
        $nextDate = $today->copy();
        $maxDaysToCheck = 365; // Prevent infinite loop
        $daysChecked = 0;
        
        do {
            // Move to next day if not the target day or if we're checking subsequent occurrences
            if ($nextDate->dayOfWeek !== $dayIndex || $daysChecked > 0) {
                $nextDate->addDay();
                $daysChecked++;
                
                if ($daysChecked >= $maxDaysToCheck) {
                    return null; // No available dates found
                }
                
                // Skip if not the target day
                if ($nextDate->dayOfWeek !== $dayIndex) {
                    continue;
                }
            }
            
            // Check if this date has available capacity
            if ($this->hasAvailableCapacityForDate($nextDate)) {
                return $nextDate;
            }
            
            // If we checked today and it's full, start looking for next occurrence
            if ($daysChecked === 0) {
                $daysChecked = 1;
            }
            
        } while ($daysChecked < $maxDaysToCheck);
        
        return null; // No available dates found
    }

    /**
     * Convert day name to Carbon day index
     */
    private function getDayIndex($dayName)
    {
        $days = [
            'sunday' => 0,
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6
        ];
        
        return $days[strtolower($dayName)] ?? 0;
    }

    /**
     * Scope for active schedules
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get formatted time range
     */
    public function getTimeRangeAttribute()
    {
        return Carbon::parse($this->start_time)->format('g:i A') . ' - ' . 
               Carbon::parse($this->end_time)->format('g:i A');
    }

    /**
     * Reserve a slot for a specific date
     */
    public function reserveSlotForDate($date)
    {
        $dateCapacity = $this->getDateCapacity($date);
        
        if ($dateCapacity->hasAvailableCapacity()) {
            $dateCapacity->incrementOrders();
            return true;
        }
        
        return false;
    }

    /**
     * Cancel a reservation for a specific date
     */
    public function cancelReservationForDate($date)
    {
        $dateCapacity = $this->getDateCapacity($date);
        $dateCapacity->decrementOrders();
        return true;
    }
}