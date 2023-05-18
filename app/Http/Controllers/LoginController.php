<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function username(){
        return 'UserId';
    }

    public function login(Request $request)
    {
 
        if (Auth::attempt(['UserId'=>$request->UserId,'password'=>$request->Password])) {
            
            return redirect()->intended('home');
        }
        return redirect()->route('login.index');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return redirect()->route('login');
    }

   
}
