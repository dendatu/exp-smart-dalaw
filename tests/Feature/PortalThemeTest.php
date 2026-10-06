<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

test('bumblebee theme is set on the public admin and authentication roots', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('<html lang="en" data-theme="bumblebee">', false);

    $this->get(route('bookings.create'))
        ->assertOk()
        ->assertSee('class="btn btn-primary', false);

    $this->get(route('login'))
        ->assertOk()
        ->assertSee('<html lang="en" data-theme="bumblebee">', false)
        ->assertSee('class="checkbox checkbox-primary', false);

    $this->actingAs(User::factory()->create())
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('<html lang="en" data-theme="bumblebee">', false);
});
