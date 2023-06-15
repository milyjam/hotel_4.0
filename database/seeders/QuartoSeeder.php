<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuartoModel;
use App\Models\HotelModel;
use Faker\Factory as Faker;
use App\Http\Resources\GetImageResource;

class QuartoSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $hoteis = HotelModel::all();
        $realImages = GetImageResource::getImage('hotel', env('QTD_QUARTO', '1000'));
        for ($i = 0; $i < env('QTD_QUARTO', '1000'); $i++) {
            $hotel = $hoteis->random();

            QuartoModel::create([
                'fk_hotel' => $hotel->id,
                'nome' => $faker->word,
                'descricao' => $faker->sentence,
                'valor_diaria' => $faker->randomFloat(2, 50, 200),
                'status' => $faker->randomElement(['disponível', 'ocupado']),
                'imagem' => $realImages[$i]['urls']['regular'] ?? $faker->imageUrl(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
