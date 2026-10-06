<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $visibleBookings = Booking::visibleToUser($request->user());

        $countsByStatus = (clone $visibleBookings)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $analytics = [
            'total' => $countsByStatus->sum(),
            'pending' => (int) $countsByStatus->get('Pending', 0),
            'approved' => (int) $countsByStatus->get('Approved', 0),
            'rejected' => (int) $countsByStatus->get('Rejected', 0),
            'today' => (clone $visibleBookings)->whereDate('visit_date', today())->count(),
            'upcoming' => (clone $visibleBookings)->whereDate('visit_date', '>=', today())
                ->where('status', 'Approved')
                ->count(),
        ];

        $query = Booking::visibleToUser($request->user())->with(['facility']);

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('date') && $request->date !== '') {
            $query->whereDate('visit_date', $request->date);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.dashboard', compact('analytics', 'bookings'));
    }

    public function approve(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        return $this->changeStatus($booking, 'Approved', $validated['reason']);
    }

    public function reject(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'admin_remarks' => ['required', 'string', 'max:500'],
        ]);

        return $this->changeStatus($booking, 'Rejected', $validated['admin_remarks']);
    }

    public function updateStatus(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['Pending', 'Approved', 'Rejected'])],
            'reason' => ['required', 'string', 'max:500'],
        ]);

        return $this->changeStatus($booking, $validated['status'], $validated['reason']);
    }

    private function changeStatus(Booking $booking, string $status, string $reason): RedirectResponse
    {
        DB::transaction(function () use ($booking, $status, $reason): void {
            $lockedBooking = Booking::visibleToUser(auth()->user())
                ->lockForUpdate()
                ->findOrFail($booking->id);

            if ($lockedBooking->status === $status) {
                throw ValidationException::withMessages([
                    'status' => "This booking is already {$status}.",
                ]);
            }

            if ($lockedBooking->status === 'Rejected' && $status !== 'Rejected') {
                $facility = Facility::visibleToUser(auth()->user())
                    ->lockForUpdate()
                    ->findOrFail($lockedBooking->facility_id);
                $existingBookings = Booking::query()
                    ->where('facility_id', $facility->id)
                    ->whereDate('visit_date', $lockedBooking->visit_date)
                    ->where('time_slot', $lockedBooking->time_slot)
                    ->where('status', '!=', 'Rejected')
                    ->whereKeyNot($lockedBooking->id)
                    ->count();

                if ($existingBookings >= $facility->max_visitors_per_hour) {
                    throw ValidationException::withMessages([
                        'status' => 'This visit cannot be reactivated because its hourly slot is full.',
                    ]);
                }
            }

            $previousStatus = $lockedBooking->status;
            $lockedBooking->status = $status;
            $lockedBooking->admin_remarks = $status === 'Rejected' ? $reason : null;
            $lockedBooking->save();

            $lockedBooking->statusHistory()->create([
                'user_id' => auth()->id(),
                'from_status' => $previousStatus,
                'to_status' => $status,
                'reason' => $reason,
            ]);
        });

        return redirect()->route('admin.dashboard')->with('success', "Booking status changed to {$status}.");
    }
}
