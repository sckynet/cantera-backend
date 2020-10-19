<?php

declare(strict_types = 1);

namespace Cantera\Transito\Shared\Domain\ValueObject;

class Uuid
{
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function random(): self
    {
        return new self(rand());
    }

    public function value(): int
    {
        return $this->value;
    }


    public function equals(Uuid $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString()
    {
        return "$this->value()";
    }
}
