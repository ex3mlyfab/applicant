<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNursingFunctionalhpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nursing_functionalhps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inpatient_id');
            $table->text('health_man')->nullable();
            $table->text('nutrition')->nullable();
            $table->text('elimination')->nullable();
            $table->text('activity')->nullable();
            $table->text('cognition')->nullable();
            $table->text('sleep')->nullable();
            $table->text('perception')->nullable();
            $table->text('roles')->nullable();
            $table->text('sexuality')->nullable();
            $table->text('coping')->nullable();
            $table->text('values')->nullable();
            $table->unsignedBigInteger('admin_id');
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
        Schema::dropIfExists('nursing_functionalhps');
    }
}
