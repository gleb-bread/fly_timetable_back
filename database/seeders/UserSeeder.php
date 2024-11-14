<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Запускает сидер.
     *
     * @return void
     */
    public function run()
    {
        // Создание пользователя с логином 'admin' и паролем '01234456789'
        $users = [
            [
                'login' => 'admin',
                'password' => Hash::make('01234456789'),  // Хешируем пароль перед сохранением
                'name' => 'Admin',  // Имя пользователя
                'second_name' => 'Adminovich',  // Фамилия
            ],
        ];

        // Добавляем пользователя в таблицу users
        DB::table('users')->insert($users);
    }
}
