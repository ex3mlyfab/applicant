<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_trackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inpatient_id');
            $table->string('clinical_tasks',150);
            $table->dateTime('due_date')->nullable();
            $table->boolean('done')->default(false)->nullable();
            $table->string('complete', 15)->nullable();
            $table->unsignedBigInteger('prepared_by');
            $table->unsignedBigInteger('done_by')->nullable();
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
        Schema::dropIfExists('clinical_trackers');
    }
}
