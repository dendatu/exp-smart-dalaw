<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin login remembers the user when requested', function () {
    $user = User::factory()->create(['remember_token' => null]);

    $response = $this->post(route('login.submit'), [
        'email' => $user->email,
        'password' => 'password',
        'remember' => '1',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
    expect($user->fresh()->getRememberToken())->not->toBe('');
});

test('admin login does not remember the user when not requested', function () {
    $user = User::factory()->create(['remember_token' => null]);

    $response = $this->post(route('login.submit'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
    expect($user->fresh()->getRememberToken())->toBe('');
});

test('admin login form offers a remember me checkbox', function () {
    $this->get(route('login'))
        ->assertSee('id="remember"', false)
        ->assertSee('name="remember"', false)
        ->assertSeeText('Remember me');
});
