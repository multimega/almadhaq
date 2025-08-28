<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_type')->nullable();
            $table->mediumText('email_subject')->nullable();
            $table->longText('email_body')->nullable();
            $table->integer('status')->nullable()->default(1);
        });


        DB::table('email_templates')->insert([
            [
                'email_type' => 'new_order',
                'email_subject' => 'Your Order Placed Successfully',
                'email_body' => '<p>Hello {customer_name},<br>Your Order Number is {order_number}<br>Your order has been placed successfully</p>'
            ], [
                'email_type' => 'new_registration',
                'email_subject' => 'Welcome To Vowalaa E-Commerce',
                'email_body' => "<p>Hello {customer_name},<br>You have successfully registered to {website_title}, We wish you will have a wonderful experience using our service.</p><p>Thank You<br></p>"
            ], [
                'email_type' => 'vendor_accept',
                'email_subject' => 'Your Vendor Account Activated',
                'email_body' => '<p>Hello {customer_name},<br>Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.</p><p>Thank You<br></p>'
            ], [
                'email_type' => 'subscription_warning',
                'email_subject' => 'Your subscrption plan will end after five days',
                'email_body' => '<p>Hello {customer_name},<br>Your subscription plan duration will end after five days. Please renew your plan otherwise all of your products will be deactivated.</p><p>Thank You<br></p>'
            ], [
                'email_type' => 'vendor_verification',
                'email_subject' => 'Request for verification.',
                'email_body' => '<p>Hello {customer_name},<br>You are requested verify your account. Please send us photo of your passport.</p><p>Thank You<br></p>'
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
        Schema::dropIfExists('email_templates');
    }
}
