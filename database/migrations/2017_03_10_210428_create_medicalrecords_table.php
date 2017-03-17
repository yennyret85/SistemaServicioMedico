<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicalrecords', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appointment_id')->unsigned()->unique();
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->text('reasonforappointment');
            $table->text('physicalevaluation');
            $table->text('medicalreport');
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
        Schema::dropIfExists('medicalrecords');
    }
}
