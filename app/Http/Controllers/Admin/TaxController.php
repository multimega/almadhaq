<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class TaxController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

  
    //*** GET Request
    public function index()
    {
        return view('admin.tax.index');
    }


    

    //*** GET Request
    public function edit($id)
    {
        $data = Currency::findOrFail($id);
        return view('admin.currency.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = ['name' => 'unique:currencies,name,'.$id,'sign' => 'unique:currencies,sign,'.$id,'image' => 'mimes:jpeg,jpg,png,gif,svg,webp|max:10000'];
        $customs = ['name.unique' => 'This name has already been taken.','sign.unique' => 'This sign has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } 
        
        $data = Currency::findOrFail($id);
        
        $input = $request->except(['image']);
        // dd($input);
        if ($file = $request->file('image')) 
        {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/currency',$name);           
            $input['image'] = $name;
            if(! empty($data->image)) {
            if (file_exists(public_path().'/assets/images/currency/'.$data->image)) {
                unlink(public_path().'/assets/images/currency/'.$data->image);
            }    
            }
            
        } 
        //--- Validation Section Ends
        // dd($input);
        
        //--- Logic Section
        
        
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
         return response()->json([
        'status' => true,    
        'msg'   => $msg
        
        ]);    
        //--- Redirect Section Ends            
    }

  

   
    
    

}