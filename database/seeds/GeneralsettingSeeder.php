<?php

use Illuminate\Database\Seeder;

class GeneralsettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        
        DB::table('generalsettings')->insert([
            [
                'id' => '1',
                'logo' => '16079862321595537899Untitdsadsaled.png',
                'logo_ar' => '16092823381280px-Samsung_Logo.svg.png',
                'favicon' => '16079841051585070655Vowaa.png',
                'title' => 'Vowalaa',
                'title_ar' => 'فوالا',
                'header_email' => 'Info@example.com',
                'header_phone' => '015203043012',
                'footer' => '<p>Footer text&gt;</p>',
                'footer_ar' => '<p>Footer text&gt;</p>',
                'copyright' => '<div>&gt;COPYRIGHT &copy; 2020. All Rights Reserved By MultiMega, Developed By <a href="http://vowalaa.com" target="" title="">Vowalaa.com</a></div>',
                'copyright_ar' => '<div>&gt;COPYRIGHT &copy; 2020. All Rights Reserved By MultiMega, Developed By <a href="http://vowalaa.com" target="" title="">Vowalaa.com</a></div>',
                'colors' => '#0d0609',
                'loader' => '16091893331595675963preloader.gif',
                'admin_loader' => '16079845031595675963preloader.gif',
                'map_key' => 'AIzaSyB1GpE4qeoJ__70UZxvX9CTMUTZRZNHcu8',
                'smtp_host' => 'in-v3.mailjet.com',
                'smtp_port' => 587,
                'smtp_user' => '0e05029e2dc70da691aa2223aa53c5be',
                'smtp_pass' => '5df1b6242e86bce602c3fd9adc178460',
                'from_email' => 'admin@vowalaa.com',
                'from_name' => 'Vowalaa',
                'add_cart' => 'Successfully Added To Cart',
                'out_stock' => 'Out Of Stock',
                'add_wish' => 'Add To Wishlist',
                'already_wish' => 'Already Added To Wishlist',
                'wish_remove' => 'wish_remove',
                'add_compare' => 'Successfully Added To Compare',
                'already_compare' => 'Already Added To Compare',
                'compare_remove' => 'Successfully Removed From The Compare',
                'color_change' => 'Successfully Changed The Color',
                'coupon_found' => 'Coupon Found',
                'no_coupon' => 'No Coupon Found',
                'already_coupon' => 'Coupon Already Applied',
                'order_title' => 'THANK YOU FOR YOUR PURCHASE.',
                'order_text' => 'We\'ll email you an order confirmation with details and tracking info.',
                'affilate_banner' => '15587771131554048228onepiece.jpeg',
                'already_cart' => 'Already Added To Cart',
                'cod_text' => 'Pay with cash upon delivery.',
                'paypal_text' => 'Pay via your PayPal account.',
                'stripe_text' => 'Pay via your Credit Card.',
                'header_color' => '#ffffff',
                'footer_color' => '#2846db',
                'copyright_color' => '#02020c',
                'menu_color' => '#ff5500',
                'menu_hover_color' => '#02020c',
                'error_banner' => '16079884381566878455404.png',
                'popup_title' => 'NEWSLETTER',
                'popup_text' => 'Subscribe in our Emails Newsletter',
                'popup_title_ar' => 'arabic NEWSLETTER',
                'popup_text_ar' => 'بامكانك التسجيل معنا',
                'popup_background' => '1607986151158384925298758.png',
                'invoice_logo' => '1581489581logo-signs.png',
                'user_image' => '1567655174profile.jpg',
                'vendor_color' => '#666666',
                'footer_logo' => '16079862281595537899Untitdsadsaled.png',
                'wallet_photo' => '1595331656nike-highres-500x500-1.jpg',
                'loyalty_photo' => '1595331656images.png',
                'address' => 'Maadi, Cairo',
                'address_ar' => 'Maadi, Cairo',
                'phone' => '233060021',
                'working_hours' => '9 AM : 7 PM',
                'email' => 'test@yahoo.com',
                'paymentsicon' => '1590681359payments.png',
                'points' => '0.2',
                'refelar_points' => '100',
                'light_dark' => '1',
                'is_brand' => '1',
                'is_shop' => '1',
                'templatee_select' => '1',
                'free_shipping' => '1000000',
            ]

        ]);
    }
}
