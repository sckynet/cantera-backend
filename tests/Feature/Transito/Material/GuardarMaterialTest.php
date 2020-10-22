<?php

namespace Tests\Feature\Transito\Material;

use Illuminate\Http\Response;
use Tests\TestCase;

class GuardarMaterialTest extends  TestCase
{

    public function testGuardarMaterialCorrectamente() : void {

        $response = $this->post('/api/material',[
            'nombre' => 'nombre'
        ]);

        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertSeeText('El Material nombre se guardo satisfactoriamente');
    }

}
