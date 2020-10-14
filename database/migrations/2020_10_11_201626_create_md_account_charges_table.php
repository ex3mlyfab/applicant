<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMdAccountChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('md_account_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('md_account_id');
            $table->string('service', 100)->nullable();
            $table->decimal('charge', 20,2)->nullable();
            $table->decimal('patient_paid', 20, 2)->nullable();
            $table->decimal('md_covers', 20,2)->nullable();
            $table->string('status', 100)->nullable();
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
        Schema::dropIfExists('md_account_charges');
    }
}
