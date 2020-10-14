<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->string('name', 150)->nullable();
            $table->unsignedBigInteger('payment_mode_id')->nullable();
            $table->decimal('vat', 10,2)->nullable();
            $table->decimal('discount', 20,2)->nullable();
            $table->decimal('gross_amount', 20, 2)->nullable();
            $table->decimal('total', 20, 2)->nullable();
            $table->string('remark', 100)->nullable();
            $table->string('receipt_no', 50)->nullable();
            $table->nullableMorphs('paymentable');
            $table->timestamps();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_receipt_id');
            $table->dropColumn('payment_mode_id');
            $table->dropColumn('admin_id');
            $table->dropColumn('user_id');
            $table->dropColumn('name');
            $table->dropColumn('invoice_item_id');
            $table->dropColumn('discount');
            $table->dropColumn('gross_amount');
            $table->dropColumn('vat');
            $table->dropColumn('invoice_no');
        });
        Schema::table('bank_transfers', function(Blueprint $table){
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('name', 200)->nullable();
        });
        Schema::table('organizations', function (Blueprint $table) {
            $table->unsignedMediumInteger('enrolment_count')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_receipts');
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('payment_receipt_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('payment_mode_id')->nullable();
            $table->unsignedBigInteger('invoice_item_id')->nullable();
            $table->decimal('vat', 10,2)->nullable();
            $table->decimal('discount', 20,2)->nullable();
            $table->decimal('gross_amount', 20, 2)->nullable();
            $table->string('name')->nullable();
            $table->string('invoice_no');
        });
        Schema::table('bank_transfers', function(Blueprint $table){
            $table->unsignedBigInteger('user_id')->change();
            $table->dropColumn('name');
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('enrolment_count');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('organization_id');
        });
    }
}
