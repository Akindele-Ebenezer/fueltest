<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_test_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Email');
            $table->string('Password');
            $table->timestamps();
            $table->string('Name');
            $table->integer('Status');
            $table->string('Role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuel_test_users');
    }
};
