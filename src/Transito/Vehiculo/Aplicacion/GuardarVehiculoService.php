<?php


namespace Cantera\Transito\Vehiculo\Aplicacion;


use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Conductor\Dominio\ConductorIdentificacion;
use Cantera\Transito\Conductor\Dominio\ConductorNombre;
use Cantera\Transito\Conductor\Dominio\CondutorTelefono;
use Cantera\Transito\Shared\Dominio\IUnitOfWork;
use Cantera\Transito\Vehiculo\Dominio\IVehiculoRepository;
use Cantera\Transito\Vehiculo\Dominio\Vehiculo;
use Cantera\Transito\Vehiculo\Dominio\VehiculoCapacidad;
use Cantera\Transito\Vehiculo\Dominio\VehiculoId;
use Cantera\Transito\Vehiculo\Dominio\VehiculoPlaca;
use Cantera\Transito\Vehiculo\Dominio\VehiculoTipo;
use Exception;

class GuardarVehiculoService
{
    private $repository;
    private $unitOfWork;

    public function __construct(IVehiculoRepository $repository, IUnitOfWork $unitOfWork)
    {
        $this->repository = $repository;
        $this->unitOfWork = $unitOfWork;
    }

    public function __invoke(VehiculoRequest $request): GuardarVehiculoResponse
    {
        try {
            $this->unitOfWork->beginTransaction();
            $conductor = new Conductor(new ConductorIdentificacion('1065848333'), new ConductorNombre('CAMILO'), new CondutorTelefono('3187545196'));
            $vehiculo = new Vehiculo(new VehiculoId($request->getId()), new VehiculoPlaca($request->getPlaca()), new VehiculoCapacidad($request->getCapacidad()), new VehiculoTipo($request->getTipo()), $conductor);
            $this->repository->save($vehiculo);
            $this->unitOfWork->commit();
            return new GuardarVehiculoResponse(sprintf('El Vehiculo %s se guardo satisfactoriamente', $request->getPlaca()));
        } catch (Exception $exception) {
            $this->unitOfWork->rollback();
            return new GuardarVehiculoResponse(sprintf('El Vehiculo %s no pudo ser almacenado, intente más tarde. Error: %s', $request->getPlaca(), $exception->getMessage()));
        }

    }

}
