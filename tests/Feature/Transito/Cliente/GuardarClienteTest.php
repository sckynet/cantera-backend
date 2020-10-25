<?php


namespace Tests\Feature\Cliente;


use Tests\TestCase;

class GuardarClienteTest extends TestCase
{
    public function testGuardarClienteCorrectamente(): void {
        $response = $this->post('/api/cliente',[
                'identificacion'=>'1118536667',
                'nombre'=>'alberto',
                'municipio'=>'valledupar',
                'despartamento'=>'cesar',
                'direccion'=>'calle7c 19 e 41',
                'telefono'=>'3002885908'
            ]);
        $response->assertStatus('201')
        ->assertSeeText('El Cliente se guardo satisfactoriamente');
    }
}
