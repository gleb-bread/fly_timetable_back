<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Запуск сидера.
     *
     * @return void
     */
    public function run()
    {
        $ProjectTypesSeeder = new ProjectTypesSeeder();

        $ProjectTypesSeeder->run();

        // Добавляем проекты в таблицу projects
        $projects = [
            ['project_type_id' => 1, 'title' => 'Проект с расписанием'],
            ['project_type_id' => 2, 'title' => 'Проект с редактированием'],
        ];

        // Вставляем проекты в таблицу projects
        DB::table('projects')->insert($projects);
    }
}
