<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPharmReqDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmreq_details', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('drug_model_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmreq_details', function (Blueprint $table) {
            //
            $table->dropColumn('drug_model_id');
        });
    }
}
