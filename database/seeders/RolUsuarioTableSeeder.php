<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rol_usuario')->insert([
            'rol_id'=>Rol::where('nombre','Administrador')->firstOrFail()->id,
            'usuario_id'=>Usuario::where('email','admin@admin.com')->firstOrFail()->id
        ]);
    }
}
