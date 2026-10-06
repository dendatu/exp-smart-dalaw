<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function edit(Booking $booking): View
    {
        $booking = Booking::visibleToUser(auth()->user())
            ->whereKey($booking->id)
            ->firstOrFail();
        $booking->load(['facility', 'accompanyingVisitors', 'statusHistory.changedBy']);
        $facilities = Facility::visibleToUser(auth()->user())->orderBy('name')->get();

        return view('admin.bookings.edit', compact('booking', 'facilities'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($booking, $validated): void {
            $lockedBooking = Booking::visibleToUser(auth()->user())
                ->lockForUpdate()
                ->findOrFail($booking->id);
            $facility = Facility::visibleToUser(auth()->user())
                ->lockForUpdate()
                ->findOrFail($validated['facility_id']);

            if ($lockedBooking->status !== 'Rejected') {
                $existingBookings = Booking::query()
                    ->where('facility_id', $facility->id)
                    ->whereDate('visit_date', $validated['visit_date'])
                    ->where('time_slot', $validated['time_slot'])
                    ->where('status', '!=', 'Rejected')
                    ->where('id', '!=', $lockedBooking->id)
                    ->count();

                if ($existingBookings >= $facility->max_visitors_per_hour) {
                    throw ValidationException::withMessages([
                        'time_slot' => 'This time slot is fully booked. Choose another date or time.',
                    ]);
                }
            }

            $lockedBooking->update($validated);
        });

        return redirect()->route('admin.dashboard')->with('success', 'Booking details updated.');
    }
}
