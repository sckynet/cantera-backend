<?php

namespace Cantera\Transito\Conductor\Dominio;

class Conductor
{
    private $identificacion;
    private $nombre;
    private $telefono;

    public function __construct(ConductorIdentificacion $identificacion, ConductorNombre $nombre, CondutorTelefono $telefono) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->identificacion = $identificacion;
    }

    public function getIdentificacion(): ConductorIdentificacion
    {
        return $this->identificacion;
    }

    public function getNombre(): ConductorNombre {
        return $this->nombre;
    }

    public function getTelefono(): CondutorTelefono {
        return $this->telefono;
    }

   public function toArray() : array {
        return  [
          'identificacion' => $this->getIdentificacion(),
          'nombre' => $this->getNombre(),
          'telefono' => $this->getTelefono()
        ];
   }

}
