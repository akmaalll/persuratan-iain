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
use App\Livewire\Auth\Index as Auth;
use App\Livewire\Auth\Login as Login;
use App\Http\Services\Repositories\Contracts\SuratMasukContract;
use App\Livewire\Admin\Dashboard;
use App\Models\RencanaHasilKerja;
use App\Livewire\PostCrud;
use App\Livewire\Admin\SuratMasuk;
use App\Livewire\Admin\SuratMasuk\Index;
use App\Livewire\Admin\SuratKeluar;
use App\Livewire\Admin\Menu;
use App\Livewire\Admin\Role;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\UserMenu;
use App\Livewire\Admin\ArsipSurat;

Route::get('posts', PostCrud::class);
// Route::get('suratmasuk', SuratMasuk::class);

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

    Route::get('/logout', [Auths::class, 'logout'])->middleware('auth')->name('logout');


    // ADMIN_ROUTES
    Route::group(['prefix' => 'admin',   'middleware' => ['web']], function () {

        Route::get('/', Dashboard::class)->name('admin');
        Route::get('/get-indikator-kinerja/{id}', [DashboardController::class, 'getIndikatorKinerja']);


        # APPS 
        Route::group(['prefix' => '/surat-masuk'], function () {
            Route::get('/', SuratMasuk::class);
        });
        Route::group(['prefix' => '/arsip'], function () {
            Route::get('/', ArsipSurat::class);
        });
        Route::group(['prefix' => '/surat-keluar'], function () {
            Route::get('/', SuratKeluar::class)->name('surat-keluar.index');
        });

        # USER SETTING
        Route::group(['prefix' => '/roles'], function () {
            Route::get('/', Role::class);
            // Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            // Route::get('/data', [RoleController::class, 'data'])->name('roles.data');
            // Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
            // Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
            // Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            // Route::put('/{id}', [RoleController::class, 'update'])->name('roles.update');
            // Route::delete('/{id}', [RoleController::class, 'destroy'])->name('roles.delete');
        });

        Route::group(['prefix' => '/menus'], function () {
            Route::get('/', Menu::class);
            // Route::get('/', [MenuController::class, 'index'])->name('menus.index');
            // Route::get('/data', [MenuController::class, 'data'])->name('menus.data');
            // Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
            // Route::post('/store', [MenuController::class, 'store'])->name('menus.store');
            // Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
            // Route::put('/{id}', [MenuController::class, 'update'])->name('menus.update');
            // Route::delete('/{id}', [MenuController::class, 'destroy'])->name('menus.delete');
        });

        Route::group(['prefix' => '/user-menus'], function () {
            Route::get('/', UserMenu::class);
            // Route::get('/', [UserMenuController::class, 'index'])->name('user-menus.index');
            // Route::get('/data', [UserMenuController::class, 'data'])->name('user-menus.data');
            // Route::post('/store', [UserMenuController::class, 'store'])->name('user-menus.store');
            // Route::get('/{id}/edit', [UserMenuController::class, 'edit'])->name('user-menus.edit');
            // Route::get('/{id}/show', [UserMenuController::class, 'show'])->name('user-menus.show');
            // Route::delete('/{id}', [UserMenuController::class, 'destroy'])->name('user-menus.delete');
        });
        Route::get('user-menus/create/{id}', [UserMenuController::class, 'create'])->name('user-menus.create');


        Route::group(['prefix' => '/users'], function () {
            Route::get('/', Users::class);
            // Route::get('/', [UsersController::class, 'index'])->name('users.index');
            // Route::get('/data', [UsersController::class, 'data'])->name('users.data');
            // Route::get('/create', [UsersController::class, 'create'])->name('users.create');
            // Route::post('/store', [UsersController::class, 'store'])->name('users.store');
            // Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
            // Route::put('/{id}', [UsersController::class, 'update'])->name('users.update');
            // Route::delete('/{id}', [UsersController::class, 'destroy'])->name('users.delete');
        });
    });
});
