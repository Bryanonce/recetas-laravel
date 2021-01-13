<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receta;
use App\Models\User;

class LikeReceta extends Model
{
    //use HasFactory;

    protected $fillable = [
        'user_id',
        'receta_id',
    ];

    public function likes(){
        return $this->belongsTo(Receta::class,'receta_id');
    }

    public function meGusta(){
        return $this->belongsTo(User::class,'user_id');
    }

}
