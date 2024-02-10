<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //PRODUCT CREATE PAGE
    public function product_create(){
        //modal get
        //categories::all();

        //Quare get
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $pickup_point = DB::table('pickup_point')->get();

        return view('admin.product.product_create', compact('categories', 'brands', 'pickup_point'));
    }

    //PRODUCT STORE PAGE
    public function product_store(Request $request){
        dd($request->all());

    }
}
