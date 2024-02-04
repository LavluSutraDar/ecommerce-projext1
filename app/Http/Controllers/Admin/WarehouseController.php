<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function warehouse_index(Request $request)
    {
        if ($request->ajax()) {
            $warehouse_data = DB::table('warehouses')->latest()->get();

            return DataTables::of($warehouse_data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $actionbtn = '<a href="" class="btn btn-info btn-lg warehouseedit" 
                data-id="' . $row->id . '" data-toggle="modal" data-target="#editwarehouseModal">
                <i class="fa-solid fa-pen-to-square"></i>
                </a>

                  <a href=" ' . route('warehouse.destroy', [$row->id]) . '" class="btn btn-danger btn-lg" id="delete"> 
                  <i class="fa-solid fa-trash-can"></i>
                  </a>';
                    return $actionbtn;
                })->rawColumns(['action'])->make(true);
        }
        return view('admin.categories.warehouse.warehouse_index');
    }

    public function warehouse_store(Request $request)
    {
        $validated = $request->validate([
            'warehouse_name' => 'required',
            'warehouse_address' => 'required',
            'warehouse_phone' => 'required|unique:warehouses|max:11',
        ]);

        $data = array();
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone'] = $request->warehouse_phone;

        DB::table('warehouses')->insert($data);

        $notifacition = array(
            'message' => 'Ware House Insert!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }

    public function warehouse_destroy($id)
    {
        //Quere Builder
        Db::table('warehouses')->where('id', $id)->delete();

        $notifacition = array(
            'message' => 'Ware House Deleted!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notifacition);
    }

    public function warehouse_edit($id)
    {
        $warehouse = DB::table('warehouses')->where('id', $id)->first();
        return view('admin.categories.warehouse.warehouse_edit', compact('warehouse'));
    }

    public function warehouse_update(Request $request, $id)
    {

        $validated = $request->validate([
            'warehouse_name_edit' => 'required',
            'warehouse_address_edit' => 'required',
            'warehouse_phone_edit' => 'required',
        ]);

        $data = array();
        $data['warehouse_name'] = $request->warehouse_name_edit;
        $data['warehouse_address'] = $request->warehouse_address_edit;
        $data['warehouse_phone'] = $request->warehouse_phone_edit;
        DB::table('warehouses')->where('id', $request->id)->update($data);

        $notifacition = array(
            'message' => 'Ware house Update!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }
}
