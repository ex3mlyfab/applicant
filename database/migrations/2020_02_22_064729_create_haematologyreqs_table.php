<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHaematologyreqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haematologyreqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('patientable');
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->string('clinical_details')->nullable();
            $table->string('investigation_required')->nullable();
            $table->string('fbc', 10)->nullable();
            $table->string('pcv', 10)->nullable();
            $table->string('rbc', 10)->nullable();
            $table->string('mcv', 10)->nullable();
            $table->string('mch', 10)->nullable();
            $table->string('mchc', 10)->nullable();
            $table->string('retic', 10)->nullable();
            $table->string('wbc', 10)->nullable();
            $table->string('plat', 10)->nullable();
            $table->string('esr', 10)->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->string('payment_status')->nullable();
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
        Schema::dropIfExists('haematologyreqs');
    }
}
