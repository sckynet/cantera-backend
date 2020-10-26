<?php


namespace Cantera\Transito\Shared\Infraestructura;


use Cantera\Transito\Shared\Dominio\IUnitOfWork;
use Illuminate\Support\Facades\DB;

final class UnitOfWorkEloquent implements IUnitOfWork
{


    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    public function commit(): void
    {
        DB::commit();
    }

    public function rollback(): void
    {
        DB::rollBack();
    }
}
