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
        Schema::create('fuel_test_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('SampleNo')->nullable();
            $table->string('SampleCollectionDate')->nullable();
            $table->string('TruckPlateNo')->nullable();
            $table->string('TankNo')->nullable();
            $table->string('AppearanceResult')->nullable();
            $table->string('Color')->nullable();
            $table->string('Density')->nullable();
            $table->string('FlashPoint')->nullable();
            $table->string('Temp')->nullable();
            $table->string('WaterSediment')->nullable();
            $table->string('Cleanliness')->nullable();
            $table->string('DateOfTest')->nullable();
            $table->string('uid')->nullable();
            $table->string('MadeBy')->nullable();
            $table->string('DeliveredTo')->nullable();
            $table->string('Remarks')->nullable();
            $table->string('VendorName')->nullable();
            $table->string('VendorNo')->nullable();
            $table->string('ApprovalForUse')->nullable();
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
        Schema::dropIfExists('fuel_test_records');
    }
};
