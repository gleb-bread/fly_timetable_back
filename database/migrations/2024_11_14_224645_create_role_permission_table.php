<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id(); // Поле id с AUTO_INCREMENT
            
            $table->unsignedBigInteger('role_id'); // Поле role_id
            $table->unsignedBigInteger('permission_id'); // Поле permission_id
            
            // Внешние ключи
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade') // Каскадное удаление
                ->onUpdate('cascade'); // Каскадное обновление

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
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
        Schema::dropIfExists('role_permission');
    }
}
