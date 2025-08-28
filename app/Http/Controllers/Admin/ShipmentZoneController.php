<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\ShipmentZone;
use App\Models\Shipment;
use App\Models\Zone;
use App\Models\Country;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class ShipmentZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
        $datas = ShipmentZone::all();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)

            ->addColumn('action', function (ShipmentZone $data) {
                return '<div class="action-list">
                                  <a href="' . route('admin-city-zone-index', $data->id) . '" class="edit" > <i class="fas fa-edit"></i>Cities</a>
                                <a data-href="' . route('admin-zones-edit', $data->id) . '" class="edit" data-bs-toggle="modal" data-bs-target="#modal1"> <i class="fas fa-edit"></i>Edit</a>
                                <a href="javascript:;" data-href="' . route('admin-zones-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
            })
            ->rawColumns(['action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.zones.index');
    }

    //*** GET Request
    public function create()
    {
        $sign = Currency::where('is_default', '=', 1)->first();
        return view('admin.zones.create', compact('sign'));
    }

    //*** POST Request
    public function store(Request $request)
    {




        //--- Validation Section


        $rules = [

            'name'                                         => 'unique:shipment_zone,name|required',
            'name_ar'                                      => 'unique:shipment_zone,name|required',


        ];

        $messages = [
            'name.unique'                                 => trans('Name') . '  ' . trans('unique'),
            'name.required'                               => trans('Name') . '  ' . trans('required'),
            'name_ar.unique'                              => trans('Arabic Name') . '  ' . trans('unique'),
            'name_ar.required'                            => trans('Arabic Name') . '  ' . trans('required'),


        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }






        //--- Validation Section Ends

        //--- Logic Section
        $data = new ShipmentZone();
        $input = $request->all();
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = trans('Add Success');


        return response()->json([
            'status' => true,
            'msg'   => $msg

        ], 200);
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id)
    {
        $sign = Currency::where('is_default', '=', 1)->first();
        $data = ShipmentZone::findOrFail($id);
        return view('admin.zones.edit', compact('data', 'sign'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [

            'name'                                         => 'required',
            'name_ar'                                      => 'required',


        ];

        $messages = [
            'name.unique'                                 => trans('Name') . '  ' . trans('unique'),
            'name.required'                               => trans('Name') . '  ' . trans('required'),
            'name_ar.unique'                              => trans('Arabic Name') . '  ' . trans('unique'),
            'name_ar.required'                            => trans('Arabic Name') . '  ' . trans('required'),


        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = ShipmentZone::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = trans('Update Success');


        return response()->json([

            'status'  => true,
            'msg'   =>   $msg

        ], 200);
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = ShipmentZone::findOrFail($id);
        $zones =  Zone::where('zone_id', $id)->get();

        foreach ($zones as $z) {
            $z->zone_id = null;
            $z->update();
        }
        $data->delete();
        //--- Redirect Section     
        $msg = trans('Delete Msg');
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);
        //--- Redirect Section Ends     
    }


    //*** GET Request
    public function citycreate()
    {
        $zones = ShipmentZone::get();
        $countries = Country::where('status', 1)->get();
        return view('admin.zones.city', compact('zones', 'countries'));
    }

    //*** POST Request
    public function citystore(Request $request)
    {
        //--- Validation Section

        //--- Validation Section Ends
        if ($request->city_id) {

            $interest_array = $request->city_id;

            $array_len = count($interest_array);
            for ($i = 0; $i < $array_len; $i++) {

                $city = Zone::find($interest_array[$i]);

                $city->zone_id = $request->zone_id;

                $city->update();
            }
        }

        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = trans('Add Success');


        return response()->json([
            'status' => true,
            'msg'   => $msg

        ], 200);
        //--- Redirect Section Ends    
    }
    public function city($id)
    {

        //--- Validation Section

        //--- Validation Section Ends
      //  $city = Country::where('zone_id', $id)->get();
        $city = Zone::where('zone_id', $id)->get();

        return view('admin.zones.zones', compact('city'));
    }
    public function citydelete($id)
    {
        //--- Validation Section

        //--- Validation Section Ends
       // $city = Country::where('id', $id)->first();
        $city = Zone::where('id', $id)->first();
        $city->zone_id = null;
        $city->update();

        return redirect()->back();
    }
}
