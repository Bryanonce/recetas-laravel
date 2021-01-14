<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\LikeRecetaController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CategoriasController;

Route::group(['prefix'=>'recetas'],function(){
    Route::get('',function(){
        return redirect()->route('recetas.index');
    });
    Route::get('index',[RecetaController::class,'index'])->name('recetas.index');
    Route::get('create',[RecetaController::class,'create'])->name('recetas.create');
    Route::get('{receta}',[RecetaController::class,'show'])->name('recetas.show');
    Route::post('store',[RecetaController::class,'store'])->name('recetas.store');
    Route::get('{receta}/edit',[RecetaController::class,'edit'])->name('recetas.edit');
    Route::put('{receta}',[RecetaController::class,'update'])->name('recetas.update');
    Route::delete('{receta}',[RecetaController::class,'destroy'])->name('recetas.destroy');
});

//Route::resource('recetas',RecetaController::class);

Route::post('likes/{receta}',[LikeRecetaController::class,'update'])->name('likes.update');

Route::group(['prefix'=>'perfiles'],function(){
    Route::get('{perfil}',[PerfilController::class,'show'])->name('perfiles.show');
    Route::get('{perfil}/edit',[PerfilController::class,'edit'])->name('perfiles.edit');
    Route::put('{perfil}',[PerfilController::class,'update'])->name('perfiles.update');
    Route::delete('{perfil}',[PerfilController::class,'destroy'])->name('perfiles.destroy');
});

Route::get('/categoria/{categoriaReceta}',[CategoriasController::class,'show'])->name('categorias.show');

Route::get('/',[InicioController::class,'index'])->name('inicio.index');

//Buscador de Recetas
Route::get('/buscar',[RecetaController::class,'search'])->name('recetas.search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
