<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receta;

class CategoriaReceta extends Model
{
    public function recetas(){
        return $this->hasMany(Receta::class);
    }
}
