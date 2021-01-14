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
            'nombre' => 'Desayunos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('categoria_recetas')->insert(array(
            'nombre' => 'Almuerzos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('categoria_recetas')->insert(array(
            'nombre' => 'Meriendas',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('categoria_recetas')->insert(array(
            'nombre' => 'Postres',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('categoria_recetas')->insert(array(
            'nombre' => 'Comida Nacional',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('categoria_recetas')->insert(array(
            'nombre' => 'Comida Extrangera',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
    }
}
