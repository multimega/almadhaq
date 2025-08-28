<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('photo')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->tinyInteger('is_provider')->nullable()->default(0);

            $table->text('verification_link')->nullable();
            $table->text('affilate_code')->nullable();
            $table->enum('email_verified',['Yes','No'])->nullable()->default('No');
            $table->double('affilate_income')->nullable()->default(0);
            $table->text('shop_name')->nullable();
            $table->text('owner_name')->nullable();
            $table->text('shop_number')->nullable();
            $table->text('shop_address')->nullable();
            $table->text('reg_number')->nullable();
            $table->text('shop_message')->nullable();
            $table->text('shop_details')->nullable();
            $table->text('shop_image')->nullable();
            $table->text('f_url')->nullable();
            $table->text('g_url')->nullable();
            $table->text('t_url')->nullable();
            $table->tinyInteger('is_vendor')->nullable()->default(0);
            $table->tinyInteger('f_check')->nullable()->default(0);
            $table->tinyInteger('g_check')->nullable()->default(0);
            $table->tinyInteger('t_check')->nullable()->default(0);
            $table->tinyInteger('l_check')->nullable()->default(0);
            $table->tinyInteger('mail_sent')->nullable()->default(0);
            $table->tinyInteger('ban')->nullable()->default(0);
            $table->double('shipping_cost')->nullable()->default(0);
            $table->date('date')->nullable();
            $table->double('refunds')->nullable()->default(0);
            $table->double('points')->nullable()->default(0);
            $table->text('message')->nullable();
            $table->text('message_ar')->nullable();
            $table->integer('code')->nullable();
            $table->integer('ref')->nullable()->default(0);
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('gender')->nullable();
            $table->integer('wallet_status')->nullable()->default(1);
            $table->integer('current_status')->nullable()->default(1);
            $table->string('company_name')->nullable();
            $table->string('contact_id')->nullable();
            $table->double('cuurent_balance')->nullable()->default(0);
            $table->text('l_url')->nullable();
            $table->integer('currency')->nullable()->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
