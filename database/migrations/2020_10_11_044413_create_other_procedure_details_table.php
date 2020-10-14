<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherProcedureDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_procedure_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('other_procedure_id');
            $table->string('name', 100);
            $table->decimal('cost', 20,2)->nullable();
            $table->string('status', 20)->nullable();
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
        Schema::dropIfExists('other_procedure_details');
    }
}
