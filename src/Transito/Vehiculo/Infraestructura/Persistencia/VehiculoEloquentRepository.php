<?php


namespace Cantera\Transito\Vehiculo\Infraestructura\Persistencia;


use Cantera\Transito\Vehiculo\Dominio\IVehiculoRepository;
use Cantera\Transito\Vehiculo\Dominio\Vehiculo;
use Cantera\Transito\Vehiculo\Infraestructura\Persistencia\Eloquent\VehiculoModel;

class VehiculoEloquentRepository implements IVehiculoRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new VehiculoModel();
    }

    public function save(Vehiculo $vehiculo): void
    {
        $this->model->fill($vehiculo->toArray());

        $this->model->save();

    }


}
