<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInpatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpatient_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inpatient_id');
            $table->string('actions', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->nullableMorphs('testable');
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
        Schema::dropIfExists('inpatient_details');
    }
}
