<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Schools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {

       $this->middleware(['auth']);
    }


    public function dashboard(){
        // get current logged in school
        $get_school = Schools::find(auth()->user()->school_id);
        // dd($get_school);
        return view('admin.dashboard', compact('get_school'));
    }


    //site settings view
    public function settings(){
        return view('admin.settings');
    }

    //update the user password
    public function changePassword(Request $request){
        // check if current password match database password
        if(!Hash::check($request->current_password, auth()->user()->password)){
            // the passwords matches
            return redirect()->back()->with('error', 'Your current password does not matches with the password');
        }

        // check if current password and new password same
        // if(strcmp($request->current_password)){}
    }
}
