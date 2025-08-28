<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->integer('type')->nullable();
            $table->double('price')->nullable();
            $table->integer('limited')->nullable();
            $table->string('times')->nullable();
            $table->integer('used')->nullable()->default(0);
            $table->integer('status')->nullable()->default(1);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('photo')->nullable();
            $table->integer('rand')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcat_id')->nullable();
            $table->integer('childcat_id')->nullable();
            $table->integer('brand_id')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
