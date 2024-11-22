<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\ProjectTypesSeeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Запуск сидера ProjectTypesSeeder
        $projectTypesSeeder = new ProjectTypesSeeder();
        $projectTypesSeeder->run();

        // Массив с ролями
        $roles = [
            [
                'title' => 'user',
                'project_type_id' => 1,
            ],
            [
                'title' => 'admin',
                'project_type_id' => 2,
            ],
            [
                'title' => 'manager',
                'project_type_id' => 2,
            ],
        ];

        // Вставка значений только если их нет
        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['title' => $role['title'], 'project_type_id' => $role['project_type_id']], // Условие уникальности
                $role // Данные для вставки/обновления
            );
        }
    }
}
