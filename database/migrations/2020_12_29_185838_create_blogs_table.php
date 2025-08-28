<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('details')->nullable();
            $table->text('details_ar')->nullable();
            $table->string('photo')->nullable();
            $table->string('source')->nullable();
            $table->integer('views')->nullable()->default(0);
            $table->integer('status')->nullable()->default(1);
            $table->text('meta_tag')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('tags')->nullable();
            $table->text('alt')->nullable();
            $table->text('alt_ar')->nullable();
            $table->text('author')->nullable();
            $table->text('mobile_details')->nullable();
            $table->text('mobile_details_ar')->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
