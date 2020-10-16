<?php


namespace Cantera\Transito\Conductor\Dominio;


class Conductor
{
    private $id;
    private $nombre;
    private $telefono;

    /**
     * Conductor constructor.
     * @param ConductorId $id
     * @param ConductorNombre $nombre
     * @param CondutorTelefono $telefono
     */
    public function __construct(string $id, string $nombre, string $telefono) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
    }

    /**
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre(): string {
        return $this->nombre;
    }

    /**
     * @return string
     */
    public function getTelefono(): string {
        return $this->telefono;
    }

}
