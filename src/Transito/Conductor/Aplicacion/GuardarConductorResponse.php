<?php

namespace Cantera\Transito\Conductor\Aplicacion;

class GuardarConductorResponse
{
     private $mensaje;

     public function __construct(string $mensaje)
     {
         $this->mensaje = $mensaje;
     }

    public function getMensaje(): string
    {
        return $this->mensaje;
    }

}
