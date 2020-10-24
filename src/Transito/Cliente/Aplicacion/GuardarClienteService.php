<?php


namespace Cantera\Transito\Cliente\Aplicacion;


use Cantera\Transito\Cliente\Dominio\Cliente;
use Cantera\Transito\Cliente\Dominio\ClienteIdentificacion;
use Cantera\Transito\Cliente\Dominio\ClienteNombre;
use Cantera\Transito\Cliente\Dominio\ClienteTelefono;
use Cantera\Transito\Cliente\Dominio\ClienteTipo;
use Cantera\Transito\Cliente\Dominio\ClienteUbicacion;

class GuardarClienteService
{
    private $repository;

    public function __construct(IClienteRepository $repository)
    {
        $this->repository = $repository;
    }
    public function __invoke(ClienteRequest $request) : GuardarClienteResponse
    {
        $identificacion=new ClienteIdentificacion($request->getIdentificacion());
        $nombre=new ClienteNombre($request->getNombre());
        $telefono=new ClienteTelefono($request->getTelefono());
        $ubicacion=new ClienteUbicacion($request->getMunicipio(),$request->getDepartamento(),$request->getDireccion());
        $tipo=new ClienteTipo($request->getTipo());

        $cliente= new Cliente($identificacion,$nombre,$telefono, $ubicacion,$tipo);
        $this->repository->save($cliente);

        return new GuardarClienteResponse(sprintf('El Cliente %s se guardo satisfactoriamente',$request->getNombre()));

    }
}
