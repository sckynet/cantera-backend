<?php

namespace Cantera\Transito\Contrato\Domain;

use Cantera\Transito\Shared\Domain\Collection;

class ContratoDetalle extends Collection
{

    protected function type(): string
    {
       return Detalle::class;
    }

    public function add(Detalle $detalle){
        return new self(array_merge($this->items(),[$detalle]));
    }

    public function search(callable $fn) : ?Detalle{

        foreach ($this->items() as $item){
            if($fn($item))
                return $item;
        }

        return null;
    }

}
