<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_bill_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pharmacybill_id');
            $table->unsignedBigInteger('drug_model_id');
            $table->string('batch_no', 20);
            $table->string('quantity', 20);
            $table->string('unit_cost', 20);
            $table->string('amount', 20);
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
        Schema::dropIfExists('pharmacy_bill_details');
    }
}
