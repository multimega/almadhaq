<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSeotoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seotools', function (Blueprint $table) {
            $table->increments('id');
            $table->text('google_analytics')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('facebook_pixel')->nullable();
            $table->text('title')->nullable();
            $table->text('title_ar')->nullable();
            $table->text('meta_keys_ar')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('product_analytics')->nullable();
            $table->text('category_analytics')->nullable();
            $table->text('offer_analytics')->nullable();
            $table->text('brand_analytics')->nullable();
            $table->text('subcategory_analytics')->nullable();
            $table->text('childcategory_analytics')->nullable();
        });
        DB::table('seotools')->insert([
            [
                'meta_keys' => 'Vowalaa,Vowalaa,',
                'title' => 'Vowalaa,',
                'title_ar' => 'Vowalaa,'


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
        Schema::dropIfExists('seotools');
    }
}
