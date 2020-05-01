<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetainershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retainerships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('folder_number')->nullable();
            $table->string('comment');
            $table->decimal('debit', 50, 2)->nullable()->default(0);
            $table->decimal('credit', 50, 2)->nullable()->default(0);
            $table->decimal('balance', 50, 2)->nullable()->default(0);
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('referral_source', 100)->after('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retainerships');
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('referral_source');
        });
    }
}
