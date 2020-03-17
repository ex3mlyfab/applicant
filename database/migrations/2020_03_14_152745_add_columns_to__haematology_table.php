<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToHaematologyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('haematologyreqs', function (Blueprint $table) {
            //
            $table->string('anisocytosis', 20)->nullable();
            $table->string('poikilocytosis', 20)->nullable();
            $table->string('microcytosis', 20)->nullable();
            $table->string('hypochromia', 20)->nullable();
            $table->string('polychromasia', 20)->nullable();
            $table->string('target_cells', 20)->nullable();
            $table->string('sickle_cells', 20)->nullable();
            $table->string('nucleated_rbc', 20)->nullable();
            $table->string('plat_on_film', 20)->nullable();
            $table->string('blast', 20)->nullable();
            $table->string('promyel', 20)->nullable();
            $table->string('myel', 20)->nullable();
            $table->string('metamyel', 20)->nullable();
            $table->string('neut', 20)->nullable();
            $table->string('lymph', 20)->nullable();
            $table->string('mono', 20)->nullable();
            $table->string('eosin', 20)->nullable();
            $table->string('baso', 20)->nullable();
            $table->longText('other_results')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('haematologyreqs', function (Blueprint $table) {
            //
        });
    }
}
