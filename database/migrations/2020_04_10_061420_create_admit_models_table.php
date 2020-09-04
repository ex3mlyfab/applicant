<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmitModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admit_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('clinical_appointment_id');
            $table->string('clinical_information')->nullable();
            $table->string('reason')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
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
        Schema::dropIfExists('admit_models');
    }
}
