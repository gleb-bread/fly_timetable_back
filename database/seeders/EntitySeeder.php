<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntitySeeder extends Seeder
{
    /**
     * Запускает сидер.
     *
     * @return void
     */
    public function run()
    {
        // Пример значений для столбца title в таблице entitys
        $entities = [
            ['title' => 'all'],
            ['title' => 'flight'],
            ['title' => 'flightType'],
            ['title' => 'user'],
            ['title' => 'right'],
        ];

        // Добавляем записи в таблицу entitys
        DB::table('entitys')->insert($entities);
    }
}
