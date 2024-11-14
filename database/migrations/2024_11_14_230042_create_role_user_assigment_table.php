<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserAssigmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user_assigment', function (Blueprint $table) {
            $table->id(); // Поле id с AUTO_INCREMENT

            $table->unsignedBigInteger('user_assigment_id'); // Поле user_assigment_id
            $table->unsignedBigInteger('role_id'); // Поле role_id

            // Внешние ключи
            $table->foreign('user_assigment_id')
                ->references('id')
                ->on('user_assigment')
                ->onDelete('cascade') // Каскадное удаление
                ->onUpdate('cascade'); // Каскадное обновление

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade') // Ограничение: запретить удаление
                ->onUpdate('cascade'); // Ограничение: запретить обновление

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
        Schema::dropIfExists('role_user_assigment');
    }
}
