<?php


namespace Cantera\Transito\Conductor\Dominio;


class Conductor
{
    private $id;
    private $identificacion;
    private $nombre;
    private $telefono;


    public function __construct(ConductorId $id,ConductorIdentificacion $identificacion, ConductorNombre $nombre, CondutorTelefono $telefono) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->identificacion = $identificacion;
    }

    /**
     * @return ConductorIdentificacion
     */
    public function getIdentificacion(): ConductorIdentificacion
    {
        return $this->identificacion;
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
