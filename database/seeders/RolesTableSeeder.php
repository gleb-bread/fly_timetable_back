<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
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
        ]);
    }
}
