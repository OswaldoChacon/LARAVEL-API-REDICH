<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nombre'
    ];
    protected $hidden = [
        'id'
    ];

    public function vacante()
    {
        return $this->belongsTo(Vacante::class);
    }
}
