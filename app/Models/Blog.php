<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title','title_ar','category_id', 'details', 'details_ar', 'photo', 'source', 'views','updated_at', 'status','meta_tag','meta_description','meta_description_ar','tags','alt','alt_ar','author','mobile_details','mobile_details_ar'];

    protected $dates = ['created_at'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    public function category()
    {
    	return $this->belongsTo('App\Models\BlogCategory','category_id');
    }    

}
