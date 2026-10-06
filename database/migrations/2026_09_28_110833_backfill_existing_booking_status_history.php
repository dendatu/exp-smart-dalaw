<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $snapshotTime = now();

        DB::table('bookings')
            ->select(['id', 'status', 'admin_remarks'])
            ->orderBy('id')
            ->chunkById(500, function ($bookings) use ($snapshotTime): void {
                $historyEntries = $bookings->map(function (object $booking) use ($snapshotTime): array {
                    $reason = $booking->status === 'Rejected'
                        ? (filled($booking->admin_remarks)
                            ? $booking->admin_remarks
                            : 'This booking was rejected before status history was enabled; no reason was saved.')
                        : 'Current status recorded when status history was enabled; earlier changes are unavailable.';

                    return [
                        'booking_id' => $booking->id,
                        'user_id' => null,
                        'from_status' => null,
                        'to_status' => $booking->status,
                        'reason' => $reason,
                        'created_at' => $snapshotTime,
                        'updated_at' => $snapshotTime,
                    ];
                })->all();

                DB::table('booking_status_histories')->insert($historyEntries);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Audit snapshots are retained so rolling back does not erase history.
    }
};
