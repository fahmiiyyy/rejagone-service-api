<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with([
            'service',
            'barber',
            'schedule',
            'payment'
        ])->get();

        return response()->json([
            'message' => 'List of bookings',
            'data' => $bookings
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',

            'service_id' => 'required|exists:services,id',

            'barber_id' => 'required|exists:barbers,id',

            'schedule_id' => 'required|exists:schedules,id',

            'booking_date' => 'required|date',

            'booking_time' => 'required',

            'notes' => 'nullable|string'
        ]);

        // cek schedule tersedia
        $schedule = Schedule::findOrFail($validated['schedule_id']);

        if ($schedule->status !== 'available') {
            return response()->json([
                'message' => 'Schedule is not available'
            ], 422);
        }

        // create booking
        $booking = Booking::create([
            ...$validated,
            'status' => 'need_payment'
        ]);

        // update schedule jadi booked
        $schedule->update([
            'status' => 'booked'
        ]);

        return response()->json([
            'message' => 'Booking created successfully',
            'data' => $booking
        ], 201);
    }

    public function show(string $id)
    {
        $booking = Booking::with([
            'service',
            'barber',
            'schedule',
            'payment'
        ])->findOrFail($id);

        return response()->json([
            'message' => 'Booking detail',
            'data' => $booking
        ]);
    }

    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);

        // balikin schedule jadi available
        $schedule = $booking->schedule;

        if ($schedule) {
            $schedule->update([
                'status' => 'available'
            ]);
        }

        $booking->delete();

        return response()->json([
            'message' => 'Booking deleted successfully'
        ]);
    }
}