<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('barber')->get();

        return response()->json([
            'message' => 'List of schedules',
            'data' => $schedules
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'schedule_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'nullable|in:available,booked,closed'
        ]);

        $schedule = Schedule::create($validated);

        return response()->json([
            'message' => 'Schedule created successfully',
            'data' => $schedule
        ], 201);
    }

    public function show(string $id)
    {
        $schedule = Schedule::with('barber')->findOrFail($id);

        return response()->json([
            'message' => 'Schedule detail',
            'data' => $schedule
        ]);
    }

    public function update(Request $request, string $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'barber_id' => 'sometimes|exists:barbers,id',
            'schedule_date' => 'sometimes|date',
            'start_time' => 'sometimes',
            'end_time' => 'sometimes',
            'status' => 'sometimes|in:available,booked,closed'
        ]);

        $schedule->update($validated);

        return response()->json([
            'message' => 'Schedule updated successfully',
            'data' => $schedule
        ]);
    }

    public function destroy(string $id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->delete();

        return response()->json([
            'message' => 'Schedule deleted successfully'
        ]);
    }
}