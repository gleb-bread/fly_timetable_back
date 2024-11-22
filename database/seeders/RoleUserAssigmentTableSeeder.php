<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UserAssigmentTableSeeder;

class RoleUserAssigmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $rolesTableSeeder = new RolesTableSeeder();
        $userAssigmentTableSeeder = new UserAssigmentTableSeeder();

        $rolesTableSeeder->run();
        $userAssigmentTableSeeder->run();

        DB::table('role_user_assigment')->insert([
            'user_assigment_id' => 1,
            'role_id' => 2,
        ]);
    }
}
