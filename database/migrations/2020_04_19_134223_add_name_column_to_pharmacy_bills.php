<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameColumnToPharmacyBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacy_bills', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('pharmreq_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmacy_bills', function (Blueprint $table) {
            //
            $table->dropColumn('pharmreq_id');
            $table->dropColumn('patient_name');
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }
}
