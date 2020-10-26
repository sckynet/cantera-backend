<?php

namespace Tests\Unit\Transito\Conductor\Aplicacion;

use Cantera\Transito\Conductor\Aplicacion\BuscarConductorRequest;
use Cantera\Transito\Conductor\Aplicacion\BuscarConductorResponse;
use Cantera\Transito\Conductor\Aplicacion\BuscarConductorService;
use Cantera\Transito\Conductor\Dominio\ConductorIdentificacion;
use Cantera\Transito\Conductor\Dominio\IConductorRepository;
use PHPUnit\Framework\TestCase;

class BucarConductorServiceTest extends TestCase
{
   public function testBuscarConductor() : void {

      $request = new BuscarConductorRequest('1065848333');
      $repository = $this->createMock(IConductorRepository::class);
      $service = new BuscarConductorService($repository);
      $identificacion = new ConductorIdentificacion('1065848333');
      $repository->method('search')->with($identificacion);
      $conducor = $service->__invoke($request);

   }
}
