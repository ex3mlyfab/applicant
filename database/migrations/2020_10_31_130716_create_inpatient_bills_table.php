<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInpatientBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpatient_bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('$inpatient_id');
            $table->decimal('bill', 20, 2)->nullable();
            $table->decimal('discount', 20, 2)->nullable();
            $table->decimal('paid', 20, 2)->nullable();
            $table->string('p_status', 30)->nullable();
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
        Schema::dropIfExists('inpatient_bills');
    }
}
