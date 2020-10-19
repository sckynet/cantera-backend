<?php


namespace Cantera\Transito\Contrato\Domain;


use Cantera\Transito\Shared\Domain\ValueObject\Enum;

class TicketEstado extends Enum
{
    private const PENDIENTE = 'PENDIENTE';
    private const FINALIZADO = 'FINALIZADO';

    protected function throwExceptionForInvalidValue($value)
    {
        throw new \InvalidArgumentException(sprintf('The type selected <%s> is invalid', $value));
    }

    public static function isPendiente(): self
    {
        return new self(static::PENDIENTE);
    }

    public static function isFinalizado(): self
    {
        return new self(static::FINALIZADO);
    }
}
