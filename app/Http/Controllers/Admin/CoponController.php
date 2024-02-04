<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CoponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function coupon_index(Request $request){
        if ($request->ajax()) {

            $cupon_data = DB::table('copons')->latest()->get();

            return DataTables::of($cupon_data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $actionbtn = '<a href="" class="btn btn-info btn-lg editCoupon" 
                data-id="' . $row->id . '" data-toggle="modal" data-target="#editCouponModal">
                <i class="fa-solid fa-pen-to-square"></i>
                </a>

                  <a href="'.route('coupon.delete',[$row->id]).'" class="btn btn-danger btn-lg" id="delete_coupon"> 
                  <i class="fa-solid fa-trash-can"></i>
                  </a>';

                    return $actionbtn;
                })->rawColumns(['action'])->make(true);
        }
        return view('admin.offer.copon.copon_index');
    }

    public function coupon_store(Request $request)
    {
         $validated = $request->validate([
             'coupon_code' => 'required|unique:copons',
             //'coupon_date' => 'date_format:d/m/y',
             'coupon_date' => 'nullable|required|date',
             'coupon_type' => 'required',
              'coupon_amount' => 'required',
              'status' => 'required', 
         ]);

        //Quere Builder
        $data = array();
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_date'] = $request->coupon_date;
        $data['coupon_type'] = $request->coupon_type;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['status'] = $request->status;

         DB::table('copons')->insert($data);
         //$notifacition = array(
             //'message' => 'Coupon Store!',
             //'alert-type' => 'success'
         //);
        //return redirect()->back()->with($notifacition);
        return response()->json('Cupon Store!');
    }

    public function coupon_delete($id){

        //Quere Builder
        Db::table('copons')->where('id', $id)->delete();

        $notifacition = array(
            'message' => 'Coupon Deleted!',
            'alert-type' => 'success'
        );
         return redirect()->back()->with($notifacition);
         //return response()->json('Cupon Deleted!');
    }

    public function coupon_edit($id){
        $coupon = DB::table('copons')->where('id',$id)->first();
        return view('admin.offer.copon.copon_edit', compact('coupon'));
    }

    public function coupon_update(Request $request){
        // $validated = $request->validate([
        //     'coupon_code' => 'required|unique:copons',
        //     'coupon_date' => 'date_format:d/m/y',
        //     'coupon_date' => 'nullable|required|date',
        //     'coupon_type' => 'required',
        //     'coupon_amount' => 'required',
        //     'status' => 'required',
        // ]);

        //Quere Builder
        $data = array();
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_date'] = $request->coupon_date;
        $data['coupon_type'] = $request->coupon_type;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['status'] = $request->status;

        DB::table('copons')->where('id', $request->id)->update($data);
        return response()->json('Cupon Store!');

    }
}
