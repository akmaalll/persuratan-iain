<?php

use App\Http\Controllers\Admin\ArsipSuratController;
use App\Http\Controllers\Admin\CariArsipController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataKlasifikasiController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NoSuratController;
use App\Http\Controllers\Admin\SuratMasukController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SuratKeluarController;
use App\Http\Controllers\Admin\UserMenuController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\LoginController as Auths;
use App\Models\NoSurat;
use Illuminate\Support\Facades\Redirect;

// Route::get('suratmasuk', SuratMasuk::class);

// Route::get('/', function () {
//     return view('app.welcome');
// });

// Auth::routes();

// Route::resource('photos', PhotoController::class)->except(['create', 'store', 'update', 'destroy']);
// Route::resource('photos', PhotoController::class)->only(['index', 'show']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
// Route::get('/', [DashboardController::class, 'home'])->name('index');
Route::get('/data', [DashboardController::class, 'data'])->name('index.data');


Route::domain('')->group(function () {
    // Auth::routes();

    Route::get('/auth/login', [Auths::class, 'index'])->name('admin.login');
    Route::post('/auth/login', [Auths::class, 'login'])->name('login');
    Route::get('/auth/reset', [Auths::class, 'reset'])->name('reset');
    Route::post('/auth/reset', [Auths::class, 'reset_password'])->name('reset.password');

    Route::get('/logout', [Auths::class, 'logout'])->middleware('auth')->name('logout');


    // ADMIN_ROUTES
    Route::group(['prefix' => 'admin',   'middleware' => ['web', 'auth']], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin');
        Route::get('/get-indikator-kinerja/{id}', [DashboardController::class, 'getIndikatorKinerja']);


        # APPS 
        Route::group(['prefix' => '/surat-masuk'], function () {
            Route::get('/', [SuratMasukController::class, 'index'])->name('surat-masuk.index');
            Route::get('/detail/{id}', [SuratMasukController::class, 'detail'])->name('surat-masuk.detail');
            Route::get('/data', [SuratMasukController::class, 'data'])->name('surat-masuk.data');
            Route::get('/create', [SuratMasukController::class, 'create'])->name('surat-masuk.create');
            Route::post('/store', [SuratMasukController::class, 'store'])->name('surat-masuk.store');
            Route::get('/{id}/edit', [SuratMasukController::class, 'edit'])->name('surat-masuk.edit');
            Route::put('/{id}', [SuratMasukController::class, 'update'])->name('surat-masuk.update');
            Route::delete('/{id}', [SuratMasukController::class, 'destroy'])->name('surat-masuk.delete');
            Route::get('/export', [SuratMasukController::class, 'export'])->name('surat-masuk.export');
            Route::get('/cetak', [SuratMasukController::class, 'cetakPdf'])->name('surat-masuk.pdf');
            Route::get('/arsip/{id}', [SuratMasukController::class, 'storeArsip'])->name('surat-masuk.arsip');
        });



        // Arsip surat
        Route::group(['prefix' => '/arsip'], function () {
            Route::get('/', [ArsipSuratController::class, 'index'])->name('arsip.index');
            Route::get('/filter', [ArsipSuratController::class, 'filter'])->name('arsip.filter');
            Route::get('/detail/{id}', [ArsipSuratController::class, 'detail'])->name('arsip.detail');
            Route::get('/data', [ArsipSuratController::class, 'data'])->name('arsip.data');
            Route::get('/dashboard/data', [ArsipSuratController::class, 'dataDashboard'])->name('arsip.data.dashboard');
            Route::get('/dashboard/cetak', [ArsipSuratController::class, 'cetakPdf'])->name('arsip.data.pdf');
            Route::get('/dashboard/export', [ArsipSuratController::class, 'export'])->name('arsip.data.export');
            Route::get('/create', [ArsipSuratController::class, 'create'])->name('arsip.create');
            Route::post('/store', [ArsipSuratController::class, 'store'])->name('arsip.store');
            Route::get('/{id}/edit', [ArsipSuratController::class, 'edit'])->name('arsip.edit');
            Route::put('/{id}', [ArsipSuratController::class, 'update'])->name('arsip.update');
            Route::delete('/{id}', [ArsipSuratController::class, 'destroy'])->name('arsip.delete');
        });

        // Pencarian arsip surat
        Route::group(['prefix' => '/cari-arsip'], function () {
            Route::get('/', [CariArsipController::class, 'index'])->name('cari-arsip.index');
            Route::get('/filter', [CariArsipController::class, 'filter'])->name('cari-arsip.filter');
            Route::get('/detail/{id}', [CariArsipController::class, 'detail'])->name('cari-arsip.detail');
            Route::get('/data', [CariArsipController::class, 'data'])->name('cari-arsip.data');
            Route::get('/dashboard/data', [CariArsipController::class, 'dataDashboard'])->name('cari-arsip.data.dashboard');
            Route::get('/cetak', [CariArsipController::class, 'cetakPdf'])->name('cari-arsip.data.pdf');
            Route::get('/export', [CariArsipController::class, 'export'])->name('cari-arsip.data.export');
            Route::get('/create', [CariArsipController::class, 'create'])->name('cari-arsip.create');
            Route::post('/store', [CariArsipController::class, 'store'])->name('cari-arsip.store');
            Route::get('/{id}/edit', [CariArsipController::class, 'edit'])->name('cari-arsip.edit');
            Route::put('/{id}', [CariArsipController::class, 'update'])->name('cari-arsip.update');
            Route::delete('/{id}', [CariArsipController::class, 'destroy'])->name('cari-arsip.delete');
        });



        Route::group(['prefix' => '/surat-keluar'], function () {
            // Route::get('/', SuratKeluar::class);
            Route::get('/', [SuratKeluarController::class, 'index'])->name('surat-keluar.index');
            Route::get('/detail/{id}', [SuratKeluarController::class, 'detail'])->name('surat-keluar.detail');
            Route::get('/data', [SuratKeluarController::class, 'data'])->name('surat-keluar.data');
            Route::get('/create', [SuratKeluarController::class, 'create'])->name('surat-keluar.create');
            Route::post('/store', [SuratKeluarController::class, 'store'])->name('surat-keluar.store');
            Route::get('/{id}/edit', [SuratKeluarController::class, 'edit'])->name('surat-keluar.edit');
            Route::put('/{id}', [SuratKeluarController::class, 'update'])->name('surat-keluar.update');
            Route::delete('/{id}', [SuratKeluarController::class, 'destroy'])->name('surat-keluar.delete');
            Route::get('/export', [SuratKeluarController::class, 'export'])->name('surat-keluar.export');
            Route::get('/cetak', [SuratKeluarController::class, 'cetakPdf'])->name('surat-keluar.pdf');
            Route::post('/last-number', [SuratKeluarController::class, 'getLastNumber'])->name('surat-keluar.last-number');
            Route::get('/arsip/{id}', [SuratKeluarController::class, 'storeArsip'])->name('surat-keluar.arsip');
            Route::post('/get-no-surat-data', [SuratKeluarController::class, 'getNoSuratData'])->name('get.no.surat.data');

        });

        // Log aktivitas
        Route::group(['prefix' => '/log-aktivitas'], function () {
            Route::get('/', [LogAktivitasController::class, 'index'])->name('log-aktivitas.index');
            Route::get('/data', [LogAktivitasController::class, 'data'])->name('log-aktivitas.data');
            Route::get('/create', [LogAktivitasController::class, 'create'])->name('log-aktivitas.create');
            Route::post('/store', [LogAktivitasController::class, 'store'])->name('log-aktivitas.store');
            Route::get('/{id}/edit', [LogAktivitasController::class, 'edit'])->name('log-aktivitas.edit');
            Route::put('/{id}', [LogAktivitasController::class, 'update'])->name('log-aktivitas.update');
            Route::delete('/{id}', [LogAktivitasController::class, 'destroy'])->name('log-aktivitas.delete');
        });

        // Data klasifikasi
        Route::group(['prefix' => '/data-klasifikasi'], function () {
            Route::get('/', [DataKlasifikasiController::class, 'index'])->name('data-klasifikasi.index');
            Route::get('/data', [DataKlasifikasiController::class, 'data'])->name('data-klasifikasi.data');
            Route::get('/create', [DataKlasifikasiController::class, 'create'])->name('data-klasifikasi.create');
            Route::post('/store', [DataKlasifikasiController::class, 'store'])->name('data-klasifikasi.store');
            Route::get('/{id}/edit', [DataKlasifikasiController::class, 'edit'])->name('data-klasifikasi.edit');
            Route::put('/{id}', [DataKlasifikasiController::class, 'update'])->name('data-klasifikasi.update');
            Route::delete('/{id}', [DataKlasifikasiController::class, 'destroy'])->name('data-klasifikasi.delete');
        });

        //no-surat
        Route::group(['prefix' => '/no-surat'], function () {
            Route::get('/', [NoSuratController::class, 'index'])->name('no-surat.index');
            Route::get('/data', [NoSuratController::class, 'data'])->name('no-surat.data');
            Route::get('/create', [NoSuratController::class, 'create'])->name('no-surat.create');
            Route::post('/store', [NoSuratController::class, 'store'])->name('no-surat.store');
            Route::get('/{id}/edit', [NoSuratController::class, 'edit'])->name('no-surat.edit');
            Route::put('/{id}', [NoSuratController::class, 'update'])->name('no-surat.update');
            Route::delete('/{id}', [NoSuratController::class, 'destroy'])->name('no-surat.delete');
            Route::post('/last-number', [NoSuratController::class, 'getLastNumber'])->name('no-surat.last-number');
        });

        # USER SETTING
        Route::group(['prefix' => '/roles'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/data', [RoleController::class, 'data'])->name('roles.data');
            Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/{id}', [RoleController::class, 'update'])->name('roles.update');
            Route::delete('/{id}', [RoleController::class, 'destroy'])->name('roles.delete');
        });

        Route::group(['prefix' => '/menus'], function () {
            Route::get('/', [MenuController::class, 'index'])->name('menus.index');
            Route::get('/data', [MenuController::class, 'data'])->name('menus.data');
            Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
            Route::post('/store', [MenuController::class, 'store'])->name('menus.store');
            Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
            Route::put('/{id}', [MenuController::class, 'update'])->name('menus.update');
            Route::delete('/{id}', [MenuController::class, 'destroy'])->name('menus.delete');
        });


        Route::group(['prefix' => '/user-menus'], function () {
            Route::get('/', [UserMenuController::class, 'index'])->name('user-menus.index');
            Route::get('/data', [UserMenuController::class, 'data'])->name('user-menus.data');
            Route::post('/store', [UserMenuController::class, 'store'])->name('user-menus.store');
            Route::get('/{id}/edit', [UserMenuController::class, 'edit'])->name('user-menus.edit');
            Route::get('/{id}/show', [UserMenuController::class, 'show'])->name('user-menus.show');
            Route::delete('/{id}', [UserMenuController::class, 'destroy'])->name('user-menus.delete');
        });
        Route::get('user-menus/create/{id}', [UserMenuController::class, 'create'])->name('user-menus.create');


        Route::group(['prefix' => '/users'], function () {
            Route::get('/', [UsersController::class, 'index'])->name('users.index');
            Route::get('/data', [UsersController::class, 'data'])->name('users.data');
            Route::get('/create', [UsersController::class, 'create'])->name('users.create');
            Route::post('/store', [UsersController::class, 'store'])->name('users.store');
            Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
            Route::put('/{id}', [UsersController::class, 'update'])->name('users.update');
            Route::delete('/{id}', [UsersController::class, 'destroy'])->name('users.delete');
            Route::get('/profile/{id}', [UsersController::class, 'profile'])->name('users.profile');
        });
    });
});
