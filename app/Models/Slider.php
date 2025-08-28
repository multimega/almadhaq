<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['subtitle_text','subtitle_text_ar','subtitle_size','subtitle_color','subtitle_anime','title_text','btn_text','btn_text_ar','title_text_ar','title_size','title_color','title_anime','details_text','details_text_ar','details_size','details_color','details_anime','photo','position','link','linked','mobile_setting','link_id','first_side_photo','second_side_photo'];
    public $timestamps = false;
}
