<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Shipment;
use App\Models\ShipmentPrice;
use App\Models\ShipmentZone;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class ShipmentPriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = ShipmentPrice::all();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('value', function(ShipmentPrice $data) {
                                $sign = Currency::where('is_default','=',1)->first();
                                $price = $sign->sign . ($data->value * $sign->value);
                                return  $price;
                            }) ->editColumn('extra', function(ShipmentPrice $data) {
                                $sign = Currency::where('is_default','=',1)->first();
                                $pricee = $sign->sign . ($data->extra * $sign->value);
                                return  $pricee;
                            })->editColumn('shipment_id', function(ShipmentPrice $data) {
                               $shipments = Shipment::where('id',$data->shipment_id)->first();
                                $shipment = !empty($shipments) ? $shipments->name : "company deleted" ;
                                return  $shipment;
                            })->editColumn('to', function(ShipmentPrice $data) {
                               $shipmentss = ShipmentZone::where('id',$data->to)->first();
                                $zone = !empty($shipmentss) ? $shipmentss->name : "Zone deleted" ;
                                return  $zone;
                            })
                            ->addColumn('action', function(ShipmentPrice $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-shipment-price-edit',$data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-shipment-price-delete',$data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.shipmentprice.index');
    }

    //*** GET Request
    public function create()
    {
        $sign = Currency::where('is_default','=',1)->first();
        $shipments = Shipment::all();
        $zones = ShipmentZone::all();
        return view('admin.shipmentprice.create',compact('shipments','zones'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        
        
        
        
        //--- Validation Section
        
           $rules = [
            
            'to'                                           => 'required',
            'shipment_id'                                  => 'required',
            'value'                                        => 'required|numeric|min:0',
            'extra'                                        => 'required|numeric|min:0',
           
            
           
            
            ];
        $messages = [
            
           
            'to.required'                                   => trans('To Zone') . '    ' . trans('required'),
            'shipment_id.required'                          => trans('Shipment Method') .'    ' . trans('required'),
            'value.required'                                => trans('Price') .'    ' . trans('required'),
            'value.numeric'                                 => trans('Price') .'    ' . trans('numeric'),
            'value.min'                                     => trans('Price') .'    ' . trans('min'),
            'extra.numeric'                                 => trans('Extra Price') .'    ' . trans('numeric'),
            'extra.required'                                => trans('Extra Price') .'    ' . trans('required'),
            'extra.min'                                     => trans('Extra Price') .'    ' . trans('min'),
            
           
            
          
            
            
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
        $data = new ShipmentPrice();
        $input = $request->all();
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
        $shipments = Shipment::all();
        $data = ShipmentPrice::findOrFail($id);
         $zones = ShipmentZone::all();
        return view('admin.shipmentprice.edit',compact('data','shipments','zones'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        
         $rules = [
            
            'to'                                           => 'required',
            'shipment_id'                                  => 'required',
            'value'                                        => 'required|numeric|min:0',
            'extra'                                        => 'required|numeric|min:0',
           
            
           
            
            ];
        $messages = [
            
           
            'to.required'                                   => trans('To Zone') . '    ' . trans('required'),
            'shipment_id.required'                          => trans('Shipment Method') .'    ' . trans('required'),
            'value.required'                                => trans('Price') .'    ' . trans('required'),
            'value.numeric'                                 => trans('Price') .'    ' . trans('numeric'),
            'value.min'                                     => trans('Price') .'    ' . trans('min'),
            'extra.numeric'                                 => trans('Extra Price') .'    ' . trans('numeric'),
            'extra.required'                                => trans('Extra Price') .'    ' . trans('required'),
            'extra.min'                                     => trans('Extra Price') .'    ' . trans('min'),
            
           
            
          
            
            
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
        $data = ShipmentPrice::findOrFail($id);
        $input = $request->all();
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

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = ShipmentPrice::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
       $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
            ],200);  
        //--- Redirect Section Ends     
    }
}
