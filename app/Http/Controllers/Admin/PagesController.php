<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Display a listing of the resource.
    public function create_index_page(){
        $pages = DB::table('pages')->get();
        return view('admin.setting.page.index', compact('pages'));
    }

    //Show the form for creating a new resource.
    public function setting_create_page(){
        return view('admin.setting.page.create');
    }

    //Store a newly created resource in storage.
    public function page_store(Request $request){

         $validated = $request->validate([
             'page_name' => 'required',
             'page_title' => 'required',
             'page_description' => 'required',
         ]);

        $data = array();
        $data['page_position'] = $request->page_position;
        $data['page_name'] = $request->page_name;
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;
        $data['page_slug'] = Str::slug($request->page_name);


        DB::table('pages')->insert($data);
        $notifacition = array(
            'message' => 'Page Insert!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }

    public function page_destroy($id){
        Db::table('pages')->where('id', $id)->delete();
        $notifacition = array(
            'message' => 'Page Deleted!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }

    public function page_edit($id){
        $pages = DB::table('pages')->where('id',$id)->first();
        return view('admin.setting.page.edit',compact('pages'));
    }

    public function page_update(Request $request, $id){

        $validated = $request->validate([
            'edit_page_name' => 'required',
            'edit_page_title' => 'required',
            'edit_page_description' => 'required',
        ]);

        $data = array();
        $data['page_position'] = $request->edit_page_position;
        $data['page_name'] = $request->edit_page_name;
        $data['page_title'] = $request->edit_page_title;
        $data['page_description'] = $request->edit_page_description;
        $data['page_slug'] = Str::slug($request->edit_page_name);
        DB::table('pages')->where('id', $request->id)->update($data);

        $notifacition = array(
            'message' => 'Page Update!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);

    }

}
