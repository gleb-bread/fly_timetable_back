<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FlightSeeder extends Seeder
{
    /**
     * Запускает сидер.
     *
     * @return void
     */
    public function run()
    {
        // Инициализация Faker для генерации случайных данных
        $faker = Faker::create();

        $FlightTypeSeeder = new FlightTypeSeeder();

        $FlightTypeSeeder->run();

        // Генерация 100 записей для полетов
        for ($i = 0; $i < 100; $i++) {
            DB::table('flights')->insert([
                'flight_type_id' => rand(1, 3), // Ссылка на случайный тип полета (1, 2 или 3)
                'departure_from' => $faker->city,
                'destination' => $faker->city,
                'flight_number' => $faker->unique()->bothify('??###'),
                'departure_time' => $faker->dateTimeThisYear()->format('Y-m-d'),
                'arrival_time' => $faker->dateTimeThisYear()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
