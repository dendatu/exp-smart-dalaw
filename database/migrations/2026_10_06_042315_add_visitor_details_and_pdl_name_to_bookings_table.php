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
            $table->foreignId('pdl_id')->nullable()->change();
            $table->string('pdl_name')->nullable()->after('pdl_id');
            $table->string('visitor_sex')->nullable()->after('visitor_full_name');
            $table->integer('visitor_age')->nullable()->after('visitor_sex');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['pdl_name', 'visitor_sex', 'visitor_age']);
        });
    }
};
