<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipo_canal extends Model
{
    use HasFactory;
    protected $table = "canales";
    public $timestamps = false;
    public function equipo(){
        return $this->belongsTo(equipo::class,'id_equipo');
    }
    protected $fillable = [
        'tipo_placa',
        'id_equipo',
        'altura_agua',
        'altura_sensor',
        'altura_max_canal'    
    ];

}
