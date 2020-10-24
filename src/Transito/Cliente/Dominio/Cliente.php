<?php


namespace Cantera\Transito\Cliente\Dominio;


use Cantera\Transito\Shared\Dominio\ValueObject\UbicacionValueObject;

class Cliente
{


   private $identificacion;
   private $nombre;
   private $ubicacion;
   private $telefono;
   private $tipo;

   public function __construct(ClienteIdentificacion $identificacion, ClienteNombre $nombre, ClienteTelefono $telefono,ClienteUbicacion $ubicacion,ClienteTipo $tipo)
   {

            $this->identificacion = $identificacion;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->ubicacion = $ubicacion;
            $this->tipo = $tipo;
   }

    /**
     * @return ClienteId
     */
    public function getId(): ClienteId
    {
        return $this->id;
    }

    /**
     * @return ClienteNombre
     */
    public function getNombre(): ClienteNombre
    {
        return $this->nombre;
    }

    /**
     * @return ClienteUbicacion
     */
    public function getUbicacion(): ClienteUbicacion
    {
        return $this->ubicacion;
    }

    /**
     * @return ClienteTelefono
     */
    public function getTelefono(): ClienteTelefono
    {
        return $this->telefono;
    }

    /**
     * @return ClienteTipo
     */
    public function getTipo(): ClienteTipo
    {
        return $this->tipo;
    }

    public function getIdentificacion() : CLienteIdentificacion {
        return $this->identificacion;
    }

    public function toArray() : array {
        return [
            'identificacion' => $this->getIdentificacion()->value(),
            'nombre' => $this->getNombre()->value(),
            'telefono' => $this->getTelefono()->value(),
            'municipio' => $this->getUbicacion()->getMunicipio(),
            'departamento' => $this->getUbicacion()->getDepartamento(),
            'direccion' => $this->getUbicacion()->getDireccion(),
            'tipo' => $this->getTipo()->value(),
        ];
    }

}
