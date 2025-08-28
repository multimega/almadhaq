<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePagesettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagesettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_success')->nullable();
            $table->string('contact_success_ar')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('contact_title')->nullable();
            $table->text('contact_title_ar')->nullable();
            $table->text('contact_text')->nullable();
            $table->text('contact_text_ar')->nullable();
            $table->text('side_title')->nullable();
            $table->text('side_text')->nullable();
            $table->text('street')->nullable();
            $table->text('street_ar')->nullable();
            $table->text('phone')->nullable();
            $table->text('fax')->nullable();
            $table->text('w_phone')->nullable();
            $table->text('page_id')->nullable();
            $table->text('email')->nullable();
            $table->text('site')->nullable();
            $table->integer('slider')->nullable()->default(1);
            $table->integer('service')->nullable()->default(1);
            $table->integer('featured')->nullable()->default(1);
            $table->integer('small_banner')->nullable()->default(1);
            $table->integer('best')->nullable()->default(1);
            $table->integer('top_rated')->nullable()->default(1);
            $table->integer('large_banner')->nullable()->default(1);
            $table->integer('big')->nullable()->default(1);
            $table->integer('hot_sale')->nullable()->default(1);
            $table->integer('partners')->nullable()->default(1);
            $table->integer('review_blog')->nullable()->default(1);
            $table->integer('bottom_small')->nullable()->default(1);
            $table->integer('flash_deal')->nullable()->default(1);
            $table->text('best_seller_banner')->nullable();
            $table->text('best_seller_banner_link')->nullable();
            $table->text('big_save_banner')->nullable();
            $table->text('big_save_banner_link')->nullable();
            $table->text('best_seller_banner1')->nullable();
            $table->text('best_seller_banner_link1')->nullable();
            $table->text('big_save_banner1')->nullable();
            $table->text('big_save_banner_link1')->nullable();
            $table->integer('featured_category')->nullable()->default(1);
            $table->text('map')->nullable();

        });

        DB::table('pagesettings')->insert([
            [
                'contact_success' => '<p>Success! Thanks for contacting us, we will get back to you shortly.</p>',
                'contact_success_ar' => '<p>Success! Thanks for contacting us, we will get back to you shortly.</p>',
                'contact_email' => 'test@outlook.com',
                'contact_title' => '<h4>WE&#39;D LOVE TO</h4><h2>HEAR FROM YOU</h2>',
                'contact_title_ar' => '<h4>WE&#39;D LOVE TO</h4><h2>HEAR FROM YOU</h2>',
                'contact_text' => '<p><span style="color:#777777">Send us a message and we&#39; ll respond as soon as possible.</span></p>',
                'contact_text_ar' => '<p><span style="color:#777777">Send us a message and we&#39; ll respond as soon as possible.</span></p>',
                'side_title' => '<h4 class="title" style="margin-bottom: 10px; font-weight: 600; line-height: 28px; font-size: 28px;">Let\'s Connect</h4>',
                'side_text' => '<span style="color: rgb(51, 51, 51);">Get in touch with us</span>',
                'street' => '13, 162B street Maadi, Cairo, Egypt',
                'street_ar' => '13, 162B street Maadi, Cairo, Egypt',
                'phone' => '+201004282491',
                'fax' => '+20225250510',
                'w_phone' => '+201004282491',
                'page_id' => '2137860159616121',
                'email' => 'Sales@vowalaa.com',
                'site' => 'https://vowalaa.com',
                'best_seller_banner' => '15951034361592907257_2-en.jpg',
                'best_seller_banner_link' => 'http://google.com',
                'big_save_banner' => '15951034531568889164bottom1.jpg',
                'big_save_banner_link' => 'http://google.com',
                'best_seller_banner1' => '15951034361592907629_4-en.jpg',
                'best_seller_banner_link1' => 'http://google.com',
                'big_save_banner1' => '15951034531568889151top2.jpg',
                'big_save_banner_link1' => 'http://google.com'

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
        Schema::dropIfExists('pagesettings');
    }
}
