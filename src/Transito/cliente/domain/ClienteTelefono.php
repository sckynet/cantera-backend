<?php


namespace Cantera\Transito\cliente\domain;


use Cantera\Transito\Shared\Domain\ValueObject\StringValueObject;

class ClienteTelefono extends  StringValueObject
{
  public function __construct(string $value)
  {
      $this->ensureIsValidTelefono($value);
      parent::__construct($value);
  }

  private function ensureIsValidTelefono(string $value) : void {
     if(!preg_match('/^[0-9]{9,9}$/', $value))
         throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $value));
  }

}
