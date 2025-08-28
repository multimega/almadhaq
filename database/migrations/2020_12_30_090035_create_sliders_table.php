<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->text('subtitle_text')->nullable();
            $table->text('subtitle_text_ar')->nullable();
            $table->text('subtitle_size')->nullable();
            $table->text('subtitle_color')->nullable();
            $table->text('subtitle_anime')->nullable();
            $table->text('title_text')->nullable();
            $table->text('title_text_ar')->nullable();
            $table->text('title_size')->nullable();
            $table->text('title_color')->nullable();
            $table->text('title_anime')->nullable();
            $table->text('details_text')->nullable();
            $table->text('details_text_ar')->nullable();
            $table->text('details_size')->nullable();
            $table->text('details_color')->nullable();
            $table->text('details_anime')->nullable();
            $table->text('photo')->nullable();
            $table->text('position')->nullable();
            $table->text('link')->nullable();
            $table->text('btn_text')->nullable();
            $table->text('btn_text_ar')->nullable();
            $table->text('first_side_photo')->nullable();
            $table->text('second_side_photo')->nullable();
            $table->integer('mobile_setting')->nullable()->default(0);
            $table->integer('linked')->nullable()->default(0);
            $table->integer('link_id')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
