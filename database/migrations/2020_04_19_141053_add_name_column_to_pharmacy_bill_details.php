<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameColumnToPharmacyBillDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacy_bill_details', function (Blueprint $table) {
            //
            $table->string('dosage', 100)->nullable();
            $table->string('instruction', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmacy_bill_details', function (Blueprint $table) {
            //
            $table->dropColumn('dosage');
            $table->dropColumn('instruction');
        });
    }
}
