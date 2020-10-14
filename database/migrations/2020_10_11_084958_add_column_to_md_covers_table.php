<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMdCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('md_account_covers', function (Blueprint $table) {
            //
            $table->date('starts')->nullable();
            $table->date('ends')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('md_account_covers', function (Blueprint $table) {
            //
            $table->dropColumn('starts');

            $table->dropColumn('ends');
        });
    }
}
