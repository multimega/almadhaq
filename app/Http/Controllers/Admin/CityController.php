<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\Zone;
use App\Models\Country;
use App\Models\City;
use App\Models\CityShippingSchedule;


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

class CityController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }


    
    //*** JSON Request
    public function datatables()
    {
         $datas = Zone::with('shippingSchedules')->orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                        
                            ->editColumn('country_id', function(Zone $data) {
                                $country =  Country::find($data->country_id);
                                 $country_name = !empty($country->country_name) ?$country->country_name : "deleted" ;
                                return $country_name;
                            })
                            ->addColumn('shipping_schedules', function(Zone $data) {
                                $schedulesCount = $data->shippingSchedules->count();
                                $activeCount = $data->shippingSchedules->where('is_active', true)->count();
                                
                                if ($schedulesCount == 0) {
                                    return '<span class="badge badge-warning">No Schedules</span>';
                                }
                                
                                return '<span class="badge badge-info">' . $activeCount . '/' . $schedulesCount . ' Active</span>';
                            })
                            ->addColumn('status', function(Zone $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-city-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>'.__('Activated').'</option><option data-val="0" value="'. route('admin-city-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>'.__('Deactivated').'</option></select></div>';
                            })
                            ->addColumn('checkbox', function(Zone $data) {
                              
                                return '<div class="">
                                <label class="container">
                                <input type="checkbox" name="id['.$data->id.'][]" value="'.$data->id.'" class="all row-select">
                                 <span class="checkmark" style="top: -27px;"></span>
                               </label>
                                </div>';
                            })
                            ->addColumn('action', function(Zone $data) {
                                $actions = '<div class="action-list">';
                                $actions .= '<a data-href="' . route('admin-city-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>'.__('Edit').'</a>';
                                $actions .= '<a href="' . route('admin-city-shipping-schedules',$data->id) . '" class="btn btn-sm btn-info"> <i class="fas fa-clock"></i> Schedules</a>';
                                $actions .= '<a href="javascript:;" data-href="' . route('admin-city-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>';
                                $actions .= '</div>';
                                return $actions;
                            }) 
                            ->rawColumns(['status','checkbox', 'action', 'shipping_schedules'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    
    //*** GET Request
    public function index()
    {
        
        return view('admin.city.index');
    }

    //*** GET Request
    public function create()
    {
        
        return view('admin.city.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            
            'name'                            => 'unique:zone|required',
            'name_ar'                         => 'unique:zone|required',
            'country_id'                      => 'required',
            'allow_cash'                      => 'nullable'
            
            ];
        $messages = [
            
            'name.unique'                    =>  trans('nameUnique'),
            'name.required'                  => trans('City Name') . '    ' . trans('required'),
            'name_ar.unique'                 =>  trans('City Name'). '    '. 'Arabic'. '    ' . trans('unique'),
            'name_ar.required'                  => trans('City Name') . '    '. 'Arabic'. '    ' . trans('required'),
            'country_id.required'            => trans('Country Name') . '    ' . trans('required'),
            
            
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
        $data = new Zone();
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
        
        $data = Zone::findOrFail($id);
        return view('admin.city.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        
        
        $rules = [
            
            'name'                            => 'required',
            'name_ar'                         => 'required',
            'country_id'                      => 'required',
            'allow_cash'                      => 'nullable'
            
            ];
        $messages = [
            
            'name.unique'                    =>  trans('nameUnique'),
            'name.required'                  => trans('City Name') . '    ' . trans('required'),
            'name_ar.unique'                 =>  trans('City Name'). '    '. 'Arabic'. '    ' . trans('unique'),
            'name_ar.required'                  => trans('City Name') . '    '. 'Arabic'. '    ' . trans('required'),
            'country_id.required'            => trans('Country Name') . '    ' . trans('required'),
            
            
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
        $data = Zone::findOrFail($id);
        $input = $request->all();
        if(!$request->allow_cash){
            $input['allow_cash'] = 'off';
        }
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
            $data = Zone::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Zone::findOrFail($id);
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
    
                  
    
                    $products = Zone::whereIn('id', $selected_products)
                                        ->update(['status' => 1]);
                                        
             $msg = 'Zone activate Successfully.';
           return redirect()->back()->with('success',$msg);
         }else{
             return redirect()->back(); 
         }
     
   
    }  
      public function ckeckall(Request $request) {
        
             if (!empty($request->input('selected_products'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products'));
    
                  
    
                    $products = Zone::whereIn('id', $selected_products)
                                        ->update(['status' => 0]);
                                        
              $msg = 'Zone Deactivate Successfully.';                      
             return redirect()->back()->with('success',$msg);
                }else{
             return redirect()->back(); 
         }
     
   
    }
      
    
    
     public function ckeckdelete(Request $request) {
        
             if (!empty($request->input('selected_products_delete'))) {
                
    
                    $selected_products = explode(',', $request->input('selected_products_delete'));
    
                  
    
                    $products = Zone::whereIn('id', $selected_products)
                                        ->get();
                                        
        foreach($products as $data){
         
               $sub_child = City::where('state_id',$data->id)->delete();
                  
            
    
      
      
              $data->delete();
         }                      
                                        
          
            
          return redirect()->back()->with('success','Zone deleted Successfully.');
         }else{
             return redirect()->back(); 
         }
     
   
    }


    
}
