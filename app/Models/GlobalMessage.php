<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalMessage extends Model {

    protected $table = "global_messages";
    protected $fillable = array('min', 'max', 'status', 'message');
    public $timestamps = false;

}
