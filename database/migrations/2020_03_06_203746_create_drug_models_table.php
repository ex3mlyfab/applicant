<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('drug_sub_category_id');
            $table->string('name', 100);
            $table->string('dosage', 100);
            $table->string('forms', 100);
            $table->string('strength', 100);
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
        Schema::dropIfExists('drug_models');
    }
}
