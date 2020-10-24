<?php


namespace Tests\Feature\Transito\Vehiculo;

use Illuminate\Http\Response;
use Tests\TestCase;

class GuardarVehiculoTest extends TestCase
{
    public function testGuardarVehiculoCorrectamente(): void
    {
        $response = $this->post('/api/vehiculo', [
            'placa' => 'ABC-806',
            'capacidad' => 8,
            'tipo' => 'VOLQUETA',
            'conductor_id' => 1
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
//            ->assertSeeText('El vehiculo ABC-806 se guardo satisfactoriamente');
    }

}
