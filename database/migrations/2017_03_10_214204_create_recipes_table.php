<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['Activo', 'Entregado', 'Cancelado'])->default('Activo');
            $table->integer('medicalrecord_id')->unsigned()->unique();
            $table->foreign('medicalrecord_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('pharmacist_id')->unsigned()->nullable();
            $table->foreign('pharmacist_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('indications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
