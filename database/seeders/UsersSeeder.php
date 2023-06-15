<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserModel;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < env('QTD_USERS', '1000'); $i++) {
            UserModel::create([
                'nome' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make($faker->password),
                'profile' => 'cliente',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        UserModel::create([
            'nome' => env('ADMIN_NAME', 'Administrador'),
            'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
            'password' => env('ADMIN_PASS', '123456'),
            'password' => Hash::make(env('ADMIN_PASS', '123456')),
            'profile' => 'administrador',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
