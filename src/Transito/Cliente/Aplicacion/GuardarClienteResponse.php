<?php


namespace Cantera\Transito\Cliente\Aplicacion;


class GuardarClienteResponse
{
    private $mensaje;

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
