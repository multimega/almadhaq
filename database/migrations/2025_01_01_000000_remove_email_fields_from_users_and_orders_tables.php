<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveEmailFieldsFromUsersAndOrdersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['email', 'email_verified']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_email', 'shipping_email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->unique();
            $table->enum('email_verified', ['Yes', 'No'])->nullable()->default('No');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_email')->nullable();
            $table->string('shipping_email')->nullable();
        });
    }
}
