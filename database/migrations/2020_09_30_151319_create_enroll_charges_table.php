<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enroll_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('enroll_user_id');
            $table->string('service');
            $table->decimal('charge', 20,2);
            $table->decimal('patient_paid', 20, 2)->nullable();
            $table->decimal('insurance_cover', 20, 2)->nullable();
            $table->string('payment_status')->nullable();
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
        Schema::dropIfExists('enroll_charges');
    }
}
