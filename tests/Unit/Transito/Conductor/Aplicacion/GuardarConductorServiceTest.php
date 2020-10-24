<?php

namespace Tests\Unit\Transito\Conductor\Aplicacion;

use Cantera\Transito\Conductor\Aplicacion\ConductorRequest;
use Cantera\Transito\Conductor\Aplicacion\GuardarConductorService;
use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Conductor\Dominio\ConductorIdentificacion;
use Cantera\Transito\Conductor\Dominio\ConductorNombre;
use Cantera\Transito\Conductor\Dominio\CondutorTelefono;
use PHPUnit\Framework\TestCase;

class GuardarConductorServiceTest extends TestCase
{

    public function testGuardarConductor() : void
    {

       $request = new ConductorRequest('1065848333','camilo','3017764758');
       $respository = $this->createMock(IConductorRepository::class);
       $service = new GuardarConductorService($respository);

       $conductor = new Conductor(new ConductorIdentificacion('1065848333'),new ConductorNombre('camilo'),new CondutorTelefono('3017764758'));
       $respository->method('save')->with($conductor);

       $response = $service->__invoke($request);
       $this->assertEquals('El conductor camilo con identificacion 1065848333 se ha guardado correctamente',$response->getMensaje());
    }
}
