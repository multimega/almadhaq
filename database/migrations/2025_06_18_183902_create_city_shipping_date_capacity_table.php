<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityShippingDateCapacityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_shipping_date_capacity', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('schedule_id'); // Reference to the schedule
            $table->date('shipping_date');
            $table->integer('current_orders')->default(0);
            $table->timestamps();
            
            // Foreign keys
            // $table->foreign('city_id')->references('id')->on('zone')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('city_shipping_schedules')->onDelete('cascade');
            
            // Unique constraint to prevent duplicate entries for same date/schedule
            $table->unique(['schedule_id', 'shipping_date'], 'unique_schedule_date');
            
            // Indexes for performance
            $table->index(['city_id', 'shipping_date']);
            $table->index('shipping_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_shipping_date_capacity');
    }
}
