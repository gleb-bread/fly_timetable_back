<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Запускает все сидеры.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleUserAssigmentTableSeeder::class,
            RolePermissionTableSeeder::class,
            FlightSeeder::class
        ]);
    }
}
