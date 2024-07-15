<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\ProfilAdmin;
use App\Models\TipePekerjaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    //
    public function index() {

        $judul = "SILOKER | Admin Kategori Pekerjaan Page";
        $namaHalaman = "Semua Data Kategori Pekerjaan";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        return view('dashboard.kategori.index', compact('judul', 'namaHalaman', 'profil'));

    }

    public function getDataTipePekerjaan() {
        $data = Kategori::query()->latest();
        return DataTables::of($data)->addIndexColumn()->addColumn('action', 'dashboard.kategori.action')->rawColumns(['action'])->make(true);
    }

    public function create() {
        $judul = "SILOKER | Admin Tambah Data Kategori Pekerjaan Page";
        $namaHalaman = "Tambah Data Kategori Pekerjaan";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        return view('dashboard.kategori.create', compact('judul', 'namaHalaman', 'profil'));
    }

    public function store(Request $request) {
        
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori',
        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->slug = Str::slug($request->input("nama_kategori"));

        $kategori->save();

        return redirect()->route('kategori.index')->with('success', 'Data Kategori Pekerjaan Berhasil Ditambahkan...');
    }

    public function edit($slug) {
        $judul = "SILOKER | Admin Kategori Pekerjaan Page";
        $namaHalaman = "Semua Data Kategori Pekerjaan";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        $tipePekerjaan = Kategori::where('slug', $slug)->first();

        return view('dashboard.kategori.edit', compact('judul', 'namaHalaman', 'tipePekerjaan', 'profil'));
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        

        $kategori->save();

        return redirect()->route('kategori.index')->with('success', 'Data Kategori Pekerjaan Berhasil Diupdate...');
    }

    public function delete($id) {
        $kategori = Kategori::find($id);

        $kategori->delete(); 

        return response()->json([
            'message' => "Data Kategori Pekerjaan Berhasil Dihapus..."
        ]);
    }
}
