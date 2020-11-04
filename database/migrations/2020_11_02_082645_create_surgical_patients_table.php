<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurgicalPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgical_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inpatient_id');
            $table->string('procedure', 200);
            $table->string('to_do');
            $table->unsignedBigInteger('requested_by');
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
        Schema::dropIfExists('surgical_patients');
    }
}
