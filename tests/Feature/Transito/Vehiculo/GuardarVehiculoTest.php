<?php


namespace Tests\Feature\Transito\Vehiculo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class GuardarVehiculoTest extends TestCase
{

    use RefreshDatabase;

    public function testGuardarVehiculoCorrectamente(): void
    {
        $this->post('api/conductor', [
            'identificacion' => '1065848333',
            'nombre' => 'CAMILO',
            'telefono' => '3017764758'
        ]);
        $response = $this->post('/api/vehiculo', [
            'placa' => 'ABC-806',
            'capacidad' => 8,
            'tipo' => 'VOLQUETA',
            'conductor_id' => '1065848333'
        ]);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertSeeText('El Vehiculo ABC-806 se guardo satisfactoriamente');
    }

}
