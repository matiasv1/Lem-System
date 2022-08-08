<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipo_pozo extends Model
{
    use HasFactory;
    protected $table = "pozos";
    public $timestamps = false;
    public function equipo(){
        return $this->belongsTo(equipo::class,'id_equipo');
    }
    protected $fillable = [
        'compania3G',
        'id_equipo',
        'profundidad_pozo',
        'nivel_estatico',
        'nivel_dinamico',
        'referencia_sh',
        'tipo_sensor',
        'tipo_energia',
        'factor_pulsos'    
    ];

}
