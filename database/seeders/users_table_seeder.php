<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Tymon\JWTAuth\Facades\JWTAuth;

class users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 15) as $index) {
            $user = \App\Models\User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bCrypt('12345'), // Cambia 'password' por la contraseña que desees
            ]);
            $token = JWTAuth::fromUser($user);
            $user->remember_token = $token;
            $user->save();
        }
    }
}
