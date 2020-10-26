<?php

namespace Tests\Tests\Unit\Transito\Material\Aplicacion;

use Cantera\Transito\Material\Aplicacion\GuardarMaterialService;
use Cantera\Transito\Material\Aplicacion\MaterialRequest;
use Cantera\Transito\Material\Dominio\IMaterialRepository;
use Cantera\Transito\Material\Dominio\Material;
use Cantera\Transito\Material\Dominio\MaterialId;
use Cantera\Transito\Material\Dominio\MaterialNombre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class GuardarMaterialServiceTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
   public function testGuardarMaterial() : void {

      $request = new MaterialRequest(rand(),'nombre');
      $repository = $this->createMock(IMaterialRepository::class);
      $service = new GuardarMaterialService($repository);

      $material = new Material(new MaterialId($request->getId()),new MaterialNombre($request->getNombre()));
      $repository->method('save')->with($material);

      $response  = $service($request);

      $this->assertEquals('El Material nombre se guardo satisfactoriamente',$response->getMensaje());

   }

}
