<?php

namespace App\Http\Controllers\Conductor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConductorGetController extends Controller
{
   public function buscar(string $id)
   {
      return response()->json([
          'identificacion' => '1065848333',
          'nombre' => 'camilo',
          'telefono' => '3017764758'
      ],Response::HTTP_OK);
   }
}
