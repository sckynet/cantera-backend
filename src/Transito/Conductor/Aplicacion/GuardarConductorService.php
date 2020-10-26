<?php

namespace Cantera\Transito\Conductor\Aplicacion;

use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Conductor\Dominio\ConductorIdentificacion;
use Cantera\Transito\Conductor\Dominio\ConductorNombre;
use Cantera\Transito\Conductor\Dominio\CondutorTelefono;
use Cantera\Transito\Conductor\Dominio\IConductorRepository;
use Cantera\Transito\Shared\Dominio\IUnitOfWork;
use Exception;

class GuardarConductorService
{
    private $repository;
    private $unitOfWork;

    public function __construct(IConductorRepository $repository,IUnitOfWork $unitOfWork)
    {
        $this->repository = $repository;
        $this->unitOfWork = $unitOfWork;
    }

    public function __invoke(ConductorRequest $request): GuardarConductorResponse
    {
        try {
            $this->unitOfWork->beginTransaction();
            $conductor = new Conductor(new ConductorIdentificacion($request->getIdentificacion()), new ConductorNombre($request->getNombre()), new CondutorTelefono($request->getTelefono()));
            $this->repository->save($conductor);
            $this->unitOfWork->commit();
            return new GuardarConductorResponse(sprintf('El conductor %s con identificacion %s se ha guardado correctamente', $request->getNombre(), $request->getIdentificacion()));
        }catch (Exception $exception){
            $this->unitOfWork->rollback();
            return new GuardarConductorResponse(sprintf('El conductor %s con identificacion %s no pudo ser almacenado, intente más tarde. Error: %s', $request->getNombre(), $request->getIdentificacion(),$exception->getMessage()));
        }

    }

}
