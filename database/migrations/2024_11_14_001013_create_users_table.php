<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Запускает миграцию.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Первичный ключ, auto increment
            $table->string('login', 32);  // Строка для логина, длина 32 символа
            $table->string('email')->unique();  // Обязательное поле email с уникальностью
            $table->string('name', 256)->nullable();  // Строка для имени, nullable
            $table->string('second_name', 256)->nullable();  // Строка для фамилии, nullable
            $table->text('password');  // Текстовое поле для пароля
            $table->timestamps();  // Столбцы created_at и updated_at
        });
    }

    /**
     * Откатывает миграцию.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
