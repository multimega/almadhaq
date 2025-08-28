<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->integer('active')->nullable()->default(1);

    });
        DB::table('features')->insert([
            [
                'name' => 'Promo Codes'

            ], [
                'name' => 'Loyalty Program'

            ], [
                'name' => 'Wallet'

            ], [
                'name' => 'Referrals program'

            ], [
                'name' => 'Whats APP & Messenger Chat '

            ], [
                'name' => 'Offer Pages'

            ], [
                'name' => 'Notifications'

            ], [
                'name' => 'Templates'

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
        Schema::dropIfExists('features');
    }
}
