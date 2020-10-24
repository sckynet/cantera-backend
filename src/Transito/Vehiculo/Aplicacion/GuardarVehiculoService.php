<?php


namespace Cantera\Transito\Vehiculo\Aplicacion;


use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Vehiculo\Dominio\IVehiculoRepository;
use Cantera\Transito\Vehiculo\Dominio\Vehiculo;
use Cantera\Transito\Vehiculo\Dominio\VehiculoCapacidad;
use Cantera\Transito\Vehiculo\Dominio\VehiculoId;
use Cantera\Transito\Vehiculo\Dominio\VehiculoPlaca;
use Cantera\Transito\Vehiculo\Dominio\VehiculoTipo;

class GuardarVehiculoService
{
    private $repository;

    public function __construct(IVehiculoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(VehiculoRequest $request): GuardarVehiculoResponse
    {
        $conductor= new Conductor();
        $vehiculo= new Vehiculo(new VehiculoId($request->getId()),new VehiculoPlaca($request->getPlaca()),new VehiculoCapacidad($request->getCapacidad()),new VehiculoTipo($request->getTipo()),$conductor);

    }

}
