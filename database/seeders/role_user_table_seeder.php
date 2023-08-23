<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class role_user_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = User::all();
        $roles = ['1', '2']; // Roles

        foreach ($usuarios as $usuario) {
            $rolAleatorio = $roles[array_rand($roles)]; // Obtén un rol aleatorio
            DB::table('role_user')->insert([
                'user_id' => $usuario->id,
                'role_id' => $rolAleatorio,
            ]);
        }

    }
}
