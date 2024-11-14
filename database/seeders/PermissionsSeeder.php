<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Запускает сидер.
     *
     * @return void
     */
    public function run()
    {
        // Вставляем данные в таблицу permissions
        DB::table('permissions')->insert([
            ['entity_id' => 1, 'action_id' => 1],
            ['entity_id' => 1, 'action_id' => 2],
            ['entity_id' => 1, 'action_id' => 3],
            ['entity_id' => 1, 'action_id' => 4],
            ['entity_id' => 1, 'action_id' => 5],
        ]);
    }
}
