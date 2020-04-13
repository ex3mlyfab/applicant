<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('clinical_appointment_id');
            $table->date('due_date');
            $table->unsignedBigInteger('admin_id');
            $table->string('status', 50)->nullable();
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
        Schema::dropIfExists('tcas');
    }
}
