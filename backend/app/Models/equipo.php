<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipo extends Model
{
    use HasFactory;
    protected $table = "equipo";

    const CREATED_AT = 'time_create';
    const UPDATED_AT = 'time_update';

    public function users(){
        return $this->belongsTo(User::class,'id_tecnico');
    }
    public function equipo_coordinador(){
        return $this->hasOne(equipo_coordinador::class,'id_equipo');
    }

    public function equipo_canal(){
        return $this->hasOne(equipo_canal::class,'id_equipo');
    }

    public function equipo_sonda(){
        return $this->hasOne(equipo_sonda::class,'id_equipo');
    }
    public function equipo_estacion(){
        return $this->hasOne(equipo_estacion::class,'id_equipo');
    }
    public function equipo_pozo(){
        return $this->hasOne(equipo_pozo::class,'id_equipo');
    }

    

    protected $fillable = [
        'nombre',
        'ubicacion',
        'observaciones',
        'firmware',
        'frecuencia_de_envio'   
    ];

    
}
