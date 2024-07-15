<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemberiKerja;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\ProfilAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemberiKerjaController extends Controller
{
    //
    public function index() {
        $judul = "SILOKER | Admin Tambah Pemberi Kerja Page";
        $namaHalaman = "Semua Data Pemberi Kerja";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        return view('dashboard.pemberi_kerja.index', compact('judul', 'namaHalaman', 'profil'));
    }

    public function getDataPemberiKerja() {
        $data = PemberiKerja::query()->latest();
        return DataTables::of($data)->addIndexColumn()->addColumn('action', 'dashboard.pemberi_kerja.action')->rawColumns(['action'])->make(true);
    }

    public function create() {
        $judul = "SILOKER | Admin Tambah Pemberi Kerja Page";
        $namaHalaman = "Tambah Data Pemberi Kerja";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        return view('dashboard.pemberi_kerja.create', compact('judul', 'namaHalaman', 'profil'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => "required",
            'no_hp' => "max:13",
            'deskripsi' => "required|min:10",
            'email' => "min:10|max:25",
            "gambar" => "required|image|mimes:jpeg,jpg,png",
        ]);

        // Ambil nama gambar dan pindahkan gambar dalam folder public/pekerjaan
        $namaFileGambar = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('pemberi_kerja'), $namaFileGambar);

        $pemberi_kerja = new PemberiKerja();
        $pemberi_kerja->nama = $request->input("nama");
        $pemberi_kerja->no_hp = $request->input("no_hp");
        $pemberi_kerja->link = $request->input("link");
        $pemberi_kerja->deskripsi = $request->input("deskripsi");
        $pemberi_kerja->email = $request->input("email");
        $pemberi_kerja->gambar = $namaFileGambar;
        $pemberi_kerja->slug = Str::slug($request->input("nama"));

        $pemberi_kerja->save();

        // notify()->success('Data Pemberi Kerja Berhasil ditambahkan ke dalam sistem...');

        return redirect()->route('pemberi_kerja')->with('success', 'Data Pemberi Kerja Berhasil Ditambahkan...');
    }

    public function edit($slug) {
        $judul = "SILOKER | Admin Edit Pemberi Kerja Page";
        $namaHalaman = "Semua Data Pemberi Kerja";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        $pemberi_kerja = PemberiKerja::where('slug', $slug)->first();

        return view('dashboard.pemberi_kerja.edit', compact('judul', 'namaHalaman', 'pemberi_kerja', 'profil'));
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'nama' => "required",
            'no_hp' => "max:13",
            'deskripsi' => "required|min:10",
            'email' => "min:10|max:25",
            "gambar" => "image|mimes:jpeg,jpg,png",
        ]);

        $pemberi_kerja = PemberiKerja::find($id);

        // cek apakah gambar baru diupload
        if($request->has('gambar')) {
            $lokasiGambar = "pemberi_kerja/";
            File::delete($lokasiGambar. $pemberi_kerja->gambar);

            $namaFileGambar = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('pemberi_kerja'), $namaFileGambar);

            $pemberi_kerja->gambar = $namaFileGambar;
        }

        // update data tanpa rubah gambar
        $pemberi_kerja->nama = $request->input("nama");
        $pemberi_kerja->no_hp = $request->input("no_hp");
        $pemberi_kerja->link = $request->input("link");
        $pemberi_kerja->deskripsi = $request->input("deskripsi");
        $pemberi_kerja->email = $request->input("email");
        $pemberi_kerja->slug = Str::slug($request->input("nama"));

        $pemberi_kerja->save();

        // notify()->success('Data Pemberi Kerja Berhasil diupdate...');

        return redirect()->route('pemberi_kerja')->with('success', 'Data Pemberi Kerja Berhasil Diupdate...');
    }

    public function delete(string $id) {
        $pemberi_kerja = PemberiKerja::find($id);

        // $pemberi_kerja->delete();
        if($pemberi_kerja->loker()->exists()) {  
            foreach($pemberi_kerja->loker()->get() as $item) {
                $item->delete();
                $pemberi_kerja->delete();
                $lokasiGambar = "pemberi_kerja/";
                File::delete($lokasiGambar. $pemberi_kerja->gambar);
            }
        } 

        $lokasiGambar = "pemberi_kerja/";
        File::delete($lokasiGambar. $pemberi_kerja->gambar);

        $pemberi_kerja->delete();

        



        // notify()->success('Data Pemberi Kerja Berhasil dihapus...');

        // return redirect()->route('pemberi_kerja');
        return response()->json([
            'message' => "Data Pemberi Kerja Berhasil dihapus"
        ]);



    }
}
