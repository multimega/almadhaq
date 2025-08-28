<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSocialsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialsettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('facebook')->nullable();
            $table->string('gplus')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('dribble')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->tinyInteger('ystatus')->nullable()->default(0);
            $table->tinyInteger('i_status')->nullable()->default(0);
            $table->tinyInteger('f_status')->nullable()->default(0);
            $table->tinyInteger('g_status')->nullable()->default(0);
            $table->tinyInteger('t_status')->nullable()->default(0);

            $table->tinyInteger('l_status')->nullable()->default(0);
            $table->tinyInteger('d_status')->nullable()->default(0);
            $table->tinyInteger('f_check')->nullable()->default(0);
            $table->tinyInteger('g_check')->nullable()->default(0);
            $table->text('fclient_id')->nullable();
            $table->text('fclient_secret')->nullable();
            $table->text('fredirect')->nullable();
            $table->text('gclient_id')->nullable();
            $table->text('gclient_secret')->nullable();
            $table->text('gredirect')->nullable();
        });

        DB::table('socialsettings')->insert([
            [
                'facebook' => 'https://www.facebook.com/'


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
        Schema::dropIfExists('socialsettings');
    }
}
