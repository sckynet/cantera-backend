<?php

namespace Cantera\Transito\Conductor\Dominio;

interface IConductorRepository
{
   public function save(Conductor $conductor) : void;
   public function search(ConductorIdentificacion $identificacion) : ? Conductor;
}
