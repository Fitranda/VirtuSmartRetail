<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\StokOpnameController;
use App\Http\Controllers\ProdukController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('forgot-password/change-password', [ForgotPasswordController::class, 'showChangePasswordForm'])->name('ganti-password');
    Route::post('forgot-password/change-password', [ForgotPasswordController::class, 'changePassword'])->name("ubah-password");
    Route::resource('akuns', AkunController::class);
    Route::resource('stokopnames', StokOpnameController::class);
    Route::resource('produks', ProdukController::class);

    // Add more routes that require authentication here
});
