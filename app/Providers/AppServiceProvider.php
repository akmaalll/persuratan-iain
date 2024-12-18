<?php

namespace App\Providers;

use App\Http\Services\Repositories\ArsipSuratRepository;
use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\CariArsipRepository;
use App\Http\Services\Repositories\Contracts\ArsipSuratContract;
use App\Http\Services\Repositories\Contracts\BaseContract;
use App\Http\Services\Repositories\Contracts\CariArsipContract;
use App\Http\Services\Repositories\Contracts\DataKlasifikasiContract;
use App\Http\Services\Repositories\Contracts\LogAktivitasContract;
use App\Http\Services\Repositories\Contracts\MenuContract;
use App\Http\Services\Repositories\Contracts\NoSuratContract;
use App\Http\Services\Repositories\Contracts\PostContract;
use App\Http\Services\Repositories\Contracts\RoleContract;
use App\Http\Services\Repositories\Contracts\SuratKeluarContract;
use App\Http\Services\Repositories\Contracts\SuratMasukContract;
use App\Http\Services\Repositories\Contracts\UserMenuContract;
use App\Http\Services\Repositories\Contracts\UsersContract;
use App\Http\Services\Repositories\DataKlasifikasiRepository;
use App\Http\Services\Repositories\LogAktivitasRepository;
use App\Http\Services\Repositories\MenuRepository;
use App\Http\Services\Repositories\NoSuratRepository;
use App\Http\Services\Repositories\PostRepository;
use App\Http\Services\Repositories\RoleRepository;
use App\Http\Services\Repositories\SuratKeluarRepository;
use App\Http\Services\Repositories\SuratMasukRepository;
use App\Http\Services\Repositories\UserMenuRepository;
use App\Http\Services\Repositories\UsersRepository;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(BaseContract::class, BaseRepository::class);

        $this->app->bind(SuratMasukContract::class, SuratMasukRepository::class);
        $this->app->bind(SuratKeluarContract::class, SuratKeluarRepository::class);
        $this->app->bind(ArsipSuratContract::class, ArsipSuratRepository::class);
        $this->app->bind(PostContract::class, PostRepository::class);

        $this->app->bind(MenuContract::class, MenuRepository::class);
        $this->app->bind(RoleContract::class, RoleRepository::class);
        $this->app->bind(UserMenuContract::class, UserMenuRepository::class);
        $this->app->bind(UsersContract::class, UsersRepository::class);
        $this->app->bind(LogAktivitasContract::class, LogAktivitasRepository::class);
        $this->app->bind(DataKlasifikasiContract::class, DataKlasifikasiRepository::class);
        $this->app->bind(CariArsipContract::class, CariArsipRepository::class);
        $this->app->bind(NoSuratContract::class, NoSuratRepository::class);

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }
}
