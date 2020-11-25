<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOperationRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operating_rooms', function (Blueprint $table) {
            //
            $table->string('lead_surgeon')->nullable()->after('performed_by');
        });

        Schema::table('pharmacy_bill_details', function (Blueprint $table) {
            $table->string('status', 30)->nullable()->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operating_rooms', function (Blueprint $table) {
            //
            $table->dropColumn('lead_surgeon');
        });

        Schema::table('pharmacy_bill_details', function (Blueprint $table) {
            $table->dropColumn('status');
                });
    }
}
