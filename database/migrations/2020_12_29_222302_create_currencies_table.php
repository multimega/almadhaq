<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('sign')->nullable();
            $table->double('value')->nullable();
            $table->tinyInteger('is_default')->nullable()->default(0);

        });
        DB::table('currencies')->insert([
            [
                'name' => 'EGP',
                'name_ar' => 'جنيه',
                'sign' => 'EGP',
                'value' => '1',
                'is_default' => 1

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
        Schema::dropIfExists('currencies');
    }
}
