<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function website_setting(){
       $websites = DB::table('settings')->first();
        return view('admin.setting.website.website_setting', compact('websites'));
    }

    public function website_update(Request $request, $id){

         $validated = $request->validate([
            'currency' => 'required',
            'phone_one' => 'required',
            'phone_two' => 'required',
            'main_email' => 'required',
            'support_email' => 'required',
            'address' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
            'youtube' => 'required',
            //'logo' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
            //'fav_icon' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
         ]);

        $data = array();
        $data['currency'] = $request->currency;
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['main_email'] = $request->main_email;
        $data['support_email'] = $request->support_email;
        $data['address'] = $request->address;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['instagram'] = $request->instagram;
        $data['linkedin'] = $request->linkedin;
        $data['youtube'] = $request->youtube;
        
        // LOGO STORE
         if ($request->logo) {
            $logo = $request->logo;
            $logoname = uniqid() . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(320, 120)
            ->save('backend/settings-logo/' . $logoname); //With image intervention
            $data['logo'] = $logoname;
           
         }else{
            $data['logo'] = $request->old_logo;
         }

         // FAV ICON STORE
        if ($request->fav_icon) {
            $fav_icon = $request->fav_icon;
            $fav_icon_name = uniqid() . '.' . $fav_icon->getClientOriginalExtension();
            Image::make($fav_icon)->resize(32, 32)
                ->save('backend/settings-logo/' . $fav_icon_name); //With image intervention
                $data['fav_icon'] = $fav_icon_name;

            } else {
                $data['fav_icon'] = $request->old_fav_icon;
            }

            DB::table('settings')->where('id', $id)->update($data);
            $notifacition = array(
                'message' => 'setting Update!',
                'alert-type' => 'info'
            );
            return redirect()->route('warehouse.index')->with($notifacition);


    }

}
