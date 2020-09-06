<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugReturnOutwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_return_outwards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('drug_model_id');
            $table->unsignedInteger('quantity')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->decimal('total_amount', 20, 2);
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
        Schema::dropIfExists('drug_return_outwards');
    }
}
