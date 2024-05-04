<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;



class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function product_index(Request $request)
    {
        if ($request->ajax()) {
          
           //Model r maddome join
           //$data=Product::latest()->get();

           //Query r maddome join
           $product = "";
            $data = DB::table('products')
            ->leftjoin('categories', 'products.category_id', 'categories.id')
            ->leftjoin('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->leftjoin('brands', 'products.brand_id', 'brands.id');

            //FILTARING
            if($request->category_id){
                $data->where('products.category_id',$request->category_id);
            }
            if ($request->brand_id) {
                $data->where('products.brand_id', $request->brand_id);
            }
            if ($request->warehouse) {
                $data->where('warehouse', $request->warehouse);
            }
            if ($request->date) {
                $data->where('products.date', $request->date);
            }
            if ($request->product_status==1) {
                $data->where('products.product_status',1);
            }
            if ($request->product_status == 0) {
                $data->where('products.product_status',0);
            }


            $product = $data->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')->get();
            

            return DataTables::of($product)  
                ->addIndexColumn()

                //Model r maddome join
                // ->editColumn('category_name', function($data){
                //     return $data->category_name;
                // })

                ->editColumn('product_featured', function ($row) {
                    if($row->product_featured == 1){
                    return '<a href="#" data-id="' . $row->id . '" class="deactive_featurd"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                    }else{
                    return '<a href="#" data-id="' . $row->id . '" class="active_featurd"> <i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span> </a>';
                    }
                })

                ->editColumn('today_deal', function ($row) {
                    if ($row->today_deal == 1) {
                        return '<a href="#" data-id="' . $row->id . '" class="deactive_deal"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                    } else {
                        return '<a href="#" data-id="' . $row->id . '" class="active_deal"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span> </a>';
                    }
                })

                ->editColumn('product_status', function ($row) {
                    if ($row->product_status == 1) {
                        return '<a href="#" data-id="' . $row->id . '" class="deactive_status"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                    } else {
                        return '<a href="#" data-id="' . $row->id . '" class="active_status"><i class="fas fa-thumbs-up text-danger"></i> <span class="badge badge-danger">deactive</span> </a>';
                    }
                })
                
                ->addColumn('action', function ($row) {
                $actionbtn = ' 
                 <a href="" class="btn btn-info btn-lg"><i class="fa-solid fa-pen-to-square"></i></a>
                 <a href="" class="btn btn-primary btn-lg"><i class="fas fa-eye"></i></a>

                  <a href=" ' . route('product.destroy', [$row->id]) . '" class="btn btn-danger btn-lg" id="delete"> <i class="fa-solid fa-trash-can"></i></a> 
                  ';
                    return $actionbtn;
                })->rawColumns(['action', 'product_featured', 'today_deal', 'product_status'])->make(true);
        }

        //FILTARING
        $category = Category::all();
        $brand = Brand::all();
        $warehouse = DB::table('warehouses')->get();
        $product = Product::all();
        
        return view('admin.product.product_index', compact('category','brand','warehouse', 'product'));
    }

    //PRODUCT CREATE PAGE
    public function product_create(){
        //modal get
        //categories::all();

        //Quare get
        $categories = DB::table('categories')->get();
        $childcategorys = DB::table('childcategories')->get();
        $brands = DB::table('brands')->get();
        $pickupPoints = DB::table('pickup_point')->get();
        $warehouses = DB::table('warehouses')->get();
        
        return view('admin.product.product_create', compact('categories', 'brands', 'pickupPoints', 'warehouses', 'childcategorys'));
    }

    //PRODUCT STORE PAGE
    public function product_store(Request $request){
        $validated = $request->validate([
            //'product_name' => 'required',
            //'product_code' => 'required|unique:products|max:55',
            //'subcategory_id' => 'required',
            //'brand_id' => 'required',

            //'product_unit' => 'required',
            //'product_tags' => 'required',
            //'product_video' => 'required',
            //'purchase_price' => 'required',
            //'selling_price' => 'required',
            //'product_description' => 'required',
            //'product_status' => 'required',
            //'color' => 'required',
            //'size' => 'required',
            //'product_thumbnail' => 'required',
            //'product_images' => 'required',
          
        ]);

        //subcategory call for category id
        $subcategory = DB::table('subcategories')->where('id',$request->subcategory_id)->first();
       
        $slug = str::slug($request->product_name, "-"); 
        $data = array();
        $data['category_id'] = $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['pickup_point_id'] = $request->pickup_point_id;
        $data['product_name'] = $request->product_name;
        $data['slug'] = Str::slug($request->product_name);
        $data['product_code'] = $request->product_code;
        $data['product_unit'] = $request->product_unit;
        $data['product_tags'] = $request->product_tags;
        $data['product_video'] = $request->product_video;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['warehouse'] = $request->warehouse;
        $data['product_description'] = $request->product_description;
        $data['product_featured'] = $request->product_featured;
        $data['today_deal'] = $request->today_deal;
        $data['product_status'] = $request->product_status;
        //$data['cash_on_delivery'] = $request->cash_on_delivery;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $data['admin_id'] = auth::id();
        $data['flash_deal_id'] = $request->flash_deal_id;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');

        // $thumbnail = $request->product_thumbnail;
        // $thumbnailname = $slug . '.' . $thumbnail->getClientOriginalExtension();
        // Image::make($thumbnail)->resize(600, 600)
        // ->save('backend/product-thumbnail/' . $thumbnailname);
        // $data['product_thumbnail'] = $thumbnailname;
        // dd($data);

        // SINGLE IMAGE STORE
        if($request->product_thumbnail){
            $thumbnail = $request->product_thumbnail;
            $thumbnailname = $slug . '.' . $thumbnail->getClientOriginalExtension();
            //With image intervention
            Image::make($thumbnail)->resize(600, 600)
            ->save('backend/product-thumbnail/' . $thumbnailname); 
            $data['product_thumbnail'] = $thumbnailname;
        }

        //MULTIFALE IMAGE STORE
        $product_images = array();
        if ($request->hasFile('product_images')) { 
            foreach ($request->file('product_images') as $key => $image) {
                $ProductimageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(600, 600)->save('backend/product-image/' . $ProductimageName);
                array_push($product_images, $ProductimageName);
            }
            $data['product_images'] = json_encode($product_images);
        }

        DB::table('products')->insert($data);
        $notifacition = array(
            'message' => 'Products Inserted!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }

    //NOT FEATURED
    public function deactive_featured($id){
        DB::table('products')->where('id',$id)->update(['product_featured'=>0]);
        return response()->json('Product Featured De Active');
    }

    //ACTIVE FEATURED
    public function active_featured($id)
    {
        DB::table('products')->where('id', $id)->update(['product_featured' => 1]);
        return response()->json('Product Featured Active');
    }

    //NOT TO DAY DEAL
    public function deactive_todaydeal($id)
    {
        DB::table('products')->where('id', $id)->update(['today_deal' => 0]);
        return response()->json('To Day Deal De Active');
    }

    //ACTIVE TO DAY DEAL
    public function active_todaydeal($id)
    {
        DB::table('products')->where('id', $id)->update(['today_deal' => 1]);
        return response()->json('To Day Deal Active');
    }

    //NOT STATUS
    public function deactive_status($id)
    {
        DB::table('products')->where('id', $id)->update(['product_status' => 0]);
        return response()->json('Product De Active');
    }

    //ACTIVE STATUS
    public function active_status($id)
    {
        DB::table('products')->where('id', $id)->update(['product_status' => 1]);
        return response()->json('Product Active');
    }

    //PRODUCT DELETE
    public function product_destroy($id){
        $product = Product::find($id);

        if ($product->product_thumbnail) {
            File::delete(public_path('backend/product-thumbnail/' . $product->product_thumbnail));
        }
        $product->delete();

        $notifacition = array(
            'message' => 'product Deleted !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notifacition);

    }

}
