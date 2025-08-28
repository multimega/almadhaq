<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityShippingSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('city_shipping_schedules', function (Blueprint $table) {
           
           $table->engine = 'InnoDB';
           
            $table->increments('id');
            $table->unsignedInteger('city_id');
            $table->string('day_of_week'); // 'monday', 'tuesday', etc.
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('capacity');
            // $table->integer('current_orders')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // $table->foreign('city_id')->references('id')->on('zone')->onDelete('cascade');
            // $table->index(['city_id', 'day_of_week']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::dropIfExists('city_shipping_schedules');

    }
}
