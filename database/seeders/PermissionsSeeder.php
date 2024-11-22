<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\ActionSeeder;
use Database\Seeders\EntitySeeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Запускает сидер.
     *
     * @return void
     */
    public function run()
    {
        // Запуск зависимых сидеров
        $actionSeeder = new ActionSeeder();
        $entitySeeder = new EntitySeeder();

        $actionSeeder->run();
        $entitySeeder->run();

        // Массив данных для вставки
        $permissions = [
            ['entity_id' => 1, 'action_id' => 1],
            ['entity_id' => 1, 'action_id' => 2],
            ['entity_id' => 1, 'action_id' => 3],
            ['entity_id' => 1, 'action_id' => 4],
            ['entity_id' => 1, 'action_id' => 5],
            ['entity_id' => 1, 'action_id' => 6],
            ['entity_id' => 1, 'action_id' => 7],
            ['entity_id' => 2, 'action_id' => 1],
            ['entity_id' => 2, 'action_id' => 2],
            ['entity_id' => 2, 'action_id' => 3],
            ['entity_id' => 2, 'action_id' => 4],
            ['entity_id' => 2, 'action_id' => 5],
            ['entity_id' => 2, 'action_id' => 6],
            ['entity_id' => 2, 'action_id' => 7],
            ['entity_id' => 3, 'action_id' => 1],
            ['entity_id' => 3, 'action_id' => 2],
            ['entity_id' => 3, 'action_id' => 3],
            ['entity_id' => 3, 'action_id' => 4],
            ['entity_id' => 3, 'action_id' => 5],
            ['entity_id' => 3, 'action_id' => 6],
            ['entity_id' => 3, 'action_id' => 7],
            ['entity_id' => 4, 'action_id' => 1],
            ['entity_id' => 4, 'action_id' => 2],
            ['entity_id' => 4, 'action_id' => 3],
            ['entity_id' => 4, 'action_id' => 4],
            ['entity_id' => 4, 'action_id' => 5],
            ['entity_id' => 4, 'action_id' => 6],
            ['entity_id' => 4, 'action_id' => 7],
            ['entity_id' => 5, 'action_id' => 1],
            ['entity_id' => 5, 'action_id' => 2],
            ['entity_id' => 5, 'action_id' => 3],
            ['entity_id' => 5, 'action_id' => 4],
            ['entity_id' => 5, 'action_id' => 5],
            ['entity_id' => 5, 'action_id' => 6],
            ['entity_id' => 5, 'action_id' => 7],
            ['entity_id' => 6, 'action_id' => 1],
            ['entity_id' => 6, 'action_id' => 2],
            ['entity_id' => 6, 'action_id' => 3],
            ['entity_id' => 6, 'action_id' => 4],
            ['entity_id' => 6, 'action_id' => 5],
            ['entity_id' => 6, 'action_id' => 6],
            ['entity_id' => 6, 'action_id' => 7],
            ['entity_id' => 7, 'action_id' => 1],
            ['entity_id' => 7, 'action_id' => 2],
            ['entity_id' => 7, 'action_id' => 3],
            ['entity_id' => 7, 'action_id' => 4],
            ['entity_id' => 7, 'action_id' => 5],
            ['entity_id' => 7, 'action_id' => 6],
            ['entity_id' => 7, 'action_id' => 7],
            ['entity_id' => 8, 'action_id' => 1],
            ['entity_id' => 8, 'action_id' => 2],
            ['entity_id' => 8, 'action_id' => 3],
            ['entity_id' => 8, 'action_id' => 4],
            ['entity_id' => 8, 'action_id' => 5],
            ['entity_id' => 8, 'action_id' => 6],
            ['entity_id' => 8, 'action_id' => 7],
            ['entity_id' => 9, 'action_id' => 1],
            ['entity_id' => 9, 'action_id' => 2],
            ['entity_id' => 9, 'action_id' => 3],
            ['entity_id' => 9, 'action_id' => 4],
            ['entity_id' => 9, 'action_id' => 5],
            ['entity_id' => 9, 'action_id' => 6],
            ['entity_id' => 9, 'action_id' => 7],
            ['entity_id' => 10, 'action_id' => 1],
            ['entity_id' => 10, 'action_id' => 2],
            ['entity_id' => 10, 'action_id' => 3],
            ['entity_id' => 10, 'action_id' => 4],
            ['entity_id' => 10, 'action_id' => 5],
            ['entity_id' => 10, 'action_id' => 6],
            ['entity_id' => 10, 'action_id' => 7],
            ['entity_id' => 11, 'action_id' => 1],
            ['entity_id' => 11, 'action_id' => 2],
            ['entity_id' => 11, 'action_id' => 3],
            ['entity_id' => 11, 'action_id' => 4],
            ['entity_id' => 11, 'action_id' => 5],
            ['entity_id' => 11, 'action_id' => 6],
            ['entity_id' => 11, 'action_id' => 7],
        ];

        // Вставка значений только если их нет
        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['entity_id' => $permission['entity_id'], 'action_id' => $permission['action_id']], // Условие уникальности
                $permission // Данные для вставки
            );
        }
    }
}
