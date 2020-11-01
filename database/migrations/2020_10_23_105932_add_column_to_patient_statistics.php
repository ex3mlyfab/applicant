<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPatientStatistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_statistics', function (Blueprint $table) {
            //
            $table->dropColumn('regtype');
            $table->unsignedBigInteger('registration_type_id')->nullable();
            $table->unsignedInteger('number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_statistics', function (Blueprint $table) {
            //
            $table->string('regtype')->nullable();
            $table->dropColumn('registration_type_id');
        });
    }
}
