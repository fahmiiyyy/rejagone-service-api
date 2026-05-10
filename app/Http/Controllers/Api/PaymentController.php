<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking')->get();

        return response()->json([
            'message' => 'List of payments',
            'data' => $payments
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string|max:255'
        ]);

        $booking = Booking::findOrFail($validated['booking_id']);

        // cek apakah booking bisa dibayar
        if ($booking->status !== 'need_payment') {
            return response()->json([
                'message' => 'Booking cannot be paid'
            ], 422);
        }

        // cek apakah payment sudah ada
        $existingPayment = Payment::where(
            'booking_id',
            $booking->id
        )->first();

        if ($existingPayment) {
            return response()->json([
                'message' => 'Payment already exists'
            ], 422);
        }

        // ambil harga service
        $amount = $booking->service->price;

        // create payment
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $amount,
            'payment_method' => $validated['payment_method'],
            'paid_at' => now(),
            'status' => 'paid'
        ]);

        // update booking status
        $booking->update([
            'status' => 'paid'
        ]);

        return response()->json([
            'message' => 'Payment created successfully',
            'data' => $payment
        ], 201);
    }

    public function show(string $id)
    {
        $payment = Payment::with([
            'booking.service',
            'booking.barber',
            'booking.schedule'
        ])->findOrFail($id);

        return response()->json([
            'message' => 'Payment detail',
            'data' => $payment
        ]);
    }
}