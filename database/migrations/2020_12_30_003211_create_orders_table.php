<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->text('cart')->nullable();
            $table->string('method')->nullable();
            $table->string('shipping')->nullable();
            $table->string('pickup_location')->nullable();
            $table->string('totalQty')->nullable();
            $table->float('pay_amount')->nullable();
            $table->string('txnid')->nullable();
            $table->string('charge_id')->nullable();
            $table->string('order_number')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_country')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_zip')->nullable();
            $table->string('company_name')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_zip')->nullable();
            $table->text('order_note')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->enum('status',['pending','processing','completed','declined','on delivery'])->nullable();

            $table->timestamps();
            $table->string('affilate_user')->nullable();
            $table->string('affilate_charge')->nullable();
            $table->string('currency_sign')->nullable();
            $table->double('currency_value')->nullable()->default(1);
            $table->double('shipping_cost')->nullable()->default(0);
            $table->double('packing_cost')->nullable()->default(0);
            $table->integer('tax')->nullable()->default(0);
            $table->integer('shipment_id')->nullable();
            $table->double('shipping_price')->nullable()->default(0);
            $table->double('shipping_tax')->nullable()->default(0);
            $table->integer('dp')->nullable()->default(0);
            $table->text('pay_id')->nullable();
            $table->integer('vendor_shipping_id')->nullable()->default(0);
            $table->integer('vendor_packing_id')->nullable()->default(0);
            $table->integer('wallet')->nullable()->default(0);
            $table->string('company_fastlo_api')->nullable();
            $table->string('aramex_api_numbeer')->nullable();
            $table->string('id_api_aramex')->nullable();
            $table->string('pickuptrack_api')->nullable();
            $table->integer('order_completed')->nullable()->default(0);
            $table->string('domain_name')->nullable();
            $table->string('add_domain')->nullable()->default('no');
            $table->text('serial')->nullable();
            $table->text('fedex_pic_api')->nullable();
            $table->text('Awb')->nullable();
            $table->text('pickup_id')->nullable();
            $table->text('barcod')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
