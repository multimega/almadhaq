<?php

namespace App\Services;

use App\Models\Zone;
use App\Models\CityShippingSchedule;
use App\Models\CityShippingDateCapacity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShippingService
{
    /**
     * Reserve a shipping slot for an order
     */
    public function reserveShippingSlot($scheduleId, $shippingDate)
    {

        return DB::transaction(function () use ($scheduleId, $shippingDate) {
            $schedule = CityShippingSchedule::findOrFail($scheduleId);
            
            // Get or create the date capacity record
            $dateCapacity = $schedule->getDateCapacity($shippingDate);
            
            // Check if capacity is available
            if (!$dateCapacity->hasAvailableCapacity()) {
                throw new \Exception('No available capacity for the selected date and time.');
            }
            
            // Reserve the slot
            $dateCapacity->incrementOrders();
            
            return [
                'schedule_id' => $schedule->id,
                'city_id' => $schedule->city_id,
                'shipping_date' => Carbon::parse($shippingDate)->format('Y-m-d'),
                'shipping_time_range' => $schedule->time_range,
                'remaining_capacity' => $dateCapacity->getRemainingCapacity()
            ];
        });
        
    }

    /**
     * Cancel a shipping slot reservation
     */
    public function cancelShippingSlot($scheduleId, $shippingDate)
    {
        return DB::transaction(function () use ($scheduleId, $shippingDate) {
            $schedule = CityShippingSchedule::findOrFail($scheduleId);
            $dateCapacity = $schedule->getDateCapacity($shippingDate);
            
            $dateCapacity->decrementOrders();
            
            return true;
        });
    }

    /**
     * Get shipping slot details for an order
     */
    public function getShippingSlotDetails($scheduleId, $shippingDate)
    {
        $schedule = CityShippingSchedule::with('city')->findOrFail($scheduleId);
        $dateCapacity = $schedule->getDateCapacity($shippingDate);
        
        return [
            'schedule_id' => $schedule->id,
            'city_name' => $schedule->city->name,
            'city_name_ar' => $schedule->city->name_ar,
            'shipping_date' => Carbon::parse($shippingDate)->format('Y-m-d'),
            'shipping_day' => Carbon::parse($shippingDate)->format('l'),
            'formatted_date' => Carbon::parse($shippingDate)->format('M j, Y'),
            'time_range' => $schedule->time_range,
            'capacity' => $schedule->capacity,
            'current_orders' => $dateCapacity->current_orders,
            'remaining_capacity' => $dateCapacity->getRemainingCapacity()
        ];
    }

    /**
     * Validate if a shipping slot is still available before finalizing order
     */
    public function validateShippingSlot($scheduleId, $shippingDate)
    {

        $schedule = CityShippingSchedule::findOrFail($scheduleId);
        return $schedule->hasAvailableCapacityForDate($shippingDate);

    }

    /**
     * Get capacity statistics for a city and date range
     */
    public function getCapacityStats($cityId, $startDate, $endDate)
    {
        $city = Zone::findOrFail($cityId);
        $stats = collect();
        
        $currentDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);
        
        while ($currentDate->lte($endDate)) {
            $dayName = strtolower($currentDate->format('l'));
            $schedules = $city->activeShippingSchedules()
                            ->where('day_of_week', $dayName)
                            ->get();
            
            foreach ($schedules as $schedule) {
                $dateCapacity = $schedule->getDateCapacity($currentDate);
                
                $stats->push([
                    'date' => $currentDate->format('Y-m-d'),
                    'day' => $currentDate->format('l'),
                    'formatted_date' => $currentDate->format('M j, Y'),
                    'time_range' => $schedule->time_range,
                    'capacity' => $schedule->capacity,
                    'current_orders' => $dateCapacity->current_orders,
                    'remaining_capacity' => $dateCapacity->getRemainingCapacity(),
                    'utilization_percentage' => round(($dateCapacity->current_orders / $schedule->capacity) * 100, 2)
                ]);
            }
            
            $currentDate->addDay();
        }
        
        return $stats->sortBy('date');
    }

    /**
     * Clean up old capacity records (run this periodically)
     */
    public function cleanupOldCapacityRecords($daysToKeep = 30)
    {
        $cutoffDate = Carbon::now()->subDays($daysToKeep);
        
        return CityShippingDateCapacity::where('shipping_date', '<', $cutoffDate)
                                      ->delete();
    }
}