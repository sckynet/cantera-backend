<?php

namespace Cantera\Transito\Contrato\Dominio;

use Cantera\Transito\Shared\Dominio\Collection;
use Cantera\Transito\Vehiculo\Dominio\Vehiculo;
use Cantera\Transito\Vehiculo\Dominio\VehiculoId;


class ContratoVehiculo extends Collection
{

    protected function type(): string
    {
        return Vehiculo::class;
    }

    public function add(Vehiculo $vehiculo) :self {
        return new self(array_merge($this->items(),[$vehiculo]));
    }

    public function exist(VehiculoId  $vehiculo) : ?Vehiculo {

        foreach ($this->items() as $item){
            if($vehiculo->equals($item->getId()))
                return $item;
        }

        return null;
    }

    public function search(callable $fn) : ?Vehiculo{

        foreach ($this->items() as $item){
            if($fn($item))
                return $item;
        }

        return null;
    }
}
