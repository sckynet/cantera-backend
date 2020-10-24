<?php

namespace Cantera\Transito\Conductor\Aplicacion;

use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Conductor\Dominio\ConductorIdentificacion;
use Cantera\Transito\Conductor\Dominio\ConductorNombre;
use Cantera\Transito\Conductor\Dominio\CondutorTelefono;
use Cantera\Transito\Conductor\Dominio\IConductorRepository;

class GuardarConductorService
{
     private $repository;

     public function __construct(IConductorRepository $repository)
     {
         $this->repository = $repository;
     }

     public function __invoke(ConductorRequest $request) : GuardarConductorResponse
     {
            $conductor = new Conductor(new ConductorIdentificacion($request->getIdentificacion()),
                                  new ConductorNombre($request->getNombre()),
                                  new CondutorTelefono($request->getTelefono()));

            $this->repository->save($conductor);

            return new GuardarConductorResponse(sprintf('El conductor %s con identificacion %s se ha guardado correctamente',$request->getNombre(),$request->getIdentificacion()));

     }

}
