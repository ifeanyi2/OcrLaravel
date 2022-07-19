<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index(){
        return view('auth.login');
    }

    public function store(Request $request)
    {
        //dd($request->remember);
        $this->validate($request, [
            'login' => 'required|min:2',
            'password' => 'required'
        ]);

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $request->merge([
            $login_type => $request->login
        ]);


        if (!auth()->attempt($request->only($login_type, 'password'), $request->remember)) {
            return back()->with('status', 'Invalid Credentials!!');
        }
        $notification = [
            'message' => 'Login Successful!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notification);

    }
}
