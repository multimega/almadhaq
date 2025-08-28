<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShippingScheduleColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('shipping_schedule_id')->nullable();
            $table->date('scheduled_delivery_date')->nullable();
            $table->time('scheduled_delivery_start_time')->nullable();
            $table->time('scheduled_delivery_end_time')->nullable();
            
            // $table->foreign('shipping_schedule_id')->references('id')->on('city_shipping_schedules')->onDelete('set null');
            $table->index('scheduled_delivery_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('orders', function (Blueprint $table) {
            // $table->dropForeign(['shipping_schedule_id']);
            $table->dropColumn([
                'shipping_schedule_id',
                'scheduled_delivery_date',
                'scheduled_delivery_start_time',
                'scheduled_delivery_end_time'
            ]);
        });
    }
}
