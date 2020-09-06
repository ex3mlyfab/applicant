<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugReturnOutwardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_return_outward_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('drug_return_outward_id');
            $table->unsignedBigInteger('drug_model_id')->nullable();
            $table->String('name')->nullable();
            $table->unsignedInteger('quantity_returned')->nullable();
            $table->decimal('price', 20, 2)->nullable();
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
        Schema::dropIfExists('drug_return_outward_details');
    }
}
