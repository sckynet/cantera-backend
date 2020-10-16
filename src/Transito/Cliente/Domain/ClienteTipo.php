<?php

declare(strict_types=1);

namespace Cantera\Transito\cliente\Domain;

use CodelyTv\Shared\Domain\ValueObject\Enum;

class ClienteTipo extends  Enum {

    private const NATURAL = 'NATURAL';
    private const JURIDICA = 'JURIDICA';

    protected function throwExceptionForInvalidValue($value) : void
    {
        throw new \InvalidArgumentException(sprintf('The type selected <%s> is invalid', $value));
    }

}
