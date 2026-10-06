<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->boolean('terms_accepted')->default(false);
            $table->timestamp('terms_accepted_at')->nullable();
            $table->boolean('privacy_consent')->default(false);
            $table->timestamp('privacy_consent_at')->nullable();
            $table->string('privacy_notice_version', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'terms_accepted',
                'terms_accepted_at',
                'privacy_consent',
                'privacy_consent_at',
                'privacy_notice_version',
            ]);
        });
    }
};
