<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GenerarTicketPostController extends Controller
{
   public function execute(Request $request){
       return response('',Response::HTTP_CREATED);
   }
}
