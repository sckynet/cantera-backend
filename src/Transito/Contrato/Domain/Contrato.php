<?php


namespace Cantera\Transito\Contrato\Domain;


class Contrato
{
    private $id;
    private $serie;
    private $ubicacion;
    private $fecha;

    /**
     * Contrato constructor.
     * @param ContratoId $id
     * @param ContratoSerie $serie
     * @param ContratoUbicacion $ubicacion ;
     * @param ContratoFecha $fecha ;
     */
    public function __construct(ContratoId $id, ContratoSerie $serie, ContratoUbicacion $ubicacion, ContratoFecha $fecha)
    {
        $this->id = $id;
        $this->serie = $serie;
        $this->ubicacion = $ubicacion;
        $this->fecha = $fecha;
    }

    /**
     * @return ContratoId
     */
    public function getId(): ContratoId
    {
        return $this->id;
    }

    /**
     * @return ContratoSerie
     */
    public function getSerie(): ContratoSerie
    {
        return $this->serie;
    }

    /**
     * @return ContratoUbicacion
     */
    public function getUbicacion(): ContratoUbicacion
    {
        return $this->ubicacion;
    }

    /**
     * @return ContratoFecha
     */
    public function getFecha(): ContratoFecha
    {
        return $this->fecha;
    }

}
