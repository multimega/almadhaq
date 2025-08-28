<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('slug')->nullable();
            $table->string('slug_ar')->nullable();
            $table->integer('header')->nullable()->default(1);
            $table->integer('content')->nullable()->default(1);
            $table->timestamps();
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('meta_keys_ar')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
