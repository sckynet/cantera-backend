<?php

namespace Cantera\Transito\Material\Aplicacion;

class MaterialRequest
{
   private $nombre;
   private $id;

  public function __construct(int $id,string $nombre)
  {
      $this->nombre = $nombre;
      $this->id = $id;
  }

   public function getNombre(): string
   {
        return $this->nombre;
   }

    public function getId() : int
    {
        return $this->id;
    }

}
