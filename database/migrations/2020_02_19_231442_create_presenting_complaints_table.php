<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentingComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presenting_complaints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('patientable');
            $table->text('pchx')->nullable();
            $table->text('pmhx')->nullable();
            $table->text('fshx')->nullable();
            $table->string('previously_admitted', 20)->nullable();
            $table->string('reasons4admission')->nullable();
            $table->string('hypertensive', 10)->nullable();
            $table->string('diabetic', 10)->nullable();
            $table->string('blood_transfusion', 10)->nullable();
            $table->string('drug_or_allergy')->nullable();
            $table->string('sc_disease', 10)->nullable();
            $table->string('others')->nullable();
            $table->string('cns')->nullable();
            $table->string('cvs')->nullable();
            $table->string('resp_system')->nullable();
            $table->string('git')->nullable();
            $table->string('urinary_system')->nullable();
            $table->string('obgyn')->nullable();
            $table->string('mss')->nullable();
            $table->string('skin')->nullable();
            $table->string('presumptive_diagnosis')->nullable();
            $table->unsignedBigInteger('seen_by')->nullable();
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
        Schema::dropIfExists('presenting_complaints');
    }
}
