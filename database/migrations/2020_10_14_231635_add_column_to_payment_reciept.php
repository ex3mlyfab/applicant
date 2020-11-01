<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPaymentReciept extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_receipts', function (Blueprint $table) {
            //
            $table->string('service_type', 100)->nullable();
        });
        Schema::table('pharmreq_details', function (Blueprint $table) {
            $table->boolean('dispensed')->nullable();
            $table->string('status', 50)->nullable();
            $table->unsignedBigInteger('invoice_item_id')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_receipts', function (Blueprint $table) {
            //
            $table->dropColumn('service_type');
        });
        Schema::table('pharmreq_details', function (Blueprint $table) {
            $table->dropColumn('dispensed');
            $table->dropColumn('status');
            $table->dropColumn('invoice_item_id');
        });
    }
}
