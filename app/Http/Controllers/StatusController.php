<?php

namespace App\Http\Controllers;

use App\Models\PemberiKerja;
use Illuminate\Http\Request;
use App\Models\ProfilAdmin;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    //
    public function index() {
        $users = PemberiKerja::latest()->paginate(5);
        $judul = "SILOKER";
        $namaHalaman = "Dashboard Pemberi Kerja";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        return view('dashboard.admin.status', compact('users', 'judul', 'namaHalaman', 'profil'));
    }

    public function activateStatus(Request $request, $id) {
        $data = PemberiKerja::find($id);

        if($data->status == 0) {
            $data->status = 1;
        }else {
            $data->status = 0;
        }

        $data->save();

        return redirect()->route('dashboard.admin.status')->with('success', $data->email.' Status has been changed successfully...');
    }
}
