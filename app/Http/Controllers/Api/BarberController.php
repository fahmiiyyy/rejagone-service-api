<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();

        return response()->json([
            'message' => 'List of barbers',
            'data' => $barbers
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'specialty' => 'nullable|string|max:255'
        ]);

        $barber = Barber::create($validated);

        return response()->json([
            'message' => 'Barber created successfully',
            'data' => $barber
        ], 201);
    }

    public function show(string $id)
    {
        $barber = Barber::findOrFail($id);

        return response()->json([
            'message' => 'Barber detail',
            'data' => $barber
        ]);
    }

    public function update(Request $request, string $id)
    {
        $barber = Barber::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'phone' => 'nullable|string|max:20',
            'specialty' => 'nullable|string|max:255'
        ]);

        $barber->update($validated);

        return response()->json([
            'message' => 'Barber updated successfully',
            'data' => $barber
        ]);
    }

    public function destroy(string $id)
    {
        $barber = Barber::findOrFail($id);

        $barber->delete();

        return response()->json([
            'message' => 'Barber deleted successfully'
        ]);
    }
}