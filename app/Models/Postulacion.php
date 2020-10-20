<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;
    protected $table = 'postulaciones';
    public $timestamps = false;
    protected $fillable = [

    ];
    protected $hidden = [
        'usuario_id', 'vacante_id'
    ];

    public function vacante()
    {
        return $this->belongsTo(Vacante::class);
    }
    public function usuario()
    {
        return $this->belongsToMany(Usuario::class);
    }
}
