<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInpatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpatients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->date('date_of_admission')->nullable();
            $table->time('time_of_admission')->nullable();
            $table->date('date_of_discharge')->nullable();
            $table->time('time_of_discharge')->nullable();
            $table->unsignedBigInteger('bed_id')->nullable();
            $table->string('status', 100)->nullable();
            $table->decimal('credit_limit', 30, 2)->default(0)->nullable();
            $table->string('condition')->nullable();

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
        Schema::dropIfExists('inpatients');
    }
}
