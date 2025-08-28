<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profree', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('qu')->nullable()->default(1);
            $table->string('size')->nullable();
            $table->string('color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profree');
    }
}
