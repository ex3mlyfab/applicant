<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmreqDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmreq_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pharmreq_id');
            $table->string('medicine');
            $table->string('dosage');
            $table->string('quantity');
            $table->foreign('pharmreq_id')->references('id')->on('pharmreqs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmreq_details');
    }
}
