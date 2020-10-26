<?php


namespace Cantera\Transito\Cliente\Aplicacion;


use Cantera\Transito\Cliente\Dominio\Cliente;
use Cantera\Transito\Cliente\Dominio\ClienteIdentificacion;
use Cantera\Transito\Cliente\Dominio\ClienteNombre;
use Cantera\Transito\Cliente\Dominio\ClienteTelefono;
use Cantera\Transito\Cliente\Dominio\ClienteTipo;
use Cantera\Transito\Cliente\Dominio\ClienteUbicacion;
use Cantera\Transito\Cliente\Dominio\IClienteRepository;
use Cantera\Transito\Shared\Dominio\IUnitOfWork;
use Exception;


class GuardarClienteService
{
    private $repository;
    private $unitOfWork;

    public function __construct(IClienteRepository $repository, IUnitOfWork $unitOfWork)
    {
        $this->repository = $repository;
        $this->unitOfWork = $unitOfWork;
    }

    public function __invoke(ClienteRequest $request): GuardarClienteResponse
    {
        try {
            $this->unitOfWork->beginTransaction();
            $identificacion = new ClienteIdentificacion($request->getIdentificacion());
            $nombre = new ClienteNombre($request->getNombre());
            $telefono = new ClienteTelefono($request->getTelefono());
            $ubicacion = new ClienteUbicacion($request->getMunicipio(), $request->getDepartamento(), $request->getDireccion());
            $tipo = new ClienteTipo($request->getTipo());
            $cliente = new Cliente($identificacion, $nombre, $telefono, $ubicacion, $tipo);
            $this->repository->save($cliente);
            $this->unitOfWork->commit();
            return new GuardarClienteResponse(sprintf('El Cliente %s se guardo satisfactoriamente', $request->getNombre()));
        } catch (Exception $exception) {
            $this->unitOfWork->rollback();
            return new GuardarClienteResponse(sprintf('El Cliente %s no pudo se almacenado correctamente, intente más tarde. Error: ', $request->getNombre(), $exception->getMessage()));
        }


    }
}
