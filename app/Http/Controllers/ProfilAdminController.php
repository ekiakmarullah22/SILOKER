<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\PemberiKerja;
use Illuminate\Http\Request;
use App\Models\ProfilAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfilAdminController extends Controller
{
    //

    public function create() {
        // dd($id);
        $judul = "SILOKER";
        $namaHalaman = "Buat Profil";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        return view('dashboard.profil.create', compact('judul', 'namaHalaman', 'profil'));
    }

    public function store(Request $request) {

        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'link' => 'required',
            'deskripsi' => 'required',
        ]);

        $id = Auth::guard('web')->user()->id;
        $profile = PemberiKerja::findOrFail($id);

        $lokasiGambar = "profil/";
        if($request->has('gambar')) {
            $namaFileGambar = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path($lokasiGambar), $namaFileGambar);
            $profile->profile()->updateOrCreate(
                [
                    'id' => $profile->id
                ],
                [
                    'nama' => $request->nama,
                    'slug' => Str::slug($request->input("nama")),
                    'no_hp' => $request->no_hp,
                    'link' => $request->link,
                    'deskripsi' => $request->deskripsi,
                    'gambar' => $namaFileGambar
                ],
            );
        }

        $profile->profile()->updateOrCreate(
            [
                'id' => $profile->id
            ],
            [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'link' => $request->link,
                'deskripsi' => $request->deskripsi,
            ]
        );


        return redirect()->back()->with('success', 'Data Profil Berhasil Diupdate...');

        // dd($admin);
    }
}
