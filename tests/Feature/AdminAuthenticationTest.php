<?php

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

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
        'is_admin' => true,
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

test('database seeder creates the configured development admin who can sign in', function () {
    $this->seed(AdminUserSeeder::class);

    $admin = User::where('email', AdminUserSeeder::ADMIN_EMAIL)->firstOrFail();
    expect($admin->is_admin)->toBeTrue();

    $this->post(route('admin.login.submit'), [
        'email' => AdminUserSeeder::ADMIN_EMAIL,
        'password' => AdminUserSeeder::ADMIN_PASSWORD,
    ])->assertRedirect(route('admin'));

    $this->assertAuthenticatedAs($admin);
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

test('admin can change email and password without losing admin access', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => 'current-password',
        'is_admin' => true,
    ]);

    $this->actingAs($admin)
        ->put(route('admin.account-settings.update'), [
            'email' => 'updated-admin@example.com',
            'current_password' => 'current-password',
            'password' => 'new-strong-password',
            'password_confirmation' => 'new-strong-password',
        ])
        ->assertRedirect(route('admin.account-settings.edit'));

    $admin->refresh();
    expect($admin->email)->toBe('updated-admin@example.com')
        ->and($admin->is_admin)->toBeTrue();

    $this->get(route('admin.account-settings.edit'))->assertOk();
    $this->get(route('admin'))->assertOk();

    $this->post(route('admin.logout'))->assertRedirect(route('login'));
    $this->post(route('admin.login.submit'), [
        'email' => 'updated-admin@example.com',
        'password' => 'new-strong-password',
    ])->assertRedirect(route('admin'));
});

test('account settings require the current password and leave credentials unchanged on failure', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => 'current-password',
        'is_admin' => true,
    ]);

    $this->actingAs($admin)
        ->from(route('admin.account-settings.edit'))
        ->put(route('admin.account-settings.update'), [
            'email' => 'changed@example.com',
            'current_password' => 'incorrect-password',
            'password' => 'new-strong-password',
            'password_confirmation' => 'new-strong-password',
        ])
        ->assertSessionHasErrors('current_password');

    expect($admin->fresh()->email)->toBe('admin@example.com');
});