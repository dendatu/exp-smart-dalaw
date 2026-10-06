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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code')->unique();
            $table->foreignId('facility_id')->constrained()->onDelete('cascade');
            $table->foreignId('pdl_id')->constrained()->onDelete('cascade');
            $table->string('visitor_full_name');
            $table->string('visitor_email')->nullable();
            $table->string('visitor_contact');
            $table->string('visitor_id_type');
            $table->string('visitor_id_number');
            $table->string('relationship_to_pdl');
            $table->date('visit_date');
            $table->string('time_slot');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->text('admin_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
