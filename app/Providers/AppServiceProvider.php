<?php

namespace App\Providers;

use App\Repositories\Api\AdzanRepository as ApiAdzanRepository;
use App\Repositories\Api\AuthRepository as ApiAuthRepository;
use App\Repositories\Api\AyatRepository as ApiAyatRepository;
use App\Repositories\Api\SuratRepository as ApiSuratRepository;
use App\Repositories\Api\TafsirRepository as ApiTafsirRepository;
use App\Repositories\AyatRepository;
use App\Repositories\HomeRepository;
use App\Repositories\SuratRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('repository.api.auth', ApiAuthRepository::class);
        $this->app->bind('repository.api.surat', ApiSuratRepository::class);
        $this->app->bind('repository.api.ayat', ApiAyatRepository::class);
        $this->app->bind('repository.api.tafsir', ApiTafsirRepository::class);
        $this->app->bind('repository.api.adzan', ApiAdzanRepository::class);

        $this->app->bind('repository.surat', SuratRepository::class);
        $this->app->bind('repository.ayat', AyatRepository::class);
        $this->app->bind('repository.home', HomeRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
