<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateEmergencyRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Age-type', 10);
            $table->string('consciousness');
            $table->string('identity')->unique();
            $table->string('airway')->nullable();
            $table->string('blocked_airway_actions')->nullable();
            $table->string('Breathing');
            $table->string('inadequate_breathing_actions')->nullable();
            $table->string('cervical_spine');
            $table->string('threatened_cv_action')->nullable();
            $table->string('open_wounds', 10);
            $table->string('iv_access, 10')->nullable();
            $table->string('blood_sample_taken', 5);
            $table->string('dorsal_spine')->nullable();
            $table->string('exposure')->nullable();
            $table->string('flexibility_upperLimbs')->nullable();
            $table->string('flexibility_lowerLimbs')->nullable();
            $table->string('head_cranial_nerves')->nullable();
            $table->string('neck')->nullable();
            $table->string('chest')->nullable();
            $table->string('abdomen')->Nullable();
            $table->string('pelvis_perineum')->nullable();
            $table->string('upper_limb')->nullabble;
            $table->string('lower_limb')->nullabble;
            $table->String('skin')->nullable();
            $table->string('initia_diagnosis')->nullable();
            $table->string('working_diagnosis')->nullable();
            $table->text('history')->nullable();


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
        Schema::dropIfExists('emergency_rooms');
    }
}
