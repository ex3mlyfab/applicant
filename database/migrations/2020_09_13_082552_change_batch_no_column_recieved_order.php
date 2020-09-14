<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBatchNoColumnRecievedOrder extends Migration
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
            $table->unsignedBigInteger('recieve_order_id');
            $table->dropColumn('batch_no');
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
        });
    }
}
