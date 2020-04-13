<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLockoutTimeToAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
            $table->integer('lockout_time')->default(0)->after('email');
        });
        Schema::table('physical_exams', function (Blueprint $table) {
            //
            $table->text('plan')->nullable();
        });
        Schema::table('follow_ups', function (Blueprint $table) {
            //
            $table->text('plan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
            $table->dropColumn('lockout_time');
        });
    }
}
