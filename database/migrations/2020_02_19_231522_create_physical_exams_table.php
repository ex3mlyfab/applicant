<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('patientable');
            $table->text('general_exam')->nullable();
            $table->text('local_exam')->nullable();
            $table->text('regional_exam')->nullable();
            $table->string('cns')->nullable();
            $table->string('cvs')->nullable();
            $table->string('resp_system')->nullable();
            $table->string('abdomen')->nullable();
            $table->string('gut')->nullable();
            $table->string('skin')->nullable();
            $table->string('musculo_skeletal')->nullable();
            $table->text('clinical_summary')->nullable();
            $table->string('initial_diagnosis')->nullable();
            $table->unsignedBigInteger('seen_by')->nullable();
            $table->timestamps();
            $table->foreign('clinical_appointment_id')->references('id')->on('clinical_appointments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('physical_exams');
    }
}
