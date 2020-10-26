<?php

namespace App\Http\Controllers\Vehiculo;

use App\Http\Controllers\Controller;
use Cantera\Transito\Vehiculo\Aplicacion\GuardarVehiculoService;
use Cantera\Transito\Vehiculo\Aplicacion\VehiculoRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehiculoPostController extends Controller
{
    public function guardar(Request $request)
    {
        $placa = $request->placa;
        $tipo = $request->tipo;
        $capacidad = $request->capacidad;
        $conductor_id = $request->conductor_id;
        $vehiculoRequest = new VehiculoRequest(0, $placa, $tipo, $capacidad, $conductor_id);
        $servicio = app()->make(GuardarVehiculoService::class);
        $response = $servicio($vehiculoRequest);
        return response($response->getMensaje(), Response::HTTP_CREATED);
    }
}
