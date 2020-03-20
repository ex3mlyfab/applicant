<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToDrugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drug_models', function (Blueprint $table) {
            $table->string('maximum_level', 50)->nullable();
            $table->string('minimum_level', 50)->nullable();
            $table->string('reorder_level', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drug_models', function (Blueprint $table) {
            //
        });
    }
}
