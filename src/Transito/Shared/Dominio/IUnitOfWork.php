<?php


namespace Cantera\Transito\Shared\Dominio;


interface IUnitOfWork
{


    public function beginTransaction();

    public function commit();

    public function rollback();

}
