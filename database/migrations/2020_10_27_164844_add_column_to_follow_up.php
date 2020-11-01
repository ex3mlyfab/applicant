<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToFollowUp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('follow_ups', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('seen_by')->nullable();

        });
        Schema::table('inpatients', function (Blueprint $table) {
            $table->decimal('bill',  20, 2 )->nullable();
            $table->dropColumn('credit_limit');
        });
        Schema::table('pharmreqs', function (Blueprint $table) {
            $table->unsignedBigInteger('collected_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('follow_ups', function (Blueprint $table) {
            //
            $table->dropColumn('seen_by');
        });
        Schema::table('inpatients', function (Blueprint $table) {
            $table->dropColumn('bill');
            $table->decimal('credit_limit',  20, 2 )->nullable();
        });
        Schema::table('pharmreqs', function (Blueprint $table) {
            $table->dropColumn('collected_by');
        });
    }
}
