<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name', 50);
            $table->string('other_names', 100);
            $table->string('phone', 20)->unique();
            $table->string('age_at_reg')->nullable();
            $table->date('dob')->nullable();
            $table->string('avatar')->nullable();
            $table->string('folder_number', 20)->nullable();
            $table->string('occupation')->nullable();
            $table->string('sex')->nullable();
            $table->string('marital_status')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('nationality')->nullable();
            $table->string('tribe')->nullable();
            $table->string('source')->nullable();
            $table->string('religion')->nullable();
            $table->string('nok')->nullable();
            $table->string('nok_relationship')->nullable();
            $table->string('nok_phone')->nullable();
            $table->string('nok_address')->nullable();
            $table->unsignedBigInteger('registered_by')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('paymentMethod')->nullable();
            $table->string('insurance_number')->nullable();
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
        Schema::dropIfExists('users');
    }
}
