<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\PemberiKerja;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    //
    use AuthenticatesUsers;
    public function login()
    {
        return view('auth.login');
    }



    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        
        
        


        if (Auth::attempt($credentials)) {
            
                $request->session()->regenerate();

                $id = Auth::guard('web')->user()->id;
                $user = PemberiKerja::find($id);

                if($user->status !=1) {
                    return redirect()->back()->with('session', 'Akun anda belum diaktivasi...');
                }else {
                    return redirect()->intended('dashboard');
                }

                
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    
}
