<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Запуск миграции.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Автогенерируемый идентификатор
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Внешний ключ на таблицу users
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade'); // Внешний ключ на таблицу flights
            $table->integer('count'); // Количество
            $table->timestamps(); // Дата создания и обновления
        });
    }

    /**
     * Откат миграции.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
