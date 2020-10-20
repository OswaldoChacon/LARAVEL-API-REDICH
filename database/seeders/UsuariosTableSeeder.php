<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usuarios')->insert([
            'nombre' => 'admin',
            'apellidos' => 'admin',
            'sexo' => 'Masculino',
            'fecha_nacimiento' => '2000-01-01',
            'edad'=>30,
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
    }
}
