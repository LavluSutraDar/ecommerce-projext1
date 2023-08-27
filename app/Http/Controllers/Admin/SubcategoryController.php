<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;


class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //INDEX METHOD FOR READ DATA
    public function subcategory_index()
    {
        //Quere dia join
        $subcategories = DB::table('subcategories')->leftjoin('categories', 'subcategories.category_id', 'categories.id')->select('subcategories.*', 'categories.category_name')->get();

        //CATEGORY
        $categories = DB::table('categories')->get();
        return view('admin.categories.subcategories.index', compact('subcategories', 'categories'));
    }

    //SUBCATEGORY STORE
    public function subcategory_store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required|unique:subcategories|max:100',
        ]);

        //Quere Builder
        // $data = array();
        // $data['category_id']=$request->category_id;
        // $data['subcategory_name']=$request->subcategory_name;
        // $data['subcategory_slug']= Str::slug($request->subcategory_name);
        // DB::table('subcategories')->insert($data);

        //Elequent ORM
        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name),
        ]);

        $notifacition = array(
            'message' => 'Sub Category Inserted!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }

    //SUBCATEGORY DISTROY
    public function subcategory_destroy($id)
    {
        //Quere Builder
        //Db::table('categories')->where('id', $id)->delete();

        //Elequent ORM // Model r maddome delete
        $cat = Subcategory::find($id);
        $cat->delete();

        $notifacition = array(
            'message' => 'Category Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notifacition);
    }

    //EDIT CATEGORY FUNCTION
    public function subcategory_edit($id){
        //Model r maddome edit
        $subcategory = Subcategory::find($id);
        $categories = Category::all();

        //Quere r maddome edit
        //$data = DB::table('categories')->where('id', $id)->first();
        //$data = DB::table('categories')->get();

        //return response()->json($data);

        return view('admin.categories.subcategories.edit', compact('subcategory', 'categories'));

    }

    public function subcategory_update(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required|unique:subcategories|max:100',
        ]);

        //Quere Builder
          //$data = array();
          //$data['category_id'] = $request->category_id;
        //   $data['subcategory_name'] = $request->subcategory_name;
        //   $data['subcategory_slug'] = Str::slug($request->subcategory_name);
        //   DB::table('subcategories')->where('id', $request->id)->update($data);

        //Elequent ORM
          $subcategory_up = Subcategory::where('id', $request->id)->first();

         $subcategory_up->update([
            'category_id'=>$request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name),
         ]);

         $notifacition = array(
             'message' => 'Sub Category Update!',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notifacition);


    }
}
