<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitysTable extends Migration
{
    /**
     * Запускает миграцию.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entitys', function (Blueprint $table) {
            $table->id();  // Первичный ключ, автоинкремент
            $table->string('title', 64);  // Строка для title, длина 64 символа
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
        Schema::dropIfExists('entitys');
    }
}
