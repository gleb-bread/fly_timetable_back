<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Запуск миграции.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id(); // Создание автогенерируемого поля id
            $table->foreignId('flight_type_id')->constrained()->onDelete('cascade'); // Внешний ключ на таблицу типов полетов
            $table->string('departure_from'); // Поле "Откуда вылет"
            $table->string('destination'); // Поле "Куда вылет"
            $table->string('flight_number'); // Поле "Номер рейса"
            $table->datetimes('departure_time'); // Поле "Во сколько вылет"
            $table->datetimes('arrival_time'); // Поле "Во сколько прилет"
            $table->timestamps(); // Поля "Дата создания" и "Дата обновления"
        });
    }

    /**
     * Откат миграции.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
