<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\CicilanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\WaliSantriController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\KeuanganMasukController;
use App\Http\Controllers\KeuanganKeluarController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
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
                'create' => 'admin.konfigurasi.users.create',
                'store' => 'admin.konfigurasi.users.store',
                'edit' => 'admin.konfigurasi.users.edit',
            ]
        );
        Route::get('/admin/laporan/santri', [SantriController::class, 'report'])->name('admin.laporan.santri');
        Route::get('/admin/laporan/wali-santri', [WaliSantriController::class, 'report'])->name('admin.laporan.wali-santri');
    });

    Route::middleware('roles:bendahara')->group(function() {
        Route::get('/bendahara/dashboard', [DashboardController::class, 'bendahara'])->name('bendahara.dashboard');

        Route::get('/bendahara/santri/pembayaran', [PembayaranController::class, 'index'])->name('bendahara.santri.pembayaran');
        Route::get('/bendahara/santri/{nis}/pembayaran', [PembayaranController::class, 'create'])->name('bendahara.santri.pembayaran.create');
        Route::post('/bendahara/santri/{nis}/pembayaran', [PembayaranController::class, 'store'])->name('bendahara.santri.pembayaran.store');

        Route::get('/bendahara/keuangan-masuk', [KeuanganMasukController::class, 'index'])->name('bendahara.keuangan-masuk');
        Route::get('/bendahara/keuangan-masuk/{id}/detail', [KeuanganMasukController::class, 'index'])->name('bendahara.keuangan-masuk.detail');
        Route::get('/bendahara/keuangan-masuk/invoice/{id}', [KeuanganMasukController::class, 'show'])->name('bendahara.keuangan-masuk.invoice');
        Route::post('/bendahara/keuangan-masuk/invoice/send', [KeuanganMasukController::class, 'send'])->name('bendahara.keuangan-masuk.invoice.send');

        Route::resource('/bendahara/keuangan-keluar', KeuanganKeluarController::class)->names(
            [
                'index' => 'bendahara.keuangan-keluar',
                'store' => 'bendahara.keuangan-keluar.store',
                'edit' => 'bendahara.keuangan-keluar.edit',
            ]
        );

        Route::get('/bendahara/mutasi', [MutasiController::class, 'index'])->name('bendahara.mutasi');
        Route::get('/bendahara/riwayat/mutasi', [MutasiController::class, 'riwayat'])->name('bendahara.riwayat.mutasi');
        Route::post('/bendahara/mutasi/transfer', [MutasiController::class, 'transfer'])->name('bendahara.mutasi.transfer');

        Route::resource('/bendahara/cicilan/pembayaran', CicilanController::class)->names(
            [
                'index' => 'bendahara.cicilan.pembayaran',
                'create' => 'bendahara.cicilan.pembayaran.create',
                'store' => 'bendahara.cicilan.pembayaran.store',
                'show' => 'bendahara.cicilan.pembayaran.show'
            ]
        );

        Route::get('/bendahara/iuran/rekapitulasi', [RekapitulasiController::class, 'index'])->name('bendahara.iuran.rekapitulasi');

        Route::get('/bendahara/laporan/keuangan-masuk', [KeuanganMasukController::class, 'report'])->name('bendahara.laporan.keuangan-masuk');

        Route::get('/bendahara/laporan/keuangan-keluar', [KeuanganKeluarController::class, 'report'])->name('bendahara.laporan.keuangan-keluar');

    });

    Route::middleware('roles:walisantri')->group(function() {
        Route::get('/wali-santri/dashboard', [DashboardController::class, 'walisantri'])->name('walisantri.dashboard');

        Route::get('/wali-santri/pembayaran/riwayat', [PembayaranController::class, 'riwayat'])->name('walisantri.pembayaran.riwayat');

        Route::get('/wali-santri/rekapitulasi/santri', [RekapitulasiController::class, 'rekapitulasiSantri'])->name('walisantri.rekapitulasi.santri');
    });

    Route::middleware('roles:kepalapondok')->group(function() {
        Route::get('/kepala-pondok/dashboard', [DashboardController::class, 'kepalapondok'])->name('kepalapondok.dashboard');

        Route::get('/kepala-pondok/laporan/keuangan-masuk', [KeuanganMasukController::class, 'reportKepalaPondok'])->name('kepalapondok.laporan.keuangan-masuk');
        Route::delete('/kepala-pondok/keuangan-masuk/{id}', [KeuanganMasukController::class, 'destroy'])->name('kepalapondok.keuangan-masuk.destroy');

        Route::get('/kepala-pondok/laporan/keuangan-keluar', [KeuanganKeluarController::class, 'reportKepalaPondok'])->name('kepalapondok.laporan.keuangan-keluar');
        Route::delete('/kepala-pondok/keuangan-keluar/{id}', [KeuanganKeluarController::class, 'destroy'])->name('kepalapondok.keuangan-keluar.destroy');
    });

    Route::post('/user/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::fallback(function() {
    return view('pages.fallback.404');
});