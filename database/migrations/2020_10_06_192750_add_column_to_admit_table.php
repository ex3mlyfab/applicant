<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAdmitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inpatients', function (Blueprint $table) {
            //
            $table->dateTime('date_of_admission')->nullable()->change();
            $table->dateTime('date_of_discharge')->nullable()->change();
            $table->dropColumn('time_of_admission');
            $table->dropColumn('time_of_discharge');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inpatients', function (Blueprint $table) {
            //
        });
    }
}
