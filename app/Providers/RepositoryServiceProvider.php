<?php

namespace App\Providers;

use App\Repository\EloquentRepositoryInterface; 
use App\Repository\Eloquent\BaseRepository;
use App\Repository\TemperatureRepositoryInterface; 
use App\Repository\Eloquent\TemperatureRepository; 
use App\Repository\CityRepositoryInterface; 
use App\Repository\Eloquent\CityRepository; 
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
       $this->app->bind(TemperatureRepositoryInterface::class, TemperatureRepository::class);
       $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
