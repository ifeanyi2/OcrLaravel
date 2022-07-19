<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Schools;
use Illuminate\Http\Request;

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
}
