<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Stmt\Echo_;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function brand_index(Request $request){
         if ($request->ajax()) {
             $data = DB::table('brands')->get();
             return DataTables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function ($row) {

                 $actionbtn = '<a href="" class="btn btn-info btn-lg brandedit" 
                 data-id="' . $row->id . '" data-toggle="modal" data-target="#editbrandModal">
                 <i class="fa-solid fa-pen-to-square"></i>
                 </a>

                <a href=" ' . route('brand.destroy', [$row->id]) . '" class="delete btn btn-danger btn-lg" id="delete"> 
                <i class="fa-solid fa-trash-can"></i>
                </a>';

                    return $actionbtn;
                 })->rawColumns(['action'])->make(true);
         }
        return view('admin.categories.brand.index');
    }

    //BRAND STORE
    public function brand_store(Request $request){

         $validated = $request->validate([
             'brand_name' => 'required|string| unique:brands|max:100',
              'brand_logo' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
         ]);

        $slug = str::slug($request->brand_name, "-");
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = str::slug($request->brand_name, "-");

        $photo = $request->brand_logo;
        $photoname = $slug .'.'. $photo->getClientOriginalExtension();
        //$photo->move('public/file/brand', $photoname); //Without image intervention
        Image::make($photo)->resize(240, 120)
        ->save('backend/brand-logo/'.$photoname); //With image intervention
        $data['brand_logo'] = $photoname;
        DB::table('brands')->insert($data);

         $notifacition = array(
            'message' => 'Brand Inserted!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }

    //BRAND DISTROY
    public function brand_destroy($id){
        $brand = Brand::find($id);
        if ($brand->brand_logo) {
            File::delete(public_path('backend/brand-logo/' . $brand->brand_logo));
        }
        $brand->delete();

        $notifacition = array(
            'message' => 'Brand Deleted !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notifacition);
    }

    public function brand_edit($id)
    {
        $data = DB::table('brands')->where('id',$id)->first();

        //$data = Brand::find($id);
        return view('admin.categories.brand.edit', compact('data'));
    }

    public function brand_update(Request $request){
        $validated = $request->validate([
            'brand_name' => 'string',
            'brand_logo' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $slug = str::slug($request->brand_name, "-");
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = str::slug($request->brand_name, "-");
        if($request->brand_logo){
            if ($request->old_logo) {
                File::delete(public_path('backend/brand-logo/' . $request->old_logo));
            }
            $photo = $request->brand_logo;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(240, 120)->save('backend/brand-logo/' . $photoname);
            $data['brand_logo'] = $photoname;
            DB::table('brands')->where('id',$request->id)->update($data);
            $notifacition = array(
                'message' => 'Brand Update!',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notifacition);
        }else{
            $data['brand_logo'] = $request->old_logo;
            DB::table('brands')->where('id', $request->id)->update($data);
            $notifacition = array(
                'message' => 'Brand Update!',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notifacition);

            
        }


        

    }
}
