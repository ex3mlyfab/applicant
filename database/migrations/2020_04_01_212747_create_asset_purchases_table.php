<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asset_model_id')->nullable();
            $table->string('vendor')->nullable();
            $table->string('id_range')->nullable();
            $table->decimal('quantity', 20);
            $table->decimal('purchase_price', 40, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('depreciation_cost', 10, 2)->nullable();
            $table->string('depreciation_rate', 10)->nullable();
            $table->decimal('net_book_value', 20, 2)->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('purchased_by')->nullable();
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
        Schema::dropIfExists('asset_purchases');
    }
}
