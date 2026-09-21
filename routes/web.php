<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\InquiryController;
use App\Models\User;
use Illuminate\Http\Request;

// Redirect /login to admin login
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    $admin = User::where('is_admin', true)->first();
    return view('pages.about', ['admin' => $admin]);
})->name('about');
// Resume download (public)
Route::get('/resume/download', [ResumeController::class, 'download'])->name('resume.download');
Route::get('/skills', function () {
    $admin = User::where('is_admin', true)->first();
    return view('pages.skills', ['admin' => $admin]);
})->name('skills');
Route::get('/experience', function () {
    $admin = User::where('is_admin', true)->first();
    return view('pages.experience', ['admin' => $admin]);
})->name('experience');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{project}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/contact', fn () => view('pages.contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return auth()->check()
            ? redirect()->route('admin.projects.index')
            : redirect()->route('admin.login');
    })->name('dashboard');

    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.perform');
    Route::get('login/confirm', [AuthController::class, 'confirmLogin'])->name('login.confirm')->middleware('signed');

    Route::get('forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
    Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('send-reset-link');

    Route::get('reset-password', function (Request $request) {
        if ($token = $request->query('token')) {
            return redirect()->route('admin.reset-password', [
                'token' => $token,
                'email' => $request->query('email'),
            ]);
        }

        return redirect()->route('admin.forgot-password')
            ->withErrors(['email' => 'Password reset link is invalid or expired. Please request a new link.']);
    });

    Route::get('reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('reset-password');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('reset-password.perform');

    Route::get('recovery', [AuthController::class, 'showRecovery'])->name('recovery');
    Route::post('recovery', [AuthController::class, 'sendRecoveryLink'])->name('send-recovery-link');

    Route::middleware('auth')->group(function () {
        Route::get('profile', [AuthController::class, 'showProfile'])->name('profile');
        Route::get('profile/skills', [AuthController::class, 'showSkills'])->name('profile.skills');
        Route::get('profile/stats', [AuthController::class, 'showStats'])->name('profile.stats');
        Route::put('profile', [AuthController::class, 'updateProfile'])->name('profile.update');
        Route::put('profile/skills', [AuthController::class, 'updateSkills'])->name('profile.skills.update');
        Route::put('profile/stats', [AuthController::class, 'updateStats'])->name('profile.stats.update');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::resource('projects', ProjectController::class);
        Route::resource('services', AdminServiceController::class);
        Route::resource('certificates', CertificateController::class);
        Route::post('inquiries/bulk-delete', [InquiryController::class, 'bulkDelete'])->name('inquiries.bulk-delete');
        Route::resource('inquiries', InquiryController::class)->only(['index', 'show', 'destroy']);
        Route::put('inquiries/{inquiry}/mark-responded', [InquiryController::class, 'markResponded'])->name('inquiries.mark-responded');
        // Resume management (admin)
        Route::get('resume', fn() => view('admin.resume'))->name('resume.index');
        Route::post('resume/upload', [\App\Http\Controllers\ResumeController::class, 'upload'])->name('resume.upload');
    });
});
