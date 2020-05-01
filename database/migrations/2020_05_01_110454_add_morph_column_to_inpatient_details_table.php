<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorphColumnToInpatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inpatient_details', function (Blueprint $table) {
            //
            $table->morphs('inlabtest');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inpatient_details', function (Blueprint $table) {
            //
            $table->dropMorphs('inlabtest');
        });
    }
}
