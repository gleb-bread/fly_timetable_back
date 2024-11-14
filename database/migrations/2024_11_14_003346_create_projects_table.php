<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Запуск миграции.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();  // Создает столбец id (первичный ключ, AUTO_INCREMENT)
            $table->unsignedBigInteger('project_type_id');  // Столбец для связи с проектами
            $table->string('title', 64);  // Столбец для названия проекта

            // Внешний ключ для связи с таблицей project_types
            $table->foreign('project_type_id')->references('id')->on('project_types')
                  ->onDelete('cascade')  // Если проект-тип удален, то удаляются и связанные проекты
                  ->onUpdate('cascade');  // При обновлении id project_type_id в проекте, обновляется и ссылка

            $table->timestamps();  // Для created_at и updated_at
        });
    }

    /**
     * Откат миграции.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
