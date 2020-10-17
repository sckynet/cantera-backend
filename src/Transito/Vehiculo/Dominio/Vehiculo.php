<?php

declare(strict_types=1);

namespace Cantera\Transito\Vehiculo\Dominio;

use Cantera\Transito\Conductor\Dominio\Conductor;
use Cantera\Transito\Conductor\Dominio\ConductorId;

class Vehiculo
{
    private $id;
    private $placa;
    private $capacidad;
    private $tipo;
    private $conductor;

    public function __construct(VehiculoId $id, VehiculoPlaca $placa, VehiculoCapacidad $capacidad, VehiculoTipo $tipo, Conductor $conductor)
    {
        $this->placa = $placa;
        $this->capacidad = $capacidad;
        $this->tipo = $tipo;
        $this->conductor = $conductor;
        $this->id = $id;
    }

    /**
     * @return VehiculoId
     */
    public function getId(): VehiculoId
    {
        return $this->id;
    }

    public function getPlaca(): VehiculoPlaca
    {
        return $this->placa;
    }


    public function getCapacidad(): VehiculoCapacidad
    {
        return $this->capacidad;
    }


    public function getTipo(): VehiculoTipo
    {
        return $this->tipo;
    }

    /**
     * @return Conductor
     */
    public function getConductor(): Conductor
    {
        return $this->conductor;
    }

}
