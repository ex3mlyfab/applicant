<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNursingPhysicalAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nursing_physical_assessments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inpatient_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('hair')->nullable();
            $table->string('eyes')->nullable();
            $table->string('nose')->nullable();
            $table->string('ears')->nullable();
            $table->string('face')->nullable();
            $table->string('neck')->nullable();
            $table->string('upper_limbs')->nullable();
            $table->string('chest')->nullable();
            $table->string('abdomen')->nullable();
            $table->string('genitals')->nullable();
            $table->string('lower_limbs')->nullable();
            $table->text('nurse_admission_note')->nullable();
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
        Schema::dropIfExists('nursing_physical_assessments');
    }
}
