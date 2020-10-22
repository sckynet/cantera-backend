<?php

namespace Cantera\Transito\Material\Dominio;

interface IMaterialRepository
{
   public function save(Material $material) : void;
}
