<?php

use App\Http\Controllers\Admin\ApprovalRhkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IndikatorKinerjaController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\RencanaHasilKerjaController;
use App\Http\Controllers\Admin\RencanaKerjaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserMenuController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\LoginController as Auths;
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

        Route::get('/', [DashboardController::class, 'index'])->name('admin');
        Route::get('/get-indikator-kinerja/{id}', [DashboardController::class, 'getIndikatorKinerja']);


        # APPS 
        Route::group(['prefix' => '/rencana-hasil-kerja'], function () {
            Route::get('/', [RencanaHasilKerjaController::class, 'index'])->name('rencana-hasil-kerja.index');
            Route::get('/data', [RencanaHasilKerjaController::class, 'data'])->name('rencana-hasil-kerja.data');
            Route::get('/create', [RencanaHasilKerjaController::class, 'create'])->name('rencana-hasil-kerja.create');
            Route::post('/store', [RencanaHasilKerjaController::class, 'store'])->name('rencana-hasil-kerja.store');
            Route::get('/{id}/edit', [RencanaHasilKerjaController::class, 'edit'])->name('rencana-hasil-kerja.edit');
            Route::put('/{id}', [RencanaHasilKerjaController::class, 'update'])->name('rencana-hasil-kerja.update');
            Route::patch('/{id}', [RencanaHasilKerjaController::class, 'destroy'])->name('rencana-hasil-kerja.delete');
            Route::get('/export', [RencanaHasilKerjaController::class, 'export'])->name('rencana-hasil-kerja.export');
        });

        Route::group(['prefix' => '/approval-rencana-hasil-kerja'], function () {
            Route::get('/', [ApprovalRhkController::class, 'index'])->name('approval-rencana-hasil-kerja.index');
            Route::get('/data', [ApprovalRhkController::class, 'data'])->name('approval-rencana-hasil-kerja.data');
            Route::get('/create', [ApprovalRhkController::class, 'create'])->name('approval-rencana-hasil-kerja.create');
            Route::post('/store', [ApprovalRhkController::class, 'store'])->name('approval-rencana-hasil-kerja.store');
            Route::get('/{id}/edit', [ApprovalRhkController::class, 'edit'])->name('approval-rencana-hasil-kerja.edit');
            Route::put('/{id}', [ApprovalRhkController::class, 'update'])->name('approval-rencana-hasil-kerja.update');
            Route::patch('/{id}', [ApprovalRhkController::class, 'destroy'])->name('approval-rencana-hasil-kerja.delete');
        });

        # MASTER DATA 
        Route::group(['prefix' => '/rencana-kerja'], function () {
            Route::get('/', [RencanaKerjaController::class, 'index'])->name('rencana-kerja.index');
            Route::get('/data', [RencanaKerjaController::class, 'data'])->name('rencana-kerja.data');
            Route::get('/create', [RencanaKerjaController::class, 'create'])->name('rencana-kerja.create');
            Route::post('/store', [RencanaKerjaController::class, 'store'])->name('rencana-kerja.store');
            Route::get('/{id}/edit', [RencanaKerjaController::class, 'edit'])->name('rencana-kerja.edit');
            Route::put('/{id}', [RencanaKerjaController::class, 'update'])->name('rencana-kerja.update');
            Route::delete('/{id}', [RencanaKerjaController::class, 'destroy'])->name('rencana-kerja.delete');
        });

        Route::group(['prefix' => '/indikator-kinerja'], function () {
            Route::get('/', [IndikatorKinerjaController::class, 'index'])->name('indikator-kinerja.index');
            Route::get('/data', [IndikatorKinerjaController::class, 'data'])->name('indikator-kinerja.data');
            Route::get('/create', [IndikatorKinerjaController::class, 'create'])->name('indikator-kinerja.create');
            Route::post('/store', [IndikatorKinerjaController::class, 'store'])->name('indikator-kinerja.store');
            Route::get('/{id}/edit', [IndikatorKinerjaController::class, 'edit'])->name('indikator-kinerja.edit');
            Route::put('/{id}', [IndikatorKinerjaController::class, 'update'])->name('indikator-kinerja.update');
            Route::delete('/{id}', [IndikatorKinerjaController::class, 'destroy'])->name('indikator-kinerja.delete');
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
