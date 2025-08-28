<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('photo')->nullable()->default('1582359362wallet.png');
            $table->integer('rand')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->timestamps();
            $table->string('type')->nullable();
            $table->double('price')->nullable();
            $table->integer('limited')->nullable();
            $table->integer('percent_off')->nullable();
            $table->string('times')->nullable();
            $table->integer('used')->nullable()->default(0);
            $table->integer('view')->nullable()->default(0);

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referrals');
    }
}
