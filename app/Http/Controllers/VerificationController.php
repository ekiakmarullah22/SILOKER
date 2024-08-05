<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    //
    public function notice() {
        return view('dashboard.verification.notice');
    }

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('login')->with('session', 'Email Anda Berhasil diverifikasi, Silahkan tunggu admin untuk mengaktikan akun anda...');
    }
}
