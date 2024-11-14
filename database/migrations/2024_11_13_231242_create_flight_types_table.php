<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightTypesTable extends Migration
{
    /**
     * Запуск миграции.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_types', function (Blueprint $table) {
            $table->id(); // Создание автогенерируемого поля id
            $table->string('type'); // Поле "Тип полета" (Грузовой/Пасс.)
            $table->timestamps(); // Поля для создания и обновления
        });
    }

    /**
     * Откат миграции.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flight_types');
    }
}
