<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatingRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('operating_rooms');
        Schema::create('operating_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('encounter_id');
            $table->string('operation_name', 100);
            $table->string('position')->nullable();
            $table->string('incision')->nullable();
            $table->string('pre_operative_pcv')->nullable();
            $table->string('findings')->nullable();
            $table->text('procedure')->nullable();
            $table->string('estimated_blood_loss', 100)->nullable();
            $table->string('intra_operative_transfusion', 100)->nullable();
            $table->string('drainage', 100)->nullable();
            $table->unsignedBigInteger('performed_by')->nullable();
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
        Schema::dropIfExists('operating_rooms');
    }
}
