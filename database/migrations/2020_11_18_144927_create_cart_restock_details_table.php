<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartRestockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_restock_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nursing_cart_restock_id');
            $table->decimal('quantity_supplied', 10,2)->default(0)->nullable();
            $table->decimal('cost', 20, 2);
            $table->decimal('unit', 20, 2);
            $table->unsignedBigInteger('drug_model_id');
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
        Schema::dropIfExists('cart_restock_details');
    }
}
