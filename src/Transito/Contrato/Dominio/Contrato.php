<?php

namespace Cantera\Transito\Contrato\Dominio;

use Cantera\Transito\Cliente\Dominio\ClienteId;
use Cantera\Transito\Material\Dominio\Material;
use Cantera\Transito\Material\Dominio\MaterialId;
use Cantera\Transito\Vehiculo\Dominio\Vehiculo;
use Cantera\Transito\Vehiculo\Dominio\VehiculoId;
use Cantera\Transito\Vehiculo\Dominio\VehiculoPlaca;

class Contrato
{
    private $id;
    private $serie;
    private $ubicacion;
    private $fecha;
    private $detalles;
    private $vehiculos;
    private $clienteId;
    private $tickets;


    public function __construct(ContratoId $id, ContratoSerie $serie, ContratoUbicacion $ubicacion, ContratoFecha $fecha, ClienteId $clienteId)
    {
        $this->id = $id;
        $this->serie = $serie;
        $this->ubicacion = $ubicacion;
        $this->fecha = $fecha;
        $this->clienteId = $clienteId;
        $this->detalles = new ContratoDetalle([]);
        $this->vehiculos = new ContratoVehiculo([]);
        $this->tickets = new ContratoTickets([]);
    }

    public function getTickets(): ContratoTickets
    {
        return $this->tickets;
    }

    public function getClienteId(): ClienteId
    {
        return $this->clienteId;
    }

    public function getDetalles(): ContratoDetalle
    {
        return $this->detalles;
    }

    public function getId(): ContratoId
    {
        return $this->id;
    }

    public function getSerie(): ContratoSerie
    {
        return $this->serie;
    }

    public function getUbicacion(): ContratoUbicacion
    {
        return $this->ubicacion;
    }

    public function getFecha(): ContratoFecha
    {
        return $this->fecha;
    }

    public function getVehiculos(): ContratoVehiculo
    {
        return $this->vehiculos;
    }

    public function addDetalle(TerminoValueObject $termino, TransaccionValueObject $transaccion, Material $material): void
    {
        $detalle = new Detalle($material, $termino, $transaccion);
        $this->detalles = $this->detalles->add($detalle);
    }

    public function addVechiculo(Vehiculo $vehiculo): void
    {
        $this->vehiculos = $this->vehiculos->add($vehiculo);
    }

    private function addContratoTickets(Ticket $ticket):void{
        $this->tickets = $this->tickets->add($ticket);
    }

    public function addTicket(VehiculoId $vehiculoId, MaterialId $materialId, TicketCarga $carga) :  ?Ticket
    {

        $vehiculo = $this->vehiculos->exist($vehiculoId);
        if ($vehiculo == null)
            throw new VehiculoSinContratoException('Atención!, No se puede genera un ticket porque el vehículo no tiene contrato asociado.');

        if ($this->tipoTransaccion($materialId, TransaccionValueObject::isDescarga()))
            throw new TipoTransaccionExeption('Atención!, No se puede generar un ticket un para el tipo de transacción DESCARGA.');

        $detalle = $this->tieneCantidadPendiente($materialId, $carga, TransaccionValueObject::isCarga());
        if ($detalle->getTermino()->getVolumen() < $carga->value())
            throw  new VolumenDisponibleExeption('Atención!, La cantidad de carga ingresada supera el volumen disponible del contrato.');

        $material = $detalle->getMaterial();

        if(!$this->tieneTicketPendienteVehiculo($vehiculo->getPlaca()))
            throw new TicketPendienteExeption('Atencion!, El vehiculo ya tiene un ticket pendiente, debe finalizar el ticket pendiente.');

        $ticket = new Ticket(new TicketId(rand(1, 1000)), $this->serie, $vehiculo->getPlaca(), $carga, $material->getNombre(), $vehiculo->getConductor()->getNombre(), TicketEstado::isPendiente());
        $this->addContratoTickets($ticket);
        $volumenPendiente = $detalle->getTermino()->getVolumen() - $ticket->getCarga()->value();
        $message = "Se ha generado un ticket con serie:" . $ticket->getSerie()->value() . " placa:" . $ticket->getPlaca()->value() . " carga:" . $ticket->getCarga()->value() . " material:" . $ticket->getMaterialNombre()->value() . " nombre del conductor:" . $ticket->getConductorNombre()->value() . " volumen pendiente:" . $volumenPendiente . ".";
        return $ticket;

    }

    private function tieneTicketPendienteVehiculo(VehiculoPlaca $vehiculoPlaca){
        $ticket = $this->tickets->search(function (Ticket $item) use($vehiculoPlaca){
            return $item->getPlaca() === $vehiculoPlaca and $item->getEstado()->equals(TicketEstado::isPendiente());
        });
        return $ticket == null;
    }

    private function tieneCantidadPendiente(MaterialId $materialId, TicketCarga $carga, TransaccionValueObject $operacion): Detalle
    {
        $detalle = $this->detalles->search(function (Detalle $item) use ($materialId, $operacion) {
            return $item->getMaterial()->getId()->equals($materialId) && $item->getTransaccion()->equals($operacion);
        });
        return $detalle;
    }

    private function tipoTransaccion(MaterialId $materialId, TransaccionValueObject $operacion)
    {
        $detalle = $this->detalles->search(function (Detalle $item) use ($materialId, $operacion) {
            return $item->getMaterial()->getId()->equals($materialId) && $item->getTransaccion()->equals($operacion);
        });
        return $detalle !== null;
    }

}
