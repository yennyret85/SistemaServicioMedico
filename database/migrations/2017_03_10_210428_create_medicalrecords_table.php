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
            $table->date('medical_record_date');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('users');
            $table->integer('specialty_id')->unsigned();
            $table->foreign('specialty_id')->references('id')->on('specialties');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('users');
            $table->integer('appointment_id')->unsigned();
            $table->foreign('appointment_id')->references('id')->on('appointments');
            $table->text('medical_report');
            $table->timestamps();
            $table->softDeletes();
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
