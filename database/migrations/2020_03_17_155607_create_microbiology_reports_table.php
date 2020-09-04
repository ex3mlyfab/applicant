<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicrobiologyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microbiology_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('microbiologyreq_id');
            $table->string('augmentin', 25)->nullable();
            $table->string('cefixime', 25)->nullable();
            $table->string('erythromycin', 25)->nullable();
            $table->string('azythromycin', 25)->nullable();
            $table->string('imipenem', 25)->nullable();
            $table->string('gentamycin', 25)->nullable();
            $table->string('ofloxacin', 25)->nullable();
            $table->string('ciprofloxacin', 25)->nullable();
            $table->string('cefuroxim', 25)->nullable();
            $table->string('ceftriaxone', 25)->nullable();
            $table->string('clindamycin', 25)->nullable();
            $table->string('ceftazidime', 25)->nullable();
            $table->string('piperacillin', 25)->nullable();
            $table->string('meropenem', 25)->nullable();
            $table->string('vancomycin', 25)->nullable();
            $table->string('nitrofuration', 25)->nullable();
            $table->string('tigecycline', 25)->nullable();
            $table->string('synercid', 25)->nullable();
            $table->string('ceftazidime_tazo', 25)->nullable();
            $table->string('cetriaxone_tazo', 25)->nullable();
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
        Schema::dropIfExists('microbiology_reports');
    }
}
