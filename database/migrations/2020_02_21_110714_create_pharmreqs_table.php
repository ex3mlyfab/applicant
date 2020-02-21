<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmreqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmreqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('clinical_appointment_id');
            $table->unsignedBigInteger('seen_by');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->foreign('appointment_id')->references('id')->on('clinical_appointments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmreqs');
    }
}
