<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilAdmin;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
{
    //
    public function index() {

        $judul = "SILOKER | Admin Lokasi Page";
        $namaHalaman = "Semua Data Lokasi";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        return view('dashboard.lokasi.index', compact('judul', 'namaHalaman', 'profil'));

    }

    public function getDataLokasi() {
        $data = Lokasi::query()->latest();
        return DataTables::of($data)->addIndexColumn()->addColumn('action', 'dashboard.lokasi.action')->rawColumns(['action'])->make(true);
    }

    public function create() {
        $judul = "SILOKER | Admin Tambah Data Lokasi Page";
        $namaHalaman = "Tambah Data Lokasi";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        return view('dashboard.lokasi.create', compact('judul', 'namaHalaman', 'profil'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kampung' => 'required|unique:lokasi,nama_kampung',
            'nama_kecamatan' => 'required'
        ]);

        $lokasi = new Lokasi();
        $lokasi->nama_kampung = $request->nama_kampung;
        $lokasi->nama_kecamatan = $request->nama_kecamatan;
        $lokasi->slug = Str::slug($request->input("nama_kampung"));

        $lokasi->save();

        return redirect()->route('lokasi.index')->with('success', 'Data Lokasi Berhasil Ditambahkan...');
    }

    public function edit($slug) {
        $judul = "SILOKER | Admin Lokasi Page";
        $namaHalaman = "Semua Data Lokasi";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        $lokasi = Lokasi::where('slug', $slug)->first();

        return view('dashboard.lokasi.edit', compact('judul', 'namaHalaman', 'lokasi', 'profil'));
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'nama_kampung' => 'required',
            'nama_kecamatan' => 'required',
        ]);

        $lokasi = Lokasi::find($id);
        $lokasi->nama_kampung = $request->nama_kampung;
        $lokasi->nama_kecamatan = $request->nama_kecamatan;

        $lokasi->save();

        return redirect()->route('lokasi.index')->with('success', 'Data Lokasi Berhasil Diupdate...');
    }

    public function delete($id) {
        $lokasi = Lokasi::find($id);

        if($lokasi->pekerjaan()->exists()) {  
            foreach($lokasi->pekerjaan()->get() as $item) {
                $lokasi->delete();
            }
        } 

        $lokasi->delete();

        return response()->json([
            'message' => "Data Lokasi Berhasil Dihapus..."
        ]);
    }


}
