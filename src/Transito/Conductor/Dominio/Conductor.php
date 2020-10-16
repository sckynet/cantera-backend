<?php


namespace Cantera\Transito\Conductor\Dominio;


class Conductor
{
    private $id;
    private $nombre;
    private $telefono;


    public function __construct(ConductorId $id, ConductorNombre $nombre, CondutorTelefono $telefono) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
    }

    /**
     * @return string
     */
    public function getId(): ConductorId {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre(): ConductorNombre {
        return $this->nombre;
    }

    /**
     * @return string
     */
    public function getTelefono(): CondutorTelefono {
        return $this->telefono;
    }

}
