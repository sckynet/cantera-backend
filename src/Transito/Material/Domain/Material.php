<?php

declare(strict_types=1);

namespace Cantera\Transito\Material\Domain;

use Cantera\Transito\Material\Domain\MaterialId;
use Cantera\Transito\Material\Domain\MaterialNombre;

class Material
{
    private $id;
    private $nombre;

    public function __construct(MaterialId $id, MaterialNombre $nombre)
    {
            $this->id =  $id;
            $this->nombre = $nombre;
    }

    public function  id() : MaterialId {
        return $this->id;
    }

    public function nombre() : MaterialNombre {
        return $this->nombre;
    }

}
