<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CityShippingDateCapacity extends Model
{
    protected $table = 'city_shipping_date_capacity';
    
    protected $fillable = [
        'city_id',
        'schedule_id',
        'shipping_date',
        'current_orders'
    ];

    protected $casts = [
        'shipping_date' => 'date'
    ];

    /**
     * Get the city that owns this date capacity
     */
    public function city()
    {
        return $this->belongsTo(Zone::class, 'city_id');
    }

    /**
     * Get the schedule that owns this date capacity
     */
    public function schedule()
    {
        return $this->belongsTo(CityShippingSchedule::class, 'schedule_id');
    }

    /**
     * Check if this date has available capacity
     */
    public function hasAvailableCapacity()
    {
        return $this->current_orders < $this->schedule->capacity;
    }

    /**
     * Get remaining capacity for this date
     */
    public function getRemainingCapacity()
    {
        return $this->schedule->capacity - $this->current_orders;
    }

    /**
     * Increment the order count for this date
     */
    public function incrementOrders()
    {
        $this->increment('current_orders');
        return $this;
    }

    /**
     * Decrement the order count for this date (for order cancellations)
     */
    public function decrementOrders()
    {
        if ($this->current_orders > 0) {
            $this->decrement('current_orders');
        }
        return $this;
    }

    /**
     * Get or create capacity record for a specific date and schedule
     */
    public static function getOrCreateForDate($scheduleId, $cityId, $date)
    {
        return static::firstOrCreate([
            'schedule_id' => $scheduleId,
            'city_id' => $cityId,
            'shipping_date' => $date
        ], [
            'current_orders' => 0
        ]);
    }
}