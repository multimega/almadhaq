<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('is_default')->nullable()->default(0);
            $table->string('language')->nullable();
            $table->string('file')->nullable();
            $table->string('sign')->nullable();

        });
        DB::table('languages')->insert([
            [
                'is_default' => 1,
                'language' => 'English',
                'file' => '1609942915m2BTSvan.json',
                'sign' => 'en'
            ],[
                'is_default' => 0,
                'language' => 'Arabic',
                'file' => '1611500715vPeeB5dQ.json',
                'sign' => 'ar'
            ]

        ]);



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
