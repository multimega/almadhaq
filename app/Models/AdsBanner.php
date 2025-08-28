<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdsBanner extends Model
{
    protected $table = 'ads_banners';
    protected $fillable = ['title','photo','linked','linked_id'];
    public $timestamps = false;
}
