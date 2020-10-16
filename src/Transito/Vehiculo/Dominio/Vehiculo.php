<?php

declare(strict_types=1);

namespace Cantera\Transito\Vehiculo\Dominio;

use Cantera\Transito\Conductor\Dominio\ConductorId;

class Vehiculo
{
    private $placa;
    private $capacidad;
    private $tipo;
    private $conductorId;

    public function __construct(VehiculoPlaca $placa,VehiculoCapacidad $capacidad, VehiculoTipo $tipo,ConductorId $conductorId)
    {
        $this->placa = $placa;
        $this->capacidad = $capacidad;
        $this->tipo = $tipo;
        $this->conductorId = $conductorId;
    }


    public function getPlaca(): VehiculoPlaca {
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


    public function conductor(): ConductorId
    {
        return $this->conductorId;
    }

}
