<?php

declare(strict_types=1);

namespace Cantera\Transito\Material\Domain;


class Material
{
    private $id;
    private $nombre;

    public function __construct(MaterialId $id, MaterialNombre $nombre)
    {
            $this->id =  $id;
            $this->nombre = $nombre;
    }

    public function  getId() : MaterialId {
        return $this->id;
    }

    public function getNombre() : MaterialNombre {
        return $this->nombre;
    }

}
