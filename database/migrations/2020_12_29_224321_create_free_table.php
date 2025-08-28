<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('times')->nullable()->default(1);
            $table->integer('used')->nullable()->default(0);
            $table->integer('status')->nullable()->default(1);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('photo')->nullable();
            $table->integer('rand')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('free');
    }
}
