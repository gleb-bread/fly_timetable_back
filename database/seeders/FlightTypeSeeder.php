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

        foreach ($flightTypes as $flightType) {
            // Проверяем, существует ли запись с таким типом
            $exists = DB::table('flight_types')
                ->where('type', $flightType['type'])
                ->exists();

            if (!$exists) {
                // Если запись не существует, добавляем её
                DB::table('flight_types')->insert($flightType);
            }
        }
    }
}
