<?php


namespace Cantera\Transito\Cliente\Infraestructura\Persistencia;


use Cantera\Transito\Cliente\Dominio\Cliente;
use Cantera\Transito\Cliente\Dominio\IClienteRepository;
use Cantera\Transito\Cliente\Infraestructura\Persistencia\Eloquent\ClienteModel;

class ClienteEloquentRepository implements IClienteRepository
{
    private $model;
    public function __construct()
    {
        $this->model=new ClienteModel();
    }

    public function save(Cliente $cliente): void
    {
        $this->model->fill($cliente->toArray());
        $this->model->save();
    }

}
