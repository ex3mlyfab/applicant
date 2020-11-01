<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnFromPharmacyBillTable extends Migration
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
            $table->dropColumn('payment_method');
            $table->dropColumn('invoice_id');
            $table->dropColumn('vat');
            $table->dropColumn('status');
            $table->dropColumn('discount');
            $table->dropColumn('amount');
            $table->dropColumn('gross_amount');
            $table->decimal('total', 20, 2)->nullable();
            $table->decimal('gross_total', 20, 2)->nullable();
            $table->decimal('discounted', 20, 2)->nullable();

        });
        Schema::table('pharmacy_bill_details', function (Blueprint $table) {
            $table->dropColumn('instruction');
            $table->dropColumn('pharmacybill_id');
            $table->dropColumn('batch_no');
            $table->unsignedBigInteger('pharmacy_bill_id');
            $table->string('duration')->nullable();
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
            $table->string('payment_method')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('vat')->nullable();
            $table->string('status')->nullable();
            $table->string('discount')->nullable();
            $table->string('amount')->nullable();
            $table->string('gross_amount')->nullable();
            $table->dropColumn('discounted');
            $table->dropColumn('total');
            $table->dropColumn('gross_total');
        });
        Schema::table('pharmacy_bill_details', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->dropColumn('pharmacy_bill_id');
            $table->string('instruction')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('pharmacybill_id')->nullable();
        });
    }
}
