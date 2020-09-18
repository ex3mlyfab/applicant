<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumToAdmitModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admit_models', function (Blueprint $table) {
            //
            $table->dropColumn('clinical_appointment_id');
            $table->unsignedBigInteger('encounter_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admit_models', function (Blueprint $table) {
            //
        });
    }
}
