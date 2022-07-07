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
        Schema::create('fuel_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('SampleNo');
            $table->string('SampleCollectionDate');
            $table->string('TruckPlateNo');
            $table->string('TankNo');
            $table->string('AppearanceResult');
            $table->string('Color');
            $table->string('Density');
            $table->string('FlashPoint');
            $table->string('Temp');
            $table->string('WaterSediment');
            $table->string('Cleanliness');
            $table->string('DateOfTest');
            $table->string('uid');
            $table->string('MadeBy');
            $table->string('DeliveredTo');
            $table->string('Remarks');
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
        Schema::dropIfExists('fuel_tests');
    }
};
