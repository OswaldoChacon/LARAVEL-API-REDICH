<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JWTAuth;

class Vacante extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'titulo',
        'empresa',
        'sueldo',
        'sexo',
        'fecha_publicacion',
    ];
    protected $hidden = [
        'id'
    ];
    protected $appends = [
        'postulado'
    ];
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class,'postulaciones');
    }
    public function requisitos()
    {
        return $this->hasMany(Requisito::class);
    }

    public function getPostuladoAttribute()
    {        
        if (JWTAuth::user() != null) {            
            if (JWTAuth::user()->postulaciones()->get()->contains('id', $this->id))
                return true;
        }
        return false;
    }
    public function scopeEmpresa($query, $empresa)
    {
        return $query->where('empresa', $empresa);
    }
    public function scopeFechaPublicacion($query, $fecha)
    {
        return $query->where('fecha_publicacion', $fecha);
    }
    public function scopeSueldo($query,$sueldo)
    {
        return $query->where('sueldo','<=',$sueldo);
    }
}
