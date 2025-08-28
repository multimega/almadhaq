<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['title', 'details','title_ar', 'details_ar', 'mobile_details_ar', 'mobile_details'];
    public $timestamps = false;
}
