<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToConsultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('ecg_requests', function (Blueprint $table) {
            $table->dropMorphs('patientable');
            $table->unsignedBigInteger('encounter_id');
            
        });
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->dropMorphs('patientable');
            $table->unsignedBigInteger('encounter_id');
            $table->string('status', 50)->nullable();
        });
        Schema::table('histopathologyreqs', function (Blueprint $table) {
            $table->dropMorphs('patientable');
            $table->unsignedBigInteger('encounter_id');
            $table->string('status', 50)->nullable();
        });
        Schema::table('haematologyreqs', function (Blueprint $table) {
            $table->dropMorphs('patientable');
            $table->unsignedBigInteger('encounter_id');

        });
        Schema::table('microbiologyreqs', function (Blueprint $table) {
            $table->dropMorphs('patientable');
            $table->unsignedBigInteger('encounter_id');

        });
        Schema::table('physioreqs', function (Blueprint $table) {
            $table->dropMorphs('patientable');
            $table->unsignedBigInteger('encounter_id');

        });
        Schema::table('pharmreqs', function (Blueprint $table) {
            $table->dropMorphs('patientable');
            $table->unsignedBigInteger('encounter_id');

        });
        Schema::table('physical_exams', function (Blueprint $table) {
                    $table->dropMorphs('patientable');
                    $table->unsignedBigInteger('encounter_id');

        });
        Schema::table('presenting_complaints', function (Blueprint $table) {
                    $table->dropMorphs('patientable');
                    $table->unsignedBigInteger('encounter_id');

        });
        Schema::table('radiologyreqs', function (Blueprint $table) {
                    $table->dropMorphs('patientable');
                    $table->unsignedBigInteger('encounter_id');

        });
        Schema::table('ultrasoundreqs', function (Blueprint $table) {
                    $table->dropMorphs('patientable');
                    $table->unsignedBigInteger('encounter_id');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bloodreqs', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');
        });
        Schema::table('ecg_requests', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');
            $table->dropColumn('status', 50)->nullable();
        });
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');
            $table->dropColumn('status', 50)->nullable();
        });
        Schema::table('histopathologyreqs', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');
            $table->dropColumn('status', 50)->nullable();
        });
        Schema::table('haematologyreqs', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');
        });
        Schema::table('microbiologyreqs', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');
        });
        Schema::table('physioreqs', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');
        });
        Schema::table('pharmreqs', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');

        });
        Schema::table('physical_exams', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');

        });
        Schema::table('presenting_complaints', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');
        });
        Schema::table('radiologyreqs', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');

        });
        Schema::table('ultrasoundreqs', function (Blueprint $table) {
            $table->Morphs('patientable');
            $table->dropColumn('encounter_id');
        });
    }
}
