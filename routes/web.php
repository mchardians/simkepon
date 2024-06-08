<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KonfigurasiController;
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
    Route::get('/user/forgot-password', function() {
        return view('pages.auth.forgot-password');
    })->name('auth.forgot-password');
});

Route::middleware('auth')->group(function() {
    Route::middleware('roles:admin')->group(function() {
        Route::get('/admin/dashboard', [SantriController::class, 'dashboard'])->name('admin.dashboard');
        Route::resource('/admin/santri', SantriController::class)->names(
            [
                    'index' => 'admin.santri',
                    'show' => 'admin.santri.show',
                    'create' => 'admin.santri.create',
                    'store' => 'admin.santri.store',
                    'edit' => 'admin.santri.edit',
                ]
        );
        Route::resource('/admin/wali-santri', WaliSantriController::class)->names(
     [
                'index' => 'admin.wali-santri',
                'store' => 'admin.wali-santri.store',
                'edit' => 'admin.wali-santri.edit',
            ]
        );
        Route::get('/admin/konfigurasi', [KonfigurasiController::class, 'index'])->name('admin.konfigurasi');
        Route::resource('/admin/konfigurasi/users', UserController::class)->names(
    [
                'index' => 'admin.konfigurasi.users',
                'store' => 'admin.konfigurasi.users.store',
                'edit' => 'admin.konfigurasi.users.edit',
            ]
        );
        Route::get('/admin/laporan/santri', [SantriController::class, 'report'])->name('admin.santri.laporan');
        Route::get('/admin/laporan/wali-santri', function() {
            return view('pages.admin.laporan-wali-santri');
        })->name('admin.wali-santri.laporan');
    });

    Route::middleware('roles:bendahara')->group(function() {

    });

    Route::middleware('roles:walisantri')->group(function() {

    });

    Route::middleware('roles:kepalapondok')->group(function() {

    });

    Route::post('/user/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::fallback(function() {
    return view('pages.fallback.404');
});