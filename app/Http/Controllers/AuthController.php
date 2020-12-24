<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
    	return view('auth.login');
    }

    public function postlogin(Request $Request)
    {
    	if(Auth::attempt($Request->only('email','password'))){
    		return redirect('/dashboard');
    	}
    	return redirect('/login');
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('/login'); 
    }
}
