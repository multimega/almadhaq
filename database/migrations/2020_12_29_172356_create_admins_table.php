<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('role_id')->nullable()->default(0);
            $table->string('photo')->nullable();
            $table->string('password')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->text('shop_name')->nullable();
            $table->text('city')->nullable();
        });
        DB::table('admins')->insert([
            [
                'name' => 'Vowalaa - Ecommerce complete solution',
                'email' => 'admin@demo.com',
                'phone' => '01004282491',
                'photo' => '1582134235User-icon.png',
                'password' => '$2y$10$4nG69nMV7X4HT2cMirQjG.y6XdE8qVy/aNjOjf8sTBmlUzNq1JF0.',
                'shop_name' => 'Vowalaa',
                'city' => 'Cairo'

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
        Schema::dropIfExists('admins');
    }
}
