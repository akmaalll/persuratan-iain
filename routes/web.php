<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SuratMasukController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SuratKeluarController;
use App\Http\Controllers\Admin\UserMenuController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\LoginController as Auths;
use App\Http\Services\Repositories\Contracts\SuratMasukContract;
use App\Livewire\Admin\Dashboard;
use App\Models\RencanaHasilKerja;
use App\Livewire\PostCrud;

Route::get('posts', PostCrud::class);

// Route::get('/', function () {
//     return view('app.welcome');
// });

// Auth::routes();

// Route::resource('photos', PhotoController::class)->except(['create', 'store', 'update', 'destroy']);
// Route::resource('photos', PhotoController::class)->only(['index', 'show']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [DashboardController::class, 'home'])->name('index');
Route::get('/data', [DashboardController::class, 'data'])->name('index.data');


Route::domain('')->group(function () { // development
    // Route::domain('permohonan.bpfkmakassar.go.id')->group(function () { // production

    // Auth::routes();
    Route::get('/auth/login', [Auths::class, 'index'])->name('admin.login');
    Route::post('/auth/login', [Auths::class, 'login'])->name('login');

    Route::get('/logout', [Auths::class, 'logout'])->middleware('auth');


    // ADMIN_ROUTES
    Route::group(['prefix' => 'admin',   'middleware' => ['web']], function () {

        Route::get('/', Dashboard::class)->name('admin');
        Route::get('/get-indikator-kinerja/{id}', [DashboardController::class, 'getIndikatorKinerja']);


        # APPS 
        Route::group(['prefix' => '/surat-masuk'], function () {
            Route::get('/', [SuratMasukController::class, 'index'])->name('surat-masuk.index');
            Route::get('/data', [SuratMasukController::class, 'data'])->name('surat-masuk.data');
            Route::get('/create', [SuratMasukController::class, 'create'])->name('surat-masuk.create');
            Route::post('/store', [SuratMasukController::class, 'store'])->name('surat-masuk.store');
            Route::get('/{id}/edit', [SuratMasukController::class, 'edit'])->name('surat-masuk.edit');
            Route::put('/{id}', [SuratMasukController::class, 'update'])->name('surat-masuk.update');
            Route::patch('/{id}', [SuratMasukController::class, 'destroy'])->name('surat-masuk.delete');
            Route::get('/export', [SuratMasukController::class, 'export'])->name('surat-masuk.export');
        });

        Route::group(['prefix' => '/surat-keluar'], function () {
            Route::get('/', [SuratKeluarController::class, 'index'])->name('surat-keluar.index');
            Route::get('/data', [SuratKeluarController::class, 'data'])->name('surat-keluar.data');
            Route::get('/create', [SuratKeluarController::class, 'create'])->name('surat-keluar.create');
            Route::post('/store', [SuratKeluarController::class, 'store'])->name('surat-keluar.store');
            Route::get('/{id}/edit', [SuratKeluarController::class, 'edit'])->name('surat-keluar.edit');
            Route::put('/{id}', [SuratKeluarController::class, 'update'])->name('surat-keluar.update');
            Route::patch('/{id}', [SuratKeluarController::class, 'destroy'])->name('surat-keluar.delete');
            Route::get('/export', [SuratKeluarController::class, 'export'])->name('surat-keluar.export');
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
        });
    });
});
