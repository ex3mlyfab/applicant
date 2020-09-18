<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presenting_complaints', function (Blueprint $table) {
            //
            $table->string('duration')->nullable();
        });
        Schema::table('allergies', function(Blueprint $table){
            $table->dropColumn('type');
            $table->unsignedBigInteger('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presenting_complaints', function (Blueprint $table) {
            //
        });
    }
}
