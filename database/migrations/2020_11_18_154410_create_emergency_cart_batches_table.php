<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyCartBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_cart_batches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('emergency_cart_id');
            $table->decimal('brought_forward', 10,2)->default(0)->nullable();
            $table->decimal('available_quantity', 10, 2);
            $table->decimal('quantity_supplied', 10, 2);
            $table->unsignedBigInteger('nursing_cart_restock_id');
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
        Schema::dropIfExists('emergency_cart_batches');
    }
}
