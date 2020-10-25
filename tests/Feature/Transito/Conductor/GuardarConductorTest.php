<?php

namespace Tests\Feature\Transito\Conductor;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuardarConductorTest extends TestCase {

    use RefreshDatabase;

    public function testGuardarConductor() :  void {

       $response = $this->post('api/conductor',[
          'identificacion' => '1065848333',
          'nombre' => 'CAMILO',
          'telefono' => '3017764758'
       ]);
       $response->assertStatus(201)
                ->assertSeeText('El conductor camilo con identificacion 1065848333 se ha guardado correctamente');
    }

}
