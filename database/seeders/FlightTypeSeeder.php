<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightTypeSeeder extends Seeder
{
    /**
     * Запускает сидер.
     *
     * @return void
     */
    public function run()
    {
        // Пример типов полетов, которые ты хочешь добавить
        $flightTypes = [
            ['type' => 'Грузовой'],
            ['type' => 'Пассажирский'],
            ['type' => 'Гибридный'],
        ];

        // Добавляем типы полетов в таблицу flight_types
        DB::table('flight_types')->insert($flightTypes);
    }
}
