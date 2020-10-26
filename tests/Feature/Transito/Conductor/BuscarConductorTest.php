<?php

namespace Tests\Feature\Transito\Conductor;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuscarConductorTest extends TestCase
{
    use RefreshDatabase;

    public function testBuscarConductorExistente()
    {

         $this->post('api/conductor',[
            'identificacion' => '1065848333',
            'nombre' => 'camilo',
            'telefono' => '3017764758'
        ]);

        $response = $this->get('api/conductor/1065848333');

        $response->assertStatus(200)->assertExactJson([
            'identificacion' => '1065848333',
            'nombre' => 'camilo',
            'telefono' => '3017764758'
        ]);
    }



}
