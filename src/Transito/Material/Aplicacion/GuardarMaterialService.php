<?php

namespace Cantera\Transito\Material\Aplicacion;

use Cantera\Transito\Material\Dominio\IMaterialRepository;
use Cantera\Transito\Material\Dominio\Material;
use Cantera\Transito\Material\Dominio\MaterialId;
use Cantera\Transito\Material\Dominio\MaterialNombre;
use Cantera\Transito\Shared\Dominio\IUnitOfWork;
use Exception;

class GuardarMaterialService
{
    private $repository;
    private $unitOfWork;

    public function __construct(IMaterialRepository $repository, IUnitOfWork $unitOfWork)
    {
        $this->repository = $repository;
        $this->unitOfWork = $unitOfWork;
    }

    public function __invoke(MaterialRequest $request): GuardarMaterialResponse
    {
        try {
            $this->unitOfWork->beginTransaction();
            $material = new Material(new MaterialId($request->getId()), new MaterialNombre($request->getNombre()));
            $this->repository->save($material);
            $this->unitOfWork->commit();
            return new GuardarMaterialResponse(sprintf('El Material %s se guardo satisfactoriamente', $request->getNombre()));
        } catch (Exception $exception) {
            $this->unitOfWork->rollback();
            return new GuardarMaterialResponse(sprintf('El Material %s no pudo ser almacenado correctamente, intente más tarde. Error: %s', $request->getNombre(), $exception->getMessage()));
        }

    }

}
