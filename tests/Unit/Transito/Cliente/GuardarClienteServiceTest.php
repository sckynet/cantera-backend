<?php


namespace Tests\Unit\transito\Cliente;


use Cantera\Transito\Cliente\Aplicacion\ClienteRequest;
use Cantera\Transito\Cliente\Aplicacion\GuardarClienteService;
use Cantera\Transito\Cliente\Dominio\Cliente;
use Cantera\Transito\Cliente\Dominio\ClienteIdentificacion;
use Cantera\Transito\Cliente\Dominio\ClienteNombre;
use Cantera\Transito\Cliente\Dominio\ClienteTelefono;
use Cantera\Transito\Cliente\Dominio\ClienteTipo;
use Cantera\Transito\Cliente\Dominio\ClienteUbicacion;
use \PHPUnit\Framework\TestCase;
class GuardarClienteServiceTest extends TestCase
{
    public function testGuardarCliente(): void{

        $request = new ClienteRequest('1118536667','alberto','valledupar','cesar','calle7c 19 e 41','3002885908');
        $repository= $this->createMock(IClienteRepository::class);
        $service= new GuardarClienteService($repository);
        $cliente=new Cliente(new ClienteIdentificacion($request->getIdentificacion()),new ClienteNombre($request->getNombre()),
                             new ClienteTelefono($request->getTelefono()),
                            new ClienteUbicacion($request->getMunicipio(),$request->getDepartamento(),$request->getDireccion()),
                            new ClienteTipo($request->getTipo()));
        $repository->method('save')->with($cliente);
        $response= $service($request);

        $this->assertEquals('El Cliente alberto se guardo satisfactoriamente',$response->getMensaje());

    }
}
