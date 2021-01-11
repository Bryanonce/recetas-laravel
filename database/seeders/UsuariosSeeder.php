<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'name' => 'Mark Zukerberg',
            'email' => 'mark@fb.com',
            'password' => Hash::make('123456789'),
            'url' => 'https://www.facebook.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));

        User::create(array(
            'name' => 'Evan Spiegel',
            'email' => 'evan@snapchat.com',
            'password' => Hash::make('123456789'),
            'url' => 'https://www.snapchat.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));

        User::create(array(
            'name' => 'Jeff Bezzos',
            'email' => 'jeff@amazon.com',
            'password' => Hash::make('123456789'),
            'url' => 'https://www.amazon.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        
    }
}
