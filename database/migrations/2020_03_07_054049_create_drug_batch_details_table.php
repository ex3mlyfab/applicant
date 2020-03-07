<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugBatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_batch_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('drug_model_id');
            $table->string('batch_no', 50)->unique();
            $table->string('quantity_supplied', 10);
            $table->string('packing_quantity', 10)->nullable();
            $table->date('expiry_date');
            $table->decimal('cost', 20, 2)->nullable();
            $table->string('supplier', 100)->nullable();
            $table->string('available_quantity')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('drug_batch_details');
    }
}
