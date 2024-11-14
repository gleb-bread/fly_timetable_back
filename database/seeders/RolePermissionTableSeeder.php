<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permission')->insert([
            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 2, 'permission_id' => 6],
            ['role_id' => 2, 'permission_id' => 12],
            ['role_id' => 3, 'permission_id' => 6],
        ]);
    }
}
