<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function category_index(){
       $categorys =  DB::table('categories')->get();
        //Category::all();

        return view('admin.categories.category.index', compact('categorys'));
    }

    public function category_store(Request $request){
        $validated = $request->validate([
            'category_name'=> 'required|unique:categories|max:255',

        ]);

        //Quere Builder
        // $data = array();
        // $data['category_name']=$request->category_name;
        // $data['category_slug']= Str::slug($request->category_name);
        // DB::table('categories')->insert($data);

        //Elequent ORM
        Category::insert([
            'category_name'=>$request->category_name,
            'category_slug' => Str::slug($request->category_name),
        ]);

        $notifacition = array(
            'message' => 'Category Inserted!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
        
    }

    public function category_delete($id){
         //Quere Builder
        //Db::table('categories')->where('id', $id)->delete();

        //Elequent ORM // Model r maddome delete
        $cat = Category::find($id);
        $cat->delete();

        $notifacition = array(
            'message' => 'Category Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notifacition);
    }

    //CATEGORY EDIT FUNCTION
    public function category_edit($id){
        //Model r maddome edit
        $data = Category::find($id);
        //Quere r maddome edit
        //$data = DB::table('categories')->where('id', $id)->first();

        return response()->json($data);
        //return view('admin.categories.category.edit', compact('data'));
    }

    //CATEGORY UPDATE FUNCTION
    public function category_update(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        //Quere Builder
        $data = array();
        $data['category_name']=$request->category_name;
        $data['category_slug']= Str::slug($request->category_name);
        DB::table('categories')->where('id', $request->id)->update($data);

        //Elequent ORM
        // $categoryup = Category::where('id', $request->id)->first();

        // $categoryup->update([
        //     'category_name' => $request->category_name,
        //     'category_slug' => Str::slug($request->category_name),
        // ]);

        $notifacition = array(
            'message' => 'Category Update!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notifacition);

    }

    //Get child Category
    public function getChildCategory($id){
        $data = DB::table('childcategories')->where('subcategory_id', $id)->get();
        return response()->json($data);

    }
}
