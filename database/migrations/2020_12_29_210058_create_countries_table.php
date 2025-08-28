<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->text('country_name')->nullable();
            $table->text('name_ar')->nullable();
            $table->char('country_code')->nullable();
            $table->string('nicename')->nullable();
            $table->char('iso3')->nullable();
            $table->integer('numcode')->nullable();
            $table->integer('phonecode')->nullable();
            $table->text('photo')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->integer('is_default')->nullable()->default(0);
            $table->integer('phone_numbers')->nullable()->default(0);
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
