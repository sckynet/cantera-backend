<?php

namespace App\Http\Controllers\Conductor;

use App\Http\Controllers\Controller;
use Cantera\Transito\Conductor\Aplicacion\ConductorRequest;
use Cantera\Transito\Conductor\Aplicacion\GuardarConductorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConductorPostController extends Controller
{
    public function guardar(Request $request){
        $identificacion = $request->identificacion;
        $nombre = $request->nombre;
        $telefono = $request->telefono;
        $request = new ConductorRequest($identificacion,$nombre,$telefono);
        $service = app()->make(GuardarConductorService::class);
        try{

            $response = $service($request);
        }catch (\Exception $e){
            var_dump($e);
        }

        return response($response->getMensaje(),Response::HTTP_CREATED);
    }
}
