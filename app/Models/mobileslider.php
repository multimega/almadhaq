<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mobileslider extends Model
{
    protected $table = 'sliders';
    protected $fillable = ['subtitle_text','subtitle_text_ar','subtitle_size','subtitle_color','subtitle_anime','title_text','title_text_ar','title_size','title_color','title_anime','details_text','details_text_ar','details_size','details_color','details_anime','photo','position','mobile_setting','linked','link_id'];
    public $timestamps = false;
}
