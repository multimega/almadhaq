<?php

namespace App\Http\Controllers\Api;

use Datatables;
use App\Classes\GeniusMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Generalsetting;
use App\Models\Withdraw;
use App\Models\Currency;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;

class VendorController extends Controller
{
  


	//*** GET Request
    public function show($id)
    {
        $data = User::findOrFail($id);
         return response()->json(array('status' => 'Ok', 'data' => $data));

    }
    

}
