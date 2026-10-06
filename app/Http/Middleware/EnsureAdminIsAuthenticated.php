<?php

namespace App\Http\Middleware;

use App\Models\Booking;
use App\Models\Facility;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        abort_unless(
            $user->isSuperAdmin() || ($user->isFacilityAdmin() && $user->facility_id !== null),
            403,
        );

        $booking = $request->route('booking');
        if ($booking instanceof Booking && $user->isFacilityAdmin() && (int) $booking->facility_id !== (int) $user->facility_id) {
            abort(404);
        }

        $facility = $request->route('facility');
        if ($facility instanceof Facility && $user->isFacilityAdmin() && (int) $facility->id !== (int) $user->facility_id) {
            abort(404);
        }

        return $next($request);
    }
}
