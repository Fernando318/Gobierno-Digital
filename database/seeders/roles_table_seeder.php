<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class roles_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Administrador', 'description' => 'Puede consultar, crear y eliminar'],
            ['name' => 'Usuario', 'description' => 'Solo puede consultar datos']            
        ];
        DB::table('roles')->insert($data);
    }
}
