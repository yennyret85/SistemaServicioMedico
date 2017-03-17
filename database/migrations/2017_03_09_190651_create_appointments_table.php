<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('specialty_id')->unsigned();
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', ['Asignada', 'Concluida', 'Cancelada'])->default('Asignada');
            $table->unique(['patient_id', 'specialty_id', 'appointment_date']);
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
        Schema::dropIfExists('appointments');
    }
}
