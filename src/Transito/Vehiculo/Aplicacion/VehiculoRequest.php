<?php


namespace Cantera\Transito\Vehiculo\Aplicacion;


class VehiculoRequest
{
    private $id;
    private $placa;
    private $tipo;
    private $capacidad;
    private $conductor_id;

    /**
     * VehiculoRequest constructor.
     * @param int $id
     * @param string $placa
     * @param string $tipo
     * @param int $capacidad
     * @param int $conductor_id
     */
    public function __construct(int $id,string $placa,string $tipo,int $capacidad,int $conductor_id)
    {
        $this->id = $id;
        $this->placa = $placa;
        $this->tipo = $tipo;
        $this->capacidad = $capacidad;
        $this->conductor_id = $conductor_id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPlaca(): string
    {
        return $this->placa;
    }

    /**
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @return int
     */
    public function getCapacidad(): int
    {
        return $this->capacidad;
    }

    /**
     * @return int
     */
    public function getConductorId(): int
    {
        return $this->conductor_id;
    }


}
