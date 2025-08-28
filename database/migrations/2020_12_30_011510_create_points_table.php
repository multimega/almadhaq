<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->integer('type')->nullable();
            $table->double('price')->nullable();
            $table->integer('points')->nullable();
            $table->integer('limited')->nullable();
            $table->string('times')->nullable();
            $table->integer('used')->nullable()->default(0);
            $table->integer('status')->nullable()->default(1);
            $table->integer('days')->nullable();

            $table->integer('user_id')->nullable();
            $table->string('photo')->nullable()->default('1582359362wallet.png');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}
