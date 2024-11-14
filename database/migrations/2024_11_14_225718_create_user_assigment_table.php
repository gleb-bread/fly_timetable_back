<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAssigmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_assigment', function (Blueprint $table) {
            $table->id(); // Поле id с AUTO_INCREMENT
            
            $table->unsignedBigInteger('user_id'); // Поле user_id
            $table->unsignedBigInteger('project_id'); // Поле project_id
            
            // Внешние ключи
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade') // Ограничение: запретить удаление
                ->onUpdate('cascade'); // Ограничение: запретить обновление

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade') // Каскадное удаление
                ->onUpdate('cascade'); // Каскадное обновление

            $table->timestamps(); // Поля created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_assigment');
    }
}
