<?php

namespace App\Providers;

use Cantera\Transito\Material\Dominio\IMaterialRepository;
use Cantera\Transito\Material\Infraestructura\MaterialEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            IMaterialRepository::class,
            MaterialEloquentRepository::class
        );
    }

    public function boot()
    {
        //
    }
}
