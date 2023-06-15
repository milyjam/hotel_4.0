<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClienteModel;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < env('QTD_CLIENTES', '1000'); $i++) {
            ClienteModel::create([
                'nome' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
