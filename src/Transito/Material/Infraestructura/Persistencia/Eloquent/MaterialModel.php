<?php

namespace Cantera\Transito\Material\Infraestructura\Persistencia\Eloquent;

use Illuminate\Database\Eloquent\Model;

class MaterialModel extends Model
{

    protected $table = 'materiales';
    protected $fillable = ['id','nombre','created_at','updated_at'];

}
