<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $fillable = ['title', 'details','title_ar', 'details_ar', 'subtitle'];
    public $timestamps = false;
}
