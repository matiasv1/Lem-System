<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "users";
    public $timestamps = false;
    
    public function equipos(){
        return $this->hasMany(equipo::class,'id_equipo');
    }

    protected $fillable = [
        'name',
        'email',
        'telefono',
        
        
    ];
    
}
