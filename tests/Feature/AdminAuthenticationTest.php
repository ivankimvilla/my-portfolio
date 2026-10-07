<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    config(['admin.email' => 'admin@example.com']);
});

test('guests are redirected to the admin login page', function () {
    $this->get(route('admin'))
        ->assertRedirect(route('login'));
});

test('the admin login page is available to guests', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertSee('Sign in');
});

test('the configured admin can sign in and sign out', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => 'correct-password',
    ]);

    $this->post(route('admin.login.submit'), [
        'email' => 'ADMIN@example.com',
        'password' => 'correct-password',
    ])->assertRedirect(route('admin'));

    $this->assertAuthenticatedAs($admin);
    $this->get(route('admin'))->assertOk();

    $this->post(route('admin.logout'))
        ->assertRedirect(route('login'));

    $this->assertGuest();
});

test('invalid and non-admin credentials are rejected', function () {
    User::factory()->create([
        'email' => 'admin@example.com',
        'password' => 'correct-password',
    ]);
    User::factory()->create([
        'email' => 'other@example.com',
        'password' => 'correct-password',
    ]);

    $this->post(route('admin.login.submit'), [
        'email' => 'admin@example.com',
        'password' => 'wrong-password',
    ])->assertSessionHasErrors('email');

    $this->post(route('admin.login.submit'), [
        'email' => 'other@example.com',
        'password' => 'correct-password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('authenticated non-admin users cannot access the dashboard', function () {
    $user = User::factory()->create(['email' => 'other@example.com']);

    $this->actingAs($user)
        ->get(route('admin'))
        ->assertForbidden();
});