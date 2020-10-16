<?php

namespace Tests\Unit\transito\ticket\domain;


use Cantera\Transito\Cliente\Domain\Cliente;
use Cantera\Transito\Cliente\Domain\ClienteId;
use Cantera\Transito\Cliente\Domain\ClienteIdentificacion;
use Cantera\Transito\Cliente\Domain\ClienteNombre;
use Cantera\Transito\Cliente\Domain\ClienteTelefono;
use Cantera\Transito\Cliente\Domain\ClienteTipo;
use Cantera\Transito\Cliente\Domain\ClienteUbicacion;
use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Conductor\Dominio\ConductorId;
use Cantera\Transito\Conductor\Dominio\ConductorIdentificacion;
use Cantera\Transito\Conductor\Dominio\ConductorNombre;
use Cantera\Transito\Conductor\Dominio\CondutorTelefono;
use Cantera\Transito\Contrato\Domain\Contrato;
use Cantera\Transito\Contrato\Domain\ContratoFecha;
use Cantera\Transito\Contrato\Domain\ContratoId;
use Cantera\Transito\Contrato\Domain\ContratoSerie;
use Cantera\Transito\Contrato\Domain\ContratoUbicacion;
use Cantera\Transito\Contrato\Domain\TerminoValueObject;
use Cantera\Transito\Contrato\Domain\TicketCarga;
use Cantera\Transito\Contrato\Domain\TransaccionValueObject;
use Cantera\Transito\Contrato\Domain\VehiculoSinContratoException;
use Cantera\Transito\Contrato\Domain\VolumenDisponibleExeption;
use Cantera\Transito\Material\Domain\Material;
use Cantera\Transito\Material\Domain\MaterialId;
use Cantera\Transito\Material\Domain\MaterialNombre;
use Cantera\Transito\Vehiculo\Dominio\Vehiculo;
use Cantera\Transito\Vehiculo\Dominio\VehiculoCapacidad;
use Cantera\Transito\Vehiculo\Dominio\VehiculoId;
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
     * El usuario tiene un material con id “1“ nombre “RELLENO”.
     * un cliente con id ”1”, identificación “123456789-7”, nombre “CONSTRUCTORA MAYALES”, municipio “VALLEDUPAR“, departamento “CESAR“, dirección “CLL38#18d-30”, teléfono “3152556478” y tipo “JURIDICA”.
     * Un conductor con id “1“ identificación “123456”, nombre “FABIAN”, teléfono “3005228888”.
     * El usuario tiene un vehículo con id “1“ placa “ADF-123A”, capacidad “8”, tipo “VOLQUETA” y conductor_id “1“.
     * Un contrato con id ”4”, serie “123”, cliente_id “1“, municipio “VALLEDUPAR”, departamento “CESAR”, dirección “CLL38#18d-30”, día “05”, mes “10”, año “2020”.
     * Un contrato detalle con operación “CARGA”, volumen “8”, tipo “DEFINIDO“ y material_id “1“.
     * Un contrato vehículo con vehiculo_id “1”
     * Cuando
     * va a generar un ticket con carga “12” , material_id “1“ y vehiculo_id “1“
     * Entonces
     * El sistema presentará el mensaje. “Atención!, La cantidad de carga ingresada supera el volumen disponible del contrato.”.
     * @test
     */

    public function testGenerarTicketSinVolumenDisponible(): void
    {
        $material = new Material(new MaterialId(1), new MaterialNombre('RELLENO'));
        $cliente = new Cliente(new ClienteId(1), new ClienteIdentificacion('1065848333'), new ClienteNombre('CONSTRUCTURA MAYALES'), new ClienteTelefono('3152556478'), new ClienteUbicacion('VALLEDUPAR', 'CESAR', 'CLL38#18D-30'), new ClienteTipo('JURIDICA'));
        $conductor = new Conductor(new ConductorId(1), new ConductorIdentificacion('123456'), new ConductorNombre('FABIAN'), new CondutorTelefono('3005228888'));
        $vehiculo = new Vehiculo(new VehiculoId(1), new VehiculoPlaca('ADF-123A'), new VehiculoCapacidad(8), new VehiculoTipo('VOLQUETA'), $conductor->getId());
        $contrato = new Contrato(new ContratoId(4), new ContratoSerie('123'), new ContratoUbicacion('VALLEDUPAR', 'CESAR', 'CLL38#18D-30'), new ContratoFecha(5, 10, 2020), $cliente->getId());
        $contrato->addDetalle(new TerminoValueObject(8, 'DEFINIDO'), new TransaccionValueObject('CARGA'), $material);
        $contrato->addVechiculo($vehiculo);
        try {
            $contrato->addTicket($vehiculo->getId(), $material->getId(), new TicketCarga(12));
        } catch (VolumenDisponibleExeption $exception) {
            $this->assertEquals('Atención!, La cantidad de carga ingresada supera el volumen disponible del contrato.', $exception->getMessage());
        }
    }

    /**
     * Escenario:  Genera ticket sin contrato
     * HU 30. Como Usuario Quiero generar un ticket para llevar un control de las cargas que se van a realizar
     * Criterio de Aceptación:
     * 1.1. El ticket se genera solo si el vehículo está asociado a un contrato.
     * 1.2. El ticket se genera solo si existe volumen disponible en el contrato.
     * 1.3. debe haber máximo un ticket pendiente por vehículo
     * 1.4. solo se genera un ticket si la transacción es carga
     * Dado
     * El usuario tiene un material con id “1“ nombre “RELLENO”.
     * un cliente con id ”1”, identificación “123456789-7”, nombre “CONSTRUCTORA MAYALES”, municipio “VALLEDUPAR“, departamento “CESAR“, dirección “CLL38#18d-30”, teléfono “3152556478” y tipo “JURIDICA”.
     * Un conductor con id “1“ identificación “123456”, nombre “FABIAN”, teléfono “3005228888”.
     * El usuario tiene un vehículo con id “1“ placa “ADF-123A”, capacidad “8”, tipo “VOLQUETA” y conductor_id “1“.
     * Un contrato con id ”4”, serie “123”, cliente_id “1“, municipio “VALLEDUPAR”, departamento “CESAR”, dirección “CLL38#18d-30”, día “05”, mes “10”, año “2020”.
     * Un contrato detalle con operación “CARGA”, volumen “8”, tipo “DEFINIDO“ y material_id “1“.
     * Cuando
     * Va a generar un ticket con carga “5” , material_id “1“ y vehiculo_id “1“
     * Entonces
     * El sistema presentará el mensaje. “Atención!, No se puede genera un ticket porque el vehículo no tiene contrato asociado.”
     * @test
     */

    public function testGenerarTicketDeVehiculoSinContrato() : void {
        $material = new Material(new MaterialId(1), new MaterialNombre('RELLENO'));
        $cliente = new Cliente(new ClienteId(1), new ClienteIdentificacion('1065848333'), new ClienteNombre('CONSTRUCTURA MAYALES'), new ClienteTelefono('3152556478'), new ClienteUbicacion('VALLEDUPAR', 'CESAR', 'CLL38#18D-30'), new ClienteTipo('JURIDICA'));
        $conductor = new Conductor(new ConductorId(1), new ConductorIdentificacion('123456'), new ConductorNombre('FABIAN'), new CondutorTelefono('3005228888'));
        $vehiculo = new Vehiculo(new VehiculoId(1), new VehiculoPlaca('ADF-123A'), new VehiculoCapacidad(8), new VehiculoTipo('VOLQUETA'), $conductor->getId());
        $contrato = new Contrato(new ContratoId(4), new ContratoSerie('123'), new ContratoUbicacion('VALLEDUPAR', 'CESAR', 'CLL38#18D-30'), new ContratoFecha(5, 10, 2020), $cliente->getId());
        $contrato->addDetalle(new TerminoValueObject(8, 'DEFINIDO'), new TransaccionValueObject('CARGA'), $material);
        try {
            $contrato->addTicket($vehiculo->getId(), $material->getId(), new TicketCarga(5));
        } catch (VehiculoSinContratoException $exception) {
            $this->assertEquals('Atención!, No se puede genera un ticket porque el vehículo no tiene contrato asociado.', $exception->getMessage());
        }
    }

}
