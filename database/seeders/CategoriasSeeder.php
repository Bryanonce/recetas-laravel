<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_recetas')->insert(array(
            'nombre' => 'Comida Mexicana',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('categoria_recetas')->insert(array(
            'nombre' => 'Comida Italiana',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('categoria_recetas')->insert(array(
            'nombre' => 'Comida Argentina',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('categoria_recetas')->insert(array(
            'nombre' => 'Comida Ecuatoriana',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('categoria_recetas')->insert(array(
            'nombre' => 'Cortes de Carne',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
    }
}
