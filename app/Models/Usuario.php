<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'sexo',
        'fecha_nacimiento',
        'email',
        'password',
    ];
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
        'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'admin' => $this->getAdminAttribute()
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class);
    }
    public function experiencias()
    {
        return $this->hasMany(Experiencia::class);
    }
    public function postulaciones()
    {
        // return $this->hasMany(Postulacion::class);
        return $this->belongsToMany(Vacante::class,'postulaciones');
    }
    public function hasRole($rol)
    {
        if ($this->roles()->where('nombre', $rol)->first())
            return true;        
        return false;
    }
    public function hasAnyRole($rol)
    {
    }

    public function getAdminAttribute()
    {
        return $this->roles()->where('nombre', 'Administrador')->count() > 0;
    }
}
