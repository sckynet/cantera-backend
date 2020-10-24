<?php

namespace Cantera\Transito\Conductor\Infraestructura\Persistencia\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ConductorModel extends Model
{
   protected $table = 'conductores';
   protected $fillable = ['identificacion','nombre','telefono'];
}
