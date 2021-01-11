<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PerfilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

Route::group(['prefix'=>'perfiles'],function(){
    Route::get('{perfil}',[PerfilController::class,'show'])->name('perfiles.show');
    Route::get('{perfil}/edit',[PerfilController::class,'edit'])->name('perfiles.edit');
    Route::put('{perfil}',[PerfilController::class,'update'])->name('perfiles.update');
});
//Route::get('/recetas',[RecetaController::class,'index'])->name('recetas.index');

//Route::get('/recetas',[RecetaController::class,'index'])->name('recetas.index');

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
