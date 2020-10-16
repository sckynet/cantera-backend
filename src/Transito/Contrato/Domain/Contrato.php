<?php


namespace Cantera\Transito\Contrato\Domain;


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

    /**
     * Contrato constructor.
     * @param ContratoId $id
     * @param ContratoSerie $serie
     * @param ContratoUbicacion $ubicacion ;
     * @param ContratoFecha $fecha ;
     */
    public function __construct(ContratoId $id, ContratoSerie $serie, ContratoUbicacion $ubicacion, ContratoFecha $fecha)
    {
        $this->id = $id;
        $this->serie = $serie;
        $this->ubicacion = $ubicacion;
        $this->fecha = $fecha;
        $this->detalles = new ContratoDetalle([]);
        $this->vehiculos = new ContratoVehiculo([]);
    }

    /**
     * @return ContratoDetalle
     */
    public function getDetalles(): ContratoDetalle
    {
        return $this->detalles;
    }


    public function addDetalle(TerminoValueObject $termino, TransaccionValueObject $transaccion, Material $material){
        $detalle = new Detalle($material,$termino, $transaccion);
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

    public function addVechiculo(Vehiculo $vehiculo) : void
    {
        $this->vehiculos = $this->vehiculos->add($vehiculo);
    }

    public function addTicket(VehiculoId $vehiculo,MaterialId $materialId,TicketCarga $carga){

        if(!$this->tieneCantidadPendiente($materialId,$carga,TransaccionValueObject::isCarga()))
            throw  new VolumenDisponibleExeption('Atención!, La cantidad de carga ingresada supera el volumen disponible del contrato.');

        //$ticket = new Ticket(new TicketId(TicketId::random()),$this->serie,$this->);
    }

    private function tieneCantidadPendiente(MaterialId $materialId,TicketCarga $carga, TransaccionValueObject $operacion) : bool {

        $detalle = $this->detalles->search(function(Detalle $item) use ($materialId,$operacion){
            return $item->getMaterial()->getId()->equals($materialId)  && $item->getTransaccion()->equals($operacion);
        });
        
        return $detalle->getTermino()->getVolumen() > $carga->value();
    }

}
