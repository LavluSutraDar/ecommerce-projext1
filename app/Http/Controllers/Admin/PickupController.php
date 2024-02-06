<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Database theke data tule ane yejratable a show kora
    public function pickup_point_index(Request $request)
    {
        if ($request->ajax()) {
            $pickup_point_data = DB::table('pickup_point')->latest()->get();
            return DataTables::of($pickup_point_data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="" class="btn btn-info btn-lg editpickup" 
                data-id="' . $row->id . '" data-toggle="modal" data-target="#editpickupModal">
                <i class="fa-solid fa-pen-to-square"></i>
                </a>
                
                  <a href="' . route('pickuppoint.delete', [$row->id]) . '" class="btn btn-danger btn-lg" id="delete_coupon"> 
                  <i class="fa-solid fa-trash-can"></i>
                  </a>';
                    return $actionbtn;
                })->rawColumns(['action'])->make(true);
        }
        return view('admin.pickup_point.pickup_index');
    }

    // pickup point store
    public function pickup_point_store(Request $request)
    {

        $validated = $request->validate([
            'pickup_point_name' => 'required',
            'pickup_point_address' => 'required',
            'pickup_point_phone' => 'required|unique:pickup_point',
            'pickup_point_phone_two' => 'required|unique:pickup_point',
        ]);

        //Quere Builder
        $data = array();
        $data['pickup_point_name'] = $request->pickup_point_name;
        $data['pickup_point_address'] = $request->pickup_point_address;
        $data['pickup_point_phone'] = $request->pickup_point_phone;
        $data['pickup_point_phone_two'] = $request->pickup_point_phone_two;

        DB::table('pickup_point')->insert($data);
        $notifacition = array(
            'message' => 'Coupon Store!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notifacition);
        //return response()->json('Pick Up Store!');
    }

    public function pickup_point_delete($id)
    {
        //Quere Builder
        Db::table('pickup_point')->where('id', $id)->delete();

        $notifacition = array(
            'message' => 'Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notifacition);
        //return response()->json('Deleted!');
    }

    public function pickuppoint_edit($id)
    {
        $pickups = DB::table('pickup_point')->where('id', $id)->first();
        return view('admin.pickup_point.pickup_edit', compact('pickups'));
    }

    public function pickup_point_update(Request $request,$id){
        $validated = $request->validate([
            'pickup_point_name' => 'required',
            'pickup_point_address' => 'required',
            'pickup_point_phone' => 'required',
            'pickup_point_phone_two' => 'required',
        ]);

        //Quere Builder
        $data = array();
        $data['pickup_point_name'] = $request->pickup_point_name;
        $data['pickup_point_address'] = $request->pickup_point_address;
        $data['pickup_point_phone'] = $request->pickup_point_phone;
        $data['pickup_point_phone_two'] = $request->pickup_point_phone_two;

        DB::table('pickup_point')->where('id', $request->id)->update($data);
        $notifacition = array(
            'message' => 'Update!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notifacition);
        //return response()->json('Update!');

    }
}
