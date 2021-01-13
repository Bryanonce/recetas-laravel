<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Receta;
use App\Models\Perfil;
use App\Models\LikeReceta;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Un evento que se ejecuta cuando un usuario es creado
    protected static function boot(){
        parent::boot();
        //asignar perfil una vez se haya creado
        static::created(function($user){
            $user->perfil()->create();
        });
    }

    /* Relación de uno a muchos de usuarios a Recetas */
    public function recetas(){
        return $this->hasMany(Receta::class);
    }

    /* Relación de uno a uno */
    public function perfil(){
        return $this->hasOne(Perfil::class);
    }

    public function meGusta(){
        return $this->hasMany(LikeReceta::class);
    }
}
