<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    use HasFactory;
    // empresa, fecha inicio, fecha fin, actividades que realizó
    public $timestamps = false;
    protected $fillable = [
        // 'puesto',
        'empresa',
        'fecha_inicio',
        'fecha_fin',
        'actividades',
    ];
    protected $hidden = [
        'id'
    ];
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
    public function getRouteKeyName()
    {
        return 'empresa';
    }
}
