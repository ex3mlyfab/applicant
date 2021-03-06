<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMdAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('md_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 100);
            $table->unsignedBigInteger('user_id');
            $table->date('starts')->nullable(); // duration starts if it is period bound
            $table->date('ends')->nullable(); //ends
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('md_accounts');
    }
}
