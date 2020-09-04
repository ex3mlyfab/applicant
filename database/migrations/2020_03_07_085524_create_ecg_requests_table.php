<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcgRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecg_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('patientable');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('reason', 100)->nullable();
            $table->string('clinical_summary', 200)->nullable();
            $table->string('drugs', 200)->nullable();
            $table->string('status', 20)->nullable();
            $table->text('frequency', 20)->nullable();
            $table->string('rhythm_strip', 10)->nullable();
            $table->string('exercise_test', 10)->nullable();
            $table->string('daily', 10)->nullable();
            $table->string('twice_a_week', 10)->nullable();
            $table->string('echo', 10)->nullable();
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
        Schema::dropIfExists('ecg_requests');
    }
}
