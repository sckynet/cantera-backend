<?php

namespace App\Providers;

use Cantera\Transito\Conductor\Dominio\IConductorRepository;
use Cantera\Transito\Conductor\Infraestructura\ConductorElquentRepository;
use Cantera\Transito\Material\Dominio\IMaterialRepository;
use Cantera\Transito\Material\Infraestructura\MaterialEloquentRepository;
use Cantera\Transito\Vehiculo\Dominio\IVehiculoRepository;
use Cantera\Transito\Vehiculo\Infraestructura\Persistencia\VehiculoEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind( IMaterialRepository::class, MaterialEloquentRepository::class );
        $this->app->bind(IConductorRepository::class,ConductorElquentRepository::class);
        $this->app->bind(
            IVehiculoRepository::class,
            VehiculoEloquentRepository::class
        );
    }

    public function boot()
    {
        //
    }
}
