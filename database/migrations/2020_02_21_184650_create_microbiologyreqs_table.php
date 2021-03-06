<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicrobiologyreqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microbiologyreqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('patientable');
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->string('specimen')->nullable();
            $table->string('clinical_information')->nullable();
            $table->string('examination_required')->nullable();
            $table->date('specimen_collected')->nullable();
            $table->date('specimentime')->nullable();
            $table->string('priority')->nullable();
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
        Schema::dropIfExists('microbiologyreqs');
    }
}
