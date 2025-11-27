<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function login(){
        return view('Auth.login');
    }

    public function login_proses(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ]);

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($infoLogin)){
            return redirect('/dashboard');
        }else{
            return back()->withErrors([
                'email', 'Email atau Password salah',
                'password', 'Email atau Password salah'
            ]);
        }
    }


}
