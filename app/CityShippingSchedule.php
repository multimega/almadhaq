<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CityShippingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'day_of_week',
        'start_time',
        'end_time',
        'capacity',
        'current_orders',
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
     * Check if this schedule has available capacity
     */
    public function hasAvailableCapacity()
    {
        return $this->current_orders < $this->capacity;
    }

    /**
     * Get remaining capacity
     */
    public function getRemainingCapacity()
    {
        return $this->capacity - $this->current_orders;
    }

    /**
     * Get the next available date for this schedule
     */
    public function getNextAvailableDate()
    {
        $today = Carbon::now();
        $dayIndex = $this->getDayIndex($this->day_of_week);
        
        // Find next occurrence of this day
        $nextDate = $today->copy();
        while ($nextDate->dayOfWeek !== $dayIndex || !$this->hasAvailableCapacity()) {
            $nextDate->addDay();
            
            // If we've reached the target day and it has capacity, break
            if ($nextDate->dayOfWeek === $dayIndex && $this->hasAvailableCapacity()) {
                break;
            }
        }
        
        return $nextDate;
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
     * Scope for schedules with available capacity
     */
    public function scopeAvailable($query)
    {
        return $query->whereRaw('current_orders < capacity');
    }

    /**
     * Get formatted time range
     */
    public function getTimeRangeAttribute()
    {
        return Carbon::parse($this->start_time)->format('g:i A') . ' - ' . 
               Carbon::parse($this->end_time)->format('g:i A');
    }
}