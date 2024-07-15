<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;
use App\Models\PemberiKerja;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;
use Yajra\DataTables\Html\Column;
use App\Models\ProfilAdmin;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Auth;

class LowonganPekerjaanController extends Controller
{
    //

    public function index() {

        $judul = "SILOKER";
        $namaHalaman = "Semua Data Lowongan Pekerjaan";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        return view('dashboard.lowongan_pekerjaan.index', compact('judul', 'namaHalaman', 'profil'));

    }

    public function getDataLowonganPekerjaan() {
        // milih loker berdasarkan id pemberi kerja yang sedang login
        $id = Auth::guard('web')->user()->id;
        $data = DB::table('lowongan_pekerjaan')->join('pemberi_kerja', 'lowongan_pekerjaan.pemberi_kerja_id', '=', 'pemberi_kerja.id')->where('pemberi_kerja_id', '=', $id)->select("lowongan_pekerjaan.*","lowongan_pekerjaan.nama as nama_lowongan_pekerjaan", "pemberi_kerja.nama as nama_pemberi_kerja")->get();

        // dd($data);

        return DataTables::of($data)->addIndexColumn()->addColumn('action', 'dashboard.lowongan_pekerjaan.action')->rawColumns(['action'])->make(true);
    }

    public function create() {
        $judul = "SILOKER";
        $namaHalaman = "Tambah Data Lowongan Pekerjaan";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        $dataPemberiKerja = PemberiKerja::latest()->get();
        $dataLokasi = Lokasi::latest()->get();
        $dataTipePekerjaan = Kategori::latest()->get();

        return view('dashboard.lowongan_pekerjaan.create', compact('judul', 'namaHalaman', 'dataPemberiKerja', 'dataLokasi', 'dataTipePekerjaan', 'profil'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'lokasi_id' => 'required',
            'kategori_id' => 'required',
            'batas_lamaran' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,jpg,png',
            'besaran_gaji' => 'required'
        ]);

        $namaFileGambar = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('lowongan_pekerjaan'), $namaFileGambar);

        $lowongan_pekerjaan = new LowonganPekerjaan();

        $lowongan_pekerjaan->nama = $request->nama;
        $lowongan_pekerjaan->slug = Str::slug($request->input("nama"));
        $lowongan_pekerjaan->pemberi_kerja_id = Auth::guard('web')->user()->id;
        $lowongan_pekerjaan->lokasi_id = $request->lokasi_id;
        $lowongan_pekerjaan->kategori_id = $request->kategori_id;
        $lowongan_pekerjaan->batas_lamaran = $request->batas_lamaran;
        $lowongan_pekerjaan->deskripsi = $request->deskripsi;
        $lowongan_pekerjaan->gambar = $namaFileGambar;
        $lowongan_pekerjaan->besaran_gaji = $request->besaran_gaji;

        $lowongan_pekerjaan->save();

        return redirect()->route('lowongan_pekerjaan')->with('success', 'Data Lowongan Pekerjaan Berhasil Ditambahkan...');
    }

    public function edit($slug) {
        $judul = "SILOKER | Admin Edit Lowongan Pekerjaan Page";
        $namaHalaman = "Semua Data Lowongan Pekerjaan";
        $lowongan_pekerjaan = DB::table('lowongan_pekerjaan')->join('pemberi_kerja', 'lowongan_pekerjaan.pemberi_kerja_id', '=', 'pemberi_kerja.id')->join('lokasi', 'lowongan_pekerjaan.lokasi_id', '=', 'lokasi.id')->join('kategori', 'lowongan_pekerjaan.kategori_id', '=', 'kategori.id')->where("lowongan_pekerjaan.slug", "=", $slug)->select("lowongan_pekerjaan.*")->first();
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();

        // dd($lowongan_pekerjaan);

        $pemberi_kerja = PemberiKerja::all();
        $lokasi = Lokasi::all();
        $tipePekerjaan = Kategori::all();

        return view('dashboard.lowongan_pekerjaan.edit', compact('judul', 'namaHalaman', 'lowongan_pekerjaan', 'pemberi_kerja', 'lokasi', 'tipePekerjaan', 'profil'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required',
            'lokasi_id' => 'required',
            'kategori_id' => 'required',
            'batas_lamaran' => 'required',
            'deskripsi' => 'required',
            'besaran_gaji' => 'required'
        ]);

        $lowongan_pekerjaan = LowonganPekerjaan::find($id);

        // cek apakah gambar baru diupload
        if($request->has('gambar')) {
            $lokasiGambar = "lowongan_pekerjaan/";
            File::delete($lokasiGambar. $lowongan_pekerjaan->gambar);

            $namaFileGambar = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('lowongan_pekerjaan'), $namaFileGambar);

            $lowongan_pekerjaan->gambar = $namaFileGambar;
        }

        $lowongan_pekerjaan->nama = $request->nama;
        $lowongan_pekerjaan->slug = Str::slug($request->input("nama"));
        $lowongan_pekerjaan->pemberi_kerja_id = Auth::guard('web')->user()->id;
        $lowongan_pekerjaan->lokasi_id = $request->lokasi_id;
        $lowongan_pekerjaan->kategori_id = $request->kategori_id;
        $lowongan_pekerjaan->batas_lamaran = $request->batas_lamaran;
        $lowongan_pekerjaan->deskripsi = $request->deskripsi;
        $lowongan_pekerjaan->besaran_gaji = $request->besaran_gaji;

        $lowongan_pekerjaan->save();

        return redirect()->route('lowongan_pekerjaan')->with('success', 'Data Lowongan Pekerjaan Berhasil Diupdate...');


    } 

    public function delete($id) {
        $lowongan_pekerjaan = LowonganPekerjaan::find($id);
        $lokasiGambar = "lowongan_pekerjaan/";
        File::delete($lokasiGambar. $lowongan_pekerjaan->gambar);

        $lowongan_pekerjaan->delete();

        // notify()->success('Data Pemberi Kerja Berhasil dihapus...');

        // return redirect()->route('pemberi_kerja');
        return response()->json([
            'message' => "Data Lowongan Pekerjaan Berhasil dihapus"
        ]);
    }
}
