<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('subscription_id')->nullable();
            $table->text('title')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_code')->nullable();
            $table->double('price')->nullable()->default(0);
            $table->integer('days')->nullable();
            $table->integer('allowed_products')->nullable()->default(0);
            $table->text('details')->nullable();
            $table->string('method')->nullable()->default('Free');
            $table->string('txnid')->nullable();
            $table->string('charge_id')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->text('payment_number')->nullable();
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
        Schema::dropIfExists('user_subscriptions');
    }
}
