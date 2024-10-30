<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getLogin(){
        return view('dashboard.auth.login');
    }
    public function login($request, Closure $next, $guard = null){
        if (auth()->guard()) {
            # code...
        }
        return view('dashboard.auth.login');
    }
}
