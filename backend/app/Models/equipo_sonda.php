<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipo_sonda extends Model
{
    use HasFactory;
    protected $table = "sonda";
    public $timestamps = false;
    public function equipo(){
        return $this->belongsTo(equipo::class,'id_equipo');
    }
    protected $fillable = [
        'tipo_placa',
        'compania3G',
        'id_equipo',
        'tipo_sonda',
        'largo_sonda'    
    ];
    
}
