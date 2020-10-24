<?php


namespace Cantera\Transito\Vehiculo\Dominio;


interface IVehiculoRepository
{
    public function save(Vehiculo $vehiculo): void;

}
