<?php

use App\Models\Booking;
use App\Models\Facility;
use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

uses(RefreshDatabase::class);

test('urls and routes are dynamically based on APP_URL configuration', function () {
    config(['app.url' => 'http://exp-smart-dalaw.test']);
    (new AppServiceProvider(app()))->boot();

    expect(url('/'))->toBe('http://exp-smart-dalaw.test')
        ->and(route('home'))->toBe('http://exp-smart-dalaw.test')
        ->and(route('bookings.create'))->toBe('http://exp-smart-dalaw.test/book')
        ->and(route('qr.redirect', ['code' => 'BJMP-TEST01']))->toBe('http://exp-smart-dalaw.test/qr/BJMP-TEST01')
        ->and(asset('css/app.css'))->toBe('http://exp-smart-dalaw.test/css/app.css');
});

test('urls respect https scheme when APP_URL is https', function () {
    config(['app.url' => 'https://exp-smart-dalaw.test']);
    (new AppServiceProvider(app()))->boot();

    expect(url('/'))->toBe('https://exp-smart-dalaw.test')
        ->and(route('home'))->toBe('https://exp-smart-dalaw.test')
        ->and(route('qr.redirect', ['code' => 'BJMP-TEST01']))->toBe('https://exp-smart-dalaw.test/qr/BJMP-TEST01');
});

test('success page generates QR code matching APP_URL even when request host differs', function () {
    config(['app.url' => 'http://exp-smart-dalaw.test']);
    (new AppServiceProvider(app()))->boot();

    $facility = Facility::create([
        'name' => 'Test Jail Facility',
        'max_visitors_per_hour' => 50,
    ]);

    $pdl = $facility->pdls()->create([
        'first_name' => 'Juan',
        'last_name' => 'Dela Cruz',
        'cell_block' => 'A-101',
    ]);

    $booking = Booking::create([
        'reference_code' => 'BJMP-TESTQR',
        'facility_id' => $facility->id,
        'pdl_id' => $pdl->id,
        'visitor_full_name' => 'Maria Dela Cruz',
        'visitor_email' => 'maria@example.com',
        'visitor_contact' => '09123456789',
        'visitor_id_type' => 'Driver License',
        'visitor_id_number' => 'D01-23-456789',
        'relationship_to_pdl' => 'Spouse',
        'visit_date' => now()->addDays(2)->format('Y-m-d'),
        'time_slot' => '8:00 AM - 9:00 AM',
        'status' => 'Pending',
    ]);

    $response = $this->withServerVariables(['HTTP_HOST' => 'localhost:8000'])
        ->get(route('booking.success', $booking->reference_code));

    $response->assertStatus(200);

    $expectedQrCode = (string) QrCode::size(180)->generate('http://exp-smart-dalaw.test/qr/BJMP-TESTQR');
    $response->assertSee($expectedQrCode, false);
});
