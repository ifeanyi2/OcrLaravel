<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    public function store(){
        auth()->logout();

        Cookie::forget('data');
        
        return redirect()->route('login');
    }
}
