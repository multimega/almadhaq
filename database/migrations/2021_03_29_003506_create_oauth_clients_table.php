<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOauthClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_clients', function (Blueprint $table) {
            $table->id();
             $table->integer('user_id')->nullable();
              $table->string('name')->nullable();
              $table->string('secret')->nullable();
              $table->string('provider')->nullable();
              $table->text('redirect')->nullable();
                $table->integer('personal_access_client')->nullable();
                $table->integer('password_client')->nullable();
                $table->integer('revoked')->nullable();
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
        Schema::dropIfExists('oauth_clients');
    }
}
