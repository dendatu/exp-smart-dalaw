<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWalkInBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function create(): View
    {
        $facilities = Facility::visibleToUser(auth()->user())->orderBy('name')->get();

        return view('admin.bookings.create', compact('facilities'));
    }

    public function store(StoreWalkInBookingRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $referenceCode = 'BJMP-'.strtoupper(Str::random(6));

        $booking = DB::transaction(function () use ($validated, $referenceCode): Booking {
            $facility = Facility::visibleToUser(auth()->user())
                ->lockForUpdate()
                ->findOrFail($validated['facility_id']);

            $existingBookings = Booking::where('facility_id', $facility->id)
                ->whereDate('visit_date', $validated['visit_date'])
                ->where('time_slot', $validated['time_slot'])
                ->where('status', '!=', 'Rejected')
                ->count();

            if ($existingBookings >= $facility->max_visitors_per_hour) {
                throw ValidationException::withMessages([
                    'time_slot' => 'This time slot is fully booked. Choose another date or time.',
                ]);
            }

            $accompanyingVisitors = $validated['accompanying_visitors'] ?? [];
            unset($validated['accompanying_visitors']);

            $booking = Booking::create([
                ...$validated,
                'reference_code' => $referenceCode,
                'status' => 'Approved',
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'privacy_consent' => true,
                'privacy_consent_at' => now(),
                'privacy_notice_version' => '2026-09-28-v1',
            ]);

            foreach ($accompanyingVisitors as $visitorData) {
                $booking->accompanyingVisitors()->create($visitorData);
            }

            $booking->statusHistory()->create([
                'user_id' => auth()->id(),
                'from_status' => null,
                'to_status' => 'Approved',
                'reason' => 'Walk-in visitor registered on-site.',
            ]);

            return $booking;
        });

        return redirect()->route('admin.dashboard')->with('success', 'Walk-in visitor registered successfully.');
    }

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

            $accompanyingVisitors = $validated['accompanying_visitors'] ?? [];
            unset($validated['accompanying_visitors']);

            $lockedBooking->update($validated);

            $lockedBooking->accompanyingVisitors()->delete();
            foreach ($accompanyingVisitors as $visitorData) {
                $lockedBooking->accompanyingVisitors()->create($visitorData);
            }
        });

        return redirect()->route('admin.dashboard')->with('success', 'Booking details updated.');
    }
}
