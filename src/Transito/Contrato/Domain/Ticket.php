<?php

namespace Cantera\Transito\Contrato\Domain;

use Cantera\Transito\Conductor\Dominio\ConductorNombre;
use Cantera\Transito\Material\Domain\MaterialNombre;
use Cantera\Transito\Vehiculo\Dominio\VehiculoPlaca;

class Ticket
{
   private $id;
   private $serie;
   private $placa;
   private $carga;
   private $materialNombre;
   private $conductorNombre;

    /**
     * Ticket constructor.
     * @param $id
     * @param $serie
     * @param $placa
     * @param $carga
     * @param $material
     */
    public function __construct(TicketId $id,ContratoSerie $serie,VehiculoPlaca $placa,TicketCarga $carga,MaterialNombre $materialNombre,ConductorNombre  $conductorNombre)
    {
        $this->id = $id;
        $this->serie = $serie;
        $this->placa = $placa;
        $this->carga = $carga;
        $this->materialNombre = $materialNombre;
        $this->conductorNombre = $conductorNombre;
    }

    /**
     * @return TicketId
     */
    public function getId(): TicketId
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
     * @return VehiculoPlaca
     */
    public function getPlaca(): VehiculoPlaca
    {
        return $this->placa;
    }

    /**
     * @return TicketCarga
     */
    public function getCarga(): TicketCarga
    {
        return $this->carga;
    }

    /**
     * @return MaterialNombre
     */
    public function getMaterialNombre(): MaterialNombre
    {
        return $this->materialNombre;
    }

    /**
     * @return ConductorNombre
     */
    public function getConductorNombre(): ConductorNombre
    {
        return $this->conductorNombre;
    }



}
