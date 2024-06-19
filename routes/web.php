<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PembayaranController;
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
        Route::get('/admin/laporan/santri', [SantriController::class, 'report'])->name('admin.laporan.santri');
        Route::get('/admin/laporan/wali-santri', [WaliSantriController::class, 'report'])->name('admin.laporan.wali-santri');
    });

    Route::middleware('roles:bendahara')->group(function() {
        Route::get('/bendahara/dashboard', function() {
            return view('pages.bendahara.dashboard');
        })->name('bendahara.dashboard');

        Route::get('/bendahara/keuangan-masuk', function() {
            return view('pages.bendahara.keuangan-masuk');
        })->name('bendahara.keuangan-masuk');

        Route::resource('/bendahara/keuangan-masuk/pembayaran', PembayaranController::class)->names([
            'index' => 'bendahara.keuangan-masuk.pembayaran'
        ]);

        Route::get('/bendahara/keuangan-masuk/riwayat', function() {
            return view('pages.bendahara.riwayat-pembayaran');
        })->name('bendahara.keuangan-masuk.riwayat');

        Route::get('/bendahara/keuangan-keluar', function() {
            return view('pages.bendahara.keuangan-keluar');
        })->name('bendahara.keuangan-keluar');

        Route::get('/bendahara/cicilan/pembayaran', function() {
            return view('pages.bendahara.cicilan');
        })->name('bendahara.cicilan.pembayaran');

        Route::get('/bendahara/iuran/rekapitulasi', function() {
            return view('pages.bendahara.rekapitulasi');
        })->name('bendahara.iuran.rekapitulasi');

        Route::get('/bendahara/laporan/keuangan-masuk', function() {
            return view('pages.bendahara.laporan-keuangan-masuk');
        })->name('bendahara.laporan.keuangan-masuk');

        Route::get('/bendahara/laporan/keuangan-keluar', function() {
            return view('pages.bendahara.laporan-keuangan-keluar');
        })->name('bendahara.laporan.keuangan-keluar');

    });

    Route::middleware('roles:walisantri')->group(function() {
        Route::get('/wali-santri/dashboard', function() {
            return view('pages.walisantri.dashboard');
        })->name('walisantri.dashboard');

        Route::get('/wali-santri/rekapitulasi/santri', function() {
            return view('pages.walisantri.rekapitulasi');
        })->name('walisantri.rekapitulasi.santri');

        Route::get('/wali-santri/pembayaran/riwayat', function() {
            return view('pages.walisantri.riwayat-pembayaran');
        })->name('walisantri.pembayaran.riwayat');
    });

    Route::middleware('roles:kepalapondok')->group(function() {
        Route::get('/kepala-pondok/dashboard', function() {
            return view('pages.kepala-pondok.dashboard');
        })->name('kepalapondok.dashboard');

        Route::get('/kepala-pondok/laporan/keuangan-masuk', function() {
            return view('pages.kepala-pondok.laporan-keuangan-masuk');
        })->name('kepalapondok.laporan.keuangan-masuk');

        Route::get('/kepala-pondok/laporan/keuangan-keluar', function() {
            return view('pages.kepala-pondok.laporan-keuangan-keluar');
        })->name('kepalapondok.laporan.keuangan-keluar');
    });

    Route::post('/user/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::fallback(function() {
    return view('pages.fallback.404');
});