<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
//use Yajra\DataTables\Contracts\DataTable;
//use DataTables;

class ChildCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //YEJRA TABLE R MADDOME DATA SHOW
    public function childcategory_index(Request $request)
    {
        if ($request->ajax()) {
            $child_data = DB::table('childcategories')
                ->leftjoin('categories', 'childcategories.category_id', 'categories.id')
                ->leftjoin('subcategories', 'childcategories.subcategory_id', 'subcategories.id')
                ->select('childcategories.*', 'categories.category_name', 'subcategories.subcategory_name')->get();

               return DataTables::of($child_data)
               ->addIndexColumn()
               ->addColumn('action', function($row){

                $actionbtn = '<a href="" class="btn btn-info btn-lg childedit" 
                data-id="'.$row->id.'" data-toggle="modal" data-target="#editchildcategoryModal">
                <i class="fa-solid fa-pen-to-square"></i>
                </a>

                  <a href=" '.route('childcategory.destroy',[$row->id]). '" class="btn btn-danger btn-lg" id="delete"> 
                  <i class="fa-solid fa-trash-can"></i>
                  </a>';

                  return $actionbtn;
               })->rawColumns(['action'])->make(true);
        }
        $category = DB::table('categories')->get();
        return view('admin.categories.childcategory.index', compact('category'));
        
    }


    //CHILD CATEGORY STORE
    public function childcategory_store(Request $request){

        $validated = $request->validate([
            'childcategory_name' => 'required|unique:childcategories|max:100',
        ]);

        $cat = DB::table('subcategories')->where('id', $request->subcategory_id)->first();
        $data = array();
        $data['category_id']= $cat->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_name'] = $request->childcategory_name;
        $data['childcategory_slug'] = $request->childcategory_name;
        DB::table('childcategories')->insert($data);

        $notifacition = array(
            'message' => 'Child Category Inserted!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }

    //childcategory destroy
    public function childcategory_destroy($id){

        //Quere Builder
        Db::table('childcategories')->where('id', $id)->delete();

        //Elequent ORM // Model r maddome delete
        //$cat = ChildCategoryController::find($id);
        //$cat->delete();

        $notifacition = array(
            'message' => 'Child Category Deleted!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notifacition);
    }

    //childcategory edit
    public function childcategory_edit($id){
        $category = DB::table('categories')->get();
        $childcate = DB::table('childcategories')->where('id',$id)->first();

        return view('admin.categories.childcategory.edit', compact('category', 'childcate'));
    }

    //childcategory update
    public function childcategory_update(Request $request){
        $cat = DB::table('subcategories')->where('id', $request->subcategory_id)->first();
        $data = array();
        $data['category_id'] = $cat->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_name'] = $request->childcategory_name;
        $data['childcategory_slug'] = $request->childcategory_name;
        DB::table('childcategories')->where('id', $request->id)->update($data);

        $notifacition = array(
            'message' => 'Child Category Update!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }
}
