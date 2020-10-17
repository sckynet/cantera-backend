<?php


namespace Cantera\Transito\Contrato\Domain;


use Cantera\Transito\Shared\Domain\ValueObject\Enum;
use InvalidArgumentException;

class TransaccionValueObject extends Enum
{

    private const CARGA = 'CARGA';
    private const DESCARGA = 'DESCARGA';

    protected function throwExceptionForInvalidValue($value)
    {
        throw new InvalidArgumentException(sprintf('The type selected <%s> is invalid', $value));
    }

    public static function isCarga(): self
    {
        return new self(static::CARGA);
    }

    public function isDescarga(): self
    {
        return new self(static::DESCARGA);
    }
}
