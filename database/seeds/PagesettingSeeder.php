<?php

use Illuminate\Database\Seeder;

class PagesettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
           DB::table('pagesettings')->insert([
            [
                'id' => '1',
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
}
