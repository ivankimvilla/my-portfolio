<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AccountSettingsController;
use App\Http\Controllers\Admin\CvController;
use App\Http\Controllers\Admin\WorkController as AdminWorkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicWorkController;
use App\Models\Cv;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about', static fn () => view('pages.about', [
	'cvAvailable' => Cv::query()->exists(),
]))->name('about');
Route::get('/cv/view', static function () {
	$cv = Cv::query()->first();
	abort_unless($cv, 404);

	return response($cv->file_blob, 200, [
		'Content-Type' => $cv->mime_type,
		'Content-Disposition' => 'inline; filename=Ivan-Kim-Almadin-CV.pdf',
	]);
})->name('cv.view');
Route::get('/cv/download', static function () {
	$cv = Cv::query()->first();
	abort_unless($cv, 404);

	return response($cv->file_blob, 200, [
		'Content-Type' => $cv->mime_type,
		'Content-Disposition' => 'attachment; filename=Ivan-Kim-Almadin-CV.pdf',
	]);
})->name('cv.download');
Route::get('/works', [PublicWorkController::class, 'index'])->name('works');
Route::get('/works/{work}/image', [PublicWorkController::class, 'image'])->name('works.image');
Route::get('/works/{work}/images/{galleryImage}', [PublicWorkController::class, 'galleryImage'])->name('works.gallery-image');
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
	Route::get('/admin/cv', [CvController::class, 'edit'])->name('admin.cv.edit');
	Route::put('/admin/cv', [CvController::class, 'update'])->name('admin.cv.update');
	Route::resource('/admin/works', AdminWorkController::class)
		->except(['show'])
		->names('admin.works');
	Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');
});
