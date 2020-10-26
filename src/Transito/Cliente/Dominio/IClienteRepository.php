<?php


namespace Cantera\Transito\Cliente\Dominio;


interface IClienteRepository
{
    public function save(Cliente $cliente): void;
}
