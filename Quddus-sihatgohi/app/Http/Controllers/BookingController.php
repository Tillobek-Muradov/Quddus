<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after:arrival_date',
            'treatment_type' => 'required|in:heart,respiratory,nervous,joints'
        ]);

        Booking::create($validated);

        return redirect()->route('bookings.index')
                         ->with('success', 'Bron muvaffaqiyatli qo\'shildi');
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after:arrival_date',
            'treatment_type' => 'required|in:heart,respiratory,nervous,joints',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.index')
                         ->with('success', 'Bron muvaffaqiyatli yangilandi');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')
                         ->with('success', 'Bron muvaffaqiyatli o\'chirildi');
    }
}