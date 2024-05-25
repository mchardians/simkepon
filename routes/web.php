<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\WaliSantriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function() {
    Route::get('/user/login', [AuthController::class, 'index'])->name('login');
    Route::post('/user/login', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::get('/admin/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('/admin/santri', SantriController::class)->names(['index' => 'admin.santri']);

    Route::get('/admin/wali-santri', [WaliSantriController::class, 'index'])->name('admin.wali-santri');

    Route::get('/admin/konfigurasi', [UserController::class, 'index'])->name('admin.konfigurasi');

    Route::get('/admin/santri/laporan', function() {
        return view('pages.admin.laporan-santri');
    })->name('admin.santri.laporan');

    Route::get('/admin/wali-santri/laporan', function() {
        return view('pages.admin.laporan-wali-santri');
    })->name('admin.wali-santri.laporan');

    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/user/forgot-password', function() {
    return view('pages.auth.forgot-password');
})->name('auth.forgot-password');
