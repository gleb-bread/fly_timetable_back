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
            FlightTypeSeeder::class,
            FlightSeeder::class,
            UserSeeder::class,
            EntitySeeder::class,
            ActionSeeder::class,
            PermissionsSeeder::class,
            ProjectSeeder::class
        ]);
    }
}
