<?php
namespace Cantera\Transito\Material\Aplicacion;

use Cantera\Transito\Material\Dominio\IMaterialRepository;
use Cantera\Transito\Material\Dominio\Material;
use Cantera\Transito\Material\Dominio\MaterialId;
use Cantera\Transito\Material\Dominio\MaterialNombre;

class GuardarMaterialService
{
     private $repository;

    public function __construct(IMaterialRepository $repository)
    {
        $this->repository =  $repository;
    }

    public function __invoke(MaterialRequest $request) : GuardarMaterialResponse
    {
        $material = new Material(new MaterialId($request->getId()),new MaterialNombre($request->getNombre()));
        $this->repository->save($material);

        return new GuardarMaterialResponse(sprintf('El Material %s se guardo satisfactoriamente',$request->getNombre()));
    }

}
