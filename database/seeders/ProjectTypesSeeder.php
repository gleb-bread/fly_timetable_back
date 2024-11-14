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

        // Вставка значений в таблицу project_types
        DB::table('project_types')->insert($projectTypes);
    }
}
