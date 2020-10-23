<?php


namespace Cantera\Transito\Material\Aplicacion;

final class GuardarMaterialResponse
{
    private $mensaje;

    public function __construct(string $mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function getMensaje(): string
    {
        return $this->mensaje;
    }

}
