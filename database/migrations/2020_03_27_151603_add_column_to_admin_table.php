<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAdminTable extends Migration
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
            $table->string('other_names', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('marital_status', 20)->nullable();
            $table->date('dob')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('resume')->nullable();
            $table->string('application_letter')->nullable();
            $table->string('appointment_letter')->nullable();
            $table->string('acceptance_letter')->nullable();
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
        });
    }
}
