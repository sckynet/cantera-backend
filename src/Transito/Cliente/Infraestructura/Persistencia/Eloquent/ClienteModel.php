<?php


namespace Cantera\Transito\Cliente\Infraestructura\Persistencia\Eloquent;


use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    protected $table='clientes';
    protected $fillable = ['identificacion','nombre','telefono','municipio','departamento','direccion','tipo','created_at','updated_at'];
}
