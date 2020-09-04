<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodreqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloodreqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('patientable');
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('blood_group', 10)->nullable();
            $table->string('genotype', 10)->nullable();
            $table->string('previous_transfusion', 10)->nullable();
            $table->string('date_of_previous')->nullable();
            $table->string('previous_transfusion_rx')->nullable();
            $table->string('no_of_pregnancies', 10)->nullable();
            $table->string('no_of_stillbirths', 10)->nullable();
            $table->string('no_of_jaundiced_babies', 10)->nullable();
            $table->string('no_of_units_required')->nullable();
            $table->string('mode')->nullable();
            $table->string('date_required')->nullable();
            $table->string('time_required')->nullable();
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
        Schema::dropIfExists('bloodreqs');
    }
}
