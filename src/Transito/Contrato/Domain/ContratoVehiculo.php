<?php


namespace Cantera\Transito\Contrato\Domain;


use Cantera\Transito\Shared\Domain\Collection;
use Cantera\Transito\Vehiculo\Dominio\Vehiculo;


class ContratoVehiculo extends Collection
{

    protected function type(): string
    {
        return Vehiculo::class;
    }

    public function add(Vehiculo $vehiculo) :self {
        return new self(array_merge($this->items(),[$vehiculo]));
    }
}
