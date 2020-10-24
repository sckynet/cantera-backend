<?php


namespace Cantera\Transito\Vehiculo\Aplicacion;


use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Conductor\Dominio\ConductorId;
use Cantera\Transito\Conductor\Dominio\ConductorIdentificacion;
use Cantera\Transito\Conductor\Dominio\ConductorNombre;
use Cantera\Transito\Conductor\Dominio\CondutorTelefono;
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
        $conductor = new Conductor(new ConductorId(1),new ConductorIdentificacion('123456789'),new ConductorNombre('CAMILO'),new CondutorTelefono('3187545196'));
        $vehiculo = new Vehiculo(new VehiculoId($request->getId()), new VehiculoPlaca($request->getPlaca()), new VehiculoCapacidad($request->getCapacidad()), new VehiculoTipo($request->getTipo()), $conductor);
        $this->repository->save($vehiculo);
        //$mensaje = 'El Vehiculo ABC-806 se guardo satisfactoriamente';
        //return new GuardarVehiculoResponse($mensaje);
        return new GuardarVehiculoResponse(sprintf('El Vehiculo %s se guardo satisfactoriamente', $request->getPlaca()));
    }

}
