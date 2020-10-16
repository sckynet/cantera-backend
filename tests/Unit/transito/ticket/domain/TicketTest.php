<?php

namespace Tests\Unit\transito\ticket\domain;

use Cantera\Transito\cliente\domain\Cliente;
use Cantera\Transito\cliente\domain\ClienteId;
use Cantera\Transito\cliente\domain\ClienteNombre;
use Cantera\Transito\cliente\domain\ClienteTelefono;
use Cantera\Transito\cliente\domain\ClienteTipo;
use Cantera\Transito\cliente\domain\ClienteUbicacion;
use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Conductor\Dominio\ConductorId;
use Cantera\Transito\Conductor\Dominio\ConductorNombre;
use Cantera\Transito\Conductor\Dominio\CondutorTelefono;
use Cantera\Transito\Material\Domain\Material;
use Cantera\Transito\Material\Domain\MaterialId;
use Cantera\Transito\Material\Domain\MaterialNombre;
use Cantera\Transito\Vehiculo\Dominio\Vehiculo;
use Cantera\Transito\Vehiculo\Dominio\VehiculoCapacidad;
use Cantera\Transito\Vehiculo\Dominio\VehiculoPlaca;
use Cantera\Transito\Vehiculo\Dominio\VehiculoTipo;
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{
    /**
     * Escenario:  Genera ticket sin volumen disponible en el contrato
     * HU 30. Como Usuario Quiero generar un ticket para llevar un control de las cargas que se van a realizar
     * Criterio de Aceptación:
     * 1.1. El ticket se genera solo si el vehículo está asociado a un contrato.
     * 1.2. El ticket se genera solo si existe volumen disponible en el contrato.
     * 1.3. debe haber máximo un ticket pendiente por vehículo
     * 1.4. solo se genera un ticket si la transacción es carga
     * Dado
     * El usuario tiene un material con nombre “RELLENO”.
     * un cliente con identificación “123456789-7”, nombre “CONSTRUCTORA MAYALES”, dirección “calle 38 #18d-30”, teléfono “3152556478” y tipo “JURIDICA”.
     * El usuario tiene un vehículo con id “2”, placa “ADF-123A”, capacidad “8”, tipo “VOLQUETA” y manejada por el conductor con identificación “123456”, nombre “FABIAN”, teléfono “3005228888”.
     * Un contrato con id “4” serie “123” numero contrato “25” municipio “VALLEDUPAR”, departamento “CESAR”, dirección “calle 38 #18d-30”, día “05”, mes “10”, año “2020”.
     * Un contrato detalle con operación “CARGA”, volumen “8”, tipo “RELLENO”.
     * Un contrato vehículo con contrato_id “4” y vehiculo_id “2”
     * Cuando
     * va a generar un ticket con carga “12”
     * Entonces
     * El sistema presentará el mensaje. “Atención!, La cantidad de carga ingresada supera el volumen disponible del contrato.”.
     */
    public function testGenerarTicketSinVolumenDisponible(): void {
        $material = new Material(new MaterialId('1'), new MaterialNombre('RELLENO'));
        $cliente = new Cliente(new ClienteId('123456789-7'), new ClienteNombre('CONSTRUCTURA MAYALES'), new ClienteTelefono('3152556478'), new ClienteUbicacion('VALLEDUPAR', 'CESAR', 'CLL38#18D-30'), new ClienteTipo('JURIDICA'));
        $vehiculo = new Vehiculo(new VehiculoPlaca('ADF-123A'), new VehiculoCapacidad(8), new VehiculoTipo('VOLQUETA'));
        $conductor = new Conductor(new ConductorId('123456'), new ConductorNombre('FABIAN'), new CondutorTelefono('3005228888'));
        $vehiculo->asignarConductor($conductor);
        $contrato = new Contrato(4, '123', $cliente->getId(), '05-10-2020', 'Valledupar', 'CESAR', 'CLL38#18D-30');
        $contrato->addDetalle('CARGA', 8, 'DEFINIDO', $material->getId());
        $contrato->addVechiculo($vehiculo->getId());
        $result = $contrato->addTicket(12, $material->getId(), $vehiculo->getId());
        $this->assertEquals('Atención!, La cantidad de carga ingresada supera el volumen disponible del contrato.', $result);
    }
}