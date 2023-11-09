<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //SEO PAGE SHOW METHOD
    public function setting_seo_index(){
        $data = DB::table('seos')->first();
        return view('admin.setting.seo', compact('data'));
    }

    public function setting_seo_update(Request $request, $id){
        $data = array();
        $data['meta_title']= $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_description'] = $request->meta_description;
        $data['meta_keyword'] = $request->meta_keyword;
        $data['google_verification'] = $request->google_verification;
        $data['google_analytics'] = $request->google_analytics;
        $data['alexa_verification'] = $request->alexa_verification;
        $data['google_adsense'] = $request->google_adsense;
        DB::table('seos')->where('id', $id)->update($data);

        $notifacition = array(
            'message' => 'SEOS Update!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }

    //SMTP SETTING PAGE
    public function setting_smtp(Request $request){
        $smtp = DB::table('smtp')->first();
        return view('admin.setting.smtp',compact('smtp'));
    }


    public function setting_smtp_update(Request $request, $id)
    {
        $data = array();
        $data['mailer'] = $request->mailer;
        $data['host'] = $request->host;
        $data['port'] = $request->port;
        $data['user_name'] = $request->user_name;
        $data['password'] = $request->password;
        
        DB::table('smtp')->where('id', $id)->update($data);

        $notifacition = array(
            'message' => 'SMTP Update!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notifacition);
    }

}
