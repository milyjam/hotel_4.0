<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReservasModel;
use App\Models\ClienteModel;
use App\Models\QuartoModel;
use App\Models\HotelModel;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ReservasSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('pt_BR');
        
        $clientes = ClienteModel::pluck('id')->toArray();
        $quartos = QuartoModel::pluck('id')->toArray();
        $hoteis = HotelModel::pluck('id')->toArray();

        for ($i = 0; $i < env('QTD_RESERVAS', '1000'); $i++) {
            $clienteId = $faker->randomElement($clientes);
            $quartoId = $faker->randomElement($quartos);
            $hotelId = $faker->randomElement($hoteis);

            $checkin = $faker->dateTimeBetween('-10 years', 'now');
            $checkout = $faker->dateTimeBetween($checkin, $checkin->format('Y-m-d').' +20 days');

            ReservasModel::create([
                'fk_cliente' => $clienteId,
                'fk_quarto' => $quartoId,
                'fk_hotel' => $hotelId,
                'checkin' => $checkin,
                'checkout' => $checkout,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
