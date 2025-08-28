<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_price', function (Blueprint $table) {
            $table->increments('id');
            $table->text('from')->nullable();
            $table->integer('to')->nullable();
            $table->double('value')->nullable();
            $table->integer('shipment_id')->nullable();
            $table->double('extra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_price');
    }
}
