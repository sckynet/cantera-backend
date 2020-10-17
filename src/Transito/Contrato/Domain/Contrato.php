<?php

namespace Cantera\Transito\Contrato\Domain;

use Cantera\Transito\Cliente\Domain\ClienteId;
use Cantera\Transito\Material\Domain\Material;
use Cantera\Transito\Material\Domain\MaterialId;
use Cantera\Transito\Vehiculo\Dominio\Vehiculo;
use Cantera\Transito\Vehiculo\Dominio\VehiculoId;

class Contrato
{
    private $id;
    private $serie;
    private $ubicacion;
    private $fecha;
    private $detalles;
    private $vehiculos;
    private $clienteId;

    /**
     * Contrato constructor.
     * @param ContratoId $id
     * @param ContratoSerie $serie
     * @param ContratoUbicacion $ubicacion ;
     * @param ContratoFecha $fecha ;
     */
    public function __construct(ContratoId $id, ContratoSerie $serie, ContratoUbicacion $ubicacion, ContratoFecha $fecha, ClienteId $clienteId)
    {
        $this->id = $id;
        $this->serie = $serie;
        $this->ubicacion = $ubicacion;
        $this->fecha = $fecha;
        $this->clienteId = $clienteId;
        $this->detalles = new ContratoDetalle([]);
        $this->vehiculos = new ContratoVehiculo([]);
    }

    /**
     * @return ClienteId
     */
    public function getClienteId(): ClienteId
    {
        return $this->clienteId;
    }


    /**
     * @return ContratoDetalle
     */
    public function getDetalles(): ContratoDetalle
    {
        return $this->detalles;
    }


    public function addDetalle(TerminoValueObject $termino, TransaccionValueObject $transaccion, Material $material)
    {
        $detalle = new Detalle($material, $termino, $transaccion);
        $this->detalles = $this->detalles->add($detalle);
    }

    /**
     * @return ContratoId
     */
    public function getId(): ContratoId
    {
        return $this->id;
    }

    /**
     * @return ContratoSerie
     */
    public function getSerie(): ContratoSerie
    {
        return $this->serie;
    }

    /**
     * @return ContratoUbicacion
     */
    public function getUbicacion(): ContratoUbicacion
    {
        return $this->ubicacion;
    }

    /**
     * @return ContratoFecha
     */
    public function getFecha(): ContratoFecha
    {
        return $this->fecha;
    }

    /**
     * @return ContratoVehiculo
     */
    public function getVehiculos(): ContratoVehiculo
    {
        return $this->vehiculos;
    }

    public function addVechiculo(Vehiculo $vehiculo): void
    {
        $this->vehiculos = $this->vehiculos->add($vehiculo);
    }

    public function addTicket(VehiculoId $vehiculoId, MaterialId $materialId, TicketCarga $carga)
    {

        $vehiculo = $this->existeVehiculo($vehiculoId);
        if ($vehiculo == null)
            throw new VehiculoSinContratoException('Atención!, No se puede genera un ticket porque el vehículo no tiene contrato asociado.');

        if ($this->tipoTransaccion($materialId, TransaccionValueObject::isDescarga()))
            throw new TipoTransaccionExeption('Atención!, No se puede generar un ticket un para el tipo de transacción DESCARGA.');

        $detalle = $this->tieneCantidadPendiente($materialId, $carga, TransaccionValueObject::isCarga());
        if ($detalle->getTermino()->getVolumen() < $carga->value())
            throw  new VolumenDisponibleExeption('Atención!, La cantidad de carga ingresada supera el volumen disponible del contrato.');

        $material = $detalle->getMaterial();

        $ticket = new Ticket(new TicketId(rand(1, 1000)), $this->serie, $vehiculo->getPlaca(), $carga, $material->getNombre(), $vehiculo->getConductor()->getNombre());
        $volumenPendiente = $detalle->getTermino()->getVolumen() - $ticket->getCarga()->value();
        $message = "Se ha generado un ticket con serie:" . $ticket->getSerie()->value() . " placa:" . $ticket->getPlaca()->value() . " carga:" . $ticket->getCarga()->value() . " material:" . $ticket->getMaterialNombre()->value() . " nombre del conductor:" . $ticket->getConductorNombre()->value() . " volumen pendiente:" . $volumenPendiente.".";
        return $message;
        //return sprintf("Se ha generado un ticket con serie:s% placa:s% carga:s% material:s% nombre del conductor:s% volumen pendiente:s%.", $ticket->getSerie()->value(),$ticket->getCarga()->value(), $ticket->getPlaca()->value(), $ticket->getMaterialNombre()->value(), $ticket->getConductorNombre()->value(),$volumenPendiente);
    }

    private function getVehiculo(VehiculoId $vehiculoId): Vehiculo
    {
        $vehiculo = $this->vehiculos->search(function (Vehiculo $item) use ($vehiculoId) {
            return $item->getId()->equals($vehiculoId);
        });
        return $vehiculo;
    }

    private function getMaterial(MaterialId $materialId): Detalle
    {
        $detalle = $this->detalles->search(function (Detalle $item) use ($materialId) {
            return $item->getMaterial()->getId()->equals($materialId);
        });
        return $detalle->getMaterial();
    }

    private function tieneCantidadPendiente(MaterialId $materialId, TicketCarga $carga, TransaccionValueObject $operacion): Detalle
    {
        $detalle = $this->detalles->search(function (Detalle $item) use ($materialId, $operacion) {
            return $item->getMaterial()->getId()->equals($materialId) && $item->getTransaccion()->equals($operacion);
        });
        return $detalle;
        //return $detalle->getTermino()->getVolumen() >= $carga->value();
    }

    private function tipoTransaccion(MaterialId $materialId, TransaccionValueObject $operacion)
    {
        $detalle = $this->detalles->search(function (Detalle $item) use ($materialId, $operacion) {
            return $item->getMaterial()->getId()->equals($materialId) && $item->getTransaccion()->equals($operacion);
        });
        return $detalle !== null;
    }

    private function existeVehiculo(VehiculoId $vehiculoId): ?Vehiculo
    {
        $vehiculo = $this->vehiculos->search(function (Vehiculo $item) use ($vehiculoId) {
            return $item->getId()->equals($vehiculoId);
        });
//        $vehiculo = $this->vehiculos->search(function (Vehiculo $item) use ($vehiculo) {
//            return $item->getId()->equals($vehiculo);
//        });
        return $vehiculo;
        //return $vehiculo !== null;
    }

}
