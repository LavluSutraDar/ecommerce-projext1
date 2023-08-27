<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        return view('admin.home');
    }

    public function admin_logout(){
        Auth::logout();

        $notifacition = array(
            'message'=>'You Are Logout',
             'alert-type'=> 'success'
            );

        return redirect()->route('admin.login')->with($notifacition);
    }
}
