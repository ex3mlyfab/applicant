<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOtherProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_procedures', function (Blueprint $table) {
            //
            $table->dropColumn('remark');
            $table->boolean('p_status')->default(false)->nullable();
            $table->string('status', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_procedures', function (Blueprint $table) {
            $table->dropColumn('p_status');
            $table->dropColumn('status');
            $table->string('remark');

        });
    }
}
