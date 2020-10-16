<?php

declare(strict_types=1);

namespace Cantera\Transito\Vehiculo\Dominio;

use Cantera\Transito\Conductor\Dominio\Conductor;

class Vehiculo
{
    private $placa;
    private $capacidad;
    private $tipo;

    public function __construct(VehiculoPlaca $placa,VehiculoCapacidad $capacidad, VehiculoTipo $tipo)
    {
        $this->placa = $placa;
        $this->capacidad = $capacidad;
        $this->tipo = $tipo;
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

    public function asignarCondctor(Conductor $conductor){

    }

}
