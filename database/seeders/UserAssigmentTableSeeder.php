<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProjectSeeder;

class UserAssigmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userSeeder = new UserSeeder();
        $projectSeeder = new ProjectSeeder();

        $userSeeder->run();
        $projectSeeder->run();

        DB::table('user_assigment')->insert([
            'user_id' => 1,
            'project_id' => 2,
        ]);
    }
}
