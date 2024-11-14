<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Поле id с AUTO_INCREMENT
            $table->string('title', 64); // Поле title длиной 64 символа
            $table->unsignedBigInteger('project_type_id'); // Поле project_type_id
            
            // Внешний ключ
            $table->foreign('project_type_id')
                ->references('id')
                ->on('project_types')
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
        Schema::dropIfExists('roles');
    }
}
