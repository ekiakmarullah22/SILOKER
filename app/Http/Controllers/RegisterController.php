<?php

namespace App\Http\Controllers;

use App\Models\PemberiKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required','email', 'unique:pemberi_kerja,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

       $user = PemberiKerja::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => false,
        ]);

        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('login')->with('session', 'Your Account Is Not Activated Yet, Please Contact Administrator to Activate it...');
        }
    }
}
