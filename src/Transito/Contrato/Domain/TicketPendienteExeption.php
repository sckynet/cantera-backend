<?php


namespace Cantera\Transito\Contrato\Domain;

use DomainException;
use Throwable;

class TicketPendienteExeption extends DomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
