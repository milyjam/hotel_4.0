<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelModel;
use Faker\Factory as Faker;
use App\Http\Resources\GetImageResource;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('pt_BR');
        $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
        $realImages = GetImageResource::getImage('hotel', env('QTD_HOTEL', '1000'));

        for ($i = 0; $i < env('QTD_HOTEL', '1000'); $i++) {
            HotelModel::create([
                'nome' => $faker->company,
                'descricao' => $faker->sentence(25),
                'cidade' => $faker->city,
                'estado' => $faker->state,
                'pais' => $faker->country,
                'status' => $faker->randomElement(['ativo', 'inativo']),
                'imagem' => $realImages[$i]['urls']['regular'] ?? $faker->imageUrl(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
