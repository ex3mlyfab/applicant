<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedureRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inpatient_id');
            $table->unsignedBigInteger('requested_by');
            $table->string('procedure_type');
            $table->string('clinical_information')->nullable();
            $table->string('status', 30)->nullable();
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
        Schema::dropIfExists('procedure_requests');
    }
}
