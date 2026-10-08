<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AccountSettingsController;
use App\Http\Controllers\Admin\WorkController as AdminWorkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicWorkController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::get('/works', [PublicWorkController::class, 'index'])->name('works');
Route::get('/works/{work}/image', [PublicWorkController::class, 'image'])->name('works.image');
Route::get('/works/{work}', [PublicWorkController::class, 'show'])->name('works.show');
Route::middleware('guest')->group(function () {
	Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('login');
	Route::post('/admin/login', [AdminAuthController::class, 'store'])
		->middleware('throttle:5,1')
		->name('admin.login.submit');
});

Route::middleware(['auth', 'admin'])->group(function () {
	Route::get('/admin', [AdminWorkController::class, 'index'])->name('admin');
	Route::get('/admin/account-settings', [AccountSettingsController::class, 'edit'])->name('admin.account-settings.edit');
	Route::put('/admin/account-settings', [AccountSettingsController::class, 'update'])->name('admin.account-settings.update');
	Route::resource('/admin/works', AdminWorkController::class)
		->except(['show'])
		->names('admin.works');
	Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');
});
