<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->text('country')->nullable();
            $table->text('city')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->text('street_name')->nullable();
            $table->text('floor_number')->nullable();
            $table->text('flat_num')->nullable();
            $table->integer('defaultt')->nullable()->default(0);
            $table->text('building_number')->nullable();
            $table->text('area')->nullable();
            $table->integer('code')->nullable();
            $table->text('title')->nullable();
            $table->string('mobile')->nullable();
            $table->string('location_by_gps')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');

    }
}
