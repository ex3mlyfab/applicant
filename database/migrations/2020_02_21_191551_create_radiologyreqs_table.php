<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiologyreqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiologyreqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('clinical_appointment_id');
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->string('clinical_information')->nullable();
            $table->string('examination_required')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('radiologyreqs');
    }
}
