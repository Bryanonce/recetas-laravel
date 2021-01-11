<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
USE App\Models\CategoriaReceta;

class Receta extends Model
{

    //Campos que se agregarán
    protected $fillable = [
        'titulo',
        'ingredientes',
        'preparacion',
        'imagen',
        'categoria_id',
    ];

    //use HasFactory;
    //Obtiene la categoria de la Receta
    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }

    //Un usuario tiene varias recetas
    public function user(){
        return $this->belongsTo(User::class);
    }



}
