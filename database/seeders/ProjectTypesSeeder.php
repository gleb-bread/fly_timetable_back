<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTypesSeeder extends Seeder
{
    /**
     * Запускает сидер.
     *
     * @return void
     */
    public function run()
    {
        // Массив с типами проектов
        $projectTypes = [
            ['title' => 'user'],
            ['title' => 'stuff'],
        ];

        // Вставка значений только если их нет
        foreach ($projectTypes as $type) {
            DB::table('project_types')->updateOrInsert(
                ['title' => $type['title']], // Условие уникальности
                $type                        // Данные для вставки/обновления
            );
        }
    }
}
