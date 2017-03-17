<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes_medicines', function (Blueprint $table) {
            $table->integer('recipe_id')->unsigned();
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->integer('medicine_id')->unsigned();
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->primary(['recipe_id', 'medicine_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes_medicines');
    }
}
