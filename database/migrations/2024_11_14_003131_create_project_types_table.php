<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTypesTable extends Migration
{
    /**
     * Выполнить миграцию.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_types', function (Blueprint $table) {
            $table->id();  // id (первичный ключ)
            $table->string('title', 64);  // title (varchar(64))
            $table->timestamps();  // created_at и updated_at
        });
    }

    /**
     * Откатить миграцию.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_types');
    }
}
