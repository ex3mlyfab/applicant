<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToDrugBatchDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drug_batch_details', function (Blueprint $table) {
            //
            $table->decimal('purchase_price', 20, 2)->nullable();
            $table->date('purchase_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drug_batch_details', function (Blueprint $table) {
            //
            $table->dropColumn('purchase_price');
            $table->dropColumn('purchase_date');
        });
    }
}
