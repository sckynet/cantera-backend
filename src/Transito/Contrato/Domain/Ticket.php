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
    private $estado;

    /**
     * Ticket constructor.
     * @param TicketId $id
     * @param ContratoSerie $serie
     * @param VehiculoPlaca $placa
     * @param TicketCarga $carga
     * @param MaterialNombre $materialNombre
     * @param ConductorNombre $conductorNombre
     * @param TicketEstado $estado
     */
    public function __construct(TicketId $id, ContratoSerie $serie, VehiculoPlaca $placa, TicketCarga $carga, MaterialNombre $materialNombre, ConductorNombre $conductorNombre, TicketEstado $estado)
    {
        $this->id = $id;
        $this->serie = $serie;
        $this->placa = $placa;
        $this->carga = $carga;
        $this->estado = $estado;
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

    /**
     * @return TicketEstado
     */
    public function getEstado(): TicketEstado
    {
        return $this->estado;
    }

    /**
     * @param TicketEstado $estado
     */
    public function setEstado(TicketEstado $estado): void
    {
        $this->estado = $estado;
    }


}
