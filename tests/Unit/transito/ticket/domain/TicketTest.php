<?php

namespace Tests\Unit\transito\ticket\domain;

use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{
    /**
    Escenario:  Genera ticket sin volumen disponible en el contrato

    HU 30. Como Usuario Quiero generar un ticket para llevar un control de las cargas que se van a realizar

    Criterio de Aceptación:

    1.1. El ticket se genera solo si el vehículo está asociado a un contrato.

    1.2. El ticket se genera solo si existe volumen disponible en el contrato.

    1.3. debe haber máximo un ticket pendiente por vehículo

    1.4. solo se genera un ticket si la transacción es carga

    Dado

    El usuario tiene un material con nombre “RELLENO”.

    un cliente con identificación “123456789-7”, nombre “CONSTRUCTORA MAYALES”, dirección “calle 38 #18d-30”, teléfono “3152556478” y tipo “JURIDICA”.

    El usuario tiene un vehículo con id “2”, placa “ADF-123A”, capacidad “8”, tipo “VOLQUETA” y manejada por el conductor con identificación “123456”, nombre “FABIAN”, teléfono “3005228888”.

    Un contrato con id “4” serie “123” numero contrato “25” municipio “VALLEDUPAR”, departamento “CESAR”, dirección “calle 38 #18d-30”, día “05”, mes “10”, año “2020”.

    Un contrato detalle con operación “CARGA”, volumen “8”, tipo “RELLENO”.

    Un contrato vehículo con contrato_id “4” y vehiculo_id “2”

    Cuando

    va a generar un ticket con carga “12”

    Entonces

    El sistema presentará el mensaje. “Atención!, La cantidad de carga ingresada supera el volumen disponible del contrato.”.
     */
    public function testGenerarTicketSinVolumenDisponible() : void
    {
        $material = new Material(1,'RELLENO');
        $cliente = new Cliente("123456789-7",'CONSTRUCTURA MAYALES','CLL38#18D-30','3152556478');
        $vehiculo =  new Vehiculo("ADF-123A",8,'VOLQUETA');
        $conductor =  new Conductor("123456","FABIAN","3005228888");
        $vehiculo->asignarConductor($conductor);
        $contrato = new Contrato(4,'123',$cliente->getId(),'05-10-2020','Valledupar','CESAR','CLL38#18D-30');
        $contrato->addDetalle('CARGA',8,'DEFINIDO',$material->getId());
        $contrato->addVechiculo($vehiculo->getId());
        $ticket = new Ticke(12);
        $result = $contrato->addTicket($ticket);
        $this->assertEquals('Atención!, La cantidad de carga ingresada supera el volumen disponible del contrato.',$result);
    }
}
