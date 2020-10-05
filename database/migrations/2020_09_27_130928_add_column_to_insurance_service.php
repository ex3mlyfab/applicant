<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToInsuranceService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_services', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('charge_id')->nullable()->change();
            $table->string('service_type', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_services', function (Blueprint $table) {
            //
            $table->dropColumn('service_type');
        });
    }
}
