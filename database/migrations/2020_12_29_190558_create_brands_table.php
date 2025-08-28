<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('slug')->nullable();
            $table->string('slug_ar')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->string('photo')->nullable();
            $table->integer('is_featured')->nullable()->default(0);
            $table->string('image')->nullable();
            $table->string('rand')->nullable();
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('meta_keys_ar')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->integer('erp_id')->nullable();
              $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
