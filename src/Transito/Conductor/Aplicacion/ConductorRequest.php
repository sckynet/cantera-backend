<?php


namespace Cantera\Transito\Conductor\Aplicacion;


class ConductorRequest
{
   private $identificacion;
   private $nombre;
   private $telefono;

   public function __construct(string $identificacion, string $nombre, string $telefono)
   {
      $this->identificacion = $identificacion;
      $this->nombre = $nombre;
      $this->telefono = $telefono;
   }


    public function getIdentificacion(): string
    {
        return $this->identificacion;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

}
