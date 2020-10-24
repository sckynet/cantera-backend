<?php


namespace Cantera\Transito\Conductor\Dominio;

interface IConductorRepository
{
   public function save(Conductor $conductor) : void;
}
