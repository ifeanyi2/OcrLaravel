<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
       $this->middleware(['guest']);
    }


    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        $default_role = 0;
        //validate
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:8|max:10'
        ]);

        //store
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $default_role
        ]);

        $user->notify(new WelcomeEmailNotification());


        //authenticate user
        auth()->attempt($request->only('email', 'name', 'password'));

        //redirect
        $notification = [
            'message' => 'Registration Successfull!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notification);

    }
}
