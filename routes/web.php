<?php

use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/works', 'pages.works')->name('works');
Route::middleware('guest')->group(function () {
	Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('login');
	Route::post('/admin/login', [AdminAuthController::class, 'store'])
		->middleware('throttle:5,1')
		->name('admin.login.submit');
});

Route::middleware(['auth', 'admin'])->group(function () {
	Route::view('/admin', 'admin.admin')->name('admin');
	Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');
});
