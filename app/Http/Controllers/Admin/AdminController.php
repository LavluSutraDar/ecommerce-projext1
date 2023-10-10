<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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

    public function admin_logout()
    {
        Auth::logout();

        $notifacition = array(
            'message' => 'You Are Logout',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.login')->with($notifacition);
    }

    public function password_change()
    {
        return view('admin.profile.admin_profile_password');
    }

    public function admin_password_update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:2'],
            'password' => ['required', 'string', 'min:2', 'confirmed'],
        ]);

        $old_password = Auth::user()->password; //LOGIN USER PASSWORD GET
        $current_password = $request->current_password; // REQUEST THEKE PAWA PASSWORD

        if (Hash::check($current_password,$old_password )) { 
        //CHECKING CURRENT PASSWORD OR OLD PASSWORD SAME OR NOT

            $user = User::findorfail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            
            $notifacition = array(
                'message' => 'Password Updated Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.login')->with($notifacition);
        } else {
             $notifacition = array(
                 'message' => 'Current Password does not match with Old Password!',
                 'alert-type' => 'error'
             );
             return redirect()->back()->with($notifacition);
        }
    }
}
