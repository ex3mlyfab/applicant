<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNursingCartRestocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nursing_cart_restocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cart_type', 10);
            $table->unsignedBigInteger('supplied_by');
            $table->unsignedBigInteger('recieved_by')->nullable();
            $table->decimal('costs', 20,2)->nullable();
            $table->string('status' ,10);
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
        Schema::dropIfExists('nursing_cart_restocks');
    }
}
