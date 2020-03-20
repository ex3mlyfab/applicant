<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistopathologyreqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histopathologyreqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('test_date')->nullable();
            $table->date('lmp')->nullable();
            $table->string('religion', 50)->nullable();
            $table->string('marriage_type', 50)->nullable();
            $table->string('husband_occupation', 50)->nullable();
            $table->string('specimen_type', 50)->nullable();
            $table->string('total_birth', 50)->nullable();
            $table->string('abortion_miscarriage', 50)->nullable();
            $table->string('condition', 50)->nullable();
            $table->string('cervix_appearance', 50)->nullable();
            $table->string('symptoms', 50)->nullable();
            $table->unsignedBigInteger('clinical_appointment_id');
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
        Schema::dropIfExists('histopathologyreqs');
    }
}
