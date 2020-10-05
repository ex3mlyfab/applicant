<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMdAccountCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('md_account_covers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('md_account_id');
            $table->string('name',100);
            $table->decimal('percentage', 5,2);
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();
        });
        Schema::table('md_accounts', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('starts');
            $table->dropColumn('ends');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('md_account_covers');
    }
}
