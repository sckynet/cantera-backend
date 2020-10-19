<?php


namespace Cantera\Transito\Cliente\Domain;


use Cantera\Transito\Shared\Domain\ValueObject\StringValueObject;

class ClienteTelefono extends  StringValueObject
{
  public function __construct(string $value)
  {
      $this->ensureIsValidTelefono($value);
      parent::__construct($value);
  }

  private function ensureIsValidTelefono(string $value) : void {
     if(!is_numeric($value))
         throw new  \DomainException(sprintf('<%s> does not allow the value <%s>.', static::class, $value));
  }

}
