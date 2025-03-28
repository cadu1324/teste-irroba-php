<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->dateTime('appointment_time');
            $table->enum('status', ['scheduled', 'performed', 'canceled'])->default('scheduled');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}