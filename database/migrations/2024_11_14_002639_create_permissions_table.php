<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Запуск миграции.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();  // Первичный ключ
            $table->foreignId('entity_id')->constrained('entitys')->onDelete('cascade')->onUpdate('cascade');  // Внешний ключ на таблицу entitys
            $table->foreignId('action_id')->constrained('actions')->onDelete('cascade')->onUpdate('cascade');  // Внешний ключ на таблицу actions
            $table->timestamps();  // Время создания и обновления записи
        });
    }

    /**
     * Откат миграции.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
