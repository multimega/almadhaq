<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\CityShippingSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityShippingScheduleController extends Controller
{

    
        /**
 * Display shipping schedules for a specific city
 */
public function index($cityId)
{
    $city = Zone::findOrFail($cityId);
    $schedules = CityShippingSchedule::where('city_id', $cityId)
        ->orderBy('day_of_week')
        ->orderBy('start_time')
        ->get();
        
    return view('admin.city.shipping-schedules', compact('city', 'schedules'));
}

/**
 * Show form to create new shipping schedule
 */
public function create($cityId)
{
    $city = Zone::findOrFail($cityId);
    $daysOfWeek = [
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday'
    ];
    
    // Return only the form content for AJAX
    if (request()->ajax()) {
        return view('admin.city.shipping-schedule-create', compact('city', 'daysOfWeek'))->render();
    }
    
    return view('admin.city.shipping-schedule-create', compact('city', 'daysOfWeek'));
}

/**
 * Store new shipping schedule
 */
public function store(Request $request, $cityId)
{
    $validator = Validator::make($request->all(), [
        'day_of_week' => 'required|string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'capacity' => 'required|integer|min:1',
        'is_active' => 'boolean'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Check for overlapping schedules
    $existing = CityShippingSchedule::where('city_id', $cityId)
        ->where('day_of_week', $request->day_of_week)
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                ->orWhere(function ($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time)
                      ->where('end_time', '>=', $request->end_time);
                });
        })
        ->exists();

    if ($existing) {
        return response()->json([
            'success' => false,
            'message' => 'This time slot overlaps with an existing schedule for the same day.'
        ], 422);
    }

    try {
        CityShippingSchedule::create([
            'city_id' => $cityId,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'capacity' => $request->capacity,
            'is_active' => $request->boolean('is_active', true)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Shipping schedule created successfully!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while creating the schedule.'
        ], 500);
    }
}

/**
 * Show form to edit shipping schedule
 */
public function edit($scheduleId)
{
    $schedule = CityShippingSchedule::with('city')->findOrFail($scheduleId);
    $daysOfWeek = [
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday'
    ];
    
    // Return only the form content for AJAX
    if (request()->ajax()) {
        return view('admin.city.shipping-schedule-edit', compact('schedule', 'daysOfWeek'))->render();
    }
    
    return view('admin.city.shipping-schedule-edit', compact('schedule', 'daysOfWeek'));
}

/**
 * Update shipping schedule
 */
public function update(Request $request, $scheduleId)
{
    $schedule = CityShippingSchedule::findOrFail($scheduleId);
    
    $validator = Validator::make($request->all(), [
        'day_of_week' => 'required|string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'capacity' => [
            'required',
            'integer',
            'min:' . $schedule->current_orders, // Cannot be less than current orders
        ],
        'is_active' => 'boolean'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Check for overlapping schedules (exclude current schedule)
    $existing = CityShippingSchedule::where('city_id', $schedule->city_id)
        ->where('id', '!=', $scheduleId)
        ->where('day_of_week', $request->day_of_week)
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                ->orWhere(function ($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time)
                      ->where('end_time', '>=', $request->end_time);
                });
        })
        ->exists();

    if ($existing) {
        return response()->json([
            'success' => false,
            'message' => 'This time slot overlaps with an existing schedule for the same day.'
        ], 422);
    }

    try {
        $schedule->update([
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'capacity' => $request->capacity,
            'is_active' => $request->boolean('is_active', true)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Shipping schedule updated successfully!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while updating the schedule.'
        ], 500);
    }
}

/**
 * Delete shipping schedule
 */
public function destroy($scheduleId)
{
    // Ensure this is a DELETE request
    if (!request()->isMethod('DELETE')) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid request method.'
        ], 405);
    }

    try {
        $schedule = CityShippingSchedule::findOrFail($scheduleId);

        // Reset all orders that are associated with this schedule
        \App\Models\Order::where('shipping_schedule_id', $scheduleId)->update([
            'shipping_schedule_id' => null,
            // 'scheduled_delivery_date' => null,
            // 'scheduled_delivery_start_time' => null,
            // 'scheduled_delivery_end_time' => null,
        ]);

        // Now delete the schedule
        $schedule->delete();

        return response()->json([
            'success' => true,
            'message' => 'Shipping schedule deleted successfully, and associated orders were reset.'
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Schedule not found.'
        ], 404);
    } catch (\Exception $e) {
        \Log::error('Error deleting shipping schedule: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while deleting the schedule.'
        ], 500);
    }
}


public function getAvailableSlots($cityName)
{
    try {
        $city = Zone::where('name', $cityName)
                    ->orWhere('name_ar', $cityName)
                    ->firstOrFail();

        $nextSlot = $city->getNextAvailableShippingSlot();
        $weekSlots = $city->getAvailableShippingSlotsForWeek();

        return response()->json([
            'success' => true,
            'next_available' => $nextSlot,
            'weekly_slots' => $weekSlots->values()->toArray()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while fetching available slots.'
        ], 500);
    }
}


}