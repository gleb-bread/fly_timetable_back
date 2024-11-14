<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Запускает сидер.
     *
     * @return void
     */
    public function run()
    {
        // Массив значений, которые будут добавлены в таблицу actions
        $actions = [
            ['title' => 'get'],
            ['title' => 'create'],
            ['title' => 'update'],
            ['title' => 'delete'],
            ['title' => 'buy'],
            ['title' => 'all']
        ];

        // Добавляем записи в таблицу actions
        DB::table('actions')->insert($actions);
    }
}
