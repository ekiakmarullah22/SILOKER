<?php

namespace App\Http\Controllers;

use App\Models\PemberiKerja;
use Illuminate\Auth\Events\Registered;
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


        //setelah mengisi form dan melewati validasi form
        // maka user akan diminta untuk verifikasi alamat email terlebih dahulu

       $user = PemberiKerja::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => false,
        ]);

        event(new Registered($user));

        auth()->login($user);

        return redirect()->route('verification.notice')->with('session', 'Akun berhasil dibuat, silahkan verifikasi alamat email anda terlebih dahulu');

        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('login')->with('session', 'Your Account Is Not Activated Yet, Please Contact Administrator to Activate it...');
        }
    }
}
