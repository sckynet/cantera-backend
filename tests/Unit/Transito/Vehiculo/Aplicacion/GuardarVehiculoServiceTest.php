<?php


namespace Tests\Unit\transito\Vehiculo\Aplicacion;


use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Conductor\Dominio\ConductorId;
use Cantera\Transito\Conductor\Dominio\ConductorIdentificacion;
use Cantera\Transito\Conductor\Dominio\ConductorNombre;
use Cantera\Transito\Conductor\Dominio\CondutorTelefono;
use Cantera\Transito\Vehiculo\Aplicacion\GuardarVehiculoService;
use Cantera\Transito\Vehiculo\Aplicacion\VehiculoRequest;
use Cantera\Transito\Vehiculo\Dominio\IVehiculoRepository;
use Cantera\Transito\Vehiculo\Dominio\Vehiculo;
use Cantera\Transito\Vehiculo\Dominio\VehiculoCapacidad;
use Cantera\Transito\Vehiculo\Dominio\VehiculoId;
use Cantera\Transito\Vehiculo\Dominio\VehiculoPlaca;
use Cantera\Transito\Vehiculo\Dominio\VehiculoTipo;
use PHPUnit\Framework\TestCase;

class GuardarVehiculoServiceTest extends TestCase
{

    /**
     * @test
     */
    public function testGuardarVehiculo(): void
    {
        $request = new VehiculoRequest(rand(), 'ABC-806', 'VOLQUETA', 8, 1);
        $repository = $this->createMock(IVehiculoRepository::class);
        $service = new GuardarVehiculoService($repository);
        $conductor = new Conductor(new ConductorIdentificacion('123456789'), new ConductorNombre('CAMILO'), new CondutorTelefono('3187545196'));
        $vehiculo = new Vehiculo(new VehiculoId($request->getId()), new VehiculoPlaca($request->getPlaca()), new VehiculoCapacidad($request->getCapacidad()), new VehiculoTipo($request->getTipo()), $conductor);
        $repository->method('save')->with($vehiculo);

        $response = $service($request);

        $this->assertEquals('El Vehiculo ABC-806 se guardo satisfactoriamente', $response->getMensaje());
    }
}
