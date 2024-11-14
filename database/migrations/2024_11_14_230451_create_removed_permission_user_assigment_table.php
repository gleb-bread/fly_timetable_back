<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemovedPermissionUserAssigmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('removed_permission_user_assigment', function (Blueprint $table) {
            $table->id(); // Поле id с AUTO_INCREMENT

            $table->unsignedBigInteger('user_assigment_id'); // Поле user_assigment_id
            $table->unsignedBigInteger('permission_id'); // Поле permission_id

            // Внешние ключи
            $table->foreign('user_assigment_id')
                ->references('id')
                ->on('user_assigment')
                ->onDelete('cascade') // Каскадное удаление
                ->onUpdate('cascade'); // Каскадное обновление

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
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
        Schema::dropIfExists('removed_permission_user_assigment');
    }
}
