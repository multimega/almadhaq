<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->text('details')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_code')->nullable();
            $table->double('price')->nullable()->default(0);
            $table->integer('allowed_products')->nullable()->default(0);
            $table->integer('days')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
