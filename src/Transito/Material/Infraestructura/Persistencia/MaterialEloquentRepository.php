<?php

namespace Cantera\Transito\Material\Infraestructura;

use Cantera\Transito\Material\Dominio\IMaterialRepository;
use Cantera\Transito\Material\Dominio\Material;
use Cantera\Transito\Material\Infraestructura\Persistencia\Eloquent\MaterialModel;

final class MaterialEloquentRepository implements IMaterialRepository
{

    private $model;

    public function __construct()
    {
        $this->model = new MaterialModel();
    }

    public function save(Material $material) : void
    {
        $this->model->fill($material->toArray());
        $this->model->save();
    }
}
