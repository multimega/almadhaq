<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGeneralsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generalsettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo')->nullable();
            $table->string('logo_ar')->nullable();
            $table->string('favicon')->nullable();
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('header_email')->nullable();
            $table->text('header_phone')->nullable();
            $table->text('footer')->nullable();
            $table->text('footer_ar')->nullable();
            $table->text('copyright')->nullable();
            $table->text('copyright_ar')->nullable();
            $table->string('colors')->nullable();
            $table->string('loader')->nullable();
            $table->string('admin_loader')->nullable();
            $table->integer('is_talkto')->nullable()->default(0);
            $table->text('talkto')->nullable();
            $table->integer('is_drift')->nullable()->default(0);
            $table->text('drift')->nullable();
            $table->integer('is_messenger')->nullable()->default(0);
            $table->text('messenger')->nullable();
            $table->integer('is_language')->nullable()->default(1);
            $table->integer('is_loader')->nullable()->default(1);

            $table->text('map_key')->nullable();

            $table->integer('is_disqus')->nullable()->default(0);
            $table->text('disqus')->nullable();
            $table->integer('is_contact')->nullable()->default(1);
            $table->integer('is_faq')->nullable()->default(1);
            $table->integer('guest_checkout')->nullable()->default(1);
            $table->integer('stripe_check')->nullable()->default(0);
            $table->integer('cod_check')->nullable()->default(1);
            $table->text('stripe_key')->nullable();
            $table->text('stripe_secret')->nullable();
            $table->integer('currency_format')->nullable()->default(1);

            $table->double('withdraw_fee')->nullable()->default(0);
            $table->double('withdraw_charge')->nullable()->default(0);
            $table->double('tax')->nullable()->default(0);
            $table->double('shipping_cost')->nullable()->default(0);
            $table->string('smtp_host')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_user')->nullable();
            $table->string('smtp_pass')->nullable();
            $table->string('from_email')->nullable();
            $table->string('from_name')->nullable();
            $table->integer('is_smtp')->nullable()->default(1);
            $table->integer('is_comment')->nullable()->default(1);
            $table->integer('is_currency')->nullable()->default(1);
            $table->text('add_cart')->nullable();
            $table->text('out_stock')->nullable();
            $table->text('add_wish')->nullable();
            $table->text('already_wish')->nullable();
            $table->text('wish_remove')->nullable();
            $table->text('add_compare')->nullable();
            $table->text('already_compare')->nullable();
            $table->text('compare_remove')->nullable();
            $table->text('color_change')->nullable();
            $table->text('coupon_found')->nullable();
            $table->text('no_coupon')->nullable();
            $table->text('already_coupon')->nullable();
            $table->text('order_title')->nullable();
            $table->text('order_text')->nullable();
            $table->integer('is_affilate')->nullable()->default(0);
            $table->integer('affilate_charge')->nullable()->default(0);
            $table->text('affilate_banner')->nullable();
            $table->text('already_cart')->nullable();
            $table->double('fixed_commission')->nullable()->default(0);
            $table->double('percentage_commission')->nullable()->default(0);
            $table->integer('multiple_shipping')->nullable()->default(0);
            $table->integer('multiple_packaging')->nullable()->default(0);
            $table->integer('vendor_ship_info')->nullable()->default(0);
            $table->integer('reg_vendor')->nullable()->default(0);
            $table->text('cod_text')->nullable();
            $table->text('paypal_text')->nullable();
            $table->text('stripe_text')->nullable();
            $table->string('header_color')->nullable();
            $table->string('footer_color')->nullable();
            $table->string('copyright_color')->nullable();
            $table->integer('is_admin_loader')->nullable()->default(0);
            $table->string('menu_color')->nullable();
            $table->string('menu_hover_color')->nullable();
            $table->integer('is_home')->nullable()->default(1);
            $table->integer('is_verification_email')->nullable()->default(0);
            $table->string('instamojo_key')->nullable();
            $table->string('instamojo_token')->nullable();

            $table->text('instamojo_text')->nullable();

            $table->integer('is_instamojo')->nullable()->default(0);
            $table->integer('instamojo_sandbox')->nullable()->default(0);
            $table->integer('is_paystack')->nullable()->default(0);

            $table->text('paystack_key')->nullable();
            $table->text('paystack_email')->nullable();
            $table->text('paystack_text')->nullable();

            $table->integer('wholesell')->nullable()->default(0);

            $table->integer('is_capcha')->nullable()->default(1);
            $table->string('error_banner')->nullable();
            $table->integer('is_popup')->nullable()->default(0);

            $table->text('popup_title')->nullable();
            $table->text('popup_text')->nullable();
            $table->text('popup_title_ar')->nullable();
            $table->text('popup_text_ar')->nullable();

            $table->text('popup_background')->nullable();
            $table->string('invoice_logo')->nullable();
            $table->string('user_image')->nullable();
            $table->string('vendor_color')->nullable();

            $table->integer('is_secure')->nullable()->default(0);
            $table->integer('is_report')->nullable()->default(0);
            $table->integer('paypal_check')->nullable()->default(0);
            $table->text('paypal_business')->nullable();
            $table->text('footer_logo')->nullable();
            $table->string('email_encryption')->nullable();
            $table->text('paytm_merchant')->nullable();
            $table->text('paytm_secret')->nullable();
            $table->text('paytm_website')->nullable();
            $table->text('paytm_industry')->nullable();
            $table->integer('is_paytm')->nullable()->default(0);
            $table->text('paytm_text')->nullable();
            $table->enum('paytm_mode',['sandbox','live'])->nullable();
            $table->integer('is_molly')->nullable()->default(0);

            $table->text('molly_key')->nullable();
            $table->text('molly_text')->nullable();

            $table->integer('is_razorpay')->nullable()->default(0);
            $table->text('razorpay_key')->nullable();
            $table->text('razorpay_secret')->nullable();
            $table->text('razorpay_text')->nullable();
            
            $table->integer('is_tabby')->nullable()->default(0);
            $table->string('tabby_key')->nullable();
            $table->string('tabby_secret')->nullable();
            
            $table->integer('is_telr')->nullable()->default(0);
            $table->string('telr_store_id')->nullable();
            $table->string('telr_auth_key')->nullable();
            
            $table->integer('show_stock')->nullable()->default(0);
            $table->integer('is_maintain')->nullable()->default(0);
            $table->text('maintain_text')->nullable();
            $table->string('wallet_photo')->nullable();
            $table->string('loyalty_photo')->nullable();
            $table->integer('shipment')->nullable()->default(1);
            $table->integer('templatee_select')->nullable()->default(1);

            $table->string('address')->nullable();
            $table->string('address_ar')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('paymentsicon')->nullable();
            $table->double('points')->nullable()->default(0.2);
            $table->integer('refelar_points')->nullable()->default(100);
            $table->string('subscribee_message')->nullable()->default('subscribe');
            $table->string('subscribee_message_ar')->nullable()->default('subscribee_message_ar');
            $table->string('messagee')->nullable()->default('Vowalaa-APPs');
            $table->string('messagee_ar')->nullable()->default('Vowalaa-APPs');

            $table->integer('light_dark')->nullable()->default(1);
            $table->integer('is_shop')->nullable()->default(1);
            $table->integer('is_brand')->nullable()->default(1);
            $table->string('brandphoto')->nullable();
            $table->double('free_shipping')->nullable()->default(10000);
            $table->text('map')->nullable();
            $table->text('fawry_secret')->nullable();
            $table->text('cancel_url')->nullable();
            $table->text('bostaakey')->nullable();
            $table->text('policy')->nullable();
            $table->text('policy_ar')->nullable();
            $table->text('name_api')->nullable();
            $table->text('password_api')->nullable();
            $table->text('merchant_name')->nullable();
            $table->text('merchant_id')->nullable();
            $table->text('password_nbe')->nullable();
            $table->text('merchant_nbe')->nullable();
            $table->text('name_nbe')->nullable();
            $table->text('merchant_id_nbe')->nullable();
            $table->text('fastlookey')->nullable();
            $table->text('aramexuser')->nullable();
            $table->text('aramex_password')->nullable();
            $table->text('api_key')->nullable();
            $table->text('publickey')->nullable();
            $table->text('privatekey')->nullable();
            $table->text('accountnum')->nullable();
            $table->text('fedex_password')->nullable();
            $table->text('fedexaccount')->nullable();
            $table->text('accept_merchant')->nullable();
            $table->text('accept_key')->nullable();
            $table->text('paymentid')->nullable();
            $table->text('framepaymentt')->nullable();
            $table->text('abs_username')->nullable();
            $table->text('abs_password')->nullable();
             $table->integer('allow_shipto')->nullable()->default(1);
             $table->integer('allow_pickup')->nullable()->default(1);
             $table->integer('allow_zip')->nullable()->default(1);
             $table->text('mylerz_username')->nullable();
             $table->text('mylerz_password')->nullable();
             $table->text('feature_icon')->nullable();
             $table->text('best_icon')->nullable();
             $table->text('top_icon')->nullable();
             $table->text('big_icon')->nullable();
             $table->text('new_icon')->nullable();
             $table->text('hot_icon')->nullable();
             $table->text('trending_icon')->nullable();
             $table->text('discount_icon')->nullable();
             $table->text('thawani_publish')->nullable();
             $table->text('thawani_secret')->nullable();
             $table->text('thawani_link')->nullable();
             $table->text('fatoratoken')->nullable();
             $table->text('paypal_secret')->nullable();
             $table->text('paypal_client_id')->nullable();
             $table->text('paypal_status')->nullable();
             $table->text('vapulus_secret')->nullable();
             $table->text('vapulus_hash')->nullable();
             $table->text('application_id')->nullable();
             $table->text('order_url')->nullable();

        });



        DB::table('generalsettings')->insert([
            [
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
				 'points' => '0.2',
                'refelar_points' => '100',
                'light_dark' => '1',
                'is_brand' => '1',
                'is_shop' => '1',
                'templatee_select' => '1',
                'free_shipping' => '1000000',
                'paymentsicon' => '1590681359payments.png'
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
        Schema::dropIfExists('generalsettings');
    }
}
