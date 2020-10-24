<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use Cantera\Transito\Material\Aplicacion\GuardarMaterialService;
use Cantera\Transito\Material\Aplicacion\MaterialRequest;
use Cantera\Transito\Material\Dominio\IMaterialRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MaterialPostController extends Controller
{
    public function guardar(Request $request){
        $nombre = $request->nombre;
        $request = new MaterialRequest(0,$nombre);
        $service = app()->make(GuardarMaterialService::class);
        $response = $service($request);
        return response($response->getMensaje(),Response::HTTP_CREATED);
    }
}
