<?php

namespace Cantera\Transito\Shared\Dominio\ValueObject;

abstract class UbicacionValueObject
{
    private $municipio;
    private $departamento;
    private $direccion;

    /**
     * UbicacionValueObject constructor.
     * @param string $municipio
     * @param string $departamento
     * @param string $direccion
     */
    public function __construct(string $municipio,string $departamento,string $direccion)
    {
        $this->municipio = $municipio;
        $this->departamento = $departamento;
        $this->direccion = $direccion;
    }

    /**
     * @return string
     */
    public function getMunicipio(): string
    {
        return $this->municipio;
    }

    /**
     * @return string
     */
    public function getDepartamento(): string
    {
        return $this->departamento;
    }

    /**
     * @return string
     */
    public function getDireccion(): string
    {
        return $this->direccion;
    }

}
