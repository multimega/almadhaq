<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAdminLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('is_default')->nullable()->default(0);
            $table->string('language')->nullable();
            $table->string('file')->nullable();
            $table->string('name')->nullable();
            $table->integer('rtl')->nullable()->default(0);
            $table->string('sign')->nullable();
        });

        DB::table('admin_languages')->insert([
            [
                'is_default' => 1,
                'language' => 'English',
                'file' => '1606734816qrxx0wvw.json',
                'name' => '1606734816qrxx0wvw',
                'rtl' => 0,
                'sign' => 'en'


            ],[
                'is_default' => 0,
                'language' => 'عربى',
                'file' => '1611067820ugxtpVzJ.json',
                'name' => '1611067820ugxtpVzJ',
                'rtl' => 1,
                'sign' => 'ar'


            ],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_languages');
    }
}
