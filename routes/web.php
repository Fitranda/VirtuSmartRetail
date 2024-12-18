<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\StokOpnameController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ManageAbsensiController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StokRequestController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\JurnalController;





Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/ganti-password', [UserController::class, 'changePasswordForm'])->name('ganti-password');
Route::post('/ganti-password', [UserController::class, 'updatePassword'])->name('update-password');

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

    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('/karyawan/{id}/update', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');

    Route::get('/pelanggan', [PelangganController::class, 'data'])->name('pelanggan.data');
    Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    Route::resource('shift', ShiftController::class);
    Route::resource('shift', ShiftController::class);

    Route::get('/shift', [ShiftController::class, 'index'])->name('shift.index');
    Route::get('/shift/create', [ShiftController::class, 'create'])->name('shift.create');
    Route::post('/shift', [ShiftController::class, 'store'])->name('shift.store');
    Route::get('/shift/{id}/edit', [ShiftController::class, 'edit'])->name('shift.edit');
    Route::put('/shift/{id}/update', [ShiftController::class, 'update'])->name('shift.update');
    Route::delete('/shift/{shift}', [ShiftController::class, 'destroy'])->name('shift.destroy');

    Route::resource('pos', PosController::class);
    Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
    Route::get('/pos/create', [POSController::class, 'create'])->name('pos.create');
    Route::get('/pos/{id}/edit', [POSController::class, 'edit'])->name('pos.edit');
    Route::get('/pos/{id}/update', [POSController::class, 'create'])->name('pos.edit');
    Route::post('/pos', [POSController::class, 'store'])->name('pos.store');
    Route::get('/pos/result/{id}', [POSController::class, 'result'])->name('pos.result');
    Route::get('/pos/struk/{id}', [POSController::class, 'cetakStruk'])->name('pos.struk');
    Route::delete('/pos/{id}', [POSController::class, 'destroy'])->name('pos.destroy');

    Route::resource('absensi', AbsensiController::class);
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/{id}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
    Route::put('/absensi/{id}', [AbsensiController::class, 'update'])->name('absensi.update');
    Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');

    Route::prefix('manage-absensi')->name('manageAbsensi.')->middleware('auth')->group(function () {
        Route::get('/', [ManageAbsensiController::class, 'index'])->name('index');
        Route::get('edit/{tanggal}', [ManageAbsensiController::class, 'edit'])->name('edit');
        Route::put('update/{tanggal}', [ManageAbsensiController::class, 'update'])->name('update');
        Route::delete('destroy/{tanggal}', [ManageAbsensiController::class, 'destroy'])->name('destroy');
    });

    Route::get('/stokrequests', [StokRequestController::class, 'index'])->name('stokrequests.index');
    Route::get('/stokrequests/create', [StokRequestController::class, 'create'])->name('stokrequests.create');
    Route::post('/stokrequests', [StokRequestController::class, 'store'])->name('stokrequests.store');
    Route::get('/stokrequests/{id}/edit', [StokRequestController::class, 'edit'])->name('stokrequests.edit');
    Route::put('/stokrequests/{id}', [StokRequestController::class, 'update'])->name('stokrequests.update');
    Route::delete('/stokrequests/{id}', [StokRequestController::class, 'destroy'])->name('stokrequests.destroy');

    Route::get('/pembelian', [PembelianController::class, 'create'])->name('beli');
    Route::post('/add-to-session', [PembelianController::class, 'addToSession'])->name('add.to.session');
    Route::post('/remove-from-session', [PembelianController::class, 'removeFromSession'])->name('remove.from.session');
    Route::post('/editsession', [PembelianController::class, 'editSession'])->name('ubahcart');
    Route::get('/reset', [PembelianController::class, 'reset'])->name('reset');
    Route::get('/barang', [PembelianController::class, 'pilihproduk'])->name('produk');
    Route::post('/savepembelian', [PembelianController::class, 'beli'])->name('savebeli');

    Route::resource('jurnals', JurnalController::class);


    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::get('/laporan', [LaporanPenjualanController::class, 'index'])->name('laporan.index');
});



