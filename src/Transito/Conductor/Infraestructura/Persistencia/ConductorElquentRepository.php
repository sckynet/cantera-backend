<?php

namespace Cantera\Transito\Conductor\Infraestructura;

use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Conductor\Dominio\ConductorIdentificacion;
use Cantera\Transito\Conductor\Dominio\IConductorRepository;
use Cantera\Transito\Conductor\Infraestructura\Persistencia\Eloquent\ConductorModel;

class ConductorElquentRepository implements IConductorRepository
{

    private $model;

    public function __construct()
    {
        $this->model = new ConductorModel();
    }

    public function save(Conductor $conductor): void
    {
       $this->model->fill($conductor->toArray());
       $this->model->save();
    }

    public function search(ConductorIdentificacion $identificacion): ?Conductor
    {
        $conductor = ConductorModel::where('identificacion',$identificacion->value())->first();
        return $conductor;
    }

}
