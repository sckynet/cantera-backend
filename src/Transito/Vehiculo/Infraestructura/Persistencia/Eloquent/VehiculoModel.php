<?php


namespace Cantera\Transito\Vehiculo\Infraestructura\Persistencia\Eloquent;


use Illuminate\Database\Eloquent\Model;

class VehiculoModel extends Model
{
    protected $table = 'vehiculos';
    protected $fillable = ['id', 'placa', 'capacidad', 'tipo', 'conductor_id', 'created_at', 'updated_at'];

}
