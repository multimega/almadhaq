<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->nullable();
            $table->enum('product_type',['normal','affiliate'])->nullable()->default('normal');

            $table->text('affiliate_link')->nullable();
            $table->integer('user_id')->nullable()->default(0);
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('childcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->text('attributes')->nullable();
            $table->text('name')->nullable();
            $table->text('name_ar')->nullable();
            $table->text('slug')->nullable();
            $table->text('slug_ar')->nullable();
            $table->string('photo')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('file')->nullable();
            $table->string('size')->nullable();
            $table->string('size_qty')->nullable();
            $table->string('size_price')->nullable();
            $table->string('color')->nullable();
            $table->double('price')->nullable();
            $table->double('mobile_price')->nullable()->default(0);
            $table->double('previous_price')->nullable()->default(0);
            $table->text('details')->nullable();
            $table->text('details_ar')->nullable();
            $table->integer('stock')->nullable();
            $table->text('policy')->nullable();
            $table->text('policy_ar')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->integer('views')->nullable()->default(0);
            $table->text('tags')->nullable();
            $table->text('tags_ar')->nullable();
            $table->text('features')->nullable();
            $table->text('colors')->nullable();
            $table->integer('product_condition')->nullable()->default(0);

            $table->string('ship')->nullable();

            $table->integer('is_meta')->nullable()->default(0);
            $table->text('meta_tag')->nullable();
            $table->text('meta_tag_ar')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('youtube')->nullable();
            $table->enum('type',['Physical','Digital','License'])->nullable();
            $table->text('license')->nullable();
            $table->text('license_qty')->nullable();
            $table->text('link')->nullable();
            $table->string('platform')->nullable();
            $table->string('region')->nullable();
            $table->string('licence_type')->nullable();
            $table->string('measure')->nullable();
            $table->integer('scale')->nullable()->default(1);
            $table->integer('featured')->nullable()->default(0);
            $table->integer('best')->nullable()->default(0);
            $table->integer('top')->nullable()->default(0);
            $table->integer('hot')->nullable()->default(0);
            $table->integer('latest')->nullable()->default(0);
            $table->integer('big')->nullable()->default(0);
            $table->integer('trending')->nullable()->default(0);
            $table->integer('sale')->nullable()->default(0);
            $table->integer('is_discount')->nullable()->default(0);
            $table->text('discount_date')->nullable();
            $table->text('whole_sell_qty')->nullable();
            $table->text('whole_sell_discount')->nullable();
            $table->integer('is_catalog')->nullable()->default(0);
            $table->integer('catalog_id')->nullable()->default(0);
            $table->integer('feature')->nullable()->default(0);
            $table->integer('erp_id')->nullable();
            $table->enum('subscription_type',['Years','Months','Days'])->nullable();
            $table->integer('subscription_period')->nullable();
            $table->integer('trial_period')->nullable();
            $table->text('mobile_photo')->nullable();
            $table->text('mobile_details')->nullable();
            $table->text('mobile_details_ar')->nullable();
            $table->text('mobile_policy')->nullable();
            $table->text('mobile_policy_ar')->nullable();
            $table->integer('like_status')->nullable()->default(0);
            $table->integer('free_ship')->nullable()->default(0);
            $table->string('hover_photo')->nullable();
            $table->string('alt')->nullable();
            $table->string('alt_ar')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('meta_keys_ar')->nullable();
            $table->text('title')->nullable();
            $table->text('title_ar')->nullable();

            $table->integer('size_status')->nullable()->default(1);

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
        Schema::dropIfExists('products');
    }
}
