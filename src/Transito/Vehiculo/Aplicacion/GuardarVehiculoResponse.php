<?php


namespace Cantera\Transito\Vehiculo\Aplicacion;


class GuardarVehiculoResponse
{
    private $mensaje;

    /**
     * GuardarVehiculoResponse constructor.
     * @param string $mensaje
     */
    public function __construct(string $mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * @return string
     */
    public function getMensaje(): string
    {
        return $this->mensaje;
    }


}
