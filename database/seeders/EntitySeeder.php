<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\Entity;

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
            ['title' => Entity::ALL],
            ['title' => Entity::FLIGHT],
            ['title' => Entity::FLIGHT_TYPE],
            ['title' => Entity::USER],
            ['title' => Entity::RIGHT],
            ['title' => Entity::ACTION],
            ['title' => Entity::ENTITY],
            ['title' => Entity::PERMISSION],
            ['title' => Entity::PROJECT],
            ['title' => Entity::PROJECT_TYPE],
            ['title' => Entity::ROLE],
            ['title' => Entity::CART],
            ['title' => Entity::APPLICATION],
            ['title' => Entity::ANALYTIC],
        ];

        // Добавляем записи в таблицу entitys
        DB::table('entitys')->insert($entities);
    }
}
