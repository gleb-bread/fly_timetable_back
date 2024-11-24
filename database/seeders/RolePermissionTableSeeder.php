<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\PermissionsSeeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesTableSeeder = new RolesTableSeeder();
        $permissionsSeeder = new PermissionsSeeder();

        $rolesTableSeeder->run();
        $permissionsSeeder->run();
        
        DB::table('role_permission')->insert([
            ['role_id' => 2, 'permission_id' => 6],
            ['role_id' => 3, 'permission_id' => 12],
            ['role_id' => 1, 'permission_id' => 8],
            ['role_id' => 1, 'permission_id' => 68],
            ['role_id' => 1, 'permission_id' => 69],
            ['role_id' => 1, 'permission_id' => 70],
            ['role_id' => 1, 'permission_id' => 71],
        ]);
    }
}