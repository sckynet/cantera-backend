<?php

namespace App\Http\Controllers\CLiente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientePostController extends Controller
{
    public function guardar(Request $request)
    {
        $identificacion = $request->identificacion;
        $nombre = $request->nombre;
        $muncipio = $request->municipio;
        $departamento = $request->departamento;
        $direccion = $request->direccion;
        $telefono = $request->telefono;
        $request = new ClienteRequest($identificacion,$nombre,$muncipio,$departamento,$direccion,$telefono);
        $service = app()->make(GuardarClienteService::class);
        $response = $service($request);
        return response($response->getMensaje(),Response::HTTP_CREATED);
    }
}
