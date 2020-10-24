<?php


namespace Cantera\Transito\Cliente\Aplicacion;




class ClienteRequest
{
    private $identificacion;
    private $nombre;
    private $municipio;
    private $departamento;
    private $direccion;
    private $telefono;
    private $tipo;

    public function __construct(string $identificacion,string $nombre,string $municipio,string $departamento,string $direccion, string $telefono,string $tipo)
    {
        $this->identificacion=$identificacion;
        $this->nombre=$nombre;
        $this->municipio=$municipio;
        $this->departamento=$departamento;
        $this->direccion=$direccion;
        $this->telefono=$telefono;
        $this->tipo=$tipo;
    }

    /**
     * @return string
     */
    public function getIdentificacion(): string
    {
        return $this->identificacion;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
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

    /**
     * @return Number
     */
    public function getTelefono(): string
    {
        return $this->telefono;
    }

    /**
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }



}
