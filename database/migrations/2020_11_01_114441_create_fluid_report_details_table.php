<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFluidReportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fluid_report_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fluid_report_id');
            $table->string('measure', 30)->nullable();
            $table->dateTime('done_at');
            $table->unsignedBigInteger('done_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fluid_report_details');
    }
}
