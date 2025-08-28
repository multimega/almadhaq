<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\City;
use App\Models\Zone;
use App\Models\Feature;
use App\Models\Piece;
use App\Models\Product;
use App\Models\Propiece;
use App\Models\Free;
use App\Models\Profree;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class CountryController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Country::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                        
                            ->addColumn('status', function(Country $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-country-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>'.__('Activated').'</option><<option data-val="0" value="'. route('admin-country-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>'.__('Deactivated').'</option>/select></div>';
                        
                            })   ->addColumn('default', function(Country $data) {
                               
                                  $default = $data->is_default == 1 ? '<a><i class="fa fa-check"></i> Default</a>' : '<a class="status" data-href="' . route('admin-country-default',['id1'=>$data->id,'id2'=>1]) . '">SetDefault</a>';
                                 return '<div class="action-list">'.$default.'</div>';
                            }) 
                            
                            
                            
                            ->addColumn('checkbox', function(Country $data) {
                              
                                return '<div class="">
                                <label class="container">
                                <input type="checkbox" name="id['.$data->id.'][]" value="'.$data->id.'" class="all row-select">
                                 <span class="checkmark" style="top: -27px;"></span>
                               </label>
                                </div>';
                            })
                            ->addColumn('action', function(Country $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-country-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>'.__('Edit').'</a><a href="javascript:;" data-href="' . route('admin-country-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['status','default','checkbox','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        
        return view('admin.country.index');
    }

    //*** GET Request
    public function create()
    {
        
        return view('admin.country.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            
            'country_code'                           => 'required',
            'country_name'                           => 'required|unique:countries',
            'phonecode'                              => 'required',
            
            
            ];
        $messages = [
            
            'country_name.unique'                    => trans('nameUnique'),
            'country_name.required'                  => trans('Country Name') . '    ' . trans('required'),
            'country_code.required'                  => trans('Country Code') . '    ' . trans('required'),
            'phonecode.required'                     => trans('Phone Code') . '    ' . trans('required'),
            
            
            
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
          return response()->json([
              'status' =>false,
              'errors' => $validator->messages(),
              
              ],200);
        }   
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Country();
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->photo);
                $input['photo'] = $name;
            }

        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
       $msg = trans('Add Success');
        
        
        return response()->json([
            'status' => true,
            'msg'   => $msg
            
        ],200); 
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function edit($id)
    {
        
        $data = Country::findOrFail($id);
        return view('admin.country.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {



         $rules = [
            
            'country_code'                           => 'required',
            'country_name'                           => 'unique:countries'. $id .'|required',
            'phonecode'                              => 'required',
            
            
            ];
        $messages = [
            
            'country_name.unique'                    => trans('nameUnique'),
            'country_name.required'                  => trans('Country Name') . '    ' . trans('required'),
            'country_code.required'                  => trans('Country Code') . '    ' . trans('required'),
            'phonecode.required'                     => trans('Phone Code') . '    ' . trans('required'),
            
            
            
        ];
        //--- Validation Section Ends

        //--- Logic Section
        $data = Country::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->photo);
                $input['photo'] = $name;
            }

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
       $msg = trans('Update Success');
        
        
        return response()->json([
            
            'status'  => true,
            'msg'   =>   $msg
            
        ],200);    
        //--- Redirect Section Ends           
    }
      //*** GET Request Status
      public function status($id1,$id2)
        {
            $data = Country::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Country::findOrFail($id);
        $child = Zone::where('country_id',$id)->get();
        foreach($child as $z){
          $sub_child = City::where('state_id',$z->id)->delete();
         
         
         
         }
          $ch = Zone::where('country_id',$id)->delete();
        $data->delete();
        //--- Redirect Section     
         $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200);     
        //--- Redirect Section Ends   
    }
    

  public function ckeckactivate(Request $request) {
        
             if (!empty($request->input('selected_products_activate'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_activate'));
    
                  
    
                    $products = Country::whereIn('id', $selected_products)
                                        ->update(['status' => 1]);
                                        
             $msg = 'Country activate Successfully.';
           return redirect()->back()->with('success',$msg);
         }else{
             return redirect()->back(); 
         }
     
   
    }  
      public function ckeckall(Request $request) {
        
             if (!empty($request->input('selected_products'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products'));
    
                  
    
                    $products = Country::whereIn('id', $selected_products)
                                        ->update(['status' => 0]);
                                        
              $msg = 'Country Deactivate Successfully.';                      
             return redirect()->back()->with('success',$msg);
                }else{
             return redirect()->back(); 
         }
     
   
    }
    
    
     public function ckeckdelete(Request $request) {
        
             if (!empty($request->input('selected_products_delete'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_delete'));
    
                  
    
                    $products = Country::whereIn('id', $selected_products)
                                        ->get();
                                        
        foreach($products as $data){
          $child = Zone::where('country_id',$data->id)->get();
                foreach($child as $z){
                    
                  $sub_child = City::where('state_id',$z->id)->delete();
                  
                 
                 }
          $ch = Zone::where('country_id',$data->id)->delete();
    
      
      
              $data->delete();
         }                      
                                        
          
            
          return redirect()->back()->with('success','Country deleted Successfully.');
         }else{
             return redirect()->back(); 
         }
     
   
    }
    
    
    
    
    
        public function Default($id1,$id2)
        {
            $data = Country::findOrFail($id1);
            $data->is_default = $id2;
            $data->update();
            $data = Country::where('id','!=',$id1)->update(['is_default' => 0]);
            //--- Redirect Section     
               $msg = 'Data Updated Successfully';
               return response()->json($msg); 
            //--- Redirect Section Ends  
        }
    
    
    
    
    
}
