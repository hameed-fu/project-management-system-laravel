<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }
    public function validateLogin(Request $request){
        
        $validator = $request->validate([
            'email'     => 'required',
            'password'  => 'required|min:8'
        ]);
         if (auth()->attempt($validator)) {
             return redirect()->route('admin.dashboard')->with('success', 'You are logged in successfully');
            
        }else{
            return redirect()->back()->with("error","Invalid email or password");
        }
    }

}
